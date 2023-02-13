<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="box">
  <div class="box-header">
    <div class="col-md-6" style="padding: 0;">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#export-excel"><i class="glyphicon glyphicon-floppy-save"></i> Export Excel</button>
    </div>
    <div class="col-md-3" style="padding: 1;">
        <a href="<?php echo base_url('Device/hapusdatachart/'.$dataDevice->device_id); ?>" ><button class="form-control btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus Data Live Chart</button></a>
    </div>
    <div class="col-md-3" style="padding: 0;">
        <a href="<?php echo base_url('Device/hapusdatapenggunaan/'.$dataDevice->device_id); ?>" ><button class="form-control btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus Data Penggunaan</button></a>
    </div>
  </div>
  <div class="box-body">
    <div class="col-lg-6">
      <div id="chartVolt" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
    </div>
    <div class="col-lg-6">
      <div id="chartAmpere" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
    </div>
    <div class="col-lg-6">
      <div id="chartWatt" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
    </div>
    <div class="col-lg-6">
      <div id="chartKwh" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
    </div>
    <div class="col-lg-12">
      <div id="chartmonthusage" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
    </div>
    <div class="col-lg-12">
      <div id="chartmonthcost" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
    </div>
  </div>
</div>
  <!-- /.box-header -->
  <div class="row">
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
    </div>

    <div class="col-lg-12 col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <i class="fa fa-bolt"></i>
          <h3 class="box-title">Today Period</h3>

        </div>
        <div class="box-body">
          <table id="table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>First Time</th>
                <th>Last Time</th>
                <th>Total Time</th>
                <th>Kwh</th>
                <th>Cost</th>
                <th>Total Cost</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php echo $modal_tambah_device; ?>

<div id="tempat-modal"></div>

