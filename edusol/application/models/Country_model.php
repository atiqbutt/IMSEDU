<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  country
 * @author      Atif Razzaq
 * @link        http://atifrazzaq.arteck.xyz
 */

class country_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	
      // for saving data in sql
    public function save($data)
	{
            
            $fields_country = array(

                            'country_name' =>  $data['country'],
                );
              
             return $this->db->insert('country',$fields_country);
             
	}

    public function edit($id)
    {
           
            $this->db->where('country_id',$id);
     return $this->db->get('country')->result();


    }
      // for updating data
    public function update($data)
    {
           $id=$data['id'];
            $fields_country = array(
                                      'country_name' =>  $data['country'],
                );
              
                    $this->db->where('country_id',$id);
             return $this->db->update('country',$fields_country);
                 
    }
    // for deleting ->update recourd 0 to 1
   public function delete($id){

                $fields_country=array('is_delete'=>'1');
                $this->db->where('country_id',$id);
                return $this->db->update('country',$fields_country);
   }
    

}

