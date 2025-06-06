<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mutasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mutasi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Mutasi';

        $data['contents'] = $this->load->view('mutasi_view', $data, true);
        $this->load->view('templates/admin_templates', $data);
    }

    public function get_mutasi()
    {
        $request = $_POST;

        $columns = ['id', 'nama_aset', 'jumlah', 'satuan', 'dari_ruangan', 'ke_ruangan', 'tanggal_mutasi', 'alasan', 'dokumen_mutasi'];

        $start = isset($request['start']) ? (int) $request['start'] : 0;
        $length = isset($request['length']) ? (int) $request['length'] : 10;
        $search = isset($request['search']['value']) ? $request['search']['value'] : '';
        $order_column_index = isset($request['order'][0]['column']) ? (int) $request['order'][0]['column'] : 0;
        $order_column = isset($columns[$order_column_index]) ? $columns[$order_column_index] : 'id';
        $order_dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'asc';

        $totalData = $this->Mutasi_model->count_all();
        $totalFiltered = $this->Mutasi_model->count_filtered($search);

        $mutasi = $this->Mutasi_model->get_dt_all($start, $length, $search, $order_column, $order_dir);

        $data = [];
        $no = $start + 1;
        foreach ($mutasi as $s) {
            $data[] = [
                'no' => $no++,
                'nama_aset' => htmlspecialchars($s['nama_aset']),
                'jumlah' => htmlspecialchars($s['jumlah']),
                'satuan' => htmlspecialchars($s['satuan']),
                'dari_ruangan' => htmlspecialchars($s['dari_ruangan']),
                'ke_ruangan' => htmlspecialchars($s['ke_ruangan']),
                'tanggal_mutasi' => htmlspecialchars($s['tanggal_mutasi']),
                'alasan' => htmlspecialchars($s['alasan']),
                'dokumen_mutasi' => htmlspecialchars($s['dokumen_mutasi']),
                'aset_id' => $s['aset_id'],
                'dari_ruangan_id' => $s['dari_ruangan_id'],
                'ke_ruangan_id' => $s['ke_ruangan_id'],
                'id' => $s['id']
            ];
        }

        echo json_encode([
            "draw" => isset($request['draw']) ? intval($request['draw']) : 1,
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ]);
    }

    public function tambah_mutasi()
    {
        $this->form_validation->set_rules('asset', 'Asset', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|integer');
        $this->form_validation->set_rules('dari_ruangan', 'Dari Ruangan', 'required');
        $this->form_validation->set_rules('ke_ruangan', 'Ke Ruangan', 'required');
        $this->form_validation->set_rules('alasan', 'Alasan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('mutasi');
        }

        $id = $this->input->post('id_mutasi');
        $mode = $this->input->post('mode');

        $data = [
            'aset_id'           => $this->input->post('asset'),
            'jumlah'            => $this->input->post('jumlah'),
            'dari_ruangan_id'   => $this->input->post('dari_ruangan'),
            'ke_ruangan_id'     => $this->input->post('ke_ruangan'),
            'alasan'            => $this->input->post('alasan'),
            'tanggal_mutasi'    => date('Y-m-d H:i:s'),
        ];

        if (!empty($_FILES['dokumen']['name'])) {
            $config['upload_path']   = './assets/doc/mutasi/';
            $config['allowed_types'] = 'pdf|jpg|png|jpeg';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('dokumen')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('mutasi');
            }

            $upload_data = $this->upload->data();
            $data['dokumen_mutasi'] = $upload_data['file_name'];
        }

        if ($mode === 'edit' && $id) {
            $this->db->where('id', $id)->update('m_mutasi', $data);
            $this->session->set_flashdata('success', 'Data mutasi berhasil diperbarui.');
        } else {
            $data['created_by'] = $this->session->userdata('user_id');
            $this->db->insert('m_mutasi', $data);
            $this->session->set_flashdata('success', 'Data mutasi berhasil ditambahkan.');
        }

        redirect('mutasi');
    }

    public function download($id)
    {
        $mutasi = $this->Mutasi_model->get_by_id($id);

        if (!$mutasi || empty($mutasi->dokumen_mutasi)) {
            $this->load->view('welcome_message');
        }

        $file_path = FCPATH . 'assets/doc/mutasi' . $mutasi->dokumen_mutasi;

        if (file_exists($file_path)) {
            $this->load->helper('download');
            force_download($file_path, NULL);
        } else {
            $this->load->view('errors/gagal_download', [
                'message' => 'File tidak ditemukan atau sudah dihapus.'
            ]);
        }
    }
} 