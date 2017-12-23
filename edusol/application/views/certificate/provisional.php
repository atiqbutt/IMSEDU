<html>
    <head>
        <title><?php echo $b_header['title']; ?></title>
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
            background:url('<?php echo base_url().$b_header['logo1'];?>');
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
                margin-right: 5px;
            }
            .wrapper.left1{
                width: calc(69vw - 5px);
                margin-left: 5px;
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
        </style>
    </head>
    <body class="clear">
<?php
foreach($studentcer as $student)
 {
    $cer=$_REQUEST['cer'];
    //checking if certificate exist
    $this->db->select("*");
    $this->db->where('std_id',$student['id'])->where('cert_id',$cer)->where('is_delete',0);
    $issued=@$this->db->get('certificate_issued')->result_array();
    if(empty($issued)) {
        $duplicate=false;
    }
    else{
        $duplicate=true;
    }
    //================================
    $date = date("m/d/Y");
                        $fields= array(
                                   'std_id' => $student['id'] , 
                                   'cert_id' => $cer, 
                                   'date' => $date, 

                                  );
        $this->db->insert('certificate_issued',$fields);
        $insert_id=$this->db->insert_id();                                         
    
$date = date("m/d/Y");
                            
                                 $id=$student['id'];
                             $pro=$this->db->query("SELECT * FROM `pro_info` where std_id=$id")->result_array();                
                              foreach ($pro as $value){
                                
                                 $examination=empty($value['examination'])?"&nbsp;":$value['examination'];
                                 $seat_no=empty($value['seat_no'])?"&nbsp;":$value['seat_no'];
                                 $grade=empty($value['grade'])?"&nbsp;":$value['grade'];
                                 $marks=empty($value['marks'])?"&nbsp;":$value['marks'];
                              }
                              ?>
   
 <div class="super_container">
    <div class="page_break clear">
     <div class="watermark_wrapper">
        <div class="watermark"></div>
        </div>
        <div class="super_wrapper">
        <div class="wrapper left2 left">
            <div class="header">
                 <div class="wd-100">
                    <h1><?php echo $b_header['title']; ?></h1>
                    <h3><i><?php echo $b_header['tagline']; ?></i></h3>
                    <div class="row text-center wd-100">
                        <img src="<?php echo base_url().$b_header['logo1'];?>" style="width:100px;height:100px;">
                    </div>
                    <h3 class="boxed">PROVISIONAL CERTIFICATE</h3>
                </div>
            </div>
            <div class="body">
                <div>
                    <div style="text-align:center;color:red;"><u><i><?php if($duplicate==true) echo "DUPLICATE"; ?></i></u></div>
                </div>
                <div class="row clear">
                    <div class="left">
                        <p class="x-small"><strong>Serial # </strong> <?php echo $insert_id; ?></p>
                    </div>
                    <div class="right">
                        <p class="x-small"><strong>GR. No. </strong><b> <?php echo $student['grno']; ?></b></p>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-50 x-small">
                        <p>This is certify that Mr. / Miss: </p>
                    </div>
                    <div class="right wd-50 x-small">
                        <b><?php echo $student['student_name']; ?></b>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-50">
                        <div class="left wd-30 x-small">
                            <p>S/O D/O: </p>
                        </div>
                        <div class="right wd-70 x-small">
                            <b><?php echo $student['father_name']; ?></b>
                        </div>
                    </div>
                    <div class="right wd-50">
                        <div class="left wd-40 x-small">
                            <p> By Religion: </p>
                        </div>
                        <div class="right wd-60 x-small">
                            <b><?php echo $student['religion']; ?></b>
                        </div>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-10 x-small">
                        <p>R/O </p>
                    </div>
                    <div class="right wd-90 x-small">
                        <b> <?php echo @$student['perment_address']; ?> </b>
                    </div>
                </div>
                <div class="row x-small">
                    Has been a bonafide student of this school.
                </div>
                <div class="row clear x-small">
                    He/She has passed SSCII (Class X) Annual / Supply / Compart
                </div>
                <div class="row clear">
                    <div class="left wd-30 x-small">
                        examination
                    </div>
                    <div class="left wd-20 x-small">
                        <?php echo @$examination; ?>
                    </div>
                    <div class="left wd-50 x-small">
                        held by B.I.S.E Sukkur in Science / 
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-60 x-small">
                        Humanities group under Seat Number
                    </div>
                    <div class="left wd-10 x-small">
                        <?php echo @$seat_no; ?>
                    </div>
                    <div class="left wd-10 x-small">
                         grade 
                    </div>
                    <div class="left wd-10 x-small">
                         <?php echo @$grade; ?>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-20 x-small">
                        <p>Securing </p>
                    </div>
                    <div class="left wd-20 text-center x-small">
                        <b><?php echo @$marks; ?></b>
                    </div>
                    <div class="left wd-30 x-small">
                        <b>&nbsp;&nbsp;&nbsp;&nbsp;marks</b>
                    </div>
                </div>
                <div class="row clear x-small">
                    He/She bears a good moral character to the best of my knowledge and belief.
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">&nbsp;</div>
                <div class="row">&nbsp;</div>

                <div class="row">
                    <div class="right">
                        <div class="row text-center x-small">
                            Principal
                        </div>
                        <div class="row text-center x-small">
                            <?php echo $b_header['title']; ?>
                        </div>
                        <div class="row text-center x-small">
                            <?php echo $b_header['short_address']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        <div class="wrapper left1 left">
            <div class="header clear">
                <div class="right wd-100">
                    <h1 class="title"><?php echo $b_header['title']; ?></h1>
                    <h3><?php echo $b_header['tagline']; ?></h3>
                    <div class="row text-center wd-100">
                        <img src="<?php echo base_url().$b_header['logo1'];?>" style="width:100px;height:100px;">
                    </div>
                    <h1 class="boxed">PROVISIONAL CERTIFICATE</h1>
                </div>
            </div>
            <div class="body">
                <div>
                    <div style="text-align:center;color:red;"><strong><u><i><?php if($duplicate==true) echo "DUPLICATE"; ?></i></u></strong></div>
                </div>
                <div class="row clear">
                    <div class="left">
                        <p><strong>Serial # </strong> <span class="b-u-l"><?php echo $insert_id; ?></span></p>
                    </div>
                    <div class="right">
                        <p><strong>GR. No. </strong> <span class="b-u-l"><b><?php echo $student['grno']; ?></b></span></p>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-25">
                        <p>This is certify that Mr. / Miss: </p>
                    </div>
                    <div class="right wd-75 b-u-l">
                        <b><?php echo $student['student_name']; ?></b>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-50">
                        <div class="left wd-20">
                            <p>S/O D/O: </p>
                        </div>
                        <div class="right wd-80 b-u-l">
                            <b><?php echo @$student['father_name']; ?></b>
                        </div>
                    </div>
                    <div class="right wd-50">
                        <div class="left wd-20">
                            <p> By Religion: </p>
                        </div>
                        <div class="right wd-80 b-u-l">
                            <b><?php echo @$student['religion']; ?></b>
                        </div>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-10">
                        <p>R/O: </p>
                    </div>
                    <div class="right wd-90 b-u-l">
                        <b><?php echo @$student['perment_address']; ?></b>
                    </div>
                </div>
                <div class="row">
                    Has been a bonafide student of this school.
                </div>
                <div class="row clear">
                    He/She has passed SSC Part-II (Class X) Annual / Supplementary / Compart: examination
                </div>
                <div class="row clear">
                    
                    <div class="left b-u-l wd-20">
                        <b><?php echo @$examination; ?></b>
                    </div>
                    <div class="left wd-80">
                        held by B.I.S.E Sukkur in Science / Humanities group 
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-20">
                         Under Seat Number:
                    </div>
                    <div class="left wd-20 b-u-l">
                        <b><?php echo @$seat_no; ?></b>
                    </div>
                    <div class="left wd-10">
                         Grade: 
                    </div>
                    <div class="left wd-20 b-u-l">
                        <b> <?php echo @$grade; ?></b>
                    </div>
                </div>
                <div class="row clear">
                    <div class="left wd-10">
                        <p>Securing: </p>
                    </div>
                    <div class="left wd-30 b-u-l">
                        <b><?php echo @$marks; ?></b>
                    </div>
                    <div class="left wd-30">
                        <b>&nbsp;&nbsp;&nbsp;&nbsp;marks</b>
                    </div>
                </div>
                <div class="row clear">
                    He/She bears a good moral character to the best of my knowledge and belief.
                </div>
                <div class="row">&nbsp;</div>
           
                <div class="row">
                    <div class="right">
                        <div class="row text-center bold">
                            Principal
                        </div>
                        <div class="row text-center bold">
                            <?php echo $b_header['title']; ?>
                        </div>
                        <div class="row text-center bold">
                            <?php echo $b_header['short_address']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>




    <?php } ?>
    </body>
    <script>
       // window.print();
    </script>
</html>