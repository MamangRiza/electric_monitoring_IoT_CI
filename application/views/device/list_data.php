<?php
  foreach ($dataDevice as $device) {
    ?>
    <tr>
      <td><?php echo $device->device_id; ?></td>
      <td><?php echo $device->device_name; ?></td>
      <td><?php echo $device->created; ?></td>
      <td><?php echo $device->updated; ?></td>
      <td class="text-center" style="width:290px;">
        <button class="btn btn-warning update-dataDevice" data-id="<?php echo $device->device_id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
        <a class="btn btn-info detail-dataDevice"  href="<?php echo base_url('Device/detail/'.$device->device_id); ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
      </td>
    </tr>
    <?php
  }
?>