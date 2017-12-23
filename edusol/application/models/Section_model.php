<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  section
 * @author      Atif Razzaq
 * @link        http://atifrazzaq.arteck.xyz
 */

class section_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
            // saving data in sql
	public function save($data)
	{
            
            $fields_section = array(

                            'branch' =>  $data['branch'],
                            'section_name' => $data['section_name'],
                            'description' => $data['description'] ,
                            'class_id'=>$data['class_id'] 
                );
              
             return $this->db->insert('section',$fields_section);
             
	}


/*public function update($data)
    {
           $id=$data['id'];
 
            $fields_class = array(

                            'branch' =>  $data['branch'],
                            'class_name' => $data['class_name'],
                            'description' => $data['description'] ,
                            'tution_fee'=>$data['tution_fee'] 
                );
                    $this->db->where('class_id',$id);
             return $this->db->update('class',$fields_class);
                 
    }
*/
    // updating section 1 in delete
   public function delete($id){

                                $fields_class=array('is_delete'=>'1');
                $this->db->where('section_id',$id);
                return $this->db->update('section',$fields_class);
   }
    

}

