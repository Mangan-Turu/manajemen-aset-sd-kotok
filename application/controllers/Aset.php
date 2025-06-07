<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aset extends MY_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('asets_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Aset';

        $data['contents'] = $this->load->view('aset_view', $data, true);
        $this->load->view('templates/admin_templates', $data);
    }

    public function get_aset()
    {
        $request = $_POST;

        // Urutan kolom sesuai dengan frontend DataTables
        $columns = [
            'a.id',               // no (dummy, pakai id)
            'a.kode_aset',
            'a.nama_aset',
            'a.kategori',
            'a.merk',
            'a.tipe',
            'a.jumlah',
            'a.spesifikasi', // spesifikasi tidak ditampilkan di tabel
            'a.sumber_data',
            'a.harga_satuan',
            'a.ruangan_id', // ruangan_id tidak ditampilkan di tabel
            'a.lokasi_fisik',
            'r.nama',             // alias ruangan_nama
            'a.tahun_perolehan',
            'a.satuan',
            'a.id'                // id untuk action (edit/delete)
        ];

        $start = $request['start'];
        $length = $request['length'];
        $search = $request['search']['value'];
        $order_column = $columns[$request['order'][0]['column']];
        $order_dir = $request['order'][0]['dir'];

        $totalData = $this->asets_model->count_all();
        $totalFiltered = $this->asets_model->count_filtered($search);
        $asets = $this->asets_model->get_dt_all($start, $length, $search, $order_column, $order_dir);

        $data = [];
        $no = $start + 1;
        foreach ($asets as $a) {
            $data[] = [
                'no' => $no++,
                'kode_aset' => htmlspecialchars($a['kode_aset']),
                'nama_aset' => htmlspecialchars($a['nama_aset']),
                'kategori' => htmlspecialchars($a['kategori']),
                'merk' => htmlspecialchars($a['merk']),
                'tipe' => htmlspecialchars($a['tipe']),
                'jumlah' => htmlspecialchars($a['jumlah']),
                'lokasi_fisik' => htmlspecialchars($a['lokasi_fisik']),
                'ruangan_nama' => htmlspecialchars($a['ruangan_nama'] ?? '-'),
                'tahun_perolehan' => htmlspecialchars($a['tahun_perolehan']),
                'id' => $a['id'],
                'sumber_dana' => htmlspecialchars($a['sumber_dana']),
                'harga_satuan' => htmlspecialchars($a['harga_satuan']),
                'spesifikasi' => htmlspecialchars($a['spesifikasi'] ?? '-'),
                'ruangan_id' => $a['ruangan_id'],
                'satuan' => htmlspecialchars($a['satuan'] ?? '-'),

            ];
        }

        echo json_encode([
            "draw" => intval($request['draw']),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ]);
    }

    public function store()
    {
        $mode = $this->input->post('mode', TRUE);
        $id   = $this->input->post('id', TRUE);

        $this->form_validation->set_rules('nama_aset', 'Nama Aset', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('merk', 'Merk', 'required');
        $this->form_validation->set_rules('tipe', 'Tipe', 'required');
        $this->form_validation->set_rules('spesifikasi', 'Spesifikasi', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('lokasi_fisik', 'Lokasi Fisik', 'required');
        $this->form_validation->set_rules('ruangan_id', 'Ruangan', 'required|numeric');
        $this->form_validation->set_rules('tahun_perolehan', 'Tahun Perolehan', 'required|numeric');
        $this->form_validation->set_rules('sumber_dana', 'Sumber Dana', 'required');
        $this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required|numeric');

        if ($mode === 'edit') {
            $this->form_validation->set_rules('id', 'ID Aset', 'required|numeric');
        }

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('alert_danger', validation_errors());
            redirect('aset');
            return;
        }

        $data = [
            'nama_aset'         => $this->input->post('nama_aset', TRUE),
            'kategori'          => $this->input->post('kategori', TRUE),
            'merk'              => $this->input->post('merk', TRUE),
            'tipe'              => $this->input->post('tipe', TRUE),
            'spesifikasi'       => $this->input->post('spesifikasi', TRUE),
            'jumlah'            => $this->input->post('jumlah', TRUE),
            'satuan'            => $this->input->post('satuan', TRUE),
            'lokasi_fisik'      => $this->input->post('lokasi_fisik', TRUE),
            'ruangan_id'        => $this->input->post('ruangan_id', TRUE),
            'tahun_perolehan'   => $this->input->post('tahun_perolehan', TRUE),
            'sumber_dana'       => $this->input->post('sumber_dana', TRUE),
            'harga_satuan'      => $this->input->post('harga_satuan', TRUE)
        ];

        if ($mode === 'edit' && !empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('m_aset', $data);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Data aset berhasil diperbarui.']
                : ['alert_danger', 'Gagal memperbarui data aset atau tidak ada perubahan data.'];
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('m_aset', $data);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Data aset berhasil ditambahkan.']
                : ['alert_danger', 'Gagal menambahkan data aset.'];
        }

        $this->session->set_flashdata($message[0], $message[1]);
        redirect('aset');
    }

    public function delete($id)
    {
        if (empty($id)) {
            $this->session->set_flashdata('alert_danger', 'ID aset tidak ditemukan.');
            redirect('aset');
            return;
        }

        $this->db->where('id', $id);
        $this->db->update('m_aset', ['deleted' => 1, 'updated_at' => date('Y-m-d H:i:s')]);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('alert_success', 'Data aset berhasil dihapus.');
        } else {
            $this->session->set_flashdata('alert_danger', 'Gagal menghapus data aset atau data sudah dihapus sebelumnya.');
        }

        redirect('aset');
    }
}
