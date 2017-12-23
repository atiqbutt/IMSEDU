<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class salary_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
       public function Advance_teacher($value="")
       {
        $this->db->select('advancesal.id,advancesal.refrence,teacher.firstname,teacher.lastname,advancesal.Amount,advancesal.month');    
        $this->db->from('advancesal');
        $this->db->join('teacher', 'teacher.id=advancesal.bothid');
        $this->db->where('advancesal.refrence',$value )->where('advancesal.is_delete',0)->where('advancesal.is_used',0);
        $query = $this->db->get();
        return $query->result_array();
       }  
        public function Advance_staff($value="")
       {
        $this->db->select('advancesal.id,advancesal.refrence,staff.firstname,staff.lastname,advancesal.Amount,advancesal.month');    
        $this->db->from('advancesal');
        $this->db->join('staff', 'staff.id=advancesal.bothid');
        $this->db->where('advancesal.refrence',$value )->where('advancesal.is_delete',0)->where('advancesal.is_used',0);
        $query = $this->db->get();
        return $query->result_array();
       } 
       public function advance1_teacher($ref,$val)
       {
        
        $this->db->select('advancesal.id,advancesal.refrence,teacher.firstname,teacher.lastname,advancesal.Amount,advancesal.month');    
        $this->db->from('advancesal');
        $this->db->join('teacher', 'teacher.id=advancesal.bothid');
        $this->db->where('advancesal.refrence',$ref )->where('advancesal.bothid',$val)->where('advancesal.is_delete',0)->where('advancesal.is_used',0);
        $query = $this->db->get();
        
        return $query->result_array();
       }
        public function advance1_staff($ref,$val)
       {
        
        $this->db->select('advancesal.id,advancesal.refrence,staff.firstname,staff.lastname,advancesal.Amount,advancesal.month');    
        $this->db->from('advancesal');
        $this->db->join('staff', 'staff.id=advancesal.bothid');
        $this->db->where('advancesal.refrence',$ref )->where('advancesal.bothid',$val)->where('advancesal.is_delete',0)->where('advancesal.is_used',0);
        $query = $this->db->get();
        return $query->result_array();
       }
       public function id($val)
       {   
           $this->db->select('refrence'); 
            $this->db->from('advancesal');
           $this->db->where('id',$val);
           $data =$this->db->get();
           $query=$data->result_array()[0];
           $ref= implode(" ",$query);
           if($ref=="teacher"){
                $this->db->select('advancesal.id,advancesal.refrence,teacher.id as tid,teacher.firstname,teacher.lastname,advancesal.Amount,advancesal.month');    
                $this->db->from('advancesal');
                $this->db->join('teacher', 'teacher.id=advancesal.bothid');
                $this->db->where('advancesal.refrence',$ref )->where('advancesal.id',$val)->where('advancesal.is_delete',0)->where('advancesal.is_used',0);
                $query = $this->db->get();
                return $query->result_array()[0];
               
           }else if($ref=="staff"){
               $this->db->select('advancesal.id,advancesal.refrence,staff.id as tid,staff.firstname,staff.lastname,advancesal.Amount,advancesal.month');    
                $this->db->from('advancesal');
                $this->db->join('staff', 'staff.id=advancesal.bothid');
                $this->db->where('advancesal.refrence',$ref )->where('advancesal.id',$val)->where('advancesal.is_delete',0)->where('advancesal.is_used',0);
                $query = $this->db->get();
                return $query->result_array()[0];
           }
       }
       public function teacher_data($limit=0,$offset=0)
       {
        $branch=$this->user_model->getbranch();
        $this->db->select('assign_allowance.id,teacher.firstname,teacher.lastname,assign_allowance.refrence,allonce.name,assign_allowance.amount,assign_allowance.month');    
        $this->db->from('assign_allowance');
        $this->db->join('teacher', 'teacher.id=assign_allowance.bothid');
        $this->db->join('allonce', 'allonce.id=assign_allowance.allowance_id');
        $this->db->where('assign_allowance.status',0)->where('assign_allowance.is_delete',0)->where('assign_allowance.refrence','teacher')->where('teacher.branch',$branch);
        $query = $this->db->limit($limit,$offset)->get();
        return $query->result_array();
       }
        public function staff_data($limit=0,$offset=0)
       {
           
        $branch=$this->user_model->getbranch();
        
        $this->db->select('assign_allowance.id,staff.firstname,staff.lastname,assign_allowance.refrence,allonce.name,assign_allowance.amount,assign_allowance.month');    
        $this->db->from('assign_allowance');
        $this->db->join('staff', 'staff.id=assign_allowance.bothid');
        $this->db->join('allonce', 'allonce.id=assign_allowance.allowance_id');
        $this->db->where('assign_allowance.status',0)->where('assign_allowance.is_delete',0)->where('assign_allowance.refrence','staff')->where('staff.branch',$branch);
        $query = $this->db->limit($limit,$offset)->get();
        return $query->result_array();
        }
       public function count($t="",$ref="")
       {
          $branch=$this->user_model->getbranch();
           $this->db->select('*');
           $this->db->from($t);
           $data=$this->db->where('is_delete',0)->where('refrence',$ref)->where('status',0)->get();
           $count=count($data->result_array());
           return $count;           
       }
       public function count_salery($t="",$ref="")
       {
           $this->db->select('*');
           $this->db->from($t);
           $data=$this->db->where('is_delete',0)->where('refrence',$ref)->get();
           $count=count($data->result_array());
           return $count;           
       }
       public function teacher_deduction($limit,$offset)
       {
            $branch=$this->user_model->getbranch();
        
        $this->db->select('deduction.id,teacher.firstname,teacher.lastname,deduction.refrence,deduction.reason,deduction.amount,deduction.month');    
        $this->db->from('deduction');
        $this->db->join('teacher', 'teacher.id=deduction.bothid');
        $this->db->where('deduction.status',0)->where('deduction.is_delete',0)->where('deduction.refrence','teacher')->where('teacher.branch',$branch);
        $query = $this->db->limit($limit,$offset)->get();
        return $query->result_array();
       }
       public function staff_deduction($limit,$offset)
       {
            $branch=$this->user_model->getbranch();
        
        $this->db->select('deduction.id,staff.firstname,staff.lastname,deduction.refrence,deduction.reason,deduction.amount,deduction.month');    
        $this->db->from('deduction');
        $this->db->join('staff', 'staff.id=deduction.bothid');
        $this->db->where('deduction.status',0)->where('deduction.is_delete',0)->where('deduction.refrence','staff')->where('staff.branch',$branch);
        $query = $this->db->limit($limit,$offset)->get();
        return $query->result_array();
       }
       public function teacher_security_view($limit,$offset)
       {
         $branch=$this->user_model->getbranch();
        $this->db->select('security_deduct.id,teacher.firstname,teacher.lastname,security_deduct.refrence,security_deduct.security_amount,security_deduct.detuct_amount,security_deduct.remendar_amount,security_deduct.month');    
        $this->db->from('security_deduct');
        $this->db->join('teacher', 'teacher.id=security_deduct.bothid');
        $this->db->where('security_deduct.status',0)->where('teacher.branch',$branch)->where('security_deduct.is_delete',0)->where('security_deduct.refrence','teacher');
        $query = $this->db->limit($limit,$offset)->get();
         return $query->result_array();
        //   var_dump($query->result_array());die();
       }
       public function staff_security_view($limit,$offset)
       {
        $this->db->select('security_deduct.id,staff.firstname,staff.lastname,security_deduct.refrence,security_deduct.security_amount,security_deduct.detuct_amount,security_deduct.remendar_amount,security_deduct.month');    
        $this->db->from('security_deduct');
        $this->db->join('staff', 'staff.id=security_deduct.bothid');
        $this->db->where('security_deduct.status',0)->where('security_deduct.is_delete',0)->where('security_deduct.refrence','staff');
        $query = $this->db->limit($limit,$offset)->get();
         return $query->result_array();
        //   var_dump($query->result_array());die();
       }
       public function get_assign_allonce($ref="",$month="0000-00")
       {
           if($ref=="teacher"){
           $this->db->select('assign_allowance.bothid,sum(assign_allowance.amount) as amount');
           $this->db->from('assign_allowance');
           $this->db->join('teacher','teacher.id=assign_allowance.bothid');
           $this->db->group_by('assign_allowance.bothid');
           $this->db->where('assign_allowance.refrence',$ref)->where('assign_allowance.month',$month)->where('assign_allowance.is_delete',0);
           $data=$this->db->get()->result_array();
           return $data;
           }
           else if($ref=="staff"){
            $this->db->select('assign_allowance.bothid,sum(assign_allowance.amount) as amount');
           $this->db->from('assign_allowance');
           $this->db->join('staff','staff.id=assign_allowance.bothid');
            $this->db->group_by('assign_allowance.bothid');
           $this->db->where('assign_allowance.refrence',$ref)->where('assign_allowance.month',$month)->where('assign_allowance.is_delete',0);
           $data=$this->db->get()->result_array();
           return $data;
           }
       }
        public function get_assign_allonce_id($ref="",$month="0000-00",$id=0)
       {
           if($ref=="teacher"){
           $this->db->select('allonce.name,assign_allowance.bothid,assign_allowance.allowance_id,assign_allowance.amount');
           $this->db->from('assign_allowance');
           $this->db->join('allonce','allonce.id=assign_allowance.allowance_id');
           $this->db->join('teacher','teacher.id=assign_allowance.bothid');
           $this->db->where('assign_allowance.refrence',$ref)->where('assign_allowance.month',$month)->where('bothid',$id)->where('assign_allowance.is_delete',0);
           $data=$this->db->get()->result_array();
           return $data;
           }
           else if($ref=="staff"){
            $this->db->select('assign_allowance.bothid,assign_allowance.allowance_id,assign_allowance.amount');
           $this->db->from('assign_allowance');
           $this->db->join('allonce','allonce.id=assign_allowance.allowance_id');
           $this->db->join('staff','staff.id=assign_allowance.bothid');
            $this->db->group_by('assign_allowance.bothid,assign_allowance.allowance_id');
           $this->db->where('assign_allowance.refrence',$ref)->where('assign_allowance.month',$month)->where('bothid',$id)->where('assign_allowance.is_delete',0);
           $data=$this->db->get()->result_array();
           return $data;
           }
       }
       public function all_emp($ref="")
       {
          
           $id=$this->user_model->getbranch();
           if($ref=="teacher"){
            $data=$this->db->select('firstname,lastname,id as empid,salery')->where('is_delete',0)->where('branch',$id)->where('left(doj,7)!=',date("Y-m"))->where('status',0)->get("teacher")->result_array();
            return $data;
        }else if($ref=="staff"){
            $data=$this->db->select('firstname,lastname,id as empid,salery')->where('status',0)->where('branch',$id)->where('left(doj,7)!=',date("Y-m"))->get("staff")->result_array();
            return $data;
        }
       }
       public function advance_all($ref="",$month="0000-00")
       {
           if($ref=="teacher"){
               $this->db->select('id as advancesalid ,bothid,sum(Amount) as totaladvance');
               $this->db->from('advancesal');
               $this->db->group_by('bothid');
               $data=$this->db->where('is_delete',0)->where('refrence',$ref)->where('month',$month)->get()->result_array();
            return $data;
           }else if($ref=="staff"){
                    $this->db->select('id as advancesalid ,bothid,sum(Amount) as totaladvance');
               $this->db->from('advancesal');
               $this->db->group_by('bothid');
               $data=$this->db->where('is_delete',0)->where('refrence',$ref)->where('month',$month)->get()->result_array();
                 return $data;
           }
       }
       public function advance_all_id($ref="",$month="0000-00",$id=0)
       {
           if($ref=="teacher"){
               $this->db->select('id as advancesalid ,bothid,Amount as totaladvance');
               $this->db->from('advancesal');
               $data=$this->db->where('is_delete',0)->where('bothid',$id)->where('refrence',$ref)->where('month',$month)->get()->result_array();
            return $data;
           }else if($ref=="staff"){
                    $this->db->select('id as advancesalid ,bothid,sum(Amount) as totaladvance');
               $this->db->from('advancesal');
               $this->db->group_by('bothid');
               $data=$this->db->where('is_delete',0)->where('bothid',$id)->where('refrence',$ref)->where('month',$month)->get()->result_array();
                 return $data;
           }
       }
        public function deduction_all($ref="",$month="0000-00")
       {
$branch=$this->user_model->getbranch();
           if($ref=="teacher"){
               $data=$this->db->select('deduction.id AS deductionid, deduction.bothid, Amount')->from('deduction')->join('teacher','teacher.id=deduction.bothid')->where(' deduction.is_delete',0)->where(' teacher.branch',$branch)->where('refrence',$ref)->where('month',$month)->group_by('deduction.bothid')->get()->result_array();
            return $data;
           }else if($ref=="staff"){
                $data=$this->db->select('deduction.id AS deductionid, deduction.bothid, Amount')->from('deduction')->join('staff','staff.id=deduction.bothid')->where(' deduction.is_delete',0)->where('staff.branch',$branch)->where('refrence',$ref)->where('month',$month)->group_by('deduction.bothid')->get()->result_array();
            return $data;
           }
       }
        public function deduction_all_id($ref="",$month="0000-00",$id=0)
       {
           if($ref=="teacher"){
               $data=$this->db->select('id as deductionid ,bothid,Amount,reason')->where('bothid',$id)->where('is_delete',0)->where('refrence',$ref)->where('month',$month)->get("deduction")->result_array();
            return $data;
           }else if($ref=="staff"){
                $data=$this->db->select('id as advancesalid ,bothid,Amount')->where('bothid',$id)->where('is_delete',0)->where('refrence',$ref)->where('month',$month)->get("deduction")->result_array();
            return $data;
           }
       }
        public function security_all($ref="",$month="0000-00")
       {
           if($ref=="teacher"){
               $data=$this->db->select('id as securityid,detuct_amount,bothid')->where('is_delete',0)->where('refrence',$ref)->where('month',$month)->get("security_deduct")->result_array();
            return $data;
           }else if($ref=="staff"){
                $data=$this->db->select('id as securityid,detuct_amount,bothid')->where('is_delete',0)->where('refrence',$ref)->where('month',$month)->get("security_deduct")->result_array();
            return $data;
           }
       }
         public function security_all_id($ref="",$month="0000-00",$id=0)
       {
           if($ref=="teacher"){
               $data=$this->db->select('id as securityid,detuct_amount,bothid')->where('bothid',$id)->where('is_delete',0)->where('refrence',$ref)->where('month',$month)->get("security_deduct")->result_array();
            return $data;
           }else if($ref=="staff"){
                $data=$this->db->select('id as securityid,detuct_amount,bothid')->where('bothid',$id)->where('is_delete',0)->where('refrence',$ref)->where('month',$month)->get("security_deduct")->result_array();
            return $data;
           }
       }
       public function get($t='',$month="0000-00",$type)
       {
           $branch=$this->user_model->getbranch();
           $this->db->select('*');
          return $this->db->where('is_delete',0)->where('month',$month)->where('refrence',$type)->where('branch',$branch)->get($t)->result_array();
       }
       public function Teacher_salary($limit=0,$offset=0)
       {
           $this->db->select('salary.id,salary.month,salary.refrence,salary.total_amount,teacher.salery,teacher.firstname,teacher.lastname');
           $this->db->from('salary');
           $this->db->join('teacher','teacher.id=salary.bothid');
           $this->db->where('salary.refrence','teacher')->where('salary.is_delete',0);
          $query=$this->db->limit($limit,$offset)->get()->result_array();
          return $query;
       }
        public function staff_salary($limit=0,$offset=0)
       {
           $this->db->select('salary.id,salary.month,salary.refrence,salary.total_amount,staff.salery,staff.firstname,staff.lastname');
           $this->db->from('salary');
           $this->db->join('staff','staff.id=salary.bothid');
           $this->db->where('salary.refrence','staff')->where('salary.is_delete',0);
          $query=$this->db->limit($limit,$offset)->get()->result_array();
          return $query;
       }
        public function Teacher_salary1($v='')
       {
           $this->db->select('salary.id,salary.month,salary.refrence,salary.total_amount,teacher.salery,teacher.firstname,teacher.lastname');
           $this->db->from('salary');
           $this->db->join('teacher','teacher.id=salary.bothid');
           $this->db->where('salary.refrence','teacher')->where('salary.is_delete',0);
          $query=$this->db->like('teacher.firstname',$v)->or_like('teacher.lastname',$v)->or_like('salary.month',$v)->get()->result_array();
          return $query;
       }
       public function staff_salary1($v='')
       {
           $this->db->select('salary.id,salary.month,salary.refrence,salary.total_amount,staff.salery,staff.firstname,staff.lastname');
           $this->db->from('salary');
           $this->db->join('staff','staff.id=salary.bothid');
           $this->db->where('salary.refrence','staff')->where('salary.is_delete',0);
          $query=$this->db->like('staff.firstname',$v)->or_like('staff.lastname',$v)->or_like('salary.month',$v)->get()->result_array();
          return $query;
       }
      public function emp_id($ref="",$id=0)
       {
           
           if($ref=="teacher"){
            $data=$this->db->select('firstname,lastname,id as empid,cnic,contact,salery,designation')->where('is_delete',0)->where('id',$id)->where('status',0)->get("teacher")->result_array()[0];
            return $data;
        }else if($ref=="staff"){
            $data=$this->db->select('firstname,lastname,id as empid,cnic,contact,salery,designation')->where('status',0)->where('id',$id)->get("staff")->result_array()[0];
            return $data;
        }
       }
        public function salary_emp($ref="",$month="0000-00")
       {
$branch=$this->user_model->getbranch();
           if($ref=="teacher"){
               $this->db->select('teacher.firstname,teacher.lastname,teacher.designation,teacher.doj,teacher.salery,salary.bothid as empid,salary.id,salary.is_paid');
               $this->db->from('salary');
               $this->db->join('teacher','teacher.id=salary.bothid');
$this->db->where('salary.refrence',$ref)->where('salary.month',$month)->where('teacher.branch',$branch)->where('salary.branch',$branch)->where('salary.is_delete',0);
               $result=$this->db->get()->result_array();
               return $result;
           }else if($ref=="staff"){
               $this->db->select('staff.firstname,staff.lastname,staff.designation,staff.doj,staff.salery,salary.bothid as empid,salary.id,salary.is_paid');
               $this->db->from('salary');
               $this->db->join('staff','staff.id=salary.bothid')->where('salary.refrence',$ref)->where('staff.branch',$branch)->where('salary.month',$month)->where('salary.is_delete',0);
               $result=$this->db->get()->result_array();
               return $result;
           }
       }
         public function update_salary($id=0)
       {
           $field = array('is_paid' =>1 );
           $this->db->where('id',$id);
           $this->db->update('salary',$field);
           return true;
       }
        
       }