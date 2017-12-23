        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Report</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Section Wise Result Report</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" action="<?php echo $base_url;?>Report/SectionWiseResultReport" method="post">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch">Branch<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="branch" class="form-control col-md-7 col-xs-12 branch" name="branch" required="required">
                            <option value=''>Select Branch</option>
                            <?php foreach($branch as $k=>$v){ ?>
                            <option value='<?php echo $v['id']; ?>'><?php echo $v['name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class">Class<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="class" class="form-control col-md-7 col-xs-12 class" name="class" required="required">
                            <option value=''>Select Class</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section">Section<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="section" class="form-control col-md-7 col-xs-12 section" name="section" required="required">
                            <option value=''>Select Section</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="session">Session<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="session" class="form-control col-md-7 col-xs-12 session" name="session" required="required">
                            <option value=''>Select Session</option>
                            <?php foreach($session as $k=>$v){ ?>
                            <option value='<?php echo $v['id']; ?>'><?php echo $v['name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                       
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section">Exam<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="exam" class="form-control col-md-7 col-xs-12 exam" name="exam" required="required">
                           <option value=''>Select Exam</option>
                          </select>
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
            $(document).on("change",".branch",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/classs/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $(".class").html(pre+d);
                });
            });
            
        });
          $(document).ready(function(){
            $(document).on("change",".class",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/section/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $(".section").html(pre+d);
                });
            });
            
        });
          $(document).ready(function(){
            $(document).on("change",".class",function(){
                var value = $(this).val();
                $.get("<?php echo base_url(); ?>load/exam/"+value,{},function(d){
                    var pre = '<option value="">Select Exam</opiton>';
                    $(".exam").html(pre+d);
                });
            });
            
        });
    </script>