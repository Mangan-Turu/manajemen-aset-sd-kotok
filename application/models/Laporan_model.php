<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    protected $table = 'm_aset';

    public function __construct()
    {
        parent::__construct();
    }

    public function count_all($status = null)
    {
        $this->db->from($this->table . ' a');
        $this->db->where('a.deleted', 0);

        if ($status !== null && $status !== '') {
            $this->db->where('a.status', $status);
        }

        return $this->db->count_all_results();
    }


    public function count_filtered($search = null, $status = null)
    {
        $this->db->from($this->table . ' a');
        $this->db->join('m_ruangan r', 'a.ruangan_id = r.id', 'left');
        $this->db->where('a.deleted', 0);

        if ($status !== null && $status !== '') {
            $this->db->where('a.status', $status);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('a.kode_aset', $search);
            $this->db->or_like('a.nama_aset', $search);
            $this->db->or_like('a.kategori', $search);
            $this->db->or_like('a.merk', $search);
            $this->db->or_like('a.tipe', $search);
            $this->db->or_like('r.nama_ruangan', $search);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }

    public function get_dt_all($start, $length, $search = null, $order_column = 'a.id', $order_dir = 'asc', $status = null)
    {
        $this->db->select('
            a.id,
            a.kode_aset,
            a.nama_aset,
            a.kategori,
            a.merk,
            a.tipe,
            a.jumlah,
            a.satuan,
            a.pemilik,
            a.harga_satuan,
            (a.jumlah * a.harga_satuan) AS total_nilai_aset,
            a.tahun_perolehan,
            a.sumber_dana,
            a.status,
            a.keterangan,
            r.nama_ruangan,
            r.jenis_ruangan,

            -- Subquery untuk pengadaan terakhir
            (
                SELECT MAX(p.tanggal_pengadaan)
                FROM m_pengadaan p 
                WHERE p.aset_id = a.id AND p.deleted = 0
            ) AS terakhir_pengadaan,

            -- Subquery total mutasi
            (
                SELECT COUNT(*) 
                FROM m_mutasi m 
                WHERE m.aset_id = a.id AND m.deleted = 0
            ) AS total_mutasi,

            -- Subquery total kerusakan
            (
                SELECT SUM(k.jumlah)
                FROM t_aset_kerusakan k 
                WHERE k.aset_id = a.id AND k.deleted = 0
            ) AS total_kerusakan,

            -- Subquery total biaya pemeliharaan
            (
                SELECT SUM(p.biaya)
                FROM t_aset_pemeliharaan p 
                WHERE p.aset_id = a.id AND p.deleted = 0
            ) AS total_biaya_pemeliharaan
        ');

        $this->db->from($this->table . ' a');
        $this->db->join('m_ruangan r', 'a.ruangan_id = r.id', 'left');
        $this->db->where('a.deleted', 0);

        if ($status !== null && $status !== '') {
            $this->db->where('a.status', $status);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('a.kode_aset', $search);
            $this->db->or_like('a.nama_aset', $search);
            $this->db->or_like('a.kategori', $search);
            $this->db->or_like('a.merk', $search);
            $this->db->or_like('a.tipe', $search);
            $this->db->or_like('r.nama_ruangan', $search);
            $this->db->group_end();
        }

        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }

    public function get_kategori()
    {
        $this->db->distinct();
        $this->db->select('kategori');
        $this->db->from($this->table);
        $this->db->where('deleted', 0);
        $this->db->order_by('kategori', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }
}
