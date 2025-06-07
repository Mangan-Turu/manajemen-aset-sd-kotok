<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruangan_model extends CI_Model
{
    protected $table = 'm_ruangan';

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
            $this->db->like('kode_ruangan', $search);
            $this->db->or_like('nama_ruangan', $search);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }

    public function get_dt_all($start, $length, $search = null, $order_column = 'id', $order_dir = 'asc')
    {
        $this->db->from($this->table);
        $this->db->where('deleted', 0);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('kode_ruangan', $search);
            $this->db->or_like('nama_ruangan', $search);
            $this->db->group_end();
        }

        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }
}
