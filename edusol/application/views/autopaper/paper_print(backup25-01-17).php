<html>
    <head>
        <title><?php echo $b_header['title']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="all">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <style type="text/css">
         

.relative{position:relative;}
.text-bold{font-weight:bold;}
h4,hr{margin:2px;}
.logo{width:100px;height:100px;position:absolute;top:0;left:0;}
.page{box-sizing: border-box;border-radius:10px;height:100%;padding:5px;}
.table tr td{border:2px dotted #17a05e !important;}
@media print{
.logo{width:300px !important;height:100px;}
.page{page-break-after:always;}
}
    </style>
    </head>
    <body id="datatable-buttons">
      <?php


       $mcq_limit=$this->input->post('mcq');
       $class1=$this->input->post('class');
       $subject1=$this->input->post('subject');
       $short_limit=$this->input->post('short');
       $long_limit=$this->input->post('long');
       $chapter=$_REQUEST['chapter'];

         
       $count=count($chapter);
       $level=$this->input->post('level');
       $mcq_marks=$this->input->post('mcq_marks');
       $short_marks=$this->input->post('short_marks');
       $long_marks=$this->input->post('long_marks');
?>
        <div class="page">
        <div class="container-fluid">
          <div class="row header">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                      <div class="col-md-2 col-sm-2 col-xs-2 relative"><img class="logo" src="<?php echo base_url().$b_header['b_logo'];?>"></div>
                      <div class="col-md-8 col-sm-8 col-xs-8 text-center">
                            <h3 class="wd-100"><?php echo $b_header['title']; ?></h3>
                            <h4 class="wd-100"><?php echo $b_header['tagline']; ?></h4>
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-2 relative"><img class="logo" src="<?php echo base_url().$b_header['b_logo'];?>"></div>
                  </div>  
              </div>
          </div>
          <hr style="margin-top:30px;border-top:6px double #17a05e;" />
          <div class="row header">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="row upper-header" style="border-top:2px dashed #17a05e;border-bottom:2px dashed #17a05e;padding:5px;margin:5px;">
                        <!--<table class="table" >
                              <tbody>
                                    <tr>
                                          <td style="width:10%;"><strong>Class:</strong></td>
                                          <td style="width:40%;"><?php echo $classes['class_name']; ?></td>
                                          <td style="width:10%;"><strong>Subject</strong></td>
                                          <td style="width:40%;" colspan="3"><?php echo $subject['name']; ?></td>
                                    </tr>
                                    <tr>
                                          <td><strong>Time Allowed:</strong></td>
                                          <td></td>
                                          <td><strong>Total Marks</strong></td>
                                          <td><?php echo ($mcq_marks*$mcq_limit)+($short_marks*$short_limit)+($long_marks*$long_limit);?></td>
                                          <td><strong>Obtained Marks</strong></td>
                                          <td></td>
                                    </tr>
                              </tbody>
                        </table>-->
                              <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                          <h5 class="text-bold">Class:</h5>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                          <h5><?php echo $classes['class_name']; ?></h5>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                          <h5 class="text-bold">Subject:</h5>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                          <h5><?php echo $subject['name']; ?></h5>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                          <h5 class="text-bold">Time Allowed:</h5>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                          <h5>&nbsp;</h5>
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                          <h5 class="text-bold">Total Marks:</h5>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                          <h5><?php echo ($mcq_marks*$mcq_limit)+($short_marks*$short_limit)+($long_marks*$long_limit);?></h5>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                          <h5 class="text-bold">Obtain Marks:</h5>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                          <h5>&nbsp;</h5>
                                    </div>
                              </div>   
                      </div>
                  </div>  
              </div>
          </div>
<hr/>
          <div class="row header">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="text-bold">Student Name:</h4>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4></h4>
                                  </div>
                            </div>
                            <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="text-bold">Teacher Name:</h4>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4></h4>
                                  </div>
                            </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="text-bold">Roll Number:</h4>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4></h4>
                                  </div>
                            </div>
                            <div class="row">
                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="text-bold">Teacher Sign:</h4>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4></h4>
                                  </div>
                            </div>
                      </div>
                  </div>  
              </div>
          </div>
<hr/>
<?php //var_dump($data); ?>
          <div class="row">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                     <CENTER> <h3>MCQ'S Questions</h3></CENTER>
                  <div class="row" style="line-height:2;">
                              <?php
                              $j=1;
                 for($i=0;$i<$count;$i++)
        {
               $chap=$chapter[$i];
           $query_print = $this->db->query("SELECT * FROM `mcq_questions` INNER JOIN `chapters` ON mcq_questions.chapter=chapters.id INNER JOIN `class` ON class.class_id=mcq_questions.class WHERE mcq_questions.is_delete='0' AND mcq_questions.chapter='$chap' AND mcq_questions.level='$level' ORDER BY RAND() limit $mcq_limit")->result_array();
           foreach ($query_print as $value) {
                            
                            $question=$value['question'];
                            $option1=$value['option1'];
                            $option2=$value['option2'];
                            $option3=$value['option3'];
                            $option4=$value['option4'];
                ?>
                
                        <div class="col-md-11 col-sm-11 col-xs-11"><span class="question">Q1.<?php echo $j++;?>:</span> <b> <?php echo $value['question'] ;?></b></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><b>(<?php echo $data['mcq_marks'] ;?>)</b></div>
                        <div class="clearfix"></div>
                          <div class="col-sm-12">
                              <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6"><b>A.</b> <?php echo  $option1; ?></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6"><b>B.</b> <?php echo $option2; ?></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6"><b>C.</b> <?php echo $option3; ?></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6"><b>D.</b> <?php echo $option4; ?></div>

                                    </div>
                          </div>


                          <?php }} ?>
                  </div>  
              </div>
          </div>

</div></div>
<div class="page">

                        <div class="row">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                      <center><h3>Short Questions</h3></center>
                  <div class="row">
      <?php $k=1;
      for($i=0;$i<$count;$i++)
        {
               $chap=$chapter[$i];
           $query_print = $this->db->query("SELECT * FROM `short_questions` INNER JOIN `chapters` ON short_questions.chapter=chapters.id INNER JOIN `class` ON class.class_id=short_questions.class WHERE short_questions.is_delete='0' AND short_questions.chapter='$chap' AND short_questions.level='$level' ORDER BY RAND() limit $mcq_limit")->result_array();
           foreach ($query_print as $value) {
                            
                            $question=$value['question'];
                ?>
                
                        <div class="col-md-11 col-sm-11 col-xs-11"<br/>Q2.<?php echo $k++; ?>:<b> <?php echo $value['question'];?></b></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><b>(<?php echo $data['short_marks'] ;?>)</b></div>
                        <div class="clearfix"></div>
                          <?php }} ?>
                  </div>  
              </div>
          </div>


            <div class="row">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                      <center><h3>Long Questions</h3></center>
                  <div class="row">
                              <?php $k = 1;
                 for($i=0;$i<$count;$i++)
        {
               $chap=$chapter[$i];
           $query_print = $this->db->query("SELECT * FROM `long_questions` INNER JOIN `chapters` ON long_questions.chapter=chapters.id INNER JOIN `class` ON class.class_id=long_questions.class WHERE long_questions.is_delete='0' AND long_questions.chapter='$chap' AND long_questions.level='$level' ORDER BY RAND() limit $long_limit")->result_array();
           foreach ($query_print as $value) {
                            
                            $question=$value['question'];
                ?>
                
                        <div class="col-md-11 col-sm-11 col-xs-11">Q3.<?php echo $k++; ?>:<b> <?php echo $value['question'];?></b></div>
                        <div class="col-md-1 col-sm-1 col-xs-1"><b>(<?php echo $data['long_marks'] ;?>)</b></div>
                        <div class="clearfix"></div>
                          


                          <?php }} ?>
                  </div>  
              </div>
          </div>
          <br /><br /><br />




        </div></div>
        <script>//window.print();</script>
    </body>
</html>