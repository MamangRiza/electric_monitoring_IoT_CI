<script type="text/javascript">
	var MyTable = $('#list-data').dataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false
		});

	window.onload = function() {
		tampilDevice();
		tampilDeviceTraining();
		tampilAppliance();
		tampilConfig();
		tampilApplianceDevice();
		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refresh() {
		MyTable = $('#list-data').dataTable();
	}

	function effect_msg_form() {
		// $('.form-msg').hide();
		$('.form-msg').show(1000);
		setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
	}

	function effect_msg() {
		// $('.msg').hide();
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}

	function tampilDevice() {
		$.get('<?php echo base_url('Device/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-device').html(data);
			refresh();
		});
	}

	function tampilDeviceTraining() {
		$.get('<?php echo base_url('Device/tampildevicetraining'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-devicetraining').html(data);
			refresh();
		});
	}

	var id_pegawai;
	$(document).on("click", ".konfirmasiHapus-device", function() {
		device_id = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataDevice", function() {
		var id = device_id;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Device/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilDevice();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".konfirmasiHapus-appliancedevice", function() {
		appliancedevice_id = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataApplianceDevice", function() {
		var id = appliancedevice_id;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Device/deleteappliancedevice'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			$('.msg').html(data);
			effect_msg();
			setTimeout(function(){
			      location.reload();
			  },1500);
		})
	})

	$(document).on("click", ".konfirmasiUpdate-appliancedevice", function() {
		appliancedevice_id = $(this).attr("data-id");
	})
	$(document).on("click", ".update-dataApplianceDevice", function() {
		var id = appliancedevice_id;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Device/updateappliancedevice'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiSwitch').modal('hide');
			$('.msg').html(data);
			effect_msg();
			setTimeout(function(){
			      location.reload();
			  },1500);
		})
	})


	$(document).on("click", ".update-dataDevice", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Device/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-device').modal('show');
		})
	})

	$(document).on("click", ".update-datamaxkwh", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Device/updatemaxkwh'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-maxkwh').modal('show');
		})
	})

	$('#form-tambah-device').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Device/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilDevice();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-device").reset();
				$('#tambah-device').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#form-tambah-connection').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Device/prosesTambahconnection'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
				setTimeout(function(){
				      location.reload();
				  },2000);
			} else {
				document.getElementById("form-tambah-connection").reset();
				$('#tambah-connection').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
				setTimeout(function(){
				      location.reload();
				  },2000);
			}
		})
		
		e.preventDefault();
	});

	$('#form-export-excel').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Device/export'); ?>',
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilDevice();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-export-excel").reset();
				$('#export-excel').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-device', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Device/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilDevice();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-device").reset();
				$('#update-device').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-maxkwh', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Device/prosesUpdatemaxkwh'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilDevice();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-maxkwh").reset();
				$('#update-maxkwh').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
				setTimeout(function(){
				      location.reload();
				  },2000);
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-device').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#tambah-connection').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#export-excel').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-device').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-maxkwh').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Kota
	function tampilConfig() {
		$.get('<?php echo base_url('Config/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-config').html(data);
			refresh();
		});
	}

	var id_kota;
	$(document).on("click", ".konfirmasiHapus-config", function() {
		id_kota = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataConfig", function() {
		var id = id_kota;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Config/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilConfig();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataConfig", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Config/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-config').modal('show');
		})
	})

	$(document).on("click", ".detail-dataKota", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Config/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-kota').modal('show');
		})
	})

	$('#form-tambah-config').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Config/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilConfig();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-config").reset();
				$('#tambah-config').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-config', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Config/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilConfig();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-config").reset();
				$('#update-config').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-config').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-config').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Posisi
	function tampilAppliance() {
		$.get('<?php echo base_url('Appliance/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-appliance').html(data);
			refresh();
		});
	}

	var id_posisi;
	$(document).on("click", ".konfirmasiHapus-appliance", function() {
		id_posisi = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataAppliance", function() {
		var id = id_posisi;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Appliance/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilAppliance();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataAppliance", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Appliance/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-appliance').modal('show');
		})
	})

	$('#form-tambah-appliance').submit(function(e) {
		e.preventDefault();    
    var formData = new FormData(this);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Appliance/prosesTambah'); ?>',
			data: formData,
			cache: false,
			        contentType: false,
			        processData: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilAppliance();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-appliance").reset();
				$('#tambah-appliance').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-appliance', function(e){
		var data = new FormData(this);

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Appliance/prosesUpdate'); ?>',
			data: data,
			cache: false,
			contentType: false,
			processData: false
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilAppliance();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-appliance").reset();
				$('#update-appliance').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-appliance').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-appliance').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
</script>