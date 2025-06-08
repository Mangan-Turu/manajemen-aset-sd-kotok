<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruangan extends MY_Controller
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
        $this->load->model('Ruangan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Ruangan';

        $data['contents'] = $this->load->view('ruangan_view', $data, true);
        $this->load->view('templates/admin_templates', $data);
    }

    public function get_ruangan()
    {
        $request = $_POST;

        $columns = ['id', 'kode_ruangan', 'nama_ruangan', 'jenis_ruangan', 'lantai', 'kapasitas', 'penanggung_jawab', 'keterangan'];

        $start = $request['start'];
        $length = $request['length'];
        $search = $request['search']['value'];
        $order_column = $columns[$request['order'][0]['column']];
        $order_dir = $request['order'][0]['dir'];;

        $totalData = $this->Ruangan_model->count_all();
        $totalFiltered = $this->Ruangan_model->count_filtered($search);

        $ruangan = $this->Ruangan_model->get_dt_all($start, $length, $search, $order_column, $order_dir);

        $data = [];
        $no = $start + 1;
        foreach ($ruangan as $s) {
            $data[] = [
                'no' => $no++,
                'kode_ruangan' => htmlspecialchars($s['kode_ruangan']),
                'nama_ruangan' => htmlspecialchars($s['nama_ruangan']),
                'jenis_ruangan' => htmlspecialchars($s['jenis_ruangan']),
                'lantai' => htmlspecialchars($s['lantai']),
                'kapasitas' => htmlspecialchars($s['kapasitas']),
                'id' => $s['id'],
                'penanggung_jawab' => htmlspecialchars($s['penanggung_jawab']),
                'keterangan' => htmlspecialchars($s['keterangan']),
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
    
        if ($mode === 'edit') {
            $this->form_validation->set_rules('kode_ruangan', 'Kode Ruangan', 'required|trim');
        }
    
        $this->form_validation->set_rules('nama_ruangan', 'Nama Ruangan', 'trim');
        $this->form_validation->set_rules('jenis_ruangan', 'Jenis Ruangan', 'trim');
        $this->form_validation->set_rules('lantai', 'Lantai', 'trim');
        $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'trim');
        $this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim');
    
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('alert_danger', validation_errors());
            redirect('ruangan');
            return;
        }
    
        $data = [
            'kode_ruangan'      => ($mode === 'edit') 
                                    ? $this->input->post('kode_ruangan', TRUE) 
                                    : $this->generate_kode_ruangan(),
            'nama_ruangan'      => $this->input->post('nama_ruangan', TRUE),
            'jenis_ruangan'     => $this->input->post('jenis_ruangan', TRUE),
            'lantai'            => $this->input->post('lantai', TRUE),
            'kapasitas'         => $this->input->post('kapasitas', TRUE),
            'penanggung_jawab'  => $this->input->post('penanggung_jawab', TRUE),
            'keterangan'        => $this->input->post('keterangan', TRUE),
            'updated_at'        => date('Y-m-d H:i:s'),
        ];
    
        if ($mode === 'edit' && !empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('m_ruangan', $data);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Data ruangan berhasil diperbarui.']
                : ['alert_danger', 'Gagal memperbarui data ruangan atau tidak ada perubahan data.'];
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('m_ruangan', $data);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Data ruangan berhasil ditambahkan.']
                : ['alert_danger', 'Gagal menambahkan data ruangan.'];
        }
    
        $this->session->set_flashdata($message[0], $message[1]);
        redirect('ruangan');
    }
    
    private function generate_kode_ruangan()
    {
        $this->db->select('kode_ruangan');
        $this->db->like('kode_ruangan', 'R', 'after');
        $this->db->order_by('kode_ruangan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('m_ruangan');
    
        if ($query->num_rows() > 0) {
            $last_kode = $query->row()->kode_ruangan;
            $number = (int) substr($last_kode, 1);
            $new_number = $number + 1;
        } else {
            $new_number = 1;
        }
    
        return 'R' . str_pad($new_number, 4, '0', STR_PAD_LEFT); 
    }    

    public function delete($id)
    {
        if (empty($id)) {
            $this->session->set_flashdata('alert_danger', 'ID ruangan tidak ditemukan.');
            redirect('ruangan');
            return;
        }

        $this->db->where('id', $id);
        $this->db->update('m_ruangan', ['deleted' => 1, 'updated_at' => date('Y-m-d H:i:s')]);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('alert_success', 'Data ruangan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('alert_danger', 'Gagal menghapus data ruangan atau data sudah dihapus sebelumnya.');
        }

        redirect('ruangan');
    }
}
