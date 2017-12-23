        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Essay Questions</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Essay Question</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
          <form class="form-horizontal form-label-left" action="<?php echo $base_url;?>autopaper/save_edit_essay" method="post">
                     <input type="hidden" name="id" value="<?php echo $val['id']; ?>">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Branch <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="branch" name="branch" class="form-control" >
                            <option value="">Select Branch</option>
                          <?php       
                              foreach ($branch as $value) { 
                  ?>
                    <option <?php if ($val['branch']==$value->id){ echo "selected";} ?> value="<?php echo $value->id; ?>"><?php echo $value->name?></option>
                  <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Class <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="class" name="class" class="form-control">
                            <option value="">Select Class</option>
                            <?php       
                              foreach ($class as $value) {
                            
                  ?>
                   <option <?php if ($val['class']==$value['class_id']){ echo "selected";} ?> value="<?php echo $value['class_id']; ?>"><?php echo $value['class_name']; ?></option>
                              <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Subject <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="subject" name="subject" class="form-control" required>
                            <option value="">Select Subject</option>
                            <?php       
                              foreach ($subject as $value) {
                  ?>
                   <option <?php if ($val['subject']==$value['id']){ echo "selected";} ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                              <?php }?>
                          </select>
                        </div>
                      </div>
                      
                      <div class="item form-group" id="chapter_div">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chapter<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <select id="chapter" name="chapter" class="form-control" required>
                                <option value="">Select Chapter</option>
                                <?php       
                              foreach ($chapter as $value) {
                  ?>
                             <option <?php if ($val['chapter']==$value['id']){ echo "selected";} ?> value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                              <?php }?>
                          </select>
                        </div>
                      </div>
                       <div class="item form-group" id="level_div">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Level<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <select id="level" name="level" class="form-control" required>
                          
                            <option  value="<?php echo $val['level'] ?>"><?php echo $val['level'] ?></option>
                            <option value="Easy">Easy</option>
                            <option value="Medium">Medium</option>
                            <option value="Difficult">Difficult</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <label class="control-label col-md-3 col-sm-3 col-xs-3" for="name">Question<span class="required">*</span>
                        </label>
                         <div id="keyword_wrapper" class="col-md-7 col-sm-7 col-xs-7">
                                    <div class="row row1">
                                        <div class="col-md-10 col-xs-10 col-sm-10">
                                            <input type="text" class="form-control" name="question" value="<?php echo $val['essay'];?>">
                                        </div>
                                    </div>
                                </div>
                      <div class="ln_solid"></div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3"><br>
                          <button id="send" type="submit" class="btn btn-success ">Update</button>
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
            $("#class_div").show();            
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
                var branch = $("#branch").val();
            $("#section_div").show();             
                $.get("<?php echo base_url(); ?>load/section/role/"+value+"/"+branch,{},function(d){
                var pre = '<option value="">Select Section</option>';
            $("#section").html(pre+d);
                });
            });
            $(document).on("change","#class",function(){
                var c = $("#class").val();
            $("#subject_div").show();            
                $.get("<?php echo base_url(); ?>load/subject/"+c,{},function(d){
                    var pre = '<option value="">Select Subject</option>';
            $("#subject").html(pre+d);
                });
            });
        });
      


        $(document).ready(function(){
            $(document).ready(function(){
            $(document).on("change","#subject",function(){
            $("#chapter_div").show();            
                var value = $(this).val();
                var clas = $("#class").val();
                $.get("<?php echo base_url(); ?>load/chapter/"+value+"/"+clas,{},function(d){
                    var pre = '<option value="">Select Chapter</option>';
                    $("#chapter").html(pre+d);
                });
            });
            
        });
            
        });
    
</script>
  </body>
</html>