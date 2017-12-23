<html>
    <head>
        <title><?php echo $b_header['title']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="<?php echo base_url()?>assets/fonts/urdu.css" media="all">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="all">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/ckeditor/plugins/ckeditor_wiris/integration/WIRISplugins.js?viewer=image"></script>




<style type="text/css">
body{max-height:350px !important;
page-break-after: always; margin-bottom:10px;} 
h3{margin:0;}
.relative{position:relative;}
.text-bold{font-weight:bold;}
h4,hr{margin:2px;}
.logo{height:100px;position:absolute;top:0;left:0;}
.page{box-sizing: border-box;border-radius:10px;height:100%;padding:5px;}
.table tr td{border:2px dotted #17a05e !important;}
@media print{
.logo{height:80px;}
.page{page-break-after:always;}
}
    </style>

    </head>
    <body id="datatable-buttons">
      <?php
      $chapter=$data['chapter'];   
      $count=count($data['chapter']);
      $level=$data['level'];
      $class=$data['class'];
      ?>
<div class="watermark" style="width:100%;position:fixed;top:30%;opacity:0.1;"><img src="<?php echo base_url().$b_header['b_logo'];?>" style="display:block;margin:0 auto;width:600px;" alt="logo"></div>
        <div class="page">
        <div class="container-fluid">
          <div class="row header">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="row">
                      <div class="col-md-2 col-sm-2 col-xs-2 relative"><img class="logo" src="<?php echo base_url().$b_header['b_logo'];?>"></div>
                      <div class="col-md-8 col-sm-8 col-xs-8 text-center">
                            <h4 class="wd-100"><?php echo "<b>".$b_header['title']."</b>"; ?></h4>
                            <h5 class="wd-100"><?php echo "<b>".$b_header['tagline']."</b>"; ?></h5>
                            <h5 class="wd-100"><?php echo "<b>".$b_header['name']."</b>"?> - <?php echo $exam['name'];?> </h5>
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-2 relative"><img class="logo" src="<?php echo base_url().$b_header['b_logo'];?>"></div>
                  </div>  
              </div>
          </div>
          <div class="row header">
              <div class="col-md-12 col-sm-12 col-xs-12" style="padding:0;">
                  <div class="row upper-header" style="border-top:2px solid #17a05e;border-bottom:2px solid #17a05e;padding:5px;margin:5px;">
                              <div class="row">
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                          <h5 class="text-bold">Class:</h5>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                          <h5 class="text-bold"><?php echo $classes['class_name']; ?></h5>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                          <h5 class="text-bold">Subject:</h5>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                          <h5 class="text-bold"><?php echo $subject['name']; ?></h5>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                          <h5 class="text-bold">Time:</h5>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                          <h5 class="text-bold"><?php echo $data['time']; ?></h5>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                          <h5 class="text-bold">Date:</h5>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                          <h5 class="text-bold"><?php echo  date("d-m-Y", strtotime($data['dateofpaper'])); ?></h5>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                          <h5 class="text-bold">Total Marks:</h5>
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                          <h5 class="text-bold"><?php echo $data['totalmarks'];?></h5>
                                    </div>
                              </div>
                      </div>
                  </div>  
              </div>
          </div>
        
<!--//====================================Mcqs Questions===============================================-->
 <?php if(!empty($data['mcq']) && !empty($data['mcq_marks']) ){
      $subject=$data['subject'];
      $mcq_limit=$data['mcq'];
      $mrks=$data['mcq_marks'];
      $c=0;
 foreach($chapter as $key=> $chap){
      $checkpara= $this->db->query("SELECT * FROM `mcq_questions` where class=$class AND subject=$subject AND chapter=$chap AND  level='$level' ")->result_array();
      $c+=count($checkpara);
     }
     if($c>0)  {
       ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                  <h4 style="font-weight:bold;"><?php echo $data['mcq_tag'];echo "  ".$mcq_limit*$mrks; ?></h4>
                  <div class="row" style="line-height:2;">
<?php
           $j=1;
           $mcq_limit=$data['mcq'];
           $this->db->select('*');
           $this->db->from('mcq_questions');
           $this->db->join('chapters','mcq_questions.chapter=chapters.id');
           $this->db->join('class','class.class_id=mcq_questions.class');
           $this->db->join('subject','subject.id=mcq_questions.subject');
           $this->db->where('mcq_questions.is_delete',0);
           $this->db->where_in('mcq_questions.chapter', $chapter);
           $query_print=$this->db->where('mcq_questions.level',$level)->order_by('rand()')->limit($mcq_limit)->get()->result_array();
           //var_dump("<pre>",$query_print);die();
           foreach ($query_print as $value) {          
                            $option1=$value['option1'];
                            $option2=$value['option2'];
                            $option3=$value['option3'];
                            $option4=$value['option4'];
                ?>
                        <div class="col-md-11 col-sm-11 col-xs-11"><span class="question "><b class="magic_question">(<?php echo $j++;?>)</b></span> <b> <?php echo $value['question'] ;?></b></div>
                        <div class="col-md-1 col-sm-1 col-xs-1 magic_swap"><b>(<?php echo $data['mcq_marks'] ;?>)</b></div>
                        <div class="clearfix"></div>
                          <div class="col-sm-12">
                              <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3 magic_question"><b class="magic_question">(A)</b> <?php echo  $option1; ?></div>
                                    <div class="col-md-3 col-sm-3 col-xs-3 magic_question"><b class="magic_question">(B)</b> <?php echo $option2; ?></div>
                                    <div class="col-md-3 col-sm-3 col-xs-3 magic_question"><b class="magic_question">(C)</b> <?php echo $option3; ?></div>
                                    <div class="col-md-3 col-sm-3 col-xs-3 magic_question"><b class="magic_question">(D) </b> <?php echo $option4; ?></div>
                                    </div>
                          </div>
            <?php }
             ?>
                  </div>  
              </div>
          </div>
 <?php  }}?>

<!--//=========================================================Paragraph Questions==========================-->
<?php  if(!empty($data['paragraph']) && !empty($data['paragraph_marks']) ){
      $subject=$data['subject'];
      $paragraph_limit=$data['paragraph']; 
      $mrks=$data['paragraph_marks']; 
      $c=0;
 foreach($chapter as $key=> $chap){
       $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=5 AND  level='$level' ")->result_array();
       $c+=count($checkpara);
     }
     if($c>0)  {
       ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
              <h4 style="font-weight:bold;"><?php echo $data['paragraph_tag'];echo "  ".$paragraph_limit*$mrks; ?></h4>
                  <div class="row" style="line-height:2;">
            <?php
             $j=1;
          $paragraph_limit=$data['paragraph']; 
          $this->db->select('paragraph,question_type');
          $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',5);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($paragraph_limit)->get()->result_array();
           //var_dump($query_print);die();
           foreach ($query_print as $value) {          
            $question=$value['paragraph'];
                ?>
                        <div class="col-md-11 col-sm-11 col-xs-11 magic_arrange"><span class="question"><b class="magic_question">&nbsp;&bull;&nbsp;</b></span> <b> <?php echo $value['paragraph']; ;?></b></div>
                       <!-- <div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['paragraph_marks'] ;?>)</b></div>-->
            <?php 
            } ?>
                  </div>  
              </div>
          </div>
     <?php }}
      ?>
