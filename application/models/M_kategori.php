<?php
class M_kategori extends CI_Model
{
    function get_kategori()
    {
        return $this->db->query("SELECT * FROM si_kategori ORDER BY kategori_id ASC");
    }
    function delete_kategori($kat_id)
    {
        return $this->db->query("DELETE FROM si_kategori WHERE kategori_id='$kat_id'");
    }

    function update_kategori($kat_id, $kat)
    {
        return $this->db->query("UPDATE si_kategori SET kategori_nama='$kat' WHERE kategori_id='$kat_id'");
    }
    function add_kategori($kat)
    {
        return $this->db->query("INSERT INTO si_kategori(kategori_nama) VALUES ('$kat')");
    }
}
