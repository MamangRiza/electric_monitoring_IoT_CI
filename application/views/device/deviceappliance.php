<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="box">
  <div class="box-header">
    <div class="col-md-6" style="padding: 0;">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-connection"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Device ID</th>
          <th>Device Name</th>
          <th>Appliance Name</th>
          <th>Created</th>
          <th>Max kWh</th>
          <th>Last Active</th>
          <th>Status</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-appliancedevice">
        <?php
          $dataPoints = array();
          foreach ($dataAppliancedevice as $row) {
            ?>
            <tr>
              <td><?php echo $row->device_id; ?></td>
              <td><?php echo $row->device_name; ?></td>
              <td><?php echo $row->appliance_name; ?></td>
              <td><?php echo $row->created; ?></td>
              <td><?php echo $row->max_kwh; ?></td>
              <td><?php echo $row->last_active; ?></td>
              <td><?php echo $row->status; ?></td>
              <td class="text-center" style="width:310px;">
                <button class="btn btn-success konfirmasiUpdate-appliancedevice" data-id="<?php echo $row->appliancedevice_id; ?>" data-toggle="modal" data-target="#konfirmasiSwitch"><i class="glyphicon glyphicon-repeat"></i> Switch ON/OFF</button>
                <button class="btn btn-warning update-datamaxkwh" data-id="<?php echo $row->appliancedevice_id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
                <a class="btn btn-info detail-dataDevice"  href="<?php echo base_url('Device/detail/'.$row->device_id.'/'.$row->appliance_id); ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
              </td>
            </tr>
            <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_tambah_connection; ?>
<div id="tempat-modal"></div>
<?php show_my_confirm('konfirmasiHapus', 'hapus-dataApplianceDevice', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php show_my_confirm('konfirmasiSwitch', 'update-dataApplianceDevice', 'Confirm'); ?>