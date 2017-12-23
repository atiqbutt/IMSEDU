<style>
  .my_dashboard_tiles .tile_stats_count:nth-child(7):before {
      border-left: 0 !important;
  }
  .my_dashboard_tiles .tile_stats_count:nth-child(13):before {
      border-left: 0 !important;
  }
  .my_dashboard_tiles .tile_stats_count:nth-child(19):before {
      border-left: 0 !important;
  }
</style>
        <!-- page content -->
        <div class="right_col" role="main">
           <div class="row">
              <?php $branch=$this->user_model->getBranch();$date=date('Y-m-d'); if($this->user_model->is_super()) { $cash_deposit_today=$this->db->query("SELECT SUM( amount ) AS total FROM  `cash_deposit` WHERE  main_head_id =5 and `date`='$date' and is_delete='0'")->result_array()[0]['total']; } else { $cash_deposit_today=$this->db->query("SELECT SUM( amount ) AS total FROM  `cash_deposit` WHERE  main_head_id =5 and `date`='$date' and `branch`=$branch and is_delete='0'")->result_array()[0]['total']; } $cash_deposit_today=($cash_deposit_today==''?0:$cash_deposit_today); ?>
              <a class="btn btn-primary pull-right" href="<?php $income=($total['today_fee_recieved']==''?0:$total['today_fee_recieved']); $expense=($total['today_expense']==''?0:$total['today_expense']);$total_students=($total['student']==''?0:$total['student']);$cash_hand=($total['cash_hand']==''?0:$total['cash_hand']); echo base_url().'SmsHajana/sendClosingSms'.'?income='.$income.'&expense='.$expense.'&students='.$total_students.'&cash_deposit='.$cash_deposit_today.'&cash_hand='.$cash_hand; ?>" >Send Closing Message</a>
          </div>
          <!-- top tiles -->
          <div class="row tile_count my_dashboard_tiles">
            <?php 
                $this->db->select('dashboard_widgets.code');
                $this->db->join('dashboard_permissions','dashboard_permissions.widget_id=dashboard_widgets.id');
                $this->db->where('dashboard_widgets.section_id',1)->where('dashboard_widgets.is_delete',0)->where('dashboard_permissions.user_id',$this->user_model->userInfo("id")['id']);
                $code=@$this->db->order_by('order','asc')->get('dashboard_widgets')->result_array();
                foreach ($code as $key => $value) {                    
                    eval("?> $value[code] <?php ");
                }
            ?>
            
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Total Admissions <small>Students</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                  <div style="width: 100%;">
                    <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Total Attendance</h2>
                    <div class="clearfix"></div>
                  </div>

                 <h5><?php echo date('d-M-Y');?></h5>
                  <div class="row">
                    <div class="col-md-10 col-sm-11 col-xs-6">
                      <p>Present</p>
