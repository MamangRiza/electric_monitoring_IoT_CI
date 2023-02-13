<?php
  $no = 1;
  foreach ($dataConfig as $config) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $config->cost; ?></td>
      <td class="text-center" style="width:10px;">
          <button class="btn btn-warning update-dataConfig" data-id="<?php echo $config->config_id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
      </td>
      <td>
          <a href="<?php echo base_url('Device/hapusdatapenggunaanconfig/ESPTEST1'); ?>" ><button class="form-control btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus Data Penggunaan</button></a>
      </td>
    </tr>
    <?php
    $no++;
  }
?>