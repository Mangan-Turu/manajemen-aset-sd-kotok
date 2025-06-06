<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
    protected $table_users = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->select('*');
        $this->db->from($this->table_users);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function store($data)
    {
        $this->db->insert($this->table_users, $data);
        return $this->db->affected_rows() > 0;
    }

    // Cek apakah email sudah ada di database
    public function check_email_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get($this->table_users);

        return $query->num_rows() > 0;
    }

    public function get_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function count_all()
    {
        return $this->db->count_all('users');
    }

    public function count_filtered($search)
    {
        if (!empty($search)) {
            $this->db->like('nama', $search);
            $this->db->or_like('username', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('role', $search);
        }

        return $this->db->count_all_results('users');
    }

    public function get_dt_all($start, $length, $search, $order_column, $order_dir)
    {
        if (!empty($search)) {
            $this->db->like('nama', $search);
            $this->db->or_like('username', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('role', $search);
        }

        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);
        return $this->db->get('users')->result_array();
    }
}
