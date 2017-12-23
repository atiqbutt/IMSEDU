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
                    <h3>Salary</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Salary</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <style media="print">
                    * {-webkit-print-color-adjust:exact;}
                    .border_wrapper{
                        width:100%;
                        height:100%;
                        border: 7px double #17a05e;
                        box-sizing: border-box;
                        border-radius: 10px;
                        padding: 10px;
                    }
                    .table > thead > tr > th{
                        background-color: #17a05e !important;
                        color: #fff !important;
                        border-color: #17a05e !important;
                    }
                    #print{display:none;}
                    </style>
                    <div class="border_wrapper">
                        <div class="row">
                            <div class="col-md-7 col-sm-7 col-xs-5">
                                <h1>Salary Slip</h1>
                            
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-4 form-horizontal">
                                <h2 class="control-label"><?php echo $branch['name']; ?></h2>
                                <h3 class="control-label"><?php echo $branch['contact']; ?></h3>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-3">
                                <img src="<?php echo base_url().$branch['b_logo']; ?>" width="100" height="100" alt="">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="row form-horizontal">
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <div class="">
                                    <p class="col-md-2 col-sm-2 col-xs-3"><strong>Slip #</strong></p>
                                    <p class="col-md-10 col-sm-10 col-xs-9"><?php echo $invoice; ?></p>
                                </div>
                                <div class="">
                                    <p class="col-md-2 col-sm-2 col-xs-3"><strong>Name</strong></p>
                                    <p class="col-md-10 col-sm-10 col-xs-9"><?php echo $employee['firstname']." ".$employee['lastname']; ?></p>
                                </div>
                                <div class="">
                                    <p class="col-md-2 col-sm-2 col-xs-3"><strong>CNIC</strong></p>
                                    <p class="col-md-10 col-sm-10 col-xs-9"><?php echo $employee['cnic']; ?></p>
                                </div>
                                <div class="">
                                    <p class="col-md-2 col-sm-2 col-xs-3"><strong>Contact</strong></p>
                                    <p class="col-md-10 col-sm-10 col-xs-9"><?php echo $employee['contact']; ?></p>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <div class="">
                                    <strong class="control-label col-md-8 col-sm-8 col-xs-7">Month</strong>
                                    <p class="col-md-4 col-sm-4 col-xs-5"><?php echo date("F - Y",strtotime($month)); ?></p>
                                </div>
                                <div class="">
                                    <strong class="control-label col-md-8 col-sm-8 col-xs-7">Create Date</strong>
                                    <p class="col-md-4 col-sm-4 col-xs-5"><?php echo $create_date; ?></p>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th><th>Name</th><th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; $net=$employee['salery']; ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td>Basic Salary</td>
                                    <td>+ <?php echo $employee['salery']; ?></td>
                                </tr>
                            <?php 
                            if(!empty($allonce)){                             
                                foreach($allonce as $allonce){?>
                                <tr>
                                <td><?php echo $i++ ?></td><td><?php echo $allonce['name']?></td><td>+ <?php echo $allonce['amount']?></td>    
                                    <?php $net+=$allonce['amount'];?>
                                </tr>
                            <?php }
                            }
                            if(!empty($advance)){
                                foreach($advance as $advance){?>
                                <tr>
                                <td><?php echo $i++ ?></td><td>Advance</td><td>- <?php echo $advance['totaladvance']?></td>    
                                    <?php $net-=$advance['totaladvance'];?>
                                </tr>
                            <?php } 
                            }
                            if(!empty($deduction)){
                                foreach($deduction as $deduction){?>
                                <tr>
                                <td><?php echo $i++; ?></td><td>Deduction</td><td>- <?php echo $deduction['Amount']; ?></td>    
                                <?php $net-=$deduction['Amount'];?>
                                </tr>
                            <?php } 
                            }
                            if(!empty($security)){
                                foreach($security as $security){?>
                                <tr>
                                <td><?php echo $i++; ?></td><td>Security</td><td>- <?php echo $security['detuct_amount']; ?></td>    
                                    <?php $net-=$security['detuct_amount']; ?>
                                </tr>
                            <?php } 
                            }
                            ?>
                            </tbody>
                        </table>
                        <div class="form-horizontal form-label-left">
                            
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-4 col-md-offset-8 col-sm-offset-8 col-xs-offset-8">
                                    <div class="ln-solid"></div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <h2>Total Salary</h2>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <p><input id="salary" type="number" name="salary" class="form-control" readonly="readonly" value="<?php echo $employee['salery']; ?>" min="0"></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <h2 style="font-weight:900;">Net Salary</h2>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <p><input id="net" type="number" name="net" class="form-control" readonly="readonly" min="0" value="<?php echo $net; ?>"></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <button class="btn btn-primary" id="print">Print</button>
                                        </div>
                                     <?php if($ret['is_paid']==0){ ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <a href="<?php echo base_url(); ?>salary/is_paid/<?php echo $sal_id; ?>" class="btn btn-primary" id="paid">Paid</a><?php }?>
 
 
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
          </div>
        </div>
        <!-- /page content -->

       </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
   
    <script>
        $(function(){
            var total = $("#total").val();
            var net = $("#net").val();
            <?php if($invoice['status']==0){ ?>
            if(total <= 0)
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
    <script>
        $(function(){
            $(document).on("click","#print",function(){
                printDiv();
            });
        });
        function printDiv() 
        {
            var divToPrint=$('.x_content').html();
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<html><head><link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"></head><body onload="window.print();">'+divToPrint+'</body></html>');
            newWin.document.close();
            setTimeout(function(){newWin.close();},5);
        }
    </script>

  </body>
</html>