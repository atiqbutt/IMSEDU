<html>
    <head>
        <title><?php echo $b_header['title']; ?></title>
        <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="all">
    
    <style type="text/css">
         
          
.relative{position:relative;}
.text-bold{font-weight:bold;}
h4,hr{margin:2px;}
h3,h2,h1,h4{color:#17a05e;}
.logo{width:100px;height:100px;position:absolute;top:0;left:0;}
@media print{
 * {-webkit-print-color-adjust:exact;}

.logo{width:300px !important;height:100px;}
#myDataTable{width:100%;margin:0;font-size:14px;}
.print_doj{width:110px;}
}
    </style>
    </head>
    <body >

        <div class="super_container">
        <div class="container-fluid">
          <div class="row header">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                      <div class="col-md-1 col-sm-2 col-xs-2 relative"><img class="logo" src="<?php echo base_url().$b_header['b_logo'];?>"></div>
                      <div class="col-md-11 col-sm-10 col-xs-10 text-center">
                            <h2 class="wd-100"><?php echo $b_header['title']; ?></h2>
                            <h3 class="wd-100"><?php echo $b_header['tagline']; ?></h3>
                      </div>
<?php if($type=="teacher"){
$t="Teacher's";}
else{ $t="Staff";} ?>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                             <div class="col-md-4 col-sm-4 col-xs-4 text-left">
                                <h3> <?php echo $t." Salaries"; ?></h3>
                             </div>
                             <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                                <h2> <?php echo $b_header['name']; ?></h2>
                             </div>
                             <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                                 <h3><?php echo "<b>Month</b>: ".date("F, Y",strtotime($month)); ?></h3>
                             </div>
                      </div>
                  </div>  
              </div>
          </div>
<hr/>
<hr/>
<hr/>


           
          <div class="row header">
    <div>

                      <table id="myDataTable" class="table table-striped table-bordered nowrap" style="width:100%;" >
                      
                        <tr>
                          
                          <th >#</th>
                          <th >Employee Name</th>
                          <th class="print_doj">Date of Join</th>
                          <th >Salary</th>
                          <th >Deduction</th>
                          <th >Advance</th>
                          <th >Security</th>
                          <th >Bonus</th>
                           <th >Status</th>
                          <th >Total</th>
                           
                        </tr>
                                           
                     
                      <?php $i=1;  $dedu=0;$advanc=0;$allonc=0;$securit=0;$fi=0;
                       foreach ($employee as $key => $value) { 
                           $cut=0; $add=0;
                            
                           ?>
                          <tr><td><?php echo $i++; ?></td>
                          <td><?php echo $value['firstname']." ".$value['lastname']; ?> </td>
                           
                            <td><?php echo $value['doj']; ?></td>
                          <td><?php echo $value['salery'] ?></td>
                          <td id="deduct"><?php $v=0; foreach ($deduction as $key => $det) {
                              if($value['empid']==$det['bothid']){
                                  $v=$det['Amount'];
                                  $cut=$det['Amount']+$cut;
                                   $dedu+=$det['Amount'];
                              }
                          } echo $v; ?></td>
                          <td><?php $v=0; foreach ($advance as $key => $adv) {

                             
                              if($value['empid']==$adv['bothid']){
                                  $v=$adv['totaladvance'];
                                  $cut=$adv['totaladvance']+$cut;
                                  $advanc=$adv['totaladvance']+$advanc;
                              }
                          } echo $v; ?></td>
                          <td><?php $v=0;  foreach ($security as $key => $sec) {
                              if($value['empid']==$sec['bothid']){
                                  $v=$sec['detuct_amount'];
                                $cut=$sec['detuct_amount']+$cut;
                                $securit=$sec['detuct_amount']+$securit;
                              }
                          } echo $v; ?></td>
                          <td><?php $v=0;  foreach ($allonce as $key => $all) {
                                if($value['empid']==$all['bothid']){
                                  $v = $all['amount'];
                                   $add=$add+$all['amount'];
                                   $allonc=$all['amount']+$allonc;
                                }
                            } 
                            echo $v;
                            ?></td>
                           <td><?php if($value['is_paid']==1) echo "Paid";else echo "Not Paid";?></td>
                          <td><?php 
                          $total=$value['salery']-$cut;  $final=$total+$add; $fi=$final+$fi; echo "<b>".$final."</b>";  ?></td>

                          </tr>
                        
                      <?php }?>
                     <tr style="font-weight:bold"><td class="right-border"></td><td class="right-border">Total</td><td class="right-border">=</td><td class="right-border"></td><td><?php echo $dedu; ?></td><td><?php echo $advanc; ?></td><td><?php echo $securit; ?></td> <td><?php echo $allonc; ?></td><td></td><td><?php echo $fi; ?></td></tr>
                      
                      </table>
                      </div >
</div>







 <script>//window.print();</script>
    </body>
</html>