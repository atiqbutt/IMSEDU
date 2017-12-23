<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class autopaper extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("autopaper_model");
        $this->user_model->check_login("admin");
        $this->load->library("pagination");
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

                /*==========================================================*/
    public function question_type($p=1)
     {
      $this->user_model->check_permissions("autopaper/question_type");
         $data['is_super'] = $this->user_model->is_super();
         $data['menu'] = $this->load_model->menu();
         $branch=$this->user_model->getbranch();
            if($this->user_model->is_super())
                $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
            else
                $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
         $total = $this->db->query("SELECT count(*) as total FROM `question_type` where is_delete='0'")->result_array()[0]['total'];
         $per_page = 10;
         $offset = ($p - 1) * $per_page;
           if(!$this->user_model->is_super())
           {
                 $this->db->where('branch',$branch);

           }
         $this->db->where('is_delete','0');
         $this->db->select("*"); 
         $this->db->from('question_type');
         $this->db->limit($per_page,$offset);
         $query = $this->db->get();
         $data['base_url'] = base_url();
         $data['userInfo'] = $this->userInfo;
         $data['question'] = $query->result_array();
         $data['total'] = ceil($total / $per_page);
         $this->load->view('header',$data);
         $this->load->view('sidebar',$data);
         $this->load->view('autopaper/questionType',$data);
    }

    public function save_question_type()
    {
      if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_question_type($data);
        redirect("autopaper/question_type","refresh");
    }
    else{
        redirect("autopaper/question_type","refresh");

    }
  }

    public function delete_question_type()
    {
        if($this->uri->segment(3))
        {
            $id=$this->uri->segment(3);
            $this->autopaper_model->delete_question_type($id);
           redirect("autopaper/question_type","refresh");

        }
        else
        {
           redirect("autopaper/question_type","refresh");

        }
    }
  public function  edit_question_type()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_question_type($id);
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_questionType',$data);    
    }
  }
  public function update_question_type()
  {
      if($this->input->post())
      {
        $data = $this->input->post();
        $this->autopaper_model->update_question_type($data);
        redirect("autopaper/question_type","refresh");
      }
    else{
        redirect("autopaper/question_type","refresh");
    }
  }
/*=================================Custom Pagination style==========================*/

// public function chapter($q="all",$p=1)
// {
//        $this->user_model->check_permissions("autopaper/chapter");
//          $data['is_super'] = $this->user_model->is_super();
//          $data['menu'] = $this->load_model->menu();
//          $branch=$this->user_model->getbranch();
//             if($this->user_model->is_super())
//                 $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
//             else
//                 $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
//         $per_page = 10;
//         $offset = ($p - 1) * $per_page;
//         $q = urldecode($q);
//         $p = $p<1?1:$p;
//         $per_page = 10;
//         $offset = ($p - 1) * $per_page;
//         $sq1 = "";
//         if($q!="all")
//         {
//             $sq1 .= "AND (subject.name like '%".$q."%' OR ";
//             $sq1 .= "chapters.name like '%".$q."%' OR ";
//             $sq1 .= "class_name like '%".$q."%' OR "; 
//             $sq1 .= "chapterNo like '%".$q."%' )";
//         }
//         $total = $this->db->query("SELECT count(*) as total   FROM `chapters` inner join `class` on class.class_id=chapters.class_id inner join `subject` on subject.id=chapters.subject_id  where chapters.is_delete='0' $sq1 LIMIT 0, $per_page")->result_array()[0]['total'];
//          if($total<=$offset)
//          {
//                 $query = $this->db->query("SELECT chapters.id,subject.name as sub,chapters.name as cha,class.class_name,chapters.chapterNo  FROM `chapters` inner join `class` on class.class_id=chapters.class_id inner join `subject` on subject.id=chapters.subject_id where chapters.is_delete='0' $sq1 LIMIT 0, $per_page");
//                 $p=1;
//                 }else
//         $query = $this->db->query("SELECT chapters.id,subject.name as sub,chapters.name as cha,class.class_name,chapters.chapterNo  FROM `chapters` inner join `class` on class.class_id=chapters.class_id inner join `subject` on subject.id=chapters.subject_id  where chapters.is_delete='0' $sq1 LIMIT $offset, $per_page");
//          $data['q'] = $q;
//          $data['curr'] = $p;
//          $data['searchq'] = $q;         
//          $data['base_url'] = base_url();
//          $data['userInfo'] = $this->userInfo;
//          $data['question'] = $query->result_array();
//          $data['end'] = ceil($total / $per_page);
//          $this->load->view('header',$data);
//          $this->load->view('sidebar',$data);
//          $this->load->view('autopaper/chapters',$data);
// }
//==================================================================================================================

