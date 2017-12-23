<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  Exam
 * @author      Sabeeh Murtaza
 * @link        http://facebook.com/sabeehking
 */
class Student_Attn_Report extends CI_Controller {

    private $userInfo = array();
    private $is_super;
    private $branch;

    public function __construct()
    {
        parent::__construct();
        $this->user_model->check_login("admin");
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
        $this->is_super = $this->user_model->is_super();
        $this->branch = $this->user_model->getBranch();
        $this->load->model('Showexam_model');
    }

    

  
 
    public function reportview()
    {
        if($this->input->post()){
            $postdata=$this->input->post();
            if(isset($postdata['Datesubmit'])) {
                //var_dump($this->input->post('date'));die();
                $data['mydate']=$this->input->post('date');
            }
        }
            $branch=$this->branch;
            //$exam=$this->input->post('exam');
            //$data['examtype']=$exam;
            $data['is_super'] = $this->is_super;
            $data['menu'] = $this->load_model->menu();
            $data['student']=$this->db->query("SELECT  class.class_id as cid,class.class_name,section.section_id as sid,section.section_name,count(promotion.id) as total_students from `promotion` join `class` on class.class_id=`promotion`.`class_id` join `student` on student.id=`promotion`.`student_id` join section on 
            section.section_id=promotion.section_id where student.branch=$branch and class.is_delete=0 and section.is_delete=0 and promotion.is_active=1 AND promotion.is_delete=0 and student.status=0 group by section.section_name , class.class_name order by class.class_name asc")->result_array();
             $data['att_present']=$this->db->query("SELECT  COUNT(studentatt.id) as att_count,(Select COUNT(student.id) as total from student WHERE  student.status='0') as std_count from studentatt INNER join student on student.id=studentatt.student_id WHERE is_deleted='0' AND status_id='1'")->result_array()[0];
            
           // var_dump($data['att_present']);die();
            // SELECT count(id) FROM promotion WHERE class_id=5 AND section_id=5 and is_active=1 AND is_delete=0
            // $this->db->order_by("name", "asc");
            //var_dump($data);die();
            $data['base_url'] = base_url();
            $data['userInfo'] = $this->userInfo;
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('exam/reportview',$data);
            $this->load->view('footer',$data);
    }

   

    
}

