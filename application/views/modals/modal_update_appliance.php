<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Appliance</h3>

  <form action="<?php echo base_url('Appliance/prosesUpdate') ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="appliance_id" value="<?php echo $dataAppliance->appliance_id; ?>">
    <input type="hidden" name="old_photo" value="<?php echo $dataAppliance->photo; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-pencil"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nama Posisi" name="appliance_name" aria-describedby="sizing-addon2" value="<?php echo $dataAppliance->appliance_name; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-picture"></i>
      </span>
      <input type="file" class="form-control" placeholder="Photo" name="photo" aria-describedby="sizing-addon2">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>