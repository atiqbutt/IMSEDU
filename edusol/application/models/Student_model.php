<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class student_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
         public function promotion_id($val=0)
    {
        $this->db->select('id');
        $data=$this->db->from('promotion')->where('student_id',$val)->where('is_active',1)->get()->result_array()[0]['id'];
       return $data;
    }
	public function save($data,$url)
	{
	$this->load->library('hajanasms');
        $branch = $data['branch'];
        $class = $data['class_id'];
        $section = $data['section'];
        $session = $data['session'];
        $disc_value = empty($data['disc_value'])?0:$data['disc_value'];
            $fields_student = array(

                            'branch' =>  $branch,
                            'grno' => $data['gr'],
                            'class_admited' => $data['class_admited'],
                            'student_name' => $data['name'] ,
                            'father_name'=>$data['fathername'] ,
                            'surname'=>$data['surname']  , 
                            'gender' => $data['gender'] ,
                            'guardian_name' => $data['guardianname']  ,
                            'previous_school' => $data['preschool']  ,
                            'relation_with_guardian' => $data['relationguardian']  ,
                            'father_cnic' => $data['fathercnic']  ,
                            'guardian_cnic' => $data['guardiancnic']  ,
                            'mark_identification' => $data['mark_of_identification']  ,
                            'religion' => $data['religion']  ,
                            'mother_tongue  ' => $data['mother_tongue']  ,
                            'dob' => date('Y-m-d',strtotime($data['dob']))  ,
                            'dob_words' => $data['dob_words'] ,
                            'date_of_admission' => date('Y-m-d',strtotime($data['doa'] )) ,
                            'taluka' => $data['taluka']  ,
                            'district' => $data['district']  ,
                            'father_occupation' => $data['fatheroccupation']  ,
                            'guardian_occupation' => $data['guardianoccupation']  ,
                            'income_family' => $data['familyincome']  ,
                            'img' => $url  ,
                            'perment_address' => $data['permentaddess']  ,
                            'postal_address' => $data['postaladdess']  ,
                            'father_contact' => $data['fathercontact']  ,
                            'student_contact' => $data['student_contact']  ,
                            'guardian_contact' => $data['guardiancontact']  ,
                            'disc_type' => $data['disc_type']  ,
                            'disc_value' => $disc_value
                    
                );
              
             $this->db->insert('student',$fields_student);

             $student = $this->db->insert_id();
             
             $student_info = $this->db->select('id, student_name, grno, student_contact')->from('student')->where('id', $student )->get()->row();
    
             $student_data = array(
               'student_id' => $student_info->id,
               'first_name' => $student_info->student_name ,
               'username' => $student_info->grno,
               'password' => md5('softvilla'),
               'contact_no' => $student_info->student_contact 
             );

            //$this->db->insert('admin', $student_data);

          $parent_data= array(
               'student_id' => $student_info->id,
               'first_name' => $student_info->student_name ,
               'username' => $student_info->grno . '_parent',
               'password' => md5('softvilla'),
               'contact_no' => $student_info->student_contact 
             );

             //$this->db->insert('admin', $parent_data); 

             $promotion = array(
                 'student_id' => $student,
                 'class_id' => $class,
                 'section_id' => $section,
                 'session_id' => $session
             );

             $this->db->insert('promotion',$promotion);
             $prom_id = $this->db->insert_id();

            $this->db->select("tution_fee,admin_fee");
            $this->db->where("is_delete",'0');
            $this->db->where("class_id",$class);
            $c_data = $this->db->get("class")->result_array()[0];
            $fee_pack = $c_data['tution_fee'];
            $admin_fee = $data['admin_fee'];

            $this->db->select("late_fine,due_date");
            $this->db->where("is_delete",'0');
            $this->db->where("id",$branch);
            $branch_data = $this->db->get("branch")->result_array()[0];
            $late_fine = $branch_data['late_fine'];


            $date = date("Y-m-d");
            $exp_date = date("Y-m-d", strtotime('+11 days'));

            $invoice = array(
                'branch_id' => $data['branch'],
                "student_id"=>$prom_id,
                "fee_pack"=>$fee_pack,
                "admin_fee"=>$admin_fee,
                "date"=>$date,
                "date_expire"=>$exp_date,
                "late_fine"=>$late_fine,
                "is_admitted"=>"1"
            );
            $this->db->insert("invoice",$invoice);
            $inv = $this->db->insert_id();
            if(@!empty($data['fee']))
            {
                foreach ($data['fee'] as $k => $d) {
                    $install = array(
                        'invoice' => $inv,
                        'amount' => $d['value'],
                        'fee_id' => $k
                    );
                    $this->db->insert('fee_installment',$install);
                }	
            }
            $msg="Dear Parents,\nIMS welcomes your child $data[name] to our school.\nThank You!";
            $this->hajanasms->sendOneNumber($data['fathercontact'],$msg);
             
	}



