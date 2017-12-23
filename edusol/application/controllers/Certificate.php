<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  certificate
 * @author      Atif Razzaq
 * @link        http://atifrazzaq.arteck.xyz
 */
class certificate extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("certificate_model");
        $this->user_model->check_login("admin");
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }


    public function index()
    {
         $this->user_model->check_permissions("certificate/index");
         $data['is_super'] = $this->user_model->is_super();
         $data['menu'] = $this->load_model->menu();
         $branch=$this->user_model->getbranch();
            if($this->user_model->is_super())
                $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
            else
                $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
                                

         $data['base_url'] = base_url();
         $data['userInfo'] = $this->userInfo;
                // calling view pages
         $this->load->view('header',$data);
         $this->load->view('sidebar',$data);
         $this->load->view('certificate/select_class',$data);
    }

                // reciving values of class and certificate and showing student
    public function select_class()
    {
        if($this->input->post())
        {   
                $values= $this->input->post();
                $certificate= $this->input->post('certificate');
                //$data['certificate']= $this->input->post('certificate');
                //print_r($data['certificate']);
                //die();
                $data['student']=$this->certificate_model->select_student($values);
                $data['file'] = $this->db->query("SELECT id,file FROM `certificate` WHERE `id`='$certificate' AND `is_active`='1' AND `is_delete`='0'")->result();
                $data['menu'] = $this->load_model->menu();
                $data['base_url'] = base_url();
                $data['userInfo'] = $this->userInfo;

                if($values['for_student']=='deactive' && $certificate==4) {
                    $data['check_fee']="true";
                }else{
                    $data['check_fee']="false";
                }

                if($certificate==4){
                    $data['is_leaving']="true";
                }             
                    
                $this->load->view('header',$data);
                $this->load->view('sidebar',$data);
                $this->load->view('certificate/certificate_student_list',$data);
        }
        else{
            redirect("certificate/index","refresh");
        }
        
    }


    public function deactive()
    {   
        if($this->uri->segment(3))
         {
             $id=$this->uri->segment(3);
             $this->certificate_model->deactive($id);
             redirect('certificate/edit','refresh');
         }
         else
         {
             redirect('certificate/edit','refresh');

         }
    }

    public function active()
    {
        if($this->uri->segment(3))
        {
            $id=$this->uri->segment(3);
            $this->certificate_model->active($id);
             redirect('certificate/edit','refresh');

        }
        else
        {
             redirect('certificate/edit','refresh');
            
        }
    }

    /*
            ============================================
                     Leave
            ============================================

    */

      public function leave()
    {
         $this->user_model->check_permissions("certificate/leave");
            
            $data['menu'] = $this->load_model->menu();
            $data['base_url'] = base_url();
            $data['userInfo'] = $this->userInfo;
             $branch=$this->user_model->getbranch();
            if($this->user_model->is_super())
                $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
            else
                $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
                    

            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('certificate/add_leave_info',$data);
        
            }
    public function leave_info()
    {
          if($this->input->post())
            {
                $data=$this->input->post();
                $this->certificate_model->add_leave_info($data);
                redirect("certificate/leave","refresh");
                
            }
            else
            {
                redirect("certificate/leave","refresh");
            }
    }

    public function view_leave($p=1)
    {
      $this->user_model->check_permissions("certificate/view_leave");
         $data['is_super'] = $this->user_model->is_super();
         $data['menu'] = $this->load_model->menu();
        $total = $this->db->query("SELECT count(*) as total FROM `leave_info` where is_delete='0'")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $branch=$this->user_model->getbranch();
        $this->db->where('leave_info.branch',$branch);
        $this->db->where('is_delete','0');
        $this->db->select("*"); 
        $this->db->from('leave_info');
        $this->db->join('student',"student.id=leave_info.std_id");
        $this->db->limit($per_page,$offset);
        $query = $this->db->get();
         $data['base_url'] = base_url();
         $data['userInfo'] = $this->userInfo;
        $data['leave'] = $query->result_array();
        $data['total'] = ceil($total / $per_page);
                // calling view pages
         $this->load->view('header',$data);
         $this->load->view('sidebar',$data);
         $this->load->view('certificate/view_leave_info',$data);   
    }
