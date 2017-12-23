 <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Salary</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Staff Allowance Assign View</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                
                  <div class="table-responsive">
                        <table class="table table-stripped table-bordered" id="myDataTable"  style="width:100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Allowance</th>
                                    <th>Amount</th>
                                    <th>Month</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                            <?php $offset=$this->uri->segment(3,0)+1; foreach ($employee as $key => $value) { ?>
                                <tr>
                                <td><?php echo $offset++ ; ?></td>
                                <td><?php echo $value['firstname']." ".$value['lastname'];  ?></td>
                                <td><?php echo $value['refrence'];  ?></td>
                                <td><?php echo $value['name'];  ?></td>
                                <td><?php echo $value['amount'];  ?></td>
                                <td><?php echo $value['month'];  ?></td>
                               <td><a href="<?php echo base_url(); ?>salary/Action_Allonce/del/<?php echo $value['id'] ?>"><i class='fa fa-trash'></i></a> <a href="<?php echo base_url(); ?>salary/Action_Allonce/edit/<?php echo $value['id'] ?>"><i class='fa fa-pencil'></i></a></td>
                                </tr>
                           <?php } ?>
                            </tbody>
                        </table>
                        <?php echo $page_links; ?>
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
        
        $('#myDataTable').DataTable(
            {
            "bPaginate":false,
            "bFilter":true,
            "bInfo":false,
            "ordering":false,
            "scrollX":true,
            dom: 'Bfrtip',
            buttons: [
            'csv', 'excel', 'pdf',{extend:'print',text:'Print',exportOptions:{columns:[0,1,2,3,4,5]}}            ]
            }
        );

       
        });
        
        </script>