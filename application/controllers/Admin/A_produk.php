<?php
defined('BASEPATH') or exit('No direct script access allowed');

class A_produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_kategori');
        $this->load->model('m_produk');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('si_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['produk'] = $this->m_produk->get_produk();
        $data['kategori'] = $this->m_kategori->get_kategori();
        $data['kategori2'] = $this->m_kategori->get_kategori();
        $this->load->view('admin/templates/sb-header', $data);
        $this->load->view('admin/templates/sb-sidebar', $data);
        $this->load->view('admin/templates/sb-topbar', $data);
        $this->load->view('admin/admin_produk', $data);
        $this->load->view('admin/templates/sb-footer');
    }

    public function add()
    {
        if ($this->session->userdata('role_id') == 1) {
            $namaProduk = $this->input->post('namaProduk');
            $kat = $this->input->post('kategori');
            $harga = str_replace(',', '', $this->input->post('harga'));
            $hargaJual = str_replace(',', '', $this->input->post('hargaJual'));
            $this->m_produk->add_produk($namaProduk, $kat, $harga, $hargaJual);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk Berhasil Ditambahkan!</div>');
            redirect('admin/A_produk');
        }
    }

    public function delete()
    {
        if ($this->session->userdata('role_id') == 1) {
            $po_id = $this->input->post('kode_produk');
            $this->m_produk->delete_produk($po_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk Berhasil Di Hapus!</div>');
            redirect('admin/A_produk');
        }
    }

    public function edit()
    {
        if ($this->session->userdata('role_id') == 1) {
            $po_id = $this->input->post('kode_produk');
            $namaProduk = $this->input->post('namaProduk');
            $kat = $this->input->post('kategori');
            $harga = str_replace(',', '', $this->input->post('harga'));
            $hargaJual = str_replace(',', '', $this->input->post('hargaJual'));
            $this->m_produk->update_produk($po_id, $namaProduk, $kat, $harga, $hargaJual);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk Berhasil Di Update!</div>');
            redirect('admin/A_produk');
        }
    }
}
