<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class subject_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function suball()
    {
        
         $this->db->select('subject.id,section.section_name, subject.name,class.class_name')->from('subject')
        ->join('class','class.class_id=subject.class_id')->join('section','section.section_id=subject.section_id')
        ->where('is_deleted',0);
        $data=$this->db->get()->result_array();
        return $data;
        
    }
    public function savesubject($data)
    {
        $s = array('name' => $data['subname'],
                    'class_id'=>$data['class'],
                    'section_id'=>$data['section'],
                    );
        $this->db->insert('subject',$s);
        return true;
    }
    public function del($id=0)
    {
        $data=array('is_deleted' => 1 );
        $this->db->where('id', $id);    
        $this->db->update('subject', $data);
        return true;
    }
    public function id($value=0)
    {
        $data=$this->db->where('id',$value)->get('subject');
        return $data;
    }
    public function update($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('subject',$data);
        return true;
    }
    public function insertalloc($data)
    {
        $this->db->insert('teacheralloc',$data);
        return true;
    }
    public function allocdel($value=0)
    {
        $data=array('is_deleted' => 1 );
        $this->db->where('id', $value);    
        $this->db->update('teacheralloc', $data);
        return true;
    }
    public function allocedit($value=0)
    {
        $this->db->select("teacheralloc.id,teacheralloc.teacher_id ,teacheralloc.subject_id ,teacheralloc.class_id,teacheralloc.section_id,teacher.firstname,teacher.lastname,class.class_name,section.section_name,subject.name as subname"); 
        $this->db->from('teacheralloc');
        $this->db->join('teacher', 'teacheralloc.teacher_id=teacher.id');
        $this->db->join('class', 'class.class_id=teacheralloc.class_id');
        $this->db->join('section', 'section.section_id=teacheralloc.section_id');
        $this->db->join('subject', 'subject.id=teacheralloc.subject_id');
        $this->db->where('teacheralloc.is_deleted',0)->where('teacheralloc.id',$value);
        $query = $this->db->get();
        return $query;
    }
    public function subjectagainstclorsec($cl=0,$se=0)
    {
        $data=$this->db->query("SELECT id,name FROM `subject` WHERE class_id='$cl' and section_id='$se'")->result_array();
        return $data;
    }
    public function updatealloc($data,$id)
    {
        //var_dump($id,$data);
        $this->db->where('id',$id);
        $this->db->update('teacheralloc',$data);
        return true;
    }

}