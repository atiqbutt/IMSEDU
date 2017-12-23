 
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
                    <h2>Deduction Assign</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="form-horizontal form-label-left">
                        
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <select class="form-control" name="type" id="type">
                                    <option value="">Select Type</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="staff">Staff</option>
                                 </select> 
                           </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 abc" for="name">Employee Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="hidden" id="searchid" name="empid" class="form-control"  >
                            <input type="text" id="searchv" name="empname" class="form-control"  >
                            <ul class="searchArea col-md-6 col-sm-6 col-xs-6">
                            </ul>
                           </div>
                      </div>
                      
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 num" for="name">Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="text" id="ammount" name="amount" class="form-control"  >
                           </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 abc1" for="name">Reason<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <textarea type="text" id="reason" name="reason" class="form-control"  ></textarea>
                           </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="month">Month <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="month" id='month' min="<?php echo date("Y-m",strtotime('-1 month')); ?>" name="month" class="form-control">
                             <div class="error" style="color:red;"></div>
                           </div>
                      </div> 
                            <div class="form-group">
                        <div class="col-md-6 col-md-offset-3 pull-right">
                          <button id="send" type="button" class="btn btn-success">Add</button>
                        </div>
                      </div>
                    </div>
                    <form action="<?php echo base_url(); ?>salary/savededuction/" method="post" >
                    <div class="table-responsive">
                        <table class="table table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                     <th>Amount</th>
                                    <th>Deduction Reason</th>
                                   
                                    <th>Month</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_body"></tbody>
                        </table>
                        <div class="form-group" id="submit">
                        <div class="col-md-6 col-md-offset-3 pull-right">
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
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
            $('#submit').hide();
        });
         $('#month').change(function(){
              var val=$('#month').val();
               $.get("<?php echo base_url(); ?>load/checkdate/"+val,{},function(ret){
                   
               if(ret=="true"){
                 $('#send').prop("disabled",false);
                  $('.error').html("");
              }else{
                $('.error').html("Please dont Select wrong  Date ");
                $('#send').prop("disabled",true);
                
               }
               

             
            }); });
        $("#type").change(function(){
            
            $("#searchv").val("");
        });
            $(function(){
                $(document).on("keyup","#searchv",function(){
                    var val = $(this).val();
                    var ref=$('#type').val();
                    if(ref==""){
                        alert("Select Employee Type");}else{
                    $(".searchArea").addClass("show");
                    $.get("<?php echo base_url(); ?>load/data_emp/"+ref+"/"+val,{},function(ret){
                    var d=jQuery.parseJSON(ret);
                     var retu = "";
                      $.each(d, function(i,v){
                       retu += "<li id='"+v.id+"'>"+v.name+"</li>";
                     });
                        $(".searchArea").html(retu);
                    
                    });
                    setTimeout(hideSearch,40000);}
                });
                $(document).on("click",".searchArea > li",function(){
                    var val = $(this).html();
                    var id=$(this).attr("id");
                    
                    $("#searchv").val(val);
                    $('#searchid').val(id);
                    hideSearch();
                });
            });
            function hideSearch(){
                $(".searchArea").removeClass("show");
            }
            
            $("#allonce").change(function(){
            
                var id=$("option:selected",this).attr("data-amount");
                $("#ammount").val(id);
                
            });
        var entry_id = 0;
        $('#send').click(function(){
            var type=$("#type").val();
            var id=$("#searchid").val();
            var name=$("#searchv").val();
            var reason= $("#reason").val();
            var amount= $("#ammount").val();
            var month= $("#month").val();
            
            if(type!='' && id!='' && name!='' && reason!='' && amount!='' && month!='') {
                $("#table_body").append("<tr data-row='"+(++entry_id)+"'>"+
                    "<td>"+entry_id+"</td>"+
                    "<td>"+name+"<input type='hidden' name='entry["+entry_id+"][employee][id]' value='"+id+"'></td>"+
                    "<td>"+type+"<input type='hidden' name='entry["+entry_id+"][employee][type]' value='"+type+"'></td>"+
                    "<td>"+amount+"<input type='hidden' name='entry["+entry_id+"][deduction][amount]' value='"+amount+"'></td>"+
                    "<td>"+reason+"<input type='hidden' name='entry["+entry_id+"][deduction][reason]' value='"+reason+"'></td>"+
                "<td>"+month+"<input type='hidden' name='entry["+entry_id+"][deduction][month]' value='"+month+"'></td>"+
                    "<td><i class='fa fa-remove' data-row='"+entry_id+"'></td>"+
                "</tr>");
                clearSearch();
                
                $('#submit').show();
            }
            else {
                alert("Please insert data in the fields before insert!");
            }
        });
        $(document).on("click",".fa-remove",function(){
            var row_id = $(this).attr("data-row");
            $("tr[data-row='"+row_id+"']").remove();
            if($('.fa-remove').length<1)
            $('#submit').hide('fast');
        });
        function clearSearch()
        {
            $("#type option[value='']").prop("selected","selected");
            $("#searchid").val("");
            $("#searchv").val("");
            $("#reason").val("");
            $("#ammount").val("");
            $("#month").val("");
        }
        
        </script>