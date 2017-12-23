<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SmsHajana extends CI_Controller {

    private $userInfo = array();
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library("hajanasms");
        $this->load->model("user_model");
    
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

     public function smsForm()
    {
        $this->load->view('HajanaSms/smsform');
    }
    
     public function smsFormMulti()
    {
        $this->load->view('HajanaSms/smsform_multi');
    }

    public function section_wise_form()
    {
        $this->user_model->check_permissions("SmsHajana/section_wise_form");
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
        $this->load->view('HajanaSms/sms_student',$data);
    }

    public function sendSectionWise()
    {
        if($this->input->post()) {
            $data=$this->input->post();
            $message=$data['msg'];
            $student_ids=$data['students'];
            //var_dump('<pre>',$students);die();
            $students=$this->db->select('father_contact')->where('status',0)->where_in('id',$student_ids)->get('student')->result_array();
            foreach ($students as $key => $selected_student) {
                $numbers[]=$selected_student['father_contact'];
            }
            $this->hajanasms->sendManyNumber($numbers,$message);
            redirect('SmsHajana/section_wise_form','refresh');
        }
    }

    public function result_sms_form()
    {
        $this->user_model->check_permissions("SmsHajana/result_sms_form");
        $branch = $this->user_model->getBranch();
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        if($this->user_model->is_super())    
            $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->result_array();
        else
            $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0' AND `id`='$branch'")->result_array();
        $data['session'] = $this->db->select("id,name")->from('session')->where("is_delete","0")->get()->result();
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('HajanaSms/result_sms_form',$data);
    }

    public function sendResult()
    {
        if($this->input->post())
            {
                $b = $this->input->post("branch", true);
                $c = $this->input->post("class", true);
                $s = $this->input->post("section", true);
                $sess = $this->input->post("session", true);
                $api = $this->input->post("api", true);
                $exam = $this->input->post("exam", true);
                $branch_name = $this->db->select("title")->from("branch")->where("id",$b)->get()->row()->title;
                $exam_name = $this->db->select("name")->from("exam")->where("id",$exam)->get()->row()->name;
                $student = $this->db->query("SELECT `student`.`grno`,`student`.`student_name`,`student`.`father_contact`,`student`.`father_name`,`class`.`class_name`,`section`.`section_name`,`result`.`obtained_marks`,`result`.`total_marks`,`result`.`grade` FROM `student` inner join `promotion` on promotion.student_id=student.id INNER JOIN `class` ON `class`.`class_id`=`promotion`.`class_id` INNER JOIN `section` ON `section`.`section_id`=`promotion`.`section_id` INNER JOIN `result` ON `result`.`promotion_id`=`promotion`.`id` WHERE student.branch='$b' AND promotion.class_id='$c' AND promotion.is_active='1' AND promotion.is_delete='0' AND promotion.section_id='$s' AND student.status='0'")->result_array();
                $data = array();
                foreach ($student as $key => $value) {
                    // $data[] = [
                    //     "number"=>$value['father_contact'],
                    //     "device"=>$api,
                    //     "message"=>$branch_name."\n".$value['student_name']."\n".$value['class_name']." ".$value['section_name']."\n".$exam_name."\nObt Marks:".$value['obtained_marks']."\nTot Marks:".$value['total_marks']."\nStatus:".($value['grade']=="F"?"Fail":"Pass")
                    // ];
                    $number=$value['father_contact'];
                    $message="Name: ".$value['student_name']."\nFather Name: ".$value['father_name']."\nClass: ".$value['class_name']."\nExam: ".$exam_name."\nTotal Marks: ".$value['total_marks']."\nObtain Marks: ".$value['obtained_marks']."\nStatus: ".($value['grade']=="F"?"Fail":"Pass")."\nThank You\nPrincipal\nSLMHS DHK";
                    $this->hajanasms->sendOneNumber($number,$message);
                }
                redirect("SmsHajana/result_sms_form"); 
            }
    }

    public function sendClosingSms()
    {
        $b=$this->user_model->getBranch();
        $branch_name = $this->db->select("name")->from("branch")->where("id",$b)->get()->row()->name;
        $data=$this->input->get();
        $income=$data['income'];
        $expense=$data['expense'];
        $students=$data['students'];
        $cash_deposit=$data['cash_deposit'];
        $cash_hand=$data['cash_hand'];
        $date=date('d-m-Y');
        $number=array("923337241654","923009318468");
        $message="R/sir Chairman\nSLMHS DHK closing Account ".$date."\nIncome: ".$income."\nExpense: ".$expense."\nCash Deposit: ".$cash_deposit."\nCash in Hand: ".$cash_hand."\nTotal Students: ".$students."\n".$branch_name;
        $this->hajanasms->sendManyNumber($number,$message);
        redirect(base_url(),'refresh');
    }
    
    public function sendOneNumber()
    {
        if($this->input->post()) {
            $data=$this->input->post();
            // var_dump($data);die();
            $this->hajanasms->sendOneNumber($data['number'],$data['sms']);
            redirect('SmsHajana/smsForm','refresh');
        }
    }

    public function sendMultiNumber()
    {
        if($this->input->post()) {
            $data=$this->input->post();
            $data['number']=array('03344339575','923214313713','+923470467312');
            $this->hajanasms->sendManyNumber($data['number'],$data['sms']);
            //redirect('SmsHajana/smsFormMulti','refresh');
        }
    }

}