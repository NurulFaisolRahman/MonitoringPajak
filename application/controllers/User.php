<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Admin')){
			redirect(base_url());
		}
	}

	public function index(){
		$Data['DataUser'] = $this->db->get_where('Akun', array('JenisAkun' => '2'))->result_array();
		$Data['title'] = "User";
		$Data['submenu'] = "";
		$this->load->view('Header',$Data);
		$this->load->view('User');
	}

	public function Tambah(){
		$this->db->insert('Akun',
									array('Username' => $_POST['Username'],
												 'Password' => $_POST['Password'],
												 'JenisAkun' => '2'));
		redirect(base_url('User'));
	}

	public function Edit(){
		$this->db->where('Username', $_POST['EditUsername']);
		$this->db->update('Akun', array('Password' => $_POST['EditPassword']));
		redirect(base_url('User'));
	}

	public function Hapus(){
		$this->db->delete('Akun', array('Username' => $_POST['Username']));
		echo "ok";
	}
}
