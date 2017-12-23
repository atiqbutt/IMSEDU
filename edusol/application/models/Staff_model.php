<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  staff
 * @author      Atif Razzaq
 * @link        http://atifrazzaq.arteck.xyz
 */

class staff_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Staff_model','mo');
    }
                //saving data into sql
	public function save($data)
	{
 
            $fields_staff = array(

                            'branch' =>  $data['branch'],
                            'firstname' => $data['firstname'],
                            'lastname' => $data['lastname'] ,
                            'cnic'=>$data['cnic'] ,
                            'contact'=>$data['contact']  , 
                            'salery' => $data['salery'] ,
                            'security' => $data['security'] ,

                            'designation' => $data['designation']  ,
                            'qualification' => $data['qualification']  ,
                            'dob' => $data['dob']  ,
                            'doj' => $data['doj']  ,
                            'address' => $data['address']  ,
                    
                );
              
             return $this->db->insert('staff',$fields_staff);
                 
	}

            //updatin data in sql
public function update($data)
    {
           $id=$data['id'];
 
            $fields_staff = array(

                            'branch' =>  $data['branch'],
                            'firstname' => $data['firstname'],
                            'lastname' => $data['lastname'] ,
                            'cnic'=>$data['cnic'] ,
                            'contact'=>$data['contact']  , 
                            'salery' => $data['salery'] ,
                            'security' => $data['security'] ,

                            'designation' => $data['designation']  ,
                            'qualification' => $data['qualification']  ,
                            'dob' => $data['dob']  ,
                            'doj' => $data['doj']  ,
                            'address' => $data['address']  ,
                    
                );
                    $this->db->where('id',$id);
             return $this->db->update('staff',$fields_staff);
                 
    }
            //getting record to show
    public function show()
    {
                                     $this->db->where('is_delete',0) ;
                       $staff_view=$this->db->get('staff')->result();
                       return $staff_view;
    } 

        public function status_update($data)
    {
        
          
         $staff_id=$data['staff'];

            $fields_staff = array(

                            'status' =>  $data['status'],
                    
                );

                    $this->db->where('id',$staff_id);
             return $this->db->update('staff',$fields_staff);
                 


    }
    public function rollback($id){

                                $fields_staff = array(
                                        'status'=>'0'
                                    );
                    $this->db->where('id',$id);
             return $this->db->update('staff',$fields_staff);
                
    }
      public function all($id)
    {
        $var=$this->user_model->is_super();
        if(!$var)
        {
            $data=$this->db->where('status',0)->where('branch',$id)->get("staff")->result_array();
        }else
        {
            $data=$this->db->get("staff")->result_array();
        }
        return $data;
    }
    public function staffatt_save($data)
    {
         $this->db->insert('staffatt',$data);
         return true;
    }
    public function staffatt_del($value=0)
    {
        $data=array('is_deleted' => 1  );
        $this->db->where('id', $value);    
        $this->db->update('staffatt', $data);
        return true;
    }
    public function staffatt_edit($value=0)
    {
        $this->db->select('staff.firstname,staff.lastname,staff.contact,staff.designation,attendancestatus.status,attendancestatus.id as statusid ,staffatt.id,staffatt.date');    
        $this->db->from('staffatt');
        $this->db->join('staff', 'staffatt.staff_id = staff.id');
        $this->db->join('attendancestatus', 'attendancestatus.id = staffatt.status_id');
        $this->db->where('is_deleted',0 )->where('staffatt.id',$value);
        $query = $this->db->get();
       return $query;
    }
    public function staffattupdate($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('staffatt',$data);
        return true;
    }
public function staffall()
    {
        $data=$this->db->get("staff")->result_array();
        return $data;
    }
     public function id($value=0)
    {
        $this->db->where('status',0)->where('id',$value) ;
      return $this->db->get('staff')->result_array();
    }


}

