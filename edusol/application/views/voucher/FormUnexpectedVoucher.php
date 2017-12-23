        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Vouchers</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Unexpected fee Vouchers</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>voucher/creatingUnexpectedVoucher" method="post">

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch">Branch <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="branch" class="form-control col-md-7 col-xs-12 must-fill" name="branch" required="required">
                            <option value="">Select branch</option>
                            <?php foreach ($branch as $key => $value) {
                              echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                            } ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class">Class <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="class" class="form-control col-md-7 col-xs-12 must-fill" name="class" required="required">
                            <option value="">Select Class</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                            <label for="section" class="control-label col-md-3 col-sm-3 col-xs-12">Section<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="section" class="form-control col-md-7 col-xs-12 must-fill" required id="section">
                                    <option value="">Select Section</option>
                                </select>
                            </div>
                      </div>
                      <div class="form-group">
                            <label for="session" class="control-label col-md-3 col-sm-3 col-xs-12">Session<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="session" class="form-control col-md-7 col-xs-12 must-fill" onchange="$('#section').trigger('change')" required id="session">
                                    <option value="">Select Session</option>
                                    <?php foreach ($session as $key => $value) {
                                        echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                    } ?>
                                </select>
                            </div>
                      </div>
                      <div class="form-group">
                            <label for="session" class="control-label col-md-3 col-sm-3 col-xs-12">Student<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="student" class="form-control col-md-7 col-xs-12 must-fill" required id="student">
                                    <option value="">Select Student</option>
                                </select>
                            </div>
                      </div>
                      <div class="ln_solid"></div>
                      <h3>Other Fee</h3>
                      <div id="fee_wrapper" class="row">
                        <div class="col-md-offset-3 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-control col-md-7 col-xs-12">
                            Select Above Values to show other fee's
                          </div>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success" disabled>Create</button>
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

    <script>
      $(function(){
        $(document).on("change","#branch", function(){
          var val = $(this).val();
          $.get("<?php echo base_url(); ?>load/classs/role/"+val,{},function(ret){
            var d = '<option value="">Select Class</option>';
            $("#class").html(d+ret);
          });
        });
        $(document).on("change","#class",function(){
          var val = $(this).val();
          $.get("<?php echo $base_url; ?>load/section/role/"+val,{},function(ret){
            var pre = "<option value=''>Select Section</option>";
            $("#section").html(pre+ret);
          });
        });
        $(document).on("change","#section",function(){
          var branch= $('#branch').val();
          var classs = $('#class').val();
          var section = $(this).val();
          var session= $('#session').val();

          $.get("<?php echo $base_url; ?>load/students/"+branch+"/"+classs+"/"+section+"/"+session,{},function(ret){
            var pre = "<option value=''>Select Student</option>";
            $("#student").html(pre+ret);
          });
        });
        $(document).on("change",".must-fill",function(){
            var branch= $('#branch').val();
            var classs = $('#class').val();
            var section = $(this).val();
            var session= $('#session').val();
            var student= $('#student').val();
            if(branch!='' && classs!='' && section!='' && session!='' && student!='') {
              $('#send').prop('disabled',false);
            }
        });
        $(document).on("change","#class", function(){
          var val = $(this).val();
          $.get("<?php echo base_url(); ?>load/other_fee/"+val,{},function(ret){
            $("#fee_wrapper").html(ret);
          });
        });
      });
    </script>
  </body>
</html>