<!--//=========================================================Summary Questions==========================-->
<?php  if(!empty($data['summary']) && !empty($data['summary_marks']) ){
      //var_dump($data['summary']);die();
      $subject=$data['subject'];
      $summary_limit=$data['summary']; 
      $mrks=$data['summary_marks']; 
      $c=0;
 foreach($chapter as $key=> $chap){
       $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=8 AND  level='$level' ")->result_array();
       $c+=count($checkpara);
     }
     if($c>0)  {
       ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
              <h4 style="font-weight:bold;"><?php echo $data['summary_tag'];echo "  ".$summary_limit*$mrks; ?></h4>
                  <div class="row" style="line-height:2;">
            <?php
             $j=1;
          $summary_limit=$data['summary']; 
          $this->db->select('summary,question_type');
          $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',8);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($summary_limit)->get()->result_array();
           //var_dump($query_print);die();
           foreach ($query_print as $value) {          
            $question=$value['summary'];
                ?>
                        <div class="col-md-11 col-sm-11 col-xs-11"><span class="question"><b class="magic_question">(<?php echo $j++;?>)  </b></span> <b> <?php echo $value['summary']; ;?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_swap"><b>(<?php echo $data['summary_marks'] ;?>)</b></div>-->
                        <div class="clearfix"></div>
            <?php 
            } ?>
                  </div>  
              </div>
          </div>
     <?php }}
      ?>

<!--===============================================Essay Question=================================================-->
<?php  if(!empty($data['essay']) && !empty($data['essay_marks']) ){
            $c=0;
            $subject=$data['subject'];
             $essay_limit=$data['essay'];
              $mrks=$data['essay_marks'];
            foreach($chapter as $key=> $chap){
                  $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=9 AND  level='$level' ")->result_array();
                  $c+=count($checkpara);
            }
            if($c>0) { ?>            
            <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                     <h4 style="font-weight:bold;"><?php echo $data['essay_tag'];echo "  ".$essay_limit*$mrks; ?><h4 style="font-weight:bold;">
                  <div class="row">
            <?php 
            $k = 1;
            $essay_limit=$data['essay'];
            //var_dump($essay_limit);die();
                $this->db->select('*');
      	    $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',9);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($essay_limit)->get()->result_array(); 
         // var_dump($query_print);die();
                     foreach ($query_print as $value) {
                    $question=$value['essay'];
                ?>
                        <div class="col-md-3 col-sm-3 col-xs-3"><b class="magic_question">&nbsp;&bull;&nbsp;</b><b> <?php echo $value['essay'];?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_swap"><b>(<?php echo $data['essay_marks'] ;?>)</b></div>-->
                          <?php }?>
                  </div>  
              </div>
          </div>
<?php } }?>

<!--//=========================================================Application Questions==========================-->
<?php  if(!empty($data['application']) && !empty($data['application_marks']) ){
 $class=$data['class'];
 $subject=$data['subject'];
 $application_limit=$data['application'];
 $mrks=$data['application_marks'];
  $c=0;
 foreach($chapter as $key=> $chap){
       $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=7 AND  level='$level' ")->result_array();
     $c+=count($checkpara);
     }  
     if($c>0)  {
       ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
              <h4 style="font-weight:bold;"><?php echo $data['application_tag'];echo "  ".$application_limit*$mrks; ?><h4 style="font-weight:bold;">
                  <div class="row" style="line-height:2;">
      <?php
          $application_limit=$data['application'];
          $j=1;
          $this->db->select('application');
          $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',7);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($application_limit)->get()->result_array();

foreach ($query_print as $value) {          
            $question=$value['application'];
                ?>
                        <div class="col-md-1 col-sm-1 col-xs-1 magic_arrange magic_quest_no" style="width:5%;padding:0;" ><b class="pull-right"><?php echo $j++; ?></b></div>
                        <div class="col-md-10 col-sm-10 col-xs-10 magic_arrange"><b> <?php echo $value['application'] ;?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange">(<?php echo $data['application_marks'] ;?>)</div>-->
                        <div class="clearfix"></div>
            <?php 
            } ?>
                  </div>  
              </div>
          </div>
     <?php }}
      ?>

