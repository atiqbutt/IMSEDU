<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacherattendancecr extends CI_Controller {
     private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->user_model->check_login("admin");
        $this->load->model('Teacher_model','mo');
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }
    public function index()
    {
        $this->user_model->check_permissions("Teacherattendancecr/index");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['teacher']=$this->mo->all();
        $data['Attendancestatus']=$this->mo->AttendanceStatus();
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('attendance/teacherattendanceadd',$data);
    }
public function save()
{
    $id=$this->input->post('editteacherid',true);
    if($id>0)
    {
        $td=$this->input->post('status',true);
        $date=$this->input->post('date',true);
        $data=array('status_id'=>$td,
                     'date'=>$date
                     );
        $check=$this->mo->updateAttendace($data,$id);
        if($check==true){
            redirect("Teacherattendancecr/view/");
        }else
        {
            echo "Not update";
        }
    }else{
            if($this->input->post())
            {
                $radio=$this->input->post('status',true);
                $date=$this->input->post('date',true);
                $dt=$this->input->post('id',true);
                foreach ($radio as $key => $value) 
                {
                        $data=array('teacher_id' =>$key,
                        'status_id'=> $value,
                        'date'=>$date
                        );
                        $con= $this->mo->saveattendace($data);
                        
                }
                if($con==true){
                    redirect("Teacherattendancecr/view/");
                }else
                {
                    echo "not saved";
                }
            }
            }
}
public function view($q="all",$p=1)
{
      $this->user_model->check_permissions("Teacherattendancecr/view");
      $data['menu'] = $this->load_model->menu();
      $branchid=$this->user_model->getbranch();

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
            $sq1 .= "attendancestatus.status like '%".$q."%' OR "; 
            $sq1 .= "contact like '%".$q."%' )";
        }
        $total = $this->db->query("SELECT count(*) as total FROM `teacherattendance` INNER JOIN teacher on teacherattendance.teacher_id=teacher.id inner join attendancestatus on attendancestatus.id=teacherattendance.status_id WHERE teacherattendance.is_deleted='0' AND teacher.branch='$branchid' $sq1")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT teacherattendance.id,teacherattendance.date,teacher.firstname,teacher.lastname,teacher.contact,attendancestatus.status FROM `teacherattendance` INNER JOIN teacher on teacherattendance.teacher_id=teacher.id inner join attendancestatus on attendancestatus.id=teacherattendance.status_id WHERE teacherattendance.is_deleted='0' AND teacher.branch='$branchid' $sq1  LIMIT $offset,$per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT teacherattendance.id,teacherattendance.date,teacher.firstname,teacher.lastname,teacher.contact,attendancestatus.status FROM `teacherattendance` INNER JOIN teacher on teacherattendance.teacher_id=teacher.id inner join attendancestatus on attendancestatus.id=teacherattendance.status_id WHERE teacherattendance.is_deleted='0' AND teacher.branch='$branchid' $sq1  LIMIT $offset,$per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;














/*==============================================================================================*/
       
        $data['teacheratt'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('attendance/teacherattendanceview',$data);
}
public function againstdate($value='0000-00-00',$p=1)
{ 
        $total = $this->db->query("SELECT count(*) as total FROM `teacherattendance`")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $query = $this->db->query("SELECT teacherattendance.id,teacherattendance.date,teacher.firstname,teacher.lastname,teacher.contact,attendancestatus.status FROM `teacherattendance` INNER JOIN teacher on teacherattendance.teacher_id=teacher.id inner join attendancestatus on attendancestatus.id=teacherattendance.status_id WHERE teacherattendance.date='$value' AND teacherattendance.is_deleted='0' LIMIT $offset,$per_page");
        $teacheratt = $query->result_array();
        $return = "";
        $i = 1;
        foreach ($teacheratt as $key => $value) {
            $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['firstname']." ".$value['lastname']."</td>";
            $return .= "<td>".$value['contact']."</td>";
            $return .= "<td>".$value['date']."</td>";
            $return .= "<td>".$value['status']."</td>";
            $return .= "<td><a href='".base_url()."Teacherattendancecr/actions/edit/".$value['id']."'><i class='fa fa-edit'></i></a>
            <a href='".base_url()."Teacherattendancecr/actions/del/".$value['id']."'><i class='fa fa-trash'></i></a></td>";
            $return .= "</tr>";
        }
        echo $return;
    
}
public function actions($ref='',$value=0)
{
    if($ref=="edit"){
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['teacheratt']=$this->mo->edit($value)->result_array()[0];
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $data['statusid']=$this->db->select("*")->from('attendancestatus')->get()->result_array();
        $this->load->view('attendance/editattendance',$data);
    }else if($ref=="del"){
         $data['menu'] = $this->load_model->menu();
         $data['base_url'] = base_url();
         $data['userInfo'] = $this->userInfo;
         $check=$this->mo->del($value);
         if($check==true){
            redirect("Teacherattendancecr/view/");
         }else
         {
            echo "Delete not correct";
          }
    }
}
}

