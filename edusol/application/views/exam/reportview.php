<?php
if(!isset($mydate) ){
  $mydate=date("Y-m-d");
}
 ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Student Attendance Report</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Report List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <form class="form-horizontal form-label-left" action="<?php echo $base_url;?>Student_Attn_Report/reportview" method="post">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class">Select Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date"  class="form-control col-md-7 col-xs-12" name="date" required="required">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="submit" class="form-control pull-right btn btn-success" name="Datesubmit">
                        </div>
                      </div>
                  </form>
                  <!--<input type="hidden" id="exam" value="<?php echo $examtype; ?>">-->
                  <div class="x_content">
                    <table class="table table-striped table-bordered dt-responsive nowrap" id="myDataTable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Class</th>
                          <th>Section</th>
                          <th>Total Student</th>
                          <th>Present</th>
                          <th>Absent</th>
                          <th>Leave</th>
                          <th>Short Leave</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                     
                          <?php $i=1;  foreach ($student as $key => $value) {  ?> 
                            <td><?php echo $i++;?></td>
                            <td><?php echo $value['class_name'];?></td>
                            <td><?php echo $value['section_name'];?></td>
                            <td><?php echo $value['total_students'];?></td>
                            <td><?php echo $this->Showexam_model->getTodayPresentStudents($value['cid'],$value['sid'],$mydate);//var_dump($this->db->last_query());?></td>
                            <td><?php echo $this->Showexam_model->getTodayAbsentStudents($value['cid'],$value['sid'],$mydate);//var_dump($this->db->last_query());?></td>
                            <td><?php echo $this->Showexam_model->getTodayLeaveStudents($value['cid'],$value['sid'],$mydate);//var_dump($this->db->last_query());?></td>
                            <td><?php echo $this->Showexam_model->getTodayShortLeaveStudents($value['cid'],$value['sid'],$mydate);//var_dump($this->db->last_query());?></td>
                            
                           
                           
                            <td><a target="_blank" href="<?php echo base_url();?>exam/printview/"<i class="fa fa-eye" aria-hidden="true"></i></a></td>
                          </tr>
                         <?php
                          } 
                          
                        
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
<script>
        $(document).ready(function(){
            $(document).on("change","#branch",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/classs/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $("#class").html(pre+d);
                });
            });
            
        });
          $(document).ready(function(){
            $(document).on("change","#class",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/section/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $("#section").html(pre+d);
                });
            });
            
        });
          $(document).ready(function(){
            $(document).on("change","#class",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/exam/"+value,{},function(d){
                    var pre = '<option value="">Select Exam</opiton>';
                    $("#exam").html(pre+d);
                });
            });
            
        });
    </script>



    <!-- /page content -->
   <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
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
        <script>
        $(document).ready(function() {
          $("#myDataTable").DataTable({
            dom: 'Blftipr',
                buttons: [
                    'csv',
                    'excel',
                    'pdf',
                    'print'
                ]
            });       
        });
        
        </script>