<!--//=========================================================Letter Questions==========================-->
<?php  if(!empty($data['letter']) && !empty($data['letter_marks']) ){
 $class=$data['class'];
 $subject=$data['subject'];
 $letter_limit=$data['letter'];
 $mrks=$data['letter_marks'];
  $c=0;
 foreach($chapter as $key=> $chap){
       $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=6 AND  level='$level' ")->result_array();
     $c+=count($checkpara);
     }

     
     if($c>0)  {
       ?>
          <div class="row  magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                    <h4 style="font-weight:bold;">
      <?php echo $data['letter_tag'];echo "  ".$letter_limit*$mrks; ?>
         <h4 style="font-weight:bold;">
                  <div class="row" style="line-height:2;">
            <?php
            $letter_limit=$data['letter'];
            $j=1;
 	  $this->db->select('letter');
          $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',6);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($letter_limit)->get()->result_array();
           foreach ($query_print as $value) {          
            $question=$value['letter'];
                ?>
                        <div class="col-md-1 col-sm-1 col-xs-1 magic_arrange magic_quest_no" style="width:5%;padding:0;" ><b class="pull-right"><?php echo $j++; ?></b></div>
                        <div class="col-md-10 col-sm-10 col-xs-10 magic_arrange"><b> <?php echo $value['letter'] ;?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['letter_marks'] ;?>)</b></div>-->
                        <div class="clearfix"></div>
            <?php 
            } ?>
                  </div>  
              </div>
          </div>
     <?php }}
      ?>
 
<!--================================================================Short Questions==================================================-->
<?php  if(!empty($data['short']) && !empty($data['short_marks']) ){
       $c=0;
       $subject=$data['subject'];
         $short_limit=$data['short'];
         $mrks=$data['short_marks'];
           $input = $this->input->post('short_marks');
       
 foreach($chapter as $key=> $chap){
       $checkpara= $this->db->query("SELECT * FROM `short_questions` where class=$class AND subject=$subject AND chapter=$chap  AND  level='$level' ")->result_array();
     $c+=count($checkpara);
     }
     if($c>0)  { 
      
      ?>
                        <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                     <h4 style="font-weight:bold; "><?php echo $data['short_tag']; echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."Total Marks"." ".$input//$short_limit*$mrks;?>
<h4 style="font-weight:bold;"></h3>
                    
                  <div class="row">
      <?php 
      $k=1;
      $short_limit=$data['short'];
      $this->db->select('short_questions.question, rand() as my_rand');
           $this->db->from('short_questions');
           $this->db->join('chapters','short_questions.chapter=chapters.id');
           $this->db->join('class','class.class_id=short_questions.class');
           $this->db->join('subject','subject.id=short_questions.subject');
           $this->db->where('short_questions.is_delete',0);
           $this->db->where_in('short_questions.chapter',$chapter);
           $query_print=$this->db->where('short_questions.level',$level)->order_by('my_rand','DESC')->limit($short_limit)->get()->result_array();
           //var_dump("<pre>",$query_print);die();
           foreach ($query_print as $value) {
                  $question=$value['question'];
            ?>
                        <div class="col-md-1 col-sm-1 col-xs-1 magic_arrange magic_quest_no" style="width:5%;padding:0;" ><b class="pull-right"><?php echo $k++; ?></b></div>
                        <div class="col-md-10 col-sm-10 col-xs-10 magic_arrange"><span style="font-weight:bolder;font-size: 17px;"><b><?php echo $value['question'];?></b></span></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['short_marks'] ;?>)</b></div>   -->
                        <div class="clearfix"></div>
                          <?php } ?>
                  </div>  
              </div>
          </div>
<?php }
}?>

<!--===============================================Long Question=================================================-->
<?php  if(!empty($data['long']) && !empty($data['long_marks']) ){
            $c=0;
            $subject=$data['subject'];
             $long_limit=$data['long'];
              $mrks=$data['long_marks'];
            foreach($chapter as $key=> $chap){
                  $checkpara= $this->db->query("SELECT * FROM `long_questions` where class=$class AND subject=$subject AND chapter=$chap  AND  level='$level' ")->result_array();
                  $c+=count($checkpara);
            }
            if($c>0){ ?>            
            <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                     <h4 style="font-weight:bold;"><?php echo $data['long_tag']; echo "  ".$long_limit*$mrks; ?></h4>
                  <div class="row">
<?php 
           $k = 1;
           $long_limit=$data['long'];
           $this->db->select('long_questions.question');
           $this->db->from('long_questions');
           $this->db->join('chapters','long_questions.chapter=chapters.id');
           $this->db->join('class','class.class_id=long_questions.class');
           $this->db->join('subject','subject.id=long_questions.subject');
           $this->db->where('long_questions.is_delete',0);
           $this->db->where_in('long_questions.chapter', $chapter);
           $query_print=$this->db->where('long_questions.level',$level)->order_by('rand()')->limit($long_limit)->get()->result_array();           foreach ($query_print as $value) {
           $question=$value['question'];
?>
                        <div class="col-md-1 col-sm-1 col-xs-1 magic_arrange magic_quest_no" style="width:5%;padding:0;font-size: 15px; " ><b class="pull-right"><?php echo $k++; ?></b></div>
                        <div class="col-md-10 col-sm-10 col-xs-10"><b><?php echo $value['question'];?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_swap"><b>(<?php echo $data['long_marks'] ;?>)</b></div>-->
                        <div class="clearfix"></div>
                          <?php } ?>
                  </div>  
              </div>
          </div>
<?php }} ?>

