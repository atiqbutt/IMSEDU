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
class city extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("city_model");
        $this->user_model->check_login("admin");

        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

     public function index($q="all",$p=1)
    {
        $this->user_model->check_permissions("city/index");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        

        $q = urldecode($q);
        $p = $p<1?1:$p;
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
          $sq1 = "";
        if($q!="all")
        {
            $sq1 .= "AND (province.province_name like '%".$q."%' OR ";
            $sq1 .= "district.name like '%".$q."%' OR ";
            $sq1 .= "city.city_name like '%".$q."%' OR "; 
            $sq1 .= "country.country_name like '%".$q."%' )";
        }
        $total = $this->db->query("SELECT count(*) as total FROM `city` inner join `district` on district.id = city.district_id inner join `province` on province.province_id = city.city_id  inner join `country` on country.country_id = city.country_id where city.is_delete='0' $sq1")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT *  FROM `city` inner join `district` on district.id = city.district_id inner join `province` on province.province_id = city.city_id  inner join `country` on country.country_id = city.country_id where city.is_delete='0' $sq1 LIMIT 0, $per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT *  FROM `city` inner join `district` on district.id = city.district_id inner join `province` on province.province_id = city.city_id  inner join `country` on country.country_id = city.country_id where city.is_delete='0' $sq1 LIMIT $offset, $per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;         
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['province'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
            //calling views
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('city/city',$data);
    }

    public function save()
    {
        if($this->input->post())
        {
            $data = $this->input->post();
            $db_insert = $this->city_model->save($data);
            redirect("city/index","refresh");
        }
        else
        {
            redirect("city/index","refresh");
            
        }
    }

   //  public function edit()
   //  {
   //           $data['menu'] = $this->load_model->menu();
   //           $id = $this->uri->segment(3);
   //           $data['district']=$this->district_model->edit($id);
   //           // $data['val']= $this->db->where('class_id',$id)->get('class')->result();
   //           $data['userInfo'] = $this->userInfo;
   //           $data['base_url'] = base_url();
             
   //           $this->load->view('header',$data);
   //           $this->load->view('sidebar',$data);
   //           $this->load->view('district/district_edit',$data);


      
   //  }

   //  public function update()
   //  {
   //      $data = $this->input->post();
   //      $db_update = $this->district_model->update($data);
       
   //      redirect("district/index","refresh");


   // }
   public function delete()
   {
        if($this->uri->segment(3))
        {
            $id=$this->uri->segment(3);
            $this->city_model->delete($id);
            redirect('city/index','refresh');   
        }
        else
        {
            redirect('city/index','refresh');   
          
        }
       
   }

}
