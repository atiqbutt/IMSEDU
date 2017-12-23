   <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Allowance</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Allowance Edit</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  
                     <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>salary/update_allonce" method="post">
                        
                      <input type="hidden" name="allonceid" value="<?php echo $edit_allonce['id']; ?>"/>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="month">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id='alloncename' value="<?php echo $edit_allonce['name']; ?>" name="alloncename" placeholder="Allonce Name...." class="form-control abc">
                           </div>
                      </div>  
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="month">Amount <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id='allonceammount' name="allonceammount" value="<?php echo $edit_allonce['amount']; ?>" placeholder="Allonce Amount...." class="form-control num">
                           </div>
                      </div> 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="" class="form-control col-md-7 col-xs-12 abc1" maxlength="25" name="des" placeholder="Description Here...." required="required"><?php echo $edit_allonce['description']; ?></textarea>
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
                
            </div>
          </div>
        </div>
        <!-- /page content -->
        <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
        