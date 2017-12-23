<style>
p{
    padding-top:8px;
}
</style>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Fee</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Voucher</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <h1>Fee Voucher</h1>
                            <h3>Challan # <?php echo $invoice['id']; ?></h3>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 form-horizontal">
                            <h2 class="control-label"><?php echo $branch['name']; ?></h2>
                            <h3 class="control-label"><?php echo $branch['contact']; ?></h3>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <img src="<?php echo base_url().$branch['b_logo']; ?>" width="100" height="100" alt="">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="row form-horizontal">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <div class="">
                                <p class="col-md-2 col-sm-2 col-xs-12"><strong>GR. No.</strong></p>
                                <p class="col-md-10 col-sm-10 col-xs-12"><?php echo $student['grno']; ?></p>
                            </div>
                            <div class="">
                                <p class="col-md-2 col-sm-2 col-xs-12"><strong>Student</strong></p>
                                <p class="col-md-10 col-sm-10 col-xs-12"><?php echo $student['student_name']; ?></p>
                            </div>
                            <div class="">
                                <p class="col-md-2 col-sm-2 col-xs-12"><strong>Father</strong></p>
                                <p class="col-md-10 col-sm-10 col-xs-12"><?php echo $student['father_name']; ?></p>
                            </div>
                            <div class="">
                                <p class="col-md-2 col-sm-2 col-xs-12"><strong>Contact</strong></p>
                                <p class="col-md-10 col-sm-10 col-xs-12"><?php echo $student['student_contact']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="">
                                <strong class="control-label col-md-9 col-sm-9 col-xs-12">Voucher Date</strong>
                                <p class="col-md-3 col-sm-3 col-xs-12"><?php echo date("d-m-Y",strtotime($invoice['date'])); ?></p>
                            </div>
                            <div class="">
                                <strong class="control-label col-md-9 col-sm-9 col-xs-12">Due Date</strong>
                                <p class="col-md-3 col-sm-3 col-xs-12"><?php echo date("d-m-Y",strtotime($invoice['date_expire']." -1 day")); ?></p>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fee</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Tution Fee</td>
                                <td><?php echo '+ '.$invoice['fee_pack']; ?></td>
                            </tr>
                            <?php $i=2; foreach($fee as $k=>$v){ ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $v['name'] ?></td>
                                <td><?php echo '+ '.$v['amount']; ?></td>
                            </tr>
                            <?php } if(!empty($lastadv)){?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td>Last Month Advance</td>
                                <td><?php echo '- '.$lastadv; ?></td><?php $total = $total - $lastadv; ?>
                            </tr>
                            <?php } if($invoice['is_admitted']==1){?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td>Admission Fee</td>
                                <td><?php echo '+ '.$invoice['admin_fee']; ?></td><?php $total = $total + $invoice['admin_fee']; ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <form class="form-horizontal form-label-left" action="<?php echo $base_url; ?>voucher/submit" method="post">
                        <input type="hidden" name="id" value="<?php echo $invoice['id']; ?>">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-8">
                                <div class="ln-solid"></div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <h2>Grand Total</h2>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <p><input id="total" type="number" name="total" class="form-control" readonly="readonly" value="<?php echo $total; ?>"></p>
                                    </div>
                                </div>
<?php 
			$due = date("Y-m-d",strtotime($invoice['date_expire']));
			$date = date("Y-m-d");
			if ($due<=$date && $invoice['status']==0) {
				$per = ($total * $invoice['late_fine']) / 100;
				$net = $total + $per;
				$fine = $per;
			} else {
				$net = $total;
				$fine = 0;
			}
?>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <h2>Late Fine</h2>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <p><input id="fine" type="number" name="fine" class="form-control" readonly="readonly" value="<?php echo $fine; ?>"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <h2>Arrears</h2>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <p><input id="arrears" type="number" name="arrears" class="form-control" readonly="readonly" value="<?php echo $lastrem?$lastrem:0; ?>"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <h2>Net Total</h2>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <p><input id="net" type="number" name="net" class="form-control" readonly="readonly" value="<?php echo $net = $total + $fine + $lastrem; ?>"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <h2>Recieved</h2>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <p><input id="recieved" type="number" name="recieved" class="form-control" <?php if($invoice['status']==0){ ?>value="0"<?php }else{ ?>value="<?php echo $invoice['recieved']; ?>" readonly="readonly" <?php } ?> min="0"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <h2>Remaining</h2>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <p><input id="remaining" type="number" name="remaining" class="form-control" readonly="readonly" min="0" max="<?php echo $net; ?>" value="<?php if($invoice['status']=='0'){ echo $net; }else{ echo $invoice['remaining']; } ?>"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <h2>Advance</h2>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <p><input id="advance" type="number" name="advance" class="form-control" readonly="readonly" value="<?php echo $invoice['advance']; ?>" min="0"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <h2>Submit Date</h2>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <p><input id="submitted_at" type="date" name="submitted_at" class="form-control" <?php if($invoice['status']=='0'){ $dat = date("Y-m-d"); }else{ $dat = $invoice['submitted_at']; echo "readonly='readonly'";} ?> value="<?php echo $dat; ?>" min="0"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if($invoice['status']==0){ ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button class="btn btn-success" type="submit">Submit Voucher</button>
                                    </div>
                                    <?php } ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12 <?php if($invoice['status']!=0){echo'col-md-offset-6';} ?>">
                                        <a target="_blank" href="<?php echo base_url(); ?>voucher/doprint/<?php echo $invoice['id']; ?>"><button class="btn btn-primary" type="button">Print</button></a>
                                    </div>
                                </div>
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

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            EduSolutions
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url(); ?>assets/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url(); ?>assets/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url(); ?>assets/js/flot/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/date.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flot/curvedLines.js"></script>
    <!-- jVectorMap -->
    <script src="<?php echo base_url(); ?>assets/js/maps/jquery-jvectormap-2.0.3.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/build/js/custom.min.js"></script>

    <script>
        $(function(){
            var total = $("#total").val();
            var net = $("#net").val();
            <?php if($invoice['status']==0){ ?>
            if(net <= 0 && total <= 0)
            {
                $("#total").val(0);
                $("#net").val(0);
                $("#remaining").val(0);
                $("#recieved").val(0);
                $("#advance").val(Math.abs(net));
            }else{
                $("#remaining").val(net);
            }
            <?php } ?>
            
            $(document).on("keyup","#recieved",function(){
                var val = parseInt($(this).val());
                var ret = parseInt($("#net").val()) - val;
                if(ret <= 0)
                {
                $("#remaining").val('0');
                $("#advance").val(Math.abs(ret));
                }else{
                $("#remaining").val(ret);
                $("#advance").val('0');
                }
            });
        });
    </script>

  </body>
</html>