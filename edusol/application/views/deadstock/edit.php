        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Dead Stock</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Dead Stock</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url;?>Deadstock/update" method="post">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch">Branch<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="branch" class="form-control col-md-7 col-xs-12 branch" name="branch" required="required">
                            <option value=''>Select Branch</option>
                            <?php foreach($branch as $k=>$v){ ?>
                            <option value='<?php echo $v['id']; ?>' <?php if($deadstock['branch']==$v['id']) echo 'selected'; ?> ><?php echo $v['name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Dead Stock Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" type="text" class="form-control col-md-7 col-xs-12" name="name" value="<?php echo $deadstock['name']; ?>" required="required" />
                          <input id="name" type="hidden" name="id" value="<?php echo $deadstock['id']; ?>" required="required" />
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Quantity<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="quantity" type="number" class="form-control col-md-7 col-xs-12" name="quantity" value="<?php echo $deadstock['quantity']; ?>" required="required" />
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Amount<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="amount" type="number" class="form-control col-md-7 col-xs-12" name="amount" value="<?php echo $deadstock['amount']; ?>" required="required" />
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="description" type="text" class="form-control col-md-7 col-xs-12" name="description" value="<?php echo $deadstock['description']; ?>" />
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success pull-right">Submit</button>
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
<script>
    $(document).ready(function(){
        
        
    });
</script>