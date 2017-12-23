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
                    <h2>Student Attendance</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>student/saveatt" method="post">
                       <?php 
                       if(!$this->user_model->is_super()){
?>
<input type="hidden" value="<?php echo $branch; ?>" id="branch_id"  /><?php 
}else{?>
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Branch <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" name="branch" id="branch">
                                      <option value="">Select Branch</option>
                                       <?php      
                               
                             foreach ($branch as $key => $value) {
                                
                  ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $value['name']?></option>

                  <?php } ?>
                                 </select>                    
                        </div>
                      </div>
                      
                      <?php } ?>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Class <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="branch" id="class">
                                      <option value="">Select Class</option>
                            
                                 </select>                    
                        </div>
                      </div>    
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Section <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="branch" id="section">
                                      <option value="">Select Section</option>
                            
                                 </select>                    
                        </div>
                      </div>       
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" value="<?php echo date("Y-m-d"); ?>" class="form-control col-md-7 col-xs-12 date" data-validate-length-range="6" data-validate-words="2" name="date" placeholder="Attendance Date" required="required" type="text">
                        </div>
                      </div>
                     <table class="table table-striped table-borderd">
                     <tr>
                     <td>Sr.#</td>
                     <td>Gr.#</td>
                     <td>roll no</td>
                     <td>Student Name</td>
                     <td>Father Name</td>
                     <td>Class</td>
                     <td>Section</td>
                     <td>Status</td>
                     
                     </tr>
                     <tbody class="center">
                     
                     
                      
                     
                    
                    
                    </tbody>
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

        $(document).ready(function(){
        var value=$('#branch_id').val();
           $('#send').hide();
           $.get("<?php echo base_url(); ?>load/classs/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $("#class").html(pre+d);
                });
            });
    
             $('#branch').change(function(){
                 
                var value=$(this).val();
                
                $.get("<?php echo base_url(); ?>load/classs/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $("#class").html(pre+d);
                });
            });
         $('#class').change(function(){
                 
                var value=$(this).val();
                
                $.get("<?php echo base_url(); ?>load/section/role/"+value,{},function(d){
                    var pre = '<option value="">Select Section</opiton>';
                    $("#section").html(pre+d);
                });
            });
       $('#class').change(function(){
           var val=$(this).val();
           
           $.ajax({
         url: '<?php echo base_url(); ?>load/studentagainstclass/'+val,
        data: {},
        success: function (result) {
            if(result!=""){

$('#send').show();
       $("tbody.center").html(result);
}else{
$("tbody.center").html(result);}
                    }
                });
       });
        $('#section').change(function(){
           var val=$('#class').val();
           var se=$(this).val();
           $.ajax({
         url: '<?php echo base_url(); ?>load/studentagainstsection/'+val+'/'+se,
        data: {},
        success: function (result) {
            
       $("tbody.center").html(result);
                    }
                });
       });
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
  </body>
</html>