//===============================================New Controler for view of chapter function================================
public function chapter()
{
       $this->user_model->check_permissions("autopaper/chapter");
         $data['is_super'] = $this->user_model->is_super();
         $data['menu'] = $this->load_model->menu();
         $branch=$this->user_model->getbranch();
            if($this->user_model->is_super()){
                $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
            }else{
                $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
                $query = $this->db->query("SELECT chapters.id,subject.name as sub,chapters.name as cha,class.class_name,chapters.chapterNo  FROM `chapters` inner join `class` on class.class_id=chapters.class_id inner join `subject` on subject.id=chapters.subject_id  where chapters.is_delete='0'");
                }
         $data['base_url'] = base_url();
         $data['userInfo'] = $this->userInfo;
         $data['question'] = $query->result_array();
         $this->load->view('header',$data);
         $this->load->view('sidebar',$data);
         $this->load->view('autopaper/chapters',$data);
}

//===================================================edit view of chapter====================================
public function  edit_chapter()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"chapters");
      //var_dump($data['val']);die();
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/chapter_edit',$data);    
    }
  }

//================================Save edit data of chapter===========================
public function save_edit_chapter()
{
     if($this->input->post()){
        $data = $this->input->post();
        //var_dump($data);die();
        $db_insert = $this->autopaper_model->save_edit_chapter($data);
        redirect("autopaper/chapter","refresh");
    }
    else{
        redirect("autopaper/chapter","refresh");
    }  
}

//==========================Save Chapter=================================
public function save_chapter()
{
     if($this->input->post()){
        $data = $this->input->post();
        //var_dump($data);die();
        $db_insert = $this->autopaper_model->save_chapter($data);
        redirect("autopaper/chapter","refresh");
    }
    else{
        redirect("autopaper/chapter","refresh");
    }  
}
/*======================================================================*/
public function question()
{
         $this->user_model->check_permissions("autopaper/question");
         $data['is_super'] = $this->user_model->is_super();
         $data['menu'] = $this->load_model->menu();
         $branch=$this->user_model->getbranch();
            if($this->user_model->is_super())
                $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
            else
                $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
         $data['base_url'] = base_url();
         $data['userInfo'] = $this->userInfo;
         $this->load->view('header',$data);
         $this->load->view('sidebar',$data);
         $this->load->view('autopaper/questions',$data);
}
//=============================show data regarding question preview===================================
public function get_question()
{
          $value=$this->input->post('question');
          $data['is_super'] = $this->user_model->is_super();
          $data['menu'] = $this->load_model->menu();
          $branch=$this->user_model->getbranch();
            if($this->user_model->is_super())
                $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
            else
                $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
                $data['base_url'] = base_url();
                $data['userInfo'] = $this->userInfo;
         if($value==1)
           {
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/mcq_question',$data);
           }
          elseif($value==2)
          {
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/short_question',$data);
          } 
          elseif($value==3)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/long_question',$data);
          }
          elseif($value==4)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/fill_blanks',$data);
          }
          elseif($value==5)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/paragraph_question',$data);
          }
          elseif($value==6)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/letter_question',$data);
          }
          elseif($value==7)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/application_question',$data);
          }
          elseif($value==8)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/summary_question',$data);
          }
          elseif($value==9)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/essay_question',$data);
          }
          elseif($value==10)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/poem_question',$data);
          }
          elseif($value==11)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/singular_plural_question',$data);
          }
          elseif($value==12)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/oppsites_question',$data);
          }
          elseif($value==13)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/centeralidea',$data);
          }
          elseif($value==14)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/translateintoeng',$data);
          }
          elseif($value==15)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/makesentence',$data);
          }
          elseif($value==16)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/wordsmeanings',$data);
          }
          elseif($value==17)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/superlative',$data);
          }
          elseif($value==18)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/ideoms',$data);
          }
          elseif($value==19)
          {
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('autopaper/truefalse',$data);
          }
          else
          {
            redirect('autopaper/question','refresh');
          }
}
//=================================save short question=====================================
public function save_short_question()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      $que=$this->input->post('question');
      $count=count($que);
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question' => $que[$i],
            );
     $this->autopaper_model->save_short_question($Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of Short Questions====================================
public function  edit_shortquestions()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"short_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_shortquestion',$data);    
    }
  }
