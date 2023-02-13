<?php
  $no = 1;
  foreach ($dataAppliance as $appliance) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $appliance->appliance_name; ?></td>
      <td><?php echo $appliance->watt; ?></td>
      <td><?php echo $appliance->created; ?></td>
      <td><?php echo $appliance->updated; ?></td>
      <td class="text-center"><a href="<?php echo base_url(); ?>assets/img/<?php echo $appliance->photo; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/img/<?php echo $appliance->photo; ?>" style="width: 100px">
      </a></td>
      <td class="text-center" style="width:230px;">
        <a class="btn btn-info detail-dataDevice"  href="<?php echo base_url('appliance/training/'.$appliance->appliance_id); ?>"><i class="glyphicon glyphicon-info-sign"></i> Training</a>
        <button class="btn btn-warning update-dataAppliance" data-id="<?php echo $appliance->appliance_id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
