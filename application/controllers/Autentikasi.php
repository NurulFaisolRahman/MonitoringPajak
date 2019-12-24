<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autentikasi extends CI_Controller {

	public function index(){
		if($this->session->userdata('Status') == "Login"){
			redirect(base_url('Dashboard'));
		} else {
			$this->load->view('Autentikasi/SignIn');
		}
	}

	public function SignIn(){
	  	$Username = $_POST['Username'];
	  	$Password = $_POST['Password'];
		$CekLogin = $this->db->get_where('Akun', array('Username' => $Username));
		if($CekLogin->num_rows() == 0){
			echo "Username Salah";
	  	}
	  	else{
	  		$Akun = $CekLogin->result_array();
			if (password_verify($Password, $Akun[0]['Password'])) {
				$DataSession = array();
				$DataSession = array('Status' => "Login", 'Admin' => $Akun[0]['JenisAkun'], 'NamaAdmin' => $Akun[0]['Username']);
				$this->session->set_userdata($DataSession);
				$this->db->insert('Aktifitas',
							array('NamaUser' => $Akun[0]['Username'],
								 'Aktifitas' => 'Login',
								 'TanggalAkses' => date("d-m-Y H:i:s")));	
		  		echo $Akun[0]['JenisAkun'];
			} else {
				echo "Password Salah";
			}
		}
	}

	public function SignOut(){
		$this->db->insert('Aktifitas',
							array('NamaUser' => $this->session->userdata('NamaAdmin'),
								 'Aktifitas' => 'Log Out',
								 'TanggalAkses' => date("d-m-Y H:i:s")));	
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function AutentikasiWajibPajak(){
		$CekLogin = $this->db->get_where('WajibPajak', array('NPWPD' => $_POST['NPWPD']));
		if($CekLogin->num_rows() == 1){
			if ($CekLogin->result_array()[0]['Status'] != 'Disable') {
				if (password_verify($_POST['Password'], $CekLogin->result_array()[0]['Password'])) {
					$this->db->where('NPWPD', $_POST['NPWPD']);
					$this->db->update('WajibPajak', array('Status' => 'Online'));
					if ($CekLogin->result_array()[0]['Koneksi'] == '') {
						echo "ok";
					} else {
						echo $CekLogin->result_array()[0]['Koneksi'];
					}
				} else {
					echo "fail";
				}
			} else {
				echo "Disable";
			}
	  	}
		else{
			echo "ko";
		}
	}

	public function UpdateJenisData(){
		$this->db->where('NPWPD', $_POST['NPWPD']);
		$this->db->update('WajibPajak', array('Koneksi' => $_POST['JenisData']));
	}

	public function UpdateSinyal(){
		$this->db->where('NPWPD', $_POST['NPWPD']);
		$this->db->update('WajibPajak', array('Sinyal' => $_POST['Sinyal']));
	}

	public function InputTransaksiWajibPajak(){
		$inputJSON = file_get_contents('php://input');
		$Data = json_decode($inputJSON);
		foreach ($Data as $key => $value) {
			$JenisPajak = $this->db->get_where("WajibPajak", array('NPWPD' => $key))->result_array();
			foreach ($value as $Key => $Value) {
				$value[$Key] = (array) $Value;
				$value[$Key]['NPWPD'] = $key;
				$value[$Key]['JenisPajak'] = $JenisPajak[0]['JenisPajak'];
			}
			if ($this->db->get_where('Transaksi', array('NPWPD' => $key))->num_rows() === 0) {
				$this->db->update('WajibPajak', array('PengirimanPertama' => date("d-m-Y H:i:s")));
			}
			$this->db->insert_batch("Transaksi", $value);
			$this->db->where('NPWPD', $key);
			$this->db->update('WajibPajak', array('Riwayat' => date("Y-m-d H:i:s")));
			echo "ok";
		}
	}

	public function api(){
		$Data = Array("NomorTransaksi" => '3', 
					  "SubNominal" => '150796', 
					  "Service" => '0', 
					  "Diskon" => '0', 
					  "Pajak" => '15079', 
					  "TotalTransaksi" => '199615', 
					  "WaktuTransaksi" => '2019-12-15 15:07:00'); 		
		echo json_encode($Data);
	}
}
