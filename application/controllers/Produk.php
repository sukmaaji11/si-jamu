<?php
class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('datatables'); //load library ignited-dataTable
        $this->load->model('M_produk'); //load model crud_model
    }
    function index()
    {
        $data['kategori'] = $this->M_produk->get_kategori();
        $data['user'] = $this->db->get_where('si_user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('admin/templates/sb-header', $data);
        $this->load->view('admin/templates/sb-sidebar', $data);
        $this->load->view('admin/templates/sb-topbar', $data);
        $this->load->view('admin/produk', $data);
        $this->load->view('admin/templates/sb-footer');
    }

    function get_produk_json()
    { //data data produk by JSON object
        header('Content-Type: application/json');
        echo $this->M_produk->get_all_produk();
    }

    function simpan()
    { //function simpan data
        $data = array(
            'barang_kode'     => $this->input->post('kode_barang'),
            'barang_nama'     => $this->input->post('nama_barang'),
            'barang_harga'    => $this->input->post('harga'),
            'barang_kategori_id' => $this->input->post('kategori')
        );
        $this->db->insert('barang', $data);
        redirect('crud');
    }

    function update()
    { //function update data
        $kode = $this->input->post('kode_barang');
        $data = array(
            'barang_nama'     => $this->input->post('nama_barang'),
            'barang_harga'    => $this->input->post('harga'),
            'barang_kategori_id' => $this->input->post('kategori')
        );
        $this->db->where('barang_kode', $kode);
        $this->db->update('barang', $data);
        redirect('crud');
    }

    function delete()
    { //function hapus data
        $kode = $this->input->post('kode_barang');
        $this->db->where('barang_kode', $kode);
        $this->db->delete('barang');
        redirect('crud');
    }
}
