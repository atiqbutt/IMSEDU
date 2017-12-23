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
                    <h2>Multi Exam Report List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-striped table-bordered dt-responsive nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>GR#</th>
                          <th>Student Name</th>
                          <th>Father Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $i=1; $results=[]; foreach ($student as $key => $value) {?>
                          <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $value->grno;?></td>
                            <td><?php echo $value->student_name;?></td> 
                            <td><?php echo $value->father_name;?></td>
                            <td>
                                <a target="_blank" href="<?php echo base_url();?>Report/MultiExamReportPrint/<?php echo $exams.'/'.$printAllEncoded.'/'.$value->id; ?>">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                            </td>
                          </tr>
                          <?php } ?>
                      </tbody>
                    </table>
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                        <a target="_blank" href="<?php echo base_url();?>Report/MultiExamReportPrintAll/<?php echo $exams.'/'.$printAllEncoded; ?>">
                          <button class="btn btn-success">Print All</button>
                        </a>
                      </div>
                    </div>
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