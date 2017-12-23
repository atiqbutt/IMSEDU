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
                    <h2>Allowance Assign Edit</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
               
                    <form class="form-horizontal form-label-left" action="<?php echo base_url(); ?>salary/Update_security/" method="post" >
                        
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <select class="form-control" name="type" id="type">
                                    <option value="">Select Type</option>
                                    <option <?php if($edit['refrence']=="teacher"){echo "selected";} ?> value="teacher">Teacher</option>
                                    <option <?php if($edit['refrence']=="staff"){echo "selected";} ?> value="staff">Staff</option>
                                 </select> 
                           </div>
                      </div>
                      <?php $data=$this->load_model->data_emp($edit['refrence'],$edit['bothid']); 
                     ?>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Employee Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="hidden" id="id" name="id" value="<?php echo $edit['id']; ?>" class="form-control"  >
                        <input type="hidden" id="searchid" name="empid" value="<?php echo $edit['bothid']; ?>" class="form-control"  >
                            <input type="text" id="searchv" name="empname" value="<?php echo $data['name']; ?>" class="form-control"  >
                            <ul class="searchArea col-md-6 col-sm-6 col-xs-6">
                            </ul>
                           </div>
                      </div>
                     <div class="item form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 num" for="name">Security Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="text" id="ammount" name="amount" value="<?php echo $edit['security_amount'] ?>" readonly class="form-control"  >
                           </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 abc1" for="name">Deduct Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="text" id="amountcut" name="amountcut" value="<?php echo $edit['detuct_amount'] ?>" class="form-control num"  >
                           </div>
                      </div>
                      <div class="item form-group" id="rem">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 abc1" for="name">Remendar Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="text" id="remandar" name="rem" readonly value="<?php echo $edit['remendar_amount'] ?>"  class="form-control num"  >
                           </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="month">Month <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="month" id='month' name="month" value="<?php echo $edit['month'] ?>"  class="form-control">
                           </div>
                      </div> 
                            <div class="form-group">
                        <div class="col-md-6 col-md-offset-3 pull-right">
                          <button id="send" type="submit" class="btn btn-success">Add</button>
                        </div>
                      </div>
                    </div>
                    </form>
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
        $("#type").change(function(){
            
            $("#searchv").prop("disabled",false);
            $("#amountcut").prop("disabled",false);
            $("#rem").prop("disabled",false);
            $("#month").prop("disabled",false);
            $("#send").show();
            $("#searchv").val("");
            $("#searchv").prop("disabled",false);
            $("#amountcut").prop("disabled",false);
            $("#rem").prop("readonly");
            $("#month").prop("disabled",false);
            $("#send").show();  
        });
       $('#amountcut').keyup(function(){
           var am=parseInt($(this).val());
           var se=parseInt($('#ammount').val());
           
           
           if(am>se){
               $('#amountcut').val("0");
               $('#remandar').val(se);
               
           }else{
               var remendar=se-am;
               $('#rem').show()
               $('#remandar').val(remendar);
               $('#remandar').prop("readonly");
           }

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
                    var type=$('#type').val();
                    
                    
                    $.get("<?php echo base_url(); ?>load/id_security/"+type+"/"+id,{},function(ret){
                       
                    var d=jQuery.parseJSON(ret);
                    if(d.security!=0){
                     $("#ammount").val(d.security);
                     $("#ammount").prop("disabled",true);
                    }else if(d.security==0){
                        $("#ammount").val(d.security);
                     $("#ammount").prop("disabled",true);
                        fielddisabled();
                        
                    }
                    });
                    

                    });
                });
           
            function hideSearch(){
                $(".searchArea").removeClass("show");
            }
            
        function clearSearch()
        {
            $("#type option[value='']").prop("selected","selected");
            $("#searchid").val("");
            $("#searchv").val("");
            $("#amountcut").val("");
            $("#ammount").val("");
            $("#rem").hide();
            $("#month").val("");
        }
        function fielddisabled(){
            $("#type option[value='']").prop("selected","selected");
            $("#searchv").prop("disabled",true);
            $("#amountcut").prop("disabled",true);
            $("#rem").prop("disabled",true);
            $("#month").prop("disabled",true);
            $("#send").hide();
        }
        </script>