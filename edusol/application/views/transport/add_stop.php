

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
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Stop</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo base_url(); ?>transport/save_stop" method="post">
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Branch <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="branch" id="branch">
                                      <option value="">Select Branch</option>
                                       <?php      
                               
                             foreach ($branch as $key => $value) {
                                
                  ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $value['name'];?></option>

                  <?php } ?>
                                 </select> 
                           </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="city" id="city" required>
                                      <option value="">Select City</option>
                                       <?php      
                               
                             foreach ($city as $key => $value) {
                                
                  ?>
                    <option value="<?php echo $value['city_id']; ?>"><?php echo $value['city_name'];?></option>
                            <?php }?>
                                 </select>                    
                        </div>
                      </div>    
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Stop <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="stop" name="stop" class="form-control" required="true">                    
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Fee <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="fee" name="fee" class="form-control" required="true">                    
                        </div>
                      </div> 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Description<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description" name="description" class="form-control"></textarea>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success pull-right">Add</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
             
              </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Stop view</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th style="width:100px;">Stop Name</th>
                          <th style="width:100px;">City Name</th>
                          <th style="width:100px;">Fair</th>
                          <th>Actions</th>
                        </tr>
                      </thead>


                      <tbody class="center">

                        <?php $i=1; foreach ($stop as $key => $value) { ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $value['name']; ?></td>
                          <td><?php echo $value['city_name']; ?></td>
                          <td><?php echo $value['fee']; ?></td>
                          
                          <td>
                            <!-- <a href="<?php echo $base_url; ?>subject/actions/edit/<?php echo $value['id']; ?>"><i class="fa fa-edit"></i></a>  -->
                            <a href="<?php echo $base_url; ?>transport/delete/<?php echo $value['id']; ?>"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php } ?>
                      

                      </tbody>

                    </table>
                    
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
        $('#city').change(function(){
          var id=$('#city').val();

          $.ajax({
                    url: "<?php echo base_url(); ?>load/getstop/"+id,
                    data: {},
                      success: function( result ) {
                          $( "tbody.center" ).html(result);
  }
});

        });
         
        </script>   