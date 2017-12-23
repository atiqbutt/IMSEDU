        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Cash Receipt</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a><i id="print" class="fa fa-print text-success"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  
                     
                  <div class="x_content">
                  <div class="row">
                        <div class="col-md-6">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Program<span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                        <select name="programe" id="program" class="form-control" required>
                        <option value="">Select program</option>
                        <?php
                        foreach ($pro as $value) {
                        ?>
                        <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>  
                        <?php
                        }  
                        ?>
                        </select>

                        </div>
                        </div>
                     
                      <div class="col-md-6" id="project_">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Project<span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                            <select name="project" id="project" class="form-control" required>
                              <option value="">Select project</option>
                              
                            </select>

                        </div>
                      </div>
                      
                      <div class="clearfix"></div>
                      <div class="col-md-6" id="main_head"  style="margin-top:15px;">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Main Head<span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                            <select name="main_head" id="main" class="form-control" required>
                              <option value="">Select Main Head</option>
                              <?php
                              foreach ($mainhead as $value) {
                                ?>
                                <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>  
                                <?php
                              }  
                              ?>
                            </select>

                        </div>
                      </div>
                      <br>
                      <div class="col-md-6" id="head_level2">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Head Level 2<span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                            <select name="level2" id="level2" class="form-control" required>
                              <option value="">Select Head Level 2</option>
                              
                            </select>

                        </div>
                      </div>
                       <div class="col-md-6" id="head_level3">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Head Level 3<span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                            <select name="level3" id="level3" class="form-control" required>
                              <option value="">Select Head Level 3</option>
                              
                            </select>

                        </div>
                      </div>
                      
                      <div class="col-md-6" style="margin-top:10px;">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Date<span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                        <input name="date"  id="date" value="<?php echo date('Y-m-d') ?>" class="form-control date" maxlength="20" required>                    
                        </div>
                      </div> 
                      </div>
                      <br>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th style="width:100px;">#</th>
                          
                          <th style="width:100px;">Program Name</th>
                          <th style="width:100px;">Project</th>
                          
                          <th style="width:100px;">Main Head</th>
                          <th style="width:100px;">Head Level 2</th>
                          <th style="width:100px;">Head Level 3</th>
                          <th style="width:100px;">From</th>
                          <th style="width:100px;">Description</th>
                          <th style="width:100px;">Amount</th>
                          <th style="width:100px;">Date</th>
                        </tr>
                      </thead>


                      <tbody class="center">
                        <?php  $offset=$this->uri->segment(3,0)+1; foreach($vou as $key => $value) { ?>
                        <tr>
                        <td style="width:60px;"><?php echo $offset++;   ?></td>
                         <td style="width:140px;"><?php echo $value['programename'];   ?></td>
                          <td style="width:100px;"><?php echo $value['p_name'];   ?></td>
                           <td style="width:100px;"><?php echo $value['headname'];   ?></td>
                            <td style="width:100px;"><?php echo $value['level2name'];   ?></td>
                             <td style="width:100px;"><?php echo $value['level3name'];   ?></td>
                              <td style="width:100px;"><?php echo $value['from_voucher'];   ?></td>
                              <td style="width:100px;"><?php echo $value['description'];   ?></td>
                               <td style="width:100px;"><?php echo $value['amount'];   ?></td>
                                <td style="width:100px;"><?php echo $value['date'];   ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    <?php echo $page_links; ?>
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
      $(document).ready(function(){
            $('#project_').hide();
            $('#main_head').hide();
            $('#head_level2').hide();
            $('#head_level3').hide();

            $(document).on('click', '#print', function() {
              var program=$('#program').val();
              var project=$('#project').val();
              var main_head=$('#main').val();
              var level2=$('#level2').val();
              var level3=$('#level3').val();
              if(program=='') {
                window.open("<?php echo base_url(); ?>"+"Account/cash_vou_print/");
              }
               else if(program!='' && project!='' && main_head!='' && level2!='' && level3!='')
              {
                window.open("<?php echo base_url(); ?>"+"Account/cash_vou_print/"+program+"/"+project+"/"+main_head+"/"+level2+"/"+level3);
              }
              else if(program!='' && project!='' && main_head!='' && level2!='')
              {
                window.open("<?php echo base_url(); ?>"+"Account/cash_vou_print/"+program+"/"+project+"/"+main_head+"/"+level2);
              }
            else if(program!='' && project!='' && main_head!='' )
             {
               window.open("<?php echo base_url(); ?>"+"Account/cash_vou_print/"+program+"/"+project+"/"+main_head);
             }
              else if(program!='' && project!='' ) {
                window.open("<?php echo base_url(); ?>"+"Account/cash_vou_print/"+program+"/"+project);
              }
              else if(program!='') {
                window.open("<?php echo base_url(); ?>"+"Account/cash_vou_print/"+program);
              }
            });

        });
        $('#program').change(function(){
          var id=$(this).val();
           $('#project_').show();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/proagainstproject/"+id,
                    data: {},
                      success: function( d ) {
                         var pre='<option value="">Select Project</option>';
                          $( "#project" ).html(pre+d);
  }
});

        });
        $('#project').change(function(){
            $('#main_head').show();
        });
        $('#main').change(function(){
          var id=$(this).val();
          $('#head_level2').show();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/level2_db/"+id,
                    data: {},
                      success: function( d ) {
                         var pre='<option value="">Select Head Level 2</option>';
                          $( "#level2" ).html(pre+d);
  }
});

        });
        $('#level2').change(function(){
          var id=$(this).val();
           $('#head_level3').show();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/level3_db/"+id,
                    data: {},
                      success: function( d ) {
                         var pre='<option value="">Select Head Level 3</option>';
                          $( "#level3" ).html(pre+d);
  }
});

        });
         //+++++++++++++++++++++data change against dropdown++++++++++++++++++++
         $('#program').change(function(){
          var id=$(this).val();
           
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/programe_against_vou/"+id,
                    data: {},
                      success: function( d ) {
                          $("tbody.center").html(d);
  }
});

        });
    $('#project').change(function(){
          var id=$(this).val();
           
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/project_against_vou/"+id,
                    data: {},
                      success: function( d ) {
                        
                          $("tbody.center").html(d);
  }
});

        });
         $('#main').change(function(){
          var id=$(this).val();
          var p=$('#program').val();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/main_head_against_vou/"+id+"/"+p,
                    data: {},
                      success: function( d ) {
                       
                        $("tbody.center").html(d); 
  }
});
});
$('#level2').change(function(){
          var id=$(this).val();
          var p=$('#project').val();
          var m=$('#main').val();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/level2_against_vou/"+m+"/"+id+"/"+p,
                    data: {},
                      success: function( d ) {
                        
                        $("tbody.center").html(d); 
  }
});
});
$('#level3').change(function(){
          var id=$(this).val();
          var p=$('#project').val();
          var m=$('#main').val();
          var l2=$('#level2').val();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/level3_against_vou/"+m+"/"+id+"/"+p+"/"+l2,
                    data: {},
                      success: function( d ) {
                       
                        $("tbody.center").html(d); 
  }
});
});

        </script> 