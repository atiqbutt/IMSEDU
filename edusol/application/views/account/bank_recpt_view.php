       <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
            
          
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Bank Receipt</h3>
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
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Bank<span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                        <select name="bank" id="bank" class="form-control" required>
                        <option value="">Select Bank</option>
                        <?php
                        foreach ($bank as $value) {
                        ?>
                       <option value="<?php echo $value['id'];?>"><?php echo $value['b_name']." ".$value['b_code'];?></option>
                        <?php
                        }  
                        ?>
                        </select>

                        </div>
                        </div>
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
                     <br>
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
                      
                       
                      </div>
                      <br>
                    <table id="myDataTable" class="table table-striped table-bordered nowrap" style="width:100%;" >
                      <thead>
                        <tr>
                          <th >#</th>
                          
                          <th >Program Name</th>
                          <th >Project</th>
                          <th >Main Head</th>
                          <th >Head Level 2</th>
                          <th >Head Level 3</th>
                          <th >Bank</th>
                          <th >From</th>
                          <th >Amount</th>
                          <th >Date</th>
                        </tr>
                      </thead>


                      <tbody class="center">
                        <?php $offset=$this->uri->segment(3,0)+1; foreach ($pay as $key => $value) { ?>
                        <tr>
                        <td style="width:60px;"><?php echo $offset++ ;   ?></td>
                         <td style="width:140px;"><?php echo $value['programename'];   ?></td>
                          <td style="width:100px;"><?php echo $value['p_name'];   ?></td>
                           <td style="width:100px;"><?php echo $value['headname'];   ?></td>
                            <td style="width:100px;"><?php echo $value['level2name'];   ?></td>
                             <td style="width:100px;"><?php echo $value['level3name'];   ?></td>
                             <td style="width:100px;"><?php echo $value['b_name'];   ?></td>
                              <td style="width:100px;"><?php echo $value['from_recpt'];   ?></td>
                               <td style="width:100px;"><?php echo $value['amount'];   ?></td>
                                <td style="width:100px;"><?php echo $value['date'];   ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <br>
                     <?php echo $page_links; ?>
                  </div>
                </div>
              </div>
             
              </div>
            
            </div>
          </div>
        </div>
        <!-- /page content -->
        <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/pdfmake/build/vfs_fonts.js"></script>
        <script>
        $(document).ready(function() {

          $(document).on('click', '#print', function() {
              var bank=$('#bank').val();
              var program=$('#program').val();
              var project=$('#project').val();
              var main_head=$('#main').val();
              var level2=$('#level2').val();
              var level3=$('#level3').val();
              if(bank=='') {
                window.open("<?php echo base_url(); ?>Account/bank_recipt_print/");
              }
               else if(bank!='' && program!='' && project!='' && main_head!='' && level2!='' && level3!='')
              {
                window.open("<?php echo base_url(); ?>Account/bank_recipt_print/"+bank+"/"+program+"/"+project+"/"+main_head+"/"+level2+"/"+level3);
              }
              else if(bank!='' && program!='' && project!='' && main_head!='' && level2!='')
              {
                window.open("<?php echo base_url(); ?>Account/bank_recipt_print/"+bank+"/"+program+"/"+project+"/"+main_head+"/"+level2);
              }
              else if(bank!='' && program!='' && project!='' && main_head!='' )
              {
               window.open("<?php echo base_url(); ?>Account/bank_recipt_print/"+bank+"/"+program+"/"+project+"/"+main_head);
              }
              else if(bank!='' && program!='' && project!='' ) {
                window.open("<?php echo base_url(); ?>Account/bank_recipt_print/"+bank+"/"+program+"/"+project);
              }
              else if(bank!='' && program!='' ) {
                window.open("<?php echo base_url(); ?>Account/bank_recipt_print/"+bank+"/"+program);
              }
              else if(bank!='') {
                window.open("<?php echo base_url(); ?>Account/bank_recipt_print/"+bank);
              }
            });
        
        $('#myDataTable').DataTable(
            {
            "bPaginate":false,
            "bFilter":true,
            "bInfo":false,
            "ordering":false,
            "scrollX":true,
            dom: 'Bfrtip',
            buttons: [
            'csv', 'excel', 'pdf',{extend:'print',text:'Print',exportOptions:{columns:[0,1,2,3,4,5,6,7,8,9]}}            ]
            }
        );

       
        });
        
        </script>
       <script>
      $(document).ready(function(){
            $('#project_').hide();
            $('#main_head').hide();
            $('#head_level2').hide();
            $('#head_level3').hide();

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
                    url: "<?php echo base_url(); ?>Load_account/programe_against_bank_recpt/"+id,
                    data: {},
                      success: function( ret ) {
                          var d=jQuery.parseJSON(ret);
                          
            var rt = "";
             $("tbody.center").empty();
            $.each(d, function(i,v){
                       
                       rt += "<tr><td>"+(++i)+"</td><td>"+v.programename+"</td><td>"+v.p_name+"</td><td>"+v.headname+"</td><td>"+v.level2name+"</td><td>"+v.level3name+"</td><td>"+v.b_name+"</td><td>"+v.to_payment+"</td><td>"+v.amount+"</td><td>"+v.date+"</td></tr>";
                     });
                      $("tbody.center").html(rt);

          }

   
});

        });
         $('#bank').change(function(){
          var id=$(this).val();
           
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/bank_against_recpt/"+id,
                    data: {},
                      success: function( ret ) {
                          var d=jQuery.parseJSON(ret);
                          
            var rt = "";
             $("tbody.center").empty();
            $.each(d, function(i,v){
                       
                       rt += "<tr><td>"+(++i)+"</td><td>"+v.programename+"</td><td>"+v.p_name+"</td><td>"+v.headname+"</td><td>"+v.level2name+"</td><td>"+v.level3name+"</td><td>"+v.b_name+"</td><td>"+v.to_payment+"</td><td>"+v.amount+"</td><td>"+v.date+"</td></tr>";
                     });
                      $("tbody.center").html(rt);

          }

   
});

        });
    $('#project').change(function(){
          var id=$(this).val();
           
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/project_against_bank_recpt/"+id,
                    data: {},
                      success: function( ret ) {
                          var d=jQuery.parseJSON(ret);
                          
            var rt = "";
             $("tbody.center").empty();
            $.each(d, function(i,v){
                       
                       rt += "<tr><td>"+(++i)+"</td><td>"+v.programename+"</td><td>"+v.p_name+"</td><td>"+v.headname+"</td><td>"+v.level2name+"</td><td>"+v.level3name+"</td><td>"+v.b_name+"</td><td>"+v.to_payment+"</td><td>"+v.amount+"</td><td>"+v.date+"</td></tr>";
                     });
                      $("tbody.center").html(rt);

          }
});

        });
         $('#main').change(function(){
          var id=$(this).val();
          var p=$('#project').val();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/main_head_against_bank_recpt/"+id+"/"+p,
                    data: {},
                       success: function( ret ) {
                          var d=jQuery.parseJSON(ret);
                          
            var rt = "";
             $("tbody.center").empty();
            $.each(d, function(i,v){
                       
                       rt += "<tr><td>"+(++i)+"</td><td>"+v.programename+"</td><td>"+v.p_name+"</td><td>"+v.headname+"</td><td>"+v.level2name+"</td><td>"+v.level3name+"</td><td>"+v.b_name+"</td><td>"+v.to_payment+"</td><td>"+v.amount+"</td><td>"+v.date+"</td></tr>";
                     });
                      $("tbody.center").html(rt);

          }
});
});
$('#level2').change(function(){
          var id=$(this).val();
          var p=$('#project').val();
          var m=$('#main').val();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/level2_against_bank_recpt/"+m+"/"+id+"/"+p,
                    data: {},
                      success: function( ret ) {
                          var d=jQuery.parseJSON(ret);
                          
            var rt = "";
             $("tbody.center").empty();
            $.each(d, function(i,v){
                       
                       rt += "<tr><td>"+(++i)+"</td><td>"+v.programename+"</td><td>"+v.p_name+"</td><td>"+v.headname+"</td><td>"+v.level2name+"</td><td>"+v.level3name+"</td><td>"+v.b_name+"</td><td>"+v.to_payment+"</td><td>"+v.amount+"</td><td>"+v.date+"</td></tr>";
                     });
                      $("tbody.center").html(rt);

          }
});
});
$('#level3').change(function(){
          var id=$(this).val();
          var p=$('#project').val();
          var m=$('#main').val();
          var l2=$('#level2').val();
          $.ajax({
                    url: "<?php echo base_url(); ?>Load_account/level3_against_bank_recpt/"+m+"/"+id+"/"+p+"/"+l2,
                    data: {},
                      success: function( ret ) {
                          var d=jQuery.parseJSON(ret);
                          
            var rt = "";
             $("tbody.center").empty();
            $.each(d, function(i,v){
                       
                       rt += "<tr><td>"+(++i)+"</td><td>"+v.programename+"</td><td>"+v.p_name+"</td><td>"+v.headname+"</td><td>"+v.level2name+"</td><td>"+v.level3name+"</td><td>"+v.b_name+"</td><td>"+v.to_payment+"</td><td>"+v.amount+"</td><td>"+v.date+"</td></tr>";
                     });
                      $("tbody.center").html(rt);

          }
});
});

        </script> 