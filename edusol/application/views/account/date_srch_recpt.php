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
                  <form method="post" action="<?php echo base_url(); ?>account/searchdate">
                  <div class="row">
                       
                     <div class="col-md-5" style="margin-top:10px;">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Date To:<span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                        <input name="date1"  id="date1" value="" class="form-control date" maxlength="20" required>                    
                        </div>
                      </div> 
                      <div class="col-md-5" style="margin-top:10px;">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Date From:<span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                        <input name="date2"  id="date2" value="" class="form-control date" maxlength="20" required>                    
                        </div>
                      </div> 
                      
                      <div class="col-md-2" style="margin-top:10px">
                      <button type="submit" id="srch" class="btn btn-success">Search</button>
                      </div>
                </div>
                </form>
                      <br>
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
                        <?php $offset=$this->uri->segment(3,0)+1; foreach ($recipt as $key => $value) { ?>
                        <tr>
                        <td style="width:60px;"><?php echo $offset++;   ?></td>
                         <td style="width:140px;"><?php echo $value['programename'];   ?></td>
                          <td style="width:100px;"><?php echo $value['p_name'];   ?></td>
                           <td style="width:100px;"><?php echo $value['headname'];   ?></td>
                            <td style="width:100px;"><?php echo $value['level2name'];   ?></td>
                             <td style="width:100px;"><?php echo $value['level3name'];   ?></td>
                              <td style="width:100px;"><?php echo $value['to_receipt'];   ?></td>
                               <td style="width:100px;"><?php echo $value['amount'];   ?></td>
                                <td style="width:100px;"><?php echo $value['date'];   ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                     <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php echo $page_links; ?>
                        
                        
                      </div>
                    </div>
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
            'csv', 'excel', 'pdf',{extend:'print',text:'Print',exportOptions:{columns:[0,1,2,3,4,5,6,7,8]}}            ]
            }
        );

       
        });
       
        
        </script>
 <script>
// $('#srch').click(function(){
// var date1=$('#date1').val();
// var date2=$('#date2').val();
// $.ajax({
//                     url: "<?php echo base_url(); ?>Load_account/datewise_recipt/"+date1+"/"+date2,
//                     data: {},
//                       success: function( d ) {
                       
//                         $("tbody.center").html(d); 
                        
                        
//   }
// });

// });
 </script>