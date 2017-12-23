<html>
    <head>
        <title><?php echo $b_header['title']; ?></title>
        <style>
            @media print
            {
                * {-webkit-print-color-adjust:exact;}
                .page_break {page-break-after: always;}
                @page {margin:0in 0.10in 0in 0.10in; }
                .super_container
                {
                    page-break-after: always;
                    margin-top:0.25in;
                    margin-right:55px !important;
                    position:relative;
                    width:100%;
                    height:730px;
                }
                .super_wrapper
                {
                    margin-left:100px;
                }
            }
            body{padding:0 10px 0 55px;}
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
            .wd-75{width:75%;}
            .wd-85{width:85%;}
            .wd-95{width:95%;}
            .wd-100{width:100%;}
            .wrapper{
                //width:calc(100vw - 20px);
                height:730px;
                //margin:10px;
                border:4px dotted #18a05e;
                outline: 7px double #18a05e;
                outline-offset: 5px;
                box-sizing: border-box;
                padding:5px;
            }
            .super_container
            {
                margin-top:60px;
                margin-right:35px !important;
                position:relative;
                width:100%;
                height:730px;
            }
            .super_wrapper
            {
                position:absolute;
                top:0;
                left:0;
                width:100%;
                height:730px;
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
                opacity:0.3;
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
                width: calc(30% - 5px);
                margin:5px;
                box-sizing: border-box;
            }
            .wrapper.left1{
                width: calc(68% - 5px);
                margin:5px;
                box-sizing: border-box;
            }
            h1,h2,h3,h4{
                color:#18a05e;
                font-family:calibri;
                text-align:center;
            }
            .boxed{background:#18a05e;color:#fff;width:80%;margin:0 auto;}
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
                margin: 10px auto;  
            }
            .text-center{text-align:left;}
            .center{text-align:center;}
            .bold{font-weight:bold;}
            .b-u-l{
                border-bottom: 1px solid #000;
                height:inherit;
            }
            .x-small{
                font-size: 12px;
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
    $id=$student['std_id'];
    //====getting class admitted class name====
    $this->db->select('class_name');
    $this->db->where('class_id',$student['class_admited'])->where('is_delete',0);
    $class_admitted_name=@$this->db->get('class')->result_array()[0]['class_name'];
    //==========================================
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
        'std_id' => $student['std_id'] , 
        'cert_id' => $cer, 
        'date' => $date 
    );
    $this->db->insert('certificate_issued',$fields);
    $insert_id=$this->db->insert_id();                                         
    $leave=$this->db->query("SELECT * FROM `leave_info` where std_id=$id")->result_array();
    $remain_days=0;
    $total_days=0;
    foreach ($leave as $value){                   
        $conduct=empty($value['conduct'])?"&nbsp;":$value['conduct'];
        $progress=empty($value['progress'])?"&nbsp;":$value['progress'];
        $dol=empty($value['dol'])?"&nbsp;":$value['dol'];
        $rol=empty($value['rol'])?"&nbsp;":$value['rol'];
        $remarks=empty($value['remarks'])?"&nbsp;":$value['remarks'];
        $remain_days=$value['remain_days'];
        $total_days=$value['total_days'];                       
        $date = date("m/d/Y");
	}
