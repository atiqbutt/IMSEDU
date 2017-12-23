<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  class
 * @author      Atif Razzaq
 * @link        http://atifrazzaq.arteck.xyz
 */
class Classes extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("class_model");
        $this->user_model->check_login("admin");
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }


   public function index($q="all",$p=1)
    {
        $this->user_model->check_permissions("classes/index");
        $q = urldecode($q);
        $p = $p<1?1:$p;
        
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $b=$this->user_model->getbranch();
        
         $sq = "";
        if($q!="all")
        {
            $sq .= "AND (class.class_name like '%".$q."%' OR "; 
            $sq .= "class.tution_fee like '%".$q."%' )";
        }

        $sq1 = "";
        if($q!="all")
        {
            $sq1 .= "AND (class.class_name like '%".$q."%' OR "; 
            $sq1 .= "class.tution_fee like '%".$q."%' )";
        }
        $total = $this->db->query("SELECT count(*) as total FROM `class` where is_delete='0' AND branch=$b $sq")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT * FROM `class` WHERE class.branch = '$b' AND class.is_delete='0'  $sq1 LIMIT 0, $per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT * FROM `class`   WHERE class.branch = '$b' AND class.is_delete='0'  $sq1 LIMIT $offset, $per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;

        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['teachers'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
                // calling view pages
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('clases/class_view',$data);
    }
            // class insertion view
     public function create()
    {
        $this->user_model->check_permissions("classes/index");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
            //calling view pages
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('clases/class_add',$data);
    }

    public function save()
    {
        if($this->input->post())
        {

            $data = $this->input->post();
            $db_insert = $this->class_model->save($data);
            redirect("classes/create","refresh");   
        }
        else
        {
            redirect("classes/create","refresh");   

        }
    }

    public function edit()
    {       
            if($this->uri->segment(3))
            {  $branch=$this->user_model->getbranch();
                     if($this->user_model->is_super())
                        $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result_array();
                     else
                        $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result_array();
            
             $data['menu'] = $this->load_model->menu();
             $id = $this->uri->segment(3);
             $data['values']= $this->db->where('class_id',$id)->get('class')->result_array()[0];
             $data['userInfo'] = $this->userInfo;
             $data['base_url'] = base_url();
             
             $this->load->view('header',$data);
             $this->load->view('sidebar',$data);
             $this->load->view('clases/class_edit',$data);
            }
            else
            {
                redirect("classes/index","refresh");
            }
             

      
    }

    public function update()
    {
        if($this->input->post())
        {
            $data = $this->input->post();
            $db_update = $this->class_model->update($data);
            redirect("classes/index","refresh");
    
        }
        else
        {
            redirect("classes/index","refresh");

        }
        

   }
   public function delete()
   {
            
        if($this->uri->segment(3))
        {
            $id=$this->uri->segment(3);
            $this->class_model->delete($id);
            redirect('classes/index','refresh');    
        }
        else
        {
            redirect('classes/index','refresh');    

        }
       
   }
public function view_section()
{
       //$this->user_model->check_permissions("classes/index");
           if($this->uri->segment(3)){
                $id=$this->uri->segment(3);
                 $data['section']=$this->db->query("SELECT * From `section` inner join `class` on class.class_id=section.class_id where section.class_id='$id' AND `section`.`is_delete`='0'")->result_array();
                 
                 $data['menu'] = $this->load_model->menu();
                 $data['base_url'] = base_url();
                  $data['userInfo'] = $this->userInfo;
            //calling view pages
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('clases/view_sections',$data);
}
}
public function students()
{
           if($this->uri->segment(3)){
                $id=$this->uri->segment(3);
                $branch=$this->user_model->getbranch();
                 $data['student']=$this->db->query("SELECT student.*,class.*,section.*,student.id as stid FROM student JOIN promotion ON promotion.student_id=student.id JOIN class ON promotion.class_id=class.class_id JOIN section ON promotion.section_id=section.section_id WHERE student.branch = '$branch' AND student.status='0' AND promotion.is_active='1' AND promotion.section_id='$id'")->result_array();
                 
                 $data['menu'] = $this->load_model->menu();
                 $data['is_super'] = $this->user_model->is_super();
                 $data['base_url'] = base_url();
                  $data['userInfo'] = $this->userInfo;
            //calling view pages
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('clases/student_view',$data);

}
}

}