/*
            ========================================
                provisional 
            ========================================
*/
    public function provisional()
    {
      $this->user_model->check_permissions("certificate/provisional");
          
            $data['menu'] = $this->load_model->menu();
            $data['base_url'] = base_url();
            $data['userInfo'] = $this->userInfo;
              $branch=$this->user_model->getbranch();
            if($this->user_model->is_super())
                $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
            else
                $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
                      

            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('certificate/add_provisional_info',$data);
        
            }
    public function provisional_info()
    {
          if($this->input->post())
            {
                $data=$this->input->post();
                $this->certificate_model->add_provisional_info($data);
                redirect("certificate/provisional","refresh");
                
            }
            else
            {
                redirect("certificate/provisional","refresh");
            }
    }

    public function provisional_view($p=1)
    {
         $this->user_model->check_permissions("certificate/provisional_view");
         $data['is_super'] = $this->user_model->is_super();
         $data['menu'] = $this->load_model->menu();
        $total = $this->db->query("SELECT count(*) as total FROM `pro_info` where is_delete='0'")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $branch=$this->user_model->getbranch();
        $this->db->where('pro_info.branch',$branch);
        $this->db->where('is_delete','0');
        $this->db->select("*"); 
        $this->db->from('pro_info');
        $this->db->join('student',"student.id=pro_info.std_id");
        $this->db->limit($per_page,$offset);
        $query = $this->db->get();
         $data['base_url'] = base_url();
         $data['userInfo'] = $this->userInfo;
        $data['leave'] = $query->result_array();
        $data['total'] = ceil($total / $per_page);
                // calling view pages
         $this->load->view('header',$data);
         $this->load->view('sidebar',$data);
         $this->load->view('certificate/view_provisional_info',$data);   
          
     }
    public function edit()
    {
            $data['menu'] = $this->load_model->menu();
            $data['base_url'] = base_url();
            $data['userInfo'] = $this->userInfo;
            $data['certificate']= $this->certificate_model->getcertificate();

            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('certificate/view_certificate',$data);
    }



    
    public function edit_leave_info()
    {
        if($this->uri->segment(3))
        {
                $leave_id=$this->uri->segment(3);
                $data['leave_info']=$this->certificate_model->edit_leave_info($leave_id);
              //  print_r($data['leave_info']);

        }
        else
        {
            redirect('certificate/index','refresh');
        }
    }

/*     ====================================================
           certificates method for printing   
       ====================================================
*/
    public function character()
    {
         if($this->input->post('std[]'))
        {    
             foreach ($this->input->post('std[]') as $value) 
                {
             
                   $data['studentcer']=@$this->db->query("SELECT * FROM `student` INNER join `promotion` on student.id = promotion.student_id  
                    INNER join `class` on  promotion.class_id=class.class_id 
                    INNER join `city` on student.taluka=city.city_id where student.id='$value' AND student.status='0'")->result_array();
                    $data['b_header'] = @$this->db->query("SELECT `title`,`tagline`,`short_address`,`phone_no`,`email`,`logo1`,`logo2` FROM `branch` WHERE `id`='".$data['studentcer'][0]['branch']."' AND `is_delete`='0'")->result_array()[0];
                    $this->load->view('certificate/character',$data);
                }
       } 
        else
         {
            redirect('certificate/index','refresh');
         }

    }
    public function sports()
    {
         if($this->input->post('std[]'))
         {

             foreach ($this->input->post('std[]') as $value) 
               {
                   $data['studentcer']=@$this->db->query("SELECT * FROM `student` INNER join `promotion` on student.id = promotion.student_id  
                    INNER join `class` on  promotion.class_id=class.class_id 
                    INNER join `city` on student.taluka=city.city_id where student.id='$value' AND student.status='0'")->result_array();
                   $data['b_header'] = @$this->db->query("SELECT `title`,`tagline`,`short_address`,`phone_no`,`email`,`logo1`,`logo2` FROM `branch` WHERE `id`='".$data['studentcer'][0]['branch']."' AND `is_delete`='0'")->result_array()[0];
                   $this->load->view('certificate/sports',$data);
                }    
        
         }
         else
         {
            redirect('certificate/index','refresh');
         }
        }
    public function provisionall()
    {
         if($this->input->post('std[]'))
         {
             foreach ($this->input->post('std[]') as $value) 
        {
           $data['studentcer']=@$this->db->query("SELECT * FROM `student` INNER join `promotion` on student.id = promotion.student_id  
                    INNER join `class` on  promotion.class_id=class.class_id 
                    INNER join `city` on student.taluka=city.city_id where student.id='$value' AND student.status='0'")->result_array();
            $data['b_header'] = @$this->db->query("SELECT `title`,`tagline`,`short_address`,`phone_no`,`email`,`logo1`,`logo2` FROM `branch` WHERE `id`='".$data['studentcer'][0]['branch']."' AND `is_delete`='0'")->result_array()[0]; 
            $this->load->view('certificate/provisional',$data);
                           
        }   
         }
            else{
            redirect('certificate/index','refresh');

            }
             
        }

       public function leaving()
    {
         if($this->input->post('std[]'))
         {
             $passed=$this->input->post('passed');
             foreach ($this->input->post('std[]') as $value) 
        {
            $data['studentcer']=@$this->db->query("SELECT student.id as std_id,student.*,class.*,city.* FROM `student` INNER join `promotion` on student.id = promotion.student_id  
                    INNER join `class` on  promotion.class_id=class.class_id 
                    INNER join `city` on student.taluka=city.city_id where student.id='$value' AND student.status='0' AND promotion.is_delete='0' AND promotion.is_active='1'")->result_array();
            if(isset($passed[$value]) && $passed[$value]=="true"){
                $data['passed']="true";
            }else {
                $data['passed']="false";
            }
            $data['b_header'] = @$this->db->query("SELECT `title`,`tagline`,`short_address`,`phone_no`,`email`,`logo1`,`logo2` FROM `branch` WHERE `id`='".$data['studentcer'][0]['branch']."' AND `is_delete`='0'")->result_array()[0]; 
            $this->load->view('certificate/school-leaving',$data);
                           
        }
    }
            else{
            redirect('certificate/index','refresh');
                
            }    
        }  
            
}
