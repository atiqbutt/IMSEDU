<html>
    <head>
        <title><?php echo $b_header['title']; ?></h3></title>
        <style>
            @media print
            {
                * {-webkit-print-color-adjust:exact;}
                  //.super_container {page-break-before: always; padding-top:10px; margin-bottom:150px !important;}
                //.page_break {page-break-after: always;}
                @page {margin:0in 0.10in 0in 0in; }
                .super_container
{
page-break-after: always;
// margin-bottom:200px;
 margin-top:0.25in;
position:relative;
width:100vw;
height:710px;
}
            }
body {margin: 0.25in 0.25in 0.63in 0.25in; box-sizing:border-box;width:100vw; height:100vh;padding-bottom:0.63in;}
            *{margin:0;padding:0;font-family:calibri;}
            .clear:after{content:"";clear:both;display:block;}
            .left{float:left;}
            .right{float:right;}
            .wd-10{width:10%;}
            .wd-20{width:20%;}
            .wd-30{width:30%;}
            .wd-40{width:40%;}
            .wd-50{width:50%;}
            .wd-60{width:60%;}
            .wd-70{width:70%;}
            .wd-80{width:80%;}
            .wd-90{width:90%;}
            .wd-100{width:100%;}
            .wd-15{width:15%;}
            .wd-25{width:25%;}
            .wd-35{width:35%;}
            .wd-45{width:45%;}
            .wd-55{width:55%;}
            .wd-65{width:65%;}
            .wd-75{width:75%;}
            .wd-85{width:85%;}
            .wd-95{width:95%;}
            .wd-100{width:100%;}
            .title{font-size:35px;}
            .super_container
            {
            margin-bottom:200px;
            position:relative;
            width:100vw;
            height:710px;
            }
            .wrapper{
                //width:calc(100vw - 20px);
                height:710px;
                //margin:10px;
                border:4px dotted #18a05e;
                outline: 7px double #18a05e;
                outline-offset: 5px;
                box-sizing: border-box;
                padding:5px;
                
                
            }
           
            .super_wrapper
            {
                position:absolute;
                top:0;
                left:0;
                width:100%;
                height:710px;
                z-index:120;
                margin:0;
                padding:0;
            }
            .watermark
            {
                height:200px;
                width:300px;
                //align:center;
                margin:auto;
                margin-left:600px;
                padding-top:50px;
                padding-left:120px;
                opacity:0.1;
                background:url('./watermark.jpg');
                background-size:100% 100%;
            }
            .watermark_wrapper
            {
                height:470px;
                width:100%;
                margin-top:150px;
                display:inline-flex;
                display:-webkit-inline-flex;
             }
            .wrapper.left2{
                width: calc(30vw - 5px);
                margin-right: 20px;
                margin-left: 20px;
            }
            
            h1,h2,h3{
                color:#18a05e;
                font-family:calibri;
                text-align:center;
            }
            //h3{font-weight: 700;}
            .boxed{background:#18a05e;color:#fff;width:80%;margin:0 auto;}
            .header{
                width:100%;
                //height:110px;
                border-bottom:4px double #18a05e;
                padding-bottom:10px;            }
            .body{
                padding:10px;
            }
            .row{
                width:100%;
                margin: 10px auto;  
            }
            .text-center{text-align:center;}
            .bold{font-weight:bold;}
            .b-u-l{
                border-bottom: 1px solid #000;
                height:inherit;
            }
            .x-small{
                font-size: 10px;
            }
            .x-x-small{
                font-size: 7px;
            }
            .page_break{
                width: 100vw;
                height: 100vh;
                padding: 10px 0px;
                box-sizing: border-box;
            }
            .tbl1
            {
                border: 1px solid #000;
                text-align:center;
                width:100%;
                min-height:20px;
            }
            th{
                padding: 7px !important;
            }
            td{
                padding: 7px !important;
            }
            .normal{
                font-weight: normal !important;
            }
            .text-right{
                text-align: right !important;
            }
        </style>
    </head>
    <body class="clear">
<?php 
date_default_timezone_set("Asia/Karachi");
$t1 = $total;
$t2 = $total;
$t3 = $total;
?>
 <div class="super_container">
    <div class="page_break clear">
     <div class="watermark_wrapper">
        <div class="watermark"></div>
        </div>
        <div class="super_wrapper">
        <div class="wrapper left2 left">
            <div class="header">
                 <div class="wd-100 clear">
                    <div class=" text-left left ">
                        <img src="<?php echo base_url().$b_header['logo1']; ?>" style="width:50px;height:50px;">
                    </div>
                    <div class=" text-left right ">
                        <img src="<?php echo base_url().$b_header['logo2']; ?>" style="width:50px;height:50px;">
                    </div>
                    <div style="">
                        <center><h3><?php echo $b_header['title']; ?></h3></center>
                        <center><h4><i><?php echo $b_header['tagline']; ?></i></h4></center>
                        <center><h4><?php echo $b_header['short_address']; ?></h4></center>
                        <center><h4>Contact# <?php echo $b_header['phone_no']; ?></h4></center>
                        <center><h4>Email: <?php echo $b_header['email']; ?></h4></center>
                        <center><h3 class="boxed" style="margin-top:10px !important;">Student's Copy</h3></center>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="row clear">
                    <div class="left">
                        <p class="x-large"><strong>Challan # </strong> <?php echo $invoice['id']; ?></p>
                    </div>
                    <div class="right">
                        <p class="x-large"><strong>GR. No. </strong><b> <?php echo $student['grno']; ?></b></p>
                    </div>
                </div>
                <div class="row clear">
                    <div class="wd-50">
                        <div class="left wd-50 x-large">
                            <p>Issue Date: </p>
                        </div>
                        <div class="left wd-50 x-large">
                            <b><?php echo date("d-m-Y",strtotime($invoice['date'])); ?></b>
                        </div>
                    </div>
                    <div class="wd-50 right text-right">
                        <div class="left wd-50 x-large">
                            <p>Due Date: </p>
                        </div>
                        <div class="left wd-50 x-large text-right">
                            <b><?php echo date("d-m-Y",strtotime($invoice['date_expire']." -1 day")); ?></b>
                        </div>
                    </div>
                </div>
                <div class="row clear">
                    
                        <div class="left wd-40 x-large">
                            <p>Fee of the Month:</p>
                        </div>
                        <div class="left wd-60 x-large">
                            <b><?php echo date("F",strtotime($invoice['date'])); ?></b>
                        </div>
                    
                    
                </div>
                <div class="row clear">
                    <div class="left wd-40 x-large">
                        <p>Name:</p>
                    </div>
                    <div class="left wd-60 x-large">
                        <b><?php echo $student['student_name']; ?></b>
                    </div>
                </div>
               <div class="row clear">
                    <div class="left wd-40 x-large">
                        <p>Father Name:</p>
                    </div>
                    <div class="left wd-60 x-large">
                        <b><?php echo $student['father_name']; ?></b>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-40 x-large">
                        <p>Class:</p>
                    </div>
                    <div class="left wd-60 x-large">
                        <b><?php echo $student['class_name']." / ".$student['section_name']; ?></b>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left ">
                        <p>The details of dues are as under: </p>
                    </div>
                    
                </div>
                <div class="row clear ">
                    <table class="tbl1" border="1">
                    <tr><th>Head</th><th>Amount</th></tr>
                    <tr><td>Tuition Fee </td><td><?php echo $invoice['fee_pack']; ?></td></tr>
                    <?php foreach($fee as $k=>$v){ ?>
                    <tr><td><?php echo $v['name']; ?></td><td><?php echo $v['amount']; ?></td></tr>
                    <?php } foreach($add_months as $k=>$v){ ?>
                    <tr><td><?php echo "Tuition fee for ".date('F Y',strtotime($v['month']));; ?></td><td><?php echo $v['fee']; ?></td></tr>
                    <?php } if(!empty($lastadv)){?>
                    <tr>
                          <td>Last Month Advance</td>
                          <td><?php echo $lastadv; ?></td><?php $t1 = $t1 - $lastadv; ?>
                    </tr>
                    <?php } if($invoice['is_admitted']==1){?>
                    <tr>
                          <td>Admission fee</td>
                          <td><?php echo $invoice['admin_fee']; ?></td><?php $t1 = $t1 + $invoice['admin_fee']; ?>
                    </tr>
                    <?php } if(!empty($lastrem)){?>
                    <tr>
                          <td>Arrears</td>
                          <td><?php echo $lastrem; ?></td>
                    </tr>
                    <?php } ?>
                    <tr><td><b>Total (Payable by Due Date)</b></td><td><?php $t1 = ($t1 < 0)?0:$t1;echo $t1+$lastrem; ?></td></tr>
                    <tr><td><b><?php echo $invoice['late_fine']; ?>% Late Fees</b></td><td><?php echo ($t1*$invoice['late_fine'])/100; ?></td></tr>
                    <tr><td><b>Payable After Due Date</b></td><td><?php echo (($t1*$invoice['late_fine'])/100) + $t1 + $lastrem; ?></td></tr>
                    </table>
                </div>
                
            </div>
        </div>
        <div class="wrapper left2 left">
            <div class="header">
                 <div class="wd-100 clear">
                                        <div class=" text-left left ">
                        <img src="<?php echo base_url().$b_header['logo1']; ?>" style="width:50px;height:50px;">
                    </div>
                    <div class=" text-left right ">
                        <img src="<?php echo base_url().$b_header['logo2']; ?>" style="width:50px;height:50px;">
                    </div>
                    <div style="">
                        <center><h3><?php echo $b_header['title']; ?></h3></center>
                        <center><h4><i><?php echo $b_header['tagline']; ?></i></h4></center>
                        <center><h4><?php echo $b_header['short_address']; ?></h4></center>
                        <center><h4>Contact# <?php echo $b_header['phone_no']; ?></h4></center>
                        <center><h4>Email: <?php echo $b_header['email']; ?></h4></center>
                        <center><h3 class="boxed" style="margin-top:10px !important;">Bank's Copy</h3></center>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="row clear">
                    <div class="left">
                        <p class="x-large"><strong>Challan # </strong> <?php echo $invoice['id']; ?></p>
                    </div>
                    <div class="right">
                        <p class="x-large"><strong>GR. No. </strong><b> <?php echo $student['grno']; ?></b></p>
                    </div>
                </div>
                <div class="row clear">
                    <div class="wd-50">
                        <div class="left wd-50 x-large">
                            <p>Issue Date: </p>
                        </div>
                        <div class="left wd-50 x-large">
                            <b><?php echo date("d-m-Y",strtotime($invoice['date'])); ?></b>
                        </div>
                    </div>
                    <div class="wd-50 right text-right">
                        <div class="left wd-50 x-large">
                            <p>Due Date: </p>
                        </div>
                        <div class="left wd-50 x-large text-right">
                            <b><?php echo date("d-m-Y",strtotime($invoice['date_expire']." -1 day")); ?></b>
                        </div>
                    </div>
                </div>
                <div class="row clear">
                    
                        <div class="left wd-40 x-large">
                            <p>Fee of the Month:</p>
                        </div>
                        <div class="left wd-60 x-large">
                            <b><?php echo date("F",strtotime($invoice['date'])); ?></b>
                        </div>
                    
                    
                </div>
                <div class="row clear">
                    <div class="left wd-40 x-large">
                        <p>Name:</p>
                    </div>
                    <div class="left wd-60 x-large">
                        <b><?php echo $student['student_name']; ?></b>
                    </div>
                </div>
               <div class="row clear">
                    <div class="left wd-40 x-large">
                        <p>Father Name:</p>
                    </div>
                    <div class="left wd-60 x-large">
                        <b><?php echo $student['father_name']; ?></b>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-40 x-large">
                        <p>Class:</p>
                    </div>
                    <div class="left wd-60 x-large">
                        <b><?php echo $student['class_name']." / ".$student['section_name']; ?></b>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left ">
                        <p>The details of dues are as under: </p>
                    </div>
                    
                </div>
                <div class="row clear ">
                    <table class="tbl1" border="1">
                    <tr><th>Head</th><th>Amount</th></tr>
                    <tr><td>Tuition Fee </td><td><?php echo $invoice['fee_pack']; ?></td></tr>
                    <?php foreach($fee as $k=>$v){ ?>
                    <tr><td><?php echo $v['name']; ?></td><td><?php echo $v['amount']; ?></td></tr>
                    <?php } foreach($add_months as $k=>$v){ ?>
                    <tr><td><?php echo "Tuition fee for ".date('F Y',strtotime($v['month']));; ?></td><td><?php echo $v['fee']; ?></td></tr>
                    <?php } if(!empty($lastadv)){?>
                    <tr>
                          <td>Last Month Advance</td>
                          <td><?php echo $lastadv; ?></td><?php $t2 = $t2 - $lastadv; ?>
                    </tr>
                    <?php } if($invoice['is_admitted']==1){?>
                    <tr>
                          <td>Admission fee</td>
                          <td><?php echo $invoice['admin_fee']; ?></td><?php $t2 = $t2 + $invoice['admin_fee']; ?>
                    </tr>
                    <?php } if(!empty($lastrem)){?>
                    <tr>
                          <td>Arrears</td>
                          <td><?php echo $lastrem; ?></td>
                    </tr>
                    <?php } ?>
                    <tr><td><b>Total (Payable by Due Date)</b></td><td><?php $t2 = ($t2 < 0)?0:$t2;echo $t2+$lastrem; ?></td></tr>
                    <tr><td><b><?php echo $invoice['late_fine']; ?>% Late Fees</b></td><td><?php echo ($t2*$invoice['late_fine'])/100; ?></td></tr>
                    <tr><td><b>Payable After Due Date</b></td><td><?php echo (($t2*$invoice['late_fine'])/100) + $t2 + $lastrem; ?></td></tr>
                    </table>
                </div>
                
            </div>
        </div>
         <div class="wrapper left2 left">
            <div class="header">
                 <div class="wd-100 clear">
                    <div class=" text-left left ">
                        <img src="<?php echo base_url().$b_header['logo1']; ?>" style="width:50px;height:50px;">
                    </div>
                    <div class=" text-left right ">
                        <img src="<?php echo base_url().$b_header['logo2']; ?>" style="width:50px;height:50px;">
                    </div>
                    <div style="">
                        <center><h3><?php echo $b_header['title']; ?></h3></center>
                        <center><h4><i><?php echo $b_header['tagline']; ?></i></h4></center>
                        <center><h4><?php echo $b_header['short_address']; ?></h4></center>
                        <center><h4>Contact# <?php echo $b_header['phone_no']; ?></h4></center>
                        <center><h4>Email: <?php echo $b_header['email']; ?></h4></center>
                        <center><h3 class="boxed" style="margin-top:10px !important;">School's Copy</h3></center>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="row clear">
                    <div class="left">
                        <p class="x-large"><strong>Challan # </strong> <?php echo $invoice['id']; ?></p>
                    </div>
                    <div class="right">
                        <p class="x-large"><strong>GR. No. </strong><b> <?php echo $student['grno']; ?></b></p>
                    </div>
                </div>
                <div class="row clear">
                    <div class="wd-50">
                        <div class="left wd-50 x-large">
                            <p>Issue Date: </p>
                        </div>
                        <div class="left wd-50 x-large">
                            <b><?php echo date("d-m-Y",strtotime($invoice['date'])); ?></b>
                        </div>
                    </div>
                    <div class="wd-50 right text-right">
                        <div class="left wd-50 x-large">
                            <p>Due Date: </p>
                        </div>
                        <div class="left wd-50 x-large text-right">
                            <b><?php echo date("d-m-Y",strtotime($invoice['date_expire']." -1 day")); ?></b>
                        </div>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-40 x-large">
                        <p>Fee of the Month:</p>
                    </div>
                    <div class="left wd-60 x-large">
                        <b><?php echo date("F",strtotime($invoice['date'])); ?></b>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-40 x-large">
                        <p>Name:</p>
                    </div>
                    <div class="left wd-60 x-large">
                        <b><?php echo $student['student_name']; ?></b>
                    </div>
                </div>
               <div class="row clear">
                    <div class="left wd-40 x-large">
                        <p>Father Name:</p>
                    </div>
                    <div class="left wd-60 x-large">
                        <b><?php echo $student['father_name']; ?></b>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-40 x-large">
                        <p>Class:</p>
                    </div>
                    <div class="left wd-60 x-large">
                        <b><?php echo $student['class_name']." / ".$student['section_name']; ?></b>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left ">
                        <p>The details of dues are as under: </p>
                    </div>
                    
                </div>
                <div class="row clear ">
                    <table class="tbl1" border="1">
                    <tr><th>Head</th><th>Amount</th></tr>
                    <tr><td>Tuition Fee </td><td><?php echo $invoice['fee_pack']; ?></td></tr>
                    <?php foreach($fee as $k=>$v){ ?>
                    <tr><td><?php echo $v['name']; ?></td><td><?php echo $v['amount']; ?></td></tr>
                    <?php } foreach($add_months as $k=>$v){ ?>
                    <tr><td><?php echo "Tuition fee for ".date('F Y',strtotime($v['month']));; ?></td><td><?php echo $v['fee']; ?></td></tr>
                    <?php } if(!empty($lastadv)){?>
                    <tr>
                          <td>Last Month Advance</td>
                          <td><?php echo $lastadv; ?></td><?php $t3 = $t3 - $lastadv; ?>
                    </tr>
                    <?php } if($invoice['is_admitted']==1){?>
                    <tr>
                          <td>Admission fee</td>
                          <td><?php echo $invoice['admin_fee']; ?></td><?php $t3 = $t3 + $invoice['admin_fee']; ?>
                    </tr>
                    <?php } if(!empty($lastrem)){?>
                    <tr>
                          <td>Arrears</td>
                          <td><?php echo $lastrem; ?></td>
                    </tr>
                    <?php } ?>
                    <tr><td><b>Total (Payable by Due Date)</b></td><td><?php $t3 = ($t3 < 0)?0:$t3;echo $t3+$lastrem; ?></td></tr>
                    <tr><td><b><?php echo $invoice['late_fine']; ?>% Late Fees</b></td><td><?php echo ($t3*$invoice['late_fine'])/100; ?></td></tr>
                    <tr><td><b>Payable After Due Date</b></td><td><?php echo (($t3*$invoice['late_fine'])/100) + $t3 + $lastrem; ?></td></tr>
                    </table>
                </div>
                
            </div>
        </div>
           
    </div>
</div>
</div>
    </body>
    <script>
        window.print();
    </script>
</html>
