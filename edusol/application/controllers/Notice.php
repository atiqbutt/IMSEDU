<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CI_Controller {

    private $userInfo = array();
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");  
        $this->load->model("api_model");
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

    public function class_wise_form()
    {
        $this->user_model->check_permissions("Notice/class_wise_form");
        $branch = $this->user_model->getBranch();
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        if($this->user_model->is_super())    
            $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->result_array();
        else
            $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0' AND `id`='$branch'")->result_array();
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('notice/student_notice',$data);
    }

    public function sendClassWise()
    {
        $data=$this->input->post();
        $insert_batch=array();
        foreach ($data['students'] as $key => $value) {
        
$result = $this->db->query("SELECT * FROM student WHERE id= '$value'")->row_array();

$tokens = array();

    $tokens[]=$result['token'];
   // var_dump($tokens);
   // die();
   
$msg = array("message" =>$data['notice'],"id"=>$value,"topic"=>"notice" );
//$msg = array("msg" => "Your child notic");  
  // var_dump($msg );
   //die();
 $this->api_model->send_notification($tokens,$msg);
 

            $insert_batch[] = array(
                'std_id'=>$value,
                'notice'=>$data['notice'],
                'date'=>date('Y-m-d')
            );
        }
        
        if(!empty($insert_batch)){
            $this->db->insert_batch('notice', $insert_batch);
        }
        redirect('Notice/class_wise_form');
    }

    public function view()
    {
        $this->user_model->check_permissions("Notice/view");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;

        $this->db->select('notice.id,notice.date,student.grno,student.student_name,student.father_name,class.class_name,section.section_name,notice.notice');
        $this->db->join('student','notice.std_id=student.id');
        $this->db->join('promotion','student.id=promotion.student_id');
        $this->db->join('class','promotion.class_id=class.class_id');
        $this->db->join('section','promotion.section_id=section.section_id');
        $this->db->where('notice.is_delete',0)->where('promotion.is_active',1);
        $data['notice']=$this->db->get('notice')->result_array();
        
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('notice/view',$data);
    }

    public function delete($id='')
    {
        if(!empty($id)){
            $this->db->where('id',$id)->update('notice',['is_delete'=>1]);
        }
        redirect('Notice/view');
    }

}