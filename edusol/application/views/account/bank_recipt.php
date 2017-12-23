
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Bank Receipt</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
<?php if(!empty($values)){
 
$pid=$this->db->select('program_id')->from('project')->where('id',$values['project_id'])->get() ->result_array()[0]['program_id'];

}else{
$pid=0;
}
 ?>
                    <form class="form-horizontal form-label-left" <?php if(!empty($values)){ echo "action=".base_url()."account/print_bank"; }else{ echo  "action=".base_url()."account/save_cash_recpt"; }  ?>   method="post" enctype="multipart/form-data">
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Program<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select <?php  if($pid!=0){echo "disabled";} ?> name="programe" id="program" class="form-control" required>
                              <option value="">Select program</option>
                               <?php
                              foreach ($pro as $value) {
                                ?>
                                <option <?php  if($pid==$value['id']){echo "selected";} ?>  value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>  
                                <?php
                              }  
                              ?>
                            </select>

                        </div>
                      </div>
                      <div class="item form-group" id="project_">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Project<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select <?php  if($pid!=0){echo "disabled";} ?> name="project" id="project" class="form-control" required>
                              <option value="">Select Project</option>
                               <?php if($values!=null){
                                foreach ($proj as $value) { ?>
                              
                               <option <?php  if($value['id']==$values['project_id']){echo "selected";} ?> value="<?php echo $value['id'];?>"><?php echo $value['p_name'];?></option>  
                         
                              <?php } }?>
                            </select>

                        </div>
                      </div>
                       <div class="item form-group" id="main_head">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Main Head<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select <?php  if($values['main_head_id']!=0){echo "disabled";} ?> name="main_head" id="main" class="form-control" required>
                              <option value="">Select Main Head</option>
                              <?php
                              foreach ($mainhead as $value) {
                                ?>
                                <option <?php  if($values['main_head_id']==$value['id']){echo "selected";} ?> value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>  
                                <?php
                              }  
                              ?>
                            </select>

                        </div>
                      </div>
                      <div class="item form-group" id="head_level2">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Head Level 2<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select <?php  if($values['level_2_id']!=0){echo "disabled";} ?>  name="level2" id="level2" class="form-control" required>
                              <option value="">Select Head Level 2</option>
                               <?php if($values!=null){
                                foreach ($l2 as $value) { ?>
                              
                               <option <?php  if($value['id']==$values['level_2_id']){echo "selected";} ?> value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>  
                         
                              <?php } }?>
                            </select>

                        </div>
                      </div>
                       <div class="item form-group" id="head_level3">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Head Level 3<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select <?php  if($values['level_3_id']!=0){echo "disabled";} ?> name="level3" id="level3" class="form-control" required>
                              <option value="">Select Head Level 3</option>
                               <?php if($values!=null){
                                foreach ($l3 as $value) { ?>
                              
                               <option <?php  if($value['id']==$values['level_3_id']){echo "selected";} ?> value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>  
                         
                              <?php } }?>
                            </select>

                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bank<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select <?php  if($values['bank_id']!=0){echo "disabled";} ?>  name="bank" id="bank" class="form-control" required>
                              <option value="">Select Bank</option>
                              <?php
                              foreach ($bank as $value) {
                                ?>
                                <option <?php  if($value['id']==$values['bank_id']){echo "selected";} ?>  value="<?php echo $value['id'];?>"><?php echo $value['b_name']." ".$value['b_code'];?></option>  
                                <?php
                              }  
                              ?>
                            </select>

                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Date<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="date" <?php  if($values['date']!=null){echo "value=".$values['date']." disabled";} ?>  id="date" value="<?php echo date('Y-m-d') ?>" class="form-control date" maxlength="20" required>                    
                        </div>
                      </div>   
                       
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">From<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="from" <?php  if($values['from_recpt']!=null){echo "value=".$values['from_recpt']." disabled";} ?>  id="from" class="form-control abc" maxlength="20" required>                    
                        </div>
                      </div> 
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Cheque #<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="cheque" <?php  if($values['cheque#']!=null){echo "value=".$values['cheque#']." disabled";} ?> id="cheque" class="form-control num" maxlength="20" required>                    
                        </div>
                      </div> 
                       <?php if(!empty($values)){}else{ ?>  
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">Cheque Pic<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                     <input type="file" name="pic">      
                        </div>
                      </div>   
<?php } ?>
            
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea name="description" <?php  if($values['description']!=null){echo "disabled";} ?>  id="des" class="form-control abc"  required><?php if($values['description']!=null){echo $values['description'] ;} ?></textarea>                                       
                        </div>
                      </div>  
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="amount" <?php  if($values['amount']!=null){echo "value=".$values['amount']." disabled";} ?>  id="amount" class="form-control num" maxlength="20" required>                    
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <?php if($values==null){?>
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success pull-right">Add</button>
                        </div>
                         <?php }else{ ?>
                         <input type="hidden" name="id" value="<?php echo $values['id']; ?>" >
                      <input type="hidden" name="invoice_name" value="Bank Receipt" >
                      <div class="col-md-6 col-md-offset-3">
                          <button id="submit" type="submit" class="btn btn-success pull-right">Print</button>
                        </div>
                        <?php } ?>
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
     <?php if($values==null){?>
      $(document).ready(function(){
            $('#project_').hide();
            $('#main_head').hide();
            $('#head_level2').hide();
            $('#head_level3').hide();

        });
<?php }
         ?>
        $('#program').change(function(){
          var id=$(this).val();
           $('#project_').show();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/proagainstproject/"+id,
                    data: {},
                      success: function( d ) {
                         var pre='<option value="">Select Project</option>';
                          $( "#project" ).html(pre+d);
  }
});

        });
        $('#project').change(function(){
            $('#main_head').show();
        });
        $('#main').change(function(){
          var id=$(this).val();
          $('#head_level2').show();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/level2_db/"+id,
                    data: {},
                      success: function( d ) {
                         var pre='<option value="">Select Head Level 2</option>';
                          $( "#level2" ).html(pre+d);
  }
});

        });
        $('#level2').change(function(){
          var id=$(this).val();
           $('#head_level3').show();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/level3_db/"+id,
                    data: {},
                      success: function( d ) {
                         var pre='<option value="">Select Head Level 3</option>';
                          $( "#level3" ).html(pre+d);
  }
});

        });
         
        </script>   