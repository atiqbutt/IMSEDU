        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>CITY</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add City</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url;?>city/save" method="post">

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Country<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="country" class="form-control col-md-7 col-xs-12" name="country" required="required">
                            

                            <option value=''>Select Country</option>
                    <?php       $this->db->where('is_delete',0) ;
                                $com=$this->db->get('country')->result();
                              foreach ($com as $value) {
                  ?>
                    <option value="<?php echo $value->country_id; ?>"><?php echo $value->country_name?></option>

                  <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Province<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="province" class="form-control col-md-7 col-xs-12" name="province" required="required">
                            

                            <option value=''>Select Province</option>
                    
                          </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">District<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="district" class="form-control col-md-7 col-xs-12" name="district" required="required">
                            

                            <option value=''>Select District</option>
                    
                          </select>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <input name="city" id="city" required="true" class="form-control">
                        </div>
                      </div>
                      
                      
                      
                      

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <input id="send" type="submit" class="btn btn-success pull-right" value"Add" >
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>City View</h2>
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
                              <input type="button" class="btn btn-success" value="Search" id="go-search">

</span>

                        </div>
                        <div class="form-group pull-right">
                          
                        </div>
                      </div>


                      </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>City Name</th>
                          <th>District Name</th>
                          <th>Province Name</th>
                          <th>Country Name</th>
                          <?php if(!$is_super){ ?>
                          <th>Actions</th>
                          <?php } ?>
                        </tr>
                      </thead>


                      <tbody>
                        <?php $i=1; foreach ($province as  $value) { ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $value['city_name']; ?></td>
                          <td><?php echo $value['name']; ?></td>
                          <td><?php echo $value['province_name']; ?></td>
                          <td><?php echo $value['country_name']; ?></td>
                          
                          <?php if(!$is_super){ ?>
                          <td>

                            <!-- <a href='<?php echo base_url();?>city/edit/<?php echo $value['city_id']; ?>'><i class="fa fa-edit"></i></a>  -->
                            
                           <a href="<?php echo base_url();?>city/delete/<?php echo $value['city_id']; ?>" <i class="fa fa-trash"></i></a>
                          </td>
                          <?php } ?>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    
                      <div class="row">
                      <div class="col-md-offset-8 col-sm-offset-8 col-md-4 col-sm-4 col-xs-12">
                        <div class="btn-group pull-right">
                            <button <?php if($curr==1){ ?>disabled<?php } ?> class="btn btn-success" data-href="<?php echo $base_url; ?>city/index/<?php echo $searchq.'/'.($curr - 1); ?>">
                                <i class="fa fa-arrow-left"></i>
                            </button>
                            <button class="btn btn-success" data-href="<?php echo $base_url; ?>city/index/<?php echo $searchq.'/'.$curr; ?>"><?php echo $curr; ?></button>
                            <button <?php if($curr==$end){ ?>disabled<?php } ?> class="btn btn-success" data-href="<?php echo $base_url; ?>city/index/<?php echo $searchq.'/'.($curr + 1); ?>">
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
<script>
        $(document).ready(function(){
            $(document).on("change","#country",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/province/role/"+value,{},function(d){
                    var pre = '<option value="">Select Province</opiton>';
                    $("#province").html(pre+d);
                });
            });
            
        });
    </script>

<script>
        $(document).ready(function(){
            $(document).on("change","#province",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/district/role/"+value,{},function(d){
                    var pre = '<option value="">Select district</opiton>';
                    $("#district").html(pre+d);
                });
            });
            
        });
    </script>
<script>
      $(function(){
        $(document).on("click","#go-search",function(){
          var p = 1;
          var s = $("#search").val();
          if(s=="")
            s="all";
          window.location = "<?php echo base_url();?>city/index/"+s+"/"+p;
        });
        $(document).on("click","button",function(){
          var val = $(this).attr("data-href");
          window.location = val;
        });
      });
    </script>

  </body>
</html>