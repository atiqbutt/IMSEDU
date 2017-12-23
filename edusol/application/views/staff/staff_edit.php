        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Staff</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Staff</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

          
                    <form class="form-horizontal form-label-left" action="<?php echo $base_url;?>Staff/update" method="post">

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Branch <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="branch" class="form-control col-md-7 col-xs-12"  name="branch" required="required">
                            

                            <option value=''>Select branch</option>
                    <?php        $branch=$this->user_model->getbranch();
                                $this->db->where('id',$branch);
                                $this->db->where('is_delete',0) ;
                                $com=$this->db->get('branch')->result_array();
                              foreach ($com as $value) {
                  ?>
                    <option value="<?php echo $value['id']; ?>" <?php if($values['branch']==$value['id']){echo "selected";} ?> ><?php echo $value['name']?></option>

                  <?php } ?>
                          </select>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="firstname" class="form-control col-md-7 col-xs-12 abc" value="<?php echo $values['firstname'];?>"   name="firstname" placeholder="First Name" required="required" type="text" aria-describedby="name-format"  title="Only alphabatic character">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="lastname" class="form-control col-md-7 col-xs-12 abc" value="<?php echo $values['lastname'];?>"  data-validate-words="2" name="lastname" placeholder="Last Name" required="required" type="text" aria-describedby="name-format">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">CNIC No <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="cnic" name="cnic"  value="<?php echo $values['cnic'];?>"  class="form-control col-md-7 col-xs-12" placeholder="Cnic NO" pattern="\d{5}\d{7}\d{1}" title="1234512345671 (13 numbers)">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact">Contact No <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="contact" name="contact" required="required" value="<?php echo $values['contact'];?>"  class="form-control col-md-7 col-xs-12" placeholder="Contact Number" pattern="[\+]\d{2}\d{4}\d{6}" title='Phone Number Format:+923027566364'>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Salary<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="salery" class="form-control col-md-7 col-xs-12" value="<?php echo $values['salery'];?>" data-validate-length-range="6" data-validate-words="2" name="salery" placeholder="Salary" required="required" type="number">
                        </div>
                      </div>
 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Security<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="security" class="form-control col-md-7 col-xs-12"  max="100000" name="security" value="<?php echo $values['security'];?>" placeholder="Security" required="required" type="number">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_h_contact">Designation <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="designation" name="designation" value="<?php echo $values['designation'];?>" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12 abc" placeholder="Designation"  title="Only alphatatic character">
                        </div>
                      </div>

                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_h_contact">Qualification<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="qualification" name="qualification"  value="<?php echo $values['qualification'];?>" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12" placeholder="Qualification">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Date of Birth<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="dob" type="date" name="dob" placeholder="Date of Birth" value="<?php echo $values['dob'];?>" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Date of joining<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="doj" type="date" name="doj" placeholder="Date of joining" value="<?php echo $values['doj'];?>" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12"><textarea id="address"  name="address" placeholder="Address" class="form-control col-md-7 col-xs-12" required="required"><?php echo  $values['address'];?></textarea></div>
                      </div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <input id="id" class="form-control col-md-7 col-xs-12" value="<?php echo $values['id'];?>" data-validate-length-range="6" data-validate-words="2" name="id" value="<?php echo $values['id'];?>" required="required" type="hidden">

                          <button id="send" type="submit" class="btn btn-success pull-right">Update</button>
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

      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
 <?php $this->load->view('footer');