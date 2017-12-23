<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Load extends CI_Controller {

	private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
		$this->load->model("user_model");
                $this->load->model("Teacher_model");
                $this->load->model("Performance_model");
                $this->load->model("Staff_model");
                $this->load->model("salary_model");
                 
		//$this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

         public function TeacherdeductSerch($id='')
    {
            $branch=$this->user_model->getbranch();
        
        $this->db->select('deduction.id,teacher.firstname,teacher.lastname,deduction.refrence,deduction.reason,deduction.amount,deduction.month');    
        $this->db->from('deduction');
        $this->db->join('teacher', 'teacher.id=deduction.bothid');
        $this->db->where('deduction.status',0)->where('deduction.is_delete',0)->where('deduction.refrence','teacher')->where('teacher.branch',$branch);
            $query = $this->db->like('teacher.firstname',$id)->limit(20,0)->get()->result();
           echo json_encode($query);
    }
     public function staffdeductSerch($id='')
    {
            $branch=$this->user_model->getbranch();
        
        $this->db->select('deduction.id,staff.firstname,staff.lastname,deduction.refrence,deduction.reason,deduction.amount,deduction.month');    
        $this->db->from('deduction');
        $this->db->join('staff', 'staff.id=deduction.bothid');
        $this->db->where('deduction.status',0)->where('deduction.is_delete',0)->where('deduction.refrence','staff')->where('staff.branch',$branch);
            $query = $this->db->like('teacher.firstname',$id)->limit(20,0)->get()->result();
           echo json_encode($query);
    }




      public function StaffSecurtySerch($id='')
    {
            $branch=$this->user_model->getbranch();
            $this->db->select('security_deduct.id,staff.firstname,staff.lastname,security_deduct.refrence,security_deduct.security_amount,security_deduct.detuct_amount,security_deduct.remendar_amount,security_deduct.month');    
            $this->db->from('security_deduct');
            $this->db->join('staff', 'staff.id=security_deduct.bothid');
            $this->db->where('security_deduct.status',0)->where('security_deduct.is_delete',0)->where('staff.branch',$branch)->where('security_deduct.refrence','staff');
            $query = $this->db->like('staff.firstname',$id)->limit(20,0)->get()->result();
           echo json_encode($query);
    }

       public function TeacherSecurtySerch($id='')
    {
            $branch=$this->user_model->getbranch();
            $this->db->select('security_deduct.id,teacher.firstname,teacher.lastname,security_deduct.refrence,security_deduct.security_amount,security_deduct.detuct_amount,security_deduct.remendar_amount,security_deduct.month');    
            $this->db->from('security_deduct');
            $this->db->join('teacher', 'teacher.id=security_deduct.bothid');
            $this->db->where('security_deduct.status',0)->where('teacher.branch',$branch)->where('security_deduct.is_delete',0)->where('security_deduct.refrence','teacher');
            $query = $this->db->like('teacher.firstname',$id)->limit(20,0)->get()->result();
            echo json_encode($query);
    }

    public function user($condition="",$v="")
    {
        if($condition=="role")
        {
            if(!empty($v))
            {
                $result = $this->db->query("SELECT `id`,`first_name`,`last_name` FROM `admin` WHERE `role_id`='$v'")->result_array();
                foreach ($result as $key => $value) {
                    echo '<option value="'.$value['id'].'">'.$value['first_name'].' '.$value['last_name'].'</option>';
                }
            }
            else
                echo "";
        }
    }
public function student($cl=0,$se=0)
    {
        
            if(!empty($cl && $se))
            {
                    $branch=$this->user_model->getbranch();
               $result = $this->db->query("select student.id,student.student_name,student.grno from `student` inner join `promotion` on student.id=promotion.student_id where promotion.class_id='$cl' and promotion.section_id='$se' AND promotion.is_active='1' AND student.status='0' AND student.branch='$branch'")->result_array();

                foreach ($result as $key => $value) {
                    echo '<option value="'.$value['id'].'">'.$value['grno'].' .'.$value['student_name'].'</option>';
                }
            }
            else
                echo "";
        
    }
public function students($branch='',$class='',$section='',$session='')
    {
        
            if(!empty($branch) && !empty($class) && !empty($section) && !empty($session))
            {
               $result = $this->db->query("select promotion.id,student.grno,student.student_name from `promotion` inner join `student` on student.id=promotion.student_id where promotion.class_id='$class' and promotion.section_id='$section' AND promotion.session_id=$session AND promotion.is_active='1' AND promotion.is_delete='0' AND student.branch='$branch'")->result_array();

                foreach ($result as $key => $value) {
                    echo '<option value="'.$value['id'].'" >'.$value['grno']." - ".$value['student_name'].'</option>';
                }
            }
            else
                echo "";
        
    }
    public function classs($condition="",$v="")
    {
        if($condition=="role")
        {
            if(!empty($v))
            {
                $result = $this->db->query("SELECT `class_id`,`class_name` FROM `class` WHERE `branch`='$v'  AND is_delete='0'")->result_array();
                foreach ($result as $key => $value) {
                    echo "<option value='".$value['class_id']."'>".$value['class_name']."</option>";
                }
            }
            else
                echo "";
        }
    }

    public function section($condition="",$v="")
    {
        if($condition=="role")
        {
            if(!empty($v))
            {
                $result = $this->db->query("SELECT `section_id`,`section_name` FROM `section` WHERE `class_id`='$v' AND is_delete='0'")->result_array();
                foreach ($result as $key => $value) {
                    echo "<option value='".$value['section_id']."'>".$value['section_name']."</option>";
                }
            }
            else
                echo "";
        }
    }
    public function taluka($condition="",$v="")
    {
        if($condition=="role")
        {
            if(!empty($v))
            {
                $result = $this->db->query("SELECT `city_id`,`city_name` FROM `city` WHERE `district_id`='$v'")->result_array();
                foreach ($result as $key => $value) {
                    echo "<option value='".$value['city_id']."'>".$value['city_name']."</option>";
                }
            }
            else
                echo "";
        }
    }


    public function province($condition="",$v="")
    {
        if($condition=="role")
        {
            if(!empty($v))
            {
                $result = $this->db->query("SELECT `province_id`,`province_name` FROM `province` WHERE `country_id`='$v'")->result_array();
                foreach ($result as $key => $value) {
                    echo "<option value='".$value['province_id']."'>".$value['province_name']."</option>";
                }
            }
            else
                echo "";
        }
    }

        public function district($condition="",$v="")
    {
        if($condition=="role")
        {
            if(!empty($v))
            {
                $result = $this->db->query("SELECT `id`,`name` FROM `district` WHERE `province_id`='$v'")->result_array();
                foreach ($result as $key => $value) {
                    echo "<option value='".$value['id']."'>".$value['name']."</option>";
                }
            }
            else
                echo "";
        }
    }
     public function againstdatestaffatt($value='0000-00-00',$p=1)
    {
        $total = $this->db->query("SELECT count(*) as total FROM `staffatt`")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $this->db->select('staff.firstname,staff.lastname,staff.contact,staff.designation,attendancestatus.status,staff.id,staffatt.date');    
        $this->db->from('staffatt');
        $this->db->join('staff', 'staffatt.staff_id = staff.id');
        $this->db->join('attendancestatus', 'attendancestatus.id = staffatt.status_id');
        $this->db->where('is_deleted',0 )->where('date',$value)->limit($per_page,$offset);
        $query = $this->db->get();
        $staffatt = $query->result_array();
        $return = "";
        $i = 1;
        foreach ($staffatt as $key => $value) {
            $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['firstname']." ".$value['lastname']."</td>";
            $return .= "<td>".$value['contact']."</td>";
            $return .= "<td>".$value['date']."</td>";
            $return .= "<td>".$value['designation']."</td>";
            $return .= "<td>".$value['status']."</td>";
            $return .= "<td><a href='".base_url()."staff/actions/edit/".$value['id']."'><i class='fa fa-edit'></i></a>
            <a href='".base_url()."staff/actions/del/".$value['id']."'><i class='fa fa-trash'></i></a></td>";
            $return .= "</tr>";
        }
        echo $return;
    }
    public function studentagainstclass($value=0)
    {
        $this->db->select('student.id,student.student_name,student.father_name,student.roll_no,student.grno,class.class_name,section.section_name');    
        $this->db->from('student');
        $this->db->join('promotion pro', 'pro.student_id=student.id');
        $this->db->join('class', 'class.class_id=pro.class_id');
        $this->db->join('session ', 'session.id=pro.session_id');
          
        $this->db->join('section', 'section.section_id=pro.section_id')->where('student.status',0)->where('pro.class_id',$value);
        $query = $this->db->get()->result_array();
        $data=$this->Teacher_model->AttendanceStatus();
        $return="";
        $i=1;
        foreach ($query as $key => $value) 
        {
            $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['grno']."</td>";
            $return .= "<td>".$value['roll_no']."</td>";
            $return .= "<td>".$value['student_name']."</td>";
            $return .= "<td>".$value['father_name']."</td>";
            $return .= "<td>".$value['class_name']."</td>";
            $return .= "<td>".$value['section_name']."</td>";
            $return .="<td>";
            foreach ($data as $key => $dt) 
            {
                $return .='<input type="radio"';
                if($dt["status"]=="P")
                { 
                    $return .= "checked ";
                    }
                $return .='name="status['. $value['id'].']"  required="required" value="'. $dt['id'].'"/>&nbsp;<span style="color:black;font-size:15px">'. $dt['status'].'</span>&nbsp;';
                }
                $return .= "</td>";
                $return .= "</tr>"; 
                }
                echo $return;
            }
             
             public function studentagainstsection($value=0,$se=0)
            {
        
                $this->db->select('student.id,student.student_name,student.father_name,student.roll_no,student.grno,class.class_name,section.section_name');    
        $this->db->from('student');
        $this->db->join('promotion pro', 'pro.student_id=student.id');
        $this->db->join('class', 'class.class_id=pro.class_id');
        $this->db->join('session ', 'session.id=pro.session_id');
$this->db->join('section', 'section.section_id=pro.section_id')->where('student.status',0)->where('pro.class_id',$value)
            ->where('pro.section_id',$se);     
                $query = $this->db->get()->result_array();
                $data=$this->Teacher_model->AttendanceStatus();
                $return="";
                $i=1;
                foreach ($query as $key => $value) {
                    $return .= "<tr>";
                    $return .= "<td>".$i++."</td>";
                    $return .= "<td>".$value['grno']."</td>";
                    $return .= "<td>".$value['roll_no']."</td>";
                    $return .= "<td>".$value['student_name']."</td>";
                    $return .= "<td>".$value['father_name']."</td>";
                    $return .= "<td>".$value['class_name']."</td>";
                    $return .= "<td>".$value['section_name']."</td>";
                    $return .="<td>";
                    foreach ($data as $key => $dt) {
                        $return .='<input type="radio"';
                        if($dt["status"]=="P"){ 
                            $return .= "checked ";
                            }
                        $return .='name="status['. $value['id'].']"  required="required" value="'. $dt['id'].'"/>&nbsp;<span style="color:black;font-size:15px">'. $dt['status'].'</span>&nbsp;';
                        }
                        $return .= "</td>";
                        $return .= "</tr>"; 
                        }
                        echo $return;
                    }
            public function againstdatestudentatt($value='0000-00-00',$p=1)
            {
                $total = $this->db->query("SELECT count(*) as total FROM `staffatt`")->result_array()[0]['total'];
                $per_page = 10;
                $offset = ($p - 1) * $per_page;
                 $this->db->select('s.student_name,s.grno,s.roll_no,class.class_name,section.section_name,studentatt.date,studentatt.id,attendancestatus.status');    
                $this->db->from('studentatt');
                $this->db->join('student s', 'studentatt.student_id = s.id');
                $this->db->join('promotion p','p.student_id=s.id' );
                $this->db->join('class', 'p.class_id = class.class_id');
                $this->db->join('section', 'p.section_id = section.section_id');
                
                $this->db->join('attendancestatus', 'attendancestatus.id = studentatt.status_id');
                $this->db->where('is_deleted',0 )->where('date',$value)->limit($per_page,$offset);
                $query = $this->db->get();
                $staffatt = $query->result_array();
                $return = "";
                $i = 1;
                    foreach ($staffatt as $key => $value) 
                    {
                            $return .= "<tr>";
                            $return .= "<td>".$i++."</td>";
                            $return .= "<td>".$value['grno']."</td>";
                            $return .= "<td>".$value['student_name']."</td>";
                            $return .= "<td>".$value['class_name']."</td>";
                            $return .= "<td>".$value['section_name']."</td>";
                            $return .= "<td>".$value['date']."</td>";
                            $return .= "<td>".$value['status']."</td>";
                            $return .= "<td><a href='".base_url()."student/actions/edit/".$value['id']."'><i class='fa fa-edit'></i></a>
                            <a href='".base_url()."student/actions/del/".$value['id']."'><i class='fa fa-trash'></i></a></td>";
                            $return .= "</tr>";
                    }
                  echo $return;
            }

              public function subagainstclass($id=0,$sec=0)
            {
                $this->db->select('subject.id,section.section_name, subject.name,class.class_name')->from('subject')
                ->join('class','class.class_id=subject.class_id')->join('section','section.section_id=subject.section_id')
                ->where('is_deleted',0)->where('subject.class_id',$id);
                $data=$this->db->get()->result_array();
                $return="";
                $i=1;
                foreach ($data as $key => $value) 
                {
                    $return .= "<tr>";
                    $return .= "<td>".$i++."</td>";
                    $return .= "<td>".$value['name']."</td>";
                    $return .= "<td>".$value['class_name']."</td>";
                    $return .= "<td>".$value['section_name']."</td>";
                    $return .= "<td><a href='".base_url()."subject/actions/edit/".$value['id']."'><i class='fa fa-edit'></i></a>
                    <a href='".base_url()."subject/actions/del/".$value['id']."'><i class='fa fa-trash'></i></a></td>";
                    $return .= "</tr>";
                }
                echo $return;
            }
    public function package($v="")
    {
        if(!empty($v))
        {
            $result = $this->db->query("SELECT `tution_fee` FROM `class` WHERE `class_id`='$v' AND is_delete='0'")->result_array();
            echo $result[0]['tution_fee'];
        }
        else
            echo 0;
    }
    
    public function admission_fee($v="")
    {
        if(!empty($v))
        {
            $branch = $this->user_model->getBranch();
            $result = $this->db->query("SELECT `admin_fee` FROM `class` WHERE `class_id`='$v' AND `is_delete`='0'")->result_array();
            echo $result[0]['admin_fee'];
        }
        else
            echo 0;
    }

    public function sibling($v="")
    {
        if(!empty($v))
        {
            $result = $this->db->query("SELECT count(*) as `count` FROM `student` WHERE `father_cnic`='$v'")->result_array();
            echo $result[0]['count'];
        }
        else
            echo 0;
    }

    public function fee_type($v="")
    {
        if(!empty($v))
        {
            $branch = $this->user_model->getBranch();
            $result = $this->db->query("SELECT `id`,`name` FROM `fee_def` WHERE `class_id`='$v' AND `branch_id`='$branch'  AND `is_delete`='0'")->result_array();
            foreach ($result as $key => $value) {
                echo "<option value='".$value['id']."'>".$value['name']."</option>";
            }
        }
        else
            echo "";
    }
      public function teacher($v=0)
                {
                     if(!empty($v))
                        {
                            $result = $this->db->query("SELECT `id`,`firstname`,`lastname` FROM `teacher` WHERE `branch`='$v'  AND is_delete='0'")->result_array();
                            var_dump($result);
                            foreach ($result as $key => $value) 
                            {
                            echo "<option value='".$value['id']."'>".$value['firstname'].''.$value['lastname']."</option>";
                            }
                        }
                        else
                             echo "";
                }
                
                public function subjectagainstsection($cl=0,$se=0)
                {
                    $data=$this->db->query("SELECT id,name FROM `subject` WHERE class_id='$cl' and section_id='$se'")->result_array();
                   
                    foreach ($data as $key => $value) {
                        echo "<input type='checkbox' value='".$value['id']."'  name='subject[]'  />".$value['name']. "<br>";
                    }
                }
 public function subject_class($c="")
    {
        if(!empty($c))
        {
            $result = $this->db->query("SELECT `id`,`name` FROM `subject` WHERE `class_id`='$c' AND `is_deleted`='0'")->result_array();
            foreach ($result as $key => $value) {
                echo "<option value='".$value['id']."'>".$value['name']."</option>";
            }
        }
        else
            echo "";
    }
                public function viewagainstteacher($value=0)
                {
                    $this->db->select("teacheralloc.id,teacher.firstname,teacher.lastname,class.class_name,section.section_name,subject.name as subname"); 
                    $this->db->from('teacheralloc');
                    $this->db->join('teacher', 'teacheralloc.teacher_id=teacher.id');
                    $this->db->join('class', 'class.class_id=teacheralloc.class_id');
                    $this->db->join('section', 'section.section_id=teacheralloc.section_id');
                    $this->db->join('subject', 'subject.id=teacheralloc.subject_id');
                    $this->db->where('teacheralloc.is_deleted',0)->where('teacheralloc.teacher_id',$value);
                    $query = $this->db->get()->result_array();
                    $return="";
                    $i=1;
                    foreach ($query as $key => $value) 
                    {
                            $return .= "<tr>";
                            $return .= "<td>".$i++."</td>";
                            $return .= "<td>".$value['firstname']." ".$value['lastname']."</td>";
                            $return .= "<td>".$value['subname']."</td>";
                            $return .= "<td>".$value['class_name']."</td>";
                            $return .= "<td>".$value['section_name']."</td>";
                            $return .= "<td><a href='".base_url()."subject/actionsalloc/edit/".$value['id']."'><i class='fa fa-edit'></i></a>
                            <a href='".base_url()."subject/actionsalloc/del/".$value['id']."'><i class='fa fa-trash'></i></a></td>";
                            $return .= "</tr>";
                    }
                    echo $return;


                }

    public function other_fee($v="")
    {
        if(!empty($v))
        {
            $branch = $this->user_model->getBranch();
            $result = $this->db->query("SELECT `id`,`name`,`amount` FROM `fee_def` WHERE `class_id`='$v' AND `branch_id`='$branch'  AND `is_delete`='0'")->result_array();
            foreach ($result as $key => $value) {
                echo '<div class="item form-group">
                        <label class=" col-md-1 col-sm-1 col-xs-6" for="other_fee"><input type="checkbox" name="fee['.$value['id'].'][name]" value="'.$value['name'].'"></span>
                        </label>
                        <label class=" col-md-2 col-sm-2 col-xs-6" for="other_fee">'.$value['name'].'</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="other_fee" class="form-control col-md-7 col-xs-12" name="fee['.$value['id'].'][value]" required="required" type="number" value="'.$value['amount'].'" min="0">
                        </div>
                      </div>';
            }
        }
        else
            echo "";
    }

   // public function subject($c="",$s="")
    //{
      //  if(!empty($c) && !empty($s))
        //{
          //  $result = $this->db->query("SELECT `id`,`name` FROM `subject` WHERE `class_id`='$c' AND `section_id`='$s'")->result_array();
            //foreach ($result as $key => $value) {
              //  echo "<option value='".$value['id']."'>".$value['name']."</option>";
            //}
        //}
        //else
          //  echo "";
    //}
 //=======================================================================Load subject according to class======================================
    public function subject($c="")
    {
      
        if(!empty($c))
        {
            $result = $this->db->query("SELECT `id`,`name` FROM `subject` WHERE `class_id`='$c'")->result_array();
            foreach ($result as $key => $value) {
                echo "<option value='".$value['id']."'>".$value['name']."</option>";
            }
        }
        else
            echo "";
    }

    public function exam($c="")
    {
        if(!empty($c))
        {
            $result = $this->db->query("SELECT `id`,`name` FROM `exam` WHERE `class_id`='$c'")->result_array();
            foreach ($result as $key => $value) {
                echo "<option value='".$value['id']."'>".$value['name']."</option>";
            }
        }
        else
            echo "";
    }

    public function exam_json($c="")
    {
        if(!empty($c))
        {
            $exam = $this->db->select("id,name")->from('exam')->where('class_id',$c)->get()->result_array();
            echo json_encode($exam);
        }
        else
            echo "";
    }

    public function per_menu($v="")
    {
        echo $this->load_model->per_menu($v);
    }
         public function getemp($va="")
            {
                          $branch=$this->user_model->getbranch();
                if(!empty($va))
                {
                    if($va=="teacher")
                    {
                        $data=$this->db->query("SELECT teacher.id,teacher.firstname,teacher.lastname,teacher.designation,teacher.qualification FROM `teacher` where branch=$branch and status=0 and is_delete=0 ")->result_array();
                        
                        if($data!=null){
                        foreach ($data as $key => $value) 
                        {
                        echo "<option value='".$value['id']."'>".$value['firstname'].' '.$value['lastname']." (".$value['designation'].' '.$value['qualification'].")</option>";
                        }
                        }else{
                            echo "";
                        }

                    }else if($va=="staff")
                    {
                        $data=$this->db->query("SELECT staff.id,staff.firstname,staff.lastname,staff.designation,staff.qualification FROM `staff`  where branch=$branch and status=0 ")->result_array();
                        
                        if($data!=null){
                        foreach ($data as $key => $value) 
                        {
                        echo "<option value='".$value['id']."'>".$value['firstname'].' '.$value['lastname']." (".$value['designation'].' '.$value['qualification'].")</option>";
                        }
                        }else{
                            echo "";
                        }
                    }
                 }
            }
                public function getemp_infodata($va="")
             {
                if(!empty($va))
                {
                    if($va=="teacher")
                    {
                         
                        
                        $data=$this->db->query("SELECT emp_info.id as empid ,teacher.id,teacher.firstname,teacher.lastname,teacher.designation,teacher.qualification FROM `emp_info` inner join teacher on teacher.id=emp_info.employe_id WHERE type='$va' ")->result_array();
                        if($data!=null){
                        foreach ($data as $key => $value) 
                        {
                        echo "<option value='".$value['empid']."'>".$value['firstname'].' '.$value['lastname']." (".$value['designation'].' '.$value['qualification'].")</option>";
                        }
                        }else{
                            echo "";
                        }

                    }else if($va=="staff")
                    {
                        $data=$this->db->query("SELECT emp_info.id as empid ,staff.id,staff.firstname,staff.lastname,staff.designation,staff.qualification FROM `emp_info` inner join staff on staff.id=emp_info.employe_id WHERE type='$va' ")->result_array();
                        
                        if($data!=null){
                        foreach ($data as $key => $value) 
                        {
                        echo "<option value='".$value['empid']."'>".$value['firstname'].' '.$value['lastname']." (".$value['designation'].' '.$value['qualification'].")</option>";
                        }
                        }else{
                            echo "";
                        }
                    }
                 }   
             }
            public function getempinfo($ref='',$val=0)
            {

                if(!empty($ref && $val))
                {
                    $chk= $this->Performance_model->checkteacher($ref,$val);
                    $chck= $this->Performance_model->checkstaff($ref,$val);
                    if($ref=="teacher")
                    {
                        $data=$this->Teacher_model->id($val)[0];
                        if($chk==true){
                        echo json_encode($data);}
                        else{echo json_encode(null);}
                     }else if($ref=="staff")
                    {
                        $data=$this->Staff_model->id($val)[0];
                        if($chck==true){
                        echo json_encode($data);} 
                     else{ echo json_encode(null);}
                 }
            }
}
            public function get_employee($ref='',$val=0)
            {
  if(!empty($ref) && $val!=0)
                {

               
                    if($ref=="teacher")
                    {
                        
                        $data=@$this->Performance_model->Get_info_teacher($ref,$val);
                     
                      echo json_encode($data);
                        //var_dump($data);
                     }else if($ref=="staff")
                    {

                        $data=@$this->Performance_model->Get_info_staff($ref,$val)[0];
                       // var_dump($data);
                        echo json_encode($data);
                     }
                     
                 }
            }
            public function viewperformance($ref="")
            {
                
                $data=$this->Performance_model->getteacher($ref);
                $return="";
                $i=1;
               // var_dump($data);
               if($data!=null){
                foreach ($data as $key => $value) 
                {
                    $return .= "<tr>";
                    $return .= "<td>".$i++."</td>";
                    $return .= "<td>".$value['firstname']." ".$value['lastname']."</td>";
                    $return .= "<td>".$value['designation']."</td>";
                    $return .= "<td>".$value['attritotalgrade']."</td>";
                    $return .= "<td>".$value['keytotalgrade']."</td>";
                    $return .= "<td>".$value['Aggregatescore']."</td>";
                     $return .= "<td>".$value['finalgrade']."</td>";
                     $return .= "<td><a href='".base_url()."performance/single_performance/".$value['type']."/".$value['id']."'><i class='fa fa-eye'></i></a>
                            <a href='".base_url()."performance/Appraise_del/".$value['id']."'><i class='fa fa-trash'></i></a></td>";
                    $return .="<tr>";
                    }
                echo $return;}else{
                    echo $return;
                }
            }

//==================================Short Questions filtration part=========================================
    public function questionagainstclass($id=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT short_questions.id,short_questions.question,short_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `short_questions` INNER JOIN class ON short_questions.class=class.class_id INNER JOIN subject ON short_questions.subject=subject.id INNER JOIN  chapters on chapters.id=short_questions.chapter WHERE short_questions.is_delete='0' AND short_questions.class=$id")->result_array();
                 $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
              $return .= "<td><a href='".base_url()."autopaper/delete_question/short_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_shortquestions/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//=====================short question subject wise filteration====================
 public function questionagainstsubject($id=0,$idsub=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT short_questions.id,short_questions.question,short_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `short_questions` INNER JOIN class ON short_questions.class=class.class_id INNER JOIN subject ON short_questions.subject=subject.id INNER JOIN  chapters on chapters.id=short_questions.chapter WHERE short_questions.is_delete='0' AND short_questions.class='$id' AND short_questions.subject='$idsub'")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {

                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['question']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                 $return .= "<td><a href='".base_url()."autopaper/delete_question/short_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_shortquestions/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//======================================short question filtarion on change of chapter=======================
    public function questionagainstchpter($id=0,$idsub=0,$idchap=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT short_questions.id,short_questions.question,short_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `short_questions` INNER JOIN class ON short_questions.class=class.class_id INNER JOIN subject ON short_questions.subject=subject.id INNER JOIN  chapters on chapters.id=short_questions.chapter WHERE short_questions.is_delete='0' AND short_questions.class=$id AND short_questions.subject=$idsub AND short_questions.chapter=$idchap")->result_array();
                 $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/short_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_shortquestions/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//======================================short question filtarion on change of level=======================
    public function questionagainstlevel($id=0,$idsub=0,$idchap=0,$level="")
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                 $result = $this->db->query("SELECT short_questions.id,short_questions.question,short_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `short_questions` INNER JOIN class ON short_questions.class=class.class_id INNER JOIN subject ON short_questions.subject=subject.id INNER JOIN  chapters on chapters.id=short_questions.chapter WHERE short_questions.is_delete='0' AND short_questions.class=$id AND short_questions.subject=$idsub AND short_questions.chapter=$idchap AND short_questions.level='$level'")->result_array();
                 $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/short_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_shortquestions/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
/*===================================================================================================*/
  public function subjectforpaper($c="")
    {
        if(!empty($c))
        {
            $result = $this->db->query("SELECT `id`,`name` FROM `subject` WHERE `class_id`='$c'")->result_array();
            foreach ($result as $key => $value) {
                echo "<option value='".$value['id']."'>".$value['name']."</option>";
            }
        }
        else
            echo "";
    }
//==============================================Load chapters=================================================
public function chapter($v="", $class="")
    {
        
            if(!empty($v))
            {
                $result = $this->db->query("SELECT `id`,`name`,`chapterNo` FROM `chapters` WHERE `subject_id`='$v'  AND `class_id`=$class ")->result_array();
                //var_dump($result);die();
                foreach ($result as $key => $value) {
                    echo "<option value='".$value['id']."'>".$value['name']."-".$value['chapterNo']."</option>";
                }
            }
            else
                echo "";
    }
//=======================================================Long Questions filtrations process===============================================================
public function long_questionagainstclass($id=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT long_questions.id,long_questions.question,long_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `long_questions` INNER JOIN class ON long_questions.class=class.class_id INNER JOIN subject ON long_questions.subject=subject.id INNER JOIN  chapters on chapters.id=long_questions.chapter WHERE long_questions.is_delete='0' AND long_questions.class=$id")->result_array();
                 $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/long_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_longquestion/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }

//=======================Load view of Long questions against subject================================
    public function long_questionagainstsubject($id=0,$idsub=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT long_questions.id,long_questions.question,long_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `long_questions` INNER JOIN class ON long_questions.class=class.class_id INNER JOIN subject ON long_questions.subject=subject.id INNER JOIN  chapters on chapters.id=long_questions.chapter WHERE long_questions.is_delete='0' AND long_questions.class='$id' AND long_questions.subject='$idsub'")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {

                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['question']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                $return .= "<td><a href='".base_url()."autopaper/delete_question/long_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_longquestion/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//======================================longquestion filtarion on change of level=======================
    public function longquestionagainstlevel($id=0,$idsub=0,$idchap=0,$level="")
    {
            if(!empty($id))
             {
                 $level=urldecode($level);
                 $result = $this->db->query("SELECT long_questions.id,long_questions.question,long_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `long_questions` INNER JOIN class ON long_questions.class=class.class_id INNER JOIN subject ON long_questions.subject=subject.id INNER JOIN  chapters on chapters.id=long_questions.chapter WHERE long_questions.is_delete='0' AND long_questions.class=$id AND long_questions.subject=$idsub AND long_questions.chapter=$idchap AND long_questions.level='$level'")->result_array();
                 $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/long_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_longquestion/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================fill class wise Questions filtration part=========================================
    public function fill_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.fill_blank_ans as ans,general_questions.id,general_questions.fill_blank_question as question,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',4);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

             $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['ans']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
              $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_fill/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================fill subject wise Questions filtration part=========================================
    public function fill_questionagainstsubject($classid=0,$sub=0,$type=0)
    {
            if(!empty($classid))
             {
                $this->db->select('general_questions.fill_blank_ans as ans,general_questions.id,general_questions.fill_blank_question as question,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',4);
                $this->db->where('general_questions.class',$classid);
                $this->db->where('general_questions.subject',$sub);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['ans']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_fill/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================fill chapter wise Questions filtration part=========================================
    public function fill_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.fill_blank_ans as ans,general_questions.id,general_questions.fill_blank_question as question,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',4);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['ans']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_fill/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================fill level wise Questions filtration part=========================================
    public function fill_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
        //var_dump($id,$sub,$chapter,$type,$level);die();
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.fill_blank_ans as ans,general_questions.id,general_questions.fill_blank_question as question,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',4);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['ans']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_fill/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//=========================================load class wise paragraph===================================================
public function paragraph_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.paragraph,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

             $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['paragraph']." </td>";
             
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
              $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_paragraph/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//=======================Load view of Paragraph Subject wise questions================================
    public function paragraph_questionagainstsubject($id=0,$idsub=0,$type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.paragraph,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['paragraph']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                 $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_paragraph/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================Paragraph chapter wise Questions filtration part=========================================
    public function paragraph_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.paragraph,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['paragraph']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
              $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_paragraph/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================Chapter level wise Questions filtration part=========================================
    public function paragraph_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
        //var_dump($id,$sub,$chapter,$type,$level);die();
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.paragraph,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['paragraph']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_paragraph/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";  
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================load class wise Letter===================================================
public function letter_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.letter,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

             $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['letter']." </td>";
             
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_letter/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//=======================Subject wise Load view of Letter questions================================
    public function letter_questionagainstsubject($id=0,$idsub=0,$type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.letter,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['letter']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_letter/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================Letter chapter wise Questions filtration part=========================================
    public function letter_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.letter,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['letter']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_letter/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================Level wise Letter=========================================
    public function letter_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.letter,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['letter']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_letter/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";    
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================Class wise application===================================================
public function application_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.application,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

             $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['application']." </td>";
             
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_application/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//=======================Subject wise application view================================
    public function application_questionagainstsubject($id=0,$idsub=0,$type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.application,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['application']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_application/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================Chapter wise Application=========================================
    public function application_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.application,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['application']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_application/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================Level wise Application=========================================
    public function application_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.application,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['application']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_application/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";   
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================Class wise Summary===================================================
public function summary_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.summary,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

             $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['summary']." </td>";
             
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_summary/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//=======================Subject wise summary================================
    public function summary_questionagainstsubject($id=0,$idsub=0,$type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.summary,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['summary']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_summary/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================Chapter wise Summary=========================================
    public function summary_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.summary,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['summary']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_summary/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================Level wise Summary=========================================
    public function summary_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.summary,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['summary']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_summary/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";   
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================Class wise Essay===================================================
public function essay_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.essay,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

             $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['essay']." </td>";
             
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_essay/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//=======================Subject wise Essay questions================================
    public function essay_questionagainstsubject($id=0,$idsub=0,$type=0)
    {
            if(!empty($id))
             {
                $result = $this->db->query("SELECT general_questions.id,general_questions.essay,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                $return="";
                $i=1;
                foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['essay']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_essay/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Chapter wise essay=========================================
    public function essay_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.essay,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['essay']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_essay/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================Level wise Essay=========================================
    public function Essay_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.essay,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['essay']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                         $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_essay/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";   
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================Class wise Poem===================================================
public function poem_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.poem,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

             $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['poem']." </td>";
             
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
              $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_poem/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//=======================Subject wise of Poem questions================================
    public function poem_questionagainstsubject($id=0,$idsub=0, $type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.poem,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['poem']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                 $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_poem/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================Chapter wise Poem=========================================
    public function poem_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.poem,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['poem']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                         $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_poem/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================Level wise Poem=========================================
    public function poem_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.poem,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['poem']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_poem/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";   
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================Class wise English Translation===================================================
public function englishtranslation_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.translate_english,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                    $return .= "<tr>";
                    $return .= "<td>".$i++."</td>";
                    $return .= "<td>".$value['translate_english']." </td>";
                    $return .= "<td>".$value['class_name']." </td>";
                    $return .= "<td>".$value['sub']." </td>";
                    $return .= "<td>".$value['chap']."</td>";
                    $return .= "<td>".$value['level']."</td>";
                    $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_translateintoeng/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo ""; 
    }
//=======================Subject wise of English Translation questions================================
    public function englishtranslation_questionagainstsubject($id=0,$idsub=0, $type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.translate_english,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['translate_english']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_translateintoeng/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
//==================================Chapter wise Translation in Egnlish=========================================
    public function englishtranslation_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.translate_english,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['translate_english']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_translateintoeng/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Level wise Translate Into English=========================================
    public function englishtranslation_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.translate_english,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['translate_english']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_translateintoeng/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";    
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================Class wise Make Sentence===================================================
public function sentence_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.wordforsentence,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                    $return .= "<tr>";
                    $return .= "<td>".$i++."</td>";
                    $return .= "<td>".$value['wordforsentence']." </td>";
                    $return .= "<td>".$value['class_name']." </td>";
                    $return .= "<td>".$value['sub']." </td>";
                    $return .= "<td>".$value['chap']."</td>";
                    $return .= "<td>".$value['level']."</td>";
                    $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_sentence/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo ""; 
    }
//=======================Subject wise of sentence questions================================
    public function sentence_questionagainstsubject($id=0,$idsub=0, $type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.wordforsentence,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['wordforsentence']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_sentence/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Chapter wise Sentence=========================================
    public function sentence_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.wordforsentence,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['wordforsentence']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_sentence/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Level wise make Sentence=========================================
    public function sentence_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.wordforsentence,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['wordforsentence']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_sentence/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";   
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================Class wise centeral idea===================================================
public function centeralidea_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.centeral_idea,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                    $return .= "<tr>";
                    $return .= "<td>".$i++."</td>";
                    $return .= "<td>".$value['centeral_idea']." </td>";
                    $return .= "<td>".$value['class_name']." </td>";
                    $return .= "<td>".$value['sub']." </td>";
                    $return .= "<td>".$value['chap']."</td>";
                    $return .= "<td>".$value['level']."</td>";
                    $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_centeralidea/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";  
        
                 }
                 echo $return;
            }
            else
                echo ""; 
    }
//=======================Subject wise of Centeral Idea questions================================
    public function centeralidea_questionagainstsubject($id=0,$idsub=0, $type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.centeral_idea,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['centeral_idea']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_centeralidea/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";  
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Chapter wise Centeral Idea=========================================
    public function centeralidea_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.centeral_idea,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['centeral_idea']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_centeralidea/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";  
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Level wise Centeral Idea=========================================
    public function centeralidea_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.centeral_idea,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['centeral_idea']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
 $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_centeralidea/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";  
                        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================Class wise Ideoms===================================================
public function ideoms_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.ideoms,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                    $return .= "<tr>";
                    $return .= "<td>".$i++."</td>";
                    $return .= "<td>".$value['ideoms']." </td>";
                    $return .= "<td>".$value['class_name']." </td>";
                    $return .= "<td>".$value['sub']." </td>";
                    $return .= "<td>".$value['chap']."</td>";
                    $return .= "<td>".$value['level']."</td>";
                     $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_ideoms/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";  
        
                 }
                 echo $return;
            }
            else
                echo ""; 
    }
//=======================Subject wise of Ideoms questions================================
    public function ideoms_questionagainstsubject($id=0,$idsub=0, $type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.ideoms,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['ideoms']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                 $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_ideoms/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";  
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Chapter wise Ideoms=========================================
    public function ideoms_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.ideoms,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['ideoms']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                         $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_ideoms/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";  
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Level wise ideoms=========================================
    public function ideoms_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.ideoms,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['ideoms']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                          $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_ideoms/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";   
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================Class wise sp===================================================
public function sp_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.singular,general_questions.plural,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                    $return .= "<tr>";
                    $return .= "<td>".$i++."</td>";
                    $return .= "<td>".$value['singular']." </td>";
                    $return .= "<td>".$value['plural']." </td>";
                    $return .= "<td>".$value['class_name']." </td>";
                    $return .= "<td>".$value['sub']." </td>";
                    $return .= "<td>".$value['chap']."</td>";
                    $return .= "<td>".$value['level']."</td>";
                      $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_sp/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo ""; 
    }
//=======================Subject wise of sp questions================================
    public function sp_questionagainstsubject($id=0,$idsub=0, $type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.singular,general_questions.plural,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['singular']." </td>";
                $return .= "<td>".$value['plural']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                  $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_sp/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Chapter wise sp=========================================
    public function sp_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.singular,general_questions.plural,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['singular']." </td>";
                        $return .= "<td>".$value['plural']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                          $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_sp/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Level wise sp=========================================
    public function sp_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.singular,general_questions.plural,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['singular']." </td>";
                        $return .= "<td>".$value['plural']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                         $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_sp/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";  
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================Class wise Opposites===================================================
public function opposites_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.opposites,general_questions.opposites_ans,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                    $return .= "<tr>";
                    $return .= "<td>".$i++."</td>";
                    $return .= "<td>".$value['opposites']." </td>";
                    $return .= "<td>".$value['opposites_ans']." </td>";
                    $return .= "<td>".$value['class_name']." </td>";
                    $return .= "<td>".$value['sub']." </td>";
                    $return .= "<td>".$value['chap']."</td>";
                    $return .= "<td>".$value['level']."</td>";
                    $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_opposites_ans/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo ""; 
    }
//=======================Subject wise of Opposites questions================================
    public function opposites_questionagainstsubject($id=0,$idsub=0, $type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.opposites,general_questions.opposites_ans,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['opposites']." </td>";
                $return .= "<td>".$value['opposites_ans']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_opposites_ans/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Chapter wise Opposites=========================================
    public function opposites_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.opposites,general_questions.opposites_ans,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['opposites']." </td>";
                        $return .= "<td>".$value['opposites_ans']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                         $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_opposites_ans/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Level wise opposites========================================
    public function opposites_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.opposites,general_questions.opposites_ans,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['opposites']." </td>";
                        $return .= "<td>".$value['opposites_ans']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
 $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_opposites_ans/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
                         
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================Class wise Wordsmeanings===================================================
public function wm_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.words,general_questions.meanings,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.is_delete',0);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                    $return .= "<tr>";
                    $return .= "<td>".$i++."</td>";
                    $return .= "<td>".$value['words']." </td>";
                    $return .= "<td>".$value['meanings']." </td>";
                    $return .= "<td>".$value['class_name']." </td>";
                    $return .= "<td>".$value['sub']." </td>";
                    $return .= "<td>".$value['chap']."</td>";
                    $return .= "<td>".$value['level']."</td>";
                    $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_wm/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo ""; 
    }
//=======================Subject wise of Words meanings questions================================
    public function wm_questionagainstsubject($id=0,$idsub=0, $type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.words,general_questions.meanings,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' AND general_questions.is_delete=0 ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['words']." </td>";
                $return .= "<td>".$value['meanings']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                 $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_wm/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Chapter wise WM=========================================
    public function wm_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.words,general_questions.meanings,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
 $this->db->where('general_questions.is_delete',0);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['words']." </td>";
                        $return .= "<td>".$value['meanings']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                        $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_wm/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Level wise WM========================================
    public function wm_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.words,general_questions.meanings,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
 $this->db->where('general_questions.is_delete',0);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['words']." </td>";
                        $return .= "<td>".$value['meanings']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
  $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_wm/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>"; 
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================Class wise sd===================================================
public function sd_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.adjective,general_questions.superlative,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                    $return .= "<tr>";
                    $return .= "<td>".$i++."</td>";
                    $return .= "<td>".$value['adjective']." </td>";
                    $return .= "<td>".$value['superlative']." </td>";
                    $return .= "<td>".$value['class_name']." </td>";
                    $return .= "<td>".$value['sub']." </td>";
                    $return .= "<td>".$value['chap']."</td>";
                    $return .= "<td>".$value['level']."</td>";
 $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_sd/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo ""; 
    }
//=======================Subject wise of SD questions================================
    public function sd_questionagainstsubject($id=0,$idsub=0, $type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.adjective,general_questions.superlative,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['adjective']." </td>";
                $return .= "<td>".$value['superlative']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
 $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_sd/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Chapter wise SD=========================================
    public function sd_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.adjective,general_questions.superlative,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['adjective']." </td>";
                        $return .= "<td>".$value['superlative']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
 $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_sd/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Level wise SD========================================
    public function sd_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.adjective,general_questions.superlative,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['adjective']." </td>";
                        $return .= "<td>".$value['superlative']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
 $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_sd/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
                       
                 }
                 echo $return;
            }
            else
                echo "";
    }
//=========================================Class wise tf===================================================
public function tf_questionagainstclass($id=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.true_words,general_questions.false_words,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                    $return .= "<tr>";
                    $return .= "<td>".$i++."</td>";
                    $return .= "<td>".$value['true_words']." </td>";
                    $return .= "<td>".$value['false_words']." </td>";
                    $return .= "<td>".$value['class_name']." </td>";
                    $return .= "<td>".$value['sub']." </td>";
                    $return .= "<td>".$value['chap']."</td>";
                    $return .= "<td>".$value['level']."</td>";
                     $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_tf/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo ""; 
    }
//=======================Subject wise of tf questions================================
    public function tf_questionagainstsubject($id=0,$idsub=0, $type=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT general_questions.id,general_questions.true_words,general_questions.false_words,general_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `general_questions` INNER JOIN class ON general_questions.class=class.class_id INNER JOIN subject ON general_questions.subject=subject.id INNER JOIN  chapters on chapters.id=general_questions.chapter WHERE general_questions.is_delete='0' AND general_questions.class='$id'  AND general_questions.subject='$idsub' AND general_questions.question_type='$type' ")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {
                $return .= "<tr>";
                $return .= "<td>".$i++."</td>";
                $return .= "<td>".$value['true_words']." </td>";
                $return .= "<td>".$value['false_words']." </td>";
                $return .= "<td>".$value['class_name']." </td>";
                $return .= "<td>".$value['sub']." </td>";
                $return .= "<td>".$value['chap']."</td>";
                $return .= "<td>".$value['level']."</td>";
                 $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_tf/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Chapter wise tf=========================================
    public function tf_questionagainstchapter($id=0,$sub=0,$chapter=0,$type=0)
    {
            if(!empty($id))
             {
                $this->db->select('general_questions.true_words,general_questions.false_words,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $result=$this->db->get()->result_array();
                $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['true_words']." </td>";
                        $return .= "<td>".$value['false_words']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                         $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_tf/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
    }
//==================================Level wise tf========================================
    public function tf_questionagainstlevel($id=0,$sub=0,$chapter=0,$level="",$type=0)
    {
            if(!empty($id))
             {
                $level=urldecode($level);
                $this->db->select('general_questions.true_words,general_questions.false_words,general_questions.id,general_questions.level,class.class_name,subject.name as sub, chapters.name as chap');
                $this->db->from('general_questions');
                $this->db->join('class','general_questions.class=class.class_id');
                $this->db->join('chapters','general_questions.chapter=chapters.id');
                $this->db->join('subject','general_questions.subject=subject.id');
                $this->db->where('general_questions.question_type',$type);
                $this->db->where('general_questions.class',$id);
                $this->db->where('general_questions.subject',$sub);
                $this->db->where('general_questions.chapter',$chapter);
                $this->db->where('general_questions.level',$level);
                $result=$this->db->get()->result_array();
                $return="";
                $i=1;
                 foreach ($result as $key => $value) {
                        $return .= "<tr>";
                        $return .= "<td>".$i++."</td>";
                        $return .= "<td>".$value['true_words']." </td>";
                        $return .= "<td>".$value['false_words']." </td>";
                        $return .= "<td>".$value['class_name']." </td>";
                        $return .= "<td>".$value['sub']." </td>";
                        $return .= "<td>".$value['chap']."</td>";
                        $return .= "<td>".$value['level']."</td>";
                         $return .= "<td><a href='".base_url()."autopaper/delete_question/general_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_tf/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";

 
                 }
                 echo $return;
            }
            else
                echo "";
    }















    public function long_questionagainstchpter($id=0,$idsub=0,$idchap=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT long_questions.id,long_questions.question,long_questions.level,class.class_name,subject.name as sub,chapters.name as chap FROM `long_questions` INNER JOIN class ON long_questions.class=class.class_id INNER JOIN subject ON long_questions.subject=subject.id INNER JOIN  chapters on chapters.id=long_questions.chapter WHERE long_questions.is_delete='0' AND long_questions.class=$id AND long_questions.subject=$idsub AND long_questions.chapter=$idchap")->result_array();
                 $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['sub']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td>
             <a href='".base_url()."autopaper/delete_question/".$value['id']."'><i class='fa fa-trash'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }

    public function mcq_questionagainstclass($id=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT mcq_questions.correct_answer,mcq_questions.option1,mcq_questions.option2,mcq_questions.option3,mcq_questions.option4, mcq_questions.id ,mcq_questions.question,mcq_questions.level,class.class_name,subject.name AS subj,chapters.name as chap,mcq_questions.correct_answer 
FROM mcq_questions   INNER JOIN class on class.class_id=mcq_questions.class INNER JOIN subject ON subject.id=mcq_questions.subject INNER JOIN chapters on chapters.id=mcq_questions.chapter WHERE  mcq_questions.is_delete='0' AND mcq_questions.class=$id")->result_array();
                 $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['option1']." </td>";
             $return .= "<td>".$value['option2']." </td>";
             $return .= "<td>".$value['option3']." </td>";
             $return .= "<td>".$value['option4']." </td>";
             $return .= "<td>".$value['correct_answer']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['subj']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/mcq_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_mcq/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }


    public function mcq_questionagainstsubject($id=0,$idsub=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT mcq_questions.correct_answer,mcq_questions.option1,mcq_questions.option2,mcq_questions.option3,mcq_questions.option4, mcq_questions.id ,mcq_questions.question,mcq_questions.level,class.class_name,subject.name AS subj,chapters.name as chap,mcq_questions.correct_answer 
FROM mcq_questions   INNER JOIN class on class.class_id=mcq_questions.class INNER JOIN subject ON subject.id=mcq_questions.subject INNER JOIN chapters on chapters.id=mcq_questions.chapter WHERE  mcq_questions.is_delete='0' AND mcq_questions.class=$id AND mcq_questions.subject=$idsub")->result_array();
                 $return="";

                 $i=1;
                 foreach ($result as $key => $value) {

             $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['option1']." </td>";
             $return .= "<td>".$value['option2']." </td>";
             $return .= "<td>".$value['option3']." </td>";
             $return .= "<td>".$value['option4']." </td>";
             $return .= "<td>".$value['correct_answer']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['subj']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
             $return .= "<td><a href='".base_url()."autopaper/delete_question/mcq_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_mcq/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }

    public function mcq_questionagainstchpter($id=0,$idsub=0,$idchap=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT mcq_questions.correct_answer,mcq_questions.option1,mcq_questions.option2,mcq_questions.option3,mcq_questions.option4, mcq_questions.id ,mcq_questions.question,mcq_questions.level,class.class_name,subject.name AS subj,chapters.name as chap,mcq_questions.correct_answer 
FROM mcq_questions   INNER JOIN class on class.class_id=mcq_questions.class INNER JOIN subject ON subject.id=mcq_questions.subject INNER JOIN chapters on chapters.id=mcq_questions.chapter WHERE  mcq_questions.is_delete='0' AND mcq_questions.class=$id AND mcq_questions.subject=$idsub AND mcq_questions.chapter=$idchap")->result_array();
                 $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

             $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['option1']." </td>";
             $return .= "<td>".$value['option2']." </td>";
             $return .= "<td>".$value['option3']." </td>";
             $return .= "<td>".$value['option4']." </td>";
             $return .= "<td>".$value['correct_answer']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['subj']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
            $return .= "<td><a href='".base_url()."autopaper/delete_question/mcq_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_mcq/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 //var_dump($return);die();
                 echo $return;
            }
            else
                echo "";
        
    }
//=============================Load MCQs level wise
    public function mcq_questionagainstlevel($id=0,$idsub=0,$idchap=0,$level="")
    {
            if(!empty($id))
             {
                 $level=urldecode($level);
                 $result = $this->db->query("SELECT mcq_questions.correct_answer,mcq_questions.option1,mcq_questions.option2,mcq_questions.option3,mcq_questions.option4, mcq_questions.id ,mcq_questions.question,mcq_questions.level,class.class_name,subject.name AS subj,chapters.name as chap,mcq_questions.correct_answer 
FROM mcq_questions   INNER JOIN class on class.class_id=mcq_questions.class INNER JOIN subject ON subject.id=mcq_questions.subject INNER JOIN chapters on chapters.id=mcq_questions.chapter WHERE  mcq_questions.is_delete='0' AND mcq_questions.class=$id AND mcq_questions.subject=$idsub AND mcq_questions.chapter=$idchap AND mcq_questions.level='$level' ")->result_array();
                 $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

             $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['question']." </td>";
             $return .= "<td>".$value['option1']." </td>";
             $return .= "<td>".$value['option2']." </td>";
             $return .= "<td>".$value['option3']." </td>";
             $return .= "<td>".$value['option4']." </td>";
             $return .= "<td>".$value['correct_answer']." </td>";
             $return .= "<td>".$value['class_name']." </td>";
             $return .= "<td>".$value['subj']." </td>";
             $return .= "<td>".$value['chap']."</td>";
             $return .= "<td>".$value['level']."</td>";
            $return .= "<td><a href='".base_url()."autopaper/delete_question/mcq_questions/".$value['id']."'><i class='fa fa-trash'></i></a><a href='".base_url()."autopaper/edit_mcq/".$value['id']."'><i class='fa fa-edit'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 //var_dump($return);die();
                 echo $return;
            }
            else
                echo "";   
    }
        public function questionagainstchpter_checkbox($id=0,$idsub=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT `id`,`name`,`chapterNo` FROM `chapters` WHERE `class_id`='$id' AND subject_id='$idsub'")->result_array();
                 $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         
               
                         
              $return .= "<div id='chapter' name='chapter' class='form-control'>

                          
              <input name='chapter[]' type='checkbox' value=".$value['id'].">".$value['name']."     --".$value['chapterNo']." </div>";
             
                 }
                 echo $return;
            }
            else
                echo "";
        
    }

public function getstop($id=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT stop.id,stop.name,city.city_name,stop.fee FROM `stop` inner JOIN `city` ON city.city_id=stop.city_id WHERE stop.city_id='$id' AND stop.is_delete='0' AND stop.branch='$branch'")->result_array();
                 // var_dump($result);
                 $return="";
                 $i=1;
                 foreach ($result as $key => $value) {
                     // echo "<option value='".$value['city_id']."'>".$value['city_name']."</option>";

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['name']." </td>";
             $return .= "<td>".$value['city_name']." </td>";
             $return .= "<td>".$value['fee']."</td>";
             $return .= "<td><a href='".base_url()."staff/actions/edit/".$value['id']."'><i class='fa fa-edit'></i></a>
             <a href='".base_url()."staff/actions/del/".$value['id']."'><i class='fa fa-trash'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
/*==================================================================================================*/

  public function stop_student($id=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT stop.id,stop.name,city.city_name,stop.fee FROM `stop` inner JOIN `city` ON city.city_id=stop.city_id WHERE stop.city_id='$id' AND stop.is_delete='0'")->result_array();
                 // var_dump($result);
                 $return="";
                 
                 foreach ($result as $key => $value) {
                     // echo "<option value='".$value['city_id']."'>".$value['city_name']."</option>";
                    echo "<option value='".$value['id']."'>".$value['name']."</option>";
            
                 }
            }
            else
                echo "";
        
    }

    public function getemp_advance($value='')
    {
        if(!empty($value))
             {
                 if($value=="teacher")
                 {
                     $data=$this->salary_model->Advance_teacher($value);
                      $return="";
                        $i=1;
                 foreach ($data as $key => $value) {

                         $return .= "<tr>";
               $return .= "<td>".$i++."</td>";
               $return .= "<td>".$value['firstname']."".$value['lastname']." </td>";
               $return .= "<td>".$value['refrence']." </td>";
               $return .= "<td>".$value['Amount']." </td>";
             $return .= "<td>".$value['month']." </td>";
             $return .= "<td><a href='".base_url()."salary/actions/del/".$value['id']."'><i class='fa fa-trash'></i></a>
             <a href='".base_url()."salary/actions/edit/".$value['id']."'><i class='fa fa-pencil'></i></a>
             </td>";
            $return .= "</tr>";
        
                 }
                 echo $return;
            
                 }else if($value=="staff"){
                     $data=$this->salary_model->Advance_staff($value);
                      $return="";
                        $i=1;
                 foreach ($data as $key => $value) {

                         $return .= "<tr>";
               $return .= "<td>".$i++."</td>";
               $return .= "<td>".$value['firstname']."".$value['lastname']." </td>";
               $return .= "<td>".$value['refrence']." </td>";
               $return .= "<td>".$value['Amount']." </td>";
             $return .= "<td>".$value['month']." </td>";
             $return .= "<td><a href='".base_url()."salary/actions/del/".$value['id']."'><i class='fa fa-trash'></i></a>
             <a href='".base_url()."salary/actions/edit/".$value['id']."'><i class='fa fa-pencil'></i></a>
             </td>";
            $return .= "</tr>";
        
                 }
                 echo $return;
                 }else{
                     echo "";
                 }
             }
    }
    public function getemp_advance1($val,$ref='')
    {
        if(!empty($ref && $val))
             {
                  if($ref=="teacher" && $val!=0)
                 {
                     $data=$this->salary_model->advance1_teacher($ref,$val);
                     echo json_encode($data);
                 }else if($ref=="staff" && $val!=0){
                     $data=$this->salary_model->advance1_staff($ref,$val);
                     echo json_encode($data);
                 }else{
                     echo "";
                 }
             }
    }
    public function data_emp($ref="",$val="")
    {
        $branch=$this->user_model->getbranch();
        if($ref=="teacher"){
            
            $this->db->select("id,CONCAT(firstname,' ', lastname) as name");
            $this->db->from('teacher');
            $this->db->where('branch',$branch)->where('is_delete',0)->where('status',0);
            $this->db->like('firstname',$val);
            $data=$this->db->get()->result_array();
            echo json_encode($data);
        }else if($ref=="staff"){
            $this->db->select("id,CONCAT(firstname,' ', lastname) as name");
            $this->db->from('staff');
            $this->db->where('branch',$branch)->where('status',0);
            $this->db->like('firstname',$val);
            $data=$this->db->get()->result_array();
            echo json_encode($data);
        }else{echo "";}
    }
    public function id_security($ref="",$id="")
    {

       $detuct=0;$security=0;
        if($ref=="teacher"){
            
            $this->db->select("security");
            $this->db->from('teacher');
            $this->db->where('is_delete',0)->where('id',$id);
            $security= $this->db->get()->result_array()[0]['security'];
            $this->db->select('detuct_amount');
            $this->db->from('security_deduct');
            $this->db->where('status',0)->where('is_delete',0)->where('bothid',$id)->where('refrence',$ref);
            $data=$this->db->get()->result_array();
            foreach ($data as $key => $value) {
                $detuct=$value['detuct_amount']+$detuct;
            }
            if($detuct!=$security){
                $se=(int)$security - $detuct;
                $data=array('security' => $se );
                echo json_encode($data);
            }else if($detuct==$security){
                $data=array('security'=>0);
                echo json_encode($data);
            }else{
                $data=array('security'=>$security);
                echo json_encode($data);
            }
            
        }else if($ref=="staff"){
           $this->db->select("security");
            $this->db->from('staff');
            $this->db->where('status',0)->where('id',$id);
            $security= $this->db->get()->result_array()[0]['security'];
            $this->db->select('detuct_amount');
            $this->db->from('security_deduct');
            $this->db->where('status',0)->where('is_delete',0)->where('bothid',$id)->where('refrence',$ref);
            $data=$this->db->get()->result_array();
            foreach ($data as $key => $value) {
                $detuct=$value['detuct_amount']+$detuct;
            }
            if($detuct!=$security){
                $se=(int)$security - $detuct;
                $data=array('security' => $se );
                echo json_encode($data);
            }else{
                $data=array('security'=>$security);
                echo json_encode($data);
            }
        }else{echo "";}
        
    }

    public function check_voucher($cid="",$date="")
    {
        if(!empty($cid) && !empty($date))
             {
                $ym = date("Y-m",strtotime($date));
		$disabled_check = $this->db->where("promotion.is_delete","0")->where("promotion.is_active","1")->where("invoice.is_admitted","0")->where("promotion.class_id",$cid)->where("LEFT(`invoice`.`date`,7)",$ym)->from("invoice")->join("promotion","promotion.id=invoice.student_id")->count_all_results();
        $add_month_fee_check=$this->db->where('fee_add_months.month',$ym)->where('fee_add_months.is_delete',0)->where('invoice.is_delete',0)->where("promotion.class_id",$cid)->from('fee_add_months')->join('invoice','fee_add_months.invoice_id=invoice.id')->join("promotion","promotion.id=invoice.student_id")->count_all_results();
		if($disabled_check>0 || $add_month_fee_check>0)
			echo 1;
		else
			echo 0;
             }
    }

    public function CheckTeacherAllocation($class=0,$section=0,$subject=0)
    {
        if(!empty($class) AND !empty($section) AND !empty($subject))
        {
		    $disabled_check = $this->db->where("is_deleted","0")->where("class_id",$class)->where("section_id",$section)->where("subject_id",$subject)->from("teacheralloc")->count_all_results();
            if($disabled_check>0)
                echo 1;
            else
                echo 0;
        }
    }
      public function checkdate($val="0000-00")
    {
        $date=date('Y-m');
        //var_dump($val,$date);
        if($val<$date){
            echo "true";
        }else{
            echo "false";
        }
    }

}
