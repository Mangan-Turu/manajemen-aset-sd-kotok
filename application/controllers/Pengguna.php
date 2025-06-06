<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends MY_Controller
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
        $data['title'] = 'Data Pengguna';

        $data['contents'] = $this->load->view('pengguna_view', $data, true);
        $this->load->view('templates/admin_templates', $data);
    }


    public function get_pengguna()
    {
        $request = $_POST;
        $columns = ['id', 'nama', 'username', 'email', 'role'];

        $start          = $request['start'];
        $length         = $request['length'];
        $search         = $request['search']['value'];
        $order_column   = $columns[$request['order'][0]['column']];
        $order_dir      = $request['order'][0]['dir'];

        $this->load->model('users_model');

        $totalData      = $this->users_model->count_all();
        $totalFiltered  = $this->users_model->count_filtered($search);

        $users = $this->users_model->get_dt_all($start, $length, $search, $order_column, $order_dir);

        $data = [];
        $no = $start + 1;
        foreach ($users as $u) {
            $row    = [];
            $row['no']          = $no++;
            $row['id']          = $u['id'];
            $row['nama']        = htmlspecialchars($u['nama']);
            $row['username']    = htmlspecialchars($u['username']);
            $row['email']       = htmlspecialchars($u['email']);
            $row['no_hp']       = htmlspecialchars($u['no_hp']) ?: '';
            $row['role']        = htmlspecialchars($u['role']) ?: '-';
            $data[] = $row;
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

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,kepala_sekolah]');

        if ($mode === 'edit') {
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]');
            }
        } else {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|trim');
            $this->form_validation->set_rules('username', 'Username', 'is_unique[users.username]');
            $this->form_validation->set_rules('email', 'Email', 'is_unique[users.email]');
        }

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('alert_danger', validation_errors());
            redirect('pengguna');
        }

        $data = [
            'nama'       => $this->input->post('nama', TRUE),
            'username'   => $this->input->post('username', TRUE),
            'email'      => $this->input->post('email', TRUE),
            'role'       => $this->input->post('role', TRUE),
            'no_hp'      => $this->input->post('no_hp', TRUE),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($mode === 'edit') {
            $this->db->where('id', $id)->update('users', $data);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Pengguna berhasil diperbarui.']
                : ['alert_danger', 'Gagal memperbarui pengguna.'];
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('users', $data);
            $message = $this->db->affected_rows() > 0
                ? ['alert_success', 'Pengguna berhasil ditambahkan.']
                : ['alert_danger', 'Gagal menambahkan pengguna.'];
        }

        $this->session->set_flashdata($message[0], $message[1]);
        redirect('pengguna');
    }

    public function delete($id)
    {
        if ($this->users_model->delete($id)) {
            $this->session->set_flashdata('alert_success', 'Pengguna berhasil dihapus.');
        } else {
            $this->session->set_flashdata('alert_danger', 'Gagal menghapus pengguna.');
        }
        redirect('pengguna');
    }
}