<!--//=========================================================Centeral Idea==========================-->
<?php  if(!empty($data['centeralidea']) && !empty($data['centeralidea_marks']) ){
                  $c=0;
                  $class=$data['class'];
                  $subject=$data['subject'];
                  $c_limit=$data['centeralidea'];
                  $mrks=$data['centeralidea_marks'];
                  foreach($chapter as $key=> $chap){
                        $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=13 AND  level='$level' ")->result_array();
                        $c+=count($checkpara);
                        }
            if($c>0) { ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                    <h4 style="font-weight:bold;"><?php echo $data['ci_tag'];echo "  ".$c_limit*$mrks; ?></h4>
                  <div class="row" style="line-height:2;">
            <?php
               $c_limit=$data['centeralidea'];
               $j=1;
                $this->db->select('*');
      	    $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',13);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($c_limit)->get()->result_array();   
           foreach ($query_print as $value) {          
                  $question=$value['centeral_idea'];
            ?>
                        <div class="col-md-11 col-sm-11 col-xs-11"><b>&nbsp;&bull;&nbsp;</b><b> <?php echo $value['centeral_idea'] ;?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_swap"><b>(<?php echo $data['centeralidea_marks'] ;?>)</b></div>-->
                        <div class="clearfix"></div>
            <?php } ?>
                  </div>  
              </div>
          </div>
 <?php }} ?>

<!--================================================================Words Meanings Questions==================================================-->
<?php  if(!empty($data['wordsmeanings']) && !empty($data['wordsmeanings_marks']) ){
       $c=0;
       $subject=$data['subject'];
       $wm_limit=$data['wordsmeanings'];
       $mrks=$data['wordsmeanings_marks'] ;
     $input = $this->input->post('wordsmeanings_marks');
      
      foreach($chapter as $key=> $chap){
       $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=16 AND  level='$level' ")->result_array();
       $c+=count($checkpara);
     }
     if($c>0)  { ?>
       <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                     <h4 style="font-weight:bold;"><?php echo $data['wm_tag'];echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."Total Marks"." ".$input//$short_limit*$mrks; ?> </h4>
                  <div class="row">
<?php 
      $k=1;
      $wm_limit=$data['wordsmeanings'];
                $this->db->select('words');
                $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',16);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($wm_limit)->get()->result_array();
                  foreach ($query_print as $value) {
                        $question=$value['words'];
                        ?>
                        <div class="col-md-3 col-sm-3 col-xs-3 magic_arrange"><b class="magic_question">&nbsp;&bull;&nbsp;</b><b><span style="font-weight:bolder;font-size: 17px;"><?php echo $value['words'];?></b></span></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['wordsmeanings_marks'] ;?>)</b></div>-->
            <?php } ?>
                  </div>  
              </div>
          </div>
    <div class="clearfix"></div>
     <?php } } ?>

<!--//=========================================================Make Sentence==========================-->
<?php  if(!empty($data['makesentence']) && !empty($data['makesentence_marks']) ){
              $class=$data['class'];
              $subject=$data['subject'];
              $ms_limit=$data['makesentence'];
              $mrks=$data['makesentence_marks'] ;
              $c=0;
                  foreach($chapter as $key=> $chap){
                  $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=15 AND  level='$level' ")->result_array();
                  $c+=count($checkpara);
                  }if($c>0){ ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1 " >
                    <h4 style="font-weight:bold;"><?php echo $data['ms_tag'];echo "  ".$ms_limit*$mrks;?></h4>
                  <div class="row" style="line-height:2;">
            <?php
            $ms_limit=$data['makesentence'];
            $j=1;
                $this->db->select('*');
      	    $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',15);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($ms_limit)->get()->result_array();
           foreach ($query_print as $value) {          
                  $question=$value['wordforsentence'];?>
                        <div class="col-md-2 col-sm-2 col-xs-2 magic_arrange"><b class="magic_question">&nbsp;&bull;&nbsp;</b><b> <?php echo $value['wordforsentence'] ;?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['makesentence_marks'] ;?>)</b></div>-->
                        
            <?php } ?>
                  </div>  
              </div>
          </div>
 <?php }}?>

