        <!-- page content -->
         <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Student</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                  </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Student Update <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                   
    <div class="demo-settings" data-open="true">
        
        <div class="settings-main">
            <label>Step effect</label>
            <select class="form-control" id="stepEffect">
                <option value="basic" selected="selected">basic</option>
                <option value="bounce">bounce</option>
                <option value="slideRightLeft">slideRightLeft</option>
                <option value="slideLeftRight">slideLeftRight</option>

                <option value="flip">flip</option>
                <option value="transformation">transformation</option>
                <option value="slideDownUp">slideDownUp</option>
                <option value="slideUpDown">slideUpDown</option>
            </select>
            <br />
            <label for="stepTransition">
                Step transition <input type="checkbox" id="stepTransition" name="stepTransition" value="11" checked />
            </label>
            <br />
            <label for="showButtons">
                Show buttons <input type="checkbox" id="showButtons" name="showButtons" value="111" checked />
            </label>
            <br />
            <label for="showStepNum">
                Show stepNum <input type="checkbox" id="showStepNum" name="showStepNum" value="123" checked />
            </label>


        </div>
    </div>

    <div class="container">
        <div class="row">
            
            <!-- BEGIN STEP FORM WIZARD -->
            <div class="tsf-wizard tsf-wizard-1">
                <!-- BEGIN NAV STEP-->
                <div class="tsf-nav-step">
                    <!-- BEGIN STEP INDICATOR-->
                    <ul class="gsi-step-indicator triangle gsi-style-1  gsi-transition ">
                        <li class="current" data-target="step-1">
                            <a href="#0">
                                <span class="number">1</span>
                                <span class="desc">
                                    <label>Personal Information</label>
                                    <!-- <span>Account details</span> -->
                                </span>
                            </a>
                        </li>
                        <li data-target="step-2">
                            <a href="#0">
                                <span class="number">2</span>
                                <span class="desc">
                                    <label>Father / Guardian Information</label>
                                    <!-- <span>Profile details</span> -->
                                </span>
                            </a>
                        </li>
                        <li data-target="step-3">
                            <a href="#0">
                                <span class="number">
                                    3
                                </span>
                                <span class="desc">
                                    <label>School Information</label>
                                    <span></span>
                                </span>
                            </a>
                        </li>
                        <li data-target="step-4">
                            <a href="#4">
                                <span class="number">
                                    4
                                </span>
                                <span class="desc">
                                    <label>Fee Detail</label>
                                    <span></span>
                                </span>
                            </a>
                        </li>
                    </ul>
               
                <!-- BEGIN STEP CONTAINER -->

                <div class="tsf-container">
                    <!-- BEGIN CONTENT-->
                   
                    <form class="tsf-content" method="POST" action="<?php echo base_url();?>student/update"  enctype="multipart/form-data">
                        <!--<form class="tsf-form">-->
                        <!-- BEGIN STEP 1-->
                        
                        <div class="tsf-step step-1 active">
                            <fieldset>
                                <legend>Provide personal details</legend>
                                <div class="row">
                                    <!-- BEGIN STEP CONTENT-->
                                    <div class="tsf-step-content">
                                        
                                        <div class="row">
                                          <div class="form-group">
                                                <div class="col-lg-3 col-lg-offset-2">
                                                <label for="name">GR NO</label>
                                                <?php echo form_error('gr',"<p style='color:red;font-size:12px;'>");?>
                      <input type="hidden" value="<?php echo $val['stid'];?>" name="id">

                                                
                                                <input type="text" class="form-control required" id="gr" name="gr" placeholder="Student GR No." required="ture" value="<?php echo $val['grno']; ?>" disabled>
                                            </div>
                                                <div class="col-lg-3 col-lg-offset-2">

                                                <label for="doa">Date of Admission</label>
                                                <input type="text" class="DMY form-control required" id="doa" name="doa" placeholder="dd-mm-yyyy" required="true" value="<?php echo date('d-m-Y',strtotime($val['date_of_admission']));?>" >
                                            </div>
                                            </div>
                                          </div>
                                          <br>
                                        <div class="col-lg-6 col-lg-offset-3">
                                            




                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control required" id="name" name="name" placeholder="Student Name" required="ture" pattern="[A-Za-z- ]{3,}" title="Only alphabatic character" value="<?php echo $val['student_name'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="fathername">Father Name</label>
                                                <input type="text" id="fathername" name="fathername" required="required" class="form-control col-md-7 col-xs-12" pattern="[A-Za-z- ]{3,}" title="Only alphabatic character" value="<?php echo $val['father_name'];?>">
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="surname">Surname</label>
                                                  <input id="surname" name="surname" class="form-control col-md-7 col-xs-12" type="text" pattern="[A-Za-z- ]{3,}" title="Only alphabatic character" value="<?php echo $val['surname'];?>">
                                              
                                            </div>
        <div class="form-group">
         
        <label for="Image">Image</label>
    <div style="margin:5px 0px;"> <img class="img-responsive avatar-view" src="<?php echo base_url().$val['img']; ?>"></div>
</div>
                                            <div class="form-group">
                  <?php
                                                              $pic = array(
                              'name' => 'pic',
                               'id' => 'pic', 
                               'class'=> 'form-control',
                            );
                      echo form_label('Picture');
                      echo form_upload($pic);  
                  ?>
                                                
                                            </div>

                                            <div class="form-group">
                                                <label for="dob">Date of Birth</label>
                                                  <input id="dob" name="dob" class="DMY form-control col-md-7 col-xs-12" placeholder="dd-mm-yyyy" required="required" type="text" value="<?php echo date('d-m-Y',strtotime($val['dob']));?>">                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="dob_words">Date of Birth in words</label>
                                                  <input id="dob_words" name="dob_words" class="form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $val['dob_words']; ?>" >                                   
                                            </div>
                                            <label>Gender </label>
                                    <div class="radio">
                                        <label>
                                            <input <?php if($val['gender']=="Male"){echo "checked";} ?> type="radio" name="gender" value="Male"  required="">
                                            Male
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input <?php if($val['gender']=="Female"){echo "checked";} ?> type="radio" name="gender" value="Female">
                                            Female
                                        </label>
                                    </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="dob">Student Contact#</label>
                                                  <input id="student_contact" name="student_contact" class=" form-control col-md-7 col-xs-12"  type="text" pattern="[\+]\d{2}\d{4}\d{6}" title='Phone Number Format:+923027566364' placeholder="+923027566364" value="<?php echo $val['student_contact'];?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="dob">Religion</label>
                                                  <input id="religion" name="religion" class=" form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $val['religion'];?>">
                                            </div>
                                             <div class="form-group">
                                                <label for="dob">Mark of Identification</label>
                                                  <input id="mark_of_identification" name="mark_of_identification" class=" form-control col-md-7 col-xs-12" pattern="[A-Za-z]{1,}" type="text" value="<?php echo $val['mark_identification'];?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="dob">Mother tongue</label>
                                                  <input id="mother_tongue" name="mother_tongue" class=" form-control col-md-7 col-xs-12" pattern="[A-Za-z]{1,}"  type="text" value="<?php echo $val['mother_tongue'];?>">
                                            </div>


                                  <label>Place Of Birth</label>
                                    <div class="form-group">
                                                <label for="dob">District</label>

                                                   <select id="district" name="district" class="date-picker form-control col-md-7 col-xs-12" >
                                <option value="">Select District</option>
                              
                                       <?php       //$this->db->where('is_delete',0) ;
                                $dis=$this->db->get('district')->result_array();
                                
                                     foreach ($dis as $key => $di) {?>
                     <option <?php if($val['district']==$di['id']){echo "selected";} ?>  value="<?php echo $di['id']; ?>"><?php echo $di['name']?></option>

                  <?php } ?>
              </select>
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="dob">Taluka</label>
                                                   <select id="taluka" name="taluka" class="date-picker form-control col-md-7 col-xs-12" required="true">
                                
                                <option   value="">Select Taluka</option>
                              <?php       //$this->db->where('is_delete',0) ;
                                $dis=$this->db->get('city')->result_array();
                                
                                     foreach ($dis as $key => $ci) {?>
                                      <option <?php if($val['taluka']==$ci['city_id']){echo "selected";} ?>  value="<?php echo $ci['city_id']; ?>"><?php echo $ci['city_name']?></option>

                  <?php } ?>
                              </select>
                                            </div>




                                             
                                            <div class="form-group">
                                                <label for="dob">Perment Address</label>
                              <textarea id="permentaddess" name="permentaddess"  class="form-control" required="true"><?php echo $val['perment_address'];?></textarea>
                                                   
                              </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="dob">Postal Address</label>
                              <textarea id="potaladdess" name="postaladdess"  class="form-control"><?php echo $val['postal_address'];?></textarea>
                              
                                                   
                              </select>
                                            </div>

                                        </div><!-- col-lg-6 col-lg-offset-3 -->
                                        
                                    </div>
                                    <!-- END STEP CONTENT-->
                                </div>

                            </fieldset>
                        </div>
                        <!-- END STEP 1-->
                        <!-- BEGIN STEP 2-->
                        <div class="tsf-step step-2">
                            <fieldset>
                                <legend>Father / Guardian Details</legend>
                                <!-- BEGIN STEP CONTENT-->
                                <div class="tsf-step-content">
                                    <div class="form-group">
                                        <label for="fathercontact">Father Contact#</label>
                                        <input type="text" class="form-control" id="fathercontact" name="fathercontact" placeholder="e.g +923027566364" required="true" pattern="[\+]\d{2}\d{4}\d{6}" title='Phone Number Format:+923027566364' value="<?php echo $val['father_contact'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="fathercnic">Father CNIC</label>
                                        <input type="text" class="form-control" id="fathercnic" name="fathercnic" placeholder="e.g 123456789" required="true" pattern="\d{5}\d{7}\d{1}" title="1234512345671 (13 numbers)" value="<?php echo $val['father_cnic'];?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="fatheroccupation">Father Occupation</label>
                                        <input type="text" class="form-control" id="fatheroccupation" name="fatheroccupation" placeholder="Father Occupation" pattern="[A-Za-z]{3,}" value="<?php echo $val['father_occupation'];?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="guardianname">Guardian Name</label>
                                        <input type="text" class="form-control" id="guardianname" name="guardianname" placeholder="Guardian Name" pattern="[A-Za-z]{3,}" value="<?php echo $val['guardian_name'];?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="guardiancontact">Guardian Contact#</label>
                                        <input type="text" class="form-control" id="guardiancontact" name="guardiancontact" placeholder="+923027566364" pattern="[\+]\d{2}\d{4}\d{6}" value="<?php echo $val['guardian_contact'];?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="guardiancnic">Guardian CNIC</label>
                                        <input type="text" class="form-control" id="guardiancnic" name="guardiancnic" placeholder="1234512345671" pattern="\d{5}\d{7}\d{1}" value="<?php echo $val['guardian_cnic']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="guardianoccupation">Guardian Occupation</label>
                                        <input type="text" class="form-control" id="guardianoccupation" name="guardianoccupation" placeholder="Guardian Occupation" pattern="[A-Za-z]{3,}" value="<?php echo $val['guardian_occupation'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="relationguardian">Relation with Guardian </label>
                                        <input type="text" class="form-control" id="relationguardian" name="relationguardian" placeholder="Guardian Relation" pattern="[A-Za-z]{3,}" value="<?php echo $val['relation_with_guardian'];?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="familyincome">Family Income</label>
                                        <input type="number" class="form-control" id="familyincome" name="familyincome" placeholder="Guardian Occupation" value="<?php echo $val['income_family'];?>">
                                    </div>
                                    
                                </div>
                                <!-- END STEP CONTENT-->
                            </fieldset>
                        </div>
                        <!-- END STEP 2-->
                        <!-- BEGIN STEP 3-->
                        <div class=" tsf-step step-3 ">
                            <fieldset>
                                <legend>Admission information</legend>
                                <!-- BEGIN STEP CONTENT-->
                                <div class="tsf-step-content">
                                    
                                  <div class="form-group">
                                        <label for="familyincome">Previous School</label>
                                        <input type="text" class="form-control" id="preschool" name="preschool" placeholder="Previous School" value="<?php echo $val['previous_school'];?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="familyincome">Select Branch</label>
                                        <select class="form-control" name="branch" id="branch">
                                      <option value="">Select Branch</option>
                                       <?php       $this->db->where('is_delete',0) ;
                                $com=$this->db->get('branch')->result_array();
                              foreach ($com as $key => $branc) {?>
                 
                    <option <?php if($val['branch']==$branc['id']){ echo "selected";} ?> value="<?php echo $branc['id']; ?>"><?php echo $branc['name'];?></option>

                  <?php } ?>
                                 </select>  

                                    </div>
                                    <div class="form-group">
                                        <label for="familyincome">Select Class</label>
                                       <select name="class_id" id="class_id" class="form-control col-md-12 col-sm-12 col-xs-12" required="required">
                                
                                <option value="">Select Class</option>
                                 <?php       $this->db->where('is_delete',0) ;
                                $class=$this->db->get('class')->result_array();
                              foreach ($class as $value) {?>
                  
                   <option <?php if($val['class_id']==$value['class_id']){ echo "selected";} else{echo "";} ?> value="<?php echo $value['class_id']; ?>"><?php echo $value['class_name'];?></option>

                  <?php } ?>
                            </select>  

                                    </div>
                                    <div class="form-group">
                                        <label for="section">Section</label>
                                        <select class="form-control" name="section" id="section" class="form-control" required>
                                      <option value="">Select Section</option>
                                  <?php       $this->db->where('is_delete',0)->where('class_id',$val['class_id']) ;
                                $sec=$this->db->get('section')->result_array();
                              foreach ($sec as $value) {?>
                  
                   <option <?php if($val['section_id']==$value['section_id']){ echo "selected";} else{echo "";} ?> value="<?php echo $value['section_id']; ?>"><?php echo $value['section_name'];?></option>

                  <?php } ?>
                                 </select>  

                                    </div>
                                          <div class="form-group">
                                        <label for="section">Session</label>
                                        <select class="form-control" name="session" id="Session" class="form-control" required>
                                      <option value="">Select Section</option>
                                       <?php  $this->db->select('id,name');$this->db->from('session');
$this->db->where('is_delete',0);
                                $com=$this->db->get()->result_array();
                                              foreach ($com as $key => $value) {
                  ?>
                                   <option <?php if($val['session_id']==$value['id']){ echo "selected";}else {echo "";} ?> value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>

                  <?php } ?>
                                 </select>  

                                    </div>
                                    <div class="form-group">
                                        <label for="familyincome">Class Admitted</label>
                                       <select name="class_admited" id="class_admited" class="form-control col-md-12 col-sm-12 col-xs-12" required="required">
                                
                                        <option value="">Select Class</option>
                                        <?php       $this->db->where('is_delete',0) ;
                                        $class=$this->db->get('class')->result_array();
                                         foreach ($class as $value) {?>
                                        <option <?php if($val['class_admited']==$value['class_id']){ echo "selected";} else{echo "";} ?> value="<?php echo $value['class_id']; ?>"><?php echo $value['class_name'];?></option>
                                        <?php } ?>
                                        </select>  

                                    </div>

                                 

                                </div>
                                <!-- END STEP CONTENT-->

                            </fieldset>
                        </div>
                        <!-- END STEP 3-->
                        <!-- BEGIN STEP 4-->
                        <div class=" tsf-step step-4 ">
                            <fieldset>
                                <legend>Fee Details</legend>
                                <!-- BEGIN STEP CONTENT-->
                                <div class="tsf-step-content">
                                    <div class="form-group">
                                        <label for="fee_pack">Tution Fee</label>
                                        <input type="number" class="form-control" id="fee_pack" name="fee_pack" placeholder="Fee Package" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="disc_type">Select Discount Type</label>
                                        <select class="form-control" name="disc_type" id="disc_type">
                                            <option value="">Select Discount Type</option>
                                            <option value="percentage" <?php if($val['disc_type']=="percentage"){echo "selected";} ?> >Percentage (%)</option>
                                            <option value="rupees" <?php if($val['disc_type']=="rupees"){echo "selected";} ?> >Rupees (RS)</option>
                                        </select>  
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="disc">Discount</label>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <input type="number" min="1" max="100" name="disc_value" id="disc_per" class="form-control" <?php if($val['disc_type']=="percentage"){echo "value='".$val['disc_value']."'";}else{echo "disabled";} ?> placeholder="IN %">
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <input type="number" min="1" name="disc_value" id="disc_rs" class="form-control" <?php if($val['disc_type']=="rupees"){echo "value='".$val['disc_value']."'";}else{echo "disabled";} ?> placeholder="IN RS">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="net_fee">Fee Package</label>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="number" name="net_fee" id="net_fee" class="form-control" readonly="readonly" placeholder="Fee Package" required="required">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END STEP CONTENT-->
                            </fieldset>
                        </div>
                        <!-- END STEP 4-->
                        <!--</form>-->
                    
                    <!-- END CONTENT-->
                    <!-- BEGIN CONTROLS-->
                    <div class="tsf-controls ">
                        <!-- BEGIN PREV BUTTTON-->
                        <button type="button" data-type="prev" class="btn btn-left tsf-wizard-btn">
                            <i class="fa fa-chevron-left"></i> PREV
                        </button>
                        <!-- END PREV BUTTTON-->
                        <!-- BEGIN NEXT BUTTTON-->
                        <button type="button" data-type="next" class="btn btn-right tsf-wizard-btn">
                            NEXT <i class="fa fa-chevron-right"></i>
                        </button>
                        <!-- END NEXT BUTTTON-->
                        <!-- BEGIN FINISH BUTTTON-->
                        <button type="submit" data-type="finish" class="btn btn-right tsf-wizard-btn">
                            FINISH
                        </button>
                        <!-- END FINISH BUTTTON-->
                    </div>
                    <!-- END CONTROLS-->
                </div>
                <!-- END STEP CONTAINER -->
</form>

            </div>





                </div>
              </div>
            </div> 
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            EduSolutions
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url(); ?>assets/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url(); ?>assets/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url(); ?>assets/js/flot/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/date.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/curvedLines.js"></script>
    <!-- jVectorMap -->
    <script src="<?php echo base_url(); ?>assets/js/maps/jquery-jvectormap-2.0.3.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/build/js/custom.min.js"></script>
 

    <!-- jQuery Smart Wizard -->
    <script src="<?php echo base_url(); ?>assets/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/validator/validator.js"></script>


<!--  -->
<!-- <script src="<?php echo base_url();?>assets/formwizard/js/jquery-1.11.3.min.js"></script> -->
    <script src="<?php echo base_url();?>assets/formwizard/js/demo.js"></script>

    <script src="<?php echo base_url();?>assets/formwizard/plugin/parsley/js/parsley.js"></script>

    <script src="<?php echo base_url();?>assets/formwizard/js/tsf-wizard-plugin.js"></script>


    <script>
        $(function () {
            pageLoadScript();
        });
    

        function pageLoadScript() {

            _stepEffect = $('#stepEffect').val();
            _style = 'style1';
            _stepTransition = $('#stepTransition').is(':checked');
            _showButtons = $('#showButtons').is(':checked');
            _showStepNum = $('#showStepNum').is(':checked');


          tsf1=  $('.tsf-wizard-1').tsfWizard({
                stepEffect: _stepEffect,
                stepStyle: _style,
                navPosition: 'top',
                validation: true,
                stepTransition: _stepTransition,
                showButtons: _showButtons,
                showStepNum: _showStepNum,
                height: 'auto',
                onNextClick: function (e, from, to, validation) {
                    $('#result').append('<br/>onNextClick from ' + from +
                        ' - to ' + to + ' validation ' + validation);
                },
                onPrevClick: function (e, from, to) {
                    $('#result').append('<br/>onPrevClick from ' + from + ' - to ' + to);
                },
                onFinishClick: function (e, validation) {
                    $('#result').append('<br/>onFinishClick validation ' + validation);
                }
            });         


        }
    </script>
<script>
        $(document).ready(function(){
        
        $('.DMY').daterangepicker({
      	format: 'DD-MM-YYYY',
        singleDatePicker: true,
        showDropdowns: true
    	});
        
		var c_id = $("#class_id").val();
                $.get("<?php echo base_url(); ?>load/package/"+c_id,{},function(d){
                    $("#fee_pack").val(d);
                    var v = $("#disc_type").val();
                    if(v=="percentage")
                    {
                        var val = $("#disc_per").val();
                        var sum = d - (d * (val / 100));
                        $("#net_fee").val(sum);
                    }else if(v=="rupees"){
                        var val = $("#disc_rs").val();
                        var sum = d - val;
                        $("#net_fee").val(sum);
                    }else{
                        $("#net_fee").val(d);
                    }
                });
            $(document).on("change","#branch",function(){
                var value = $(this).val();
                 $("#class_id").empty();
                $.get("<?php echo base_url(); ?>load/classs/role/"+value,{},function(d){
                    var pre = '<option value="">Select class</opiton>';
                    $("#class_id").html(pre+d);
                    $("#class_admited").html(pre+d);
                });
            });
            $(document).on("change","#class_id",function(){
                var value = $(this).val();
                $("#section").empty();
                $.get("<?php echo base_url(); ?>load/section/role/"+value,{},function(d){
                    var pre = '<option value="">Select Section</opiton>';
                    $("#section").html(pre+d);
                });
                $.get("<?php echo base_url(); ?>load/package/"+value,{},function(d){
                    $("#fee_pack").val(d);
                    var v = $("#disc_type").val();
                    if(v=="percentage")
                    {
                        var val = $("#disc_per").val();
                        var sum = d - (d * (val / 100));
                        $("#net_fee").val(sum);
                    }else if(v=="rupees"){
                        var val = $("#disc_rs").val();
                        var sum = d - val;
                        $("#net_fee").val(sum);
                    }else{
                        $("#net_fee").val(d);
                    }
                });
            });
            $(document).on("change","#district",function(){
                var value = $(this).val();
                 $("#taluka").empty();
                $.get("<?php echo base_url(); ?>load/taluka/role/"+value,{},function(d){
                    var pre = '<option value="">Select taluka</opiton>';
                    $("#taluka").html(pre+d);
                });
            });
            $(document).on("change","#disc_type",function(){
                var val = $(this).val();
                if(val=="")
                {
                    $("#disc_per").prop('disabled', true);
                    $("#disc_rs").prop('disabled', true);
                }else if (val=="percentage") {
                    $("#disc_per").prop('disabled', false);
                    $("#disc_rs").prop('disabled', true);
                }else if(val=="rupees")
                {
                    $("#disc_per").prop('disabled', true);
                    $("#disc_rs").prop('disabled', false);
                }
            });
            $(document).on("keyup","#disc_per",function(){
                var val = $(this).val();
                var tut = $("#fee_pack").val();
                var type = $("#disc_type").val();
                if(type=="percentage")
                {
                    var ret = (tut * val) / 100;
                    var retur = tut - ret;
                    $("#net_fee").val(retur); 
                }
            });
            $(document).on("keyup","#disc_rs",function(){
                var val = $(this).val();
                var tut = $("#fee_pack").val();
                var type = $("#disc_type").val();
                if(type=="rupees")
                {
                    var retur = tut - val;
                    $("#net_fee").val(retur); 
                }
            });
        });
    </script>

  </body>
</html>