<script src="<?php echo base_url(); ?>assets/plugins/canvasjs/jquery.canvasjs.min.js"></script>
<script type="text/javascript">
        $(document).ready(function () {

                var chart = new CanvasJS.Chart("chartVolt", {
                  theme: "light2",
                  exportEnabled: true,
                  title:{
                    text: "Live Chart Voltage"
                  },
                  axisY: {
                    suffix: "A"
                  },
                    data: [
                        {
                            yValueFormatString: "#,##0.0V",
                            color: "rgba(40,175,101,0.6)",
                            type: "area",
                            dataPoints: null
                        }
                    ]
                });

                $.getJSON("<?php echo base_url('Device/jsondatavolt/'.$dataDevice->device_id); ?>", function (result) {
                  
                  chart.options.data[0].dataPoints = result;
                  chart.render(); 
                });

                var updateChart = function() {
                            
                  $.getJSON("<?php echo base_url('Device/jsondatavolt/'.$dataDevice->device_id); ?>", function (result) {
                  
                    chart.options.data[0].dataPoints = result;
                    chart.render(); 
                  
                  });   
                }            
                setInterval(function(){updateChart()},1000);
        });
    </script>
    <script type="text/javascript">
            $(document).ready(function () {

                    var chart = new CanvasJS.Chart("chartAmpere", {
                      theme: "light2",
                      exportEnabled: true,
                      title:{
                        text: "Live Chart Current"
                      },
                      axisY: {
                        suffix: "A"
                      },
                        data: [
                            {
                              yValueFormatString: "#,##0.00A",
                                color: "rgba(195, 9, 9, 1)",
                                type: "area",
                                dataPoints: null
                            }
                        ]
                    });

                    $.getJSON("<?php echo base_url('Device/jsondataampere/'.$dataDevice->device_id); ?>", function (result) {
                      
                      chart.options.data[0].dataPoints = result;
                      chart.render(); 
                    });

                    var updateChart = function() {
                                
                      $.getJSON("<?php echo base_url('Device/jsondataampere/'.$dataDevice->device_id); ?>", function (result) {
                      
                        chart.options.data[0].dataPoints = result;
                        chart.render(); 
                      
                      });   
                    }            
                    setInterval(function(){updateChart()},1000);
            });
        </script>
        <script type="text/javascript">
                $(document).ready(function () {

                        var chart = new CanvasJS.Chart("chartWatt", {
                          theme: "light2",
                          exportEnabled: true,
                          title:{
                            text: "Live Chart Power"
                          },
                          axisY: {
                            suffix: "W"
                          },
                            data: [
                                {
                                  yValueFormatString: "#,##0.0W",
                                    color: "rgba(195, 99, 9, 1)",
                                    type: "area",
                                    dataPoints: null
                                }
                            ]
                        });

                        $.getJSON("<?php echo base_url('Device/jsondatawatt/'.$dataDevice->device_id); ?>", function (result) {
                          
                          chart.options.data[0].dataPoints = result;
                          chart.render(); 
                        });

                        var updateChart = function() {
                                    
                          $.getJSON("<?php echo base_url('Device/jsondatawatt/'.$dataDevice->device_id); ?>", function (result) {
                          
                            chart.options.data[0].dataPoints = result;
                            chart.render(); 
                          
                          });   
                        }            
                        setInterval(function(){updateChart()},1000);
                });
            </script>
            <script type="text/javascript">
                    $(document).ready(function () {

                            var chart = new CanvasJS.Chart("chartKwh", {
                              theme: "light2",
                              exportEnabled: true,
                              title:{
                                text: "Live Chart Energy"
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

                            $.getJSON("<?php echo base_url('Device/jsondatakwh/'.$dataDevice->device_id); ?>", function (result) {
                              
                              chart.options.data[0].dataPoints = result;
                              chart.render(); 
                            });

                            var updateChart = function() {
                                        
                              $.getJSON("<?php echo base_url('Device/jsondatakwh/'.$dataDevice->device_id); ?>", function (result) {
                              
                                chart.options.data[0].dataPoints = result;
                                chart.render(); 
                              
                              });   
                            }            
                            setInterval(function(){updateChart()},1000);
                    });
                </script>
                <script type="text/javascript">
                        $(document).ready(function () {

                                var chart = new CanvasJS.Chart("chartmonthusage", {
                                  theme: "light2",
                                  exportEnabled: true,
                                  title:{
                                    text: "This Month Usage"
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

                                $.getJSON("<?php echo base_url('Device/jsondatamonthusage/'.$dataDevice->device_id); ?>", function (result) {
                                  
                                  chart.options.data[0].dataPoints = result;
                                  chart.render(); 
                                });

                                var updateChart = function() {
                                            
                                  $.getJSON("<?php echo base_url('Device/jsondatamonthusage/'.$dataDevice->device_id); ?>", function (result) {
                                  
                                    chart.options.data[0].dataPoints = result;
                                    chart.render(); 
                                  
                                  });   
                                }            
                                setInterval(function(){updateChart()},1000);
                        });
                    </script>
                    <script type="text/javascript">
                            $(document).ready(function () {

                                    var chart = new CanvasJS.Chart("chartmonthcost", {
                                      theme: "light2",
                                      exportEnabled: true,
                                      title:{
                                        text: "This Month Cost"
                                      },
                                      axisY: {
                                        prefix: "Rp."
                                      },
                                        data: [
                                            {
                                              yValueFormatString: "#,##0.0 Rupiah",
                                                color: "rgba(9, 18, 195, 1)",
                                                type: "area",
                                                dataPoints: null
                                            }
                                        ]
                                    });

                                    $.getJSON("<?php echo base_url('Device/jsondatamonthcost/'.$dataDevice->device_id); ?>", function (result) {
                                      
                                      chart.options.data[0].dataPoints = result;
                                      chart.render(); 
                                    });

                                    var updateChart = function() {
                                                
                                      $.getJSON("<?php echo base_url('Device/jsondatamonthcost/'.$dataDevice->device_id); ?>", function (result) {
                                      
                                        chart.options.data[0].dataPoints = result;
                                        chart.render(); 
                                      
                                      });   
                                    }            
                                    setInterval(function(){updateChart()},1000);
                            });
                        </script>
<script type="text/javascript">
$( document ).ready(function() {
var table = $('#table').DataTable( {
"ajax": "<?php echo base_url('Device/tampilperiod/'.$dataDevice->device_id); ?>",
"bPaginate":true,
"pageLength": 10,
"columns": [
{ mData: 'first_time' } ,
{ mData: 'last_time' },
{ mData: 'total_time',
mRender: $.fn.dataTable.render.number(',', ' s ', '.') },
{ mData: 'kwh' },
{ mData: 'cost',
render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' ) },
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
var table = $('#today').DataTable( {
"ajax": "<?php echo base_url('Device/tampiltoday/'.$dataDevice->device_id); ?>",
"bPaginate":false,
"ordering": false,
"info": false,
"searching": false,
"columns": [
{ mData: 'kwh', render: $.fn.dataTable.render.number( ',', '.', 3, '' ) } ,
{ mData: 'total_time', mRender: $.fn.dataTable.render.number(',', ' s ', '.') } ,
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
"ajax": "<?php echo base_url('Device/tampilthisweek/'.$dataDevice->device_id); ?>",
"bPaginate":false,
"ordering": false,
"info": false,
"searching": false,
"columns": [
{ mData: 'kwh', render: $.fn.dataTable.render.number( ',', '.', 3, '' ) } ,
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
"ajax": "<?php echo base_url('Device/tampilthismonth/'.$dataDevice->device_id); ?>",
"bPaginate":false,
"ordering": false,
"info": false,
"searching": false,
"columns": [
{ mData: 'kwh', render: $.fn.dataTable.render.number( ',', '.', 3, '' ) } ,
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
"ajax": "<?php echo base_url('Device/tampilyesterday/'.$dataDevice->device_id); ?>",
"bPaginate":false,
"ordering": false,
"info": false,
"searching": false,
"columns": [
{ mData: 'kwh', render: $.fn.dataTable.render.number( ',', '.', 3, '' ) } ,
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
"ajax": "<?php echo base_url('Device/tampillastweek/'.$dataDevice->device_id); ?>",
"bPaginate":false,
"ordering": false,
"info": false,
"searching": false,
"columns": [
{ mData: 'kwh', render: $.fn.dataTable.render.number( ',', '.', 3, '' ) } ,
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
"ajax": "<?php echo base_url('Device/tampillastmonth/'.$dataDevice->device_id); ?>",
"bPaginate":false,
"ordering": false,
"info": false,
"searching": false,
"columns": [
{ mData: 'kwh', render: $.fn.dataTable.render.number( ',', '.', 3, '' ) } ,
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
