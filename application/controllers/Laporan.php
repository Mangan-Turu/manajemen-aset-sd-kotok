<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MY_Controller
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
        $this->load->model('Laporan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Laporan Rekapitulasi Aset';

        $data['contents'] = $this->load->view('laporan_view', $data, true);
        $this->load->view('templates/admin_templates', $data);
    }

    public function get_laporan()
    {
        $request = $_POST;
        $columns = [
            'id',
            'kode_aset',
            'nama_aset',
            'kategori',
            'merk',
            'tipe',
            'jumlah',
            'satuan',
            'harga_satuan',
            'total_nilai_aset',
            'tahun_perolehan',
            'sumber_dana',
            'status',
            'pemilik',
            'keterangan',
            'nama_ruangan',
            'jenis_ruangan',
            'terakhir_pengadaan',
            'total_mutasi',
            'total_kerusakan',
            'total_biaya_pemeliharaan'
        ];

        $start = $request['start'];
        $length = $request['length'];
        $search = $request['search']['value'];
        $order_column = $columns[$request['order'][0]['column']];
        $order_dir = $request['order'][0]['dir'];
        $status = isset($request['status']) ? $request['status'] : null;

        $totalData = $this->Laporan_model->count_all($status);
        $totalFiltered = $this->Laporan_model->count_filtered($search, $status);
        $laporan = $this->Laporan_model->get_dt_all($start, $length, $search, $order_column, $order_dir, $status);

        $data = [];
        $no = $start + 1;
        foreach ($laporan as $s) {
            $data[] = [
                'no' => $no++,
                'id' => $s['id'],
                'kode_aset' => $s['kode_aset'],
                'nama_aset' => $s['nama_aset'],
                'kategori' => $s['kategori'],
                'merk' => $s['merk'],
                'tipe' => $s['tipe'],
                'jumlah' => $s['jumlah'],
                'satuan' => $s['satuan'],
                'pemilik' => $s['pemilik'] ?? '-',
                'harga_satuan' => $s['harga_satuan'],
                'total_nilai_aset' => number_format($s['total_nilai_aset'], 2, ',', '.'),
                'tahun_perolehan' => $s['tahun_perolehan'],
                'sumber_dana' => $s['sumber_dana'],
                'status' => $s['status'],
                'keterangan' => $s['keterangan'],
                'nama_ruangan' => $s['nama_ruangan'],
                'jenis_ruangan' => $s['jenis_ruangan'],
                'terakhir_pengadaan' => $s['terakhir_pengadaan'],
                'total_mutasi' => $s['total_mutasi'],
                'total_kerusakan' => $s['total_kerusakan'],
                'total_biaya_pemeliharaan' => number_format($s['total_biaya_pemeliharaan'], 2, ',', '.'),
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
