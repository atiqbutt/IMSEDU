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

class certificate_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function select_student($data)
    {
         $branch=$data['branch'];
         $class=$data['class'];
         $section=$data['section'];
         $certificate=$data['certificate'];

        $this->db->where('student.branch',$branch);
        $this->db->where('promotion.class_id',$class);
        $this->db->where('promotion.section_id',$section);
        if($data['for_student']=='active'){
            $this->db->where('student.status','0');
        }elseif($data['for_student']=='deactive') {
            $this->db->where('student.status!=','0');
        }
        $this->db->select('student.id,grno,roll_no,student_name');
        $this->db->from('student');
        $this->db->join('promotion','promotion.student_id=student.id');
        return $this->db->get()->result();

    }



            //saving data into sql
	public function save($data)
	{
 
            $fields_class = array(

                            'branch' =>  $data['branch'],
                            'class_name' => $data['class_name'],
                            'description' => $data['description'] ,
                            'tution_fee'=>$data['tution_fee'] 
                );
              
             return $this->db->insert('class',$fields_class);
                 
	}


        public function getcertificate()
    {
                $this->db->where('is_delete','0');
       return   $this->db->get('certificate')->result();
                
    }
    public function add_leave_info($data)
    {
        $fields_leave_info = array(


                            'branch' =>  $data['branch'],
                            //'class' => $data['class'],
                            //'section' => $data['section'] ,
                            'std_id'=>$data['student'], 
                            'conduct'=>$data['conduct'], 
                            'progress'=>$data['progress'], 
                            'dol'=>$data['dol'], 
                            'rol'=>$data['rol'], 
                            'remain_days'=>$data['remain_days'], 
                            'total_days'=>$data['total_days'], 
                            'remarks'=>$data['remarks'] 
                );
       return $this->db->insert('leave_info',$fields_leave_info);
            

    }
    public function add_provisional_info($data)
    {
        $fields_provisional_info= array(


                            'branch' =>  $data['branch'],
                            'std_id'=>$data['student'], 
                            'examination'=>$data['exam'], 
                            'seat_no'=>$data['seat'], 
                            'grade'=>$data['grade'], 
                            'marks'=>$data['marks']
                );
       return $this->db->insert('pro_info',$fields_provisional_info);
            

    }
    public function edit_provisional_info($data)
    {
        $fields_provisional_info = array(


                            'branch' =>  $data['branch'],
                            //'class' => $data['class'],
                            //'section' => $data['section'] ,
                            'std_id'=>$data['student'], 
                            'examination'=>$data['exam'], 
                            'seat_no'=>$data['seat'], 
                            'grade'=>$data['grade'], 
                            'marks'=>$data['marks'], 
                );
       return $this->db->insert('pro_info',$fields_provisional_info);
            

    }

        //updating data into sql
public function deactive($id)
    {
 
            $field = array(

                            'is_active' =>  '0', 
                );
                    $this->db->where('id',$id);
             return $this->db->update('certificate',$field);
                 
    }
    public function active($id)
    {
 
            $field = array(

                            'is_active' =>  '1', 
                );
                    $this->db->where('id',$id);
             return $this->db->update('certificate',$field);

                 
    }
    //
   public function edit_leave_info($id)
   {
                    
                       $this->db->where('id',$id);
                $leave = $this->db->get('leave_info')->result_array();
   }

   public function check_fee_status($std_id='')
   {
       if($std_id!='') {
           $pro_id=$this->db->select('promotion.id as pro_id')->join('promotion','student.id=promotion.student_id')->where('student.id',$std_id)->where('promotion.is_active',1)->where('promotion.is_delete',0)->order_by('promotion.id','DESC')->get('student')->row_array()['pro_id'];
           $this->load->model('voucher_model');
           $pro_id_array=$this->voucher_model->getPromotionArray($pro_id);
           $last_v=$this->db->where_in('student_id',$pro_id_array)->where('is_delete',0)->order_by('id','DESC')->limit(1)->get('invoice')->row_array();
           if($last_v['status']==1){
               return true;
           }
           else{
               return false;
           }
       }
   }
    

}

