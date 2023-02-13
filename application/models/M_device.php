<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_device extends CI_Model {
	public function select_all() {
		$sql = "SELECT * FROM device";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_deviceappliance_all() {
		$sql = " SELECT device.device_id, device.device_name, device.appliance_id, device.kwh_max, device.created, device.updated, appliance.appliance_id, appliance.appliance_name FROM device, appliance WHERE device.appliance_id = appliance.appliance_id";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$this->db->where('device_id', $id);
		$data = $this->db->get('device');

		return $data->row();
	}

	public function select_appliancedevice_by_id($device_id) {
		$sql = "SELECT device.device_name, device.kwh_max, appliance.appliance_name, appliancedevice.appliancedevice_id, appliancedevice.device_id, appliancedevice.appliance_id, appliancedevice.max_kwh, appliancedevice.created, appliancedevice.updated, appliancedevice.last_active, appliancedevice.status FROM device, appliance, appliancedevice WHERE device.device_id = appliancedevice.device_id AND appliance.appliance_id = appliancedevice.appliance_id AND appliancedevice.device_id = '{$device_id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_appliancedevice_by_id_row($id) {
		$sql = "SELECT device.device_name, device.kwh_max, appliance.appliance_name, appliancedevice.appliancedevice_id, appliancedevice.device_id, appliancedevice.appliance_id, appliancedevice.max_kwh, appliancedevice.created, appliancedevice.updated, appliancedevice.last_active, appliancedevice.status FROM device, appliance, appliancedevice WHERE device.device_id = appliancedevice.device_id AND appliance.appliance_id = appliancedevice.appliance_id AND appliancedevice.appliancedevice_id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_detail_by_id($device_id) {
		$sql = "SELECT device.device_id, device.device_name, device.kwh_max, device.updated, kwh_transaction.kwh_trans_id, kwh_transaction.watt, kwh_transaction.ampere, kwh_transaction.volt, kwh_transaction.wh, kwh_transaction.created FROM device, kwh_transaction WHERE device.device_id = kwh_transaction.device_id  AND kwh_transaction.device_id = '{$device_id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_thismonthusage($device_id) {
		$sql = "SELECT * FROM tb_usage WHERE device_id = '$device_id' AND MONTH(usage_date) = MONTH(Now())";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_detail_all() {
		$sql = "SELECT device.device_id, device.device_name, device.kwh_max, device.updated, appliance.appliance_id, appliance.appliance_name, kwh_transaction.kwh_trans_id, kwh_transaction.watt, kwh_transaction.ampere, kwh_transaction.volt, kwh_transaction.wh, kwh_transaction.created FROM device, appliance, kwh_transaction WHERE device.device_id = kwh_transaction.device_id AND appliance.appliance_id = kwh_transaction.appliance_id AND MONTH(kwh_transaction.created) = MONTH(Now());";

		$data = $this->db->query($sql);

		return $data->result();
	}


	public function select_detail_training_by_id($device_id, $appliance_id) {
		$sql = "SELECT device.device_id, device.device_name, device.kwh_max, device.updated, appliance.appliance_id, appliance.appliance_name, log_training.id_training, log_training.freq_watt, log_training.created FROM device, appliance, log_training WHERE device.device_id = log_training.device_id AND appliance.appliance_id = log_training.appliance_id AND log_training.appliance_id = '{$appliance_id}' AND log_training.device_id = '{$device_id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_period_by_id($device_id) {
		$sql = "SELECT * FROM period WHERE device_id = '$device_id' AND DAY(first_time) = DAY(Now())";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_period_by_date($device_id, $tanggal_dari, $tanggal_sampai) {
		$sql = "SELECT * FROM period WHERE device_id = '$device_id' AND DATE(first_time) >= '$tanggal_dari' AND DATE(first_time) <= '$tanggal_sampai'";
		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_today_period($device_id) {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE device_id = '$device_id' AND DAY(first_time) = DAY(Now())";

		$data = $this->db->query($sql);

		return $data->result();
	}


	public function select_today_period_all() {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE DAY(first_time) = DAY(Now())";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_thisweek_period($device_id) {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE device_id = '$device_id' AND WEEK(first_time) = WEEK(Now())";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_thisweek_period_all() {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE WEEK(first_time) = WEEK(Now())";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_thismonth_period($device_id) {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE device_id = '$device_id' AND MONTH(first_time) = MONTH(Now())";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_thismonth_period_all() {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE MONTH(first_time) = MONTH(Now())";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_yesterday_period($device_id) {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE device_id = '$device_id' AND DAY(first_time) = DAY(Now())-1";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_yesterday_period_all() {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE DAY(first_time) = DAY(Now())-1";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_lastweek_period($device_id) {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE device_id = '$device_id' AND WEEK(first_time) = WEEK(Now())-1";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_lastweek_period_all() {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE WEEK(first_time) = WEEK(Now())-1";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_lastmonth_period($device_id) {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE device_id = '$device_id' AND MONTH(first_time) = MONTH(Now())-1";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_lastmonth_period_all() {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE MONTH(first_time) = MONTH(Now())-1";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_total_period_by_id($device_id, $tanggal_dari, $tanggal_sampai) {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE device_id = '$device_id' AND DATE(first_time) >= '$tanggal_dari' AND DATE(first_time) <= '$tanggal_sampai'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_detail_deviceappiance_by_id($device_id, $appliance_id) {
		$sql = "SELECT device.device_id, device.device_name, device.appliance_id, device.kwh_max, device.updated, appliance.appliance_id, appliance.appliance_name, kwh_transaction.kwh_trans_id, kwh_transaction.watt, kwh_transaction.ampere, kwh_transaction.volt, kwh_transaction.created FROM device, appliance, kwh_transaction WHERE device.device_id = kwh_transaction.device_id AND appliance.appliance_id = kwh_transaction.appliance_id AND kwh_transaction.appliance_id = '{$appliance_id}' AND kwh_transaction.device_id = '{$device_id}'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_posisi($appliance_id) {
		$sql = "SELECT COUNT(*) AS jml FROM appliance WHERE appliance_id = {$appliance_id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_kota($id) {
		$sql = "SELECT COUNT(*) AS jml FROM pegawai WHERE id_kota = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data) {

		$this->db->where('device_id', $data['device_id']);
        $this->db->update('device', $data);

		return $this->db->affected_rows();
	}

	public function updatemaxkwh($data) {

		$this->db->where('appliancedevice_id', $data['appliancedevice_id']);
	    $this->db->update('appliancedevice', $data);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM device WHERE device_id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function deleteappliancedevice($id) {
		$sql = "DELETE FROM appliancedevice WHERE appliancedevice_id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	function get_deviceid_connection($id) 
	{
		return $this->db
					->where('appliancedevice_id', $id)
					->limit(1)
					->get('appliancedevice');
	}


	public function select_connection_by_id($id) {
		$this->db->where('appliancedevice_id', $id);
		$data = $this->db->get('appliancedevice');

		return $data->row();
	}

	public function get_switchon($device_id) 
	{
		return $this->db
					->where('device_id', $device_id)
					->where('status', "ON")
					->limit(1)
					->get('appliancedevice');
	}


	public function updateappliancedevice($id, $status, $appliancedevice_id) {
		if ($appliancedevice_id != 0) {
			$this->db->query("UPDATE appliancedevice SET status='OFF' WHERE appliancedevice_id='" .$appliancedevice_id."'");
		}
		sleep(2);
		$sql = "UPDATE appliancedevice SET status='" .$status ."' WHERE appliancedevice_id='" .$id."'";
		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function get_appliancedevice_data($device_id, $appliance_id) {
		$this->db->where('device_id', $device_id);
		$this->db->where('appliance_id', $appliance_id);
		$data = $this->db->get('appliancedevice');

		return $data->row();
	}

	public function insert($data) {
		$this->db->insert('device', $data);

		return $this->db->affected_rows();
	}

	public function insertConnection($data) {
		$this->db->insert('appliancedevice', $data);

		return $this->db->affected_rows();
	}

	function cek_exist_deviceid($device_id)
	{
		return $this->db->select('device_id')->where('device_id', $device_id)->limit(1)->get('device');
	}

	function cek_exist_devicename($device_name)
	{
		return $this->db->select('device_name')->where('device_name', $device_name)->limit(1)->get('device');
	}

	function cek_exist_connection($device_id, $appliance_id)
	{
		return $this->db->select('device_id')
						->select('appliance_id')
						->where('device_id', $device_id)
						->where('appliance_id', $appliance_id)
						->limit(1)
						->get('appliancedevice');
	}

	public function insert_batch($data) {
		$this->db->insert_batch('pegawai', $data);
		
		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama', $nama);
		$data = $this->db->get('pegawai');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('device');

		return $data->num_rows();
	}


	function deletechart($device_id)
	{
		$this->db->where('device_id', $device_id)->delete('kwh_transaction');
		return $this->db->query('ALTER TABLE kwh_transaction AUTO_INCREMENT 1');
	}

	function deletepenggunaan($device_id)
	{
		$this->db->where('device_id', $device_id)->delete('period');
		$this->db->where('device_id', $device_id)->delete('tb_usage');
		$this->db->where('device_id', $device_id)->delete('kwh_transaction');
		return $this->db->query('ALTER TABLE kwh_transaction AUTO_INCREMENT 1');
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */