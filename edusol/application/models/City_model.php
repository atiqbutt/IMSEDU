<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  city
 * @author      Atif Razzaq
 * @link        http://atifrazzaq.arteck.xyz
 */

class city_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	
            //saving data in sql
    public function save($data)
	{
            $fields_city = array(

                            'city_name' =>  $data['city'],
                            'province_id' =>  $data['province'],
                            'country_id' =>  $data['country'],
                            'district_id' =>  $data['district'],
                           
                );
              
             return $this->db->insert('city',$fields_city);
             
	}

    public function edit($id)
    {
                $this->db->where('id',$id);
         return $this->db->get('district')->result();
    }

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
    // deleting record updating 0 to11
   public function delete($id)
   {
                 $fields_district=array('is_delete'=>'1');
                 $this->db->where('id',$id);
                return $this->db->update('district',$fields_district);
   }
    

}

