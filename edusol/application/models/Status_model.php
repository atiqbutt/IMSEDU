<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class status_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function save($data)
	{
          $fields_teacher = array(

                            'name' =>  $data['name'],
                            'branch' =>  $data['branch'],
                            'type' =>  $data['type'],
                            'description' =>  $data['description'],
                            
                );
              
             return $this->db->insert('status',$fields_teacher);
   
                 
	}

    public function status_update($data)
    {
           $id=$data['id'];
           $fields_teacher = array(

                            'name' =>  $data['name'],
                            'description' => $data['description'],
                    
                );

                    $this->db->where('id',$id);
             return $this->db->update('status',$fields_teacher);
                 


    }
    public function delete($id)
    {
                   $fields_s = array(

                            'is_delete' =>  '1',
                );
                     $this->db->where('id',$id);
             return $this->db->update('status',$fields_s);

    }
   

}

