

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Subject</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Subject</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>subject/savesub" method="post">
                        <?php 
                       if(!$this->user_model->is_super()){
                            ?>
                        <input type="hidden" name="branchid" value="<?php echo $branch; ?>" id="branch_id"  /><?php 
                        }else{?>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Branch <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="branch" id="branch">
                                      <option value="">Select Branch</option>
                                       <?php      
                               
                             foreach ($branch as $key => $value) {
                                
                  ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $this->user_model->limitText($value['name'], 8);?></option>

                  <?php } ?>
                                 </select> 
                           </div>
                      </div>
                       <?php } ?>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Class <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="class" id="class">
                                      <option value="">Select Class</option>
                            
                                 </select>                    
                        </div>
                      </div>    
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Section <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="section" id="section" required>
                                      <option value="">Select Section</option>
                            
                                 </select>                    
                        </div>
                      </div> 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="b_head">Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="b_head" class="form-control col-md-7 col-xs-12 abc1" maxlength="25" name="subname" placeholder="Subject Name...." required="required" type="text">
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <input id="send" type="submit" class="btn btn-success" value="Add" />
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
             
              </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Allocation Subject View</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     <div class="row">
                          <div class="col-md-7 col-sm-7 col-xs-12 pull-right">
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
                          <th style="width:100px;">Name</th>
                          <th style="width:100px;">Class</th>
                          <th style="width:100px;">Section</th>
                          <th>Actions</th>
                        </tr>
                      </thead>


                      <tbody class="center">
                        <?php $i=1; foreach ($subject as $key => $value) { ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $this->user_model->limitText($value['name'], 20); ?></td>
                          <td><?php echo $this->user_model->limitText($value['class_name'], 20); ?></td>
                          <td><?php echo $this->user_model->limitText($value['section_name'], 20); ?></td>
                          
                          <td>
                            <a href="<?php echo $base_url; ?>subject/actions/edit/<?php echo $value['id']; ?>"><i class="fa fa-edit"></i></a> 
                            <a href="<?php echo $base_url; ?>subject/actions/delete/<?php echo $value['id']; ?>"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>

                    <div class="row">
                      <div class="col-md-offset-8 col-sm-offset-8 col-md-4 col-sm-4 col-xs-12">
                        <div class="btn-group pull-right">
                            <button <?php if($curr==1){ ?>disabled<?php } ?> class="btn btn-success" data-href="<?php echo $base_url; ?>subject/index/<?php echo $searchq.'/'.($curr - 1); ?>">
                                <i class="fa fa-arrow-left"></i>
                            </button>
                            <button class="btn btn-success" data-href="<?php echo $base_url; ?>subject/index/<?php echo $searchq.'/'.$curr; ?>"><?php echo $curr; ?></button>
                            <button <?php if($curr==$end){ ?>disabled<?php } ?> class="btn btn-success" data-href="<?php echo $base_url; ?>subject/index/<?php echo $searchq.'/'.($curr + 1); ?>">
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
        </div>
        <!-- /page content -->
        <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
        <script>
         $(document).ready(function(){
        var value=$('#branch_id').val();
           $('#send').hide();
           $.get("<?php echo base_url(); ?>load/classs/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $("#class").html(pre+d);
                });
            });
    
             $('#branch').change(function(){
                 
                var value=$(this).val();
                $('#class').empty();
                
                $.get("<?php echo base_url(); ?>load/classs/role/"+value,{},function(d){
                    var pre = '<option value="">Select Class</opiton>';
                    $("#class").html(pre+d);
                });
            });
         $('#class').change(function(){
                 
                var value=$(this).val();
                $('#send').show();
                
                $.get("<?php echo base_url(); ?>load/section/role/"+value,{},function(d){
                    var pre = '<option value="">Select Section</opiton>';
                    $("#section").html(pre+d);
                });

            });
       $('#class').change(function(){
                 var id=$('#class').val();
                
                
                
           $.get("<?php echo base_url(); ?>load/subagainstclass/"+id,{},function(d){
                   
                     $("tbody.center").html(d);
                });
       });
        </script>   
        <script>
      $(function(){
      
        $(document).on("click","#go-search",function(e){
          e.preventDefault();
          var p = 1;
          var s = $("#search").val();
          if(s=="")
            s="all";
          window.location = "<?php echo base_url();?>subject/index/"+s+"/"+p;
        });
        $(document).on("click","button",function(){
          var val = $(this).attr("data-href");
          window.location = val;
        });
      });
    </script>