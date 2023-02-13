<div class="row">
  <div class="col-lg-6 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo $jml_device; ?></h3>

        <p>Jumlah Device</p>
      </div>
      <div class="icon">
        <i class="fa fa-bolt"></i>
      </div>
      <a href="<?php echo base_url('Device') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-6 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo $jml_appliance; ?></h3>

        <p>Jumlah Appliance</p>
      </div>
      <div class="icon">
        <i class="fa fa-plug"></i>
      </div>
      <a href="<?php echo base_url('Appliance') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-12 col-xs-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <i class="fa fa-bolt"></i>
        <h3 class="box-title">Statistik <small>Penggunaan Energy</small></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="col-lg-12">
          <div id="chartKwh" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
        </div>
      </div>
    </div>
  </div>

   <div class="col-lg-6">
     <div class="box box-info">
       <div class="box-header with-border">
         <i class="fa fa-bolt"></i>
         <h3 class="box-title">Live Data</h3>
       </div>
       <div class="box-body">
        <table id="today" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Today</th>
              <th>Total Time</th>
              <th>Total Cost</th>
            </tr>
          </thead>
        </table>
        <table id="thisweek" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>This Week</th>
              <th>Total Time</th>
              <th>Total Cost</th>
            </tr>
          </thead>
        </table>
        <table id="thismonth" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>This Month</th>
              <th>Total Time</th>
              <th>Total Cost</th>
            </tr>
          </thead>
        </table>
       </div>
     </div>
   </div>

   <div class="col-lg-6">
     <div class="box box-info">
       <div class="box-header with-border">
         <i class="fa fa-bolt"></i>
         <h3 class="box-title">Past Data</h3>
       </div>
       <div class="box-body">
         <table id="yesterday" class="table table-bordered table-striped">
           <thead>
             <tr>
               <th>Yesterday</th>
               <th>Total Time</th>
               <th>Total Cost</th>
             </tr>
           </thead>
         </table>
         <table id="lastweek" class="table table-bordered table-striped">
           <thead>
             <tr>
               <th>Last Week</th>
               <th>Total Time</th>
               <th>Total Cost</th>
             </tr>
           </thead>
         </table>
         <table id="lastmonth" class="table table-bordered table-striped">
           <thead>
             <tr>
               <th>Last Month</th>
               <th>Total Time</th>
               <th>Total Cost</th>
             </tr>
           </thead>
         </table>
       </div>
     </div>

<script src="<?php echo base_url(); ?>assets/plugins/canvasjs/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
        $(document).ready(function () {

                var chart = new CanvasJS.Chart("chartKwh", {
                  theme: "light2",
                  exportEnabled: true,
                  title:{
                    text: "Energy Usage This Month"
                  },
                  axisY: {
                    suffix: "kWh"
                  },
                    data: [
                        {
                          yValueFormatString: "#,##0.000kWh",
                            color: "rgba(9, 18, 195, 1)",
                            type: "area",
                            dataPoints: null
                        }
                    ]
                });

                $.getJSON("<?php echo base_url('Device/jsondatakwhall'); ?>", function (result) {
                  
                  chart.options.data[0].dataPoints = result;
                  chart.render(); 
                });

                var updateChart = function() {
                            
                  $.getJSON("<?php echo base_url('Device/jsondatakwhall'); ?>", function (result) {
                  
                    chart.options.data[0].dataPoints = result;
                    chart.render(); 
                  
                  });   
                }            
                setInterval(function(){updateChart()},1000);
        });
    </script>
    <script type="text/javascript">
    $( document ).ready(function() {
    var table = $('#today').DataTable( {
    "ajax": "<?php echo base_url('Device/tampiltodayall'); ?>",
    "bPaginate":false,
    "ordering": false,
    "info": false,
    "searching": false,
    "columns": [
    { mData: 'kwh' } ,
    { mData: 'total_time',
    mRender: $.fn.dataTable.render.number(',', ' s ', '.') } ,
    { mData: 'total_cost',
    render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' ) }
    ]
    });
    setInterval( function () {
    table.ajax.reload(null, false);
    }, 1000 );
    });

    </script>

    <script type="text/javascript">
    $( document ).ready(function() {
    var table = $('#thisweek').DataTable( {
    "ajax": "<?php echo base_url('Device/tampilthisweekall'); ?>",
    "bPaginate":false,
    "ordering": false,
    "info": false,
    "searching": false,
    "columns": [
    { mData: 'kwh' } ,
    { mData: "total_time",
    mRender: $.fn.dataTable.render.number(',', ' s ', '.') } ,
    { mData: 'total_cost',
    render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' ) }
    ]
    });
    setInterval( function () {
    table.ajax.reload(null, false);
    }, 1000 );
    });

    </script>

    <script type="text/javascript">
    $( document ).ready(function() {
    var table = $('#thismonth').DataTable( {
    "ajax": "<?php echo base_url('Device/tampilthismonthall'); ?>",
    "bPaginate":false,
    "ordering": false,
    "info": false,
    "searching": false,
    "columns": [
    { mData: 'kwh' } ,
    { mData: 'total_time',
    mRender: $.fn.dataTable.render.number(',', ' s ', '.') } ,
    { mData: 'total_cost',
    render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' ) }
    ]
    });
    setInterval( function () {
    table.ajax.reload(null, false);
    }, 1000 );
    });

    </script>

    <script type="text/javascript">
    $( document ).ready(function() {
    var table = $('#yesterday').DataTable( {
    "ajax": "<?php echo base_url('Device/tampilyesterdayall'); ?>",
    "bPaginate":false,
    "ordering": false,
    "info": false,
    "searching": false,
    "columns": [
    { mData: 'kwh' } ,
    { mData: 'total_time',
    mRender: $.fn.dataTable.render.number(',', ' s ', '.') } ,
    { mData: 'total_cost',
    render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' ) }
    ]
    });
    setInterval( function () {
    table.ajax.reload(null, false);
    }, 1000 );
    });

    </script>

    <script type="text/javascript">
    $( document ).ready(function() {
    var table = $('#lastweek').DataTable( {
    "ajax": "<?php echo base_url('Device/tampillastweekall'); ?>",
    "bPaginate":false,
    "ordering": false,
    "info": false,
    "searching": false,
    "columns": [
    { mData: 'kwh' } ,
    { mData: 'total_time',
    mRender: $.fn.dataTable.render.number(',', ' s ', '.') } ,
    { mData: 'total_cost',
    render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' ) }
    ]
    });
    setInterval( function () {
    table.ajax.reload(null, false);
    }, 1000 );
    });

    </script>

    <script type="text/javascript">
    $( document ).ready(function() {
    var table = $('#lastmonth').DataTable( {
    "ajax": "<?php echo base_url('Device/tampillastmonthall'); ?>",
    "bPaginate":false,
    "ordering": false,
    "info": false,
    "searching": false,
    "columns": [
    { mData: 'kwh' } ,
    { mData: 'total_time',
    mRender: $.fn.dataTable.render.number(',', ' s ', '.') } ,
    { mData: 'total_cost',
    render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' ) }
    ]
    });
    setInterval( function () {
    table.ajax.reload(null, false);
    }, 1000 );
    });

    </script>