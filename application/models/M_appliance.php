<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_appliance extends CI_Model {
	public function select_all() {
		$data = $this->db->get('appliance');

		return $data->result();
	}

	public function select_by_id($appliance_id) {
		$sql = "SELECT * FROM appliance WHERE appliance_id = '{$appliance_id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_pegawai($id) {
		$sql = " SELECT pegawai.id AS id, pegawai.nama AS pegawai, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id_kota = kota.id AND pegawai.id_posisi={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
		$this->db->insert('appliance', $data);

		return $this->db->affected_rows();
	}

	function cek_exist_appliancename($appliance_name)
	{
		return $this->db->select('appliance_name')->where('appliance_name', $appliance_name)->limit(1)->get('appliance');
	}

	public function insert_batch($data) {
		$this->db->insert_batch('posisi', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE appliance SET appliance_name='" .$data['appliance_name'] ."', photo='" .$data['photo'] ."' WHERE appliance_id='" .$data['appliance_id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function updatetraining($device_id, $appliance_id) {
		$sql = "UPDATE appliance SET trainwith='NO' WHERE trainwith='" .$device_id."'";
		$this->db->query($sql);

		sleep(2);
		$sql = "UPDATE appliance SET trainwith='" .$device_id."' WHERE appliance_id='" .$appliance_id."'";
		$this->db->query($sql);

		return $this->db->affected_rows();
	}


	public function update_freq_watt($device_id, $appliance_id, $watt) {
		$sql = "UPDATE appliance SET watt='" .$watt ."' WHERE appliance_id='" .$appliance_id."'";
		$this->db->query($sql);

		sleep(2);

		$sql = "UPDATE appliance SET trainwith='NO' WHERE trainwith='" .$device_id."'";
		$this->db->query($sql);

		sleep(2);
		
		$sql = "DELETE FROM log_training WHERE appliance_id='" .$appliance_id ."' AND device_id='" .$device_id."'";
		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM posisi WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('posisi');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('appliance');

		return $data->num_rows();
	}
}

/* End of file M_posisi.php */
/* Location: ./application/models/M_posisi.php */