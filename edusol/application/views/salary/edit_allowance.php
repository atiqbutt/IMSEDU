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
                 
                    <form class="form-horizontal form-label-left" action="<?php echo base_url(); ?>salary/Update_assign/" method="post" >
                        
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
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Allonce Type<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <select name="allonce" id="allonce" class="form-control">
                        <option value="">Select Allonce</option>
                        <?php foreach ($allonce as $key => $value) { ?>
                            <option <?php if($edit['allowance_id']==$value['id']) {echo "selected";} ?> value="<?php echo $value['id']; ?>" data-amount="<?php echo $value['amount'] ?>"><?php echo $value['name']; ?></option>
                        <?php } ?>
                        </select>
                           </div>
                      </div>
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <input type="text" id="ammount" name="amount" value="<?php echo $edit['amount']; ?>" class="form-control"  >
                           </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="month">Month <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="month" id='month' value="<?php echo $edit['month'] ?>" name="month" class="form-control">
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
            </script>