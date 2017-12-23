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
class Exam extends CI_Controller {

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
    }

    public function index($p=1,$c=0)
    {
        $this->user_model->check_permissions("exam/index");
        $data['is_super'] = $this->is_super;
        $data['menu'] = $this->load_model->menu();
        $total = $this->db->query("SELECT count(*) as total FROM `exam` where is_delete='0'")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $this->db->select("exam.id,exam.name,exam.start,exam.end,branch.name as b_name, class.class_name as c_name"); 
        $this->db->from('exam');
        $this->db->join('branch','branch.id=exam.branch_id');
        $this->db->join('class','class.class_id=exam.class_id');
        $this->db->where('exam.is_delete','0'); 
        $this->db->where('exam.branch_id',$this->branch);
        if($this->is_super)
            $data['branch'] = $this->db->query("SELECT id,name FROM `branch` where is_delete='0'")->result_array()[0]['total'];
        else
            $data['branch'] = $this->db->query("SELECT id,name FROM `branch` where is_delete='0' AND id='".$this->branch."'")->result_array();
        if($c!=0)
        {
            $this->db->where('exam.class_id',$c);
            $data['c'] = $c;
        }else
            $data['c'] = "";
        $this->db->limit($per_page,$offset);
        $query = $this->db->get();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['exam'] = $query->result_array();
        $data['total'] = ceil($total / $per_page);
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('exam/index',$data);
    }

    public function edit($id=1)
    {
        $data['menu'] = $this->load_model->menu();
        $this->db->select("id,name,start,end"); 
        $this->db->from('exam');
        $this->db->where('exam.is_delete','0'); 
        $this->db->where('exam.id',$id);
        $query = $this->db->get();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['data'] = $query->result_array()[0];
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('exam/edit',$data);
    }

    public function add()
    {
        if($this->input->post())
        {
            $name = $this->input->post("name",true);
            $branch = $this->input->post("branch",true);
            $class = $this->input->post("class",true);
            $start = $this->input->post("start",true);
            $end = $this->input->post("end",true);
            $data = array(
                "name"=>$name,
                "branch_id"=>$branch,
                "class_id"=>$class,
                "start"=>$start,
                "end"=>$end
            );
            $this->db->insert("exam",$data);   
        }
        redirect("exam/index","refresh");
    }

    public function save()
    {
        if($this->input->post())
        {
            $name = $this->input->post("name",true);
            $id = $this->input->post("id",true);
            $start = $this->input->post("start",true);
            $end = $this->input->post("end",true);
            $data = array(
                "name"=>$name,
                "start"=>$start,
                "end"=>$end
            );
            $this->db->where("id",$id);   
            $this->db->update("exam",$data);   
        }
        redirect("exam/index","refresh");
    }

   public function delete($id)
   {
        if(!empty($id))
        {
            $data = array(
                'is_delete' => "1",
            );
            $this->db->where("id",$id);
            $this->db->update("exam",$data); 
        }
        redirect('exam/index','refresh');
   }

   public function selection()
   {
        $this->user_model->check_permissions("exam/selection");
        $data['menu'] = $this->load_model->menu();
        $this->db->select("id,name"); 
        $this->db->from('branch');
        $this->db->where('is_delete','0');
        if(!$this->is_super)
            $this->db->where('id',$this->branch);
        $query = $this->db->get();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['branch'] = $query->result_array();
        $data['session'] = $this->db->query("SELECT * FROM `session` WHERE `is_delete`='0'")->result_array();
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('exam/add',$data);
   }

   public function premark()
   {
        if($this->input->post())
        {
            $branch = $this->input->post("branch",true);
            $class = $this->input->post("class",true);
            $section = $this->input->post("section",true);
            $exam = $this->input->post("exam",true);
            $subject = $this->input->post("subject",true);
            $session = $this->input->post("session",true);
            $data['menu'] = $this->load_model->menu();
            $data['base_url'] = base_url();
            $data['userInfo'] = $this->userInfo;
            $this->db->select("student.grno,student.student_name,promotion.student_id");
            $this->db->from("promotion");
            $this->db->join("student","student.id=promotion.student_id");
            $this->db->where("student.status","0");
            $this->db->where("student.branch",$branch);
            $this->db->where("promotion.is_delete","0");
            $this->db->where("promotion.session_id",$session);
            $this->db->where("promotion.section_id",$section);
            $this->db->where("promotion.class_id",$class);
            $data['student'] = $this->db->get()->result_array();
            $data['subject'] = $subject;
            $data['exam'] = $exam;
            $data['class'] = $class;
            $data['section'] = $section;
            $data['session'] = $session;
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('exam/enter',$data);
        }else{
            redirect("exam/selection","refresh");
        }             
   }

   public function enter()
   {
        if($this->input->post())
        {
            $class = $this->input->post("class",true);
            $section = $this->input->post("section",true);
            $subject = $this->input->post("subject",true);
            $exam = $this->input->post("exam",true);
            $session = $this->input->post("session",true);
            $date = $this->input->post("date",true);
            $total = $this->input->post("total_marks",true);
            $passing = $this->input->post("passing_marks",true);
            $obtained = $this->input->post("obtained_marks",true);
            $teacher_alloc = @$this->db->query("SELECT `id` FROM `teacheralloc` WHERE `is_deleted`='0' AND `class_id`='$class' AND `section_id`='$section' AND `subject_id`='$subject'")->result_array()[0]['id'];
            if(!empty($teacher_alloc))
            {
                if(!empty($obtained))
                {
                    $data = [];
                    foreach ($obtained as $key => $value) {
                        $promotion = @$this->db->query("SELECT `id` FROM `promotion` WHERE `is_delete`='0' AND `class_id`='$class' AND `section_id`='$section' AND `session_id`='$session' AND `student_id`='$key'")->result_array()[0]['id'];
                        $data[] = array(
                            "exam_id"=>$exam,
                            "teacheralloc_id"=>$teacher_alloc,
                            "promotion_id"=>$promotion,
                            "total_marks"=>$total,
                            "passing_marks"=>$passing,
                            "obtained_marks"=>$value,
                            "paper_date"=>$date,
                        );
                        $d = array(
                            "exam_id"=>$exam,
                            "teacheralloc_id"=>$teacher_alloc,
                            "promotion_id"=>$promotion,
                            "total_marks"=>$total,
                            "passing_marks"=>$passing,
                            "obtained_marks"=>$value,
                            "paper_date"=>$date,
                        );                        
                        $this->db->insert("result",$d);
                    }
                    $this->makeposition($data);
                }
            }
        }
        redirect("exam/selection","refresh");             
   }


