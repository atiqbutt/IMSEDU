<html>
    <head>
        <title><?php echo $b_header['title']; ?></title>
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
                .page-break-my {
                    page-break-before: always !important;
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
                margin-top:80px;
                margin-left:20px;
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
                border: 1px solid #000;
                background-color:#18a05e; 
                padding: 3px !important;
                color: #fff;
            }
            td{
                border: 1px solid #000;
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
                                    <center><h1><?php  echo $b_header['title']; ?></h1></center>
                                    <center><i><h3 style="color:#000 !important;"><?php echo $exam; ?> Consolidate Sheet For session <?php echo $session; ?></h3></i></center>
                                    <center><h3 class="boxed" style="margin-top:0px !important;font-size:23px;">Result Sheet - <?php echo $b_header['name']; ?></h3></center>
                                </div>
                            </div>
                         
                        </div>
                        <div class="body">
                            <div class="wd-100 clear">
                                <div class=" text-left left ">
                                    <b>Class: <small><?php echo $class; ?></small></b>
                                </div>
                                    
                                <div class=" text-right right ">
                                    <b>Section: <small><?php echo $section; ?></small></b>
                                </div>
                            </div>
                            <table class="tbl1">
                                <tr>
									  <th class="th" rowspan="3">#</th>
									  <th class="th" rowspan="3">GR No</th>
									  <th class="th" rowspan="3">DOB</th>
									  <th class="th" rowspan="3">Attend</th>
									  <th class="th" rowspan="3">Name</th>
									  <th class="th" rowspan="1"><?php echo "Father's Name"; ?></th>
                                        <?php if(!empty($student[0])){
                                            $subjects = $this->report_model->getSubjectNames($student[0]->result_id);
                                            if(!empty($subjects))
                                            {
                                                foreach ($subjects as $key => $value) {
                                                    echo "<th>".$value->name."</th>";
                                                }
                                            }
                                        } ?>
									  <th class="th" rowspan="1">TM</th>
									  <th class="th" rowspan="2">%</th>
									  <th class="th" rowspan="3">Status</th>
									  <th class="th" rowspan="3">Ranks</th>
									
                                </tr>
                                <tr>
                                    <th>Maximum</th>
                                    <?php $total_subjects = 0; if(!empty($student[0])){
                                        $subjects = $this->report_model->getSubjectNames($student[0]->result_id);
                                        if(!empty($subjects))
                                        {
                                            foreach ($subjects as $key => $value) {
                                                echo "<th>".$value->total_marks."</th>";
                                                $total_subjects += $value->total_marks;
                                            }
                                        }
                                    } ?>
                                    <th><?php echo $total_subjects; ?></th>
                                </tr>
                                <tr>
                                    <th>Minimum</th>
                                    <?php $passing_subjects = 0; if(!empty($student[0])){
                                        $subjects = $this->report_model->getSubjectNames($student[0]->result_id);
                                        if(!empty($subjects))
                                        {
                                            foreach ($subjects as $key => $value) {
                                                echo "<th>".$value->passing_marks."</th>";
                                                $passing_subjects += $value->passing_marks;
                                            }
                                        }
                                    } ?>
                                    <th><?php echo $passing_subjects; ?></th>
                                    <th><?php
                                    	if($passing_subjects == 0){echo "";}else{
                                     echo round( ($passing_subjects / $total_subjects) * 100 );} ?></th>
                                </tr>
										<?php $absents=0;$total_students=0;$pass_students=0;$fail_students=0; $i=1;$break=1; $results=[]; foreach ($student as $key => $value) { ++$total_students;?>
                                        <?php  if($i>=16 && ($i/16)==$break) {$break+=1;echo $this->report_model->getHeader($exam,$session);echo "<span class='page-break-my' ></span>"; } ?>
										<tr style="background-color:<?php if($value->position=="1st"){echo "#85f385";}else if($value->position=="2nd"){echo "#e4e47a";}else if($value->position=="3rd"){echo "#90d2e0";}?>">
											<td class="td"><?php echo $i++;?></td>
											<td class="td"><?php echo $value->grno;?></td>
											<td class="td"><?php echo date("d-M-Y",strtotime($value->dob));?></td> 
											<td class="td"><?php echo $value->attendance;?></td> 
											<td class="td"><?php echo $value->student_name;?></td> 
											<td class="td"><?php echo $value->father_name;?></td>
                                            <?php $obtained_subjects = 0; if(!empty($value)){
                                                $marks = $this->report_model->getSubjectMarks($value->result_id);
                                                //var_dump("<pre>",$marks);
                                                if(!empty($marks))
                                                {
                                                    foreach ($marks as $k => $v) {
                                                        if($k<count($subjects))
                                                        {
                                                            //echo $v->obtained_marks;
                                                            echo "<td>".$v->obtained_marks."</td>";
                                                            $obtained_subjects += $v->obtained_marks;
                                                            if($v->obtained_marks=="A")
                                                                $absents++;
                                                        }
                                                    }
                                                }
                                            } ?>
											<td class="td"><?php echo $obtained_subjects;?></td>
											<td class="td"><?php echo $subjects_percentage = round( ($obtained_subjects / $total_subjects) * 100, 0); ?></td>
											<td class="td" <?php if($obtained_subjects<$passing_subjects){echo 'style="background: #de0000;color: #fff;"';} ?>><?php if($obtained_subjects>=$passing_subjects){++$pass_students;echo "Pass";}else{++$fail_students;echo "Fail";} ?></td>
											<td class="td"><?php echo $value->position;?></td>
										</tr>
										  <?php
										  } 
										  ?>
                            </table>
                            <div class="wd-100 clear">
                                <div class="wd-25 left text-center">
                                    <div class="row text-center bold">
                                        Total Students: <?php echo $total_students; ?>
                                    </div>
                                </div>
                                <div class="wd-25 left text-center">
                                    <div class="row text-center bold">
                                        Pass Students: <?php echo $pass_students; ?>
                                    </div>
                                </div>
                                <div class="wd-25 left text-center">
                                    <div class="row text-center bold">
                                        Fail Students:  <?php echo $fail_students; ?>
                                    </div>
                                </div>
                                <div class="wd-25 right text-center">
                                    <div class="row text-center bold">
                                        Passing:  <?php echo @round( ($pass_students/$total_students) * 100,0); ?>%
                                    </div>
                                </div>
                            </div>
                            <div class="wd-100 clear">
                                <div class="wd-25 left text-center">
                                    <div class="wd-100 row text-center bold">&nbsp;</div>
                                </div>
                                <div class="wd-50 left text-center">
                                    <div class="row text-center bold">
                                        Absents: <?php echo $absents; ?>
                                    </div>
                                </div>
                                <div class="wd-25 right text-center">
                                    <div class="wd-100 row text-center bold">&nbsp;</div>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="wd-100 clear">
                                <div class="wd-30 left text-center">
                                    <div class="row text-center bold">
                                        Class Teacher
                                    </div>
                                    <div class="wd-50 margin-a b-u-l"></div>
                                </div>
                                <div class="wd-30 left text-center">
                                    <div class="row text-center bold">
                                    </div>
                                </div>
                                <div class="wd-40 right text-center">
                                    <div class="row text-center bold">
                                        Principal
                                    </div>
                                    <div class="wd-50 margin-a b-u-l"></div>
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