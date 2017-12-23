<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  class
 * @author      Atif Razzaq
 * @link        http://atifrazzaq.arteck.xyz
 */

class autopaper_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
public function save_question_type($data)
    {
 
            $fields = array(

                            'branch' =>  $data['branch'],
                            'name' => $data['name'],
                            'description' => $data['description']
                            
                );
                    
             return $this->db->insert('question_type',$fields);
                 
    }
    //
   public function delete_question_type($id)
   {
                    
                       $field=array('is_delete'=>'1');
                       $this->db->where('id',$id);
                return $this->db->update('question_type',$field);
   }
   public function edit_question_type($id)
   {
    $this->db->where('id',$id);
    return $this->db->get('question_type')->result_array();

   }
   public function update_question_type($data)
    {
        $id=$data['id'];
 
            $fields = array(

                            'branch' =>  $data['branch'],
                            'name' => $data['name'],
                            'description' => $data['description']
                            
                );
                    $this->db->where('id',$id);
             return $this->db->insert('question_type',$fields);
                 
    }

public function save_chapter($data)
{
    
        $fields = array(

                            'branch' =>  $data['branch'],
                            'class_id' =>  $data['class'],
                    
                            'subject_id' =>  $data['subject'],
                            'name' => $data['name'],
                            'chapterNo' => $data['chapter_no']
                            
                );
                    
             return $this->db->insert('chapters',$fields);


}
//==========================================edit view of chapters=========================
 public function edit_chapter($id,$tbl="")
   {
    $this->db->where('id',$id);
    return $this->db->get($tbl)->row_array();
   }
//=============================General Function=================================
    public function all($tbl='')
   {
       $this->db->select("*");
       $this->db->from($tbl);
       $rec=$this->db->get()->result_array();
      // var_dump($rec);die();
return $rec;
   }
//==============================save edit chapters==============================
 public function save_edit_chapter($data)
    {
            $id=$data['id'];
            $fields = array(
                            'branch' =>  $data['branch'],
                            'class_id' =>  $data['class'],
                            'subject_id' =>  $data['subject'],
                            'name' => $data['name'],
                            'chapterNo' => $data['chapter_no']
            );
            $this->db->where('id',$id);
            return $this->db->update('chapters',$fields);
    }
//==============================save edit chapters==============================
 public function save_edit_mcq($data)
    {
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $o1=$this->input->post('options1');
            $o2=$this->input->post('options2');
            $o3=$this->input->post('options3');
            $o4=$this->input->post('options4');
            $correct=$this->input->post('correct');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'question' => $que,
                            'option1' => $o1,
                            'option2' => $o2,
                            'option3' => $o3,
                            'option4' => $o4,
                            'correct_answer' => $correct,
                );
            $this->db->where('id',$id);
            return $this->db->update('mcq_questions',$Name);
    }
//==============================save edit Short Questions==============================
 public function save_edit_short($data)
    {
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question' => $que,
            );
            $this->db->where('id',$id);
            return $this->db->update('short_questions',$Name);
    }
   //==============================save edit Fill Questions==============================
 public function save_edit_fill($data)
    {
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'fill_blank_question' => $que,
            );
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit Long Questions==============================
 public function save_edit_long($data)
    {
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
          $Name = array(
                          'branch' => $data['branch'],
                          'class' => $data['class'],
                          'subject' => $data['subject'],
                          'chapter' => $data['chapter'],
                          'level' => $data['level'],
                          'question' => $que,
            );
            $this->db->where('id',$id);
            return $this->db->update('long_questions',$Name);
    }
//==============================save edit Paragraph Questions==============================
 public function save_edit_paragraph($data)
    {
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'paragraph' => $que,
                );
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit Letter Questions==============================
 public function save_edit_letter($data)
    {
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'letter' => $que,
                );
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit Application Questions==============================
 public function save_edit_application($data)
    {
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'application' => $que,
                );
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit Summary Questions==============================
 public function save_edit_summary($data)
    {
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'summary' => $que,
                );
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit Essay Questions==============================
 public function save_edit_essay($data)
    {
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'essay' => $que,
                );
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit Poem Questions==============================
 public function save_edit_poem($data)
    {
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'poem' => $que,
                );
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit Eng Translation Questions==============================
 public function save_edit_eng($data)
    {
        
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'translate_english' => $que,
                );
               // var_dump($Name);die();
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit Eng Translation Questions==============================
 public function save_edit_sentence($data)
    {
        
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'wordforsentence' => $que,
                );
               // var_dump($Name);die();
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit Centeral Idea Questions==============================
 public function save_edit_centeralidea($data)
    {
        
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'centeral_idea' => $que,
                );
               // var_dump($Name);die();
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit Ideoms Questions==============================
 public function save_edit_ideoms($data)
    {
        
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'ideoms' => $que,
                );
               // var_dump($Name);die();
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit Sp Questions==============================
 public function save_edit_sp($data)
    {
        
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $que1=$this->input->post('question1');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'singular' => $que,
                            'plural' => $que1,
                );
               // var_dump($Name);die();
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
    
    //==============================save edit Eng Translation Questions==============================
 public function save_edit_proverb($data)
    {
        
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'pro_verb' => $que,
                );
               // var_dump($Name);die();
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
    
    //==============================save edit Eng Translation Questions==============================
 public function save_edit_conservation($data)
    {
        
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'conversation' => $que,
                );
               // var_dump($Name);die();
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
    
    //==============================save edit Eng Translation Questions==============================
 public function save_edit_passage($data)
    {
        
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'passage' => $que,
                );
               // var_dump($Name);die();
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
    
//==============================save edit Opposites Questions==============================
 public function save_edit_opposites($data)
    {
        
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $que1=$this->input->post('question1');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'opposites' => $que,
                            'opposites_ans' => $que1,
                );
               // var_dump($Name);die();
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit WM Questions==============================
 public function save_edit_wm($data)
    {
        
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $que1=$this->input->post('question1');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'words' => $que,
                            'meanings' => $que1,
                );
               // var_dump($Name);die();
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit SD Questions==============================
 public function save_edit_sd($data)
    {
        
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $que1=$this->input->post('question1');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'adjective' => $que,
                            'superlative' => $que1,
                );
               // var_dump($Name);die();
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//==============================save edit tf Questions==============================
 public function save_edit_tf($data)
    {
        
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $que1=$this->input->post('question1');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'true_words' => $que,
                            'false_words' => $que1,
                );
               // var_dump($Name);die();
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }
//================================================================


public function save_short_question($data)
{
  
          //var_dump($Name);
          return $this->db->insert('short_questions',$data);
}

 //==============================save edit masculine Questions==============================
 public function save_edit_mf($data)
    {
        
            $id=$data['id'];
            $data=$this->input->post();
            $que=$this->input->post('question');
            $que1=$this->input->post('question1');
            $Name = array(
                            'branch' => $data['branch'],
                            'class' => $data['class'],
                            'subject' => $data['subject'],
                            'chapter' => $data['chapter'],
                            'level' => $data['level'],
                            'masculine' => $que,
                            'feminine' => $que1,
                );
               // var_dump($Name);die();
            $this->db->where('id',$id);
            return $this->db->update('general_questions',$Name);
    }

}

