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

class class_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
            //saving data into sql
	public function save($data)
	{
 
            $fields_class = array(

                            'branch' =>  $data['branch'],
                            'class_name' => $data['class_name'],
                            'description' => $data['description'] ,
                            'tution_fee'=>$data['tution_fee'] ,
                            'admin_fee'=>$data['admin_fee'] 
                );
              
             return $this->db->insert('class',$fields_class);
                 
	}

        //updating data into sql
public function update($data)
    {
           $id=$data['id'];
 
            $fields_class = array(

                            'branch' =>  $data['branch'],
                            'class_name' => $data['class_name'],
                            'description' => $data['description'] ,
                            'tution_fee'=>$data['tution_fee']  ,
                            'admin_fee'=>$data['admin_fee'] 
                );
                    $this->db->where('class_id',$id);
             return $this->db->update('class',$fields_class);
                 
    }
    //
   public function delete($id)
   {
                    
                       $fields_class=array('is_delete'=>'1');
                       $this->db->where('class_id',$id);
                return $this->db->update('class',$fields_class);
   }
    

}

