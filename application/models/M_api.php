<?php
class M_Api extends CI_Model 
{
	function select_appliance($device_id) 
	{
		return $this->db
					->where('device_id', $device_id)
					->limit(1)
					->get('device');
	}	

	function get_cost()
	{
		return $this->db->get('config');
	}

	function delete()
	{
		return $this->db->where('device_id', 'ESPTEST1')->delete('kwh_transaction');
	}

	function get_training_status($device_id)
	{
		return $this->db->where('trainwith', $device_id)->get('appliance');
	}

	function get_freq($device_id, $appliance_id)
	{
		$sql = "SELECT freq_watt, COUNT(*) AS magnitude FROM log_training WHERE device_id = '$device_id' AND appliance_id = '$appliance_id' GROUP BY freq_watt ORDER BY magnitude DESC LIMIT 1 ";

		return $this->db->query($sql);
	}

	function add_transaction($device_id, $watt, $ampere, $volt, $wh)
	{
		$data = array(
			'device_id' => $device_id,
			'watt' => $watt,
			'ampere' => $ampere,
			'volt' => $volt,
			'wh' => $wh
		);

		return $this->db->insert('kwh_transaction', $data);
	}

	function add_period($device_id, $cost)
	{
		$data = array(
			'device_id' => $device_id,
			'cost' => $cost
		);

		return $this->db->insert('period', $data);
	}

	function add_usage($device_id)
	{
		$data = array(
			'device_id' => $device_id
		);

		return $this->db->insert('tb_usage', $data);
	}

	function post_training($device_id, $appliance_id, $watt)
	{
		$data = array(
			'device_id' => $device_id,
			'appliance_id' => $appliance_id,
			'freq_watt' => $watt
		);

		return $this->db->insert('log_training', $data);
	}

	function put_period($device_id, $total_time, $total_cost, $kwh, $cost)
	{
		$sql = "UPDATE period SET last_time = (NOW()), total_time = $total_time, total_cost = $total_cost, kwh = $kwh, cost = $cost WHERE device_id = '$device_id' order by first_time desc limit 1";

		return $this->db->query($sql);
	}

	function put_usage($device_id, $kwh, $total_cost)
	{
		$sql = "UPDATE tb_usage SET total_cost = $total_cost, kwh = $kwh WHERE device_id = '$device_id' order by usage_date desc limit 1";

		return $this->db->query($sql);
	}

	public function select_period_by_id($device_id) {
		$sql = "SELECT * FROM period WHERE device_id = '$device_id' ORDER BY first_time desc limit 1";

		$data = $this->db->query($sql);

		return $data->row();
	}

	function get_switchon($device_id) 
	{
		return $this->db
					->where('device_id', $device_id)
					->where('status', "ON")
					->limit(1)
					->get('appliancedevice');
	}

	function get_switchonrow($device_id) 
	{
		$data =$this->db
					->where('device_id', $device_id)
					->where('status', "ON")
					->limit(1)
					->get('appliancedevice');

		return $data->row();
	}

	function cek_status_cost() {
		return $this->db
					->where('dirubah', "ya")
					->get('config');
	}

	function update_status_cost() {
		$sql = "UPDATE config SET dirubah = 'tidak' WHERE dirubah = 'ya'";

		return $this->db->query($sql);
	}

	public function get_statusswitch($device_id, $appliance_id) {
		$this->db->where('device_id', $device_id);
		$this->db->where('appliance_id', $appliance_id);
		$data = $this->db->get('appliancedevice');

		return $data->row();
	}

	public function select_today_period($appliancedevice_id) {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE appliancedevice_id = $appliancedevice_id AND DAY(first_time) = DAY(Now())";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function updateappliancedevice($appliancedevice_id) {
		$sql = "UPDATE appliancedevice SET status='OFF' WHERE appliancedevice_id='" .$appliancedevice_id."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	function cek_today($device_id) 
	{
		$sql = "SELECT first_time FROM period WHERE device_id = '$device_id' AND DAY(first_time) = DAY(NOW())";

		return $this->db->query($sql);
	}

	public function select_today_usage($device_id) {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE device_id = '$device_id' AND DAY(first_time) = DAY(Now())";

		return $this->db->query($sql);
	}

	public function select_month_usage($device_id) {
		$sql = "SELECT SUM(kwh) AS kwh, SUM(total_time) AS total_time, SUM(total_cost) AS total_cost FROM period WHERE device_id = '$device_id' AND MONTH(first_time) = MONTH(Now())";

		return $this->db->query($sql);
	}
}