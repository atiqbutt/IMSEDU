

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Head Level 3</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Head level 3</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo base_url(); ?>account/save_level3" method="post">
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Main Head<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="main_head" id="main_head" class="form-control" required>
                              <option value="">Select Main Head</option>
                              <?php
                              foreach ($main_head as $value) {
                                ?>
                                <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>  
                                <?php
                              }  
                              ?>
                            </select>

                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Level 2<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="level2" id="level2" class="form-control" required>
                              <option value="">Select Level 2</option>
                             
                            </select>

                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="name" id="name" class="form-control abc" maxlength="20" required>                    
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
                    <h2> Level 2 view</h2>
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
                          <th style="width:100px;">Level 3</th>
                          <th style="width:100px;">Level 2</th>
                          <th style="width:100px;">Main Head</th>
                          <th>Actions</th>
                        </tr>
                      </thead>


                      <tbody class="center">

                        <?php $i=1; foreach ($project as $key => $value) { ?>
                        <tr>
                          <td style="width:25%"><?php echo $i++; ?></td>
                          <td style="width:25%"><?php echo $value['level_3_name']; ?></td>
                          <td style="width:25%"><?php echo $value['level_2_name']; ?></td>
                          <td style="width:25%"><?php echo $value['main']; ?></td>
                          
                          <td style="width:25%">
                            <!-- <a href="<?php echo $base_url; ?>account/edit_program/<?php echo $value['id']; ?>"><i class="fa fa-edit"></i></a>  -->
                            <a href="<?php echo $base_url; ?>account/delete_level2/<?php echo $value['id']; ?>"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php } ?>
                      

                      </tbody>

                    </table>
                   <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php for ($i=$total; $i >= 1; $i--) { ?>
                        <a href="<?php echo $base_url; ?>account/level2/<?php echo $i; ?>">
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
                  <!-- /page content -->
        <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
      <script>
        $(document).ready(function(){
            $(document).on("change","#main_head",function(){
                var value = $(this).val();

                $.get("<?php echo base_url(); ?>Load_account/level2_db/"+value,{},function(d){

                    var pre = '<option value="">Select Level 2</opiton>';
                    $("#level2").html(pre+d);
                });
            });
            
        });
    </script>
 <script>
        $('#level2').change(function(){
          var id=$('#level2').val();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/level2_view/"+id,
                    data: {},
                      success: function( result ) {
                          $( "tbody.center" ).html(result);
  }
});

        });
         
        </script>   