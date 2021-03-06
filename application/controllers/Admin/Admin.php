<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function index()
    {
        $data['user'] = $this->db->get_where('si_user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('admin/templates/sb-header', $data);
        $this->load->view('admin/templates/sb-sidebar', $data);
        $this->load->view('admin/templates/sb-topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('admin/templates/sb-footer');
    }
}
