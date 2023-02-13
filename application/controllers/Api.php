<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_api');
		$this->load->model('M_device');
	}

	function init() 
	{
		$cost = $this->M_api->get_cost();

		if ($cost->num_rows() > 0) 
		{
			$cost = $cost->row();
			echo $cost->cost;
		} else {
			echo '0';
		}
	}

	function post_transaction()
	{
		$device_id = $this->input->post('device_id');
		$watt = $this->input->post('watt');
		$ampere = $this->input->post('ampere');
		$volt = $this->input->post('volt');
		$wh = $this->input->post('wh');

		$insert = $this->M_api->add_transaction($device_id, $watt, $ampere, $volt, $wh);

		if ($insert > 0) 
		{
			echo '1';
		} else {
			echo '0';
		}

	}

	function switchstatus() {
		$device_id = $this->input->get('device_id');

		$data = $this->M_api->get_switchon($device_id);

		if ($data->num_rows() > 0) {
			$appliance_id = $data->row()->appliance_id;
			$sql = $this->M_api->get_statusswitch($device_id, $appliance_id);
			echo '1,'.$sql->device_id.','.$sql->appliance_id.','.$sql->appliancedevice_id;
		} else {
			echo '0';
		}

	}

	function get_max_kwh() {
		$device_id = $this->input->get('device_id');

		$data = $this->M_api->get_switchon($device_id);

		if ($data->num_rows() > 0) {
			$appliance_id = $data->row()->appliance_id;
			$sql = $this->M_api->get_statusswitch($device_id, $appliance_id);
			echo $sql->max_kwh;
		} else {
			echo '0';
		}

	}

	function post_period() {
		$device_id = $this->input->post('device_id');
		$cost = $this->input->post('cost');

		$insert = $this->M_api->add_period($device_id, $cost);

		if ($insert > 0) 
		{
			echo '1';
		} else {
			echo '0';
		}
	}

	function put_period() {
		$kwh = $this->input->post('kwh');
		$device_id = $this->input->post('device_id');
		$sql = $this->M_api->select_period_by_id($device_id);
		$cost = $sql->cost;
		$data = $this->M_api->select_period_by_id($device_id);

		$datetime1 = strtotime($data->first_time);
		$datetime2 = strtotime($data->last_time);
		$interval  = abs($datetime2 - $datetime1);
		$total_time = ($interval);

		$total_cost = $kwh * $cost;

		$update = $this->M_api->put_period($device_id, $total_time, $total_cost, $kwh, $cost);
		$update_usage = $this->M_api->put_usage($device_id, $kwh, $total_cost);

		if ($update > 0 AND $update_usage > 0) 
		{
			echo '1';
		} else {
			echo '0';
		}
	}

	function check_midnight() {
		$timestamp = time();
		if(date('H', $timestamp) === '00' AND date('i', $timestamp) === '00' AND date('s', $timestamp) >= '00' AND date('s', $timestamp) <= '01'){
			echo "1";
		} else {
			echo "0";
		}
	}

	function check_monday() {
		$timestamp = time();
		if(date('D', $timestamp) === 'Mon'){
			echo "Senin";
		} else {
			echo "bukan senin";
		}
	}

	function check_firstdate() {
		$timestamp = time();
		if(date('j', $timestamp) === '1') {
		    echo "It is the first day of the month today";
		} else {
			echo "bukan tanggal satu";
		}
	}

	function test() {
		$timestamp = time();
		if(date('D', $timestamp) == date('D-1')){
			echo "Senin";
		} else {
			echo date('D-1');
		}
	}

	function cek_training() {
		$device_id = $this->input->get('device_id');
		$cek = $this->M_api->get_training_status($device_id);

		if ($cek->num_rows() > 0) 
		{
			$cek = $cek->row();
			echo $cek->appliance_id;
		} else {
			echo '0';
		}
	}

	function post_training() {
		$device_id = $this->input->post('device_id');
		$appliance_id = $this->input->post('appliance_id');
		$watt = $this->input->post('watt');

		$insert = $this->M_api->post_training($device_id, $appliance_id, $watt);

		if ($insert > 0) 
		{
			echo '1';
		} else {
			echo '0';
		}
	}

	function cek_freq() {
		$device_id = "ESPTEST1";
		$appliance_id = "40";

		$cek = $this->M_api->get_freq($device_id, $appliance_id);
		if ($cek->num_rows() > 0) 
		{
			$cek = $cek->row()->freq_watt;
			echo $cek;
		} else {
			echo '0';
		}
	}

	function cek_today() {
		$device_id = $this->input->get('device_id');

		$cek = $this->M_api->cek_today($device_id);
		if ($cek->num_rows() > 0) 
		{
			echo '1';
		} else {
			echo '0';
		}
	}

	function delete() {
		$cek = $this->M_api->delete();
		if ($cek) 
		{
			echo '1';
		} else {
			echo '0';
		}
	}

	function get_status_cost() {
		$cek = $this->M_api->cek_status_cost();
		if ($cek->num_rows() > 0) 
		{
			echo $cek->row()->cost;
		} else {
			echo '0';
		}

		$this->M_api->update_status_cost();
	}

	function get_today_kwh() {
		$device_id = $this->input->get('device_id');

		$cek = $this->M_api->select_today_usage($device_id);
		if ($cek->num_rows() > 0) 
		{
			echo round($cek->row()->kwh, 4);
		} else {
			echo '0';
		}
	}


	function get_today_cost() {
		$device_id = $this->input->get('device_id');

		$cek = $this->M_api->select_today_usage($device_id);
		if ($cek->num_rows() > 0) 
		{
			echo round($cek->row()->total_cost, 2);
		} else {
			echo '0';
		}
	}

	function get_month_kwh() {
		$device_id = $this->input->get('device_id');

		$cek = $this->M_api->select_month_usage($device_id);
		if ($cek->num_rows() > 0) 
		{
			echo round($cek->row()->kwh, 4);
		} else {
			echo '0';
		}
	}


	function get_month_cost() {
		$device_id = $this->input->get('device_id');

		$cek = $this->M_api->select_month_usage($device_id);
		if ($cek->num_rows() > 0) 
		{
			echo round($cek->row()->total_cost, 2);
		} else {
			echo '0';
		}
	}

	function post_usage() {
		$device_id = $this->input->post('device_id');

		$insert = $this->M_api->add_usage($device_id);

		if ($insert > 0) 
		{
			echo '1';
		} else {
			echo '0';
		}
	}
}