        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Status</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php if(!$is_super){ ?>
            <div class="row">
              <div class="col-md-7 col-sm-6 col-xs-12 col-lg-offset-2">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Staff Status</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>staff/status_update" method="post">

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role">Status <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select id="status" class="form-control col-md-7 col-xs-12" name="status" required="required">
                            <option value="">Select Status</option>
                             <?php       $branch=$this->user_model->getbranch();
                                       $this->db->where('is_delete',0) ;
                                       $this->db->where('type','Staff')->where('branch',$branch) ;
                                $satus=$this->db->get('status')->result_array();
                              foreach($satus as $value) {
                  ?>
                              <option value="<?php echo $value['id'];?> "><?php echo $value['name']; ?></option>
                       <?php     } 
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user">User <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select id="teacher" class="form-control col-md-7 col-xs-12" name="staff" required="required">
                            <option value="">Select Staff</option>
                             <?php       
                                       $this->db->where('status',0)->where('branch',$branch) ;
                               $tea=$this->db->get('staff')->result_array();
                              foreach($tea as $value) {
                  ?>
                              <option value="<?php echo $value['id'];?> "><?php echo $value['firstname']." ".$value['lastname']; ?></option>
                       <?php     } 
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 pull-right">
                          <input id="send" type="submit" class="btn btn-success" value="Update Status" />
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              

            </div>

                <?php } ?>
  <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <div class="row">
                          <div class="col-md-4 col-sm-4 col-xs-12 pull-right">
                        <div class="input-group">
                            <input name="search" class="form-control" id="search" type="search" value="<?php echo $q; ?>">

                            <span class="input-group-btn" >
                              <input type="button" class="btn btn-success" value="Search" id="go-search"></span>

                        </div>
                        <div class="form-group pull-right">
                          
                        </div>
                      </div>
                  </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Designation</th>
                          <th>Contact</th>
                          <th>Qualification</th>
                          <th>Date of Birth</th>
                          <th>Date of joining</th>
                          <th>Status</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>


                      <tbody>
                        <?php $i=1; foreach ($staffs as $value) { ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $value['firstname']." ".$value['lastname']; ?></td>
                          <td><?php echo $value['designation']; ?></td>
                          <td><?php echo $value['contact']; ?></td>
                          <td><?php echo $value['qualification']; ?></td>
                          <td><?php echo $value['dob']; ?></td>
                          <td><?php echo $value['doj']; ?></td>
                          <td><?php echo $value['name']; ?></td>
                          <td><a href="<?php echo $base_url;?>staff/rollback/<?php echo $value['id'];?>"><i class="fa fa-undo" aria-hidden="true"></i></a></td>
                          
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                   <div class="row">
                      <div class="col-md-offset-8 col-sm-offset-8 col-md-4 col-sm-4 col-xs-12">
                        <div class="btn-group pull-right">
                            <button <?php if($curr==1){ ?>disabled<?php } ?> class="btn btn-success" data-href="<?php echo $base_url; ?>staff/status/<?php echo $searchq.'/'.($curr - 1); ?>">
                                <i class="fa fa-arrow-left"></i>
                            </button>
                            <button class="btn btn-success" data-href="<?php echo $base_url; ?>staff/status/<?php echo $searchq.'/'.$curr; ?>"><?php echo $curr; ?></button>
                            <button <?php if($curr==$end){ ?>disabled<?php } ?> class="btn btn-success" data-href="<?php echo $base_url; ?>staff/status/<?php echo $searchq.'/'.($curr + 1); ?>">
                                <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                      </div>
                    </div>
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
    
    <!-- jQuery Tags Input -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<script>
      $(function(){
      
        $(document).on("click","#go-search",function(e){
          e.preventDefault();
          var p = 1;
          var s = $("#search").val();
          if(s=="")
            s="all";
          window.location = "<?php echo base_url();?>staff/status/"+s+"/"+p;
        });
        $(document).on("click","button",function(){
          var val = $(this).attr("data-href");
          window.location = val;
        });
      });
    </script>
  </body>
</html>