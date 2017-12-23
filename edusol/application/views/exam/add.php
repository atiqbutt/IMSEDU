        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Exam</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Section Wise</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="error_box text-center bg-red" style="display:none;">
                      Teacher is not allocated to this subject.
                    </div>
                    <br>
                    <form class="form-horizontal form-label-left" action="<?php echo $base_url;?>exam/premark" method="post">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch">Branch<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="branch" class="form-control col-md-7 col-xs-12" name="branch" required="required">
                            <option value=''>Select Branch</option>
                            <?php foreach($branch as $k=>$v){ ?>
                            <option value='<?php echo $v['id']; ?>'><?php echo $v['name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class">Class<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="class" class="form-control col-md-7 col-xs-12" name="class" required="required">
                            <option value=''>Select Class</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section">Section<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="section" class="form-control col-md-7 col-xs-12" name="section" required="required">
                            <option value=''>Select Section</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject">Subject<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="subject" class="form-control col-md-7 col-xs-12" name="subject" required="required">
                            <option value=''>Select Subject</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exam">Exam<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="exam" class="form-control col-md-7 col-xs-12" name="exam" required="required">
                            <option value=''>Select Exam</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="session">Session<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="session" class="form-control col-md-7 col-xs-12" name="session" required="required">
                            <option value=''>Select Session</option>
                            <?php foreach ($session as $key => $value) {
                                echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                            } ?>
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success pull-right" disabled="disabled">Submit</button>
                        </div>
                      </div>
                    </form>
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
        $(document).ready(function(){
            $(document).on("change","#branch",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/classs/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $("#class").html(pre+d);
                });
            });
            $(document).on("change","#class",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/section/role/"+value,{},function(d){
                    var pre = '<option value="">Select Section</opiton>';
                    $("#section").html(pre+d);
                });
                $.get("<?php echo base_url(); ?>load/exam/"+value,{},function(d){
                    var pre = '<option value="">Select Exam</opiton>';
                    $("#exam").html(pre+d);
                });
            });
            $(document).on("change","#section",function(){
                var value = $(this).val();
                var classi = $("#class").val();
                $.get("<?php echo base_url(); ?>load/subject_sectionwise/"+classi+"/"+value,{},function(d){
                    var pre = '<option value="">Select Subject</opiton>';
                    $("#subject").html(pre+d);
                });
            });
            $(document).on("change","#subject",function(){
                var value = $(this).val();
                var c = $("#class").val();
                var s = $("#section").val();
                $.get("<?php echo base_url(); ?>load/CheckTeacherAllocation/"+c+"/"+s+"/"+value,{},function(d){
                    if(d=="1")
                    {
                      $(".error_box").attr("style","display:none;");
                      $("#send").prop("disabled",false);
                    }else{
                      $("#send").prop("disabled",true);
                      $(".error_box").attr("style","display:block;");
                    }
                });
            });
        });
    </script>
  </body>
</html>