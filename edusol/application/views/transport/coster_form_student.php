<?php
foreach ($student as $value)
 {
   $id=$value['id'];
   $grno=$value['grno'];
   $name=$value['student_name'];
   $f_name=$value['father_name'];
   $class=$value['class_name'];
   $address=$value['perment_address'];
 }
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Transport</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Student</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo base_url();?>transport/save_student_transport" method="post" id="form1">
                      


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">GR No<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" id="id" name="id" class="form-control" required="true" value="<?php echo @$id; ?>" readonly>                    
                        <input type="text" id="grno" name="grno" class="form-control" required="true" value="<?php echo @$grno; ?>" readonly>                    
                       
                        </div>
                      </div>    
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Student Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="student_name" name="student_name" class="form-control" required="true" value="<?php echo @$name; ?>" readonly>                    
                       
                        </div>
                      </div>

<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Father Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="father_name" name="father_name" class="form-control" required="true" value="<?php echo @$f_name ?>" readonly>                    
                       
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Class <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="class" name="class" class="form-control" required="true" value="<?php echo @$class ?>" readonly>                    
                       
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mark Of Identification<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="moi" name="moi" class="form-control" required="true" value="<?php echo @$moi?>" readonly>                    
                       
                        </div>
                      </div>
                     
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="address" name="address" class="form-control" required="true" value="<?php echo @$address;?>" readonly>                    
                       
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="status" id="status" class="form-control">
                              <option value="1">Active</option>
                              <option value="2">Deactive</option>
                          </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" id="city" name="city">
                            <option value="">Select City</option>
                              <?php
                                foreach ($city as $value) {
                                  ?>
                                  <option value="<?php echo $value['city_id']?>"><?php echo $value['city_name']; ?></option>
                                <?php }
                            ?>
                          </select>
                        <!-- <input type="text" id="city" name="city" class="form-control" required="true" value="" disabled>                     -->
                       
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Stop<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" id="stop" name="stop" required>
                          <option value="">Select Stop</option>
                          </select>
                        <!-- <input type="text" id="city" name="city" class="form-control" required="true" value="" disabled>                     -->
                       
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
            $(document).on("change","#city",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/stop_student/"+value,{},function(d){
                    var pre = '<option value="">Select Stop</opiton>';
                    $("#stop").html(pre+d);
                });
            });
            
        });
    </script>
        