<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asets_model extends CI_Model
{
    protected $table = 'm_aset';

    public function __construct()
    {
        parent::__construct();
    }

    public function count_all()
    {
        $this->db->where('deleted', 0);
        return $this->db->count_all_results($this->table);
    }

    public function count_filtered($search = null)
    {
        $this->db->from($this->table . ' a');
        $this->db->join('m_ruangan r', 'a.ruangan_id = r.id', 'left');
        $this->db->where('a.deleted', 0);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('a.kode_aset', $search);
            $this->db->or_like('a.nama_aset', $search);
            $this->db->or_like('a.kategori', $search);
            $this->db->or_like('a.merk', $search);
            $this->db->or_like('a.tipe', $search);
            $this->db->or_like('a.lokasi_fisik', $search);
            $this->db->or_like('r.nama_ruangan', $search); // ✅ disesuaikan
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }

    public function get_dt_all($start, $length, $search = null, $order_column = 'a.id', $order_dir = 'asc')
    {
        $this->db->select('a.*, r.nama_ruangan as ruangan_nama'); // ✅ disesuaikan
        $this->db->from($this->table . ' a');
        $this->db->join('m_ruangan r', 'a.ruangan_id = r.id', 'left');
        $this->db->where('a.deleted', 0);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('a.kode_aset', $search);
            $this->db->or_like('a.nama_aset', $search);
            $this->db->or_like('a.kategori', $search);
            $this->db->or_like('a.merk', $search);
            $this->db->or_like('a.tipe', $search);
            $this->db->or_like('a.lokasi_fisik', $search);
            $this->db->or_like('r.nama_ruangan', $search); // ✅ disesuaikan
            $this->db->group_end();
        }

        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }
}
