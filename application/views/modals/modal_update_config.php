<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Config</h3>

  <form id="form-update-config" method="POST">
    <input type="hidden" name="config_id" value="<?php echo $dataConfig->config_id; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-wrench"></i>
      </span>
      <input type="text" class="form-control" placeholder="Cost" name="cost" aria-describedby="sizing-addon2" value="<?php echo $dataConfig->cost; ?>">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>