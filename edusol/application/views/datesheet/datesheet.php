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
                    <h2>Create Datesheet</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?php echo base_url(); ?>Exam/add_datesheet" class="form-horizontal form-bordered" method="post">
                      
                                            <div class="form-group">
                        <label class="col-md-3 control-label" for="inputSuccess">Select Branch</label>
                        <div class="col-md-6">
                          
                                                <select id="branch" name="branch" required="" class="form-control">
                      <option value="">Select Branch</option>    
                                                    <?php foreach($branch as $value) { ?>
                                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                                    <?php } ?>
                                              
                  </select>
                              
                          
                        </div>
                      </div>
                                           
                                             <!-- <div class="form-group">
                        <label class="col-md-3 control-label" for="inputSuccess">Select Class</label>
                        <div class="col-md-6">
                          <div id="class_dropdown">
                            <div class="form-control">
                              Select Class First
                            </div>        
                              </div>
                              
                          
                        </div>
                      </div> -->
                                             <div class="form-group">
                        <label class="col-md-3 control-label" for="inputSuccess">Class</label>
                        <div class="col-md-6">
                                            <select name="class" id="class" class="form-control" required>
                <option value="">Select class</option>
              </select>
              <span id="class_loader"></span> 
                                
                        </div>
                      </div> 
                                             <div class="form-group">
                        <label class="col-md-3 control-label" for="inputSuccess">Section</label>
                        <div class="col-md-6">
                                            <select name="section" id="section" class="form-control" required>
                <option value="">Select Section</option>
              </select>
              <span id="section_loader"></span> 
                                
                        </div>
                      </div> 
                                            

                                            <div class="form-group">
                        <label class="col-md-3 control-label" for="inputSuccess">Subject</label>
                        <div class="col-md-6">
                                            <select name="subject" id="subject" class="form-control" required>

                <option value="">Select subject</option>
              </select>
                                
                        </div>
                      </div>
                                            
                        
                        <div class="form-group">
                        <label class="col-md-3 control-label" for="inputSuccess">Exam Type</label>
                        <div class="col-md-6">
                                            <select name="exam" id="exam" class="form-control" required>
                                            <option value="">Select Exam Type </option>
                                              
                                                                      </select>
                                
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputSuccess">Exam Date</label>
                        <div class="col-md-6">
                                                <input type="date" name="date" class="form-control" required="">
                                
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputSuccess">Exam Day</label>
                        <div class="col-md-6">
                                                <input type="text" name="day" class="form-control" required="">
                                
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputSuccess">Time Start</label>
                        <div class="col-md-6">
                                                <input type="time" name="time_start" class="form-control" required="">
                                
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputSuccess">Time End</label>
                        <div class="col-md-6">
                                                <input type="time" name="time_end" class="form-control" required="">
                                
                        </div>
                    </div>

                       
            <div class="row">
                                        <button class="btn btn-success col-lg-offset-8" type="submit" name="submit">Submit</button>
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
    <!-- Chart.js - ->
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
        $(document).on("change","#branch",function(){
          var val = $(this).val();
          $.get("<?php echo base_url(); ?>Load/classs/role/"+val,{},function(data){
            var pre = "<option value=''>Select Class</option>";
            $("#class").html(pre+data);
          });
        });
        $(document).on("change","#class",function(){
          var val = $(this).val();
          $.get("<?php echo base_url(); ?>Load/section/role/"+val,{},function(data){
            var pre = "<option value=''>Select Section</option>";
            $("#section").html(pre+data);
          });
          $.get("<?php echo base_url(); ?>Load/exam/"+val,{},function(data){
            var pre = "<option value=''>Select Exam</option>";
            $("#exam").html(pre+data);
          });
        });
        $(document).on("change","#section",function(){
          var val = $(this).val();
          var c = $("#class").val();
          $.get("<?php echo base_url(); ?>Load/subject/"+c+"/"+val,{},function(data){
            var pre = "<option value=''>Select Subject</option>";
            $("#subject").html(pre+data);
          });
        });
      });
    </script>

  </body>
</html>