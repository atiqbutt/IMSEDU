 
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
                    <h2>Teacher Salary View</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                          <div class="col-md-4 col-sm-4 col-xs-12 pull-right">
                        <div class="input-group">
                            <input name="search" class="form-control" id="search" type="search">

                            <span class="input-group-btn" >
                              <input type="button" disabled class="btn btn-success" value="Search" id="go-search">

</span>

                        </div>
                        <div class="form-group pull-right">
                          
                        </div>
                      </div>


                      </div>
                  <div class="table-responsive">
                        <table class="table table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Total Salary</th>
                                    <th>Total Paid</th>
                                    <th>Month</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="center" id="table_body">
                            <?php $offset=$this->uri->segment(3,0)+1; foreach ($employee as $key => $value) { ?>
                                <tr>
                                <td><?php echo $offset++ ; ?></td>
                                <td><?php echo $value['firstname']." ".$value['lastname'];  ?></td>
                                <td><?php echo $value['refrence'];  ?></td>
                                <td><?php echo $value['salery'];  ?></td>
                                <td><?php echo $value['total_amount'];  ?></td>
                                <td><?php echo $value['month'];  ?></td>
                               <td><a href="<?php echo base_url(); ?>salary/Action_salary/<?php echo $value['id'] ?>"><i class='fa fa-eye'></i></a> </td>
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
        $('#search').keyup(function(){
          var val=$(this).val();
          $.get("<?php echo base_url(); ?>salary/teacher_sal_search/"+val,{},function(ret){
            
            var d=jQuery.parseJSON(ret);
            var rt = "";
             $("tbody.center").empty();
            $.each(d, function(i,v){
                       
                       rt += "<tr><td>"+(++i)+"</td><td>"+v.firstname+" "+v.lastname+"</td><td>"+v.refrence+"</td><td>"+v.salery+"</td><td>"+v.total_amount+"</td><td>"+v.month+"</td><td><a href='<?php echo base_url(); ?>salary/actions/"+v.id+"'><i class='fa fa-eye'></i></a>  </td></tr>";
                     });
                      $("tbody.center").html(rt);

          }

        );
        });
        </script>