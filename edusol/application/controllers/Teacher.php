<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * teacher Class
 *
 * @package     edusol
 * @subpackage  teacher
 * @author      Atif Razzaq
 * @link        http://atifrazzaq.arteck.xyz
 */
class teacher extends CI_Controller {

    private $userInfo = array();


    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("teacher_model");
        $this->user_model->check_login("admin");

        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }
            //Index method for insertion of teacher
    public function index()
    {   
            //check permissions
        $this->user_model->check_permissions("teacher/index");
        $data['base_url'] = base_url();
            //menu and user information
        $data['menu'] = $this->load_model->menu();
        $data['userInfo'] = $this->userInfo;
        $branch=$this->user_model->getbranch();

            // For view pages
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('teacher/teacher_add',$data);
    }
             //show method is for showing teachers
    public function show($q="all",$p=1)
    {
        $this->user_model->check_permissions("teacher/show");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $branch=$this->user_model->getbranch();
        
        $q = urldecode($q);
        $p = $p<1?1:$p;
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        
        $sq1 = "";
        if($q!="all")
        {
            $sq1 .= "AND (firstname like '%".$q."%' OR "; 
            $sq1 .= "lastname like '%".$q."%' OR "; 
            $sq1 .= "designation like '%".$q."%' OR "; 
            $sq1 .= "contact like '%".$q."%' OR "; 
            $sq1 .= "specialization like '%".$q."%' )";
        }
        $total = $this->db->query("SELECT count(*) as total FROM `teacher` where status='0' AND branch=$branch AND is_delete='0' $sq1")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT id,designation,contact,qualification,doj,dob,salery,specialization FROM `teacher` WHERE branch = '$branch' AND status='0' AND is_delete='0'  $sq1 LIMIT 0, $per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT id,firstname,lastname,designation,contact,qualification,doj,dob,salery,specialization FROM `teacher` WHERE branch = '$branch' AND status='0' AND is_delete='0'  $sq1 LIMIT $offset, $per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;
        $data['teachers'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
            //calling view pages
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('teacher/teacher_view',$data);
    }
        //save method is for saving teachers
    public function save()
    {
        if($this->input->post())
        {
            //$url = $this->do_upload();
            $this->load->library('upload');
            $data = $this->input->post();
           // $db_insert = $this->teacher_model->save($data,$url);
             $db_insert = $this->teacher_model->save($data);
            redirect("teacher/index","refresh");
        }
        else
        {
            redirect("teacher/index","refresh");

        }
    }
                //edit method is for getting values and shoeing in form
    public function edit()
    {
            
             if($this->uri->segment(3))
             {

                $branch=$this->user_model->getbranch();
                    if($this->user_model->is_super())
                        $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result_array();
                    else
                        $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result_array();
            
                 $data['menu'] = $this->load_model->menu();
                 $id = $this->uri->segment(3);
                 $data['values']= $this->db->where('id',$id)->get('teacher')->result_array()[0];
                 $data['userInfo'] = $this->userInfo;
                 $data['base_url'] = base_url();
                  // calling pages view
                 $this->load->view('header',$data);
                 $this->load->view('sidebar',$data);
                 $this->load->view('teacher/teacher_edit',$data);

             }
             else
             {
                redirect("teacher/show");
             }
      
    }
            //update method is for updating teacher record
    public function update()
    {
 
        if($this->input->post()){
           //$url = $this->do_upload();

            $this->load->library('upload');
            
            $data = $this->input->post();
   
           // $db_update = $this->teacher_model->update($data,$url);
           $db_update = $this->teacher_model->update($data);
            redirect("teacher/show","refresh");
        }
        else
        {
            redirect("teacher/show","refresh");
        }

   }

    private function do_upload()
    {

        $type = explode('.', $_FILES['img']['name']);
        $type = $type[count($type)-1];
        $url = "./images/".uniqid(rand()).'.'.$type;
        if (in_array($type, array("png","jpg","jpeg","gif")))
            if(move_uploaded_file($_FILES["img"]["tmp_name"], $url))
                return $url;
        return ""; 
    }  
                      //status is for showing teacher status
   public function status($q="all",$p=1)
   {
        $this->user_model->check_permissions("teacher/status");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $branch=$this->user_model->getbranch();      

         $q = urldecode($q);
        $p = $p<1?1:$p;
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        
        $sq1 = "";
        if($q!="all")
        {
            $sq1 .= "AND (status.name like '%".$q."%' OR "; 
            $sq1 .= "teacher.firstname like '%".$q."%' OR ";
            $sq1 .= "teacher.lastname like '%".$q."%' OR ";
            $sq1 .= "teacher.designation like '%".$q."%' OR ";
            $sq1 .= "teacher.qualification like '%".$q."%' OR "; 
            $sq1 .= "teacher.contact like '%".$q."%' )";
        }

        $total = $this->db->query("SELECT count(*) as total FROM `teacher` inner join `status` on teacher.status = status.id   where teacher.is_delete='0' AND teacher.branch=$branch $sq1")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT teacher.id,teacher.firstname,teacher.lastname,teacher.designation,teacher.contact,teacher.qualification,teacher.doj,teacher.dob,teacher.salery,teacher.specialization,status.name FROM `teacher` inner join `status` on teacher.status = status.id   WHERE teacher.branch = '$branch' AND teacher.is_delete='0'   $sq1 LIMIT 0, $per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT teacher.id,teacher.firstname,teacher.lastname,teacher.designation,teacher.contact,teacher.qualification,teacher.doj,teacher.dob,teacher.salery,teacher.specialization ,status.name FROM `teacher` inner join `status` on teacher.status = status.id   WHERE teacher.branch = '$branch' AND teacher.is_delete='0'   $sq1 LIMIT $offset, $per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;

        
        $data['teachers'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
            //calling  pages views
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('teacher/status',$data);


   }
            // status_update is for  upadte status of teacher
   public function status_update()
   {
        if($this->input->post())
        {
           $data=$this->input->post();
           $this->teacher_model->status_update($data);
           redirect('teacher/status');
        }
        else
        {
           redirect('teacher/status');

        }
   }

        //rollback is for back to 0 position
   public function rollback()
   {
            if($this->uri->segment(3))
            {
                $data = $this->uri->segment(3);
                $this->teacher_model->rollback($data);
                redirect('teacher/status','refresh');
            } 
            else
            {
                redirect('teacher/status','refresh');

            }
   }


    public function best_teachers()
    {
	$this->user_model->check_permissions("teacher/index");
        $data['base_url'] = base_url();
            //menu and user information
        $data['menu'] = $this->load_model->menu();
        $data['userInfo'] = $this->userInfo;
        $branch=$this->user_model->getbranch();
	$query = $this->db->query("SELECT id,firstname,lastname FROM `teacher` WHERE branch = '2' AND status='0' AND is_delete='0'");
            // For view pages
        $data['teachers'] = $query->result_array();

        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('teacher/best_teachers',$data);
    }
    
    public function save_best_teachers()
    {
        if($this->input->post())
        {
            $data = $this->input->post();
            $db_insert = $this->teacher_model->best_teachers($data);
            redirect("teacher/best_teachers","refresh");
        }
        else
        {
            redirect("teacher/best_teachers","refresh");

        }
    }    
}
