

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Program</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Program Add</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo base_url(); ?>account/save_program" method="post">
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="name" id="name" class="form-control abc" maxlength="20"  title="Only alphabatic character" required>                    
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
                    <h2>Program view</h2>
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
                          <th style="width:100px;">Name</th>
                          <th>Actions</th>
                        </tr>
                      </thead>


                      <tbody class="center">

                        <?php $i=1; foreach ($program as $key => $value) { ?>
                        <tr>
                          <td style="width:25%"><?php echo $i++; ?></td>
                          <td style="width:25%"><?php echo $value['name']; ?></td>
                          
                          <td style="width:25%">
                            <!-- <a href="<?php echo $base_url; ?>account/edit_program/<?php echo $value['id']; ?>"><i class="fa fa-edit"></i></a>  -->
                            <a href="<?php echo $base_url; ?>account/delete_program/<?php echo $value['id']; ?>"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php } ?>
                      

                      </tbody>

                    </table>
                   <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <?php for ($i=$total; $i >= 1; $i--) { ?>
                        <a href="<?php echo $base_url; ?>account/index/<?php echo $i; ?>">
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
      