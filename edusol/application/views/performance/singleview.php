 
 <style>
.td{
    border:2px solid #96C03D;

   
}
.table1{
    border:2px solid #96C03D !important;
}
</style>
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Performance View</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Performance List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="x_content">
               
                   <table class="table table-borderd" style="border:2px solid #96C03D !important">
                    <tr>
                    <td class="td">1:Type Of Review</td>
                    <?php foreach ($review as $key => $value) {?>

                    &nbsp; &nbsp; &nbsp; <td class="td"><input type="checkbox"  <?php if($value['id']==$data['reviewid']){echo "checked";} else {echo "disabled='disabled'";}?>   name="typereview" value="<?php echo $value['id']; ?>"  /> <?php echo$value['Name'] ?></td>
                    <?php } ?>
                    </tr>
                    </table>
                    <table class="table table1" >
                    <tr ><th class="td" colspan="5">2:Employee(Apraise) Information:</th></tr>
                    <tr><th class="td">a:Employee Name</th><td class="td" id="emp_name"><?php echo  $data['firstname']." ".$data['lastname']; ?></td><th class="td">b:Designation</th><td class="td" id="des"><?php echo  $data['designation']; ?></td></tr>
                    <tr><th class="td">c:Department</th><td class="td" id="dep"><?php echo $data['department']; ?></td><th class="td">d:Grade</th><td class="td" id="grade" ><?php echo $data['grade']; ?></td></tr>
                    <tr><th class="td">e:Joining Date</th><td class="td" id="doj" ><?php echo $data['doj']; ?></td><th class="td" >f:Contract Type</th><td class="td" id="ct" ><?php echo $data['Contract_type']; ?></td></tr>
                    <tr><th class="td">g:Contract End Date</th><td class="td" id="ced"><?php echo $data['Contract_end'] ?></td><th class="td">h:Confirmation Due Date</td><td class="td" id="cdd"><?php echo $data['confirmation_due']; ?></td></tr>
                    <tr><th class="td">i:Monthly Salary</th><td class="td" id="salary"><?php echo $data['salery'] ?></td><th class="td">j:Total Tenure</th><td class="td" id="tt"><?php echo $data['tottaltenure'] ?></td></tr>
                    <tr><th class="td">k:Benifits</th><td class="td" id="benifits"><?php echo $data['benifits'] ?></td><th class="td">l:Review Period</th><td class="td" id="review"><?php echo $data['review_period']  ?></td></tr>
                    </table>
                     <table class="table table1">
                        <tr><th class="td" colspan="5">3:Responsibilities and Attributes Evaluation During The Period</th></tr>
                        <tr><td class="td">Evaluation Grades Categories</td><td class="td" ><?php foreach ($grade as $key => $value) {
                            ?><span><?php echo $value['g_name']; ?> &nbsp;&nbsp;(<?php echo $value['marks']; ?>Marks)  </span> &nbsp;&nbsp;&nbsp; <?php
                        } ?></td></tr>
                        </table>
                        <table class="table table1">
                        <tr><th class="td" colspan="5" >a: Professional Attributes   (40% weightage)</th></tr>
                        <tr><th class="td">#</th><th class="td" style="text-align:center;">Attributes</td><th class="td" style="text-align:center;">Grade</td> </tr>
                        <?php 
                        $a=1;
                        foreach ($attri as $key => $value) {?>
                            
                        <tr>
                        <td class="td" style="text-align:center"><?php echo $a++ ;?></td>
                        <td class="td" style="text-align:center"><?php echo $value['attributename'] ;?></td>
                        <td class="td" style="width:30%;text-align:center"><?php echo $value['g_name'] ;?></td>
                            
                        </tr>   
                        <?php }?>
                        
                        <tr><th class="td" colspan="2">Average Marks Obtained Against Profesional Attributes (Convert Grades in Marks, sum these marks and divide by 9) </td>
                        <td class="td"  ><center><span><?php echo $data['attritotalgrade'] ?></span></center></td></tr>
                        </table>
                        
                       <table class="table table1">
                      <tr><th class="td" colspan="5" >b:Summary of Performance (please use separate sheets if required) 60% Weightage</th></tr>
                      <tr><th class="td" style="text-align:center"  >Sr.#</th><th class="td" style="text-align:center;">Key Responsibilities</th><th class="td" style="text-align:center;">Achievements</th><th class="td" style="text-align:center;">Grade</th> </tr>
                         <?php
                         $a=1;
                          foreach ($keyre as $key => $value) {?>
                           <tr>
                           <td class="td" style="text-align:center">
                            <?php echo $a++;  ?>
                           </td>
                           <td class="td" style="text-align:center">
                            <?php echo $value['key'];  ?>
                           </td>
                           <td class="td" style="text-align:center">
                            <?php echo $value['achivment'];  ?>
                           </td>
                           <td class="td" style="text-align:center">
                            <?php echo $value['g_name'];  ?>
                           </td>
                            </tr>
                         <?php } ?>
                         <tr><th class="td" colspan="3">Average Marks Obtained Against Key Responsibilities ( Convert grades in Marks, sum these marks and divide by Number of key responsibilities areas)</th>
                         <th class="td" style="text-align:center"><?php echo $data['keytotalgrade']; ?></th>
                         </tr>
                         <tr>
                        <th class="td" style="width:20%">Calculation Formula Aggregate Score for grading</th>
                        <th class="td"  colspan="2">(Average Marks obtained in professional Attributes) X 0.4 + (Marks obtained against performance) X 0.6</td>
                        <td class="td"><center><span id="formu"><?php echo $data['Aggregatescore'] ?></span></center></td>
                        </tr>
                        <tr>
                                 <th class="td" style="">C:Overall Performance Evaluation Grade Averaged  </th>
                                 <td class="td" colspan="2">
                                 <div class="col-md-2">A+:<input <?php if($data['finalgrade']=="4.5 - 5.0"){echo "checked" ;}else {echo "disabled='disabled'";} ?> value="4.5 - 5.0" type="radio" name="fgrade"><br>(4.5 - 5.0) </div> &nbsp;
                                 <div class="col-md-2">A:<input <?php if($data['finalgrade']=="3.5 - 4.49"){echo "checked" ;}else {echo "disabled='disabled'";} ?> type="radio" value="3.5 - 4.49"  name="fgrade"><br>(3.5 - 4.49)</div> &nbsp;
                                <div class="col-md-2">B+:<input <?php if($data['finalgrade']=="2.5 - 3.49"){echo "checked" ;}else {echo "disabled='disabled'";} ?>  type="radio" value="2.5 - 3.49" name="fgrade"><br>(2.5 - 3.49)</div> &nbsp;
                                <div class="col-md-2">B:<input <?php if($data['finalgrade']=="1.5 - 2.49"){echo "checked" ;}else {echo "disabled='disabled'";} ?> type="radio" value="1.5 - 2.49" name="fgrade"><br>(1.5 - 2.49)</div> &nbsp;
                                <div class="col-md-2">C:<input <?php if($data['finalgrade']=="1.49"){echo "checked" ;}else {echo "disabled='disabled'";} ?> type="radio" value="1.49" name="fgrade"><br>Upto 1.49</div> &nbsp;
                                   </td>
                                 <td class="td" style="text-align:center" ><?php echo $data['finalgrade']; ?></td>
                                 </tr>
                      </table>          
                   </div>
                </div>
              </div>
             
              </div>
            
            </div>
          </div>
        </div>
        <!-- /page content -->
        <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>