<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Performance_model extends CI_Model{
     
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function allkey()
    {
        $this->db->from('keyresponsibility');
        $this->db->where('is_deleted', 0 );
        $query = $this->db->get();
        return $query;
    }
    public function all()
    {
        $this->db->from('attributes');
        $this->db->where('is_deleted', 0 );
        $query = $this->db->get();
        return $query;
    }
    public function savekey($data)
    {
        $this->db->insert('keyresponsibility', $data);
        return $data;
    }
    public function saveattribute($data)
    {
        $this->db->insert('attributes', $data);
        return $data;
    }
    public function attributedel($value=0)
    {

        $data=array('is_deleted' => 1 );
        $this->db->where('id', $value);    
        $this->db->update('attributes', $data);
        return true;
    }
    public function id($value=0)
    {
        $this->db->select('*');
        $this->db->from('attributes')->where('id',$value);
        $query = $this->db->get()->result_array();
        return $query;
    }
    public function updateattribute($data,$value=0)
    {
         $this->db->where('id',$value);
         $this->db->update('attributes',$data);
         return true;
    }
    public function idkey($value=0)
    {
        $this->db->select('*');
        $this->db->from('keyresponsibility')->where('id',$value);
        $query = $this->db->get()->result_array();
        return $query;
    }
     public function keydel($value=0)
    {

        $data=array('is_deleted' => 1 );
        $this->db->where('id', $value);    
        $this->db->update('keyresponsibility', $data);
        return true;
    }
    public function updatekey($data,$value=0)
    {
         $this->db->where('id',$value);
         $this->db->update('keyresponsibility',$data);
         return true;
    }
    public function reviewtype()
    {
        return $this->db->from("reviewtype")->get()->result_array();
    }
    public function saveemp($data)
    {
        $this->db->insert("emp_info",$data);
        return true;
    }
    public function Get_info_teacher($ref='',$val=0)
    {
        $this->db->select("emp_info.id,teacher.firstname,teacher.lastname,teacher.designation,teacher.doj,teacher.salery,emp_info.grade,emp_info.department,emp_info.Contract_type,emp_info.Contract_end,emp_info.confirmation_due,emp_info.tottaltenure,emp_info.tottaltenure,emp_info.benifits,emp_info.review_period"); 
        $this->db->from('emp_info');
        $this->db->join('teacher', 'teacher.id=emp_info.employe_id');
       
        $this->db->where('emp_info.id',$val)->where('emp_info.type',$ref);
        $query = $this->db->get()->result_array()[0]; 
        return $query;  
    }
    public function Get_info_staff($ref='',$val=0)
    {
        $this->db->select("emp_info.id,staff.firstname,staff.lastname,staff.designation,staff.doj,staff.salery,emp_info.grade,emp_info.department,emp_info.Contract_type,emp_info.Contract_end,emp_info.confirmation_due,emp_info.tottaltenure,emp_info.tottaltenure,emp_info.benifits,emp_info.review_period"); 
        $this->db->from('emp_info');
        $this->db->join('staff', 'staff.id=emp_info.employe_id');
       
        $this->db->where('emp_info.id',$val)->where('emp_info.type',$ref);
        $query = $this->db->get()->result_array(); 
        return $query;  
    }
    public function Get_grade()
    {
        return $this->db->from("greades")->get()->result_array();
    }
    public function Get_attribute()
    {
        return $this->db->from("attributes")->where('is_deleted',0)->get()->result_array();
    }
    public function Get_keyresposbility()
    {
        return $this->db->from("keyresponsibility")->where('is_deleted',0)->get()->result_array();
    }
    public function save_apraise($data)
    {
         $this->db->insert("apraisedata",$data);
         return $this->db->insert_id();
    }
    public function Save_attri($data)
    {
       $this->db->insert("atributejunction",$data); 
    }
    public function Save_key($data)
    {
        $this->db->insert("keyjunction",$data); 
    }
    public function All_apraise()
    {
        $this->db->from('apraisedata');
        $this->db->where('is_deleted', 0 );
        $query = $this->db->get();
        return $query;
    }
    public function getteacher($ref="")
    {
        if($ref=="teacher")
        {
        $this->db->select("emp_info.type,apraisedata.id,teacher.firstname,teacher.lastname,teacher.designation,apraisedata.attritotalgrade,apraisedata.keytotalgrade,apraisedata.Aggregatescore,apraisedata.finalgrade"); 
        $this->db->from('apraisedata');
        $this->db->join('emp_info', 'emp_info.id=apraisedata.empid');
        $this->db->join('teacher ', 'teacher.id=emp_info.employe_id');
        $this->db->where('is_deleted',0)->where(' emp_info.type',$ref);
        $data = $this->db->get()->result_array();  
        return $data;
        }else if($ref=="staff"){
        $this->db->select("emp_info.type,apraisedata.id,staff.firstname,staff.lastname,staff.designation,apraisedata.attritotalgrade,apraisedata.keytotalgrade,apraisedata.Aggregatescore,apraisedata.finalgrade"); 
        $this->db->from('apraisedata');
        $this->db->join('emp_info', 'emp_info.id=apraisedata.empid');
        $this->db->join('staff ', 'staff.id=emp_info.employe_id');
        $this->db->where('is_deleted',0)->where(' emp_info.type',$ref);
        $query = $this->db->get()->result_array();  
        return $query;
        }else{
            return $query=null;

        }
    }
    public function getdata($ref='',$val=0)
    {
        if($ref=="teacher"){
        $this->db->select("apraisedata.type as reviewid,apraisedata.*,emp_info.*,emp_info.type as typedes,teacher.*"); 
        $this->db->from('apraisedata');
        $this->db->join('emp_info', 'emp_info.id=apraisedata.empid');
        $this->db->join('reviewtype ', 'reviewtype.id=apraisedata.type');
        $this->db->join('teacher  ', 'teacher.id=emp_info.employe_id');
        $this->db->where('is_deleted',0)->where('emp_info.type',$ref)->where('apraisedata.id',$val);
        $data = $this->db->get()->result_array()[0];  
        return $data;

        }else if($ref=="staff"){
            $this->db->select("apraisedata.type as reviewid,apraisedata.*,emp_info.*,emp_info.type as typedes,staff.*"); 
        $this->db->from('apraisedata');
        $this->db->join('emp_info', 'emp_info.id=apraisedata.empid');
        $this->db->join('reviewtype ', 'reviewtype.id=apraisedata.type');
        $this->db->join('staff  ', 'staff.id=emp_info.employe_id');
        $this->db->where('is_deleted',0)->where('emp_info.type',$ref)->where('apraisedata.id',$val);
        $data = $this->db->get()->result_array()[0]; 
        return $data;
        }
    }
    public function getattribute($value=0)
    {
        $this->db->select("attributes.*,gr.* "); 
        $this->db->from('atributejunction'); 
        $this->db->join('attributes ', 'attributes.id=atributejunction.atributeid');
        $this->db->join('greades gr ', 'gr.marks=atributejunction.gradeid');
       
        $this->db->where('atributejunction.apraiseid',$value);
        $data = $this->db->get()->result_array();
        return $data;
    }
    public function Get_keyrespon($value=0)
    {
        $this->db->select("keyresponsibility.*,keyjunction.*,gr.* "); 
        $this->db->from('keyjunction'); 
        $this->db->join('keyresponsibility ', 'keyresponsibility.id=keyjunction.keyresponseid');
        $this->db->join('greades gr ', 'gr.marks=keyjunction.gradeid');
       
        $this->db->where('keyjunction.apraiseid',$value);
        $data = $this->db->get()->result_array();
        return $data;
    }
    public function Appraise_del($value=0)
    {
         $data=array('is_deleted' => 1 );
        $this->db->where('id', $value);    
        $this->db->update('apraisedata', $data);
        return true;
    }
      public function checkteacher($ref="",$val=0)
    {
        
        $this->db->select('*');
        $this->db->from('emp_info');
        $this->db->where('employe_id', $val )->where('type',$ref);
        $query = $this->db->get()->result_array();
        $v=count($query);
        
        if($v>0){
            return false;}
            else{return true;}
   }
      public function checkstaff($ref="",$val=0){

           
           $this->db->select('*');
        $this->db->from('emp_info');
        $this->db->where('employe_id', $val )->where('type',$ref);
        $query = $this->db->get()->result_array();
        $v=count($query);
        if($v>0){
            return false;}
            else{return true;}
         }   

}