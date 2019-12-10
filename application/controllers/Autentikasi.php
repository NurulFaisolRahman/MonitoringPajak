<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentikasi extends CI_Controller {

	public function index(){
		$this->load->view('Autentikasi/SignIn');
	}

	public function SignIn(){
  	$Username = $_POST['Username'];
  	$Password = $_POST['Password'];
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
		$CekLogin = $this->db->select('*')    
                    ->from('WajibPajak')
                    ->where('NPWPD', $_POST['NPWPD'])
                    ->where('Status != ', 'Disable')
                    ->get();
		if($CekLogin->num_rows() == 1){
			$this->db->where('NPWPD', $_POST['NPWPD']);
			$this->db->update('WajibPajak', array('Status' => 'Online'));
			echo "ok";
	  	}
		else{
			echo "ko";
		}
	}

	public function InputTransaksiWajibPajak(){
		$inputJSON = file_get_contents('php://input');
		$Data = json_decode($inputJSON);
		foreach ($Data as $key => $value) {
			$Data[$key] = (array) $value;
		}
		$this->db->insert_batch("Transaksi", $Data);
		echo "ok";
	}
}