?>
        <div class="super_container">
            <div class="page_break clear">
                <div class="watermark_wrapper">
                    <div class="watermark" style="background-image:url('<?php echo base_url().$b_header['logo1'];?>');"></div>
                </div>
                <div class="super_wrapper">
                    <div class="wrapper left2 left">
                        <div class="header">
                            <div class="right wd-100">
                                <h3><?php echo $b_header['title']; ?></h3>
                                <h4><?php echo $b_header['tagline']; ?></h4>
                                <h4 class="boxed">SCHOOL LEAVING CERTIFICATE</h4>
                            </div>
                        </div>
                        <div class="body">
                       	    <div>
		                  <div style="text-align:center;color:red;"><strong><u><i><?php if($duplicate==true) echo "DUPLICATE"; ?></i></u></strong></div>
		            </div>
                            <div class="row clear">
                                <div class="left">
                                    <p class="x-small"><strong>Serial # </strong> <span class="b-u-l"><?php echo $insert_id; ?></span></p>
                                </div>
                                <div class="right">
                                    <p class="x-small"><strong>GR. No. </strong> <span class="b-u-l"><b><b><?php echo $student['grno']; ?></b></b></span></p>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-30">
                                    <p class="x-small">Name of Pupil </p>
                                </div>
                                <div class="right wd-70 text-center">
                                    <b class="x-small"><?php echo $student['student_name']; ?></b>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-30">
                                    <p class="x-small">Father's Name </p>
                                </div>
                                <div class="right wd-70 text-center">
                                    <b class="x-small"><?php echo $student['father_name']; ?></b>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-50">
                                    <div class="left wd-30">
                                        <p class="x-small">Race </p>
                                    </div>
                                    <div class="right wd-70 text-center">
                                        <b class="x-small"><?php echo $student['surname']; ?></b>
                                    </div>
                                </div>
                                <div class="left wd-50">
                                    <div class="left wd-40">
                                        <p class="x-small">Religion </p>
                                    </div>
                                    <div class="right wd-60 text-center">
                                        <b class="x-small"><?php echo $student['religion']; ?></b>
                                    </div>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-40">
                                    <div class="left wd-50">
                                        <p class="x-small">Date of Birth </p>
                                    </div>
                                    <div class="right wd-50 text-center">
                                        <b class="x-small"><?php echo date("d-m-Y",strtotime($student['dob'])); ?></b>
                                    </div>
                                </div>
                                <!-- <div class="left wd-60">
                                    <div class="left wd-30">
                                        <p class="x-small"> (In Words) </p>
                                    </div>
                                    <div class="right wd-70 text-center">
                                        <b class="x-small"><?php echo @$student['dob_words']; ?></b>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row clear">
                                <div class="left wd-30">
                                    <p class="x-small">Place of Birth </p>
                                </div>
                                <div class="right wd-70 text-center">
                                    <b class="x-small"><?php echo @$student['city_name']; ?></b>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-50">
                                    <div class="left wd-50">
                                        <p class="x-small">Class in which Admitted </p>
                                    </div>
                                    <div class="right wd-50 text-center">
                                        <b class="x-small"><?php echo @$class_admitted_name; ?></b>
                                    </div>
                                </div>
                                <div class="left wd-50">
                                    <div class="left wd-50">
                                        <p class="x-small"> Date of Admission </p>
                                    </div>
                                    <div class="right wd-50 text-center">
                                        <b class="x-small"><?php echo @date("d-m-Y",strtotime($student['date_of_admission'])); ?></b>
                                    </div>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-20">
                                    <p class="x-small">Last School Attended: </p>
                                </div>
                                <div class="right wd-80 text-center">
                                    <b class="x-small"><?php echo @$student['previous_school']; ?></b>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-50">
                                    <div class="left wd-80">
                                        <p class="x-small"><?php if($passed=="true") echo "Class Passed";else echo "Class in which Studying"; ?></p>
                                    </div>
                                    <div class="right wd-20 text-center">
                                        <b class="x-small"><?php echo @$student['class_name']; ?></b>
                                    </div>
                                </div>
                            <!--  <div class="left wd-50">
                                    <div class="left wd-30">
                                        <p class="x-small"> In Words </p>
                                    </div>
                                    <div class="right wd-70 text-center">
                                        <b class="x-small"><?php echo $student_class_c_f['c_name']; ?></b>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row clear">
                                <div class="left wd-50">
                                    <div class="left wd-30">
                                        <p class="x-small">Conduct </p>
                                    </div>
                                    <div class="right wd-70 text-center">
                                        <b class="x-small"><?php echo @$conduct; ?></b>
                                    </div>
                                </div>
                                <div class="left wd-50">
                                    <div class="left wd-40">
                                        <p class="x-small"> Progress </p>
                                    </div>
                                    <div class="right wd-60 text-center">
                                        <b class="x-small"><?php echo @$progress; ?></b>
                                    </div>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-50">
                                    <div class="left wd-50">
                                        <p class="x-small">Date of Leaving School </p>
                                    </div>
                                    <div class="right wd-50 text-center">
                                        <b class="x-small"><?php echo @date("d-m-Y",strtotime($dol)); ?></b>
                                    </div>
                                </div>
                                <!-- <div class="left wd-50">
                                    <div class="left wd-40">
                                        <p class="x-small"> Attendance % </p>
                                    </div>
                                    <div class="right wd-60 text-center">
                                        <b class="x-small"><?php echo $student_attendence; ?></b>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row clear">
                                <div class="left wd-40">
                                    <p class="x-small">Reason of Leaving School: </p>
                                </div>
                                <div class="right wd-60 text-center">
                                    <b class="x-small"><?php echo @$rol; ?></b>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-20">
                                    <p class="x-small">Remarks: </p>
                                </div>
                                <div class="right wd-80 text-center">
                                    <b class="x-small"><?php echo @$remarks; ?></b>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-20">
                                    <p class="x-small"></p>
                                </div>
                                <div class="right wd-80 text-center">
                                    <b class="x-small"></b>
                                </div>
                            </div>
                            <div class="row bold x-small">
                                > Certify that he/she attended the class for <?php echo @$remain_days; ?> days out of  <?php echo @$total_days; ?> in the <?php echo $student['class_name']; ?> class.
                            </div>
                            <div class="row bold x-small">
                                > Certified that above information is in accordance with the school General Register.
                            </div>
                            <div class="row bold x-small">
                                Dated: <?php echo $date; ?>
                            </div>
                            <div class="row">
                                <div class="left wd-30">
                                    <div class="row bold text-center">&nbsp;</div>
                                    <div class="row bold center x-small">
                                        Signature of Class Teacher
                                    </div>
                                </div>
                                <div class="left wd-40">
                                    <div class="row center bold x-small">
                                        Incharge
                                    </div>
                                    <div class="row center bold x-small">
                                    General Register
                                    </div>
                                </div>
                                <div class="left wd-30">
                                    <div class="row center bold x-small">
                                    Principal
                                    </div>
                                    <div class="row center bold x-small">
                                        <?php echo $b_header['title']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper left1 left">
                        <div class="header">
                            <div class="left wd-10 text-center">
                                <img src="<?php echo base_url().$b_header['logo1'];?>" style="width:100px;height:100px;">
                            </div>
                            <div class="right wd-90">
                                <h1><?php echo $b_header['title']; ?></h1>
                                <h3><?php echo $b_header['tagline']; ?></h3>
                                <h2 class="boxed">SCHOOL LEAVING CERTIFICATE</h2>
                            </div>
                        </div>
                        <div class="body">
                            <div>
		                  <div style="text-align:center;color:red;"><strong><u><i><?php if($duplicate==true) echo "DUPLICATE"; ?></i></u></strong></div>
		            </div>
                            <div class="row clear">
                                <div class="left">
                                    <p><strong>Serial #: </strong> <span class="b-u-l"><?php echo $insert_id; ?></span></p>
                                </div>
                                <div class="right">
                                    <p><strong>GR. No. </strong> <span class="b-u-l"><b><?php echo $student['grno']; ?></b></span></p>
                                </div>
                            </div>
                            <div class="row clear">
                            	<div class="left wd-50">
	                                <div class="left wd-40">
	                                    <p>Name of Pupil: </p>
	                                </div>
	                                <div class="right wd-60 b-u-l text-center">
	                                    <b><?php echo $student['student_name']; ?></b>
	                                </div>
                                </div>
                                <div class="left wd-50">
	                                <div class="left wd-30">
	                                    <p>Father's Name: </p>
	                                </div>
	                                <div class="right wd-70 b-u-l text-center">
	                                    <b><?php echo @$student['father_name']; ?></b>
	                                </div>
                                </div>
                            </div>
                            <div class="row clear">
                            	<div class="left wd-50">
	                                <div class="left wd-40">
	                                    <p>Race: </p>
	                                </div>
	                                <div class="right wd-60 b-u-l text-center">
	                                    <b><?php echo $student['surname']; ?></b>
	                                </div>
                                </div>
                                <div class="left wd-50">
	                                <div class="left wd-30">
	                                    <p>Religion: </p>
	                                </div>
	                                <div class="right wd-70 b-u-l text-center">
	                                    <b><?php echo @$student['religion']; ?></b>
	                                </div>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-50">
                                    <div class="left wd-35">
                                        <p>Date of Birth (Figures) </p>
                                    </div>
                                    <div class="right wd-60 b-u-l text-center">
                                        <b><?php echo @date("d-m-Y",strtotime($student['dob'])); ?></b>
                                    </div>
                                </div>
                                <div class="left wd-50">
                                    <div class="left wd-20">
                                        <p> (In Words) </p>
                                    </div>
                                    <div class="right wd-80 b-u-l text-center">
                                        <b><?php echo @$student['dob_words']; ?></b>
                                    </div>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-20">
                                    <p>Place of Birth: </p>
                                </div>
                                <div class="right wd-80 b-u-l text-center">
                                    <b><?php echo @$student['city_name']; ?></b>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-50">
                                    <div class="left wd-40">
                                        <p>Class in which Admitted: </p>
                                    </div>
                                    <div class="right wd-60 b-u-l text-center">
                                        <b><?php echo @$class_admitted_name; ?></b>
                                    </div>
                                </div>
                                <div class="left wd-50">
                                    <div class="left wd-30">
                                        <p> Date of Admission: </p>
                                    </div>
                                    <div class="right wd-70 b-u-l text-center">
                                        <b><?php echo @date("d-m-Y",strtotime($student['date_of_admission'])); ?></b>
                                    </div>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-20">
                                    <p>Last School Attended: </p>
                                </div>
                                <div class="right wd-80 b-u-l text-center">
                                    <b><?php echo @$student['previous_school']; ?></b>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-100">
                                    <div class="left wd-20">
                                        <p><?php if($passed=="true") echo "Class Passed";else echo "Class in which Studying"; ?></p>
                                    </div>
                                    <div class="right wd-80 b-u-l text-center">
                                        <b><?php echo $student['class_name']; ?></b>
                                    </div>
                                </div>
                                <!--<div class="left wd-50">
                                    <div class="left wd-30">
                                        <p> In Words: </p>
                                    </div>
                                    <div class="right wd-70 b-u-l text-center">
                                        <b><?php echo $student_class_c_f['c_name']; ?></b>
                                    </div>
                                </div>-->
                            </div>
                            <div class="row clear">
                                <div class="left wd-50">
                                    <div class="left wd-40">
                                        <p>Conduct: </p>
                                    </div>
                                    <div class="right wd-60 b-u-l text-center">
                                        <b><?php echo @$conduct; ?></b>
                                    </div>
                                </div>
                                <div class="left wd-50">
                                    <div class="left wd-15">
                                        <p> Progress: </p>
                                    </div>
                                    <div class="right wd-85 b-u-l text-center">
                                        <b><?php echo @$progress; ?></b>
                                    </div>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-100">
                                    <div class="left wd-20">
                                        <p>Date of Leaving School: </p>
                                    </div>
                                    <div class="right wd-80 b-u-l text-center">
                                        <b><?php echo @date("d-m-Y",strtotime($dol)); ?></b>
                                    </div>
                                </div>
                                <!-- <div class="left wd-50">
                                    <div class="left wd-30">
                                        <p> Attendance % </p>
                                    </div>
                                    <div class="right wd-70 b-u-l text-center">
                                        <b><?php echo $student_attendence; ?></b>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row clear">
                                <div class="left wd-20">
                                    <p>Reason of Leaving School: </p>
                                </div>
                                <div class="right wd-80 b-u-l text-center">
                                    <b><?php echo @$rol; ?></b>
                                </div>
                            </div>
                            <div class="row clear">
                                <div class="left wd-20">
                                    <p>Remarks: </p>
                                </div>
                                <div class="right wd-80 b-u-l text-center">
                                    <b><?php echo @$remarks; ?></b>
                                </div>
                            </div>
                            <div class="row bold">
                                > Certify that he/she attended the class for <?php echo @$remain_days; ?> days out of  <?php echo @$total_days; ?> in the <?php echo $student['class_name']; ?> class.
                            </div>
                            <div class="row bold">
                                > Certified that above information is in accordance with the school General Register.
                            </div>
                            <div class="row bold">
                                Dated: <?php echo $date; ?>
                            </div>
                            <div class="row">
                                <div class="left wd-30">
                                    <div class="row bold text-center">&nbsp;</div>
                                    <div class="row bold center">
                                    <br> Signature of Class Teacher
                                    </div>
                                </div>
                                <div class="left wd-40">
                                    <div class="row center bold">
                                    <br> Incharge
                                    </div>
                                    <div class="row center bold">
                                        General Register
                                    </div>
                                </div>
                                <div class="left wd-30">
                                    <div class="row center bold">
                                    <br> Principal
                                    </div>
                                    <div class="row center bold">
                                        <small><?php echo $b_header['title']; ?></small>
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
        window.print();
    </script>
</html>