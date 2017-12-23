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
                //height:710px;
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
                /*align:center;*/
                margin:40px;
                margin-left:200px;
                padding-top:50px;
                padding-left:100px;
                opacity:0.1;
                background:url("<?php echo base_url().$b_header['logo1']; ?>");
                background-size:100% 100%;
            }
            .watermark_wrapper
            {
                height:400px;
                width:100%;
                margin-top:150px;
                display:inline-flex;
                display:-webkit-inline-flex;
             }
            .wrapper.left2{
                width: calc(90vw);
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
                border-collapse:collapse;
                border: 1px dotted #000;
                text-align:center;
                width:100%;
                min-height:20px;
            }
            th{
                border: 1px dotted #000;
                background-color:#18a05e; 
                padding: 7px;
                padding-top:.5em;
                padding-bottom:.5em;
            }
            td{
                border: 1px dotted #000;
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

?>
 <?php 
 $name=$this->db->select('name')->from('level_3')->where('id',$val['level_3_id'])->get()->result_array()[0]['name']; ?>
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
                        <center><h1><?php echo $b_header['title']; ?></h1></center>
                        <center><h3 style="color:#000 !important;"><i><?php echo $b_header['tagline']; ?></i></h3></center>
                        <center><h3 style="color:#000 !important;"><?php echo $b_header['short_address']; ?></h3></center>
                        <center><h4>Contact# <?php echo $b_header['phone_no']; ?></h4></center>
                        <center><h4>Email: <?php echo $b_header['email']; ?></h4></center>
                        <center><h3 class="boxed" style="margin-top:10px !important;font-size:23px;"><?php echo $title ?></h3></center>
                    </div>
                </div>
            </div>
                   <br>
              
            <div class="body">
            <?php 
            
            $num=(explode("-",$val['date']));
            $y=(explode("20",$num[0]));
                       ?>
           <div class="wd-100 left" style="line-height:3em;">
                <div class="wd-100 clear">
                     <div class="wd-50 left">
                        <div class="wd-50 left"><h3>Date</h3></div>
                        <div class="wd-50 left"><h4><?php echo $val['date'] ;?></h4></div>
                    </div>
                <div class="wd-50 right">
                        <div class="wd-50 left"><h3>Voucher #</h3></div>
                        <div class="wd-50 left"><h4><?php echo $y[1] ; echo $num[1];echo  $num[2]; echo $val['id']; ?></h4></div>
                </div>      
                </div>
            
                
            </div>


           
<br/>
            <div class="wd-100 left" style="line-height:3em;">
                <div class="wd-100 clear">
                     <div class="wd-50 left">
                     <?php if($title=="Cash Payment"){$var="To"; $var2=$val['to_receipt']; }
                     
                     else  if($title=="Cash Receipt"){$var="From";  $var2=$val['from_voucher']; }
                      ?>
                        <div class="wd-50 left"><h3><?php echo $var;  ?></h3></div>
                        <div class="wd-50 left"><h4><?php echo $var2;  ?></h4></div>
                    </div>
                <div class="wd-50 left">
                        <div class="wd-50 left"><h3></h3></div>
                        <div class="wd-50 left"><h4></h4></div>
                </div>      
                </div>
            
                
            </div>

         


<br/>
            
            <table class="tbl1">
              <tbody>
              <tr >
                 <td class="td"><?php echo $name; ?></td>
                 <td class="td"><?php echo $val['amount'];?></td>
              </tr>
              <tr style="padding-top:15em;">
                 <td class="td">Total Amount</td>
                 <td class="td"><?php echo $val['amount'];?></td>
              </tr>
              </tbody>
            </table>
            
            
            
            
            
            
            
<br/>
            <div class="wd-100 left" style="line-height:3em;">
                <div class="wd-100 clear">
                     <div class="wd-50 left">
                        <div class="wd-50 left"><h3></h3></div>
                        <div class="wd-50 left"><h4></h4></div>
                    </div>
                <div class="wd-100 left">
                        <div class="wd-50 right"><h3>Signature :________________________</h3></div>
                        <div class="wd-50 left"><h4></h4></div>
                </div>      
                </div>
            
                
            </div>


                </div><!--Class Body end-->
                

                
            </div>
            
                
                
             
                
            </div>
        </div>
        
           
    </div>
</div>
</div>
    </body>
    <script>
       // window.print();
    </script>
</html>
