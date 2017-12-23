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

class Transport_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	
            //saving data in sql
    public function save_stop($data)
	{
            $fields_city = array(

                            'name' =>  $data['stop'],
                            'branch' =>  $data['branch'],
                            'description' =>  $data['description'],
                            'fee' =>  $data['fee'],
                            'city_id' =>  $data['city']
                           
                );
              
             return $this->db->insert('stop',$fields_city);
             
	}

    public function getstop()
     {
    //             $this->db->where('is_delete','0');
    //      return $this->db->get('stop')->result_array();
    //             $this->db->from('city',city.city_id=stop.city_id);


                   $this->db->where('stop.is_delete','0');
                   $this->db->from('stop');
                   $this->db->join('city', 'city.city_id=stop.city_id');
            return $this->db->get()->result_array();


    }
    public function get_student($gr)
    {
        //$this->db->where('status','0');
        $this->db->where('grno',$gr);
        $this->db->select("*"); 
        $this->db->from('student');
        $this->db->join('promotion', 'promotion.student_id=student.id');
        $this->db->join('class', 'promotion.class_id=class.class_id');
        // $this->db->join('section', 'promotion.section_id=section.section_id');
        $query=$this->db->get();
          
         if($query->num_rows() == 1)
         {
             $query=$query->result_array();
        }
        else{
            $query = 'false';
        }

        return $query;
    }

public function save_student_transport($data)
{
    $field = array(
                    'grno' => $data['grno'] , 
                    'student_id' => $data['id'], 
                    'stop_id' => $data['stop'], 
                    'is_active' => $data['status'] 
                   );
      return  $this->db->insert('transport',$field);
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
    public function deactive($id)
    {
 
            $field = array(

                            'is_active' =>  '0', 
                );
                    $this->db->where('id',$id);
             return $this->db->update('transport',$field);
                 
    }
    public function active($id)
    {
 
            $field = array(

                            'is_active' =>  '1', 
                );
                    $this->db->where('id',$id);
             return $this->db->update('transport',$field);

                 
    }

    // deleting record updating 0 to11
   public function delete($id)
   {
                 $fields_district=array('is_delete'=>'1');
                 $this->db->where('id',$id);
                return $this->db->update('stop',$fields_district);
   }
    public function delete_trans($id)
   {
                 $fields_district=array('is_delete'=>'1');
                 $this->db->where('id',$id);
                return $this->db->update('transport',$fields_district);
   }
    

}

