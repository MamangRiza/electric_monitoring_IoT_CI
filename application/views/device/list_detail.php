<?php
  foreach ($dataDetail as $device) {
    ?>
    <tr>
      <td><?php echo $device->device_id ?></td>
      <td><?php echo $device->device_name; ?></td>
      <td><?php echo $device->appliance_name; ?></td>
      <td><?php echo $device->watt; ?></td>
      <td><?php echo $device->ampere; ?></td>
      <td><?php echo $device->volt; ?></td>
      <td><?php echo $device->created; ?></td>
    </tr>
    <?php
  }
?>