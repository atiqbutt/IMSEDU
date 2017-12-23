<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {
     private $userInfo = array();
    public function __construct()
    {
        parent::__construct();
        $this->user_model->check_login("admin");
        $this->load->model('Subject_model','su');
        $this->load->model("user_model");
         $this->load->model('student_model','studentmo');

        $this->userInfo = $this->user_model->userInfo("first_name,last_name");

    }  
   public function index($q="all",$p=1)
    {
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        if(!$this->user_model->is_super())
        { 
            $data['branch']=$this->user_model->getBranch(); 
            $branch=$this->user_model->getBranch(); 
         }else {
            $data['branch']=$this->studentmo->getbranch()->result_array();
            // $branch=$this->studentmo->getbranch()->result_array();
         }

        $q = urldecode($q);
        $p = $p<1?1:$p;
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        
        $sq1 = "";
        if($q!="all")
        {
            $sq1 .= "AND (section.section_name like '%".$q."%' OR "; 
            $sq1 .= "subject.name like '%".$q."%' OR "; 
            $sq1 .= "class.class_name like '%".$q."%' )";
        }
        $total = $this->db->query("SELECT count(*) as total FROM `subject` inner join `class` on class.class_id=subject.class_id inner join `section`  on section.section_id=subject.section_id  where is_deleted='0' AND class.branch=$branch $sq1")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT subject.id,section.section_name, subject.name,class.class_name FROM `subject` inner join `class` on class.class_id=subject.class_id inner join `section`  on section.section_id=subject.section_id  WHERE class.branch = '$branch' AND is_deleted='0'   $sq1 LIMIT 0, $per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT subject.id,section.section_name, subject.name,class.class_name FROM `subject` inner join `class` on class.class_id=subject.class_id inner join `section` on section.section_id=subject.section_id  WHERE class.branch = '$branch' AND is_deleted='0' $sq1 LIMIT $offset, $per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;

        $data['subject'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
        
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("subject/subject_add",$data);
        $this->load->view("footer");
    }
    public function savesub()
    {
        $id=$this->input->post('id',true);
        if($id>0)
        {   
            $data = array('name' => $this->input->post('subname',true) ,
                           'id'=> $this->input->post('id',true)   );
            var_dump($data);
            $check=$this->su->update($data,$id);
            if($check==true)
            {
                redirect("subject","index");
            }else
            {
                echo "could not Saved Subject";
            }
        }else
        {
            $data=$this->input->post();
            
            $check=$this->su->savesubject($data);
            if($check==true)
            {
                redirect("subject","index");
            }else
            {
                echo "could not Saved Subject";
            }
        }
    }
    public function actions($ref="",$id=0)
    {
       
        if($ref=="edit")
        {
            $data['menu'] = $this->load_model->menu();
            $data['base_url'] = base_url();
            $data['userInfo'] = $this->userInfo;
            if(!$this->user_model->is_super())
            { 
            $data['branch']=$this->user_model->getBranch(); 
            }else {
            $data['branch']=$this->studentmo->getbranch()->result_array();
            }
            $data['subject']=$this->su->id($id)->result_array()[0];
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view("subject/subject_edit",$data);
            $this->load->view("footer");
        }else if($ref=="delete")
        {
            
            $tr=$this->su->del($id);
            if($tr==true)
            {
                redirect("subject","index");
            }else{
                echo "Colud not Delete ";
            }

        }
    }
    public function allocation($q="all",$p=1)
    {   
$this->user_model->check_permissions("Subject/allocation");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
         $branch=$this->user_model->getbranch(); 
        if(!$this->user_model->is_super())
        { 
            $data['branch']=$this->user_model->getbranch(); 
            
         }else {
            $data['branch']=$this->studentmo->getbranch()->result_array();
         }
           $q = urldecode($q);
        $p = $p<1?1:$p;
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        
        $sq1 = "";
        if($q!="all")
        {
            $sq1 .= "AND (teacher.firstname like '%".$q."%' OR "; 
            $sq1 .= "teacher.lastname like '%".$q."%' OR ";
            $sq1 .= "subject.name like '%".$q."%' OR "; 
            $sq1 .= "class.class_name like '%".$q."%' )";
        }
          $total = $this->db->query("SELECT count(*) as total from teacheralloc inner join teacher on teacheralloc.teacher_id=teacher.id inner join class on class.class_id=teacheralloc.class_id inner join section on section.section_id=teacheralloc.section_id inner join subject on subject.id=teacheralloc.subject_id where teacheralloc.is_deleted=0 and class.branch='$branch' $sq1")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        if($total<=$offset)
         {
       $query=$this->db->query("SELECT teacheralloc.id,teacher.firstname,teacher.lastname,class.class_name,section.section_name,subject.name as subname from teacheralloc inner join teacher on teacheralloc.teacher_id=teacher.id inner join class on class.class_id=teacheralloc.class_id inner join section on section.section_id=teacheralloc.section_id inner join subject on subject.id=teacheralloc.subject_id where teacheralloc.is_deleted=0 and class.branch='$branch' $sq1 limit 0, $per_page");
        
 }else
  $query=$this->db->query("select teacheralloc.id,teacher.firstname,teacher.lastname,class.class_name,section.section_name,subject.name as subname from teacheralloc inner join teacher on teacheralloc.teacher_id=teacher.id inner join class on class.class_id=teacheralloc.class_id inner join section on section.section_id=teacheralloc.section_id inner join subject on subject.id=teacheralloc.subject_id where teacheralloc.is_deleted=0 and class.branch='$branch' $sq1 limit $offset,$per_page");
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;
        $data['subject'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("subject/subjectallocation",$data);
        $this->load->view("footer");
        
    }
    public function savealloc()
    {
        
            $class=$this->input->post('class',true);
            $section=$this->input->post('section',true);
            $teacher=$this->input->post('teacher',true);
            $subject=$this->input->post('subject[]',true);
            foreach ($subject as $key => $value)
            {
                $data = array('teacher_id' =>$teacher ,
                            'subject_id'=>$value,
                            'section_id'=>$section,
                            'class_id'=>$class  );
                $check=$this->su->insertalloc($data);
            }
            if($check==true){
                redirect("subject/allocation","refresh");
           }else{
               echo "could not saved";
           }
        }    
    public function updatealloc()
    {
        $id=$this->input->post('id',true);
        $val=$this->input->post('subject[]',true);
        $data = array('subject_id' =>$val[0]);
        
        $check=$this->su->updatealloc($data,$id);
        if($check==true){
             redirect("subject/allocation","refresh");
        }else{
            echo "Could not Update";
        }
    }
    
    public function showalloc($p=1)
    {
        
        $data['menu'] = $this->load_model->menu();
        $total = $this->db->query("SELECT count(*) as total FROM `teacheralloc`")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $this->db->select("teacheralloc.id,teacher.firstname,teacher.lastname,class.class_name,section.section_name,subject.name as subname"); 
        $this->db->from('teacheralloc');
        $this->db->join('teacher', 'teacheralloc.teacher_id=teacher.id');
        $this->db->join('class', 'class.class_id=teacheralloc.class_id');
        $this->db->join('section', 'section.section_id=teacheralloc.section_id');
        $this->db->join('subject', 'subject.id=teacheralloc.subject_id');
        $this->db->where('teacheralloc.is_deleted',0)->limit($per_page,$offset);
        $query = $this->db->get();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['subject'] = $query->result_array();
        $data['total'] = ceil($total / $per_page);
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('subject/showalloc',$data);
    }
    public function actionsalloc($ref="",$value=0)
    {
        if($ref=="edit"){
            $data['menu'] = $this->load_model->menu();
            $data['base_url'] = base_url();
            $data['userInfo'] = $this->userInfo;
            $data['subject']=$this->su->allocedit($value)->result_array()[0];
            $cl=$data['subject']['class_id'];
            $se=$data['subject']['section_id'];
            $data['sub']=$this->su->subjectagainstclorsec($cl,$se);
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view("subject/editalloc",$data);
            $this->load->view("footer");


        }else if($ref=="del"){
            $data['menu'] =$this->load_model->menu();
            $data['base_url'] = base_url();
            $data['userInfo'] = $this->userInfo;
            $check=$this->su->allocdel($value);
            if($check==true){
                redirect("subject/allocation/","refresh");
            }else
            {
                echo "could not Delete";
            } 
        }
    }
}