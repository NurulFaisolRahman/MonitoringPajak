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
		$this->Log('Akses Menu User');
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
			$this->Log('Tambah Data User Dengan Username = '.$_POST['Username']);
		} else {
			echo "Username Sudah Ada";
		}
	}

	public function TambahWP(){
		if ($this->db->get_where('Akun', array('Username' => $_POST['UsernameWP']))->num_rows() === 0) {
			$Pemilik = array();
			foreach ($_POST['DataWP'] as $key => $value) {
				array_push($Pemilik, array('NPWPD' => $value, 'Pemilik' => $_POST['UsernameWP']));
			}
			$this->db->insert('Akun',
						array('Username' => $_POST['UsernameWP'],
							 'Password' => password_hash($_POST['PasswordWP'], PASSWORD_DEFAULT),
							 'JenisAkun' => '3',
							 'Pembuat' => $this->session->userdata('NamaAdmin')));	
			$this->db->update_batch('WajibPajak', $Pemilik, 'NPWPD');
			echo "ok";
			$this->Log('Tambah Data User WP Dengan Username = '.$_POST['UsernameWP']);
		} else {
			echo "Username Sudah Ada";
		}
	}

	public function Edit(){
		if ($_POST['EditUsername'] != $_POST['EditUsernameLama']) {
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

	public function EditWP(){
		$EditPemilik = array();
		foreach ($_POST['EditDataWP'] as $key => $value) {
			array_push($EditPemilik, array('NPWPD' => $value, 'Pemilik' => $_POST['EditUsernameWP']));
		}
		if ($_POST['EditUsernameWP'] != $_POST['EditUsernameWPLama']) {
			if ($this->db->get_where('Akun', array('Username' => $_POST['EditUsernameWP']))->num_rows() === 0) {
				if (!empty($_POST['EditPasswordWP'])) {
					$this->db->where('Username', $_POST['EditUsernameWPLama']);
					$this->db->update('Akun', array('Username' => $_POST['EditUsernameWP'],
													'Password' => password_hash($_POST['EditPasswordWP'], PASSWORD_DEFAULT)));
					$Query = 'UPDATE "WajibPajak" SET '.'"Pemilik" = NULL WHERE "Pemilik" = '."'".$_POST['EditUsernameWP']."'";
					$this->db->query($Query);
					$this->db->update_batch('WajibPajak', $EditPemilik, 'NPWPD');
					echo "ok";
				} else {
					$this->db->where('Username', $_POST['EditUsernameWPLama']);
					$this->db->update('Akun', array('Username' => $_POST['EditUsernameWP']));
					$Query = 'UPDATE "WajibPajak" SET '.'"Pemilik" = NULL WHERE "Pemilik" = '."'".$_POST['EditUsernameWP']."'";
					$this->db->query($Query);
					$this->db->update_batch('WajibPajak', $EditPemilik, 'NPWPD');
					echo "ok";
				}
				$this->Log('Edit Data User Dengan Username = '.$_POST['EditUsernameWP']);
			} else {
				echo "Username Sudah Ada";
			}
		} else {
			if (!empty($_POST['EditPasswordWP'])) {
				$this->db->where('Username', $_POST['EditUsernameWP']);
				$this->db->update('Akun', array('Password' => password_hash($_POST['EditPasswordWP'], PASSWORD_DEFAULT)));
				$Query = 'UPDATE "WajibPajak" SET '.'"Pemilik" = NULL WHERE "Pemilik" = '."'".$_POST['EditUsernameWP']."'";
				$this->db->query($Query);
				$this->db->update_batch('WajibPajak', $EditPemilik, 'NPWPD');
				echo "ok";
				$this->Log('Edit Data User Dengan Username = '.$_POST['EditUsernameWP']);
			} else {
				$Query = 'UPDATE "WajibPajak" SET '.'"Pemilik" = NULL WHERE "Pemilik" = '."'".$_POST['EditUsernameWP']."'";
				$this->db->query($Query);
				$this->db->update_batch('WajibPajak', $EditPemilik, 'NPWPD');
				echo "ok";
			}
		}
	}

	public function DaftarWP(){
		$Query = 'SELECT DISTINCT "Pemilik"'.' FROM "WajibPajak"';
		$Pemilik = $this->db->query($Query)->result_array();
		echo json_encode($Pemilik);
	}

	public function Hapus(){
		if ($this->db->get_where('WajibPajak', array('Pemilik' => $_POST['Username']))->num_rows() === 0) {
			$this->db->delete('Akun', array('Username' => $_POST['Username']));
			echo "ok";
			$this->Log('Hapus Data User Dengan Username = '.$_POST['Username']);
		} else {
			echo "Username Digunakan Pada Tabel Wajib Pajak!";
		}
	}
}