/*=======================================For Printing=============================================*/
   public function result(){
        $this->user_model->check_permissions("exam/result");
        $data['is_super'] = $this->is_super;
        $data['menu'] = $this->load_model->menu();
        $branch=$this->user_model->getbranch();
        $data['branch']=$this->db->query("SELECT id,name FROM branch where is_delete=0 AND id='$branch'")->result_array();
        $data['exam']=$this->db->query("SELECT id,name FROM exam where is_delete=0 AND branch_id='$branch'")->result_array();
        
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('exam/result',$data);
        $this->load->view('footer',$data);

   }
   public function resultview(){

        if($this->input->post()){
            $class=$this->input->post('class');
            $section=$this->input->post('section');
            $data['exam']=$this->input->post('exam');
        $data['is_super'] = $this->is_super;
        $data['menu'] = $this->load_model->menu();
        $branch=$this->user_model->getbranch();
        $data['branch']=$this->db->query("SELECT id,name FROM branch where is_delete=0 AND id='$branch'")->result_array();
        // $data['exam']=$this->db->query("SELECT id,name FROM exam where is_delete=0 AND branch_id='$branch'")->result_array();
        $data['student']=$this->db->query("SELECT student.id,student.grno,student.student_name,promotion.id as pid from `student` inner join `promotion` on student.id=promotion.student_id where promotion.class_id='$class' AND promotion.section_id='$section' AND promotion.is_active=1 AND student.status=0")->result_array();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('exam/resultview',$data);
        $this->load->view('footer',$data);
      }
      else
      {
        redirect('exam/result','refresh');
      }
   }
   public function printview(){

      if($this->uri->segment(3)){ 
               $pid=$this->uri->segment(3);
               $eid=$this->uri->segment(4);
               $branch=$this->user_model->getbranch();

               $data['b_header'] = $this->db->query("SELECT `title`,`tagline`,`short_address`,`phone_no`,`email`,`logo1`,`logo2` FROM `branch` WHERE `id`='$branch' AND `is_delete`='0'")->result_array()[0];
               $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `id`='$branch' AND `is_delete`='0'")->result_array()[0];
               $data['result']=$this->db->query("SELECT result.id,result.total_marks,result.obtained_marks,result.passing_marks,result.paper_date,subject.name as sname,exam.name as ename,exam.start,exam.end,student.grno,student.student_name,student.father_name from `result` inner join `promotion` on result.promotion_id=promotion.id inner join `exam` on exam.id=result.exam_id INNER join teacheralloc on  teacheralloc.id=result.teacheralloc_id inner JOIN subject on subject.id=teacheralloc.subject_id INNER join student on promotion.student_id=student.id where result.is_delete=0 AND result.promotion_id='$pid' AND result.exam_id='$eid' AND promotion.is_active='1'")->result_array();
               $data['exam']=@$this->db->query("SELECT result.id,result.total_marks,result.obtained_marks,result.passing_marks,result.paper_date,subject.name as sname,exam.name as ename,exam.start,exam.end,student.grno,student.student_name,student.father_name from `result` inner join `promotion` on result.promotion_id=promotion.id inner join `exam` on exam.id=result.exam_id INNER join teacheralloc on  teacheralloc.id=result.teacheralloc_id inner JOIN subject on subject.id=teacheralloc.subject_id INNER join student on promotion.student_id=student.id where result.is_delete=0 AND result.promotion_id='$pid' AND result.exam_id='$eid' AND promotion.is_active='1'")->result_array()[0];
               $data['student']=$this->db->query("SELECT student.img,student.id as stid,section.section_name,class.class_name,student.grno,student.student_name,student.father_name from `student` inner join `promotion` on student.id=promotion.student_id inner join `class` on class.class_id=promotion.class_id inner join `section` on section.section_id=promotion.section_id where student.status='0' AND promotion.id='$pid' AND promotion.is_active='1'")->result_array()[0];
               $student_grno=$data['student']['stid'];
               $data['student_att']=$this->db->query("SELECT COUNT(status_id) as total ,(select COUNT(status_id) from studentatt WHERE status_id=1 AND studentatt.student_id='$student_grno' AND studentatt.is_deleted=0) as pre FROM studentatt inner JOIN promotion on studentatt.promotion_id=promotion.id where studentatt.is_deleted=0 AND studentatt.student_id='$student_grno'")->result_array()[0];
               $this->load->view('printable/result',$data);
      }
      else
      {
        redirect('exam/result','refresh');
      }
   }

   public function printviewclass(){

      if($this->input->post()){
            $data=$this->input->post(); 
            $pid=$this->input->post('class');
            $eid=$this->input->post('exam');
                  
               $branch=$this->user_model->getbranch();

               $data['b_header'] = $this->db->query("SELECT `title`,`tagline`,`short_address`,`phone_no`,`email`,`logo1`,`logo2` FROM `branch` WHERE `id`='$branch' AND `is_delete`='0'")->result_array()[0];
               $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `id`='$branch' AND `is_delete`='0'")->result_array()[0];
               $data['exam']=@$this->db->query("SELECT result.id,result.total_marks,result.obtained_marks,result.passing_marks,result.paper_date,subject.name as sname,exam.name as ename,exam.start,exam.end,student.grno,student.student_name,student.father_name from `result` inner join `promotion` on result.promotion_id=promotion.id inner join `exam` on exam.id=result.exam_id INNER join teacheralloc on  teacheralloc.id=result.teacheralloc_id inner JOIN subject on subject.id=teacheralloc.subject_id INNER join student on promotion.student_id=student.id where result.is_delete=0  AND result.exam_id='$eid' AND promotion.is_active='1'")->result_array()[0];
               // $data['exam']=$this->db->query("SELECT * from `exam` where id='eid'")->result_array();
               $data['student'] = [];
               $data['student_att']=[];
               $student=$this->db->query("SELECT student.img,student.id as stid,promotion.id as pro_id,section.section_name,class.class_name,student.grno,student.student_name,student.father_name from `student` inner join `promotion` on student.id=promotion.student_id inner join `class` on class.class_id=promotion.class_id inner join `section` on section.section_id=promotion.section_id where student.status='0' AND promotion.class_id='$pid' AND promotion.is_active='1' AND promotion.is_delete='0'")->result_array();
               foreach ($student as $key => $value) {
                $data['student'][$key] = $value;
                $student_grno=$value['stid'];
                $pro=$value['pro_id'];
               $data['result'][$key]=$this->db->query("SELECT result.id,result.total_marks,result.obtained_marks,result.passing_marks,result.paper_date,subject.name as sname,exam.name as ename,exam.start,exam.end,student.grno,student.student_name,student.father_name from `result` inner join `promotion` on result.promotion_id=promotion.id inner join `exam` on exam.id=result.exam_id INNER join teacheralloc on  teacheralloc.id=result.teacheralloc_id inner JOIN subject on subject.id=teacheralloc.subject_id INNER join student on promotion.student_id=student.id where result.is_delete=0  AND result.exam_id='$eid' AND promotion.id='$pro' AND promotion.is_active='1'")->result_array();
               $data['student_att'][$key]=$this->db->query("SELECT COUNT(status_id) as total ,(select COUNT(status_id) from studentatt WHERE status_id=1 AND studentatt.student_id='$student_grno' AND studentatt.is_deleted=0) as pre FROM studentatt inner JOIN promotion on studentatt.promotion_id=promotion.id where studentatt.is_deleted=0 AND studentatt.student_id='$student_grno'")->result_array();
               
               }
               

              $this->load->view('printable/resultclass',$data);
      }
      else
      {
        redirect('exam/result','refresh');
      }
   }

      public function datesheet()
    {
         $this->user_model->check_permissions("exam/datesheet");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        if($this->is_super)
        {
           $data['branch'] = $this->db->select('id,name')->from("branch")->where("is_delete","0")->get()->result_array();
        }else{
            $data['branch'] = $this->db->select('id,name')->from("branch")->where("is_delete","0")->where("id",$this->branch)->get()->result_array();
        }
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("datesheet/datesheet",$data);
    }

    public function add_datesheet()
    {
        if($this->input->post())
        {
            
            $branch = $this->input->post("branch",true);
            $class = $this->input->post("class",true);
              $subject = $this->input->post("subject",true);
              $exam= $this->input->post("exam",true);
                 $day= $this->input->post("day",true);
               $date = $this->input->post("date",true);
            $time = $this->input->post("time_start",true);
            $time_e = $this->input->post("time_end",true);
            $data = array(
                "bid"=>$branch,
                "class_id"=>$class,
                 "exam_id"=>$exam,
                 "subject_id"=>$subject,
                 "date_exam"=>$date,
                 "day_exam"=> $day ,     
                "start_time"=>$time,
                "end_time"=>$time_e
            );
            $this->db->insert("datesheet",$data); 
            redirect("Exam/viewsheet");
        }else
        redirect("Exam/datesheet","refresh");
    }

    public function viewsheet()
    {
        $this->user_model->check_permissions("exam/viewsheet");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        if($this->user_model->is_super())
            $d=$this->db->select("datesheet.datesheet_id,datesheet.date_exam,class.class_name,subject.name as subject_name,exam.name as exam_name")->from("datesheet")->join("class","class.class_id=datesheet.class_id")->join("subject","subject.id=datesheet.subject_id")->join("exam","exam.id=datesheet.exam_id")->where("datesheet.is_delete","0")->get()->result_array();
        else
            $d=$this->db->select("datesheet.datesheet_id,datesheet.date_exam,class.class_name,subject.name as subject_name,exam.name as exam_name")->from("datesheet")->join("class","class.class_id=datesheet.class_id")->join("subject","subject.id=datesheet.subject_id")->join("exam","exam.id=datesheet.exam_id")->where("datesheet.bid",$this->user_model->getBranch())->where("datesheet.is_delete","0")->get()->result_array();

        $data["data"]=$d;
        $data["i"]=1;


        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("datesheet/viewsheet",$data);
    }
    
     public function edit1($id=0)
    {
        $data['menu'] = $this->load_model->menu();
        $this->db->select("datesheet_id,bid,class_id,exam_id,subject_id,date_exam,day_exam,start_time,end_time"); 
        $this->db->from('datesheet');
        $this->db->where('is_delete','0'); 
        $this->db->where('datesheet_id',$id);
        $query = $this->db->get();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['data'] = $query->result_array()[0];
        $data['class'] = $this->db->select('class_id,class_name')->from("class")->where("is_delete","0")->where("branch",$data['data']['bid'])->get()->result_array();
        $data['subject'] = $this->db->select('id,name')->from("subject")->where("is_deleted","0")->where("class_id",$data['data']['class_id'])->get()->result_array();
        $data['branch'] = $this->db->select('id,name')->from("branch")->where("is_delete","0")->where("id",$this->branch)->get()->result_array();
        $data['exam'] = $this->db->select('id,name')->from("exam")->where("branch_id",$data['data']['bid'])->where("class_id",$data['data']['class_id'])->where("is_delete","0")->get()->result_array();
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('datesheet/edit1',$data);
    }

    public function edit_datesheet()
    {
        if($this->input->post())
        {
            
            $id = $this->input->post("id",true);
            $branch = $this->input->post("branch",true);
            $class = $this->input->post("class",true);
              $subject = $this->input->post("subject",true);
              $exam= $this->input->post("exam",true);
                 $day= $this->input->post("day",true);
               $date = $this->input->post("date",true);
            $time = $this->input->post("time_start",true);
            $time_e = $this->input->post("time_end",true);
            $data = array(
                "bid"=>$branch,
                      "class_id"=>$class,
                 "exam_id"=>$exam,
                 "subject_id"=>$subject,
                 "date_exam"=>$date,
                 "day_exam"=> $day ,     
                "start_time"=>$time,
                "end_time"=>$time_e
            );
            $this->db->where("datesheet_id",$id); 
            $this->db->update("datesheet",$data); 
            redirect("Exam/viewsheet");
        }else
        redirect("Exam/viewsheet","refresh");
    }
    
    public function delete1($id)
    {
            if(!empty($id))
            {
                $data = array(
                    'is_delete' => "1"
                );
                $this->db->where("datesheet_id",$id);
                $this->db->update("datesheet",$data); 
            }
            redirect('Exam/viewsheet','refresh');
    }

    public function date() 
    {
        $this->user_model->check_permissions("exam/date");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        if($this->is_super)
        {
            $data['branch'] = $this->db->select('id,name')->from("branch")->where("is_delete","0")->get()->result_array();
            $data['exam'] = $this->db->select('id,name')->from("exam")->where("is_delete","0")->get()->result_array();
        }else{
            $data['branch'] = $this->db->select('id,name')->from("branch")->where("is_delete","0")->where("id",$this->branch)->get()->result_array();
            $data['exam'] = $this->db->select('id,name')->from("exam")->where("is_delete","0")->where("branch_id",$this->branch)->get()->result_array();
        }
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("datesheet/view_datesheet",$data);
    }

    public function date1()
    {
        if($this->input->post())
        {
            $branch = $this->input->post("branch");
            $class = $this->input->post("class");
            $exam = $this->input->post("exam");
            $data['b_title'] = $this->db->query("select title from branch where id='$branch'")->result_array()[0]['title'];
            $data['data'] = $this->db->select('datesheet.*,class.class_name,exam.name as exam_name,subject.name as subject_name')->from("datesheet")->join("class","class.class_id=datesheet.class_id")->join("exam","exam.id=datesheet.exam_id")->join("subject","subject.id=datesheet.subject_id")->where("datesheet.is_delete","0")->where("datesheet.bid",$branch)->where("datesheet.class_id",$class)->where("datesheet.exam_id",$exam)->get()->result_array();
            $this->load->view("datesheet/view_sheet",$data);   
        
        }
    }

    public function rollno()
    {
$this->user_model->check_permissions("exam/rollno");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        if($this->is_super)
        {
            $data['branch'] = $this->db->select('id,name')->from("branch")->where("is_delete","0")->get()->result_array();
        }else{
            $data['branch'] = $this->db->select('id,name')->from("branch")->where("is_delete","0")->where("id",$this->branch)->get()->result_array();
        }
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("datesheet/rollno",$data);
    }

    public function viewrollno() 
    {
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        // Getting Values from URI Segments
        $branch = $this->uri->segment('3');
        $class = $this->uri->segment('4');
        $section = $this->uri->segment('5');
        $exam = $this->uri->segment('6');
        //
        $data['exam']=$exam; 
        $data['class']=$class; 
        $data['section']=$section; 
        $d=$this->db->query("SELECT promotion.id as stid,grno,student_name from rollnoslip INNER JOIN promotion on promotion.id=rollnoslip.student_id inner join student on student.id=promotion.student_id inner join class on class.class_id=promotion.class_id INNER join section on section.section_id=promotion.section_id WHERE promotion.is_active='1' AND promotion.is_delete='0' AND rollnoslip.class_id='$class' AND rollnoslip.section_id='$section' AND rollnoslip.branch_id='$branch' AND rollnoslip.exam_id='$exam' AND student.status='0'")->result_array();
        $data["data"]=$d;
        $data["i"]=1;


        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("datesheet/viewrollno",$data);
    }

    public function rolldate()
    {
           // $exam = $this->input->post("exam");
           if($this->uri->segment('3')){
            $id=$this->uri->segment('3');
            $exam_id=$this->uri->segment('4');
            $branch=$this->user_model->getbranch();
            
            $data['b_header'] = $this->db->query("SELECT name,title,tagline,short_address,phone_no,email,logo1,logo2 from branch where id='$branch' AND is_delete='0'")->result_array()[0];
            $rollnoslip = $this->db->query("SELECT seat_no,class_id from rollnoslip where student_id='$id' AND `exam_id`='$exam_id' AND is_delete='0'")->result_array()[0];
            $data['seat_no'] = $rollnoslip['seat_no'];
            $class = $rollnoslip['class_id'];
            $data['student'] = $this->db->query("SELECT student.id,roll_no,student_name,father_name,class.class_name,student.grno,student.img,student.dob,section.section_name from student INNER JOIN promotion on promotion.student_id=student.id inner join class on class.class_id=promotion.class_id INNER join section on section.section_id=promotion.section_id  WHERE promotion.is_active='1' AND promotion.is_delete='0' AND promotion.id='$id'")->result_array()[0];
            $data['exam'] = $this->db->select('id,name')->from("exam")->where("is_delete","0")->where('id',$exam_id)->get()->row_array();
            $data['data'] = $this->db->query("SELECT datesheet.date_exam,datesheet.day_exam,datesheet.start_time,datesheet.end_time,subject.name as subject_name FROM `datesheet` INNER JOIN class on datesheet.class_id=class.class_id INNER JOIN subject ON subject.id=datesheet.subject_id  WHERE datesheet.is_delete='0' and datesheet.class_id='$class' and datesheet.exam_id='$exam_id'")->result_array();
            $data['note'] = $this->db->query("SELECT note FROM `note` WHERE branch_id='$branch' and note.is_delete='0'")->result_array();
            $this->load->view("datesheet/previewroll",$data);
        }
        else
        {
            redirect('exam/rollno',refresh);
        }
     
    }

    public function rolldatesection()
    {
           // $exam = $this->input->post("exam");
        if($this->uri->segment('3')){
            $class=$this->uri->segment('3');
            $section=$this->uri->segment('4');
            $exam_id=$this->uri->segment('5');
            $branch=$this->user_model->getbranch();
            
            $data['b_header'] = $this->db->query("SELECT name,title,tagline,short_address,phone_no,email,logo1,logo2 from branch where id='$branch' AND is_delete='0'")->result_array()[0];
            $data['exam'] = $this->db->select('id,name')->from("exam")->where("is_delete","0")->where('id',$exam_id)->get()->row_array();
            $data['data'] = $this->db->query("SELECT datesheet.date_exam,datesheet.day_exam,datesheet.start_time,datesheet.end_time,subject.name as subject_name FROM `datesheet` INNER JOIN class on datesheet.class_id=class.class_id INNER JOIN subject ON subject.id=datesheet.subject_id  WHERE datesheet.is_delete='0' and datesheet.class_id='$class' and datesheet.exam_id='$exam_id'")->result_array();
            $data['note'] = $this->db->query("SELECT note FROM `note` WHERE branch_id='$branch' and note.is_delete='0'")->result_array();
            /**/
            $data['students'] = $this->db->query("SELECT student.id,roll_no,student_name,father_name,class.class_name,student.grno,student.img,student.dob,section.section_name from student INNER JOIN promotion on promotion.student_id=student.id inner join class on class.class_id=promotion.class_id INNER join section on section.section_id=promotion.section_id  WHERE promotion.is_active='1' AND promotion.is_delete='0' AND promotion.class_id='$class' AND promotion.section_id='$section'")->result_array();
            //$rollnoslip = $this->db->query("SELECT seat_no,class_id from rollnoslip where student_id='$id' AND `exam_id`='$exam_id' AND is_delete='0'")->result_array()[0];
            //$data['seat_no'] = $rollnoslip['seat_no'];
            $this->load->view("printable/rollnoslip_section",$data);
        }
        else
        {
            redirect('exam/rollno',refresh);
        }
     
    }

    public function rollnoslip ()
    {
        if($this->input->post())
        {
            $id = $this->input->post("id",true);
            $branch = $this->input->post("branch",true);
            $class = $this->input->post("class",true);
            $section = $this->input->post("section",true);
            $exam= $this->input->post("exam",true);
            $data=$this->db->query("SELECT promotion.id,student.grno FROM `promotion` INNER JOIN student ON student.id=promotion.student_id WHERE student.branch='$branch' and promotion.class_id='$class' and promotion.is_active='1' and promotion.is_delete='0'")->result_array();
            $series = $this->random_numbers(4);
            foreach ($data as $key => $value) {
                $student_id = $value['id'];
                $exam_date = $this->db->select("start")->from("exam")->where("id",$exam)->get()->row_array()['start'];
                $seat_no = $series++; //date("ymd",strtotime($exam_date))..$value['grno']
                $count = $this->db->select("id")->from("rollnoslip")->where("student_id",$student_id)->where("branch_id",$branch)->where("class_id",$class)->where("section_id",$section)->where("exam_id",$exam)->where("is_delete","0")->count_all_results();
                if($count==0)
                {
                    $data = array(
                        "branch_id"=>$branch,
                        "class_id"=>$class,
                        "exam_id"=>$exam,
                        "section_id"=>$section,
                        "student_id"=>$student_id,
                        "seat_no"=>$seat_no
                    );
                    $this->db->insert("rollnoslip",$data); 
                }
            }
            redirect("Exam/viewrollno/$branch/$class/$section/$exam","refresh");
        }
    }
 public function notes()
    {
        $this->user_model->check_permissions("exam/notes");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        if($this->is_super)
        {
           $data['branch'] = $this->db->select('id,name')->from("branch")->where("is_delete","0")->get()->result_array();
        }else{
            $data['branch'] = $this->db->select('id,name')->from("branch")->where("is_delete","0")->where("id",$this->branch)->get()->result_array();
        }
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("datesheet/notes",$data);
    }
    public function add_note()
    {
        if($this->input->post())
        {
            
            $branch = $this->input->post("branch",true);
            $note = $this->input->post("note",true);
            
            $data = array(
                "branch_id"=>$branch,
                "note"=>$note
                
            );
            $this->db->insert("note",$data); 
            redirect("Exam/viewnote");
        }else
        redirect("Exam/viewnote","refresh");
    }
    public function viewnote()
    {
        $this->user_model->check_permissions("exam/viewnote");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        if($this->is_super)
        {
           $d=$this->db->select("note.id,note.note")->from("note")->where("note.is_delete","0")->get()->result_array();
        }else{
            $d=$this->db->select("note.id,note.note")->from("note")->where("note.is_delete","0")->where("branch_id",$this->branch)->get()->result_array();
        }

        $data["data"]=$d;
        $data["i"]=1;


        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("datesheet/viewnote1",$data);
    }
    public function editnote($id=0)
    {
        $data['menu'] = $this->load_model->menu();
        $this->db->select("id,,branch_id,note"); 
        $this->db->from('note');
        $this->db->where('is_delete','0'); 
        $this->db->where('id',$id);
        $query = $this->db->get();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['branch'] = $this->db->select('id,name')->from("branch")->where("is_delete","0")->where("id",$this->branch)->get()->result_array();
        $data['data'] = $query->result_array()[0];
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
       
        $this->load->view("datesheet/editnote",$data);
    }
    public function edit_note()
    { 
        
         if($this->input->post())
        {    
                 $id = $this->input->post("id",true);
                $branch = $this->input->post("branch",true);
                $note = $this->input->post("note",true);
                
             $data = array(
                "branch_id"=>$branch,
                "note"=>$note
                
            );
            $this->db->where("id",$id); 
            $this->db->update("note",$data); 
            redirect("Exam/viewnote");
         }
        else
            redirect("Exam/viewnote","refresh");
    }

    
   
  public function notedelete($id)
    {
        //base_url()."Exam/notedelete/$id"
            if(!empty($id))
            {
                $data = array(
                    'is_delete' => "1"
                );
                $this->db->where("id",$id);
                $this->db->update("note",$data); 
            }
            redirect('Exam/viewnote','refresh');
    }

    private function random_numbers($digits) {
        $min = pow(10, $digits - 1);
        $max = pow(10, $digits) - 1;
        return mt_rand($min, $max);
    }
    
    private function marksort($a, $b) {
        $a = $a['obtained_marks'];
        $b = $b['obtained_marks'];
        if ($a == $b)
            return 0;
        return ($a > $b) ? -1 : 1;
    }
    
    private function makeposition($arr) {
        usort($arr, array($this,"marksort"));
        $i = 1;
        foreach($arr as $k=>$v)
        {
            $p = $i;
            if($p==1 OR $p==21 OR $p==31)
                $subfix = "st";
            else if($p==2 OR $p==22 OR $p==32 OR $p==42 OR $p==52 OR $p==62 OR $p==72 OR $p==82 OR $p==92)
                $subfix = "nd";
            else if($p==3 OR $p==23 OR $p==33 OR $p==43 OR $p==53 OR $p==63 OR $p==73 OR $p==83 OR $p==93)
                $subfix = "rd";
            else
                $subfix = "th";
            $arr[$k]['position'] = $p.$subfix;
            $i++;
        }
        var_dump("<pre>",$arr);
    }

}
