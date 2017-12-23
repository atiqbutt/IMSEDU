        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3> Create Paper</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Selection</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

           <form class="form-horizontal form-label-left" action="<?php echo $base_url;?>autopaper/get_question_print" method="post">

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Branch <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="branch" name="branch" class="form-control" required="true">
                            <option value="">Select Branch</option>
                          <?php       
                              foreach ($branch as $value) {
                  ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->name?></option>

                  <?php } ?>

                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Class <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="class" name="class" class="form-control" required>
                            <option value="">Select Class</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Subject <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="subject" name="subject" class="form-control sub" required>
                            <option value="">Select Subject</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chapter<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="chapterpast">

                          </div>
                          <!--<select id="chapter" name="chapter" class="form-control" required>
                            <option value="">Select Chapter</option>
                          </select> -->
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Level<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <select id="level" name="level" class="form-control" required>
                            <option value="">Select Level</option>
                            <option value="Easy">Easy</option>
                            <option value="Medium">Medium</option>
                            <option value="Difficult">Difficult</option>
                          </select>
                        </div>
                      </div>

                      <div class="item form-group row1">
                        <label class="control-label col-md-3 col-sm-3 col-xs-10" for="name">Mcq's<span class="required">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-10">
                                <input type="number" name="mcq" class="form-control" required>
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-5" for="name">Mcq Marks<span class="required">*</span>
                        </label>

                        <div class="col-md-2 col-sm-3 col-xs-2">
                                <input type="number" name="mcq_marks" class="form-control" required>
                        </div>

                      </div>
                      <div class="item form-group row1">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Short Question<span class="required">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="short" class="form-control" required>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Short Question Marks<span class="required">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="short_marks" class="form-control" required>
                        </div>
                      </div>
                      <div class="item form-group row1">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Long Question<span class="required">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="long" class="form-control" required>
                        </div>

                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Long Question Marks<span class="required">*</span>
                        </label>

                        <div class="col-md-2 col-sm-2 col-xs-5">
                                <input type="number" name="long_marks" class="form-control" required>
                        </div>
                      </div>
                      

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success pull-right">Add</button>
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
                $.get("<?php echo base_url(); ?>load/subjectforpaper/"+value,{},function(d){
                    var pre = '<option value="">Select Subject</opiton>';
                    $("#subject").html(pre+d);
                });
            });
            
        });


       
    
                                
</script>
<script type="text/javascript">
  

        

                $('#subject').change(function(){
          var id=$('#class').val();
          var idsub=$('#subject').val();

          $.ajax({
                    url: "<?php echo base_url(); ?>load/questionagainstchpter_checkbox/"+id+"/"+idsub,
                    data: {},
                      success: function( result ) {
                          $( "#chapterpast" ).html(result);
  }
});

        });
         
</script>
  </body>
</html>