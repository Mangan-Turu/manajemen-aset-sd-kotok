<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mutasi_model extends CI_Model
{
    protected $table = 'm_mutasi';
    protected $table_ruangan = 'm_ruangan';
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
        $this->db->join($this->table_ruangan . ' AS r1', $this->table . '.dari_ruangan_id = r1.id', 'left');
        $this->db->join($this->table_ruangan . ' AS r2', $this->table . '.ke_ruangan_id = r2.id', 'left');
    
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like($this->table_aset . '.nama_aset', $search);
            $this->db->or_like('r1.nama_ruangan', $search);
            $this->db->or_like('r2.nama_ruangan', $search);
            $this->db->group_end();
        }
    
        return $this->db->count_all_results();
    }
    

    public function get_dt_all($start, $length, $search = null, $order_column = 'id', $order_dir = 'asc')
    {
        $this->db->select([
            $this->table . '.*',
            $this->table_aset . '.nama_aset AS nama_aset',
            $this->table_aset . '.satuan',
            'r1.nama_ruangan AS dari_ruangan',
            'r2.nama_ruangan AS ke_ruangan'
        ]);
        
        $this->db->from($this->table);
        $this->db->where($this->table . '.deleted', 0);
    
        $this->db->join($this->table_aset, $this->table . '.aset_id = ' . $this->table_aset . '.id', 'left');
        $this->db->join($this->table_ruangan . ' AS r1', $this->table . '.dari_ruangan_id = r1.id', 'left');
        $this->db->join($this->table_ruangan . ' AS r2', $this->table . '.ke_ruangan_id = r2.id', 'left');
    
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like($this->table_aset . '.nama_aset', $search);
            $this->db->or_like('r1.nama_ruangan', $search);
            $this->db->or_like('r2.nama_ruangan', $search);
            $this->db->group_end();
        }
    
        $this->db->order_by($this->table . '.' . $order_column, $order_dir);
        $this->db->limit($length, $start);
    
        return $this->db->get()->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('m_mutasi', ['id' => $id])->row();
    }    
    
}
