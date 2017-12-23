        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Ideoms Questions</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Ideoms</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

           <form class="form-horizontal form-label-left" action="<?php echo $base_url;?>autopaper/save_ideoms_question" method="post">

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
                          <select id="class" name="class" class="form-control">
                            <option value="">Select Class</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group" id="section_div">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section">Section <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="section" name="section" class="form-control">
                            <option value="">Select Section</option>
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
                          
                          <select id="chapter" name="chapter" class="form-control" required>
                            <option value="">Select Chapter</option>
                          </select>
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

                     

<label class="control-label col-md-3 col-sm-3 col-xs-3" for="name">Ideom<span class="required">*</span>
                        </label>
                         <div id="keyword_wrapper" class="col-md-7 col-sm-7 col-xs-7">
                                    <div class="row row1">
                                        <div class="col-md-10 col-xs-10 col-sm-10">
                                            <input type="text" class="form-control" name="question[]" placeholder="type here Ideoms ?">
                                        </div>
                                        <div class="col-md-2 col-xs-2 col-sm-2">
                                            <button class="btn btn-info kd-add" type="button" data-id="1"><i class="fa fa-plus"></i></button>
                                        </div>
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
            
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Questions View</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Question</th>
                          <th>Class</th>
                          <th>Subject</th>
                          <th>Chapter</th>
                          <th>Level</th>
                          <?php if(!$is_super){ ?>
                          <th>Actions</th>
                          <?php } ?>
                        </tr>
                      </thead>


                      <tbody class="center">
                        <?php  ?>
                        <tr>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                        </tr>
                        
                      </tbody>
                    </table>
                    <div class="row">
                     <!--  <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php for ($i=$total; $i >= 1; $i--) { ?>
                        <a href="<?php echo $base_url; ?>autopaper/question_type/<?php echo $i; ?>">
                          <button class="btn btn-success pull-right"><?php echo $i; ?></button>
                        </a>
                        <?php } ?>
                      </div> -->
                    </div>
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
<!-- Datatables -->
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>
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
            $("#class_div").hide();
            $("#section_div").hide();            
            $("#subject_div").hide();            
            $("#chapter_div").hide();            
            $("#level_div").hide();            
            $("#question_div").hide();            
        });
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
                var branch = $("#branch").val();
            $("#section_div").show();             
                $.get("<?php echo base_url(); ?>load/section/role/"+value+"/"+branch,{},function(d){
                    var pre = '<option value="">Select Section</option>';
            $("#section").html(pre+d);
                });
            });
            $(document).on("change","#section",function(){
                var c = $("#class").val();
                var value = $(this).val();
                 $("#subject_div").show();            
                $.get("<?php echo base_url(); ?>load/subject_section/"+c+"/"+value,{},function(d){
                    var pre = '<option value="">Select Subject</option>';
                    $("#subject").html(pre+d);
                });
            });
        });

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
    
                                function strReplaceAll(string, Find, Replace) {
                                    try {
                                        return string.replace( new RegExp(Find, "gi"), Replace );       
                                    } catch(ex) {
                                        return string;
                                    }
                                }
                                $(function(){
                                    var i = 2;
                                    var kw = $("#keyword_wrapper");
                                    var remove = '<div class="col-md-2 col-xs-2 col-sm-2"><button class="btn btn-info kd-remove" type="button" data-id="{id}"><i class="fa fa-remove"></i></button></div>';
                                    var add = '<div class="col-md-2 col-xs-2 col-sm-2"><button class="btn btn-info kd-add" type="button" data-id="{id}"><i class="fa fa-plus"></i></button></div>';
                                    var Dnew = '<div class="row row{id}">' +
                                        '<div class="col-md-10 col-xs-10 col-sm-10">' +
                                            '<input type="text" class="form-control" name="question[]" placeholder="Ideoms Question">' +
                                        '</div>' +
                                        '{action}' +
                                    '</div>';
                                    $(document).on("click",".kd-add",function(){
                                        var row = $(this).parent().parent();
                                        var action = $(this).parent();
                                        var app = strReplaceAll(Dnew,"{action}",add);
                                        var Drem = strReplaceAll(remove,"{id}",i);
                                        app = strReplaceAll(app,"{id}",i++);
                                        kw.append(app);
                                        action.remove();
                                        row.append(Drem);
                                    });
                                    $(document).on("click",".kd-remove",function(){
                                        var row = $(this).parent().parent();
                                        var action = $(this).parent();
                                        var app = strReplaceAll(Dnew,"{action}",remove);
                                        app = strReplaceAll(app,"{id}",i++);
                                        if(kw.children().size() == 1)
                                        {
                                            kw.html(app)
                                        }else{
                                            row.remove();
                                        }
                                        
                                    });
                                });
