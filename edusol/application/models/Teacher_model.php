<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * teacher Class
 *
 * @package     edusol
 * @subpackage  teacher
 * @author      Atif Razzaq
 * @link        http://atifrazzaq.arteck.xyz
 */
class teacher_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function all()
{
    $branchid=$this->user_model->getbranch();
    $data=$this->db->where('branch',$branchid)->where('status',0)->get('teacher')->result_array();
    return $data;
}
public function AttendanceStatus()
{
    $data=$this->db->get('attendancestatus')->result_array();
    return $data;
}
            //save method for save data in sql
	//public function save($data,$url)
	public function save($data)
	{
                //getting values from form
            $fields_teacher = array(

                            'branch' =>  $data['branch'],
                            'firstname' => $data['firstname'],
                            'lastname' => $data['lastname'] ,
                            'cnic'=>$data['cnic'] ,
                            'contact'=>$data['contact']  ,
                           // 'security' => $data['security'] ,
                            'salery' => $data['salery'] ,
                            'designation' => $data['designation']  ,
                            'qualification' => $data['qualification']  ,
                            'specialization' => $data['specialization']  ,
                            'dob' => $data['dob']  ,
                            'doj' => $data['doj']  ,
                            //'img' => $url ,
                            'address' => $data['address']  ,
                    
                );
              
             return $this->db->insert('teacher',$fields_teacher);
                 
	}
	
	public function best_teachers($data)
	{
	    $this->db->truncate('best_teachers');
	    for( $i = 0; $i < count($data["teacher_id"]);  $i++ ) {
            
                $fields_teacher = array(

                            'teacher_id' =>  $data["teacher_id"][$i]
                );
              $this->db->insert('best_teachers',$fields_teacher);
           }
	}

            //update for teacher update with given id
//public function update($data,$url)
public function update($data)
    {
           $id=$data['id'];

            $fields_teacher = array(

                            'branch' =>  $data['branch'],
                            'firstname' => $data['firstname'],
                            'lastname' => $data['lastname'] ,
                            'cnic'=>$data['cnic'] ,
                            'contact'=>$data['contact']  , 
                            'salery' => $data['salery'] ,
                            //'security' => $data['security'] ,
                            'designation' => $data['designation']  ,
                            'qualification' => $data['qualification']  ,
                            'specialization' => $data['specialization']  ,
                            'dob' => $data['dob']  ,
                            'doj' => $data['doj']  ,
                            //'img' => $url  ,                            
                            'address' => $data['address']  ,
                    
                );
                    $this->db->where('id',$id);
             return $this->db->update('teacher',$fields_teacher);
                 
    }
            // getting data from teacher tabel 
    public function show()
    {
             $this->db->where('is_delete',0) ;
      return $this->db->get('teacher')->result();
                      
    } 
public function id($value=0)
    {
        $this->db->where('is_delete',0)->where('id',$value) ;
      return $this->db->get('teacher')->result();
    }
                  //for updating teacher status
    public function status_update($data)
    {
        $teacher_id=$data['teacher'];

            $fields_teacher = array(

                            'status' =>  $data['status'],
                );

                    $this->db->where('id',$teacher_id);
             return $this->db->update('teacher',$fields_teacher);
                 


    }
        // going back to 0 position
    public function rollback($id){

                                $fields_teacher = array(
                                        'status'=>'0'
                                    );
                    $this->db->where('id',$id);
             return $this->db->update('teacher',$fields_teacher);
                
    }
    public function saveattendace($data)
{
    $this->db->insert('teacherattendance',$data);
    return true;
}
 public function edit($value=0)
 {
   $data=  $this->db->query("SELECT teacherattendance.id,teacherattendance.date, teacher.firstname,attendancestatus.id as statusid,teacher.specialization,teacher.lastname,teacher.contact,attendancestatus.status,teacherattendance.date FROM `teacherattendance` inner join teacher on teacherattendance.teacher_id=teacher.id INNER join attendancestatus on attendancestatus.id=teacherattendance.status_id WHERE teacherattendance.id='$value' and is_deleted='0'");
   return $data;
 }
 public function del($value=0)
 {
        $data=array('is_deleted' => 1  );
        $this->db->where('id', $value);    
        $this->db->update('teacherattendance', $data);
        return true;
 }
public function updateAttendace($data,$id)
{
    $this->db->where('id',$id);
              $this->db->update('teacherattendance',$data);
              return true;
}

}

