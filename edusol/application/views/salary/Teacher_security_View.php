 
 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Salary</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Teacher security View</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                    <div class="row"> <div style="float:right" class="col-lg-3 col-lg-offset-3 col-md-3 col-md-offset-3">
                  <div class="input-group">
                  <input id="search" type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                  <button class="btn btn-default" disabled type="button">Search</button>
                  </span>
                  </div><!-- /input-group -->
                  </div><!-- /.col-lg-6 -->
                  </div>
                  <div class="x_content">
                
                  <div class="table-responsive">
                        <table id="tble" class="table table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>security amount</th>
                                    <th>Deduct Amount</th>
                                    <th>Remiaining Amount</th>
                                    <th>Month</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                            <?php $offset=$this->uri->segment(3,0)+1; foreach ($employee as $key => $value) { ?>
                                <tr>
                                <td><?php echo $offset++ ; ?></td>
                                <td><?php echo $value['firstname']." ".$value['lastname'];  ?></td>
                                <td><?php echo $value['refrence'];  ?></td>
                                <td><?php echo $value['security_amount'];  ?></td>
                                <td><?php echo $value['detuct_amount'];  ?></td>
                                <td><?php echo $value['remendar_amount'];  ?></td>
                                <td><?php echo $value['month'];  ?></td>
                               <td><a href="<?php echo base_url(); ?>salary/Action_security/del/<?php echo $value['id'] ?>"><i class='fa fa-trash'></i></a>  <a href="<?php echo base_url(); ?>salary/Action_security/edit/<?php echo $value['id'] ?>"><i class='fa fa-pencil'></i></a></td>
                                </tr>
                           <?php } ?>
                            </tbody>
                        </table>
                        <?php echo $page_links; ?>
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
        $(document).on("keyup",'#search',function(){
          var id=$(this).val();
            
           
          $.ajax({
            url:"<?php echo base_url(); ?>load/TeacherSecurtySerch/"+id,
            data:{},
            success:function(d){
                   
            
                    var res=jQuery.parseJSON(d);
                    $('tbody#table_body').empty();
                    var ret="";                
                    $.each(res,function(i,v){
                
                        ret+="<tr><td>"+(++i)+"</td><td>"+v.firstname+" "+v.lastname+"</td><td>"+v.refrence+"</td><td>"+v.security_amount+"</td><td>"+v.detuct_amount+"</td><td>"+v.remendar_amount+"</td><td>"+v.month+"</td><td><a href='<?php echo base_url(); ?>salary/Action_security/del/"+v.id+"'><i class='fa fa-trash'></i></a> <a href='<?php echo base_url(); ?>salary/Action_security/edit/"+v.id+"'><i class='fa fa-pencil'></i></a></td></tr>";

                                            } );

                        $('tbody#table_body').html(ret);
                }
                
           
              
              
            
          });
        });
        </script>