</script>
<script type="text/javascript">
//=========================================Class wise load======================================
       $('#class').change(function(){
         var id=$('#class').val();

          $.ajax({
                   url: "<?php echo base_url(); ?>load/ideoms_questionagainstclass/"+id+"/"+18,
                   data: {},
                     success: function( result ) {
                            $("#datatable-buttons").dataTable().fnDestroy();
                            setTimeout(function(){ 
                                $( "tbody.center" ).html(result);
                                $("#datatable-buttons").DataTable({
      
                              dom: 'Blftipr',
                                  buttons: [
                                      'csv',
                                      'excel',
                                      'pdf',
                                      'print'
                                  ]
                            });
                          }, 1000);

  }
});

       });
//========================================Subject wise load====================================
        $('.sub').change(function(){
          var id=$('#class').val();
          var idsub=$(this).val();
          $.ajax({
                    url: "<?php echo base_url(); ?>load/ideoms_questionagainstsubject/"+id+"/"+idsub+"/"+18,
                    data: {},
                      success: function(result){
                            $("#datatable-buttons").dataTable().fnDestroy();
                            setTimeout(function(){ 
                                $( "tbody.center" ).html(result);
                                $("#datatable-buttons").DataTable({
      
                              dom: 'Blftipr',
                                  buttons: [
                                      'csv',
                                      'excel',
                                      'pdf',
                                      'print'
                                  ]
                            });
                          }, 1000);

  }
});

        });
//=======================================chapter wise load================================================
          $('#chapter').change(function(){
          var id=$('#class').val();
          var idsub=$('#subject').val();
          var idchap=$('#chapter').val();

          $.ajax({
                   url: "<?php echo base_url(); ?>load/ideoms_questionagainstchapter/"+id+"/"+idsub+"/"+idchap+"/"+18,
                   data: {},
                     success: function( result ) {
                            $("#datatable-buttons").dataTable().fnDestroy();
                            setTimeout(function(){ 
                                $( "tbody.center" ).html(result);
                                $("#datatable-buttons").DataTable({
      
                              dom: 'Blftipr',
                                  buttons: [
                                      'csv',
                                      'excel',
                                      'pdf',
                                      'print'
                                  ]
                            });
                          }, 1000);

  }
});

       });
//=======================================Level Wise Load========================================================
$('#level').change(function(){
          var level=$(this).val();
          var id=$('#class').val();
          var idsub=$('#subject').val();
          var idchap=$('#chapter').val();
          $.ajax({
                    url: "<?php echo base_url(); ?>load/ideoms_questionagainstlevel/"+id+"/"+idsub+"/"+idchap+"/"+level+"/"+18,
                    data: {},
                      success: function( result ) {
                            $("#datatable-buttons").dataTable().fnDestroy();
                            setTimeout(function(){ 
                                $( "tbody.center" ).html(result);
                                $("#datatable-buttons").DataTable({
      
                              dom: 'Blftipr',
                                  buttons: [
                                      'csv',
                                      'excel',
                                      'pdf',
                                      'print'
                                  ]
                            });
                          }, 1000);

  }
});

        });
         
</script>
  </body>
</html>