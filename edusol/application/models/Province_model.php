<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  province
 * @author      Atif Razzaq
 * @link        http://atifrazzaq.arteck.xyz
 */


class province_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	
          // for inserting data in sql
    public function save($data)
	{
            $fields_province = array(
                                      'country_id' =>  $data['country'],
                                      'province_name' =>  $data['province'],
                           
                );
              
             return $this->db->insert('province',$fields_province);
             
	}
            //getting values in to edting form
    public function edit($id)
    {

                $this->db->where('province_id',$id);
        return $this->db->get('province')->result();


    }

public function update($data)
    {
           $id=$data['id'];
            $fields_province = array(
                            'country_id' =>  $data['country'],
                            'province_name' =>  $data['province'],
                           
                );
                   $this->db->where('province_id',$id);
             return $this->db->update('province',$fields_province);
                 
    }
    // deleting record updateing 0 to 1
   public function delete($id){

                $fields_province=array('is_delete'=>'1');
                $this->db->where('province_id',$id);
                return $this->db->update('province',$fields_province);
   }
    

}

