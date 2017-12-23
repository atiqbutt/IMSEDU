

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Bank</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Definition</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo base_url(); ?>account/savekhata" method="post">
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bank Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="bnk_name" id="bnk_name" class="form-control abc" required>                    
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bank Code <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="b_code" id="b_code" class="form-control abc1" required>                    
                        </div>
                      </div>    
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Account # <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="a_num" id="a_num" class="form-control abc1" required>                    
                        </div>
                      </div>  
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="title" id="title" class="form-control abc" required>                    
                        </div>
                      </div>  
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Purpose <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea name="purpose" id="b_code" class="form-control " required></textarea>                    
                        </div>
                      </div>  
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Balance <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="o_balnce" id="o_balnce" class="form-control num" required>                    
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
                
             
              </div>
            
            </div>
          </div>
                  <!-- /page content -->
        <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
      <script>
        $('#main_head').change(function(){
          var id=$('#main_head').val();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/main_head_view/"+id,
                    data: {},
                      success: function( result ) {
                          $( "tbody.center" ).html(result);
  }
});

        });
         
        </script>   