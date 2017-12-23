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
                padding-top:50px;
                padding-left:100px;
                opacity:0.1;
                background:url("<?php echo base_url().$b_header['logo1']; ?>");
                background-size:100% 100%;
            }
            .watermark_wrapper
            {
                height:100%;
                width:100%;
                //margin-top:50px;
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
                border: 2px dotted #000;
                background-color:#18a05e; 
                padding: 3px !important;
            }
            td{
                border: 2px dotted #000;
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
                                    <center><h3 style="color:#000 !important;"><i><?php echo $b_header['tagline']; ?></i></h3></center>
                                    <center><i><h3 style="color:#000 !important;font-weight:normal;"><?php echo $b_header['short_address']; ?></h3></i></center>
                                    <!--<center><h4>Contact# <?php //echo $b_header['phone_no']; ?> / <?php //echo $b_header['email']; ?></h4></center>-->
                                    <center><h3 class="boxed" style="margin-top:0px !important;font-size:23px;">Admission Form</h3></center>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="wd-100 clear">
                                <div class="wd-100 left">
                                    <div class="wd-100 clear">
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">GR. NO:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['grno'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Roll No:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['roll_no'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wd-100 clear">
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Date of Birth:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo date("d-m-Y",strtotime($student['dob']));?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Date of Admission:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo date("d-m-Y",strtotime($student['date_of_admission']));?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wd-100 clear">
                                        <br>
                                        <hr>
                                        <br>
                                    </div>
                                    <div class="wd-100 clear">
                                        <div class="wd-70 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-30 left"><h3 class="text-left">Student Name:</h3></div>
                                                <div class="wd-70 left">
                                                    <h4><?php echo $student['student_name'];?></h4>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="wd-100 clear">
                                                <div class="wd-30 left"><h3 class="text-left">Surname:</h3></div>
                                                <div class="wd-70 left">
                                                    <h4><?php echo $student['surname'];?></h4>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="wd-100 clear">
                                                <div class="wd-30 left"><h3 class="text-left">Mark of identification:</h3></div>
                                                <div class="wd-70 left">
                                                    <h4><?php echo $student['mark_identification'];?></h4>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="wd-100 clear">
                                                <div class="wd-30 left"><h3 class="text-left">Gender:</h3></div>
                                                <div class="wd-70 left">
                                                    <h4><?php echo $student['gender'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wd-30 left">
                                            <div class="wd-100 clear text-right">
                                                <img src="<?php echo base_url().$student['img'];?>" style="max-width:120px !important;height:auto;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wd-100 clear">
                                        <div class="wd-100 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Nationality:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['national'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <br>
                                    <div class="wd-100 clear">
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Religion:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['religion'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Mother Tongue:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['mother_tongue'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wd-100 clear">
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Student Blood:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['student_blood'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Student CNIC:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['student_cnic'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wd-100 clear">
                                        <div class="wd-20 left"><h3 class="text-left">Date of Birth (Words):</h3></div>
                                        <div class="wd-80 left">
                                            <h4><?php echo $student['dob_words'];?></h4>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wd-100 clear">
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Student Contact:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['student_contact'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Last School:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['previous_school'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wd-100 clear">
                                        <div class="wd-50 left"><h3 class="text-left">Place of Birth:</h3></div>
                                        <div class="wd-50 left">
                                            <h4><?php echo $student['pob'];?></h4>
                                        </div>
                                    </div>
                                    <div class="wd-100 clear">
                                        <br>
                                        <hr>
                                        <br>
                                    </div>
                                    <div class="wd-100 clear">
                                        <div class="wd-20 left"><h3 class="text-left">Father Name:</h3></div>
                                        <div class="wd-80 left">
                                            <h4><?php echo $student['father_name'];?></h4>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wd-100 clear">
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Father CNIC:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['father_cnic'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Father Contact:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['father_contact'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wd-100 clear">
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Father Occupation:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['father_occupation'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Family Income:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['income_family'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wd-100 clear">
                                        <br>
                                        <hr>
                                        <br>
                                    </div>
                                    <div class="wd-100 clear">
                                        <div class="wd-20 left"><h3 class="text-left">Guardian Name:</h3></div>
                                        <div class="wd-80 left">
                                            <h4><?php echo $student['guardian_name'];?></h4>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wd-100 clear">
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Guardian CNIC:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['guardian_cnic'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Relation:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['relation_with_guardian'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wd-100 clear">
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Guardian Occupation:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['guardian_occupation'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Guardian Contact:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['guardian_contact'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wd-100 clear">
                                        <br>
                                        <hr>
                                        <br>
                                    </div>
                                    <div class="wd-100 clear">
                                        <div class="wd-20 left"><h3 class="text-left">Permanent Address:</h3></div>
                                        <div class="wd-80 left">
                                            <h4><?php echo $student['perment_address'];?></h4>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wd-100 clear">
                                        <div class="wd-20 left"><h3 class="text-left">Postal Address:</h3></div>
                                        <div class="wd-80 left">
                                            <h4><?php echo $student['postal_address'];?></h4>
                                        </div>
                                    </div>
                                    <div class="wd-100 clear">
                                        <br>
                                        <hr>
                                        <br>
                                    </div>
                                    <div class="wd-100 clear">
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Monthly Fee:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['monthly_fee'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Admision Fee:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['admission'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="wd-100 clear">
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Discount Type:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['disc_type'];?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wd-50 left">
                                            <div class="wd-100 clear">
                                                <div class="wd-50 left"><h3 class="text-left">Discount Value:</h3></div>
                                                <div class="wd-50 left">
                                                    <h4><?php echo $student['disc_value'];?></h4>
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
    </body>
    <script>
        window.print();
    </script>
</html>
