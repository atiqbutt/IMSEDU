<?php
 foreach ($file as $files) {
  $file_name=$files->file;
  $cer_id=$files->id;
}
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Select Student</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form  method="post" action="<?php echo base_url();?>certificate/<?php echo $file_name ?>">
<div class="row form-control" style="margin-left:0px;">
<div class="col-md-12">
                                                    <input class="second" type="checkbox" name="ALL" onClick="toggle(this)" id="selecctall"> Select All
                                                    <input type="hidden" name="cer" value="<?php echo $cer_id;?>">
</div>
</div>
    <div class="row form-control" style="margin-left:0px;">
        <div class="col-md-<?php echo ($check_fee=='true'?3:4); ?>"><strong>#</strong></div>
        <div class="col-md-<?php echo ($check_fee=='true'?3:4); ?>"><strong>GR. NO</strong></div>
        <?php if($check_fee=="true") { ?>
            <div class="col-md-3"><strong>Fee Status</strong></div>
        <?php } ?>
        <div class="col-md-<?php echo ($check_fee=='true'?3:4); ?>"><strong>Name</strong></div>
    </div>  
        <?php foreach($student as $student){ ?>
    <div class="row form-control" style=" margin-left:0px;"> 
            <div class="col-md-<?php echo ($check_fee=='true'?3:4); ?>"><input type="checkbox" <?php if($check_fee=='true' && $this->certificate_model->check_fee_status($student->id)==false) echo 'disabled'; ?> class="second" name="std[]" value="<?php echo $student->id; ?>"><?php if(isset($is_leaving) && $is_leaving=="true") { ?>&nbsp;Passed: <input type="checkbox" <?php if($check_fee=='true' && $this->certificate_model->check_fee_status($student->id)==false) echo 'disabled'; ?> name="passed[<?php echo $student->id; ?>]" value="true"><?php } ?></div>
            <div class="col-md-<?php echo ($check_fee=='true'?3:4); ?>"><?php echo $student->grno;?></div>
            <?php if($check_fee=="true") { ?>
                <div class="col-md-3 <?php if($this->certificate_model->check_fee_status($student->id)) echo 'bg-success text-success';else echo 'bg-danger text-danger'; ?>"><strong><?php if($this->certificate_model->check_fee_status($student->id)) echo "Fee Cleared";else echo "Fee Not Cleared"; ?></strong></div>
            <?php } ?>
            <div class="col-md-<?php echo ($check_fee=='true'?3:4); ?>"><?php echo $student->student_name;?></div>
    </div>
<?php } ?>
<br>
<input type="submit" class="btn btn-success pull-right">

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
   <script type="text/javascript">
function toggle(source) {

  checkboxes = document.getElementsByName('std[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
  </body>
</html>