//================================Save edit data of Short Questions===========================
public function save_edit_short()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_short($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}
//==================================save long question===========================
public function save_long_question()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      $que=$this->input->post('question');
      $count=count($que);
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question' => $que[$i],
            );
             $this->db->insert('long_questions',$Name);
        }
            redirect('autopaper/question','refresh');
  }
  else{
             redirect('autopaper/question','refresh');
      }
}
//===================================================edit view of Long Questions====================================
public function  edit_longquestion()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"long_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_longquestions',$data);    
    }
  }
//================================Save edit data of long Questions===========================
public function save_edit_long()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_long($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}

//==================================save msqs======================================
public function save_mcq_question()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      $que=$this->input->post('question');

            $o1=$this->input->post('options1');
            $o2=$this->input->post('options2');
            $o3=$this->input->post('options3');
            $o4=$this->input->post('options4');
            $correct=$this->input->post('correct');
       $count=count($que);
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question' => $que[$i],
                          'option1' => $o1[$i],
                          'option2' => $o2[$i],
                          'option3' => $o3[$i],
                          'option4' => $o4[$i],
                          'correct_answer' => $correct[$i],
            );
          $this->db->insert('mcq_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of MCQ's====================================
public function  edit_mcq()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"mcq_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_mcq',$data);    
    }
  }
//================================Save edit data of MCQ's===========================
public function save_edit_mcq()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_mcq($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}

//========================================save general questions(Fill in Blanks)====================================
public function GeneralQuestion()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      $que=$this->input->post('question');
      $correct=$this->input->post('correct');
      $count=count($que);
      $type="4";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'fill_blank_question' => $que[$i],
                          'fill_blank_ans' => $correct[$i],
            );
          $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of MCQ's====================================
public function  edit_fill()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_fill',$data);    
    }
  }
//================================Save edit data of MCQ's===========================
public function save_edit_fill()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_fill($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}
//=================================save Paragraph question=====================================
public function save_paragraph_question()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      $que=$this->input->post('question');
      $count=count($que);
      $type="5";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'paragraph' => $que[$i],
                          
            );
     $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of Paragraph Questions====================================
public function  edit_paragraph()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_paragraph',$data);    
    }
  }
//================================Save edit data of Paragraph Questions===========================
public function save_edit_paragraph()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_paragraph($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}
//=================================save Letter question=====================================
public function save_Letter_question()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      //var_dump($data);die();
      $que=$this->input->post('question');
      $count=count($que);
      $type="6";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'letter' => $que[$i],
                          
            );
           // var_dump($Name);die();
     $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of letter Questions====================================
public function  edit_letter()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_letter',$data);    
    }
  }
//================================Save edit data of Letter Questions===========================
public function save_edit_letter()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_letter($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}


//=================================save Application question=====================================
public function save_Application_question()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      $que=$this->input->post('question');
      $count=count($que);
      $type="7";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'application' => $que[$i],
                          
            );
     $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of Application Questions====================================
public function  edit_application()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_application',$data);    
    }
  }
//================================Save edit data of Letter Questions===========================
public function save_edit_application()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_application($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}

//=================================save Summary question=====================================
public function save_Summary_question()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      $que=$this->input->post('question');
      $count=count($que);
      $type="8";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'summary' => $que[$i],
                          
            );
     $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of Summary Questions====================================
public function  edit_summary()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_summary',$data);    
    }
  }
//================================Save edit data of Letter Questions===========================
public function save_edit_summary()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_summary($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}

