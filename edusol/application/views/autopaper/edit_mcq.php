        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>MCQ's Questions</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add MCQ's Question</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

           <form class="form-horizontal form-label-left" action="<?php echo $base_url;?>autopaper/save_edit_mcq" method="post">

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

                      
<div id="question_div">
<label class="control-label col-md-3 col-sm-3 col-xs-3" for="name">Question<span class="required">*</span>
                        </label>
                         <div id="keyword_wrapper" class="col-md-7 col-sm-7 col-xs-7">
                                    <div class="row row1">
                                        <div class="col-md-10 col-xs-10 col-sm-10">
                                            <input type="text" class="form-control" name="question" value="<?php echo $val['question']?>" placeholder="Question?">
                                        </div>
                                    </div>
                                    <br>

                                      <!-- <div class="option_wrapper"> -->
                                          <div class="row option1">
                                            <div class="col-md-5">
                                              <input type="text" name="options1" placeholder=" 1st Option"  value="<?php echo $val['option1'] ?>"class="form-control">
                                            </div>
                                            <div class="col-md-5">
                                              <input type="text" name="options2" placeholder="2nd Option" value="<?php echo $val['option2'] ?>" class="form-control">
                                            </div>
                                          </div>
                                          <br>
                                          <div class="row">
                                            <div class="col-md-5">
                                              <input type="text" name="options3" placeholder="3rd Option" value="<?php echo $val['option3'] ?>" class="form-control">
                                            </div>

                                            <div class="col-md-5">
                                              <input type="text" name="options4" placeholder="4th Option" value="<?php echo $val['option4'] ?>" class="form-control">
                                            </div>
                                          </div>
                                          <br>
                                          <div class="row">
                                            <div class="col-md-5 col-md-offset-3">
                                              <input type="text" name="correct" placeholder="Write Correct Answer" value="<?php echo $val['correct_answer']?>"class="form-control">
                                              <input type="hidden" name="id" value="<?php echo $val['id']?>"> 
                                            </div>                                            
                                          </div>
                                          <br>
                                        <div>
                                        <!-- </div> -->

                                </div>
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
            $("#class_div").show();            
                $.get("<?php echo base_url(); ?>load/classs/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $("#class").html(pre+d);
                });
            });
        });
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
                                        '<div class="row row1">'+
                                        '<div class="col-md-10 col-xs-10 col-sm-10">'+
                                            '<input type="text" class="form-control" name="question[]" placeholder="Question?">'+
                                        '</div>'+
                                        
                                    '</div>'+
                                    '<br>'+
                                            '<div class="row option1">'+
                                            '<div class="col-md-5">'+
                                              '<input type="text" name="options1[]" placeholder=" 1st Option" class="form-control">'+
                                            '</div>'+
                                            '<div class="col-md-5">'+
                                              '<input type="text" name="options2[]" placeholder="2nd Option" class="form-control">'+
                                            '</div>'+
                                          '</div>'+
                                          '<br>'+
                                          '<div class="row">'+
                                            '<div class="col-md-5">'+
                                              '<input type="text" name="options3[]" placeholder="3rd Option" class="form-control">'+
                                            '</div>'+

                                            '<div class="col-md-5">'+
                                              '<input type="text" name="options4[]" placeholder="4th Option" class="form-control">'+
                                            '</div>'+
                                          '</div>'+
                                          '<br>'+
                                          '<div class="row">'+
                                            '<div class="col-md-5 col-md-offset-3">'+
                                              '<input type="text" name="correct[]" placeholder="Write Correct Answer" class="form-control">'+
                                            '</div>'+
                                           '</div>'+
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
        $('#class').change(function(){
          var id=$('#class').val();

          $.ajax({
                    url: "<?php echo base_url(); ?>load/mcq_questionagainstclass/"+id,
                    data: {},
                      success: function( result ) {
                          $( "tbody.center" ).html(result);
  }
});

        });

        $('.sub').change(function(){
          var id=$('#class').val();
          var idsub=$(this).val();
          $.ajax({
                    url: "<?php echo base_url(); ?>load/mcq_questionagainstsubject/"+id+"/"+idsub,
                    data: {},
                      success: function(result){
                        
                          $("tbody.center").html(result);
  }
});

        });

          $('#chapter').change(function(){
          var id=$('#class').val();
          var idsub=$('#subject').val();
          var idchap=$('#chapter').val();

          $.ajax({
                    url: "<?php echo base_url(); ?>load/mcq_questionagainstchpter/"+id+"/"+idsub+"/"+idchap,
                    data: {},
                      success: function( result ) {
                          $( "tbody.center" ).html(result);
  }
});

        });
          $('#level').change(function(){
          var level=$(this).val();
          var id=$('#class').val();
          var idsub=$('#subject').val();
          var idchap=$('#chapter').val();
            console.log(level);
          $.ajax({
                    url: "<?php echo base_url(); ?>load/mcq_questionagainstlevel/"+id+"/"+idsub+"/"+idchap+"/"+level,
                    data: {},
                      success: function( result ) {
                          $( "tbody.center" ).html(result);
  }
});

        });
         
</script>
  </body>
</html>