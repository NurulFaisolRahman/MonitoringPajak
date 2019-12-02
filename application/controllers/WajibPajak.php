<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WajibPajak extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('Status') != "Login"){
			redirect(base_url());
		}
	}

	public function index(){
		$Data['title'] = "Daftar WP";
		$Data['submenu'] = "";
		$this->load->view('Header',$Data);
		$this->load->view('WajibPajak');
	}
}
