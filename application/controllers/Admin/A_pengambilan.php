<?php
defined('BASEPATH') or exit('No direct script access allowed');

class A_pengambilan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('m_kategori');
        $this->load->model('m_produk');
        $this->load->model('m_pengambilan');
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('si_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['produk'] = $this->m_produk->get_produk();
        $data['kategori'] = $this->m_kategori->get_kategori();
        $data['pengambilan'] = $this->m_pengambilan->get_pengambilan();
        $this->load->view('admin/templates/sb-header', $data);
        $this->load->view('admin/templates/sb-sidebar', $data);
        $this->load->view('admin/templates/sb-topbar', $data);
        $this->load->view('admin/admin_pengambilan', $data);
        $this->load->view('admin/templates/sb-footer');
    }
    public function get_barang()
    {
        $kobar = $this->input->post('kode_brg');
        $data['barang'] = $this->m_produk->get_barang($kobar);
        $this->load->view('admin/admin_detail_produk', $data);
    }
    public function add_pengambilan_cart()
    {
        $data['user'] = $this->db->get_where('si_user', ['username' => $this->session->userdata('username')])->row_array();
        $faktur = $this->input->post('faktur');
        $tgl = $this->input->post('tgl');
        $this->session->set_userdata('faktur', $faktur);
        $this->session->set_userdata('tgl', $tgl);
        $kobar = $this->input->post('kode_brg');
        $barang = $this->m_produk->get_barang($kobar);
        $i = $barang->row_array();
        $data = array(
            'id' => $this->input->post('kode_brg'),
            'nama' => $this->input->post('nama'),
            'harga' => $this->input->post('harga'),
            'qty' => $this->input->post('qty')
        );
        $this->cart->insert($data);
        redirect('admin/A_pengambilan');
    }
    public function remove()
    {
        $data['user'] = $this->db->get_where('si_user', ['username' => $this->session->userdata('username')])->row_array();
        $row_id = $this->uri->segment(4);
        $this->cart->update(array(
            'rowid'      => $row_id,
            'qty'     => 0
        ));
        redirect('admin/A_pengambilan');
    }
}
