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
                    margin-top: 20px;
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
            min-height:710px;
            }
            .wrapper{
                //width:calc(100vw - 20px);
                min-height:500px;
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
                min-height:710px;
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
                width: 90%;
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
                padding: 7px !important;font-size:15px;
            }
            td{
                padding: 7px !important;font-size:14px;
            }
            .normal{
                font-weight: normal !important;
            }
            .text-right{
                text-align: right !important;
            }
            .color-g{
                color: #18a05e;
            }
            .table-info td{
                padding: 0px !important;
            }
        </style>
    </head>
    <body class="clear">
        <?php 
        date_default_timezone_set("Asia/Karachi");
        foreach($students as $k=>$student) {
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
                                    <img src="<?php echo base_url().$b_header['logo1']; ?>" style="width:70px;height:70px;">
                                </div>
                                <div class=" text-left right ">
                                    <img src="<?php echo base_url().$b_header['logo2']; ?>" style="width:70px;height:70px;">
                                </div>
                            
                                <div style="">
                                
                                    <center><h2><?php echo $b_header['title']; ?></h2></center>
                                    <center><h4><i><?php echo $b_header['tagline']; ?></i></h4></center>
                                    <center><h4>Contact# <?php echo $b_header['phone_no']; ?></h4></center>
                                    <center><h4>Email: <?php echo $b_header['email']; ?></h4></center>
                                    <h3 class="boxed" style="margin-top:10px !important;font-size:23px;">Roll No Slip</h3>
                                </div>
                            </div>

                        </div>
                        <div class="body">
                            <div class="clear">
                                <div class="left wd-80">
                                    <div class="clear wd-100">
                                        <div class="left wd-50">
                                            <table class="table-info">
                                                <tr>
                                                    <td><b class="color-g">Branch:</b></td><td><b><?php echo $b_header['name'];?> </b></td>
                                                </tr>
                                                <tr>
                                                    <td><b class="color-g">Exam:</b></td><td><b><?php echo $exam['name'] ;?></b></td>
                                                </tr>
                                                <tr>
                                                    <td><b class="color-g">Gr. No:</b></td><td><b><?php echo $student['grno']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b class="color-g">Class:</b></td><td><b><?php echo $student['class_name']." / ".$student['section_name']; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                        <div class="left wd-50">
                                            <table class="table-info">
                                                <tr>
                                                    <td><b class="color-g">Name :</b></td><td><?php echo $student['student_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b class="color-g">Father Name :</b></td><td><?php echo $student['father_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b class="color-g">Seat # :</b></td><td><?php //echo $seat_no; ?></td>
                                                </tr>
                                                <tr>    
                                                    <td><b class="color-g">Date Of Birth :</b></td><td><?php echo date("d-m-Y",strtotime($student['dob'])); ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="right">
                                    <img src="<?php echo base_url().$student['img']; ?>" alt="" width="70" height='70'>
                                </div>
                            </div>
                            <div class="clear">
                                <div class="">
                                <table class="table table-bordered table-stripped" style="margin: 0 auto;width: 100%;">

                                        <tr  style="background-color:#18a05e;color:black;border: 2px dotted #000;">
                                            <th>Sr No.</th>
                                            <th class="th">Subject</th>
                                            <th>Date</th>
                                            <th>Day</th>
                                            <th>Time Start</th>
                                            <th>Time End</th>
                                        </tr>


                                        <?php $i=1; foreach($data as $v){ ?>
                                        <tr style="text-align: center;" >
                                    
                                            <td><?php echo $i++; ?></td>
                                            <td ><?php echo $v['subject_name']; ?></td>
                                            <td><?php echo date("d-m-Y",strtotime($v['date_exam'])); ?></td>
                                            <td><?php echo $v['day_exam']; ?></td>
                                            <td><?php echo date("h:i A",strtotime($v['start_time'])); ?></td>
                                            <td><?php echo date("h:i A",strtotime($v['end_time'])); ?></td>
                                        </tr>
                                
                                        <?php }  ?>

                                    </center>
                                </table>
                            </div>
                            <h3 style= "text-align:left">Note</h3>
                            <ul style="margin-left :10px;font-size: 12px;">
                                <?php foreach($note as $v){ ?> 
                                <li>
                                    <?php echo $v['note']; ?>
                                </li>
                                <?php } ?>
                            </ul>                   
                        </div>  
                    </div>     
                </div>
            </div>
        </div>
        </div>
        <?php } ?>
        <script>
            window.print();
        </script>
    </body>
</html>