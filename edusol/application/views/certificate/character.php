<html>
    <head>
        <title><?php echo $b_header['title']; ?></title>
         <style>
            @media print
            {
                .super_container {page-break-after: always; padding-top:10px;}
                * {-webkit-print-color-adjust:exact;}
                @page { margin: 0.26in 0.18in 0in 0.25in;}
            }

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
            .wd-5{width:5%;}
            .wd-15{width:15%;}
            .wd-25{width:25%;}
            .wd-35{width:35%;}
            .wd-45{width:45%;}
            .wd-55{width:55%;}
            .wd-65{width:65%;}
            .wd-66{width:65%;}
            .wd-67{width:66%;}
            .wd-68{width:67%;}
            .wd-69{width:68%;}
            .wd-75{width:75%;}
            .wd-85{width:85%;}
            .wd-95{width:95%;}
            .wd-100{width:100%;}
.super_container
{

position:relative;
width:calc(100vw - 20px);
                height:520px;
}
            .wrapper{
                width:calc(99vw - 20px);
                height:520px;
                margin:10px;
                border:4px dotted #18a05e;
                outline: 7px double #18a05e;
                outline-offset: 5px;
                box-sizing: border-box;
                padding:5px;
                z-index:120;
                position:absolute;
                top:0;
                left:0;
            }
            .watermark
            {
            height:200px;
             width:300px;
             //align:center;
             margin:auto;
             padding-top:10px;
             opacity:0.1;
            background:url('<?php echo base_url().$b_header['logo1'];?>');
            background-size:100% 100%;
            }
            .watermark_wrapper
            {
             height:520px;
             width:100%;
             margin-top:70px;
             display:inline-flex;
             display:-webkit-inline-flex;

             }
            h1,h2,h3{
                color:#18a05e;
                font-family:calibri;
                text-align:center;
            }
            h3{font-weight: 100;}
            h1.cert{background:#18a05e;color:#fff;width:80%;margin:0 auto;}
            .header{
                width:100%;
                height:110px;
                border-bottom:4px double #18a05e;
            }
            .body{
                padding:10px;
            }
            .row{
                width:100%;
                text-align:justify;
                margin: 10px auto;  
            }
            .text-center{text-align:left;}
            .bold{font-weight:bold;}
            .bolder{font-weight:1200;}
            .b-u-l{
                border-bottom: 1px solid #000;
            }
            .hg-20{height:20px;}
            .hg-inht{height:inherit;}
        </style>
    </head>
    <body>
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
                                            					
                              ?>
             <div class="super_container">
        <div class="watermark_wrapper">
        <div class="watermark"></div>
        </div>
        <div class="wrapper">
            <div class="header">
                <div class="left wd-10 text-center">
                    <img src="<?php echo base_url().$b_header['logo1'];?>" style="width:100px;height:100px;">
                </div>
                <div class="right wd-90">
                    <h1><?php echo $b_header['title']; ?></h1>
                    <h2><i><?php echo $b_header['tagline']; ?></i></h2>
                    <h1 class="cert">CHARACTER CERTIFICATE</h1>
                </div>
            </div>
            <div class="body">
                <div>
                        <div style="text-align:center;color:red;"><strong><u><i><?php if($duplicate==true) echo "DUPLICATE"; ?></i></u></strong></div>
                </div>
                <div class="row clear">
                    <div class="left">
                        <p><strong>SR. No. </strong> <?php echo $insert_id; ?></p>
                    </div>
                    <div class="right">
                        <p><strong>GR. No. </strong><b> <?php echo $student['grno']; ?></b></p>
                    </div>
                </div>
                <div class="row clear hg-20">
                    <div class="left wd-35=0">
                        <p class="bold">This is to certify that Mr. / Miss: </p>
                    </div>
                    <div class="right wd-68 b-u-l text-center hg-inht">
                        <b class="bolder"><?php echo $student['student_name']; ?></b>
                    </div>
                </div>
                <div class="row clear">
                    <div class="wd-50 left hg-20">
                        <div class="left wd-20">
                            <p class="bold">S/O D/O: </p>
                        </div>
                        <div class="right wd-80 b-u-l text-center hg-inht">
                            <b class="bolder"><?php echo $student['father_name']; ?>&nbsp;</b>
                        </div>
                    </div>
                    <div class="wd-50 left hg-20">
                        <div class="left wd-30">
                            <p class="bold">by religion: </p>
                        </div>
                        <div class="right wd-70 b-u-l text-center hg-inht">
                            <b class="bolder"><?php echo $student['religion']; ?></b>
                        </div>
                    </div>
                </div>
                <div class="row clear hg-20">
                    <div class="left wd-10">
                        <p class="bold">R/O: </p>
                    </div>
                    <div class="right wd-90 b-u-l text-center hg-inht">
                        <b class="bolder"><?php echo $student['perment_address']; ?></b>
                    </div>
                </div>
                <div class="row clear hg-20">
                    <div class="left wd-10">
                        <p class="bold">Taluka: </p>
                    </div>
                    <div class="right wd-90 b-u-l text-center hg-inht">
                        <b class="bolder"><?php echo $student['city_name']; ?></b>
                    </div>
                </div>
                <div class="row bold">
                    Sindh province is known to me personally.
                </div>
                <div class="row bold">
                    He/She bears a good moral character,
                
                    to the best of my knowledge and belief.
                </div>
                <div class="right">
                 <div class="row">&nbsp;</div>
                 <div class="row b-u-l">&nbsp;</div> <div class="row text-center bold">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Principal
                        </div>
                        <div class="row text-center bold">
                            <?php echo $b_header['title']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php } ?>
        <script>window.print();</script>
    </body>
</html>