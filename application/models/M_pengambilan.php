<?php
class M_pengambilan extends CI_Model
{
    function get_pengambilan()
    {
        return $this->db->query("SELECT * FROM si_pengambilan JOIN si_pengambilan_detail ON si_pengambilan.pengambilan_id = si_pengambilan_detail.pd_pengambilan_id");
    }

    function add_pemngambilan($faktur, $tgl_pengambilan)
    {
        $this->db->query("INSERT INTO si_pengambilan(pengambilan_id, pengambilan_tgl, pengambilan_status) VALUES ('$faktur', '$tgl_pengambilan', 'BLM_LUNAS')");
        foreach ($this->cart->contents() as $item) {
            $data = array(
                'pd_produk_id' => $item['id_prod'],
                'pd_harga' => $item['harga'],
                'pd_jumlah' => $item['qty'],
                'pd_total' => $item['subtotal']
            );
            $this->db->insert('si_pengamnbilan_detail', $data);
            $this->db->query("UPDATE si_produk SET produk_stok=produk_stok + '$item[qty] WHERE produk_id='$item[id_prod]'");
        }
        return true;
    }
}
