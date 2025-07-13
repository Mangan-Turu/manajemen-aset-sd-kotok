<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kerusakan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kerusakan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Kerusakan';

        $data['contents'] = $this->load->view('kerusakan_view', $data, true);
        $this->load->view('templates/admin_templates', $data);
    }

    public function get_kerusakan()
    {
        $request = $_POST;

        $columns = ['id', 'nama_aset', 'tanggal_kerusakan', 'jumlah', 'satuan', 'deskripsi', 'biaya'];

        $start = isset($request['start']) ? (int) $request['start'] : 0;
        $length = isset($request['length']) ? (int) $request['length'] : 10;
        $search = isset($request['search']['value']) ? $request['search']['value'] : '';
        $order_column_index = isset($request['order'][0]['column']) ? (int) $request['order'][0]['column'] : 0;
        $order_column = isset($columns[$order_column_index]) ? $columns[$order_column_index] : 'id';
        $order_dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'asc';

        $totalData = $this->Kerusakan_model->count_all();
        $totalFiltered = $this->Kerusakan_model->count_filtered($search);

        $kerusakan = $this->Kerusakan_model->get_dt_all($start, $length, $search, $order_column, $order_dir);

        $data = [];
        $no = $start + 1;
        foreach ($kerusakan as $s) {
            $data[] = [
                'no' => $no++,
                'nama_aset' => htmlspecialchars($s['nama_aset']),
                'jumlah' => htmlspecialchars($s['jumlah']),
                'satuan' => htmlspecialchars($s['satuan']),
                'tanggal_kerusakan' => htmlspecialchars($s['tanggal_kerusakan']),
                'deskripsi' => htmlspecialchars($s['deskripsi']),
                'aset_id' => $s['aset_id'],
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

    public function tambah_kerusakan()
    {
        $this->form_validation->set_rules('asset_kerusakan', 'Asset', 'required');
        $this->form_validation->set_rules('jumlah_kerusakan', 'Jumlah', 'required|integer');
        $this->form_validation->set_rules('deskripsi_kerusakan', 'Deskripsi', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('kerusakan');
        }

        $id   = $this->input->post('id_kerusakan');
        $mode = $this->input->post('mode');

        $data = [
            'aset_id'               => $this->input->post('asset_kerusakan'),
            'jumlah'                => $this->input->post('jumlah_kerusakan'),
            'deskripsi'             => $this->input->post('deskripsi_kerusakan'),
            'tanggal_kerusakan'     => date('Y-m-d H:i:s'),
        ];

        $dokumenBaru = !empty($_FILES['dokumen_kerusakan']['name']);

        if ($dokumenBaru) {
            $config['upload_path']   = './assets/doc/kerusakan/';
            $config['allowed_types'] = 'pdf|jpg|png|jpeg';
            $config['max_size']      = 2048; // dalam KB
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('dokumen_kerusakan')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('kerusakan');
            }

            $upload_data = $this->upload->data();
            $data['dokumen_kerusakan'] = $upload_data['file_name'];

            if ($mode === 'edit' && $id) {
                $existing = $this->db->get_where('t_aset_kerusakan', ['id' => $id])->row();
                if ($existing && !empty($existing->dokumen_kerusakan)) {
                    $old_path = './assets/doc/kerusakan/' . $existing->dokumen_kerusakan;
                    if (file_exists($old_path)) {
                        unlink($old_path);
                    }
                }
            }
        }

        if ($mode === 'edit' && $id) {
            $this->db->where('id', $id)->update('t_aset_kerusakan', $data);
            $this->db->where('id', $data['aset_id'])->update('m_aset', ['status' => 2]);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Data Kerusakan berhasil diperbarui.']
                : ['alert_danger', 'Gagal memperbarui data Kerusakan atau tidak ada perubahan data.'];
        } else {
            $data['created_by'] = $this->session->userdata('user_id');
            $this->db->insert('t_aset_kerusakan', $data);
            $this->db->where('id', $data['aset_id'])->update('m_aset', ['status' => 2]);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Data Kerusakan berhasil ditambahkan.']
                : ['alert_danger', 'Gagal memperbarui data Kerusakan atau tidak ada perubahan data.'];
        }

        $this->session->set_flashdata($message[0], $message[1]);
        redirect('kerusakan');
    }

    public function download($id)
    {
        $kerusakan = $this->Kerusakan_model->get_by_id($id);

        if (!$kerusakan || empty($kerusakan->dokumen_kerusakan)) {
            $this->load->view('errors/gagal_download');
        }

        $file_path = FCPATH . 'assets/doc/kerusakan/' . $kerusakan->dokumen_kerusakan;

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
