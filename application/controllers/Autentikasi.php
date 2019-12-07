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
			$DataSession = array('Status' => "Login");
			$this->session->set_userdata($DataSession);
  		echo 'OK';
  	}
	}

	public function SignOut(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function AutentikasiWajibPajak(){
		$NPWPD = $_GET['NPWPD'];
		if ($NPWPD == "15") {
			echo json_encode(array("respon" => "sukses"));
		}
		else{
			echo json_encode(array("respon" => "gagal"));
		}
	}
}
