
<style>
.td{
    border:2px solid #96C03D;

   
}
.table1{
    border:2px solid #96C03D !important;
}
</style>
        <!-- page content -->
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Performance</h3>
              </div>

              
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Performance regestration<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                   
    <div class="demo-settings" data-open="true">
        
        <div class="settings-main">
            <label>Step effect</label>
            <select class="form-control" id="stepEffect">
                <option value="basic" selected="selected">basic</option>
                <option value="bounce">bounce</option>
                <option value="slideRightLeft">slideRightLeft</option>
                <option value="slideLeftRight">slideLeftRight</option>

                <option value="flip">flip</option>
                <option value="transformation">transformation</option>
                <option value="slideDownUp">slideDownUp</option>
                <option value="slideUpDown">slideUpDown</option>
            </select>
            <br />
            <label for="stepTransition">
                Step transition <input type="checkbox" id="stepTransition" name="stepTransition" value="11" checked />
            </label>
            <br />
            <label for="showButtons">
                Show buttons <input type="checkbox" id="showButtons" name="showButtons" value="111" checked />
            </label>
            <br />
            <label for="showStepNum">
                Show stepNum <input type="checkbox" id="showStepNum" name="showStepNum" value="123" checked />
            </label>


        </div>
    </div>

    <div class="container">
        <div class="row">
            
            <!-- BEGIN STEP FORM WIZARD -->
            <div class="tsf-wizard tsf-wizard-1">
                <!-- BEGIN NAV STEP-->
                <div class="tsf-nav-step">
                    <!-- BEGIN STEP INDICATOR-->
                    <ul class="gsi-step-indicator triangle gsi-style-1  gsi-transition ">
                        <li class="current" data-target="step-1">
                            <a href="#0">
                                <span class="number">1</span>
                                <span class="desc">
                                    <label>Employe Infromation</label>
                                    <!-- <span>Account details</span> -->
                                </span>
                            </a>
                        </li>
                        <li data-target="step-2">
                            <a href="#0">
                                <span class="number">2</span>
                                <span class="desc">
                                    <label>Resposbility & Attributes Information</label>
                                    <!-- <span>Profile details</span> -->
                                </span>
                            </a>
                        </li>
                        
                    </ul>
               
                <!-- BEGIN STEP CONTAINER -->

                <div class="tsf-container">
                    <!-- BEGIN CONTENT-->
                    <form class="tsf-content" method="POST" action="<?php echo base_url();?>performance/Save_apraise"  >

                        <!--<form class="tsf-form">-->
                        <!-- BEGIN STEP 1-->
                        <div class="tsf-step step-1 active">
                            <fieldset>
                                <legend>Employe Infromation</legend>
                                <div class="row">
                                    <!-- BEGIN STEP CONTENT-->
                                    <div class="tsf-step-content">
                                        
                                        <div class="row">
                                           

                                           <div class="col-md-12 ">
                                           <table class="table table-borderd" style="border:2px solid #96C03D !important">
                                           <tr>
                                           <td class="td">1:Type Of Review</td>
                                           <?php foreach ($review as $key => $value) {?>

                                              &nbsp; &nbsp; &nbsp; <td class="td"><input type="radio"  name="typereview" value="<?php echo $value['id']; ?>"  /> <?php echo$value['Name'] ?></td>
                                          <?php } ?>
                                          </tr>
                                          </table>
                                           </div> 
                                           <div class="col-md-5" id="drop">
                                           <select name="type" id="type" class="form-control col-lg-3 col-lg-offset-5">
                                           <option>Select teacher Type</option>
                                           <option value="teacher">Teacher</option>
                                           <option value="staff">Staff</option>
                                           </select>
                                           <br>
                                           <select name="emp" id="emp" class="form-control col-lg-3 col-lg-offset-5">
                                           <option>Select Employee</option>
                                           </select>
                                           </div>
                                           
                                           <div class="col-md-12">
                                           <table class="table table1" >
                                           <input type="hidden" id="empid" name="empid"  />
                                           <tr ><th class="td" colspan="5">2:Employee(Apraise) Information:</th></tr>
                                           <tr><th class="td">a:Employee Name</th><td class="td" id="emp_name"></td><th class="td">b:Designation</th><td class="td" id="des"></td></tr>
                                           <tr><th class="td">c:Department</th><td class="td" id="dep"></td><th class="td">d:Grade</th><td class="td" id="grade" ></td></tr>
                                           <tr><th class="td">e:Joining Date</th><td class="td" id="doj" ></td><th class="td" >f:Contract Type</th><td class="td" id="ct" ></td></tr>
                                           <tr><th class="td">g:Contract End Date</th><td class="td" id="ced"></td><th class="td">h:Confirmation Due Date</td><td class="td" id="cdd"></td></tr>
                                           <tr><th class="td">i:Monthly Salary</th><td class="td" id="salary"></td><th class="td">j:Total Tenure</th><td class="td" id="tt"></td></tr>
                                           <tr><th class="td">k:Benifits</th><td class="td" id="benifits"></td><th class="td">l:Review Period</th><td class="td" id="review"></td></tr>
                                           </table>
                                           </div>
                                           </div>
                                    <!-- END STEP CONTENT-->
                                </div>

                            </fieldset>
                        </div>
                        <!-- END STEP 1-->
                        <!-- BEGIN STEP 2-->
                        <div class="tsf-step step-2">
                            <fieldset>
                                <legend>Resposbility & Attributes Information</legend>
                                <!-- BEGIN STEP CONTENT-->
                                <div class="tsf-step-content">
                                
                                   <div class="row">
                                   <div class="col-md-12">
                                   <table class="table table1">
                                   <tr><th class="td" colspan="5">3:Responsibilities and Attributes Evaluation During The Period</th></tr>
                                   <tr><td class="td">Evaluation Grades Categories</td><td class="td" ><?php foreach ($grade as $key => $value) {
                                       ?><span><?php echo $value['g_name']; ?> &nbsp;&nbsp;(<?php echo $value['marks']; ?>Marks)  </span> &nbsp;&nbsp;&nbsp; <?php
                                   } ?></td></tr>
                                   </table>
                                   </div> 

                                   <div class="col-md-12">
                                   <table class="table table1">
                                   <tr><th class="td" colspan="5" >a: Professional Attributes   (40% weightage)</th></tr>
                                   <tr><th class="td">#</th><th class="td" style="text-align:center;">Attributes</td><th class="td" style="text-align:center;">Grade</td> </tr>
                                   <?php $count=count($attri) ;
                                   $i=0;
                                   $a=1;
                                   for ($i;$i <$count ; $i++) { 
                                       ?>
                                       <input type="hidden" name="attributeid[]" value="<?php echo $attri[$i]['id']; ?>" />
                                       <tr><td class="td"><?php echo $a++ ?></td><td class="td" style="text-align:center;" ><?php echo  $attri[$i]['attributename']; ?></td>
                                       <td class="td" style="width:50%"> <select name="attrigrades[]" id="grade" class="form-control col-md-4 grade">
                                           <option value="0">Select grades</option>
                                       <?php foreach ($grade as $key => $value) {?>
                                           <option value="<?php echo $value['marks']  ?>"><?php echo $value['g_name'] ?></option>
                                     <?php  }?></td>
                                 </tr>
                                 
                                 <?php }
                                   ?>  
                                   <tr><th class="td" colspan="2">Average Marks Obtained Against Profesional Attributes (Convert Grades in Marks, sum these marks and divide by 9) </td>
                                 <td class="td"  ><center><span id="gradeTotal">0</span>/<span id="totalattri" ><?php echo $i ?></span>=<span id="grades">0</span><input type="hidden" name="attritotal" class="totalattri" /></center></td></tr>
                                   </table>
                                   </div>
                                   <div class="col-md-12">
                                   <table class="table table1">
                                   <tr><th class="td" colspan="5" >b:Summary of Performance (please use separate sheets if required) 60% Weightage</th></tr>
                                   <tr><th class="td"  >Sr.#</th><th class="td" style="text-align:center;">Key Responsibilities</th><th class="td" style="text-align:center;">Achievements</th><th class="td" style="text-align:center;">Grade</th> </tr>
                                   <?php $count=count($res);
                                  
                                   $i=0;
                                   $a=1;
                                   for ($i;$i <$count ; $i++) { 
                                       ?>
                                        <input type="hidden" name="keyid[]" value="<?php echo $res[$i]['id']; ?>" />
                                       <tr><td class="td"  style="width:10%" ><?php echo $a++ ?></td><td class="td" style="text-align:center;" ><?php echo $res[$i]['key']?></td>
                                       <td class="td" style="width:40%"><textarea class="form-control col-md-4" rows="5"  cols="12" name="achivment[]" required="required"  ></textarea></td>
                                       <td class="td" style="width:20%"><center> <select name="keygrades[]" id="grades" class="form-control keygrades ">
                                           <option value="">Select grades</option>
                                       <?php foreach ($grade as $key => $value) {?>
                                           <option value="<?php echo $value['marks']  ?>"><?php echo $value['g_name'] ?></option>
                                     <?php  }?></select></center></td>
                                 </tr>
                                 
                                 <?php }
                                   ?>  
                                   <tr><th class="td" colspan="3">Average Marks Obtained Against Key Responsibilities ( Convert grades in Marks, sum these marks  and divide by Number of key responsibilities areas)  </td>
                                 <td class="td"  ><center><span id="keygradetotal">0</span>/<?php echo $i ?>=<span id="keygrades" ></span><input type="hidden" name="keyfinal" class="totalkey" /></center></td></tr>
                                 <tr>
                                 <th class="td" style="width:20%">Calculation Formula Aggregate Score for grading</th>
                                 <td class="td"  colspan="2">(Average Marks obtained in professional Attributes) X 0.4 + (Marks obtained against performance) X 0.6</td>
                                 <td class="td"><center><span id="formu">0</span><input type="hidden" name="finalforum" class="forum" /></center></td>
                                 </tr>
                                 <tr>
                                 <th class="td" style="">C:Overall Performance Evaluation Grade Averaged  </th>
                                 <td class="td" colspan="2">
                                 <div class="col-md-2">A+:<input value="4.5 - 5.0" type="radio" name="fgrade"><br>(4.5 - 5.0) </div> &nbsp;
                                 <div class="col-md-2">A:<input type="radio" value="3.5 - 4.49"  name="fgrade"><br>(3.5 - 4.49)</div> &nbsp;
                                <div class="col-md-2">B+:<input type="radio" value="2.5 - 3.49" name="fgrade"><br>(2.5 - 3.49)</div> &nbsp;
                                <div class="col-md-2">B:<input type="radio" value="1.5 - 2.49" name="fgrade"><br>(1.5 - 2.49)</div> &nbsp;
                                <div class="col-md-2">C:<input type="radio" value="1.49" name="fgrade"><br>Upto 1.49</div> &nbsp;
                                   </td>
                                 <td class="td"></td>
                                 </tr>

                                   </table>
                                   </div>

                                </div>
                                <!-- END STEP CONTENT-->
                            </fieldset>
                        </div>
                        <!-- END STEP 2-->
                        <!-- BEGIN STEP 3-->
                        
                        <!-- END STEP 3-->
                        <!--</form>-->
                    
                    <!-- END CONTENT-->
                    <!-- BEGIN CONTROLS-->
                    <div class="tsf-controls ">
                        <!-- BEGIN PREV BUTTTON-->
                        <button type="button" data-type="prev" class="btn btn-left tsf-wizard-btn">
                            <i class="fa fa-chevron-left"></i> PREV
                        </button>
                        <!-- END PREV BUTTTON-->
                        <!-- BEGIN NEXT BUTTTON-->
                        <button type="button" data-type="next" class="btn btn-right tsf-wizard-btn">
                            NEXT <i class="fa fa-chevron-right"></i>
                        </button>
                        <!-- END NEXT BUTTTON-->
                        <!-- BEGIN FINISH BUTTTON-->
                        <button type="submit" data-type="finish" class="btn btn-right tsf-wizard-btn">
                            FINISH
                        </button>
                        <!-- END FINISH BUTTTON-->
                    </div>
                    <!-- END CONTROLS-->
                </div>
                <!-- END STEP CONTAINER -->


            </div>





                </div>
              </div>
            </div> 
          </div>
        </div>
        <!-- /page content -->
