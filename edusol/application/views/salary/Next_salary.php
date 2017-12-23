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
                    <h2>Create Salary</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                
                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>salary/save_salary" method="post">
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
                      <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          
                          <th style="width:50px;">#</th>
                          <th style="width:100px;">Employe Name</th>
                          <th style="width:100px;">Salary</th>
                          <th style="width:100px;">Deduction Amount</th>
                          <th style="width:100px;">Advance Amount</th>
                          <th style="width:100px;">Security Amount</th>
                          <th style="width:100px;">Allonce Amount</th>
                          <th style="width:100px;">Total</th>
                        </tr>
                      </thead>
                      <tbody class="center">
                      <?php $i=1;  
                       foreach ($employee as $key => $value) { 
                           $cut=0; $add=0
                           ?>
                          <tr><td><?php echo $i++; ?></td>
                          <td><?php echo $value['firstname']." ".$value['lastname']; ?><input type="hidden" value="<?php echo $value['empid'];?>" name="emp[<?php echo $i; ?>][id]"/> </td>
                          <td><?php echo $value['salery']; ?></td>
                          <td id="deduct"><?php $v=0; foreach ($deduction as $key => $det) {
                              if($value['empid']==$det['bothid']){
                                  $v=$det['Amount'];
                                  $cut=$det['Amount']+$cut;
                              }
                          } echo $v; ?></td>
                          <td><?php $v=0; foreach ($advance as $key => $adv) {

                             
                              if($value['empid']==$adv['bothid']){
                                  $v=$adv['totaladvance'];
                                  $cut=$adv['totaladvance']+$cut;
                              }
                          } echo $v; ?></td>
                          <td><?php $v=0;  foreach ($security as $key => $sec) {
                              if($value['empid']==$sec['bothid']){
                                  $v=$sec['detuct_amount'];
                                $cut=$sec['detuct_amount']+$cut;
                              }
                          } echo $v; ?></td>
                          <td><?php $v=0;  foreach ($allonce as $key => $all) {
                                if($value['empid']==$all['bothid']){
                                  $v = $all['amount'];
                                   $add=$add+$all['amount'];
                                }
                            } 
                            echo $v;
                            ?></td>
                          <td><?php 
                          $total=$value['salery']-$cut;  $final=$total+$add; echo $final;  ?><input type="hidden" value="<?php echo $final; ?>" name="emp[<?php echo $i; ?>][total]" /></td>
                          </tr>
                      <?php }?>
                      </tbody>
                      </table>
                      </div >
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-2 col-md-offset-10">
                          <button id="send" type="submit" class="btn btn-success">Add</button>
                        </div>
                      </div>
                      <form/>
                      </div>
                </div>
             
              </div>
                  
            </div>
          </div>
        </div>
        <!-- /page content -->
        <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
        <script>
        $('document').ready(function(){
            var deduct=$('#deduct').html();
            
        });
        </script>