<!--===============================================Poem=================================================-->
<?php  if(!empty($data['poem']) && !empty($data['poem_marks']) ){
        $c=0;
        $subject=$data['subject'];
        $p_limit=$data['poem'];
        $mrks=$data['poem_marks'];
            foreach($chapter as $key=> $chap){
            $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=10 AND  level='$level' ")->result_array();
            $c+=count($checkpara);
            }
     if($c>0) { ?>            
            <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                     <h4 style="font-weight:bold;"><?php echo $data['poem_tag']; echo "  ".$p_limit*$mrks;?></h4>
                  <div class="row">
            <?php 
            $k = 1;
            $p_limit=$data['poem'];
                $this->db->select('*');
      	    $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',10);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($p_limit)->get()->result_array(); 
           foreach ($query_print as $value) {
                    $question=$value['poem'];
                ?>
                        <div class="col-md-11 col-sm-11 col-xs-11"><b class="magic_question">(<?php echo $k++; ?>)</b><b> <?php echo  $question;?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_swap"><b>(<?php echo $data['poem_marks'] ;?>)</b></div>-->
                        <div class="clearfix"></div>
                          <?php } ?>
                  </div>  
              </div>
          </div>
<?php }}?>

<!--================================================================Opposites Questions==================================================-->
<?php  if(!empty($data['opposites']) && !empty($data['opposites_marks']) ){
       $c=0;
       $subject=$data['subject'];
       $opposites_limit=$data['opposites'];
       $mrks=$data['opposites_marks'];
 $input = $this->input->post('opposites_marks');
    
 foreach($chapter as $key=> $chap){
       $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=12 AND  level='$level' ")->result_array();
     $c+=count($checkpara);
     }
     if($c>0)  {
?>
         <div class="row  magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                     <h4 style="font-weight:bold;"><?php echo $data['opposites_tag'];echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."Total Marks"." ".$input//$short_limit*$mrks;  ?></h4>
                  <div class="row">
      <?php 
      $k=1;
      $opposites_limit=$data['opposites'];
      $this->db->select('opposites');
          $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',12);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($opposites_limit)->get()->result_array();
           //var_dump($query_print);die();
           foreach ($query_print as $value) {

                  $question=$value['opposites'];
            ?>
                        <div class="col-md-2 col-sm-2 col-xs-2 magic_arrange"><b class="magic_question">&nbsp;&bull;&nbsp;</b><b><span style="font-weight:bolder;font-size: 17px;"><?php echo $value['opposites'];?></b></span></div>
                       <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['opposites_marks'] ;?>)</b></div>-->
                          <?php } ?>
                  </div>  
              </div>
          </div>
<?php }}
?>

<!--//=========================================================Make Superlatvie==========================-->
<?php  if(!empty($data['adjective']) && !empty($data['superlative_marks']) ){
      $class=$data['class'];
      $subject=$data['subject'];
       $s_limit=$data['adjective'];
        $mrks=$data['superlative_marks'];
      $c=0;
 foreach($chapter as $key=> $chap){
       $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=17 AND  level='$level' ")->result_array();
     $c+=count($checkpara);
     }
     if($c>0) { ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                    <h4 style="font-weight:bold;"><?php echo $data['s_tag'];echo "  ".$s_limit*$mrks; ?></h4>
                  <div class="row" style="line-height:2;">
            <?php
            $s_limit=$data['adjective'];
            $j=1;
                $this->db->select('*');
      	    $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',17);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($s_limit)->get()->result_array();
           foreach ($query_print as $value) {          
                  $question=$value['adjective'];?>
                        <div class="col-md-2 col-sm-2 col-xs-2 magic_arrange"><b class="magic_question">&nbsp;&bull;&nbsp;</b> <b> <?php echo $question ;?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['superlative_marks'] ;?>)</b></div>-->
                
            <?php } ?>
                  </div>  
              </div>
          </div>
 <?php }} ?>

<!--//=========================================================Make Ideoms==========================-->
<?php  if(!empty($data['ideoms']) && !empty($data['ideoms_marks']) ){
                  $class=$data['class'];
                  $subject=$data['subject'];
                  $ideoms_limit=$data['ideoms'];
                  $mrks=$data['ideoms_marks'];
                  $c=0;
                  foreach($chapter as $key=> $chap){
                        $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=18 AND  level='$level' ")->result_array();
                        $c+=count($checkpara);
                  }
                         if($c>0){ ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                    <h4 style="font-weight:bold;"><?php echo $data['ideoms_tag'];echo "  ".$ideoms_limit*$mrks; ?></h4>
                  <div class="row" style="line-height:2;">
            <?php
            $ideoms_limit=$data['ideoms'];
            $j=1;
                $this->db->select('*');
      	    $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',18);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($ideoms_limit)->get()->result_array();
           $nom=1;
           foreach ($query_print as $value) {          
                  $question=$value['superlative'];?>
                        <div class="col-md-2 col-sm-2 col-xs-2 magic_arrange"><b class="magic_question">&nbsp;<?php echo $nom;echo ")";?>&nbsp;</b> <b> <?php echo $value['ideoms'] ;?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['ideoms_marks'] ;?>)</b></div>-->
                      <?php
                      $nom++;
                      echo "<br>";  
                      ?>
            <?php } ?>
                  </div>  
              </div>
          </div>
 <?php } } ?>

 <!--================================================================Grammer Questions==================================================-->
