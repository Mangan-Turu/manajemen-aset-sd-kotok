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
            $row['nama']        = htmlspecialchars($u['nama']);
            $row['username']    = htmlspecialchars($u['username']);
            $row['email']       = htmlspecialchars($u['email']);
            $row['role']        = htmlspecialchars($u['role']) ?: '-';
            $row['aksi']        = '
                                    <a href="' . base_url('pengguna/edit/' . $u['id']) . '" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="' . base_url('pengguna/delete/' . $u['id']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin hapus?\')">Hapus</a>
                                ';
            $data[] = $row;
        }

        echo json_encode([
            "draw" => intval($request['draw']),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ]);
    }
}
