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

        $columns = ['id', 'nis', 'nama_siswa', 'kelas', 'jenis_kelamin', 'nama_ortu'];

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
                'jenis_kelamin' => ($s['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'),
                'nama_ortu' => htmlspecialchars($s['nama_ortu']),
                'id' => $s['id']
            ];
        }

        echo json_encode([
            "draw" => intval($request['draw']),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ]);
    }
}
