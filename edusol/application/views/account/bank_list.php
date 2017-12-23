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
                    <h3>Bank</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Bank View</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="row">
                      <br>
                    <table id="myDataTable" class="table table-striped table-bordered nowrap" style="width:100%;" >
                      <thead>
                        <tr>
                          <th >#</th>
                          
                          <th>Bank Name</th>
                          <th>Bank Code</th>
                          <th>Account #</th>
                          <th>Title</th>
                          <th>Purpose</th>
                          <th>Balance</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>


                      <tbody class="center">
                        <?php $a=1; foreach ($bank as $key => $value) { ?>
                        <tr>
                        <td style="width:60px;"><?php echo $a++;   ?></td>
                         <td style="width:140px;"><?php echo $value['b_name'];   ?></td>
                          <td style="width:100px;"><?php echo $value['b_code'];   ?></td>
                           <td style="width:100px;"><?php echo $value['Account_no'];   ?></td>
                            <td style="width:100px;"><?php echo $value['title'];   ?></td>
                             <td style="width:100px;"><?php echo $value['purpose'];   ?></td>
                              <td style="width:100px;"><?php echo $value['o_balance'];   ?></td>
                               <td style="width:100px;"><?php if($value['is_active']==1){echo "<span class='badge bg-green'>Activate</span>";}else{echo "<span class='badge bg-green'>Deactivate</span>";} ?></td>
                                <td style="width:100px;"><?php if($value['is_active']==1){echo "<a  href='".base_url()."account/st_change/".$value['id']."/0' ><span class='fa fa-retweet  fa-2x' ></span></a>";}else{echo "<a  href='".base_url()."account/st_change/".$value['id']."/1' ><span class='fa fa-retweet  fa-2x'></span></a>";} ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    
                       <?php echo $page_links; ?>
                      
                  </div>
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
            'csv', 'excel', 'pdf',{extend:'print',text:'Print',exportOptions:{columns:[0,1,2,3,4,5,6,7]}}            ]
            }
        );

       
        });
        
        </script>
