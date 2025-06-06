<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends MY_Controller
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
        $this->load->model('users_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Siswa';

        $data['contents'] = $this->load->view('siswa_view', $data, true);
        $this->load->view('templates/admin_templates', $data);
    }

    public function get_siswa()
    {
        $request = $_POST;

        $columns = ['id', 'nis', 'nama_siswa', 'kelas', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'nama_ortu', 'no_hp_ortu', 'status_aktif'];

        $start = $request['start'];
        $length = $request['length'];
        $search = $request['search']['value'];
        $order_column = $columns[$request['order'][0]['column']];
        $order_dir = $request['order'][0]['dir'];

        $this->load->model('Siswa_model');

        $totalData = $this->Siswa_model->count_all();
        $totalFiltered = $this->Siswa_model->count_filtered($search);

        $siswa = $this->Siswa_model->get_dt_all($start, $length, $search, $order_column, $order_dir);

        $data = [];
        $no = $start + 1;
        foreach ($siswa as $s) {
            $data[] = [
                'no' => $no++,
                'nis' => htmlspecialchars($s['nis']),
                'nama_siswa' => htmlspecialchars($s['nama_siswa']),
                'kelas' => htmlspecialchars($s['kelas']),
                'jenis_kelamin' => htmlspecialchars($s['jenis_kelamin']),
                'nama_ortu' => htmlspecialchars($s['nama_ortu']),
                'id' => $s['id'],
                'tempat_lahir' => htmlspecialchars($s['tempat_lahir']),
                'tanggal_lahir' => htmlspecialchars($s['tanggal_lahir']),
                'alamat' => htmlspecialchars($s['alamat']),
                'no_hp_ortu' => htmlspecialchars($s['no_hp_ortu']),
                'status_aktif' => $s['status_aktif'],
            ];
        }

        echo json_encode([
            "draw" => intval($request['draw']),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ]);
    }

    public function store_siswa()
    {
        $mode = $this->input->post('mode', TRUE);
        $id   = $this->input->post('id_siswa', TRUE);

        var_dump($mode, $id);

        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|trim');
        $this->form_validation->set_rules('kelas', 'Kelas', 'trim');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|in_list[L,P]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim');
        $this->form_validation->set_rules('nama_ortu', 'Nama Orang Tua', 'trim');
        $this->form_validation->set_rules('no_hp_ortu', 'No HP Orang Tua', 'trim');
        $this->form_validation->set_rules('status_aktif', 'Status Aktif', 'trim|in_list[0,1]');

        if ($mode === 'edit') {
            $this->form_validation->set_rules('nis', 'NIS', 'required|trim');
        } else {
            $this->form_validation->set_rules('niss', 'NIS', 'required|trim|is_unique[m_siswa.nis,id,' . $id . ']');
        }

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('alert_danger', validation_errors());
            redirect('siswa');
            return;
        }

        $data = [
            'nis'           => $this->input->post('nis', TRUE),
            'nama_siswa'    => $this->input->post('nama_siswa', TRUE),
            'kelas'         => $this->input->post('kelas', TRUE),
            'tempat_lahir'  => $this->input->post('tempat_lahir', TRUE),
            'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
            'alamat'        => $this->input->post('alamat', TRUE),
            'nama_ortu'     => $this->input->post('nama_ortu', TRUE),
            'no_hp_ortu'    => $this->input->post('no_hp_ortu', TRUE),
            'status_aktif'  => $this->input->post('status_aktif', TRUE) !== null ? $this->input->post('status_aktif', TRUE) : 1,
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        if ($mode === 'edit' && !empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('m_siswa', $data);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Data siswa berhasil diperbarui.']
                : ['alert_danger', 'Gagal memperbarui data siswa atau tidak ada perubahan data.'];
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('m_siswa', $data);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Data siswa berhasil ditambahkan.']
                : ['alert_danger', 'Gagal menambahkan data siswa.'];
        }

        $this->session->set_flashdata($message[0], $message[1]);
        redirect('siswa');
    }

    public function delete($id)
    {
        if (empty($id)) {
            $this->session->set_flashdata('alert_danger', 'ID siswa tidak ditemukan.');
            redirect('siswa');
            return;
        }

        $this->db->where('id', $id);
        $this->db->update('m_siswa', ['deleted' => 1, 'updated_at' => date('Y-m-d H:i:s')]);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('alert_success', 'Data siswa berhasil dihapus.');
        } else {
            $this->session->set_flashdata('alert_danger', 'Gagal menghapus data siswa atau data sudah dihapus sebelumnya.');
        }

        redirect('siswa');
    }
}
