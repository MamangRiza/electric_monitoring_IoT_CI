<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
<div class="box">
  <div class="box-header">
  </div>
  <div class="box-body">
    <div class="col-lg-12">
      <div id="chartWatt" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
    </div>
  </div>
</div>


<script type="text/javascript">
  setTimeout(function(){ alert('Training selesai');
  window.location.href= '../../training_result/<?php echo $dataDevice->device_id ?>/<?php echo $dataAppliance->appliance_id ?>';}, 60000);
</script>
<script src="<?php echo base_url(); ?>assets/plugins/canvasjs/jquery.canvasjs.min.js"></script>
        <script type="text/javascript">
                $(document).ready(function () {

                        var chart = new CanvasJS.Chart("chartWatt", {
                          theme: "light2",
                          exportEnabled: true,
                          title:{
                            text: "Live Chart Power (Training)"
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

                        $.getJSON("<?php echo base_url('Device/jsondatawatttraining/'.$dataDevice->device_id.'/'.$dataAppliance->appliance_id); ?>", function (result) {
                          
                          chart.options.data[0].dataPoints = result;
                          chart.render(); 
                        });

                        var updateChart = function() {
                                    
                          $.getJSON("<?php echo base_url('Device/jsondatawatttraining/'.$dataDevice->device_id.'/'.$dataAppliance->appliance_id); ?>", function (result) {
                          
                            chart.options.data[0].dataPoints = result;
                            chart.render(); 
                          
                          });   
                        }            
                        setInterval(function(){updateChart()},1000);
                });
            </script>

