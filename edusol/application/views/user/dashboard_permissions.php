        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage Permissions</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Dashboard Permission</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="<?php echo base_url(); ?>Admin/update_dashboard_permissions/" method="post">
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="role" id="role" class="form-control col-md-12 col-sm-12 col-xs-12">
                                <option value="">Select Role</option>
                                <?php foreach ($roles as $key => $value) {
                                    if(!$is_super)
                                    {
                                        if($value['title']!="Super" AND $value['title']!="Branch Head")
                                            echo '<option value="'.$value['id'].'">' . $value['title'] . ' - ' . $value['name'] . '</option>';
                                    }
                                    else
                                        echo '<option value="'.$value['id'].'">' . $value['title'] . ' - ' . $value['name'] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user">User:</label>
                            <select name="user" id="user" class="form-control col-md-12 col-sm-12 col-xs-12">
                                <option value="">Select User</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="all"> All
                                    </label>
                                </div>
                                <hr>
                                <div id="permision_wrapper">
                                    <h2>Select Dashboard Permissions</h2>
                                    <?php echo $widgets; ?>
                                </div>
                            </div>
                            <button class="btn btn-success pull-right" type="submit">Save</button>
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
            $(document).on("change","#role",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/user/role/"+value,{},function(d){
                    var pre = '<option value="">Select User</opiton>';
                    $("#user").html(pre+d);
                });
            });
            $(document).on("change","#user",function(){
                var value = $(this).val();
                var pre="<h2>Select Dashboard Permissions</h2>";
                $.get("<?php echo base_url(); ?>Admin/widgets/"+value,{},function(d){
                    $("#permision_wrapper").html(pre+d);
                });
            });
            $('#all').click(function() {   
                if ($(this).is(':checked')) {
                    $(".widget_permission").prop( "checked", true );
                } else {
                    $(".widget_permission").prop( "checked", false );
                }
            });
        });
    </script>

  </body>
</html>