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
public function save_short_question($data)
{
  
          //var_dump($Name);
          return $this->db->insert('short_questions',$data);
}
public function save_long_question($data)
{
  
          //var_dump($Name);
          return $this->db->insert('long_questions',$data);
}    

}

