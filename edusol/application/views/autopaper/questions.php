        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Questions</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Question</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url;?>autopaper/get_question" method="post">

                      <!--<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch">Branch <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="branch" name="branch" class="form-control" required="true">
                            <option value="">Select Branch</option>
                          <?php
                                 
                              foreach ($branch as $value) {
                  ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name;?></option>

                  <?php } ?>

                          </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class">Class <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="class" name="class" class="form-control" required="true">
                            <option value="">Select Class</option>
                          </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject">Subject <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="subject" name="subject" class="form-control" required="true">
                            <option value="">Select Subject</option>
                          </select>
                        </div>
                      </div>-->
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Question Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="question" name="question" class="form-control" required="true">
                            <option value="">Select Question Type</option>
                          <?php
                          $this->db->where('is_delete','0');
                          $type=$this->db->get('question_type')->result();       
                              foreach ($type as $value) {
                  ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name?></option>

                  <?php } ?>

                          </select>
                        </div>
                      </div>
                      
                      

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success pull-right">Submit</button>
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
        $(document).ready(function(){
            $(document).on("change","#branch",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/classs/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $("#class").html(pre+d);
                });
            });
            
        });
    </script>
<script>
        $(document).ready(function(){
            $(document).on("change","#class",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/subagainstclass/"+value,{},function(d){
                    var pre = '<option value="">Select Subject</opiton>';
                    $("#subject").html(pre+d);
                });
            });
            
        });
    </script>

  </body>
</html>