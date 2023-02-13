<?php
  foreach ($dataDevice as $device) {
    ?>
    <tr>
      <td><?php echo $device->device_id; ?></td>
      <td><?php echo $device->device_name; ?></td>
      <td><?php echo $device->kwh_max; ?></td>
      <td><?php echo $device->created; ?></td>
      <td><?php echo $device->updated; ?></td>
      <td class="text-center" style="width:290px;">
        <a class="btn btn-success detail-dataDeviceTraining"  href="<?php echo base_url('Device/deviceappliance/'.$device->device_id.'/'.$appliance_id); ?>"><i class="glyphicon glyphicon-info-sign"></i> Train</a>
      </td>
    </tr>
    <?php
  }
?>