<?php  if(!empty($data['grammer_question']) && !empty($data['grammer_marks']) ){
       $c=0;
       $subject=$data['subject'];
       $wm_limit=$data['grammer_question'];
       $mrks=$data['grammer_marks'];
      foreach($chapter as $key=> $chap){
       $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=20 AND  level='$level' ")->result_array();
       $c+=count($checkpara);
     }
     if($c>0)  { ?>
       <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                     <h4 style="font-weight:bold;"><?php echo $data['grammer_tag'];echo "  ".$wm_limit*$mrks; ?> </h4>
                  <div class="row">
<?php 
      $k=1;
      $wm_limit=$data['grammer_question'];
                $this->db->select('grammer');
                $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',20);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($wm_limit)->get()->result_array();
                  foreach ($query_print as $value) {
                        $question=$value['grammer'];
                        ?>
                        <div class="col-md-3 col-sm-3 col-xs-3 magic_arrange"><b class="magic_question">&nbsp;&bull;&nbsp;</b><b><?php echo $value['grammer'];?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['grammer_marks'] ;?>)</b></div>-->
            <?php } ?>
                  </div>  
              </div>
          </div>
    <div class="clearfix"></div>
     <?php } } ?>

<!--//=========================================================Singular Questions==========================-->
<?php  if(!empty($data['singular']) && !empty($data['singular_marks']) ){
      
      $subject=$data['subject'];
      $singular_limit=$data['singular'];
      $mrks=$data['singular_marks'];
       $input = $this->input->post('singular_marks');
    
      $c=0;
 foreach($chapter as $key=> $chap){
       $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=11 AND  level='$level' ")->result_array();
       $c+=count($checkpara);
     }
     if($c>0)  {
       ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
              <h4 style="font-weight:bold;"><?php echo $data['sp_tag'];echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."Total Marks"." ".$input//$short_limit*$mrks;?></h4>
                  <div class="row" style="line-height:2;">
            <?php
             $j=1;
          $singular_limit=$data['singular']; 
          $this->db->select('singular,question_type');
          $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',11);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($singular_limit)->get()->result_array();
           //var_dump($query_print);die();
           foreach ($query_print as $value) {          
            $question=$value['singular'];
                ?>
                        <div class="col-md-2 col-sm-2 col-xs-2 magic_arrange"><span style="font-weight:bolder;font-size: 17px;"><b class="magic_question">&nbsp;&bull;&nbsp;</b></span> <b> <?php echo $question;?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['singular_marks'] ;?>)</b></div>-->
            <?php 
            } ?>
                  </div>  
              </div>
          </div>
     <?php }}
      ?>

<!--//=========================================================Singular Questions end==========================-->

<!--//=========================================================Fill in the Blanks==========================-->
<?php  if(!empty($data['fill']) && !empty($data['fill_marks']) ){
		  $class=$data['class'];
              $subject=$data['subject'];
              $fill_limit=$data['fill'];
              $mrks=$data['fill_marks'];
             $input = $this->input->post('fill_marks');
    
              $c=0;
                  foreach($chapter as $key=> $chap){
                        $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=4 AND  level='$level' ")->result_array();
                  $c+=count($checkpara);
                  }
                        if($c>0) { ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                  <h4 style="font-weight:bold;"><?php echo $data['fill_tag'];echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."Total Marks"." ".$input//$short_limit*$mrks; ?></h4>
                  <div class="row" style="line-height:2;">
            <?php
            $fill_limit=$data['fill'];
            $j=1;
                $this->db->select('*');
                $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',4);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($fill_limit)->get()->result_array();
                 foreach ($query_print as $value) {          
                        $question=$value['fill_blank_question'];
                        ?>
                       
                        <div class="col-md-1 col-sm-1 col-xs-1 magic_arrange magic_quest_no" style="width:5%;padding:0;" ><b class="pull-right"><?php echo $j++; ?></b></div>
                        <div class="col-md-10 col-sm-10 col-xs-10 magic_arrange"><span style="font-weight:bolder; font-size:17px;"><?php echo $value['fill_blank_question'];?></span></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_swap"><b>(<?php echo $data['fill_marks'] ;?>)</b></div>-->
                        <div class="clearfix"></div>
            <?php } ?>
                  </div>  
              </div>
          </div>
 <?php }} ?>
<!--//=========================================================True False==========================-->
<?php  if(!empty($data['truefalse']) && !empty($data['truefalse_marks']) ){
            $class=$data['class'];
            $subject=$data['subject'];
            $tf_limit=$data['truefalse'];
            $mrks=$data['truefalse_marks'];
           $input = $this->input->post('truefalse_marks');
    
            $c=0;
                  foreach($chapter as $key=> $chap){
                        $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=19 AND  level='$level' ")->result_array();
                  $c+=count($checkpara);
                  }
                  if($c>0)  { ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                    <h4 style="font-weight:bold;"><?php echo $data['tf_tag'];echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."Total Marks"." ".$input//$short_limit*$mrks; ?></h4>
                  <div class="row" style="line-height:2;">
            <?php
            $tf_limit=$data['truefalse'];
            $j=1;
                $this->db->select('*');
      	    $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',19);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($tf_limit)->get()->result_array();
           foreach ($query_print as $value) {          
                  $question=$value['true_words']; ?>
                        <div class="col-md-10 col-sm-10 col-xs-10 magic_arrange"><b class="magic_arrange">&nbsp;<?php echo $j++; ?>&nbsp;</b><span style="font-weight:bold; font-size:17px"> <?php echo $question ;?></span></div>
                        <div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b><table style="margin:1px 0;"><tr><td style="border:1px solid black;padding:5px;" >T</td><td style="border:1px solid black;padding:5px;" >F</td></tr></table></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['truefalse_marks'] ;?>)</b></div>-->
            <?php } ?>
                  </div>  
              </div>
          </div>
 <?php }} ?>

