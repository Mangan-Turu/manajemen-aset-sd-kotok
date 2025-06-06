<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option extends CI_Controller
{
    protected $table_def_aset = 'm_aset';
    protected $table_def_ruangan = 'm_ruangan';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Option_model');
    }

    public function get_aset()
    {
        $data = $this->Option_model->get_all($this->table_def_aset, ['id', 'nama_aset']);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function get_ruangan()
    {
        $data = $this->Option_model->get_all($this->table_def_ruangan, ['id', 'nama_ruangan']);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
