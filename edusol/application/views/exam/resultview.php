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
                    <h2>Result List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <input type="hidden" id="clas" value="<?php echo $clas; ?>">
                  <input type="hidden" id="sec" value="<?php echo $section; ?>">
                  <input type="hidden" id="exam" value="<?php echo $examtype; ?>">
                  <div class="x_content">

                    <table class="table table-striped table-bordered" style="width:100%;"  id="myDataTable">
                      <thead>
                        <tr>
                        
                          <th>#</th>
                          <th>GR#</th>
                          <th>Student Name</th>
                          <th>Father Name</th>
                          <th>Total Marks</th>
                          <th>Obtained Marks</th>
                          <th>Position</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $i=1; $results=[]; foreach ($student as $key => $value) {?>
                          <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $value['grno'];?></td>
                            <td><?php echo $value['student_name'];?></td> 
                            <td><?php echo $value['father_name'];?></td>
                            <td><?php echo $value['total_marks'];?></td>
                            <td><?php echo $value['obtained_marks'];?></td>
                            <td><?php if($value['obtained_marks']==0){echo "<span class='text-danger'>Fail</span>";}else{echo $value['position'];}?></td>
                            <td><a target="_blank" href="<?php echo base_url();?>exam/printview/<?php echo $value['id'];?>"<i class="fa fa-eye" aria-hidden="true"></i></a></td>
                          </tr>
                          <?php $results[]=$value['id'];

                          } 

                          $results_encoded = base64_encode(json_encode($results));
 $s = rtrim($results_encoded, '=');
//var_dump($s);
//die();
                          ?>
                      </tbody>
                    </table>
                    <div class="row">
                      <div class="col-md-12 text-right">
                        <a href="<?php echo base_url().'Exam/printviewclass/'.$s; ?>" target="_blank">
                          <button class="btn btn-success">Print All</button>
                        </a>
                      </div>
                    </div>
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
        var clas=$('#clas').val();
var section=$('#sec').val();
var exam=$('#exam').val();
        $('#myDataTable').DataTable(
            {
            "bPaginate":false,
            "bFilter":true,
            "bInfo":false,
            "ordering":false,
            "scrollX":true,
            dom: 'Bfrtip',
            buttons: [
            'csv', 'excel', 'pdf',{text:'Print',exportOptions:{columns:[0,1,2,3,4,5,6,7,8]},action:function() {var win = window.open('<?php echo base_url() ?>Exam/ClassWiseResultReport/'+clas+'/'+section+"/"+exam, '_blank');
  win.focus();}}            ]
            }
        );

       
        });
        
        </script>