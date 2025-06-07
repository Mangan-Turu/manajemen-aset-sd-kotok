<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengadaan_model extends CI_Model
{
    protected $table = 'm_pengadaan';

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
        $this->db->from($this->table);
        $this->db->where('deleted', 0);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('no_pengadaan', $search);
            $this->db->or_like('sumber_dana', $search);
            $this->db->or_like('supplier', $search);
            $this->db->or_like('keterangan', $search);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }

    public function get_dt_all($start, $length, $search = null, $order_column = 'id', $order_dir = 'asc')
    {
        $this->db->select('p.*, a.nama_aset');
        $this->db->from($this->table . ' p');
        $this->db->join('m_aset a', 'p.aset_id = a.id', 'left');
        $this->db->where('p.deleted', 0);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('p.no_pengadaan', $search);
            $this->db->or_like('p.sumber_dana', $search);
            $this->db->or_like('p.supplier', $search);
            $this->db->or_like('p.keterangan', $search);
            $this->db->or_like('a.nama_aset', $search);
            $this->db->group_end();
        }

        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_suppliers()
    {
        $this->db->distinct();
        $this->db->select('supplier');
        $this->db->from('m_pengadaan');
        $query = $this->db->get();
        return $query->result_array();
    }
}
