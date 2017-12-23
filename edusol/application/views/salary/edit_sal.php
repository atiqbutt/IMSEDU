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
                    <h2>Advance Salary</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  
                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>salary/update" method="post">
                        <input type="hidden" name="advanceid" value="<?php echo $emp['id'] ?>" >
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="type" id="type">
                                    <option value="">Select Type</option>
                                    <option <?php if($emp['refrence']=="teacher"){echo "selected";} ?> value="teacher">Teacher</option>
                                    <option <?php if($emp['refrence']=="staff"){echo "selected";} ?> value="staff">Staff</option>
                                 </select> 
                           </div>
                      </div>
                       
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Employee <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="emp" id="emp">
                        
                                 </select>                    
                        </div>
                      </div>  
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="month">Month <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="month" id='month' name="month" value="<?php echo $emp['month']  ?>" class="form-control">
                           </div>
                      </div>  
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Advance Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="" class="form-control col-md-7 col-xs-12 num" value="<?php echo $emp['Amount']  ?>" maxlength="25" name="amount" placeholder="Advance Amount...." required="required" type="text">
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">Add</button>
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
        <script>
        $('document').ready(function(){
            var value=$('#type').val();
                
                
                $.get("<?php echo base_url(); ?>load/getemp/"+value,{},function(d){
                    var pre = '<option value="">Select Employee</opiton>';
                    $("#emp").html(pre+d);
                    $("#emp option[value=<?php echo $emp['tid']; ?>]").prop("selected",true);
                });
                

            
        });
        </script>