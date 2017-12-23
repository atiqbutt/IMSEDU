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
                    <h2>View Salary</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>salary/salary_view" method="post">
                        
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <select class="form-control" name="type" id="type" required>
                                    <option value="">Select Type</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="staff">Staff</option>
                                 </select> 
                           </div>
                      </div>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Month <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="month" id='month' name="month" class="form-control" required>
                           </div>
                      </div>
                        
                      
                      
                      <div class="ln_solid"></div>
                      <div class="form-group ">
                        <div class="col-md-5 col-md-offset-5">
                          <button id="send" type="submit" class="btn btn-success">Next</button>
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
        