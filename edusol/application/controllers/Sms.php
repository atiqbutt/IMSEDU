<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library("smsgateway");
        $this->user_model->check_login("admin");
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

	public function index()
	{
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
		$this->load->view('user/view',$data);
	}

    public function api($ref="",$p=1)
	{
        $branch = $this->user_model->getBranch();
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        if($ref=="manage")
        {
            $this->user_model->check_permissions($l="sms/api/manage");
            $data['menu'] = $this->load_model->menu();
            if($this->user_model->is_super())
                $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->result_array();
            else
                $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0' AND `id`='$branch'")->result_array();
            $total = $this->db->query("SELECT count(*) as total FROM `api` WHERE `is_delete`='0'")->result_array()[0]['total'];
            $per_page = 10;
            $offset = ($p - 1) * $per_page;
            $this->db->select("id,name,code"); 
            $this->db->from('api');
            $this->db->limit($per_page,$offset);
            $this->db->where("is_delete","0");
            $query = $this->db->get();
            $data['api'] = $query->result_array();
            $data['total'] = ceil($total / $per_page);
            $this->load->view('sms/api',$data);
        }else if($ref=="add")
        {
            if($this->input->post())
            {
                $branch = $this->input->post("branch",true);
                $name = $this->input->post("name",true);
                $code = $this->input->post("code",true);

                if(!empty($name) AND !empty($code) AND !empty($branch))
                {
                    $data = array(
                    'branch_id'=>$branch,
                    'name'=>$name,
                    'code'=>$code
                    );

                    $this->db->insert('api',$data);
                    redirect("sms/api/manage","refresh");
                }else{
                    redirect("sms/api/manage","refresh");
                }
            }else{
                redirect("sms/api/manage","refresh");
            }
        }else if($ref=="delete")
        {
            $data = array(
            'is_delete'=>1
            );
            $this->db->where('id',$p);
            $this->db->update('api',$data);
            redirect("sms/api/manage","refresh");
        }else if($ref=="edit")
        {
            $data['menu'] = $this->load_model->menu();
            $this->db->select("id,name,code"); 
            $this->db->from('api');
            $this->db->where("is_delete","0");
            $this->db->where("id",$p);
            $query = $this->db->get();
            $data['api'] = $query->result_array()[0];
            $this->load->view('sms/api_edit',$data);
        }else if($ref=="save")
        {
            if($this->input->post())
            {
                $id = $this->input->post("id",true);
                $name = $this->input->post("name",true);
                $code = $this->input->post("code",true);

                if(!empty($name) AND !empty($code))
                {
                    $data = array(
                    'name'=>$name,
                    'code'=>$code
                    );
                    $this->db->where("id",$id);
                    $this->db->update('api',$data);
                    redirect("sms/api/manage","refresh");
                }else{
                    redirect("sms/api/manage","refresh");
                }
            }else{
                redirect("sms/api/manage","refresh");
            }
        }
	}

    public function view($ref="",$p=1)
	{
        $branch = $this->user_model->getBranch();
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        if($ref=="teacher")
        {
            $this->user_model->check_permissions($l="sms/view/teacher");
            $data['menu'] = $this->load_model->menu();
            $this->db->select("id,name,code"); 
            $this->db->from('api');
            $this->db->where("is_delete","0");
            $this->db->where("branch_id",$branch);
            $query = $this->db->get();
            $data['api'] = $query->result_array();
            $this->load->view('sms/teacher',$data);
        }
        else if($ref=="staff")
        {
            $this->user_model->check_permissions($l="sms/view/teacher");
            $data['menu'] = $this->load_model->menu();
            $this->db->select("id,name,code"); 
            $this->db->from('api');
            $this->db->where("is_delete","0");
            $this->db->where("branch_id",$branch);
            $query = $this->db->get();
            $data['api'] = $query->result_array();
            $this->load->view('sms/staff',$data);
        }
        else if($ref=="student")
        {
            $this->user_model->check_permissions($l="sms/view/student");
            $data['menu'] = $this->load_model->menu();
            if($this->user_model->is_super())    
                $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->result_array();
            else
                $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0' AND `id`='$branch'")->result_array();
            $this->db->select("id,name,code"); 
            $this->db->from('api');
            $this->db->where("is_delete","0");
            $this->db->where("branch_id",$branch);
            $query = $this->db->get();
            $data['api'] = $query->result_array();
            $this->load->view('sms/student',$data);
        }else if($ref=="absent")
        {
            $this->user_model->check_permissions($l="sms/view/absent");
            $data['menu'] = $this->load_model->menu();
            if($this->user_model->is_super())    
                $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->result_array();
            else
                $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0' AND `id`='$branch'")->result_array();
            $this->db->select("id,name,code"); 
            $this->db->from('api');
            $this->db->where("is_delete","0");
            $this->db->where("branch_id",$branch);
            $query = $this->db->get();
            $data['api'] = $query->result_array();
            $this->load->view('sms/absent',$data);
        }else if($ref=="result")
        {
            $this->user_model->check_permissions("sms/view/result");
            $data['menu'] = $this->load_model->menu();
            if($this->user_model->is_super())    
                $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->result_array();
            else
                $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0' AND `id`='$branch'")->result_array();
            $data['api'] = $this->db->select("id,name,code")->from('api')->where("is_delete","0")->where("branch_id",$branch)->get()->result_array();
            $data['session'] = $this->db->select("id,name")->from('session')->where("is_delete","0")->get()->result();
            $this->load->view('sms/result',$data);
        }
	}

    public function send($ref="",$p=1)
	{
        $branch = $this->user_model->getBranch();
        $is_super = $this->user_model->is_super();
        if($ref=="teacher")
        {
            if($this->input->post())
            {
                $api = $this->input->post("api", true);
                $msg = $this->input->post("msg", true);
                $data = $this->db->query("SELECT `contact` FROM `teacher` WHERE `branch`='$branch' AND `is_delete`='0' AND `status`='0'")->result_array();
                $numbers = array();
                foreach ($data as $key => $value) {
                    $numbers[] = $value['contact'];
                }
                $options = [];
                $result = $this->smsgateway->sendMessageToManyNumbers($numbers, $msg, $api, $options);
                redirect("sms/view/teacher","refresh");
            }
        }
        else if($ref=="staff")
        {
            if($this->input->post())
            {
                $api = $this->input->post("api", true);
                $msg = $this->input->post("msg", true);
                $data = $this->db->query("SELECT `contact` FROM `staff` WHERE `branch`='$branch' AND `is_delete`='0' AND `status`='0'")->result_array();
                $numbers = array();
                foreach ($data as $key => $value) {
                    $numbers[] = $value['contact'];
                }
                $options = [];
                $result = $this->smsgateway->sendMessageToManyNumbers($numbers, $msg, $api, $options);
                redirect("sms/view/staff","refresh");
            }
        }
        else if($ref=="student")
        {
            if($this->input->post())
            {
                $b = $this->input->post("branch", true);
                $c = $this->input->post("class", true);
                $s = $this->input->post("section", true);
                $api = $this->input->post("api", true);
                $msg = $this->input->post("msg", true);
$data = $this->db->query("SELECT `father_contact` FROM `student` inner join `promotion` on promotion.student_id=student.id WHERE student.branch='$b' AND promotion.class_id='$c' AND promotion.is_active='1' AND promotion.is_delete='0' AND promotion.section_id='$s' AND student.status='0'")->result_array();
                $numbers = array();
                foreach ($data as $key => $value) {
                    $numbers[] = $value['father_contact'];
                }
                $options = [];
                $result = $this->smsgateway->sendMessageToManyNumbers($numbers, $msg, $api, $options);
                redirect("sms/view/student","refresh");
            }
        }else if($ref=="absent")
        {
            if($this->input->post())
            {
                $b = $this->input->post("branch", true);
                $c = $this->input->post("class", true);
                $s = $this->input->post("section", true);
                $api = $this->input->post("api", true);
                $date = date("Y-m-d");
                $data = $this->db->query("SELECT `student`.`father_contact`,`student`.`student_name`,`student`.`grno`,`branch`.`name` as `branch`,`class`.`class_name`,`section`.`section_name` FROM `student` INNER JOIN `studentatt` ON `studentatt`.`student_id` = `student`.`id` INNER JOIN `promotion` ON `promotion`.`student_id` = `student`.`id` INNER JOIN `branch` ON `branch`.`id` = `student`.`branch` INNER JOIN `class` ON `class`.`class_id` = `promotion`.`class_id` INNER JOIN `section` ON `promotion`.`section_id` = `section`.`section_id` INNER JOIN `attendancestatus` ON `attendancestatus`.`id` = `studentatt`.`status_id` WHERE `student`.`branch`='$b' AND `promotion`.`class_id`='$c' AND `promotion`.`section_id`='$s' AND `student`.`status`='0' AND `attendancestatus`.`status`='A' AND `studentatt`.`date`='$date' AND promotion.is_active='1' AND promotion.is_delete='0'")->result_array();
                $sendData = array();
                foreach ($data as $key => $value) {
                    $sendData[] = [
                        'device'=>$api,
                        'number'=>$value['father_contact'],
                        'message'=>$value['branch']."\n".$value['student_name']."\n".$value['grno']." ".$value['class_name']." ".$value['section_name']."\nNOTE:It is here by directed you that your student is absent today from class.\nThanks."
                    ];
                }
                //var_dump($sendData);
                $result = $this->smsgateway->sendManyMessages($sendData);
                redirect("sms/view/absent","refresh");
            }
        }else if($ref=="result")
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
                $student = $this->db->query("SELECT `student`.`grno`,`student`.`student_name`,`student`.`father_contact`,`class`.`class_name`,`section`.`section_name`,`result`.`obtained_marks`,`result`.`total_marks`,`result`.`grade` FROM `student` inner join `promotion` on promotion.student_id=student.id INNER JOIN `class` ON `class`.`class_id`=`promotion`.`class_id` INNER JOIN `section` ON `section`.`section_id`=`promotion`.`section_id` INNER JOIN `result` ON `result`.`promotion_id`=`promotion`.`id` WHERE student.branch='$b' AND promotion.class_id='$c' AND promotion.is_active='1' AND promotion.is_delete='0' AND promotion.section_id='$s' AND student.status='0'")->result_array();
                $data = array();
                foreach ($student as $key => $value) {
                    $data[] = [
                        "number"=>$value['father_contact'],
                        "device"=>$api,
                        "message"=>$branch_name."\n".$value['student_name']."\n".$value['class_name']." ".$value['section_name']."\n".$exam_name."\nObt Marks:".$value['obtained_marks']."\nTot Marks:".$value['total_marks']."\nStatus:".($value['grade']=="F"?"Fail":"Pass")
                    ];
                }
                $result = $this->smsgateway->sendManyMessages($data);
                redirect("sms/view/result","refresh"); 
            }
        }
	}

}
