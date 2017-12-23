        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Cash Receipt</h3>
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
                  <div class="row">
                       
                     <div class="col-md-5" style="margin-top:10px;">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Date To:<span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                        <input name="date"  id="date1" value="" class="form-control date" maxlength="20" required>                    
                        </div>
                      </div> 
                      <div class="col-md-5" style="margin-top:10px;">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Date From:<span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                        <input name="date"  id="date2" value="" class="form-control date" maxlength="20" required>                    
                        </div>
                      </div> 
                      <div class="col-md-2" style="margin-top:10px">
                      <button type="button" id="srch" class="btn btn-success">Search</button>
                      </div>
                      </div>
                      <br>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th style="width:100px;">#</th>
                          
                          <th style="width:100px;">Program Name</th>
                          <th style="width:100px;">Project</th>
                          
                          <th style="width:100px;">Main Head</th>
                          <th style="width:100px;">Head Level 2</th>
                          <th style="width:100px;">Head Level 3</th>
                          <th style="width:100px;">From</th>
                          <th style="width:100px;">Amount</th>
                          <th style="width:100px;">Date</th>
                        </tr>
                      </thead>


                      <tbody class="center">
                        <?php $a=1; foreach ($vou as $key => $value) { ?>
                        <tr>
                        <td style="width:60px;"><?php echo $a++;   ?></td>
                         <td style="width:140px;"><?php echo $value['programename'];   ?></td>
                          <td style="width:100px;"><?php echo $value['p_name'];   ?></td>
                           <td style="width:100px;"><?php echo $value['headname'];   ?></td>
                            <td style="width:100px;"><?php echo $value['level2name'];   ?></td>
                             <td style="width:100px;"><?php echo $value['level3name'];   ?></td>
                              <td style="width:100px;"><?php echo $value['from_voucher'];   ?></td>
                               <td style="width:100px;"><?php echo $value['amount'];   ?></td>
                                <td style="width:100px;"><?php echo $value['date'];   ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                     <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php for ($i=$total; $i >= 1; $i--) { ?>
                        <a href="<?php echo $base_url; ?>account/cash_recipt_view/<?php echo $i; ?>">
                          <button class="btn btn-success pull-right"><?php echo $i; ?></button>
                        </a>
                        <?php } ?>
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
<script>
$('#srch').click(function(){
var date1=$('#date1').val();
var date2=$('#date2').val();

$.ajax({
                    url: "<?php echo base_url(); ?>Load_account/datewise_vou/"+date1+"/"+date2,
                    data: {},
                      success: function( d ) {
                       
                        $("tbody.center").html(d); 
  }
});

});
</script>