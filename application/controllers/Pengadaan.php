<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengadaan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengadaan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Pengadaan';
        $data['supliers'] = $this->Pengadaan_model->get_all_suppliers();

        $data['contents'] = $this->load->view('pengadaan_view', $data, true);
        $this->load->view('templates/admin_templates', $data);
    }

    public function get_pengadaan()
    {
        $request = $_POST;

        $columns = [
            'id',
            'no_pengadaan',
            'tanggal_pengadaan',
            'aset_id',
            'jumlah',
            'satuan',
            'harga_satuan',
            'total_harga',
            'sumber_dana',
            'supplier',
            'dokumen_pengadaan',
            'keterangan'
        ];

        $start = $request['start'];
        $length = $request['length'];
        $search = $request['search']['value'];
        $order_column = $columns[$request['order'][0]['column']] ?? 'id';
        $order_dir = $request['order'][0]['dir'] ?? 'asc';

        $this->load->model('Pengadaan_model');

        $totalData = $this->Pengadaan_model->count_all();
        $totalFiltered = $this->Pengadaan_model->count_filtered($search);

        $pengadaan = $this->Pengadaan_model->get_dt_all($start, $length, $search, $order_column, $order_dir);

        $data = [];
        $no = $start + 1;
        foreach ($pengadaan as $p) {
            $data[] = [
                'no' => $no++,
                'id' => $p['id'],
                'no_pengadaan' => htmlspecialchars($p['no_pengadaan']),
                'tanggal_pengadaan' => htmlspecialchars($p['tanggal_pengadaan']),
                'aset_id' => $p['aset_id'],
                'aset' => isset($p['nama_aset']) ? htmlspecialchars($p['nama_aset']) : '', // jika pakai JOIN
                'jumlah' => (int)$p['jumlah'],
                'satuan' => htmlspecialchars($p['satuan']),
                // 'harga_satuan' => number_format($p['harga_satuan'], 2, ',', '.'),
                // 'total_harga' => number_format($p['total_harga'], 2, ',', '.'),
                'harga_satuan' => explode('.', $p['harga_satuan'])[0],
                'total_harga' => explode('.', $p['total_harga'])[0],
                'sumber_dana' => htmlspecialchars($p['sumber_dana']),
                'supplier' => htmlspecialchars($p['supplier']),
                'dokumen_pengadaan' => $p['dokumen_pengadaan'],
                'keterangan' => $p['keterangan']
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
        $mode = $this->input->post('mode');
        $id = $this->input->post('id');

        if ($mode !== 'edit') {
            $this->db->select('no_pengadaan');
            $this->db->like('no_pengadaan', 'PGN');
            $this->db->order_by('no_pengadaan', 'DESC');
            $this->db->limit(1);
            $last = $this->db->get('m_pengadaan')->row();

            if ($last) {
                $num = (int) substr($last->no_pengadaan, 3);
                $newKode = 'PGN' . str_pad($num + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $newKode = 'PGN001';
            }

            $_POST['no_pengadaan'] = $newKode;
        }

        // Validasi
        $this->form_validation->set_rules('tanggal_pengadaan', 'Tanggal Pengadaan', 'required');
        $this->form_validation->set_rules('aset_id', 'Aset', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|integer');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required|numeric');
        $this->form_validation->set_rules('total_harga', 'Total Harga', 'required|numeric');
        $this->form_validation->set_rules('sumber_dana', 'Sumber Dana', 'required');
        $this->form_validation->set_rules('supplier', 'Supplier', 'required');
        $this->form_validation->set_rules('dokumen_pengadaan', 'Dokumen Pengadaan', 'callback_file_check');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('alert_danger', validation_errors());
            redirect('pengadaan');
            return;
        }

        // Data awal dari input
        $data = [
            'no_pengadaan'      => $this->input->post('no_pengadaan'),
            'tanggal_pengadaan' => $this->input->post('tanggal_pengadaan'),
            'aset_id'           => $this->input->post('aset_id'),
            'jumlah'            => $this->input->post('jumlah'),
            'satuan'            => $this->input->post('satuan'),
            'harga_satuan'      => $this->input->post('harga_satuan'),
            'total_harga'       => $this->input->post('total_harga'),
            'sumber_dana'       => $this->input->post('sumber_dana'),
            'supplier'          => $this->input->post('supplier'),
            'dokumen_pengadaan' => null,
            'keterangan'        => $this->input->post('keterangan'),
        ];

        if (!empty($_FILES['dokumen_pengadaan']['name'])) {
            $config['upload_path']      = './assets/doc/pengadaan/';
            $config['allowed_types']    = 'pdf|jpg|png|jpeg';
            $config['max_size']         = 2048;
            $config['encrypt_name']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('dokumen_pengadaan')) {
                $this->session->set_flashdata('alert_danger', $this->upload->display_errors());
                redirect('pengadaan');
                return;
            }

            $upload_data = $this->upload->data();
            $data['dokumen_pengadaan'] = str_replace('.', '', $config['upload_path']) . $upload_data['file_name'];
        }

        if ($mode === 'edit' && !empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('m_pengadaan', $data);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Data aset berhasil diperbarui.']
                : ['alert_danger', 'Gagal memperbarui data aset atau tidak ada perubahan data.'];
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('m_pengadaan', $data);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Data aset berhasil ditambahkan.']
                : ['alert_danger', 'Gagal menambahkan data aset.'];
        }

        $this->session->set_flashdata($message[0], $message[1]);
        redirect('pengadaan');
    }

    public function file_check($str)
    {
        if (!empty($_FILES['dokumen_pengadaan']['name'])) {
            $allowed_mime = ['application/pdf', 'image/jpeg', 'image/png'];
            $mime = get_mime_by_extension($_FILES['dokumen_pengadaan']['name']);
            if (in_array($mime, $allowed_mime)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Format file tidak valid. Hanya PDF, JPG, PNG yang diperbolehkan.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Wajib mengunggah dokumen pengadaan.');
            return false;
        }
    }

    public function delete($id)
    {
        if (empty($id)) {
            $this->session->set_flashdata('alert_danger', 'ID pengadaan tidak ditemukan.');
            redirect('pengadaan');
            return;
        }

        $this->db->where('id', $id);
        $this->db->update('m_pengadaan', ['deleted' => 1, 'updated_at' => date('Y-m-d H:i:s')]);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('alert_success', 'Data pengadaan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('alert_danger', 'Gagal menghapus data pengadaan atau data sudah dihapus sebelumnya.');
        }

        redirect('pengadaan');
    }
}
