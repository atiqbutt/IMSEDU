        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Employee Information</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Employee</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>performance/saveemp_info" method="post">
                        
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="type" id="type">
                                      <option value="">Select type</option>
                                      <option value="teacher">Teacher</option>
                                      <option value="staff">Staff</option>

                                 </select>                    
                        </div>
                      </div>    
                     
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Employee <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="emp_id" id="emp">
                                      <option value="">Select Employee</option>
                            
                                 </select>                    
                        </div>
                      </div> 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Employee Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="emp_name" class="form-control col-md-7 col-xs-12 abc" maxlength="25" name="empname" placeholder="Employee Name...." required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Designation<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="designation" class="form-control col-md-7 col-xs-12 abc" maxlength="25" name="designation" placeholder="Designation Name...." required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="b_head" class="form-control col-md-7 col-xs-12 abc" maxlength="25" name="department" placeholder="Department.." required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Grade<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="b_head" class="form-control col-md-7 col-xs-12 abc1" maxlength="25" name="grade" placeholder="Grade...." required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">joining Date<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="doj" class="form-control col-md-7 col-xs-12 " maxlength="25" placeholder="Date of Joining...." name="doj"  required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Contract Type<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="b_head" class="form-control col-md-7 col-xs-12 abc" maxlength="25" name="ctype" placeholder="Contract Type...." required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Contract End Date<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="b_head" class="form-control col-md-7 col-xs-12 date" maxlength="25" name="ced" placeholder="Contract End Date...." required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Confirmation Due Date<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="b_head" class="form-control col-md-7 col-xs-12 date" maxlength="25" name="cdd" placeholder="Confirmation Due Date...." required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Monthly Salary<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="salary" class="form-control col-md-7 col-xs-12 num" maxlength="25" name="salary" placeholder="Salary...."  required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Total Tenure<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="b_head" class="form-control col-md-7 col-xs-12 abc1" maxlength="25" name="tenure" placeholder="Total Tenure...." required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Benifits<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="b_head" class="form-control col-md-7 col-xs-12 abc" maxlength="25" name="benifits" placeholder="Benifits...." required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Review Period<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="b_head" class="form-control col-md-7 col-xs-12 abc" maxlength="25" name="period" placeholder="Review Period...." required="required" type="text">
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
        </div>
        <!-- /page content -->
        <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
        <script>
         $('#type').change(function(){
                 
                var value=$(this).val();
                
                
                $.get("<?php echo base_url(); ?>load/getemp/"+value,{},function(d){
                    var pre = '<option value="">Select Employee</opiton>';
                    $("#emp").html(pre+d);
                });

            });
            $('#emp').change(function(){
                 
                var value=$(this).val();
                var ref=$('#type').val();
                
                
                $.get("<?php echo base_url(); ?>load/getempinfo/"+ref+"/"+value,{},function(d){
                var data=jQuery.parseJSON(d);
                  
                
                  $('#emp_name').val(data.firstname+' '+data.lastname);
                  $('#designation').val(data.designation);
                  $('#doj').val(data.doj);
                  $('#salary').val(data.salery);
                  $('#id').val(data.id);
                  
                  
                  
                });

            });
            $(function () {
    $(".date").datepicker();
    date(".now");
    $(".date").focusout(function () {
        if ($(this).val().trim() == "") {
            date(".date");
        }
    });

    function date(selector) {
        var dNow = new Date();
        var localdate = dNow.getFullYear()+'/' +(dNow.getMonth() + 1)+'/' + dNow.getDate();
        
    }

});

        </script>