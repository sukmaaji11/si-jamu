<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['user'] = $this->db->get_where('si_user', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->view('user/templates/sb-header', $data);
		//$this->load->view('user/templates/sb-sidebar', $data);
		$this->load->view('user/templates/sb-topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('user/templates/sb-footer');
	}
}
