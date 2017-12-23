
<html>
    <head>
        <title><?php echo $b_header['title']; ?></h3></title>
        <style>
            @media print
            {
                * {-webkit-print-color-adjust:exact;}
                @page {margin:0in 0.10in 0in 0in; }
                .super_container
                {
                    page-break-after: always;
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
                z-index:120;
                margin:0;
                padding:0;
            }
            .watermark
            {
                height:200px;
                width:300px;
                margin:auto;
                margin-top:365px;
                padding-top:50px;
                padding-left:120px;
                opacity:0.1;
                background:url("<?php echo base_url().$b_header['logo1']; ?>");
                background-size:100% 100%;
            }
            .watermark_wrapper
            {
                height:470px;
                width:100%;
                margin-top:50px;
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
            .boxed{background:#18a05e;color:#fff;width:80%;margin:0 auto;}
            .header{
                width:100%;
                border-bottom:4px double #18a05e;            
            }
            .body{
                padding:10px;
            }
            .row{
                width:100%;
                margin: 0px auto;  
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
                border: 2px dotted #000;
                text-align:center;
                width:100%;
                min-height:20px;
            }
            th{
                border: 2px solid #000;
                background-color:#18a05e; 
                padding: 3px !important;
            }
            td{
                border: 2px solid #000;
                padding: 2px !important;
            }
            .normal{
                font-weight: normal !important;
            }
            .text-right{
                text-align: right !important;
            }
            .text-left{
                text-align: left !important;
            }
            .margin-a{margin: 30px auto 0px auto;}
            table { page-break-inside:auto }
            tr    { page-break-inside:avoid; page-break-after:auto }
            thead { display:table-header-group }
            tfoot { display:table-footer-group }
        </style>
    </head>
    <body class="clear">
        <?php date_default_timezone_set("Asia/Karachi"); ?>
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
                                    <center><i><h3 style="color:#000 !important;font-weight:normal;"><?php echo $b_header['short_address']; ?></h3></i></center>
                                     <center><h3 style="color:#000 !important;"><i style="color:#000 !important;">Bank Reciept</i></h3></center>
                                  </div>
                            </div>
                          <br>
                         
                        </div>
                       
                        <div class="body">
                            <table class="tbl1">
                                 <tr>
                                    <th class="th">#</th>
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
								  <?php $total_amount=0; foreach($recipt as $key => $value) { ?>

                                <tr>
                                 
                                        <td class="td"><?php echo ++$key; ?></td>
                                        <td class="td"><?php echo $value['programename']; ?></td>
                                        <td class="td"><?php echo $value['p_name']; ?></td>
                                        <td class="td"><?php echo $value['headname']; ?></td>
                                        <td class="td"><?php echo $value['level2name'];  ?></td>
                                        <td class="td"><?php echo $value['level3name'];   ?></td>
                                        <td class="td"><?php echo $value['b_name'];   ?></td>
                                        <td class="td"><?php echo $value['from_recpt'];  ?></td>
                                        <td class="td"><?php echo $value['amount']; $total_amount+=$value['amount']; ?></td>
                                        <td class="td"><?php echo $value['date'];  ?></td>          
                                </tr>
                                            <?php
                                            } 
                                            
                                            
                                            ?>
                                <tr>
                                    <td class="td text-right text-bold" colspan="8">Total:</td>
                                    <td class="td text-bold" colspan="2"><?php echo $total_amount; ?></td>
                                </tr>

                            </table>
                           
                           
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

