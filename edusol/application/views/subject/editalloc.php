

        <!-- page content -->
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
                    <h2>Subject Allocation</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>subject/updatealloc" method="post">
                      
                      <input type="hidden" value="<?php echo $subject['id'] ?>" name="id" />
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Class <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" value="<?php echo $subject['class_id'] ?>" name="class_id" />
                        <h3><?php echo $subject['class_name']; ?></h3>                
                        </div>
                      </div>    
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Section <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" value="<?php echo $subject['section_id'] ?>" name="section_id" />
                            <h3><?php echo $subject['section_name']; ?></h3>                 
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Teacher<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" value="<?php echo $subject['teacher_id'] ?>" name="teacher_id" />
                       <h3><?php echo $subject['firstname']."".$subject['lastname']; ?></h3>                    
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Subjects<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group" id="sub">
                                  
                                  <?php
                                  foreach ($sub as $key => $value) {?>
                                     <input type="radio" <?php if($value['id']==$subject['subject_id']){ echo "checked";} ?> value="<?php echo $value['id'] ?>"  name='subject[]' /><?php echo $value['name'];?> <br> 
                                  <?php } ?>
                                  
                                 
                            </div>
                                                     
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
        <!-- /page content -->
         <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>