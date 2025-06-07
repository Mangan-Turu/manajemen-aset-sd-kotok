<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemeliharaan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pemeliharaan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Pemeliharaan';

        $data['contents'] = $this->load->view('pemeliharaan_view', $data, true);
        $this->load->view('templates/admin_templates', $data);
    }

    public function get_pemeliharaan()
    {
        $request = $_POST;

        $columns = ['id', 'nama_aset', 'tanggal_pemeliharaan', 'status', 'jumlah', 'satuan', 'jenis_pemeliharaan', 'deskripsi', 'biaya'];

        $start = isset($request['start']) ? (int) $request['start'] : 0;
        $length = isset($request['length']) ? (int) $request['length'] : 10;
        $search = isset($request['search']['value']) ? $request['search']['value'] : '';
        $order_column_index = isset($request['order'][0]['column']) ? (int) $request['order'][0]['column'] : 0;
        $order_column = isset($columns[$order_column_index]) ? $columns[$order_column_index] : 'id';
        $order_dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'asc';

        $totalData = $this->Pemeliharaan_model->count_all();
        $totalFiltered = $this->Pemeliharaan_model->count_filtered($search);

        $pemeliharaan = $this->Pemeliharaan_model->get_dt_all($start, $length, $search, $order_column, $order_dir);

        $data = [];
        $no = $start + 1;
        foreach ($pemeliharaan as $s) {
            $data[] = [
                'no' => $no++,
                'nama_aset' => htmlspecialchars($s['nama_aset']),
                'jumlah' => htmlspecialchars($s['jumlah']),
                'satuan' => htmlspecialchars($s['satuan']),
                'tanggal_pemeliharaan' => htmlspecialchars($s['tanggal_pemeliharaan']),
                'jenis_pemeliharaan' => htmlspecialchars($s['jenis_pemeliharaan']),
                'status' => htmlspecialchars($s['status']),
                'deskripsi' => htmlspecialchars($s['deskripsi']),
                'biaya' => htmlspecialchars($s['biaya']),
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

    public function tambah_pemeliharaan()
    {
        $this->form_validation->set_rules('asset_pemeliharaan', 'Asset', 'required');
        $this->form_validation->set_rules('jumlah_pemeliharaan', 'Jumlah', 'required|integer');
        $this->form_validation->set_rules('jenis_pemeliharaan', 'Jenis', 'required');
        $this->form_validation->set_rules('deskripsi_pemeliharaan', 'Deskripsi', 'required');
        $this->form_validation->set_rules('biaya_pemeliharaan', 'Biaya', 'required|numeric');
    
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('pemeliharaan');
        }
    
        $id   = $this->input->post('id_pemeliharaan');
        $mode = $this->input->post('mode');
    
        $data = [
            'aset_id'               => $this->input->post('asset_pemeliharaan'),
            'jumlah'                => $this->input->post('jumlah_pemeliharaan'),
            'jenis_pemeliharaan'    => $this->input->post('jenis_pemeliharaan'),
            'deskripsi'             => $this->input->post('deskripsi_pemeliharaan'),
            'biaya'                 => $this->input->post('biaya_pemeliharaan'),
            'tanggal_pemeliharaan'  => date('Y-m-d H:i:s'),
        ];
    
        $dokumenBaru = !empty($_FILES['dokumen_pemeliharaan']['name']);
    
        if ($dokumenBaru) {
            $config['upload_path']   = './assets/doc/pemeliharaan/';
            $config['allowed_types'] = 'pdf|jpg|png|jpeg';
            $config['max_size']      = 2048; // dalam KB
            $config['encrypt_name']  = TRUE;
    
            $this->load->library('upload', $config);
    
            if (!$this->upload->do_upload('dokumen_pemeliharaan')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('pemeliharaan');
            }
    
            $upload_data = $this->upload->data();
            $data['dokumen_pemeliharaan'] = $upload_data['file_name'];
    
            if ($mode === 'edit' && $id) {
                $existing = $this->db->get_where('t_aset_pemeliharaan', ['id' => $id])->row();
                if ($existing && !empty($existing->dokumen_pemeliharaan)) {
                    $old_path = './assets/doc/pemeliharaan/' . $existing->dokumen_pemeliharaan;
                    if (file_exists($old_path)) {
                        unlink($old_path);
                    }
                }
            }
        }
    
        if ($mode === 'edit' && $id) {
            $this->db->where('id', $id)->update('t_aset_pemeliharaan', $data);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Data Pemeliharaan berhasil diperbarui.']
                : ['alert_danger', 'Gagal memperbarui data Pemeliharaan atau tidak ada perubahan data.'];
        } else {
            $data['created_by'] = $this->session->userdata('user_id');
            $this->db->insert('t_aset_pemeliharaan', $data);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Data Pemeliharanaan berhasil ditambahkan.']
                : ['alert_danger', 'Gagal memperbarui data Pemeliharanaan atau tidak ada perubahan data.'];
        }
        
        $this->session->set_flashdata($message[0], $message[1]);
        redirect('pemeliharaan');
    }    

    public function download($id)
    {
        $pemeliharaan = $this->Pemeliharaan_model->get_by_id($id);

        if (!$pemeliharaan || empty($pemeliharaan->dokumen_pemeliharaan)) {
            $this->load->view('errors/gagal_download');
        }

        $file_path = FCPATH . 'assets/doc/pemeliharaan/' . $pemeliharaan->dokumen_pemeliharaan;

        if (file_exists($file_path)) {
            $this->load->helper('download');
            force_download($file_path, NULL);
        } else {
            $this->load->view('errors/gagal_download', [
                'message' => 'File tidak ditemukan atau sudah dihapus.'
            ]);
        }
    }

    public function update_status()
    {
        $id = $this->input->post('id');

        if ($id) {
            $this->db->where('id', $id);
            $this->db->update('t_aset_pemeliharaan', ['status' => 1]);

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
        }
    }

} 