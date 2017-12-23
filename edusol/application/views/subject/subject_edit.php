

  <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Subject</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Subject</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>subject/savesub" method="post">
                        <input type="hidden" name="branchid" value="<?php echo $branch; ?>" id="branch_id" />
                        <?php 
                       if(!$this->user_model->is_super()){
                            ?>
                        <input type="hidden" name="id" value="<?php echo $subject['id']; ?>" id="branch_id"  /><?php 
                        }else{?>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Branch <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="branch" id="branch">
                                      <option value="">Select Branch</option>
                                       <?php      
                               
                             foreach ($branch as $key => $value) {
                                
                  ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $this->user_model->limitText($value['name'], 8);?></option>

                  <?php } ?>
                                 </select> 
                           </div>
                      </div>
                       <?php } ?>
                      <div class="item form-group" id="classhide">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Class <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="class" id="class">
                                      <option value="">Select Class</option>
                            
                                 </select>                    
                        </div>
                      </div>    
                      <div class="item form-group" id="sectionhide">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Section <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="section" id="section">
                                      <option value="">Select Section</option>
                            
                                 </select>                    
                        </div>
                      </div> 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="b_head" class="form-control col-md-7 col-xs-12 abc1" value="<?php echo $subject['name']; ?>" maxlength="25" name="subname" placeholder="Subject Name...." required="required" type="text">
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </form>
                   </div>
                </div>
              </div>
            </div>
          </div>
        </div>
               <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
        <script>
         $(document).ready(function(){
        var value=$('#branch_id').val();
            $('#sectionhide').hide();
            $('#classhide').hide();
           
           $.get("<?php echo base_url(); ?>load/classs/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $("#class").html(pre+d);
                });
            });
    
             $('#branch').change(function(){
                 
                var value=$(this).val();
                $('#class').empty();
                
                $.get("<?php echo base_url(); ?>load/classs/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $("#class").html(pre+d);
                });
            });
         $('#class').change(function(){
                 
                var value=$(this).val();
                
                
                $.get("<?php echo base_url(); ?>load/section/role/"+value,{},function(d){
                    var pre = '<option value="">Select Section</opiton>';
                    $("#section").html(pre+d);
                });

            });
      
        </script>  