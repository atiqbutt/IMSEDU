<link href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<style>
.right-border{
 border-right:white 1px;
}
</style>
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
                    <h2>View Salary</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="form-horizontal form-label-left"  >
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="month">Type <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="text" id='type' name="type" readonly value="<?php echo $type; ?>" class="form-control">
                           </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="month">Month <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="month" id='month' name="month"  readonly value="<?php echo $month; ?>" class="form-control">
                           </div>
                      </div>  
                      <div class="table-responsive">
<?php $branch=$this->user_model->getbranch();
 $d=$this->db->query("select b_logo,logo1,logo2 from branch where id=$branch")->result()[0];

 ?>
                      <table id="myDataTable" class="table table-striped table-bordered nowrap" style="width:100%;" >
                      <thead>
                        <tr>
                          
                          <th >#</th>
                          <th >Employe Name</th>
                        
                          <th >Date of join</th>
                          <th >Salary</th>
                          <th >Deduction</th>
                          <th >Advance</th>
                          <th >Security</th>
                          <th >Bonus</th>
                          <th >Total</th>
                          <th >Status</th>
                           <th class="actions" >Actions</th>
                        </tr>
                      </thead>
                      <tbody class="center">
                     
                      <?php $i=1;  $dedu=0;$advanc=0;$allonc=0;$securit=0;$fi=0;
                       foreach ($employee as $key => $value) { 
                           $cut=0; $add=0;
                            
                           ?>
                          <tr><td><?php echo $i++; ?></td>
                          <td><?php echo $value['firstname']." ".$value['lastname']; ?> </td>
                           
                            <td><?php echo $value['doj']; ?></td>
                          <td><?php echo $value['salery'] ?></td>
                          <td id="deduct"><?php $v=0; foreach ($deduction as $key => $det) {
                              if($value['empid']==$det['bothid']){
                                  $v=$det['Amount'];
                                  $cut=$det['Amount']+$cut;
                                   $dedu+=$det['Amount'];
                              }
                          } echo $v; ?></td>
                          <td><?php $v=0; foreach ($advance as $key => $adv) {

                             
                              if($value['empid']==$adv['bothid']){
                                  $v=$adv['totaladvance'];
                                  $cut=$adv['totaladvance']+$cut;
                                  $advanc=$adv['totaladvance']+$advanc;
                              }
                          } echo $v; ?></td>
                          <td><?php $v=0;  foreach ($security as $key => $sec) {
                              if($value['empid']==$sec['bothid']){
                                  $v=$sec['detuct_amount'];
                                $cut=$sec['detuct_amount']+$cut;
                                $securit=$sec['detuct_amount']+$securit;
                              }
                          } echo $v; ?></td>
                          <td><?php $v=0;  foreach ($allonce as $key => $all) {
                                if($value['empid']==$all['bothid']){
                                  $v = $all['amount'];
                                   $add=$add+$all['amount'];
                                   $allonc=$all['amount']+$allonc;
                                }
                            } 
                            echo $v;
                            ?></td>
                          <td><?php 
                          $total=$value['salery']-$cut;  $final=$total+$add; $fi=$final+$fi; echo $final;  ?></td>
                          <td><?php if($value['is_paid']==1) echo "Paid";else echo "Not Paid";?></td>
<td class="actions"><a href="<?php echo base_url(); ?>salary/Action_salary/<?php echo $value['id'] ?>"><i class='fa fa-eye'></i></a> </td>
                          </tr>
                        
                      <?php }?>
                     <tr><td class="right-border"></td><td class="right-border">Total</td><td class="right-border">=</td><td class="right-border"></td><td><?php echo $dedu; ?></td><td><?php echo $advanc; ?></td><td><?php echo $securit; ?></td> <td><?php echo $allonc; ?></td><td><?php echo $fi; ?></td><td></td><td></td></tr>
                      </tbody>
                      </table>
                      </div >
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
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>
        <script>
        $(document).ready(function() {
        var t=$('#type').val();
var month=$('#month').val();
        $('#myDataTable').DataTable(
            {
            "bPaginate":false,
            "bFilter":true,
            "bInfo":false,
            "ordering":false,
            "scrollX":true,
            dom: 'Bfrtip',
            buttons: [
            'csv', 'excel', 'pdf',{text:'Print',exportOptions:{columns:[0,1,2,3,4,5,6,7,8]},action:function() {var win = window.open('<?php echo base_url() ?>salary/printview/'+t+'/'+month, '_blank');
  win.focus();}}            ]
            }
        );

       
        });
        
        </script>
