<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Pilih Rentang Tanggal</h3>

  <form  form action="<?php echo base_url('Device/export'); ?>" method="POST">
    <input type="hidden" name="device_id" value="<?php echo $dataDevice->device_id; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <input type="text" class="form-control" placeholder="Tanggal Dari" id="tanggal_dari" name="tanggal_dari" aria-describedby="sizing-addon2" value="<?php echo date('Y-m-d'); ?>" required> 
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
      <input type="text" class="form-control" placeholder="Tanggal Sampai" id="tanggal_sampai" name="tanggal_sampai" value="<?php echo date('Y-m-d'); ?>" aria-describedby="sizing-addon2" required>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Download Laporan</button>
      </div>
    </div>
  </form>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/datetimepicker/jquery.datetimepicker.css"/>
<script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/jquery.datetimepicker.js"></script>
<script type="text/javascript">
$(function () {
    $(".select2").select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
});

$('#tanggal_dari').datetimepicker({
  lang:'en',
  format:'Y-m-d',
  closeOnDateSelect:true
});

$('#tanggal_sampai').datetimepicker({
  lang:'en',
  format:'Y-m-d',
  closeOnDateSelect:true
});

</script>