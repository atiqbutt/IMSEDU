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

class country extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("country_model");
        $this->user_model->check_login("admin");
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

     public function index($q="all",$p=1)
    {
        $this->user_model->check_permissions("country/index");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $branch=$this->user_model->getbranch();
           $q = urldecode($q);
            $p = $p<1?1:$p;
         $sq1 = "";
        if($q!="all")
        {
            $sq1 .= "AND (country_name like '%".$q."%' OR "; 
            $sq1 .= "country_id like '%".$q."%' )";
        }
          $total = $this->db->query("SELECT count(*) as total FROM `country` where is_delete='0' $sq1")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT * FROM `country` WHERE  is_delete='0'  $sq1 LIMIT 0, $per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT * FROM `country` WHERE  is_delete='0'  $sq1 LIMIT $offset, $per_page");
          $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['country'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
                //calling view pages
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('country/country',$data);
    }

    public function save()
    {
        if($this->input->post())
            {
                $data = $this->input->post();
                $db_insert = $this->country_model->save($data);
                redirect("country/index","refresh"); 
            }
        else
            {
                redirect("country/index","refresh"); 

            }
        
    }

    public function edit()
    {
        if($this->uri->segment(3))
            {
                $data['menu'] = $this->load_model->menu();
                $id = $this->uri->segment(3);
                $data['country']=$this->country_model->edit($id);
                $data['userInfo'] = $this->userInfo;
                $data['base_url'] = base_url();
                    //calling view pages
                $this->load->view('header',$data);
                $this->load->view('sidebar',$data);
                $this->load->view('country/country_edit',$data);

            }
         else
         {
                redirect("country/index","refresh"); 

         }   
             

      
    }

    public function update()
    {
        if($this->input->post())
        {
            $data = $this->input->post();
            $db_update = $this->country_model->update($data);
            redirect("country/index","refresh");
    
        }
        else
        {
            redirect("country/index","refresh");
        }
        

   }
   public function delete()
   {
        if($this->uri->segment(3))
        {
            $id=$this->uri->segment(3);
            $this->country_model->delete($id);
            redirect('country/index','refresh');
     
        }
        else
        {
            redirect('country/index','refresh');
            
        }
          }

}
