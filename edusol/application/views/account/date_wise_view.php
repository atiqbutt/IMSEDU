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
                    <h3>Cash Payment</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Date Wise Search</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  
                     
                  <div class="x_content">
<table  id="myDataTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          
                          <th >Program Name</th>
                          <th >Project</th>
                          
                          <th >Main Head</th>
                          <th >Head Level 2</th>
                          <th >Head Level 3</th>
                          <th >To</th>
                          <th >Amount</th>
                          <th >Date</th>
                        </tr>
                      </thead>


                      <tbody class="center">
                        <?php $total=0; $a=1; foreach ($rec as $key => $value) { ?>
                        <tr>
                        <td style="width:60px;"><?php echo $a++;   ?></td>
                         <td style="width:140px;"><?php echo $value['programename'];   ?></td>
                          <td style="width:100px;"><?php echo $value['p_name'];   ?></td>
                           <td style="width:100px;"><?php echo $value['headname'];   ?></td>
                            <td style="width:100px;"><?php echo $value['level2name'];   ?></td>
                             <td style="width:100px;"><?php echo $value['level3name'];   ?></td>
                              <td style="width:100px;"><?php echo $value['to_receipt'];   ?></td>
                               <td style="width:100px;"><?php echo $value['amount']; $total=$total+$value['amount'];   ?></td>
                                <td style="width:100px;"><?php echo $value['date'];   ?></td>
                        </tr>
                        <?php } ?>
                     </tbody> 
<tr><td></td><td></td><td></td><td></td><td></td><td></td><td>Total Amount: </td><td colspan="2"><?php echo $total; ?></td></tr>
                    </table>
                     </div>
                </div>
              </div>
             
              </div>
            
            </div>
          </div>
        </div>

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
            'csv', 'excel', 'pdf',{extend:'print',text:'Print',exportOptions:{columns:[0,1,2,3,4,5,6,7,8]}}            ]
            }
        );

       
        });
       
        
        </script>
</body>
</html>