//=================================save Essay question=====================================
public function save_Essay_question()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      //var_dump($data);die();
      $que=$this->input->post('question');
      $count=count($que);
      $type="9";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'essay' => $que[$i],
                          
            );
           // var_dump($Name);die();
     $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of Essay Questions====================================
public function  edit_essay()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_essay',$data);    
    }
  }
//================================Save edit data of Letter Questions===========================
public function save_edit_essay()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_essay($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}

//=================================save Poem question=====================================
public function save_Poem_question()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      //var_dump($data);die();
      $que=$this->input->post('question');
      $count=count($que);
      $type="10";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'poem' => $que[$i],
                          
            );
     $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of Poem Questions====================================
public function  edit_poem()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_poem',$data);    
    }
  }
//================================Save edit data of Letter Questions===========================
public function save_edit_poem()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_poem($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}

//=================================save Singular and Plural question=====================================
public function save_Singular_Plural_question()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      //var_dump("<pre>",$data);die();
      $que=$this->input->post('question');
      $que1=$this->input->post('question1');
      //var_dump("<pre>",$que,$que1);die();
      $count=count($que);
      $type="11";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'singular' => $que[$i],
                          'plural' => $que1[$i],
            );
           // var_dump($Name);die();
     $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of sp====================================
public function edit_sp()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_sp',$data);    
    }
  }
//================================Save edit data of Ideoms===========================
public function save_edit_sp()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_sp($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}
//=================================save Opposites question=====================================
public function save_Opposites_question()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      //var_dump("<pre>",$data);die();
      $que=$this->input->post('question');
      $que1=$this->input->post('question1');
      //var_dump("<pre>",$que,$que1);die();
      $count=count($que);
      $type="12";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'opposites' => $que[$i],
                          'opposites_ans' => $que1[$i],
            );
           // var_dump($Name);die();
     $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of Opposites====================================
public function edit_opposites()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_opposites',$data);    
    }
  }
//================================Save edit data of Opposites===========================
public function save_edit_opposites()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_opposites($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}
//==================================save Centeral Idea question===========================
public function save_centeral_idea()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      $que=$this->input->post('question');
       $count=count($que);
       $type="13";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'centeral_idea' => $que[$i],
            );
            //var_dump($Name);die();
      $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of Centeral Idea====================================
public function edit_centeralidea()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_centeralidea',$data);    
    }
  }
//================================Save edit data of Centeral Idea===========================
public function save_edit_centeralidea()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_centeralidea($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}

//==================================save Translate into eng===========================
public function save_translate_eng()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      $que=$this->input->post('question');
       $count=count($que);
       $type="14";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'translate_english' => $que[$i],
            );
            //var_dump($Name);die();
      $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of Translate into Eng====================================
public function edit_translateintoeng()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_translateintoeng',$data);    
    }
  }
//================================Save edit data of Translate Into English===========================
public function save_edit_eng()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_eng($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}

//==================================save Word for making sentence===========================
public function save_wordforsentence()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      $que=$this->input->post('question');
       $count=count($que);
       $type="15";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'wordforsentence' => $que[$i],
            );
            //var_dump($Name);die();
      $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of Sentence====================================
public function edit_sentence()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_sentence',$data);    
    }
  }
//================================Save edit data of Make Sentence to Words===========================
public function save_edit_sentence()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_sentence($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}

//=================================save Words question=====================================
public function save_words_meanings()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      $que=$this->input->post('question');
      $que1=$this->input->post('question1');
      $count=count($que);
      $type="16";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'words' => $que[$i],
                          'meanings' => $que1[$i],
            );

     $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of WM====================================
public function edit_wm()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_wm',$data);    
    }
  }
//================================Save edit data of Opposites===========================
public function save_edit_wm()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_wm($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}

//=================================save Superlative question=====================================
public function save_superlative()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      $que=$this->input->post('question');
      $que1=$this->input->post('question1');
      $count=count($que);
      $type="17";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'adjective' => $que[$i],
                          'superlative' => $que1[$i],
            );
     $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of sd====================================
public function edit_sd()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_sd',$data);    
    }
  }
//================================Save edit data of Opposites===========================
public function save_edit_sd()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_sd($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}

