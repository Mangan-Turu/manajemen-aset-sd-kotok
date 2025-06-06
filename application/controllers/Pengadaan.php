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

        $data['contents'] = $this->load->view('pengadaan_view', $data, true);
        $this->load->view('templates/admin_templates', $data);
    }

    public function get_pengadaan()
    {
        $request = $_POST;

        $columns = ['id', 'no_pengadaan', 'tanggal_pengadaan', 'aset_id', 'jumlah', 'satuan', 'harga_satuan', 'total_harga', 'sumber_dana', 'supplier'];

        $start = $request['start'];
        $length = $request['length'];
        $search = $request['search']['value'];
        $order_column = $columns[$request['order'][0]['column']] ?? 'id';
        $order_dir = $request['order'][0]['dir'] ?? 'asc';

        $totalData = $this->Pengadaan_model->count_all();
        $totalFiltered = $this->Pengadaan_model->count_filtered($search);

        $pengadaan = $this->Pengadaan_model->get_dt_all($start, $length, $search, $order_column, $order_dir);

        $data = [];
        $no = $start + 1;
        foreach ($pengadaan as $p) {
            $data[] = [
                'no' => $no++,
                'no_pengadaan' => htmlspecialchars($p['no_pengadaan']),
                'tanggal_pengadaan' => htmlspecialchars($p['tanggal_pengadaan']),
                'aset' => htmlspecialchars($p['nama_aset']),
                'jumlah' => (int)$p['jumlah'],
                'satuan' => htmlspecialchars($p['satuan']),
                'harga_satuan' => number_format($p['harga_satuan'], 2, ',', '.'),
                'total_harga' => number_format($p['total_harga'], 2, ',', '.'),
                'sumber_dana' => htmlspecialchars($p['sumber_dana']),
                'supplier' => htmlspecialchars($p['supplier']),
                'id' => $p['id'],
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