public function update($data,$url)
    {

           $id=$data['id'];
           $class = $data['class_id'];
           $section = $data['section'];
           $disc_value = empty($data['disc_value'])?0:$data['disc_value'];
           $pro=array( 'class_id'=>$class,
                        'section_id'=>$section,
                         'session_id'=>$data['session']

                     );
            $fields_student_update = array(

                            'branch' => $data['branch'],
                            'student_name' => $data['name'] ,
                            'father_name'=>$data['fathername'] ,
                            'class_admited' => $data['class_admited'],
                            'surname'=>$data['surname']  , 
                            'gender' => $data['gender'] ,
                            'guardian_name' => $data['guardianname'], 
                            'previous_school' => $data['preschool']  ,
                            'relation_with_guardian' => $data['relationguardian']  ,
                            'father_cnic' => $data['fathercnic']  ,
                            'guardian_cnic' => $data['guardiancnic']  ,
                            'mark_identification' => $data['mark_of_identification']  ,
                            'religion' => $data['religion']  ,
                            'mother_tongue  ' => $data['mother_tongue']  ,
                            'dob' => date('Y-m-d',strtotime($data['dob'])) ,
                            'dob_words' => $data['dob_words'] ,
                            'date_of_admission' => date('Y-m-d',strtotime($data['doa']))  ,
                            'taluka' => $data['taluka']  ,
                            'district' => $data['district']  ,
                            'father_occupation' => $data['fatheroccupation']  ,
                            'guardian_occupation' => $data['guardianoccupation']  ,
                            'income_family' => $data['familyincome']  ,
                             'img' => $url  ,
                            'perment_address' => $data['permentaddess']  ,
                            'postal_address' => $data['postaladdess']  ,
                            'father_contact' => $data['fathercontact']  ,
                            'student_contact' => $data['student_contact']  ,
                            'guardian_contact' => $data['guardiancontact']  ,
                            'disc_type' => $data['disc_type']  ,
                            'disc_value' => $disc_value
                    
                );
              
            
            $this->db->where('id',$id);
            $this->db->update('student',$fields_student_update);
            $this->db->where('student_id',$id);
            $this->db->where('is_active',1);
            $this->db->update('promotion',$pro);
            return true;
                 
    }

    public function show()
    {
                                     $this->db->where('is_delete',0) ;
                       $teacher_view=$this->db->get('teacher')->result();
                       return $teacher_view;
    } 

    public function status_update($data)
    {
        
         
          
         $student=$data['student'];
         $status=$data['status'];
         
            $fields = array(

                            'status' =>  $data['status'],
                );
                
          foreach ($student as $key => $selected_student) {
          	$this->db->where('id',$selected_student);
                $this->db->update('student',$fields);
          }
           return true;
    }
    
    public function rollback($id){

                                $field = array(
                                        'status'=>'0'
                                    );
                    $this->db->where('id',$id);
             return $this->db->update('student',$field);
                
    }
    public function student_infor($id){

          return $this->db->query("SELECT *  FROM `student` inner join `promotion` on promotion.student_id=student.id inner join `class` on promotion.class_id=class.class_id inner join `section` on promotion.section_id=section.section_id  where student.id=$id")->result_array();


    }
    public function getbranch()
    {
        $data=$this->db->where('is_delete',0)->get('branch');
        return $data;
    }
    public function all()
    {
        $this->db->select('student.id,student.student_name,student.roll_no,student.grno,class.class_name,section.section_name');    
        $this->db->from('student');
        $this->db->join('promotion', 'promotion.student_id=student.id');
        $this->db->join('class', 'promotion.class_id=class.class_id');
        $this->db->join('section', 'section.section_id=promotion.section_id')->where('student.status',0);
        $query = $this->db->get()->result_array();
        return $query;
    }
    public function studentatt_save($data)
    {
        $this->db->insert('studentatt',$data);
         return true;
    }
    public function studentatt_edit($value=0)
    {
            $this->db->select('s.student_name,studentatt.status_id,s.grno,s.roll_no,class.class_name,section.section_name,studentatt.date,studentatt.id,attendancestatus.status');    
            $this->db->from('studentatt');
            $this->db->join('student s', 'studentatt.student_id = s.id');
            $this->db->join('promotion', 'promotion.student_id=s.id');
            $this->db->join('class', 'promotion.class_id = class.class_id');
            $this->db->join('section', 'promotion.section_id = section.section_id');
            $this->db->join('attendancestatus', 'attendancestatus.id = studentatt.status_id');
            $this->db->where('is_deleted',0 )->where('studentatt.id',$value);
            $query = $this->db->get();
            return $query;
    }
    public function studentatt_del($value=0)
    {
        $data=array('is_deleted' => 1 );
        $this->db->where('id', $value);    
        $this->db->update('studentatt', $data);
        return true;
    }
    public function studentattupdate($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('studentatt',$data);
        return true;
    }
     public function id($value=0)
    {
         $this->db->select('*,student.id as stid');    
        $this->db->from('student');
        $this->db->join('promotion', 'promotion.student_id=student.id');
        $this->db->join('class', 'promotion.class_id=class.class_id');
        $this->db->join('branch', 'branch.id=class.branch');
        $this->db->join('section', 'section.section_id=promotion.section_id')->where('student.status',0)->where('student.id',$value)->where('promotion.is_active','1');
        $query = $this->db->get()->result_array()[0];
        return $query;
    }


}

