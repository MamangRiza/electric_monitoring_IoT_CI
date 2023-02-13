<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_device');
		$this->load->model('M_appliance');
		$this->load->model('M_config');
	}

	public function index() {
		$data['jml_device'] 	= $this->M_device->total_rows();
		$data['jml_appliance'] 	= $this->M_appliance->total_rows();
		$data['jml_config']		= $this->M_config->total_rows();
		$data['userdata'] 		= $this->userdata;

		$data['page'] 			= "home";
		$data['judul'] 			= "Beranda";
		$data['deskripsi'] 		= "Manage Data CRUD";
		$this->template->views('home', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */