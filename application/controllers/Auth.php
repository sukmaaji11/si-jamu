<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('si_user', ['role_id' => $this->session->userdata('role_id')])->row_array();
		if (($this->session->userdata('role_id')) == 1) {
			redirect('admin/admin');
		} else if (($this->session->userdata('role_id')) == 2) {
			redirect('user/user');
		} else {
			$this->form_validation->set_rules('username', 'Username', 'required|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|trim');

			if ($this->form_validation->run() == false) {
				$this->load->view('templates/auth_header');
				$this->load->view('auth/auth');
				$this->load->view('templates/auth_footer');
			} else {
				$this->_login();
			}
		}
	}

	private function _login()
	{

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->db->get_where('si_user', ['username' => $username])->row_array();

		if ($user) {
			//user ada
			if (password_verify($password, $user['user_password'])) {
				$data = [
					'username' => $user['username'],
					'role_id' => $user['role_id']
				];
				$this->session->set_userdata($data);
				if ($user['role_id'] == 1) {
					redirect('admin/admin');
				} else {
					redirect('user/user');
				}
				redirect('user');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">password salah! coba lagi</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">username tidak ditemukan!</div>');
			redirect('auth');
		}
	}

	public function registration()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[repeat-password]', [
			'matches' => "Password don't match!",
			'min_length' => "Password too short!"
		]);
		$this->form_validation->set_rules('repeat-password', 'Repeat-Password', 'required|trim|min_length[3]|matches[password]');
		if ($this->form_validation->run() == false) {
			$this->load->view('auth/registration');
		} else {
			$data = [
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'image' => 'default.png',
				'user_password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => 2
			];

			$this->db->insert('si_user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please Login..</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		//$this->session->unset_userdata('username');
		//$this->session->unset_userdata('role_id');
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out</div>');
		redirect('auth');
	}
}
