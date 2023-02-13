<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Device extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_device');
		$this->load->model('M_appliance');
		$this->load->model('M_config');
	}

	public function index() {
		$data['userdata'] = $this->userdata;
		$data['dataDevice'] = $this->M_device->select_all();
		$data['dataAppliance'] = $this->M_appliance->select_all();
		$data['dataConfig'] = $this->M_config->select_all();

		$data['page'] = "device";
		$data['judul'] = "Data Device";
		$data['deskripsi'] = "Manage Data Device";

		$data['modal_tambah_device'] = show_my_modal('modals/modal_tambah_device', 'tambah-device', $data);

		$this->template->views('device/home', $data);
	}

	public function tampil() {
		$data['dataDevice'] = $this->M_device->select_all();
		$this->load->view('device/list_data', $data);
	}


	public function prosesTambah() {
		$this->form_validation->set_rules('device_id', 'Device id', 'trim|required|callback_cek_exist_deviceid['.$this->input->post('device_id').']');
		$this->form_validation->set_rules('device_name', 'Device Name', 'trim|required|callback_cek_exist_devicename['.$this->input->post('device_name').']');

		$data = $this->input->post();

		$this->form_validation->set_message('cek_exist_deviceid', 'Device id sudah ada.');
		$this->form_validation->set_message('cek_exist_devicename', 'Device name sudah ada.');

		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_device->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Device Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Device Gagal ditambahkan', '20px');
			}
		} else {

			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function cek_exist_deviceid($device_id)
	{
		$cek = $this->M_device->cek_exist_deviceid($device_id);

		if($cek->num_rows() > 0)
		{
			return FALSE;
		}
		return TRUE;
	}

	public function cek_exist_devicename($device_name)
	{
		$cek = $this->M_device->cek_exist_devicename($device_name);

		if($cek->num_rows() > 0)
		{
			return FALSE;
		}
		return TRUE;
	}

	public function update() {
		$id = trim($_POST['id']);

		$data['dataDevice'] = $this->M_device->select_by_id($id);
		$data['dataAppliance'] = $this->M_appliance->select_all();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_device', 'update-device', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('device_name', 'Device Name', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_device->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Device Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Device Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_device->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data Device Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Device Gagal dihapus', '20px');
		}
	}

	public function deviceappliance() {
		$data['userdata'] 	= $this->userdata;
		$device_id = $this->uri->segment(3);
		$data['dataAppliancedevice'] = $this->M_device->select_appliancedevice_by_id($device_id);
		$data['dataDevice'] = $this->M_device->select_by_id($device_id);
		$data['dataAppliance'] = $this->M_appliance->select_all();

		$data['page'] = "device";
		$data['judul'] = "Device  ".$device_id;
		$data['deskripsi'] = "Device Appliance Connections";

		$data['modal_tambah_connection'] = show_my_modal('modals/modal_tambah_connection', 'tambah-connection', $data);

		$this->template->views('device/deviceappliance', $data);

	}

	public function updatemaxkwh() {
		$id = trim($_POST['id']);

		$data['dataAppliancedevicerow'] = $this->M_device->select_appliancedevice_by_id_row($id);
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_deviceappliance', 'update-maxkwh', $data);
	}

	public function prosesUpdatemaxkwh() {
		$this->form_validation->set_rules('max_kwh', 'Max kWh', 'trim|required');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_device->updatemaxkwh($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Max kWh Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Max kWh Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}


	public function prosesTambahconnection() {
		$this->form_validation->set_rules('device_id', 'Device id', 'trim|required|callback_cek_exist_connection');
		$this->form_validation->set_rules('appliance_id', 'Appliance Name', 'trim|required');
		$this->form_validation->set_rules('max_kwh', 'kwh Max', 'trim|required');

		$data = $this->input->post();

		$this->form_validation->set_message('cek_exist_connection', 'Connection sudah ada.');

		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_device->insertConnection($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Connection Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Connection Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function cek_exist_connection() {
		$device_id = $this->input->post('device_id');
		$appliance_id = $this->input->post('appliance_id');

		$cek = $this->M_device->cek_exist_connection($device_id, $appliance_id);

		if($cek->num_rows() > 0)
		{
			return FALSE;
		}
		return TRUE;
	}

	public function deleteappliancedevice() {
		$id = $_POST['id'];
		$result = $this->M_device->deleteappliancedevice($id);

		if ($result > 0) {
			echo show_succ_msg('Data Connection Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Connection Gagal dihapus', '20px');
		}
	}

	public function updateappliancedevice() {
		$id = $_POST['id'];
		$sql = $this->M_device->get_deviceid_connection($id);
		$device_id = $sql->row()->device_id;

		$sql = $this->M_device->get_switchon($device_id);
		if ($sql->num_rows() > 0) {
		$appliancedevice_id = $sql->row()->appliancedevice_id;
		} else {
			$appliancedevice_id = 0;
		}

		$sql = $this->M_device->select_connection_by_id($id);
		if ($sql->status == 'ON') {
			$status = "OFF";
		} else {
			$status = "ON";
		}

		$result = $this->M_device->updateappliancedevice($id, $status, $appliancedevice_id);

		echo show_succ_msg('Switch Sukses', '20px');
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;
		$device_id = $this->uri->segment(3);
		$data['dataDetail'] = $this->M_device->select_detail_by_id($device_id);
		$data['dataDevice'] = $this->M_device->select_by_id($device_id);
		$sql = $this->M_device->select_detail_by_id($device_id);

		$dataPointsVolt = array();
		$dataPointsAmpere = array();
		$dataPointsWatt = array();
		$dataPointsWh = array();

		foreach($sql as $row){
		        array_push($dataPointsVolt, array("y"=> $row->volt, "label" => $row->created));
		        array_push($dataPointsAmpere, array("y"=> $row->ampere, "label" => $row->created));
		        array_push($dataPointsWatt, array("y"=> $row->watt, "label" => $row->created));
		        array_push($dataPointsWh, array("y"=> $row->wh, "label" => $row->created));
		    }

		$data['dataVolt'] = json_encode($dataPointsVolt, JSON_NUMERIC_CHECK);
		$data['dataWatt'] = json_encode($dataPointsWatt, JSON_NUMERIC_CHECK);
		$data['dataAmpere'] = json_encode($dataPointsAmpere, JSON_NUMERIC_CHECK);
		$data['dataWh'] = json_encode($dataPointsWh, JSON_NUMERIC_CHECK);

		$data['page'] = "device";
		$data['judul'] = "Data Transaction ".$device_id;
		$data['deskripsi'] = "Kwh Transaction";

		$data['modal_tambah_device'] = show_my_modal('modals/modal_export_excel', 'export-excel', $data);
		$this->template->views('device/detail', $data);
	}

	public function jsondatavolt() {
		$device_id = $this->uri->segment(3);
		$data['userdata'] 	= $this->userdata;
		$sql = $this->M_device->select_detail_by_id($device_id);

		$dataPointsVolt = array();

		foreach($sql as $row){
		        array_push($dataPointsVolt, array("y"=> $row->volt, "label" => $row->created));
		    }

		echo $data['dataVolt'] = json_encode($dataPointsVolt, JSON_NUMERIC_CHECK);
	}

	public function jsondataampere() {
		$device_id = $this->uri->segment(3);
		$data['userdata'] 	= $this->userdata;
		$sql = $this->M_device->select_detail_by_id($device_id);

		$dataPointsAmpere = array();

		foreach($sql as $row){
		        array_push($dataPointsAmpere, array("y"=> $row->ampere, "label" => $row->created));
		    }

		echo $data['dataAmpere'] = json_encode($dataPointsAmpere, JSON_NUMERIC_CHECK);
	}

	public function jsondatawatt() {
		$device_id = $this->uri->segment(3);
		$appliance_id = $this->uri->segment(4);
		$data['userdata'] 	= $this->userdata;
		$sql = $this->M_device->select_detail_by_id($device_id, $appliance_id);

		$dataPointsVolt = array();
		$dataPointsAmpere = array();
		$dataPointsWatt = array();
		$dataPointsWh = array();

		foreach($sql as $row){
		        array_push($dataPointsVolt, array("y"=> $row->volt, "label" => $row->created));
		        array_push($dataPointsAmpere, array("y"=> $row->ampere, "label" => $row->created));
		        array_push($dataPointsWatt, array("y"=> $row->watt, "label" => $row->created));
		        array_push($dataPointsWh, array("y"=> $row->wh, "label" => $row->created));
		    }

		$data['dataVolt'] = json_encode($dataPointsVolt, JSON_NUMERIC_CHECK);
		echo $data['dataWatt'] = json_encode($dataPointsWatt, JSON_NUMERIC_CHECK);
		$data['dataAmpere'] = json_encode($dataPointsAmpere, JSON_NUMERIC_CHECK);
		$data['dataWh'] = json_encode($dataPointsWh, JSON_NUMERIC_CHECK);
	}

	public function jsondatawatttraining() {
		$device_id = $this->uri->segment(3);
		$appliance_id = $this->uri->segment(4);
		$data['userdata'] 	= $this->userdata;
		$sql = $this->M_device->select_detail_training_by_id($device_id, $appliance_id);

		$dataPointsWatt = array();

		foreach($sql as $row){
		        array_push($dataPointsWatt, array("y"=> $row->freq_watt, "label" => $row->created));
		    }

		echo $data['dataWatt'] = json_encode($dataPointsWatt, JSON_NUMERIC_CHECK);;
	}

	public function jsondatakwh() {
		$device_id = $this->uri->segment(3);
		$data['userdata'] 	= $this->userdata;
		$sql = $this->M_device->select_detail_by_id($device_id);

		$dataPointsWh = array();

		foreach($sql as $row){
		        array_push($dataPointsWh, array("y"=> $row->wh, "label" => $row->created));
		    }
		echo $data['dataWh'] = json_encode($dataPointsWh, JSON_NUMERIC_CHECK);
	}

	public function jsondatamonthusage() {
		$device_id = $this->uri->segment(3);
		$sql = $this->M_device->select_thismonthusage($device_id);

		$dataPointsWh = array();

		foreach($sql as $row){
				$timestamp = strtotime($row->usage_date);
		        array_push($dataPointsWh, array("y"=> $row->kwh, "label" => date('Y-m-d', $timestamp)));
		    }
		echo $data['dataWh'] = json_encode($dataPointsWh, JSON_NUMERIC_CHECK);
	}

	public function jsondatamonthcost() {
		$device_id = $this->uri->segment(3);
		$sql = $this->M_device->select_thismonthusage($device_id);

		$dataPointsWh = array();

		foreach($sql as $row){
				$timestamp = strtotime($row->usage_date);
		        array_push($dataPointsWh, array("y"=> $row->total_cost, "label" => date('Y-m-d', $timestamp)));
		    }
		echo $data['dataWh'] = json_encode($dataPointsWh, JSON_NUMERIC_CHECK);
	}

	public function jsondatakwhall() {
		$data['userdata'] 	= $this->userdata;
		$sql = $this->M_device->select_detail_all();

		$dataPointsVolt = array();
		$dataPointsAmpere = array();
		$dataPointsWatt = array();
		$dataPointsWh = array();

		foreach($sql as $row){
		        array_push($dataPointsVolt, array("y"=> $row->volt, "label" => $row->created));
		        array_push($dataPointsAmpere, array("y"=> $row->ampere, "label" => $row->created));
		        array_push($dataPointsWatt, array("y"=> $row->watt, "label" => $row->created));
		        array_push($dataPointsWh, array("y"=> $row->wh, "label" => $row->created));
		    }

		$data['dataVolt'] = json_encode($dataPointsVolt, JSON_NUMERIC_CHECK);
		$data['dataWatt'] = json_encode($dataPointsWatt, JSON_NUMERIC_CHECK);
		$data['dataAmpere'] = json_encode($dataPointsAmpere, JSON_NUMERIC_CHECK);
		echo $data['dataWh'] = json_encode($dataPointsWh, JSON_NUMERIC_CHECK);
	}

	public function tampildetail() {
		$data['userdata'] 	= $this->userdata;
		$device_id = "ESPTEST1";
		$appliance_id = "1";
		$data = $this->M_device->select_detail_by_id($device_id, $appliance_id);


		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function tampilperiod() {
		$data['userdata'] 	= $this->userdata;
		$device_id = $this->uri->segment(3);
		$data = $this->M_device->select_period_by_id($device_id);

		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function tampiltoday() {
		$data['userdata'] 	= $this->userdata;
		$device_id = $this->uri->segment(3);
		$data = $this->M_device->select_today_period($device_id);

		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function tampiltodayall() {
		$data['userdata'] 	= $this->userdata;
		$data = $this->M_device->select_today_period_all();

		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function tampilthisweek() {
		$data['userdata'] 	= $this->userdata;
		$device_id = $this->uri->segment(3);
		$data = $this->M_device->select_thisweek_period($device_id);

		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function tampilthisweekall() {
		$data['userdata'] 	= $this->userdata;
		$data = $this->M_device->select_thisweek_period_all();

		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function tampilthismonth() {
		$data['userdata'] 	= $this->userdata;
		$device_id = $this->uri->segment(3);
		$data = $this->M_device->select_thismonth_period($device_id);

		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function tampilthismonthall() {
		$data['userdata'] 	= $this->userdata;
		$data = $this->M_device->select_thismonth_period_all();

		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function tampilyesterday() {
		$data['userdata'] 	= $this->userdata;
		$device_id = $this->uri->segment(3);
		$data = $this->M_device->select_yesterday_period($device_id);

		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function tampilyesterdayall() {
		$data['userdata'] 	= $this->userdata;
		$data = $this->M_device->select_yesterday_period_all();

		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function tampillastweek() {
		$data['userdata'] 	= $this->userdata;
		$device_id = $this->uri->segment(3);
		$data = $this->M_device->select_lastweek_period($device_id);

		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function tampillastweekall() {
		$data['userdata'] 	= $this->userdata;
		$data = $this->M_device->select_lastweek_period_all();

		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function tampillastmonth() {
		$data['userdata'] 	= $this->userdata;
		$device_id = $this->uri->segment(3);
		$data = $this->M_device->select_lastmonth_period($device_id);

		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function tampillastmonthall() {
		$data['userdata'] 	= $this->userdata;
		$data = $this->M_device->select_lastmonth_period_all();

		echo json_encode(array("sEcho" => 1,
							   "iTotalRecords" => count($data),
							   "iTotalDisplayRecords" => count($data),
							   "aaData" => $data));
	}

	public function hapusdatachart() {
		$device_id = $this->uri->segment(3);

		$cek = $this->M_device->deletechart($device_id);
		if ($cek) 
		{
			echo "<script>location= '../detail/$device_id'; </script>";
		} else {

		}
	}

	public function hapusdatachartconfig() {
		$device_id = $this->uri->segment(3);

		$cek = $this->M_device->deletechart($device_id);
		if ($cek) 
		{
			echo "<script>location= '../../config'; </script>";
		} else {

		}
	}

	public function hapusdatapenggunaan() {
		$device_id = $this->uri->segment(3);

		$cek = $this->M_device->deletepenggunaan($device_id);
		if ($cek) 
		{
			echo "<script>location= '../detail/$device_id'; </script>";
		} else {

		}
	}

	public function hapusdatapenggunaanconfig() {
		$device_id = $this->uri->segment(3);

		$cek = $this->M_device->deletepenggunaan($device_id);
		if ($cek) 
		{
			echo "<script>location= '../../config'; </script>";
		} else {

		}
	}

	public function export() {
		$device_id = $this->input->post('device_id');
		$tanggal_dari = $this->input->post('tanggal_dari');
		$tanggal_sampai = $this->input->post('tanggal_sampai');

		$dataDevice = $this->M_device->select_by_id($device_id);
		$device_id1 = $dataDevice->device_id;

		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';

		$data = $this->M_device->select_period_by_date($device_id, $tanggal_dari, $tanggal_sampai);

		$excel = new PHPExcel();
		    // Settingan awal fil excel
		    $excel->getProperties()->setCreator('My Notes Code')
		                 ->setLastModifiedBy('My Notes Code')
		                 ->setTitle("Data Transaction")
		                 ->setSubject("Data Transaction")
		                 ->setDescription("Laporan Data Transaction")
		                 ->setKeywords("Data Transaction");
		    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		    $style_col = array(
		      'font' => array('bold' => true), // Set font nya jadi bold
		      'alignment' => array(
		        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		      ),
		      'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		      )
		    );
		    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		    $style_row = array(
		      'alignment' => array(
		        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		      ),
		      'borders' => array(
		        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		      )
		    );
		    $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA TRANSACTION ".$device_id); // Set kolom A1 dengan tulisan "DATA SISWA"
		    $excel->getActiveSheet()->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai E1
		    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		    // Buat header tabel nya pada baris ke 3
		    $excel->setActiveSheetIndex(0)->setCellValue('A3', "Period"); // Set kolom A3 dengan tulisan "NO"
		    $excel->setActiveSheetIndex(0)->setCellValue('B3', "First Time"); // Set kolom B3 dengan tulisan "NIS"
		    $excel->setActiveSheetIndex(0)->setCellValue('C3', "Last Time"); // Set kolom C3 dengan tulisan "NAMA"
		    $excel->setActiveSheetIndex(0)->setCellValue('D3', "Total Time"); // 
		    $excel->setActiveSheetIndex(0)->setCellValue('E3', "kWh"); // Set kolom E3 dengan tulisan "ALAMAT"
		    $excel->setActiveSheetIndex(0)->setCellValue('F3', "Cost"); // Set kolom E3 dengan tulisan "ALAMAT"
		    $excel->setActiveSheetIndex(0)->setCellValue('G3', "Total Cost"); // Set kolom E3 dengan tulisan "ALAMAT"
		    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
		    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
	
		    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
		    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		    foreach($data as $data){ // Lakukan looping pada variabel siswa
		      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->first_time);
		      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->last_time);
		      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->total_time." s");
		      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->kwh." kWh");
		      $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, "Rp. ".$data->cost);
		      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, "Rp. ".$data->total_cost);
		      
		      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		      
		      $no++; // Tambah 1 setiap kali looping
		      $numrow++; // Tambah 1 setiap kali looping
		    }
		    $data = $this->M_device->select_total_period_by_id($device_id, $tanggal_dari, $tanggal_sampai);
		    $numrow = $numrow + 1;
		    $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, "Total kWh");
		    $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, "Total Time");
		    $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, "Total Cost");
		    $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_col);
		    $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_col);

		    $numrow = $numrow + 1;
		    foreach($data as $data){ // Lakukan looping pada variabel siswa
		      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, round($data->kwh, 3)." kWh");
		      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->total_time." s");
		      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, "Rp. ".$data->total_cost);
		      
		      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		      
		      $numrow++; // Tambah 1 setiap kali looping
		    }

		    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(10); // Set width kolom A
		    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); // Set width kolom B
		    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20); // Set width kolom C
		    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom D
		    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
		    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom F
		    $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom G
		    
		    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		    // Set orientasi kertas jadi LANDSCAPE
		    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		    // Set judul file excel nya
		    $excel->getActiveSheet(0)->setTitle("Laporan Data Transaction");
		    $excel->setActiveSheetIndex(0);
		    // Proses file excel
		    $objWriter = new PHPExcel_Writer_Excel2007($excel); 
			$objWriter->save('./assets/excel/Data Transaction '.$device_id1.'-('.$tanggal_dari.'-'.$tanggal_sampai.').xlsx'); 

		    $this->load->helper('download');
		    force_download('./assets/excel/Data Transaction '.$device_id1.'-('.$tanggal_dari.'-'.$tanggal_sampai.').xlsx', NULL);
}
}