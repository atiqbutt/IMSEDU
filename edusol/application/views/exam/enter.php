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
                    <h2>Enter Marks</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php 
                        if(@$student_marks[0]['total_marks']!=0)
                            $action = $base_url."exam/update_marks"; 
                        else 
                            $action = $base_url."exam/enter";
                    ?>
                    <form class="form-horizontal form-label-left" action="<?php echo $action;?>" method="post">
                      <input type="hidden" name="class" value="<?php echo $class; ?>">
                      <input type="hidden" name="section" value="<?php echo $section; ?>">
                      <input type="hidden" name="subject" value="<?php echo $subject; ?>">
                      <input type="hidden" name="exam" value="<?php echo $exam; ?>">
                      <input type="hidden" name="session" value="<?php echo $session; ?>">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Exam Date<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php if(@$student_marks[0]['total_marks']!=0){ ?>
                            <input id="date" type="date" class="form-control col-md-7 col-xs-12" name="date" required="required" value="<?php echo $student_marks[0]['paper_date']; ?>">
                            <?php }else{ ?>
                            <input id="date" type="date" class="form-control col-md-7 col-xs-12" name="date" required="required">
                            <?php } ?>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_marks">Total Marks<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php if(@$student_marks[0]['total_marks']!=0){ ?>
                            <input id="total_marks" type="number" class="form-control col-md-7 col-xs-12" name="total_marks" required="required" min="0" value="<?php echo $student_marks[0]['total_marks']; ?>">
                            <?php }else{ ?>
                            <input id="total_marks" type="number" class="form-control col-md-7 col-xs-12" name="total_marks" required="required" min="0">
                            <?php } ?>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="passing_marks">Passing Marks<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php if(@$student_marks[0]['total_marks']!=0){ ?>
                            <input id="passing_marks" type="number" class="form-control col-md-7 col-xs-12" name="passing_marks" required="required" min="0" value="<?php echo $student_marks[0]['passing_marks']; ?>">
                            <?php }else{ ?>
                            <input id="passing_marks" type="number" class="form-control col-md-7 col-xs-12" name="passing_marks" required="required" min="0">
                            <?php } ?>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <table class="table table-stripped dt-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>GR. NO.</th>
                                <th>Student Name</th>
                                <th>Obtained Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    function getStudentMarks($id,$data){
                                        foreach($data as $k=>$v)
                                        {
                                            if($v['pid']==$id)
                                            {  
                                                return [$v['id'],$v['obtained_marks']];
                                            }
                                        } 
                                    } 
                            $i=1; foreach($student as $key=>$value){ ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $value['grno']; ?></td>
                                <td><?php echo $value['student_name']; ?></td>
                                <td>
                                    <?php 
                                    $val = getStudentMarks($value['id'],$student_marks);
                                    ?>
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="obtained_marks[<?php echo $value['id']; ?>]" required="required" min="0" value="<?php echo @$val[1]; ?>">
                                    <input type="hidden" class="form-control col-md-7 col-xs-12" name="action[<?php echo $value['id']; ?>]" required="required" min="0" value="<?php echo @$val[0]; ?>">
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                      </table>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success pull-right">Enter</button>
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
  </body>
</html>