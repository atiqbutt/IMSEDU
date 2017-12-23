

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
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Advance Salary</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>salary/saveadv" method="post">
                        
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="type" id="type">
                                    <option value="">Select Type</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="staff">Staff</option>
                                 </select> 
                           </div>
                      </div>
                       
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Employee <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="emp" id="emp">
                        <!--<option value="" >Employee</option>!-->
                                 </select>                    
                        </div>
                      </div>  
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="month">Month <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="month" id='month' name="month" class="form-control">
                           <div class="error" style="color:red;"></div>
                           </div>
                           
                      </div>  
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Advance Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="" class="form-control col-md-7 col-xs-12 num" maxlength="25" name="amount" placeholder="Advance Amount...." required="required" type="text">
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
               
             <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Advance Salary View</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="x_content">
                     <div class="row">
                        
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th style="width:100px;">Name</th>
                          <th style="width:100px;">Refrence</th>
                          <th style="width:100px;">Advance Amount</th>
                          <th style="width:100px;">Month</th>
                          <th>Actions</th>
                        </tr>
                      </thead>


                      <tbody class="center">
                       
                      </tbody>
                    </table>

                   
                    
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
        
    $('#type').change(function(){
                 
                var value=$(this).val();
                
                
                $.get("<?php echo base_url(); ?>load/getemp/"+value,{},function(d){
                    var pre = '<option value="">Select Employee</opiton>';
                    $("#emp").html(pre+d);
                });
                tabledata(value);

            });
            function tabledata(val){
               $.get("<?php echo base_url(); ?>load/getemp_advance/"+val,{},function(d){
                   $("tbody.center").html(d);

                    
                });
            }

            $('#emp').change(function(){
                 var ref=$('#type').val();
                 var val=$(this).val();
                
                 $.ajax({
                   url:"<?php echo base_url(); ?>load/getemp_advance1/"+val+"/"+ref,
                   data:{},
                   success:function(result){
                     var d=jQuery.parseJSON(result);
                     
                     var ret = "";
                     $("tbody.center").empty();
                     $.each(d, function(i,v){
                       
                       ret += "<tr><td>"+(++i)+"</td><td>"+v.firstname+" "+v.lastname+"</td><td>"+v.refrence+"</td><td>"+v.Amount+"</td><td>"+v.month+"</td><td><a href='<?php echo base_url(); ?>salary/actions/del/"+v.id+"'><i class='fa fa-trash'></i></a>  <a href='<?php echo base_url(); ?>salary/actions/edit/"+v.id+"'><i class='fa fa-pencil'></i></a></td></tr>";
                     });
                     $("tbody.center").html(ret);
                   },
                 });

            });
            $('#month').change(function(){
              var val=$('#month').val();
              var alag = val.split("-");
              var sy=parseInt(alag[0]);
              var sm=parseInt(alag[1]);
              var d = new Date();
              var m = d.getMonth()+1;
              var y = d.getFullYear();
              if(sy>=y && sm>=m){
                 $('#send').prop("disabled",false);
                  $('.error').html("");
              }else{
                $('.error').html("Please dont Select Today Date below ");
                $('#send').prop("disabled",true);
                
              }
              });
      
        </script>   