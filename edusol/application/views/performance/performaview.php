
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Performance View</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Performance List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="col-md-4 col-md-offset-2" >
                  <select name="type" id="type" class="form-control col-lg-3 col-lg-offset-5">
                    <option>Select Type</option>
                    <option value="teacher">Teacher</option>
                    <option value="staff">Staff</option>
                    </select>
                  </div>
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th style="width:100px;">#</th>
                          
                          <th style="width:100px;">Name</th>
                          <th style="width:100px;">Designation</th>
                          
                          <th style="width:100px;">Average Attribute</th>
                          <th style="width:100px;">Average Performance</th>
                          <th style="width:100px;">Average Grading</th>
                          <th style="width:100px;">Overall Grading</th>
                          <th style="width:100px;">Actions</th>
                        </tr>
                      </thead>


                      <tbody class="center">
                        
                        <tr>
                       
                        </tr>
                        
                      </tbody>
                    </table>
                     <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php for ($i=$total; $i >= 1; $i--) { ?>
                        <a href="<?php echo $base_url; ?>performance/Show_apraise/<?php echo $i; ?>">
                          <button class="btn btn-success pull-right"><?php echo $i; ?></button>
                        </a>
                        <?php } ?>
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
        <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
        $('.table').hide();
        });
        $('#type').change(function(){

            var val=$(this).val();
            
            $('.table').show();
             $.get("<?php echo base_url(); ?>load/viewperformance/"+val,{},function(d){
                    
                    $("tbody.center").html(d);
                });
            

        });
        </script>