<!--//=========================================================Translate Into Egnlish==========================-->
<?php  if(!empty($data['translateintoenglish']) && !empty($data['translateintoenglish_marks']) ){
                  $c=0;
                  $class=$data['class'];
                  $subject=$data['subject'];
                   $te_limit=$data['translateintoenglish'];
                    $mrks=$data['translateintoenglish_marks'];
                        foreach($chapter as $key=> $chap){
                              $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=14 AND  level='$level' ")->result_array();
                              $c+=count($checkpara);
                              }
      if($c>0) { ?>
          <div class="row ">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1 ">
                    <h4 style="font-weight:bold;" class="magic_hover"><?php echo $data['te_tag'];echo "  ".$te_limit*$mrks; ?></h4>
                  <div class="row magic_hover" style="line-height:2;">
<?php
            $te_limit=$data['translateintoenglish'];
            $j=1;
                $this->db->select('*');
      	    $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',14);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($te_limit)->get()->result_array();
           foreach ($query_print as $value) {          
                  $question=$value['translate_english']; ?>
          <div class="col-md-11 col-sm-11 col-xs-11 "><span class="question"><b class="magic_question">(<?php echo $j++;?>)</b></span> <b> <?php echo $value['translate_english'] ;?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_swap"><b>(<?php echo $data['translateintoenglish_marks'] ;?>)</b></div>-->
                        <div class="clearfix"></div>
            <?php } ?>
                  </div>  
              </div>
          </div>
 <?php }}?>

<!--//=========================================================Make Proverb==========================-->
<?php  if(!empty($data['pro_verb']) && !empty($data['proverb_marks']) ){
              $class=$data['class'];
              $subject=$data['subject'];
               $pr_limit=$data['pro_verb'];
                $mrks=$data['proverb_marks'];
              $c=0;
                  foreach($chapter as $key=> $chap){
                  $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=22 AND  level='$level' ")->result_array();
                  $c+=count($checkpara);
                  }if($c>0){ ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1 " >
                    <h4 style="font-weight:bold;"><?php echo $data['pr_tag'];echo "  ".$pr_limit*$mrks; ?></h4>
                  <div class="row" style="line-height:2;">
            <?php
            $pr_limit=$data['pro_verb'];
            $j=1;
                $this->db->select('*');
      	    $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',22);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($pr_limit)->get()->result_array();
            $nom=1;
           foreach ($query_print as $value) {          
                  $question=$value['pro_verb'];?>
                  
                        <div class="col-md-2 col-sm-2 col-xs-2 magic_arrange"><b class="magic_question">&nbsp;<?php echo $nom; echo ")";?>&nbsp;</b><b> <?php echo $value['pro_verb'] ;?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['proverb_marks'] ;?>)</b></div>-->
                        <?php
                        $nom++;
                        echo "<br>";
                        ?>
            <?php } ?>
                  </div>  
              </div>
          </div>
 <?php }}?>
 
 <!--//=========================================================Make conversation==========================-->
<?php  if(!empty($data['conversation']) && !empty($data['con_marks']) ){
              $class=$data['class'];
              $subject=$data['subject'];
              $con_limit=$data['conversation'];
              $mrks=$data['con_marks'];
              $c=0;
                  foreach($chapter as $key=> $chap){
                  $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=23 AND  level='$level' ")->result_array();
                  $c+=count($checkpara);
                  }if($c>0){ ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1 " >
                    <h4 style="font-weight:bold;"><?php echo $data['con_tag'];echo "  ".$con_limit*$mrks; ?></h4>
                  <div class="row" style="line-height:2;">
            <?php
            $con_limit=$data['conversation'];
            $j=1;
                $this->db->select('*');
      	    $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',23);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($con_limit)->get()->result_array();
           $nomb=1;
           foreach ($query_print as $value) {          
                  $question=$value['conversation'];?>
 <div class="col-md-5 col-sm-5 col-xs-5 magic_arrange"><b class="magic_question">&nbsp;<?php echo $nomb;echo")";?>&nbsp;</b><b><?php echo $value['conversation'] ;?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['con_marks'] ;?>)</b></div>-->
                      <?php echo"<br>"; 
                      $nomb++;
                      ?>
            <?php } ?>
                  </div>  
              </div>
          </div>
 <?php }}?>

 
 <!--================================================================passage==================================================-->
<?php  if(!empty($data['passage']) && !empty($data['pass_marks']) ){

$idd=$this->session->flashdata('passage_id');

         $class=$data['class'];
              $subject=$data['subject'];
              $c=0;
              
 foreach($chapter as $key=> $chap){
       $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap AND question_type=24 AND passage_id=$idd  AND  level='$level' ")->result_array();
     $c+=count($checkpara);
     }
     
     $pasg_text=$this->db->select('passage_text')
                         ->from('passage')
                         ->where('id',$idd)
                         ->get()->row_array();
          $pass_limit=$data['passage'];
          $mrks=$data['pass_marks'];
     if($c>0)  { 
      
      ?>
      <p><?php echo $pasg_text['passage_text'];?></p>
      <br><br>
     
      
                        <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
                     <h4 style="font-weight:bold;"><?php echo $data['pass_tag'];echo "  ".$pass_limit*$mrks; ?><h4 style="font-weight:bold;"></h3>
                  <div class="row">
      <?php 
      $k=1;
      $pass_limit=$data['passage'];
      $iid=$this->session->flashdata('passage_id');
       $this->db->select('*');
      	    $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',24);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
                $this->db->where('passage_id',$iid);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($pass_limit)->get()->result_array();
         
           
            foreach ($query_print as $value) {          
                  $question=$value['passage'];?>
     <div class="col-md-1 col-sm-1 col-xs-1 magic_arrange magic_quest_no" style="width:5%;padding:0;" ><b class="pull-right"><?php echo $k++; ?></b></div>             
       <div class="col-md-10 col-sm-10 col-xs-10 magic_arrange"><span style="font-weight:bold;"><?php echo $value['passage'];?></span></div>
                     <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['pass_marks'] ;?>)</b></div>-->
                        <div class="clearfix"></div>
                        
            <?php } ?>
            
    
                  </div>  
              </div>
          </div>
<?php }}?>

