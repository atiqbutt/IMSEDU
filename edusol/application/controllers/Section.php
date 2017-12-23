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
class section extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("section_model");
        $this->user_model->check_login("admin");
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

   public function index($q="all",$p=1)
    {
        $this->user_model->check_permissions("section/index");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $branch=$this->user_model->getbranch();
           $q = urldecode($q);
            $p = $p<1?1:$p;
             $sq = "";
        if($q!="all")
        {
            $sq .= "AND (section.section_name like '%".$q."%' OR "; 
            $sq .= "section.description like '%".$q."%' )";
        }

         $sq1 = "";
        if($q!="all")
        {
            $sq1 .= "AND (section.section_name like '%".$q."%' OR "; 
            $sq1 .= "class.class_name like '%".$q."%' )";
        }
         $total = $this->db->query("SELECT count(*) as total FROM `section` where is_delete='0' AND branch='$branch' $sq")->result_array()[0]['total'];
         
        $query = $this->db->query("SELECT class.class_name,section.description,section.section_id,section.section_name FROM `section` inner join `class` on class.class_id=section.class_id  WHERE section.branch = '$branch' AND section.is_delete='0'  $sq1 LIMIT $offset, $per_page");

        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;

        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['teachers'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
            //calling view pages
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('section/section_view',$data);

     
    }
                // for view insertion page
     public function create()
    {
        $this->user_model->check_permissions("section/index");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
          // calling view pages
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('section/section_add',$data);
    }
            // for saving data
    public function save()
    {
        if($this->input->post())
        {
            $data = $this->input->post();
            $db_insert = $this->section_model->save($data);
            redirect("section/create","refresh");
           
        }
        else
        {
            redirect("section/create","refresh");

        }
        
    }

    public function edit()
    {
             $data['menu'] = $this->load_model->menu();
             $id = $this->uri->segment(3);
             $data['classes']=$this->db->where('is_delete',0)->get('class')->result_array();
             $data['section']= $this->db->where('section_id',$id)->get('section')->row_array();
             $data['userInfo'] = $this->userInfo;
             $data['base_url'] = base_url();
            
             $this->load->view('header',$data);
             $this->load->view('sidebar',$data);
             $this->load->view('section/section_edit',$data);
    }

    public function update()
    {
        $data = $this->input->post();
        $section=$data['section_id'];
        $this->db->where('section_id',$section);
        $this->db->update('section',$data);
        redirect("section/index","refresh");
   }
        // for update is delete to 1
   public function delete()
   {
        if($this->uri->segment(3))
        {
            $id=$this->uri->segment(3);
            $this->section_model->delete($id);
            redirect('section/index','refresh');    
        }
        else
        {
            redirect('section/index','refresh');    

        }
        
   }

}
