

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Key Responbility</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Key Responbility</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>performance/savekey" method="post">
                        
                        
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="b_head" class="form-control col-md-7 col-xs-12 abc1" maxlength="25" name="key" placeholder="Key Responsibility Name...." required="required" type="text">
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">Add</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
             
              </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Responbility</h2>
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
                          <th style="width:100px;">#</th>
                          
                          <th style="width:100px;">Attribute</th>
                          
                          <th style="width:100px;">Actions</th>
                        </tr>
                      </thead>


                      <tbody class="center">
                        <?php $i=1; foreach ($response as $key => $value) { ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          
                          <td><?php echo $this->user_model->limitText($value['key'], 20); ?></td>
                          
                          
                          <td>
                            <a href="<?php echo $base_url; ?>performance/actionskey/edit/<?php echo $value['id']; ?>"><i class="fa fa-edit"></i></a> 
                            <a href="<?php echo $base_url; ?>performance/actionskey/del/<?php echo $value['id']; ?>"><i class="fa fa-trash"></i></a>
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
