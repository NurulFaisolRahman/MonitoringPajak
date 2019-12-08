<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentikasi extends CI_Controller {

	public function index(){
		$this->load->view('Autentikasi/SignIn');
	}

	public function SignIn(){
  	$Username = $_POST['Username'];
  	$Password = $_POST['Password'];
	$this->load->database();
	$CekLogin = $this->db->get_where('Akun', array('Username' => $Username,'Password' => $Password));
	if($CekLogin->num_rows() == 0){
		echo "Username / Password Salah";
  	}
  	else{
			foreach ($CekLogin->result_array() as $key) {
				$DataSession = array();
				if ($key['JenisAkun'] == 1) {
					$DataSession = array('Status' => "Login", 'Admin' => true);
					$this->session->set_userdata($DataSession);
		  		echo 'OK';
				} else {
					$DataSession = array('Status' => "Login", 'Admin' => false);
					$this->session->set_userdata($DataSession);
					echo 'OK';
				}
			}
  	}
	}

	public function SignOut(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function AutentikasiWajibPajak(){
		$this->load->database();
		$CekLogin = $this->db->get_where('WajibPajak', array('NPWPD' => $_POST['NPWPD']));
		if($CekLogin->num_rows() == 1){
			echo json_encode(array("respon" => "sukses"));
	  	}
		else{
			echo json_encode(array("respon" => "gagal"));
		}
	}
}
