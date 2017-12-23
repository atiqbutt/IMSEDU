        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Voucher</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Arrears</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo base_url();?>Voucher/apply_arrear" method="post" id="form1">
                      

                      <span class="col-lg-12 bg-danger text-danger" id="error" style="margin-bottom:5px;padding:5px;display:none;">No Vouchers are made in last month of this student</span>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">GR No<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" id="promotion_id" name="promotion_id" value="<?php echo $student['promotion_id']; ?>" >                    
                        <input type="text" id="grno" name="grno" class="form-control" required="true" value="<?php echo $student['grno']; ?>" readonly>                    
                       
                        </div>
                      </div>    
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Student Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="student_name" name="student_name" class="form-control" required="true" value="<?php echo $student['student_name']; ?>" readonly>                    
                       
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Father Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="father_name" name="father_name" class="form-control" required="true" value="<?php echo $student['father_name']; ?>" readonly>                    
                       
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Arrear Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="arrear" name="arrear" class="form-control" required="true">                    
                       
                        </div>
                      </div>
                            
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success pull-right" >Submit</button>
                        </div>
                      </div>
                    </form>


                     
                  </div>
                </div>
             
              </div>
                
             
              </div>
            
            </div>
          </div>
        </div>
      
        <!-- /page content -->
        <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript">
 
         $(document).ready(function(){
           var promotion_id=$('#promotion_id').val();
            
            //$.get( "<?php echo base_url(); ?>"+"Load/check_previous_month_voucher/"+promotion_id,function(data) {
            //    if(data=="false") {
            //      $("#error").show();
            //      $("#send").prop("disabled",true);
            //    }
            //});
        });
    </script>
        