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
        <?php 
            date_default_timezone_set("Asia/Karachi");
            foreach($students as $k=>$student_data)
            {
                $result=$this->report_model->ExamsResult($exams,$student_data->id);
                $student=$this->report_model->StudentDetails($student_data->id); 
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
                                    <center><h1><?php echo $b_header['title']; ?></h1></center>
                                    <center><h3 style="color:#000 !important;"><i><?php echo $b_header['tagline']; ?></i></h3></center>
                                    <center><i><h3 style="color:#000 !important;font-weight:normal;"><?php echo $b_header['short_address']; ?></h3></i></center>
                                    <center><i><h4 style="color:#000 !important;font-weight:bold;"><?php echo $b_header['name']; ?></h4></i></center>
                                    <center><h3 class="boxed" style="margin-top:0px !important;font-size:23px;">Report Card - <?php echo $b_header['name']; ?> </h3></center>
                                    
                                </div>
                            </div>
                            <hr>
                            <br>
                            <div class="body">
                                <div class="wd-100 clear">
                                    <div class=" text-left left ">
                                        <b>GR. NO.</b> <small><?php echo $student->grno; ?></small><br>
                                        <b>Student Name:</b> <small><?php echo $student->student_name; ?></small><br>
                                        <b>Father Name:</b> <small><?php echo $student->father_name; ?></small><br>
                                         <b>Class:</b> <small><?php echo $student->class_name."/".$student->section_name; ?></small>
                                    </div>
                                    <div class=" text-right right ">
                                        <?php if($student->img==null){$student->img="images/noimg.jpg";} ?>
                                        <img src="<?php echo base_url().$student->img ?>" width="100px" height="100px" >
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <?php 
                                $grand_obtained = 0 ; 
                                $grand_total = 0 ; 
                            ?>
                            <table class="tbl1">
                                <tr>
                                    <th class="th">#</th>
                                        <?php 
                                            $result_subjects = [];
                                            foreach($result as $index=>$result_data)
                                            {
                                                if(!empty($result_data)){
                                                    $subjects_ids = $this->report_model->getSubjectNames($result_data->id);
                                                    if(!empty($subjects_ids))
                                                    {
                                                        foreach ($subjects_ids as $key => $value) {
                                                            $result_subjects[$index][$value->name] = $value->id;
                                                        }
                                                    }
                                                }
                                            }
                                            foreach ($subjects as $key => $value) {
                                                echo "<th colspan='2'>".$value->name."</th>";
                                            }
                                         ?>
									<th class="th" colspan="3">Term Total</th>
                                </tr>
                                <tr>
                                    <th rowspan="2">Terms</th>
                                    <?php for($i=0;$i<count($subjects);$i++) {
                                        echo "<th>O</th><th>T</th>";
                                    } ?>
                                    <th rowspan="2">O</th>
                                    <th rowspan="2">T</th>
                                    <th rowspan="2">%</th>
                                </tr>
                                <tr>
                                    <?php for($i=0;$i<count($subjects);$i++) {
                                        echo "<th colspan='2'>Date</th>";
                                    } ?>
                                </tr>
										<?php foreach ($result as $key => $value) { 
                                            if($value!=null)    
                                            {
                                                $obtained_subjects = 0; 
                                                $total_subjects = 0;
                                        ?>
										<tr>
											<td class="td" rowspan="2"><?php echo $value->name;?></td>
                                            <?php
                                            foreach($subjects as $index=>$subject_arr){
                                                $found = false;
                                                foreach($result_subjects[$key] as $k=>$v )
                                                {
                                                    if($subject_arr->name == $k)
                                                    {
                                                        $found = $result_subjects[$key][$k];
                                                    }
                                                }
                                                if($found)
                                                {
                                                    $mark = $this->report_model->getSubjectMark($found);
                                                    if($mark->obtained_marks!=""){
                                                        echo "<td>".$mark->obtained_marks."</td>";
                                                        $obtained_subjects += $mark->obtained_marks;
                                                    }else{
                                                        echo "<td>-</td>";
                                                    }
                                                    if($mark->total_marks!=""){
                                                        echo "<td>".$mark->total_marks."</td>";
                                                        $total_subjects += $mark->total_marks;
                                                    }else{
                                                        echo "<td>-</td>";
                                                    }
                                                }else{
                                                    echo "<td>-</td><td>-</td>";
                                                }
                                            } ?>
                                            <td class="td" rowspan="2"><?php echo $obtained_subjects;?></td>
                                            <td class="td" rowspan="2"><?php echo $total_subjects;?></td>
                                            <td class="td" rowspan="2"><?php echo @round( ($obtained_subjects/$total_subjects) * 100,0);?></td>
                                            <?php 
                                                $grand_obtained += $obtained_subjects ; 
                                                $grand_total += $total_subjects ; 
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php 
                                            foreach($subjects as $index=>$subject_arr){
                                                $found = 0;
                                                foreach($result_subjects[$key] as $k=>$v )
                                                {
                                                    if($subject_arr->name == $k)
                                                    {
                                                        $found = $result_subjects[$key][$k];
                                                    }
                                                }
                                                if($found)
                                                {
                                                    $marks = $this->report_model->getSubjectMark($found);
                                                    if($marks->paper_date!="0000-00-00")
                                                        echo "<td colspan='2'>".date("d-m-Y",strtotime($marks->paper_date))."</td>";
                                                    else
                                                        echo "<td colspan='2'>-/-/-</td>";
                                                }else{
                                                    echo "<td colspan='2'>-/-/-</td>";
                                                }
                                            } ?>
										</tr>
										  <?php
										    } 
                                        }
										  ?>
                            </table>
                            <br>
                            <div class="wd-100 clear">
                                
                                    <b>Grand Total:</b> <small><?php echo $grand_total; ?></small>
                                    <b style="margin-left:30%" >Grand Obtained:</b> <small><?php echo $grand_obtained; ?></small>
                                    
                                
                                    <b style="margin-left:28%">Grand Percentage:</b> <small><?php echo @round( ($grand_obtained/$grand_total) * 100,0);?>%</small><br>
                                </div>
<br>
<br>
                             <div class="wd-100 clear">
                                
                                    <b>Class Teacher:</b> <small>____________________</small>
                                    <b style="margin-left:15%" >Examination:</b> <small>__________________</small>
                                    
                                
                                    <b style="margin-left:12%">Principal:</b> <small>__________________</small><br>
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