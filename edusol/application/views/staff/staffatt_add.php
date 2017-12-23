

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Attendance</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Staff Attendance</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>staff/saveatt" method="post">

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" value="<?php echo date("Y-m-d"); ?>" class="form-control col-md-7 col-xs-12 date" data-validate-length-range="6" data-validate-words="2" name="date" placeholder="Attendance Date" required="required" type="text">
                        </div>
                      </div>
                     <table class="table table-striped">
                     <tr>
                     <td>Sr.#</td>
                     <td>Name</td>
                     <td>Designation</td>
                     <td>Contact</td>
                     <td>Status</td>
                     
                     
                     </tr>
                     
                     <?php $var=1; foreach ($staff as $key => $value) {
                         
                     ?>
                     <tr>
                     <td><?php echo $var; ?></td>
                     <td><?php echo $value['firstname']." ".$value['lastname'];?></td>
                     <td><?php echo $value['designation'];?></td>
                    <td><?php echo $value['contact'];?></td>
                    <td> <?php foreach ($Attendancestatus as $key => $dt) { ?>
                      
                     
                    <input type="radio" <?php if($dt["status"]=="P"){echo "checked";}  ?> name="status[<?php echo $value['id'];?>]"  required="required" value="<?php echo $dt['id']  ?>"/>&nbsp;<span style="color:black;font-size:15px"> <?php echo $dt['status'];?></span>
                     &nbsp;
                     
                     <?php  }?>
                     </td>
                     </tr>
                     <?php $var++;?>
                    <?php } ?>
                     </table>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">Save</button>
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
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script>
 $(function () {
    $(".date").datepicker();
    date(".now");
    $(".date").focusout(function () {
        if ($(this).val().trim() == "") {
            date(".date");
        }
    });

    function date(selector) {
        var dNow = new Date();
        var localdate = dNow.getFullYear()+'/' +(dNow.getMonth() + 1)+'/' + dNow.getDate();
       
    }

});
</script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/build/js/custom.min.js"></script>
    <script>
        $(".abc").on("keypress", function (event) {

            var englishAlphabetAndWhiteSpace = /[A-Za-z ]/g;


            var key = String.fromCharCode(event.which);


            if (event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || englishAlphabetAndWhiteSpace.test(key)) {
                return true;
            }
            return false;
        });

         $('.abc').on("paste", function (e) {
            e.preventDefault();
        });
        $(".abc1").on("keypress", function (event) {

            var englishAlphabetAndWhiteSpace = /[A-Za-z0-9|-]/g;


            var key = String.fromCharCode(event.which);


            if (event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 32 || event.keyCode == 37 || event.keyCode == 39 || englishAlphabetAndWhiteSpace.test(key)) {
                return true;
            }


            return false;
        }); $('.abc1').on("paste", function (e) {
            e.preventDefault();
        });
        $(document).bind("contextmenu", function (e) {
            e.preventDefault();
        });
    </script>
  </body>
</html>