</div>
</div>
      </div>
</div>
</div>
</div>
</div>  
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    
<!--  -->
    <script src="<?php echo base_url();?>assets/formwizard/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/formwizard/js/demo.js"></script>

    <script src="<?php echo base_url();?>assets/formwizard/plugin/parsley/js/parsley.js"></script>

    <script src="<?php echo base_url();?>assets/formwizard/js/tsf-wizard-plugin.js"></script>


    <script>
        $(function () {
            pageLoadScript();
        });
    

        function pageLoadScript() {

            _stepEffect = $('#stepEffect').val();
            _style = 'style1';
            _stepTransition = $('#stepTransition').is(':checked');
            _showButtons = $('#showButtons').is(':checked');
            _showStepNum = $('#showStepNum').is(':checked');


          tsf1=  $('.tsf-wizard-1').tsfWizard({
                stepEffect: _stepEffect,
                stepStyle: _style,
                navPosition: 'top',
                validation: true,
                stepTransition: _stepTransition,
                showButtons: _showButtons,
                showStepNum: _showStepNum,
                height: 'auto',
                onNextClick: function (e, from, to, validation) {
                    $('#result').append('<br/>onNextClick from ' + from +
                        ' - to ' + to + ' validation ' + validation)
                },
                onPrevClick: function (e, from, to) {
                    $('#result').append('<br/>onPrevClick from ' + from + ' - to ' + to)
                },
                onFinishClick: function (e, validation) {
                    $('#result').append('<br/>onFinishClick validation ' + validation)
                }
            });         


        }
    </script>
    <script>
    $('#type').change(function(){
        var ref=$(this).val();
        
        $.ajax({

            url:'<?php echo base_url(); ?>/load/getemp/'+ref,
            data:{},
            success:function(result){
                
                 var pre = '<option value="">Select Employee</opiton>';
                    $("#emp").html(pre+result);
            }
        });


    });
    $('#emp').change(function(){
        var ref=$('#type').val();
        var id=$(this).val();
        
        $.ajax({

            url:'<?php echo base_url(); ?>/load/Get_employee/'+ref+'/'+id,
            data:{},
            success:function(result){
            
               if(result!="null"){ 
                var data=jQuery.parseJSON(result);
                
                $("#drop").hide();
                $('#empid').val(data.id);
                $('#emp_name').html(data.firstname+' '+data.lastname);
                $('#des').html(data.designation);
                $('#dep').html(data.department);
                $('#grade').html(data.grade);
                $('#doj').html(data.doj);
                $('#ct').html(data.Contract_type);
                $('#ced').html(data.Contract_end);
                $('#cdd').html(data.confirmation_due);
                $('#salary').html(data.salery);
                $('#tt').html(data.tottaltenure);
                $('#benifits').html(data.benifits);
                $('#review').html(data.review_period);
               }else{
                   alert("data not available")
                   window.location.href="/edusol/performance/emp_info";
               }
                
                   
            }
        });


    });
    </script>
    <script>
    var totalsumgrade = 0;
    var totalsumkey = 0;
    $(function(){
        $(document).on("change",".grade",function(){
            sumGrade();
            final();
        });
        $(document).on("change",".keygrades",function(){
            sumkeygrade();
            final();
        });
    });
function final()
    {
        var total=0;
        var val1=parseInt($('#grades').html());
        var val2=parseInt($('#keygrades').html());
       
        total=(totalsumgrade * 0.4) + (totalsumkey * 0.6);
        $('#formu').html(total);
        $('.forum').val(total);
    }
    function sumGrade()
    {
        var gradeTotal = 0;
        var grades = 0;
        var calc = 0;
        $('.grade').each(function (index, value){
            gradeTotal = gradeTotal + parseInt($(this).val());
            grades++;
        });
        calc = gradeTotal / grades;
        $("#gradeTotal").html(gradeTotal);
        totalsumgrade = calc;
        $("#grades").html(calc);
        
        $(".totalattri").val(calc);
    }
    function sumkeygrade()
    {
        var keygradeTotal = 0;
        var keygrades = 0;
        var keycalc = 0;
        $('.keygrades').each(function (index, value){
            keygradeTotal = keygradeTotal + parseInt($(this).val());
            keygrades++;
        });
        keycalc = keygradeTotal / keygrades;
        
        $("#keygradetotal").html(keygradeTotal);
        
        $("#keygrades").html(keycalc);
        $(".totalkey").val(keycalc);
        totalsumkey = keycalc;
    }
    
    </script>



<!--  -->

       

 