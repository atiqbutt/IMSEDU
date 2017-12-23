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

class province extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("province_model");
        $this->user_model->check_login("admin");

        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

     public function index($q="all",$p=1)
    {
        $this->user_model->check_permissions("province/index");
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
            $sq1 .= "country.country_name like '%".$q."%' )";
        }
       $total = $this->db->query("SELECT count(*) as total FROM `province` inner join `country` on country.country_id = province.country_id  where province.is_delete='0' $sq1")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT *  FROM `province` inner join `country` on country.country_id = province.country_id  where province.is_delete='0' $sq1 LIMIT 0, $per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT *  FROM `province` inner join `country` on country.country_id = province.country_id  where province.is_delete='0' $sq1 LIMIT 0, $per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;      
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['province'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
                //for calling views
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('province/province',$data);
    }

    public function save()
    {
            if($this->input->post())
            {
                $data = $this->input->post();
                $db_insert = $this->province_model->save($data);
                redirect("province/index","refresh");
                
            }
            else
            {
                redirect("province/index","refresh");

            }
        
    }

    public function edit()
    {
                if($this->uri->segment(3))
                {
                     $data['menu'] = $this->load_model->menu();
                     $id = $this->uri->segment(3);
                     $data['province']=$this->province_model->edit($id);
                     $data['userInfo'] = $this->userInfo;
                     $data['base_url'] = base_url();
                            //for calling views             
                     $this->load->view('header',$data);
                     $this->load->view('sidebar',$data);
                     $this->load->view('province/province_edit',$data);
  
                }
                else
                {
                    redirect("province/index","refresh");

                }
            

      
    }

    public function update()
    {
        if($this->input->post())
        {
            $data = $this->input->post();
            $db_update = $this->province_model->update($data);
            redirect("province/index","refresh");
    
        }
        else
        {
            redirect("province/index","refresh");

        }
        

   }
   public function delete()
   {
        if($this->uri->segment(3))
        {       
           $id=$this->uri->segment(3);
           $this->province_model->delete($id);
           redirect('province/index','refresh');   
        }
        else
        {
           redirect('province/index','refresh');   

        }
   }

}
