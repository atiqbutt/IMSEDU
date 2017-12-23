<style>
p{
    padding-top:8px;
}
</style>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Fee Detail</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Fee History</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <h1>Fee History</h1>
                            <h3>Fee Row # <?php echo $detail['id']; ?></h3>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 form-horizontal">
                            <h2 class="control-label"><?php echo $detail['name']; ?></h2>
                            <h3 class="control-label"><?php echo $detail['contact']; ?></h3>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <img src="<?php echo base_url().$detail['b_logo']; ?>" width="100" height="100" alt="">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="row form-horizontal">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <div class="">
                                <p class="col-md-2 col-sm-2 col-xs-12"><strong>GR. No.</strong></p>
                                <p class="col-md-10 col-sm-10 col-xs-12"><?php echo $detail['grno']; ?></p>
                            </div>
                            <div class="">
                                <p class="col-md-2 col-sm-2 col-xs-12"><strong>Student</strong></p>
                                <p class="col-md-10 col-sm-10 col-xs-12"><?php echo $detail['student_name']; ?></p>
                            </div>
                            <div class="">
                                <p class="col-md-2 col-sm-2 col-xs-12"><strong>Father</strong></p>
                                <p class="col-md-10 col-sm-10 col-xs-12"><?php echo $detail['father_name']; ?></p>
                            </div>
                            <div class="">
                                <p class="col-md-2 col-sm-2 col-xs-12"><strong>Contact</strong></p>
                                <p class="col-md-10 col-sm-10 col-xs-12"><?php echo $detail['student_contact']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="">
                                <strong class="control-label col-md-9 col-sm-9 col-xs-12">Voucher Date</strong>
                                <p class="col-md-3 col-sm-3 col-xs-12"><?php echo date("d-m-Y"); ?></p>
                            </div>
                            <div class="">
                                
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Month</th>
                                <th>Total Fee</th>
                                <th>Submitted</th>
                                <th>Remaining</th>
                                <th>Arear</th>
                                <th>Advance</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php $i=2; foreach($fee as $k=>$v){ ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php  $monthNum = sprintf("%02s",$date = $v['date']);
                                    $monthName = date("F", strtotime($monthNum));echo $monthName; ?></td>
                                <td><?php echo $v['fee_pack']; ?></td>
                                <td><?php echo $v['recieved']; ?></td>
                                <td><?php echo $v['fee_pack']-$v['recieved']; ?></td>
                                <td><?php if($v['recieved']<$v['fee_pack']){ echo $v['fee_pack']-$v['recieved'];} else{echo "Clear";} ?></td>
                                <td><?php echo $v['advance']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <a target="_blank" href="<?php echo base_url(); ?>voucher/print_history/<?php echo $v['grno']; ?>"><button class="btn btn-primary" type="button">Print</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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

    

  </body>
</html>
