<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appliance extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_appliance');
		$this->load->model('M_device');
		$this->load->model('M_config');
		$this->load->model('M_api');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataAppliance'] = $this->M_appliance->select_all();

		$data['page'] 		= "appliance";
		$data['judul'] 		= "Data Appliance";
		$data['deskripsi'] 	= "Manage Data Appliance";

		$data['modal_tambah_appliance'] = show_my_modal('modals/modal_tambah_appliance', 'tambah-appliance', $data);

		$this->template->views('appliance/home', $data);
	}

	public function tampil() {
		$data['dataAppliance'] = $this->M_appliance->select_all();
		$this->load->view('appliance/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('appliance_name', 'Appliance Name', 'trim|required|callback_cek_exist_appliancename['.$this->input->post('appliance_name').']');

		$this->form_validation->set_message('cek_exist_appliancename', 'Appliance name sudah ada.');

		$data = array(
					'appliance_name' => $this->input->post('appliance_name')
				);
				if (!empty($_FILES['photo']['name'])) {
					$upload = $this->_do_upload();
					$data['photo'] = $upload;
				} else {
					$this->form_validation->set_rules('photo', 'Photo', 'trim|required');
				}
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_appliance->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Appliance Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Aplliance Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function cek_exist_appliancename($appliance_name)
	{
		$cek = $this->M_appliance->cek_exist_appliancename($appliance_name);

		if($cek->num_rows() > 0)
		{
			return FALSE;
		}
		return TRUE;
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['dataAppliance'] = $this->M_appliance->select_by_id($id);

		echo show_my_modal('modals/modal_update_appliance', 'update-appliance', $data);
	}

	public function prosesUpdate() {

		$data = array(
					'appliance_name' => $this->input->post('appliance_name'),
					'appliance_id' => $this->input->post('appliance_id')
				);
				if (!empty($_FILES['photo']['name'])) {
					$upload = $this->_do_upload();
					$data['photo'] = $upload;
				} else {
					$data['photo'] = $this->input->post('old_photo');
				}
			$result = $this->M_appliance->update($data);

			if ($result > 0) {
				echo "<script type='text/javascript'>
				alert ('data berhasil di update');
				
				</script>";
				echo "<script>location='".base_url('appliance')."'; </script>";
			} else {
				echo "<script type='text/javascript'>
				alert ('data gagal di update');
				
				</script>";
				echo "<script>location='".base_url('appliance')."'; </script>";
			}

		echo json_encode($out);
	}

	private function _do_upload()
	{
		$config['upload_path'] 		= 'assets/img/';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size'] 			= 1000;
		$config['max_widht'] 			= 1000;
		$config['max_height']  		= 1000;
		$config['file_name'] 			= round(microtime(true)*1000);
	
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('photo')) {
			$out['msg'] = show_err_msg(display_errors());
			redirect('Appliance');
		}
		return $this->upload->data('file_name');
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_appliance->delete($id);
		
		if ($result > 0) {
			echo show_succ_msg('Data Posisi Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Posisi Gagal dihapus', '20px');
		}
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['posisi'] = $this->M_appliance->select_by_id($id);
		$data['dataPosisi'] = $this->M_appliance->select_by_pegawai($id);

		$this->template->views('appliance/home', $data);
	}

	public function training() {
		$data['userdata'] 	= $this->userdata;
		$data['appliance_id'] = $this->uri->segment(3);
		$data['dataDevice'] = $this->M_device->select_all();

		$data['page'] 		= "appliance";
		$data['judul'] 		= "Training Data Appliance";
		$data['deskripsi'] 	= "Train Appliance";

		$this->template->views('appliance/training', $data);
	}

	public function detailtraining() {
		$data['userdata'] 	= $this->userdata;
		$device_id = $this->uri->segment(3);
		$appliance_id = $this->uri->segment(4);
		$data['dataConnection'] = $this->M_device->get_appliancedevice_data($device_id, $appliance_id);
		$data['dataDetail'] = $this->M_device->select_detail_by_id($device_id, $appliance_id);
		$data['dataDevice'] = $this->M_device->select_by_id($device_id);
		$data['dataAppliance'] = $this->M_appliance->select_by_id($appliance_id);
		$sql = $this->M_device->select_detail_training_by_id($device_id, $appliance_id);

		$this->M_appliance->updatetraining($device_id, $appliance_id);

		$dataPointsWatt = array();

		foreach($sql as $row){
		        array_push($dataPointsWatt, array("y"=> $row->freq_watt, "label" => $row->created));
		    }

		$data['dataWatt'] = json_encode($dataPointsWatt, JSON_NUMERIC_CHECK);

		$data['page'] = "appliance";
		$data['judul'] = "Training ".$device_id." - ".$data['dataAppliance']->appliance_name;
		$data['deskripsi'] = "Training Appliance";

		$data['modal_tambah_device'] = show_my_modal('modals/modal_export_excel', 'export-excel', $data);
		$this->template->views('appliance/detail_training', $data);
	}

	public function training_result() {
		$data['userdata'] 	= $this->userdata;
		$device_id = $this->uri->segment(3);
		$appliance_id = $this->uri->segment(4);

		$cek = $this->M_api->get_freq($device_id, $appliance_id);
		if ($cek->num_rows() > 0) 
		{
			$watt = $cek->row()->freq_watt;
		} else {
			$cek = "0";
		}

		$this->M_appliance->update_freq_watt($device_id, $appliance_id, $watt);

		?>
		<script type="text/javascript">
		  window.location.href= '../../';
		</script>
		<?php
	}
}
