<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('Admin')){
			redirect(base_url());
		}
	}

	public function Log($Aktifitas){
		$this->db->insert('Aktifitas',
							array('NamaUser' => $this->session->userdata('NamaAdmin'),
								 'Aktifitas' => $Aktifitas,
								 'IP' => $_SERVER['REMOTE_ADDR']));
	}

	public function index(){
		// $this->Log('Akses Menu User');
		$Query = "SELECT * FROM ".'"Akun"'." WHERE ".'"JenisAkun" != '."'1' ORDER BY ".'"WaktuRegistrasi" DESC';
		$Data['DataUser'] = $this->db->query($Query)->result_array();
		$Data['title'] = "User";
		$Data['submenu'] = "";
		$this->load->view('Header',$Data);
		$this->load->view('User');
	}

	public function Tambah(){
		if ($this->db->get_where('Akun', array('Username' => $_POST['Username']))->num_rows() === 0) {
			$this->db->insert('Akun',
						array('Username' => $_POST['Username'],
							 'Password' => password_hash($_POST['Password'], PASSWORD_DEFAULT),
							 'JenisAkun' => '2',
							 'Pembuat' => $this->session->userdata('NamaAdmin')));	
			echo "ok";
			// $this->Log('Tambah Data User Dengan Username = '.$_POST['Username']);
		} else {
			echo "Username Sudah Ada";
		}
	}

	public function Edit(){
		if ($_POST['EditUsername'] != $_POST['EditUsernameLama']) {
			if ($_POST['EditJenisAkun'] == '2') {
				if ($this->db->get_where('Akun', array('Username' => $_POST['EditUsername']))->num_rows() === 0) {
					if (!empty($_POST['EditPassword'])) {
						$this->db->where('Username', $_POST['EditUsernameLama']);
						$this->db->update('Akun', array('Username' => $_POST['EditUsername'],
														'Password' => password_hash($_POST['EditPassword'], PASSWORD_DEFAULT)));
						echo "ok";
					} else {
						$this->db->where('Username', $_POST['EditUsernameLama']);
						$this->db->update('Akun', array('Username' => $_POST['EditUsername']));
						echo "ok";
					}
					$this->Log('Edit Data User Dengan Username = '.$_POST['EditUsername']);
				} else {
					echo "Username Sudah Ada";
				}
			} else {
				if($this->db->get_where('Akun', array('Username' => $_POST['EditUsername']))->num_rows() === 1){
					echo "Username Sudah Ada";
				} else if($this->db->get_where('WajibPajak', array('NPWPD' => $_POST['EditUsername']))->num_rows() === 0){
					echo "NPWPD Wajib Pajak Tidak Terdaftar";
				} else {
					if (!empty($_POST['EditPassword'])) {
						$this->db->where('Username', $_POST['EditUsernameLama']);
						$this->db->update('Akun', array('Username' => $_POST['EditUsername'],
														'Password' => password_hash($_POST['EditPassword'], PASSWORD_DEFAULT)));
						echo "ok";
					} else {
						$this->db->where('Username', $_POST['EditUsernameLama']);
						$this->db->update('Akun', array('Username' => $_POST['EditUsername']));
						echo "ok";
					}
					$this->Log('Edit Data User Dengan Username = '.$_POST['EditUsername']);
				}
			}
		} else {
			if (!empty($_POST['EditPassword'])) {
				$this->db->where('Username', $_POST['EditUsername']);
				$this->db->update('Akun', array('Password' => password_hash($_POST['EditPassword'], PASSWORD_DEFAULT)));
				echo "ok";
				$this->Log('Edit Data User Dengan Username = '.$_POST['EditUsername']);
			} else {
				echo "ok";
			}
		}
	}

	public function Hapus(){
		$this->db->delete('Akun', array('Username' => $_POST['Username']));
		echo "ok";
		$this->Log('Hapus Data User Dengan Username = '.$_POST['Username']);
	}
}
