<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $for_role = null;

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
        }
    }
}
