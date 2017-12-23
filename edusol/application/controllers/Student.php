<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class student extends CI_Controller {

    private $userInfo = array();
    public $branch = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('hajanasms');
        $this->load->model("user_model");
        $this->load->model("student_model");
        $this->load->model("Teacher_model");
        $this->user_model->check_login("admin");
        $this->branch=$this->user_model->getbranch();
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

    public function index()
    {
        $this->user_model->check_permissions("student/index");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('student/student_add',$data);
    }
        public function show()
    {
    	
        $this->user_model->check_permissions("student/show");
    	$b=$this->user_model->getbranch();
        $query = $this->db->query("SELECT student.*,class.*,section.*,student.id as stid FROM student JOIN promotion ON promotion.student_id=student.id JOIN class ON promotion.class_id=class.class_id JOIN section ON promotion.section_id=section.section_id WHERE student.branch = '$b' AND student.status='0' AND promotion.is_active='1' and class.is_delete=0 and section.is_delete=0");
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
       $data['branch']=$this->db->select("*")->from("branch")->where('id',$b)->get()->result_array();
    
        $data['student'] = $query->result_array();
	$data['menu'] = $this->load_model->menu();
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('student/student_view',$data);
    }

    public function save()
    {
        $this->form_validation->set_rules('gr','GR No','required|alpha_numeric|is_unique[student.grno]');
        $this->form_validation->set_message('is_unique', 'The %s is already taken. Try again and fill the form');
        if($this->form_validation->run() == TRUE) 
        {
            $url = $this->do_upload();
            $this->load->library('upload');
            $data = $this->input->post();
            //print_r($data);
            $db_insert = $this->student_model->save($data,$url);
            redirect("student/index","refresh");
        }
        else{
            $this->index();
        }
    }
    private function do_upload()
    {
        $type = explode('.', $_FILES["pic"]["name"]);
        $type = $type[count($type)-1];
        $url = "./images/".uniqid(rand()).'.'.$type;
        if (in_array($type, array("png","jpg","jpeg","gif")))
            if(move_uploaded_file($_FILES["pic"]["tmp_name"], $url))
                return $url;
        return ""; 
    }

   public function edit()
    {
        $data['menu'] = $this->load_model->menu();
        $id = $this->uri->segment(3);
        $data['val']= $this->student_model->id($id);
        $data['userInfo'] = $this->userInfo;
        $data['base_url'] = base_url();
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('student/student_edit',$data);  
    }


    public function update()
    {
        $data = $this->input->post();
        $url = $this->do_upload();
        $this->load->library('upload');
        $check = $this->student_model->update($data,$url);
        if($check==true){
       redirect("student/show","refresh");
        }
       else{echo "Not Save Data";}
    }
  
    public function student_info()
    {
        
        $id = $this->uri->segment(3);
        $data['studentinfo']=$this->student_model->student_infor($id);
        
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        //var_dump($studentinfo);die();
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('student/student_info',$data);   
    }
     public function studentatt_add()
    {
        $this->user_model->check_permissions("student/studentatt_add");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        
        if(!$this->user_model->is_super())
        { 
            $data['branch']=$this->user_model->getBranch(); 
         }else {
            $data['branch']=$this->student_model->getbranch()->result_array();
         }
        
        $data['Attendancestatus']=$this->Teacher_model->AttendanceStatus();
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('student/studentatt_add',$data);
    }
    public function saveatt()
    {
            $id=$this->input->post('studentattid',true);
            if($id>0){
                $td=$this->input->post('status',true);
                $date=$this->input->post('date',true);
                $data=array('status_id'=>$td,
                'date'=>$date
                );
                $check=$this->student_model->studentattupdate($data,$id);
                if($check==true){
                    redirect("student/studentatt_show/");
                }else
                {
                    echo "Not update";
                }
            }
            else {
                if($this->input->post())
                {
                    $radio=$this->input->post('status',true);
                    $date=$this->input->post('date',true);
                    $dt=$this->input->post('id',true);
                    foreach ($radio as $key => $value) 
                    { 
                        $promotionid=$this->student_model->promotion_id($key);
                        $student_data=$this->student_model->id($key);
                        $data=array('student_id' =>$key,
                        'promotion_id'=>$promotionid,
                        'status_id'=> $value,
                        'date'=>$date
                        );
                        $con= $this->student_model->studentatt_save($data);
                        // if($con && $value!=4) {
                        //     if($value==1)
                        //     $message="Dear Parents your child ".$student_data['student_name']." is safely reached at SLMHS DHK.\nDate: ".$date."\nThank You\nPrincipal\nSLMHS DHK\n".$student_data['branch_name'];
                        //     elseif($value==2)
                        //     $message="Dear Parents your child ".$student_data['student_name']." is absent from SLMHS DHK.\nDate: ".$date."\nThank You\nPrincipal\nSLMHS DHK\n".$student_data['branch_name'];
                        //     elseif($value==3)
                        //     $message="Dear Parents Today (".$date.") your child ".$student_data['student_name']." s/o ".$student_data['father_name']." is on leave from Shah Latif Model High School Daharki."."\nThank You\nPrincipal\nSLMHS DHK\n".$student_data['branch_name'];
                        //     $this->hajanasms->sendOneNumber($student_data['father_contact'],$message);
                        // }
                    }
                    if($con==true)
                    {
                        redirect("student/studentatt_show/");
                    }else
                    {
                        echo "not saved";
                    }
                }
            }
        }
    
        public function studentatt_show($q="all",$p=1)
        {
               $this->user_model->check_permissions("student/studentatt_show");
            $data['menu'] = $this->load_model->menu();
            $branch=$this->user_model->getBranch();
              $q = urldecode($q);
        $p = $p<1?1:$p;
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        
        $sq1 = "";
        if($q!="all")
        {
            $sq1 .= "AND (student.grno like '%".$q."%' OR "; 
            $sq1 .= "student.student_name like '%".$q."%' OR "; 
            $sq1 .= "class.class_name like '%".$q."%' OR ";
            $sq1 .= "section.section_name like '%".$q."%' OR ";  
            $sq1 .= "attendancestatus.status like '%".$q."%' )";
        }
        $total = $this->db->query("SELECT count(*) as total FROM `studentatt` inner join `student` on studentatt.student_id = student.id inner join `promotion` on promotion.student_id = student.id inner join `class` on promotion.class_id = class.class_id  inner join `section` on promotion.section_id = section.section_id inner join `attendancestatus` on attendancestatus.id = studentatt.status_id  WHERE is_deleted='0' AND student.branch='$branch'  $sq1")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT student.student_name,student.grno,student.roll_no,class.class_name,section.section_name,studentatt.date,studentatt.id,attendancestatus.status FROM `studentatt` inner join `student` on studentatt.student_id = student.id inner join `promotion` on promotion.student_id = student.id inner join `class` on promotion.class_id = class.class_id  inner join `section` on promotion.section_id = section.section_id inner join `attendancestatus` on attendancestatus.id = studentatt.status_id  WHERE is_deleted='0' AND student.branch='$branch'  $sq1 LIMIT 0, $per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT student.student_name,student.grno,student.roll_no,class.class_name,section.section_name,studentatt.date,studentatt.id,attendancestatus.status FROM `studentatt` inner join `student` on studentatt.student_id = student.id inner join `promotion` on promotion.student_id = student.id inner join `class` on promotion.class_id = class.class_id  inner join `section` on promotion.section_id = section.section_id inner join `attendancestatus` on attendancestatus.id = studentatt.status_id  WHERE is_deleted='0' AND student.branch='$branch'  $sq1 LIMIT $offset, $per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;


            $data['studentatt'] = $query->result_array();
            $data['end'] = ceil($total / $per_page);
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('student/studentatt_show',$data);
        
        }
        /*======================== Status =====================================*/
        public function status($q="all",$p=1)
   {
         $this->user_model->check_permissions("student/status");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
         $branch=$this->user_model->getbranch();
            if($this->user_model->is_super())
                $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result();
            else
                $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result();
            
        $q = urldecode($q);
        $p = $p<1?1:$p;
        $per_page = 20;
        $offset = ($p - 1) * $per_page;
          $sq1 = "";
        if($q!="all")
        {
            $sq1 .= "AND (student.grno like '%".$q."%' OR "; 
            $sq1 .= "student.student_name like '%".$q."%' OR ";
            $sq1 .= "student.father_name like '%".$q."%' OR ";
            $sq1 .= "student.father_contact like '%".$q."%' OR ";
            $sq1 .= "class.class_name like '%".$q."%' OR ";
            $sq1 .= "status.name like '%".$q."%' OR ";
            $sq1 .= "section.section_name like '%".$q."%' )";
        }

        $total = @$this->db->query("SELECT count(*) as total FROM `student` inner JOIN promotion ON promotion.student_id=student.id inner JOIN class ON promotion.class_id=class.class_id inner JOIN section ON promotion.section_id=section.section_id  inner join `status` on student.status = status.id WHERE student.branch = '$branch' AND student.status!='0' AND promotion.is_active='1' $sq1 LIMIT $offset, $per_page")->result_array()[0]['total'];
        $query = $this->db->query("SELECT student.*,class.*,section.*,status.*,student.id as stid FROM student JOIN promotion ON promotion.student_id=student.id JOIN class ON promotion.class_id=class.class_id JOIN section ON promotion.section_id=section.section_id inner join `status` on student.status = status.id  WHERE student.branch = '$branch' AND student.status!='0' AND promotion.is_active='1' $sq1 LIMIT $offset,$per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['student'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
            //calling  pages views
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('student/status_student',$data);


   }
            // status_update is for  upadte status of teacher
   public function status_update()
   {
        if($this->input->post())
        {
           $data=$this->input->post();
           $this->student_model->status_update($data);
           redirect('student/status');
        }
        else
        {
           redirect('student/status');

        }
   }

        //rollback is for back to 0 position
   public function rollback()
   {
            if($this->uri->segment(3))
            {
                $data = $this->uri->segment(3);
                $this->student_model->rollback($data);
                redirect('student/status','refresh');
            } 
            else
            {
                redirect('student/status','refresh');

            }
   }


        public function actions($ref="",$value=0)
        {   
            if($ref=="edit"){
                $data['menu'] = $this->load_model->menu();
                $data['base_url'] = base_url();
                $data['userInfo'] = $this->userInfo;
                $data['studentatt']=$this->student_model->studentatt_edit($value)->result_array()[0];
                $this->load->view('header',$data);
                $this->load->view('sidebar',$data);
                $data['statusid']=$this->db->select("*")->from('attendancestatus')->get()->result_array();
                $this->load->view('student/studentatt_edit',$data);
            }else if($ref=="del")
            {
                $data['menu'] =$this->load_model->menu();
                $data['base_url'] = base_url();
                $data['userInfo'] = $this->userInfo;
                $check=$this->student_model->studentatt_del($value);
                if($check==true){
                    redirect("student/studentatt_show/");
                }else
                {
                    echo "could not Delete";
                }
            }
        }
    public function promotion()
    {
        //$this->user_model->check_permissions("student/index");
        $branch = $this->user_model->getBranch();
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        if($data['is_super'])
            $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->result_array();
        else
            $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0' AND `id`='$branch'")->result_array();
        $data['session'] = $this->db->query("SELECT * FROM `session` WHERE `is_delete`='0'")->result_array();
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('student/promotion',$data);
    }
    public function promotion_selection($branch=0,$class=0,$section=0,$session=0)
    {
        if($branch==0 OR $class==0 OR $section==00 OR $session==0)
        {
            redirect("student/promotion");
        }
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['student'] = $this->db->query("SELECT `student`.`grno`,`student`.`id`,`student`.`student_name` FROM `student` INNER JOIN `promotion` ON `promotion`.`student_id`=`student`.`id` WHERE `student`.`status`='0' AND `student`.`branch`='$branch' AND `promotion`.`class_id`='$class' AND `promotion`.`section_id`='$section' AND `promotion`.`session_id`='$session'")->result_array();
        if($data['is_super'])
            $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->result_array();
        else
            $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0' AND `id`='$branch'")->result_array();
        $data['session'] = $this->db->query("SELECT * FROM `session` WHERE `is_delete`='0'")->result_array();
        $data['branch_old'] = $branch;
        $data['class_old'] = $class;
        $data['section_old'] = $section;
        $data['session_old'] = $session;
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('student/promotion_selection',$data);
    }
    public function promote_students()
    {
        if($this->input->post())
        {
            $is_super = $this->user_model->is_super();
            $students = $this->input->post('student',true);
            $branch_old = $this->input->post('branch_old',true);
            $class_old = $this->input->post('class_old',true);
            $section_old = $this->input->post('section_old',true);
            $session_old = $this->input->post('session_old',true);
            $branch = $this->input->post('branch',true);
            $class = $this->input->post('class',true);
            $section = $this->input->post('section',true);
            $session = $this->input->post('session',true);
           // var_dump(($this->input->post()));
            if(!empty($students ))
            {
            foreach ($students as $key => $value) {
                $data = array(
                    "is_active"=>"0"
                );
               $this->db->where("student_id",$value);
               $this->db->where("class_id",$class_old);
                $this->db->where("section_id",$section_old);
                $this->db->where("session_id",$session_old);
                $this->db->update("promotion",$data);
                /**/
                $data1 = array(
                    "student_id"=>$value,
                    "class_id"=>$class,
                    "section_id"=>$section,
                    "session_id"=>$session,
                    "is_active"=>"1",
                    "is_delete"=>"0"
                );
               $this->db->insert("promotion",$data1);
            }
            redirect("student/show");
            }else
            {
             // echo"students not found";
              redirect("student/promotion");
            }
            
        }else{
            redirect("student/promotion");
        }
        
    }  

    public function StudentAdmissionPrint($id=1)
    {
        $this->user_model->check_permissions("student/index");
        $branch = $this->user_model->getBranch();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        if($this->user_model->is_super())
            $data['b_header'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->row_array();
        else
            $data['b_header'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0' AND `id`='$branch'")->row_array();
        $data['student'] = $this->db->query("SELECT `student`.* FROM `student` INNER JOIN `promotion` ON `promotion`.`student_id`=`student`.`id` WHERE `student`.`status`='0' AND `promotion`.`is_delete`='0'  AND `promotion`.`is_active`='1'  AND `promotion`.`student_id`='$id'")->row_array();
        $this->load->view('printable/student_admission_print',$data);
    }

    public function student_report()
    {
        if($this->user_model->is_super())
        {
            $data['branch']=$this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->result_array();
        }else{
            $data['branch']=$this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0' AND `id`='".$this->branch."'")->result_array();
        }
        $b=$this->user_model->getBranch();
        $query = $this->db->query("SELECT student.*,class.*,section.*,student.id as stid FROM student JOIN promotion ON promotion.student_id=student.id JOIN class ON promotion.class_id=class.class_id JOIN section ON promotion.section_id=section.section_id WHERE student.branch = '$b' AND student.status='0' AND promotion.is_active='1' order by grno ASC");
        $data['student'] = $query->result_array();
        $this->load->view('student/student_report',$data);
    }
 
     public function best_students()
    {
    	
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['sessions'] = $this->db->where('is_delete', 0)->get('session')->result_array();
        $classes	= $this->db->select('class_id')->where('branch', 2)->where('is_delete', 0)->get('class')->result_array();
        $data['types']	= $this->db->select('*')->where('branch_id', 2)->where('is_delete', 0)->get('exam_type')->result_array();
        $class_ids 	= array_column($classes, 'class_id');
  

        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('student/best_students',$data);
    } 
    
     public function save_best_students()
    {
         $exam_type 	= $this->input->post('exam_type',true);
         $students 	= $this->db->select("*")->from("exam_type")->where("branch_id", 2)->join("exam", 'exam_type.id = exam.etype_id')->get()->result_array();
         var_dump("<pre>",$students); die();
 	/* $this->db->truncate('best_students');
     	$id 		= $this->input->post('session_id',true);
     	$exam_type 	= $this->input->post('exam_type',true);

        $classes	= $this->db->select('class_id')->where('branch', 2)->where('is_delete', 0)->get('class')->result_array();
        $class_ids 	= array_column($classes, 'class_id');     	
        $students = $this->db->select('id')->where('session_id', $id)->where('is_delete', 0)->where('is_active', 1)->where_in('class_id', $class_ids)->get('promotion')->result_array();
        $exams = $this->db->select('id')->where('etype_id', $exam_type)->where('is_delete', 0)->get('exam')->result_array();  
        $promotion_ids 	= array_column($students, 'id');
        $exam_ids 	= array_column($exams, 'id');
        $first_three_positions = array("1st", "2nd", "3rd");      
        $best_students = $this->db->select("promotion_id, position,exam_id")->where_in('promotion_id', $promotion_ids)->where_in('exam_id', $exam_ids)->where('is_delete', 0)->get('result')->result_array();
var_dump($best_students);die();
	foreach($best_students as $best_student) {
		$best = array(  
			'promotion_id' 	=> $best_student['promotion_id'],
			'position'	=> $best_student["position"]
		);
		$this->db->insert('best_students', $best);
	}
	*/
	return redirect("best_students", "refresh");
        }  
}
