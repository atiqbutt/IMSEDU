<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  district
 * @author      Atif Razzaq
 * @link        http://atifrazzaq.arteck.xyz
 */

class district_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	
        //saving data in sql
    public function save($data)
	{
            $fields_district = array(

                            'province_id' =>  $data['province'],
                            'country_id' =>  $data['country'],
                            'name' =>  $data['district'],
                           
                );
              
             return $this->db->insert('district',$fields_district);
             
	}

    public function edit($id){
                $this->db->where('id',$id);
         return $this->db->get('district')->result();


    }
        // update the data
public function update($data)
    {
           $id=$data['id'];
 
           $fields_district = array(

                            'province_id' =>  $data['province'],
                            'country_id' =>  $data['country'],
                            'name' =>  $data['district'],
                           
                );
               
                    $this->db->where('id',$id);
             return $this->db->update('district',$fields_district);
                 
    }

    // updating record 0 to 1
   public function delete($id){

                $fields_district=array('is_delete'=>'1');
                $this->db->where('id',$id);
                return $this->db->update('district',$fields_district);
   }
    

}

