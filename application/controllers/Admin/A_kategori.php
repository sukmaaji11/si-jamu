<?php
defined('BASEPATH') or exit('No direct script access allowed');

class A_kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_kategori');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('si_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['kategori'] = $this->m_kategori->get_kategori();
        $this->load->view('admin/templates/sb-header', $data);
        $this->load->view('admin/templates/sb-sidebar', $data);
        $this->load->view('admin/templates/sb-topbar', $data);
        $this->load->view('admin/admin_kategori', $data);
        $this->load->view('admin/templates/sb-footer');
    }

    public function add()
    {
        if ($this->session->userdata('role_id') == 1) {
            $kat = $this->input->post('kategori');
            $this->m_kategori->add_kategori($kat);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori Berhasil Ditambahkan!</div>');
            redirect('admin/A_kategori');
        }
    }

    public function delete()
    {
        if ($this->session->userdata('role_id') == 1) {
            $kat_id = $this->input->post('id_kategori');
            $this->m_kategori->delete_kategori($kat_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori Berhasil Di Hapus!</div>');
            redirect('admin/A_kategori');
        }
    }

    public function edit()
    {
        if ($this->session->userdata('role_id') == 1) {
            $kat_id = $this->input->post('id_kategori');
            $kat = $this->input->post('kategori');
            $this->m_kategori->update_kategori($kat_id, $kat);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori Berhasil Di Update!</div>');
            redirect('admin/A_kategori');
        }
    }
}
