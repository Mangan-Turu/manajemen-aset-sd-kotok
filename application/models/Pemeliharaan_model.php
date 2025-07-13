<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemeliharaan_model extends CI_Model
{
    protected $table = 't_aset_pemeliharaan';
    protected $table_aset = 'm_aset';

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
        $this->db->where($this->table . '.deleted', 0);
    
        $this->db->join($this->table_aset, $this->table . '.aset_id = ' . $this->table_aset . '.id', 'left');
    
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like($this->table_aset . '.nama_aset', $search);
            $this->db->group_end();
        }
    
        return $this->db->count_all_results();
    }
    

    public function get_dt_all($start, $length, $search = null, $order_column = 'id', $order_dir = 'asc')
    {
        $this->db->select([
            $this->table . '.*',
            $this->table_aset . '.nama_aset AS nama_aset',
            $this->table_aset . '.pemilik',
            $this->table_aset . '.satuan',
        ]);
        
        $this->db->from($this->table);
        $this->db->where($this->table . '.deleted', 0);
    
        $this->db->join($this->table_aset, $this->table . '.aset_id = ' . $this->table_aset . '.id', 'left');
    
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like($this->table_aset . '.nama_aset', $search);
            $this->db->group_end();
        }
    
        $this->db->order_by($this->table . '.' . $order_column, $order_dir);
        $this->db->limit($length, $start);
    
        return $this->db->get()->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('t_aset_pemeliharaan', ['id' => $id])->row();
    }    
    
}
