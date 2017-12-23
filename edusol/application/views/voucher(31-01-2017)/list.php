<style>
    //.dataTables_filter { visibility: hidden;}
    #custom_search_wrapper {display: none;}
    #custom_pager_wrapper {display: none;}
</style>  
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Fee</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Voucher List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row" id="custom_search_wrapper">
                      <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-8 col-sm-offset-8">
                        <div class="form-group">
                            <input name="search" class="form-control has-feedback-left" id="search" type="search" value="<?php echo $q; ?>">
                            <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="form-group pull-right">
                          <input type="submit" class="btn btn-success" id="go-search" value="Search"></i>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-8 col-sm-offset-8">
                        <div class="form-group pull-right">
                          <!--<button class="btn btn-success" id="sms_defaults" data-href="<?php echo base_url(); ?>Voucher/sms_defaulters">SMS to Defaulter Students</button>-->
                          <button class="btn btn-success" id="sms_defaulters">SMS to Defaulter Students</button>
                        </div>
                      </div>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>GR#</th>
                          <th>Invoice</th>
                          <th>Student</th>
                          <th>Class</th>
                          <th>Section</th>
                          <th>Fee</th>
                          <th>Date</th>
                          <th>Expire Date</th>
                          <th>Status</th>
                          <?php if(!$is_super){ ?>
                          <th>Actions</th>
                          <?php } ?>
                        </tr>
                      </thead>


                      <tbody>
                        <?php $i=1; foreach ($voucher as $key => $value) { ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $value['grno']; ?></td>
                          <td><?php echo $value['invoice']; ?></td>
                          <td><?php echo $value['student_name']; ?></td>
                          <td><?php echo $value['class_name']; ?></td>
                          <td><?php echo $value['section_name']; ?></td>
                          <td><?php echo ($this->voucher_model->countTotalFee($value['invoice'])); ?></td>
                          <td><?php echo date("d-m-Y",strtotime($value['date'])); ?></td>
                          <td><?php echo date("d-m-Y",strtotime($value['date_expire']." -1 day")); ?></td>
                          <?php
                          $due = date("Y-m-d",strtotime($value['date_expire']." -1 day"));
                          $date = date("Y-m-d");
                          if ($due<=$date && $value['status']==0) {
                            $status = "Defaulter";
                          }else if($due<=$date && $value['status']==1)
                          {
                            $status = "Paid";
                          }else{
                            if ($value['status']==0) {
                              $status = "Due";
                            }elseif ($value['status']==1) {
                              $status = "Paid";
                            }else {
                              $status = "Submitted";
                            } 
                          }?>
                          <td><?php echo $status; ?></td>
                          <?php if(!$is_super){ ?>
                          <td>
                            <a href='<?php echo base_url();?>voucher/view/<?php echo $value['invoice']; ?>'><i class="fa fa-eye"></i></a> 
                          </td>
                          <?php } ?>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <div class="row" id="custom_pager_wrapper">
                      <div class="col-md-offset-8 col-sm-offset-8 col-md-4 col-sm-4 col-xs-12">
                        <div class="btn-group pull-right">
                            <button <?php if($curr==1){ ?>disabled<?php } ?> class="btn btn-success" data-href="<?php echo $base_url; ?>voucher/listv/<?php echo $searchq.'/'.($curr - 1); ?>">
                                <i class="fa fa-arrow-left"></i>
                            </button>
                            <button class="btn btn-success" data-href="<?php echo $base_url; ?>voucher/listv/<?php echo $searchq.'/'.$curr; ?>"><?php echo $curr; ?></button>
                            <button <?php if($curr==$end){ ?>disabled<?php } ?> class="btn btn-success" data-href="<?php echo $base_url; ?>voucher/listv/<?php echo $searchq.'/'.($curr + 1); ?>">
                                <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Print Section Wise Vouchers</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
                        <form action="" method="get">
                          <div class="form-group">
                              <label for="branch">Branch</label>
                              <select name="branch" class="form-control" required id="branch">
                                <option value="">Select Branch</option>
                                <?php foreach ($branch as $key => $value) {
                                  echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                } ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="class">Class</label>
                              <select name="class" class="form-control" required id="class">
                                <option value="">Select Class</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="section">Section</label>
                              <select name="section" class="form-control" required id="section">
                                <option value="">Select Section</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="session">Session</label>
                              <select name="session" class="form-control" required id="session">
                                <option value="">Select Session</option>
                                <?php foreach ($session as $key => $value) {
                                  echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                } ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="month">Month</label>
                              <input name="month" class="form-control" required id="month" type="month">
                          </div>
                          <div class="form-group pull-right">
                            <input type="submit" class="btn btn-success" id="classPrint" value="Print"></i>
                          </div>
                        </form>
                      </div>
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

    <!--Starting SMS Defaulters Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="defaultersModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Send SMS to defaulters</h4>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Class</label>
                  <div class="col-sm-10">
                    <select name="def_class" id="def_class" class="form-control" required>
                      <option value="">Select Class</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Section</label>
                  <div class="col-sm-10">
                    <select name="def_section" id="def_section" class="form-control" required>
                        <option value="">Select Section</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="SendSms" disabled>Send SMS</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              "bPaginate": true,
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print", text:'Print',exportOptions:{columns:[0,1,2,3,4,5,6,7,8,9]},
                  className: "btn-sm",
                  customize: function ( win ) {
                    $(win.document.body).find('h1:first').remove();
                    <?php if(!$is_super){ ?>
                      $(win.document.body).find( 'table' ).find("thead").prepend("<tr><th colspan='3' class='text-center'><img src='<?php echo base_url().$branch[0]['logo1']; ?>' width='50' height='50' /></th><th colspan='6' class='text-center'><h1 style='font-size:30px;'><?php echo $branch[0]['title']; ?></h1></th><th class='text-center'><img src='<?php echo base_url().$branch[0]['logo2']; ?>' width='50' height='50' /></th></tr>");
                    <?php } ?>
                  }
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
        <script>
      $(function(){
        $(document).on("click","#go-search",function(){
          var p = 1;
          var s = $("#search").val();
          if(s=="")
            s="all";
          window.location = "<?php echo base_url();?>voucher/listv/"+s+"/"+p;
        });
        $(document).on("change","#branch",function(){
          var val = $(this).val();
          $.get("<?php echo $base_url; ?>/load/classs/role/"+val,{},function(ret){
            var pre = "<option value=''>Select Class</option>";
            $("#class").html(pre+ret);
          });
        });
        $(document).on("change","#class",function(){
          var val = $(this).val();
          $.get("<?php echo $base_url; ?>/load/section/role/"+val,{},function(ret){
            var pre = "<option value=''>Select Section</option>";
            $("#section").html(pre+ret);
          });
        });
        $(document).on("click","#classPrint",function(e){
          var b = $("#branch").val();
          var c = $("#class").val();
          var s = $("#section").val();
          var sess = $("#session").val();
          var m = $("#month").val();
          if(b=="")
          {
            alert("Select Branch First");
          }else if(c=="")
          {
            alert("Select Class First");
          }else if(s=="")
          {
            alert("Select Section First");
          }else if(sess=="")
          {
            alert("Select Session First");
          }else if(m=="")
          {
            alert("Select Month First");
          }else{
            var win = window.open("<?php echo $base_url; ?>voucher/classPrint/"+b+"/"+c+"/"+s+"/"+sess+"/"+m, '_blank');
            if (win) {
                win.focus();
            } else {
                alert('Please allow popups for this website');
            }
          } 
          e.preventDefault();
        });

        $(document).on("click","#sms_defaulters",function(){
            $('#defaultersModal').modal();
            $.get("<?php echo base_url(); ?>load/classs/role/"+"<?php echo $this->user_model->getBranch(); ?>",{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $("#def_class").html(pre+d);
            });
        });
        
        $(document).on("change","#def_class",function(){
          var value=$(this).val();
            $.get("<?php echo base_url(); ?>load/section/role/"+value,{},function(d){
                  var pre = '<option value="">Select Section</opiton>';
                  $("#def_section").html(pre+d);
            });
        });
        
        $(document).on("change","#def_section",function(){
            if($('#def_class').val()!='' && $('#def_section').val()!='')
              $('#SendSms').prop('disabled',false);
        });
     
        $(document).on("click","#SendSms",function(){
            var classs=$('#def_class').val();
            var section=$('#def_section').val();
            window.location = "<?php echo base_url(); ?>"+"Voucher/sms_defaulters/"+classs+"/"+section;
        });

      });
    </script>

  </body>
</html>