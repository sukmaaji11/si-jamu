<?php
class M_auth extends CI_Model
{
    function cek($username)
    {
        $this->db->get_where('si_user', ['username' => $username]);
    }
}