<?php
                        @$present=($att_present['att_count']/$total['student'])*100;
                        @$absent=($att_absent['att_count']/$total['student'])*100;
                        @$leave=($att_leave['att_count']/$total['student'])*100;
                        @$shortleave=($att_shortleave['att_count']/$total['student'])*100;
                      ?>
                      <div class="">
                        <div class="progress progress_sm">
                          <div class="progress-bar bg-green"  role="progressbar" data-transitiongoal="<?php echo round($present);?>"></div>
                        </div>
                             </div>
                    </div>
                        <div class="col-md-2"><?php echo round($present);?>%</div>
                    </div>
                    <div class="row">
                    <div>
                      <div class="col-md-10 col-sm-11 col-xs-6">
                        <p>Absent</p>
                        <div class="progress progress_sm">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo round($absent);?>"></div>
                        </div>
                      </div>
                      <div class="col-md-2"><?php echo round($absent);?>%</div>
                    </div>
                  </div>
                  <div class="row">
                    <div>
                      <div class="col-md-10 col-sm-11 col-xs-6">
                        <p>Leave</p>
                        <div class="progress progress_sm">
                          <div class="progress-bar bg-green" role="progressbar" style="width: <?php echo round($leave);?>;" data-transitiongoal="<?php $att_leave['att_count'];?>"></div>
                        </div>
                      </div>
                      <div class="col-md-2"><?php echo round($leave);?>%</div>
                    </div>
                  </div>
                  <div class="row">
                    <div>
                      <div class="col-md-10 col-sm-11 col-xs-6">
                        <p>Short Leave</p>
                        <div class="progress progress_sm" style="width: <?php $att_shortleave['std_count'];?>;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo round($shortleave);?>"></div>
                        </div>
                      </div>
                      <div class="col-md-2"><?php echo round($shortleave);?>%</div>
                    </div>
                  </div>
                  

                 

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          
          <br />
		      <div class="row tile_count my_dashboard_tiles section-2">
            
            <?php 
                $this->db->select('dashboard_widgets.code');
                $this->db->join('dashboard_permissions','dashboard_permissions.widget_id=dashboard_widgets.id');
                $this->db->where('dashboard_widgets.section_id',2)->where('dashboard_widgets.is_delete',0)->where('dashboard_permissions.user_id',$this->user_model->userInfo("id")['id']);
                $code=@$this->db->order_by('order','asc')->get('dashboard_widgets')->result_array();
                foreach ($code as $key => $value) {                    
                    eval("?> $value[code] <?php ");
                }
            ?>
            
          </div>
          <div class="row ">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Total Branches</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <h4>Total Student Branch Wise</h4>
                 <!-- Branch Wise Student--> 
                 <?php  foreach ($branches as  $value) {
                   ?>
                 <div class="widget_summary">
                    <div class="w_left w_25">
                      <span><?php echo $value['bname']; ?></span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?php echo $value['std_count']; ?>" aria-valuemin="0" aria-valuemax="100%" style="width: <?php echo $value['std_count']; ?>%;">
                          <span class="sr-only"><?php echo $value['std_count']; ?> Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span><?php echo $value['std_count']; ?></span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                    <?php }?>
                  <!-- Branch Wise Student-->
                
                 
                 
                 

                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Budget</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Top 5</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                          <p class="">Branches</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                          <p class="">Budget</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Mirpur</p>
                            </td>
                            &nbsp;
                            <td>30%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Ghotki</p>
                            </td>
                            &nbsp;
                            <td>10%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Sakhhar</p>
                            </td>
                            &nbsp;
                            <td>20%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Faizabad</p>
                            </td>
                            &nbsp;
                            <td>15%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Others</p>
                            </td>
                            &nbsp;
                            <td>30%</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Quick Settings</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="quick-list">
                      <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                      </li>
                      <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                      </li>
                    </ul>

                    <div class="sidebar-widget">
                      <h4>Online User</h4>
                      <canvas width="150" height="80" id="foo" class="" style="width: 160px; height: 100px;"></canvas>
                      <div class="goal-wrapper">
                        <span class="gauge-value pull-left"></span>
                        <span id="gauge-text" class="gauge-value pull-left">3</span>
                        <span id="goal-text" class="goal-value pull-right">50</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            EduSolutions
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url(); ?>assets/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url(); ?>assets/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url(); ?>assets/js/flot/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/date.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/curvedLines.js"></script>
    <!-- jVectorMap -->
    <script src="<?php echo base_url(); ?>assets/js/maps/jquery-jvectormap-2.0.3.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/build/js/custom.min.js"></script>

    <!-- Flot -->
        <script>
      $(document).ready(function() {
        var data1 = [
         <?php 
    $year=date('Y');
          for($i = 1; $i <= 12; $i++) {
            $v = 0;
            foreach ($graph_studentlast as $key => $value) {
              if($i==$value['MonthNum'])
              {
                $v = $value['count'];
                break;
              }
              else
                $v = 0;
            }
            if($i==12)
                echo "[gd($year, $i), $v]";
              else
                echo "[gd($year, $i), $v],";
          }
?>
        ];

        var data2 = [
<?php 
         $year=date('Y');
          if(!empty($graph_student)){
          for($i = 1; $i <= 12; $i++) {
            $v = 0;
           
            foreach ($graph_student as $key => $value) {
              if($i==$value['MonthNum'])
              {
                $v = $value['count'];
                break;
              }
              else
                $v = 0;
            }
          
            if($i==12)
                echo "[gd($year, $i), $v]";
              else
                echo "[gd($year, $i), $v],";
          }
          }
?>
];
        $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
          data1, data2
        ], {
          series: {
            lines: {
              show: false,
              fill: true
            },
            splines: {
              show: true,
              tension: 0.4,
              lineWidth: 1,
              fill: 0.4
            },
            points: {
              radius: 0,
              show: true
            },
            shadowSize: 2
          },
          grid: {
            verticalLines: true,
            hoverable: true,
            clickable: true,
            tickColor: "#d5d5d5",
            borderWidth: 1,
            color: '#fff'
          },
          colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
          xaxis: {
            tickColor: "rgba(51, 51, 51, 0.06)",
            mode: "time",
            tickSize: [1, "month"],
            //tickLength: 10,
            axisLabel: "Date",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 10
          },
          yaxis: {
            ticks: 8,
            tickColor: "rgba(51, 51, 51, 0.06)",
          },
          tooltip: false
        });

        function gd(year, month) {
          return new Date(year, month - 1).getTime();
        }
      });
    </script>
    <!-- /Flot -->

    <!-- jVectorMap -->
    <script src="<?php echo base_url(); ?>assets/js/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/maps/jquery-jvectormap-us-aea-en.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/maps/gdp-data.js"></script>
    <script>
      $(document).ready(function(){
        $('#world-map-gdp').vectorMap({
          map: 'world_mill_en',
          backgroundColor: 'transparent',
          zoomOnScroll: false,
          series: {
            regions: [{
              values: gdpData,
              scale: ['#E6F2F0', '#149B7E'],
              normalizeFunction: 'polynomial'
            }]
          },
          onRegionTipShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
    </script>
    <!-- /jVectorMap -->

    <!-- Skycons -->
    <script>
      $(document).ready(function() {
        var icons = new Skycons({
            "color": "#73879C"
          }),
          list = [
            "clear-day", "clear-night", "partly-cloudy-day",
            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
            "fog"
          ],
          i;

        for (i = list.length; i--;)
          icons.set(list[i], list[i]);

        icons.play();
      });
    </script>
    <!-- /Skycons -->

    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function(){
        var options = {
          legend: false,
          responsive: false
        };

        new Chart(document.getElementById("canvas1"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Symbian",
              "Blackberry",
              "Other",
              "Android",
              "IOS"
            ],
            datasets: [{
              data: [15, 20, 30, 10, 30],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA"
              ]
            }]
          },
          options: options
        });
      });
    </script>
    <!-- /Doughnut Chart -->
    
    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->

    <!-- gauge.js -->
    <script>
      var opts = {
          lines: 12,
          angle: 0,
          lineWidth: 0.4,
          pointer: {
              length: 0.75,
              strokeWidth: 0.042,
              color: '#1D212A'
          },
          limitMax: 'false',
          colorStart: '#1ABC9C',
          colorStop: '#1ABC9C',
          strokeColor: '#F0F3F3',
          generateGradient: true
      };
      var target = document.getElementById('foo'),
          gauge = new Gauge(target).setOptions(opts);

      gauge.maxValue = 6000;
      gauge.animationSpeed = 32;
      gauge.set(3200);
      gauge.setTextField(document.getElementById("gauge-text"));
    </script>
    
    <!-- /gauge.js -->
  </body>
</html>