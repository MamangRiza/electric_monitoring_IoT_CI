<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="box">
  <div class="box-header">
    <div class="col-md-3">
        <a href="<?php echo base_url('Pegawai/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
  </div>
  <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Device Name</th>
          <th>Appliance Name</th>
          <th>Watt</th>
          <th>Ampere</th>
          <th>Volt</th>
          <th>Created</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($dataDetail as $device) {
            ?>
            <tr>
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
      </tbody>
    </table>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/canvasjs/jquery.canvasjs.min.js"></script>
<script>
$(document).ready(function() {

var dataPoints1 = [];

var options = {
  title: {
    text: "Kwh Transaction <?php echo "$dataDevice->device_id"; ?>"
  },
  axisX: {
    title: "chart updates every 2 secs"
  },
  axisY: {
    suffix: "Wh",
    includeZero: false
  },
  toolTip: {
    shared: true
  },
  legend: {
    cursor: "pointer",
    verticalAlign: "top",
    fontSize: 22,
    fontColor: "dimGrey",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "line",
    xValueType: "dateTime",
    yValueFormatString: "###.00Wh",
    xValueFormatString: "hh:mm:ss TT",
    showInLegend: true,
    name: "Turbine 1",
    dataPoints: dataPoints1
  }]
};

var chart = $("#chartContainer").CanvasJSChart(options);

function toggleDataSeries(e) {
  if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else {
    e.dataSeries.visible = true;
  }
  e.chart.render();
}

var updateInterval = 6000;
// initial value
var yValue1 = 216;

var time = new Date;
// starting at 10.00 am
time.setHours(20);
time.setMinutes(00);
time.setSeconds(14);
time.setMilliseconds(00);

function updateChart(count) {
  count = count || 1;
  var deltaY1;
  <?php
  foreach ($dataDetail as $data) { ?>
    time.setTime(time.getTime() + updateInterval);
  
    // adding random value and rounding it to two digits. 
    yValue1 = <?php echo "$data->volt"; ?>

    // pushing the new values
    dataPoints1.push({
      x: time.setTime(time.getTime() + updateInterval),
      y: yValue1
    });
  <?php } ?>

  // updating legend text with  updated with y Value 
  options.data[0].legendText = "<?php echo "$dataDevice->appliance_name"; ?> : " + <?php echo "$data->volt"; ?> + "Wh";
  $("#chartContainer").CanvasJSChart().render();
}
// generates first set of dataPoints 
updateChart(100);
setInterval(function () { updateChart() }, updateInterval);

});
</script>

<script>
$(document).ready(function() {

var options = {
  exportEnabled: true,
  animationEnabled: true,
  title: {
    text: "V Transaction <?php echo $dataDevice->device_id; ?>"
  },
  axisY: {
    suffix: "v"
  },
  data: [
  {
    type: "splineArea",
    yValueFormatString: "# v",
    dataPoints: <?php echo $data; ?>
  }
  ]
};
$("#chartContainer").CanvasJSChart(options);

});
</script>