<!--//=========================================================Masculine Questions==========================-->
<?php  if(!empty($data['masculine']) && !empty($data['masculine_marks']) ){
      
      $subject=$data['subject'];
      $masculine_limit=$data['masculine'];
      $mrks=$data['masculine_marks'];
      $c=0;
 foreach($chapter as $key=> $chap){
       $checkpara= $this->db->query("SELECT * FROM `general_questions` where class=$class AND subject=$subject AND chapter=$chap  AND question_type=21 AND  level='$level' ")->result_array();
       $c+=count($checkpara);
     }
     if($c>0)  {
       ?>
          <div class="row magic_hover">
              <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1">
              <h4 style="font-weight:bold;"><?php echo $data['mf_tag'];echo "  ".$masculine_limit*$mrks; ?></h4>
                  <div class="row" style="line-height:2;">
            <?php
             $j=1;
          $masculine_limit=$data['masculine']; 
          $this->db->select('masculine,question_type');
          $this->db->from('general_questions');
                $this->db->where_in('chapter',$chapter); 
                $this->db->where('question_type',21);
                $this->db->where('class',$class); 
                $this->db->where('subject',$subject);
                $this->db->where('level',$level);
           $query_print=$this->db->where('is_delete',0)->order_by('rand()')->limit($masculine_limit)->get()->result_array();
           //var_dump($query_print);die();
           foreach ($query_print as $value) {          
            $question=$value['masculine'];
                ?>
                        <div class="col-md-2 col-sm-2 col-xs-2 magic_arrange"><span class="question"><b class="magic_question">&nbsp;&bull;&nbsp;</b></span> <b> <?php echo $question;?></b></div>
                        <!--<div class="col-md-1 col-sm-1 col-xs-1 magic_arrange"><b>(<?php echo $data['masculine_marks'] ;?>)</b></div>-->
            <?php 
            } ?>
                  </div>  
              </div>
          </div>
     <?php }}
      ?>

<!--//=========================================================Masculine Questions end==========================-->


          <br /><br /><br />
          <div class="col-xs-12 col-md-12 text-center">
                  <h4><i>The End | Best of Luck<i></h4>
                  <h5><i>This is a software generated paper<i></h5>
                  <div class="col-lg-12 col-md-12 text-center">
                        <img src="<?php echo base_url(); ?>assets/images/softvilla-logo.png" style="width:150px;" alt="logo"><span style="border:1px solid black;height:300px;margin:0 10px;padding:25 0;"></span><img src="<?php echo base_url(); ?>assets/images/slm-qr-code.jpg" style="width:80px;" alt="logo">
                  </div>
          </div>
        </div></div>
        <script>//window.print();</script>
    </body>
</html>
<script>
      $(window).on("load", function() {
            var button="<div class='col-lg-12 magic-align' style='display:none;'><button type='button' class='btn btn-primary btn-sm magic-align-btn'>Left/Right</button></div>";
            $('.magic_hover').prepend(button);
      });
      $(function(){
            $(document).on('mouseenter', '.magic_hover', function () {
                    $(this).find(".magic-align").show();
                }).on('mouseleave', '.magic_hover', function () {
                    $(this).find(".magic-align").hide();
                });
            $(document).on('click', '.magic-align-btn', function () {
                    var status=$(this).parent().parent().css('textAlign');
                    var div=$(this).parent().parent();
                    var swaps=div.find('.magic_swap');
                    var quest=div.find('.magic_question');
                    var quest_mirror=div.find('.magic_question_mirror');
                    var magic_arrange=div.find('.magic_arrange');
                    var magic_quest_no=div.find('.magic_quest_no');
                    if(status=='start' || status=='left'){
                        div.css('text-align','right');
                        quest.addClass('pull-right');
                        quest_mirror.addClass('pull-left');
                        quest_mirror.removeClass('pull-right');
                        for (i = 0; i < swaps.length; i++) { 
                             swaps.eq(i).prev().find('b').addClass('pull-right'); 
                             swaps.eq(i).insertBefore(swaps.eq(i).prev());
                        }
                        magic_arrange.addClass('pull-right');
                        magic_quest_no.find('b').addClass('pull-left');
                    }
                    else {
                        div.css('text-align','left'); 
                        quest.removeClass('pull-right');
                        quest_mirror.addClass('pull-right');
                        quest_mirror.removeClass('pull-left');
                        for (i = 0; i < swaps.length; i++) {
                              swaps.eq(i).next().find('b').removeClass("pull-right");  
                              swaps.eq(i).insertAfter(swaps.eq(i).next());
                        }
                        magic_arrange.removeClass('pull-right');
                        magic_quest_no.find('b').removeClass('pull-left');
                    }
            });
            
      });
</script>