<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Device Id</th>
          <th>Device Name</th>
          <th>Created</th>
          <th>Updated</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($dataDevice as $device) {
            ?>
            <tr>
              <td><?php echo $device->device_id; ?></td>
              <td><?php echo $device->device_name; ?></td>
              <td><?php echo $device->created; ?></td>
              <td><?php echo $device->updated; ?></td>
              <td class="text-center" style="width:290px;">
                <a class="btn btn-success detail-dataDeviceTraining"  href="<?php echo base_url('Appliance/detailtraining/'.$device->device_id.'/'.$appliance_id); ?>"><i class="glyphicon glyphicon-info-sign"></i> Train</a>
              </td>
            </tr>
            <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>


