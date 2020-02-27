<?php
class M_produk extends CI_Model
{
    function get_produk()
    {
        return $this->db->query("SELECT produk_id, si_produk.kategori_id, kategori_nama, produk_nama, produk_harga, produk_harga_jual, produk_stok FROM si_produk JOIN si_kategori ON si_produk.kategori_id = si_kategori.kategori_id");
    }

    function add_produk($namaProduk, $kat, $harga, $hargaJual)
    {
        return $this->db->query("INSERT INTO si_produk(kategori_id, produk_nama, produk_harga, produk_harga_jual) VALUES ('$kat', '$namaProduk', '$harga', '$hargaJual')");
    }
    function delete_produk($po_id)
    {
        return $this->db->query("DELETE FROM si_produk WHERE produk_id='$po_id'");
    }

    function update_produk($po_id, $namaProduk, $kat, $harga, $hargaJual)
    {
        return $this->db->query("UPDATE si_produk SET produk_nama='$namaProduk',kategori_id='$kat',produk_harga='$harga',produk_harga_jual='$hargaJual' WHERE produk_id='$po_id'");
    }

    function get_barang($kobar)
    {
        return $this->db->query("SELECT * FROM si_produk WHERE produk_id='$kobar'");
    }
}
