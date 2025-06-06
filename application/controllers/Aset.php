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
            'a.lokasi_fisik',
            'r.nama',             // alias ruangan_nama
            'a.tahun_perolehan',
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
                'id' => $a['id']
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