//=================================save Ideoms question=====================================
public function save_ideoms_question()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      //var_dump($data);die();
      $que=$this->input->post('question');
      $count=count($que);
      $type="18";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'ideoms' => $que[$i],
                          
            );
           // var_dump($Name);die();
     $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of Ideoms====================================
public function edit_ideoms()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_ideoms',$data);    
    }
  }
//================================Save edit data of Ideoms===========================
public function save_edit_ideoms()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_ideoms($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}

//=================================save True false question=====================================
public function save_truefalse()
{
  if($this->input->post())
    {
      $data=$this->input->post();
      //var_dump("<pre>",$data);die();
      $que=$this->input->post('question');
      $que1=$this->input->post('question1');
      //var_dump("<pre>",$que,$que1);die();
      $count=count($que);
      $type="19";
      for($i=0;$i<$count;$i++)
        {
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'section' => $data['section'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question_type' => $type,
                          'true_words' => $que[$i],
                          'false_words' => $que1[$i],
            );
           // var_dump($Name);die();
     $this->db->insert('general_questions',$Name);
    }
    redirect('autopaper/question','refresh');
  }
  else
  {
    redirect('autopaper/question','refresh');
  }
}
//===================================================edit view of tf====================================
public function edit_tf()
  {
    if($this->uri->segment(3))
    {
      $id=$this->uri->segment(3);
      $data['val']=$this->autopaper_model->edit_chapter($id,"general_questions");
      $data['class']=$this->autopaper_model->all("class");
      $data['subject']=$this->autopaper_model->all("subject");
      $data['chapter']=$this->autopaper_model->all("chapters");
      $data['is_super'] = $this->user_model->is_super();
      $data['menu'] = $this->load_model->menu();
      $branch=$this->user_model->getbranch();
      if($this->user_model->is_super())
              $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
      else
              $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
              $data['base_url'] = base_url();
              $data['userInfo'] = $this->userInfo;
              $this->load->view('header',$data);
              $this->load->view('sidebar',$data);
              $this->load->view('autopaper/edit_tf',$data);    
    }
  }
//================================Save edit data of Opposites===========================
public function save_edit_tf()
{
     if($this->input->post()){
        $data = $this->input->post();
        $db_insert = $this->autopaper_model->save_edit_tf($data);
        redirect("autopaper/question","refresh");
    }
    else{
        redirect("autopaper/question","refresh");
    }  
}

//======================================question selection====================================
public function  question_selection()
{
        //$this->user_model->check_permissions("autopaper/chapter");
         $data['is_super'] = $this->user_model->is_super();
         $data['menu'] = $this->load_model->menu();
         $branch=$this->user_model->getbranch();
            if($this->user_model->is_super())
                $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
            else
                $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
         $data['base_url'] = base_url();
         $data['userInfo'] = $this->userInfo;
         $this->load->view('header',$data);
         $this->load->view('sidebar',$data);
         $this->load->view('autopaper/question_selection',$data);
}
  public function get_question_print()
  {
    if($this->input->post())
    {
      //var_dump("<pre>",$this->input->post());die();
      $branch=$this->user_model->getBranch();
      $data['data']=$this->input->post();
      $class=$this->input->post('class');
      $subject=$this->input->post('subject');
      $data['b_header']= $this->db->query("SELECT * FROM `branch` WHERE is_delete='0' AND id='$branch'")->row_array();
      $data['classes']= $this->db->query("SELECT class_name FROM `class`  WHERE class.is_delete='0'  AND class_id=$class")->row_array();
      $data['subject']= $this->db->query("SELECT name FROM `subject`  WHERE subject.is_deleted='0'  AND id=$subject")->row_array();
      $this->load->view('autopaper/paper_print',$data);
    }
    else
    {
      redirect('autopaper/question_selection','refresh'); 
    }
  }
/*======================================================================*/

public function delete_question($tbl="",$id=0)

	{
	//var_dump($tbl,$id);die();
	$this->db->where('id', $id);
	$b= $this->db->delete("$tbl");	
	if($b==TRUE){
	redirect('autopaper/question','refresh'); 
	}
	
	
	}
}
