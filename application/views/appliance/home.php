<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
  <?php echo $error;?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-6" style="padding: 0;">
      <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-appliance"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Posisi</th>
          <th>Watt</th>
          <th>Created</th>
          <th>Updated</th>
          <th>Photo</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-appliance">

      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_tambah_appliance; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataAppliance', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Posisi';
  $data['url'] = 'Posisi/import';
  echo show_my_modal('modals/modal_import', 'import-posisi', $data);
?>