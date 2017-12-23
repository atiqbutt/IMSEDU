<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class staff extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("staff_model");
        $this->load->model('Teacher_model');
        $this->user_model->check_login("admin");

        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

    public function index()
    {
        $this->user_model->check_permissions("staff/index");
        
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        
        $this->load->view('staff/staff_add',$data);
    }
   public function show($q="all",$p=1)
    {
        $this->user_model->check_permissions("staff/show");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $branch=$this->user_model->getbranch();
         

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
            $sq1 .= "contact like '%".$q."%' )";
        }
        $total = $this->db->query("SELECT count(*) as total FROM `staff` where status='0' AND branch=$branch $sq1")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT id,designation,contact,qualification,doj,dob,salery FROM `staff` WHERE branch = '$branch' AND status='0' $sq1 LIMIT 0, $per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT id,firstname,lastname,designation,contact,qualification,doj,dob,salery FROM `staff` WHERE branch = '$branch' AND status='0'  $sq1 LIMIT $offset, $per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;

        $data['staff'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('staff/staff_view',$data);
    }

    public function save()
    {
        $data = $this->input->post();
        $db_insert = $this->staff_model->save($data);
        redirect("staff/index","refresh");
    }

    public function edit()
    {
             $data['menu'] = $this->load_model->menu();
            $id = $this->uri->segment(3);
             $data['values']= $this->db->where('id',$id)->get('staff')->result_array()[0];
             $data['userInfo'] = $this->userInfo;
            $data['base_url'] = base_url();
            $branch=$this->user_model->getbranch();
            $data['branch']=$this->user_model->getbranch();
                if($this->user_model->is_super())
                    $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result_array();
            else
                $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result_array();
            
             
             $this->load->view('header',$data);
             $this->load->view('sidebar',$data);
        
             $this->load->view('staff/staff_edit',$data);


     

      
    }

    
    public function update()
    {
         if($this->input->post()){
        $data = $this->input->post();
        $db_update = $this->staff_model->update($data);
        redirect("staff/index","refresh");}
else{ redirect("staff/index","refresh"); }


     }
    public function status($q="all",$p=1)
     {
        $this->user_model->check_permissions("staff/status");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
         
        $q = urldecode($q);
        $p = $p<1?1:$p;
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $branch=$this->user_model->getBranch();
        
         $sq1 = "";
        if($q!="all")
        {
            $sq1 .= "AND (firstname like '%".$q."%' OR "; 
            $sq1 .= "lastname like '%".$q."%' OR "; 
            $sq1 .= "designation like '%".$q."%' OR ";
            $sq1 .= "status.name like '%".$q."%' OR "; 
            $sq1 .= "contact like '%".$q."%' )";
        }
        $total = $this->db->query("SELECT count(*) as total FROM `staff` inner join `status` on staff.status = status.id where status!='0' AND staff.branch=$branch $sq1")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT staff.id,staff.firstname,staff.lastname,staff.designation,staff.contact,staff.qualification,staff.doj,staff.dob,staff.salery,status.name FROM `staff` inner join `status` on staff.status = status.id WHERE staff.branch = '$branch' AND status!='0' $sq1 LIMIT 0, $per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT staff.id,staff.firstname,staff.lastname,staff.designation,staff.contact,staff.qualification,staff.doj,staff.dob,staff.salery,status.name FROM `staff` inner join `status` on staff.status = status.id WHERE staff.branch = '$branch' AND status!='0'  $sq1 LIMIT $offset, $per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;
        
        $data['staffs'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('staff/status',$data);


    }
    public function status_update()
    {
        if($this->input->post())
         {
           $data=$this->input->post();
           $this->staff_model->status_update($data);
           redirect('staff/status');
         }
         else
         {
           redirect('staff/status');
         }
    }
    public function rollback()
    {
        if($this->uri->segment(3))
        {
                $data = $this->uri->segment(3);
                $this->staff_model->rollback($data);
                redirect('staff/status','refresh');
         }
         else
         {
                redirect('staff/status','refresh');
            
         }       
    }
    public function staffatt_add()
    {
        $this->user_model->check_permissions("staff/staffatt_add"); 
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $branchid=$this->user_model->getBranch();
        $data['staff']=$this->staff_model->all($branchid);
        $data['Attendancestatus']=$this->Teacher_model->AttendanceStatus();
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('staff/staffatt_add',$data);
    }
    public function saveatt()
    {
        $id=$this->input->post('staffattid',true);
        if($id>0){
            $td=$this->input->post('status',true);
            $date=$this->input->post('date',true);
       	    $data=array('status_id'=>$td,
               'date'=>$date
            );
            $check=$this->staff_model->staffattupdate($data,$id);
            if($check==true){
                redirect("staff/staffatt_view/");
                }else
                {
                    echo "Not update";
                 }
         }else
         {
            if($this->input->post())
            {
                $radio=$this->input->post('status',true);
                $date=$this->input->post('date',true);
                $dt=$this->input->post('id',true);
                foreach ($radio as $key => $value) 
                {
                        $data=array('staff_id' =>$key,
                        'status_id'=> $value,
                        'date'=>$date
                        );
                        $con= $this->staff_model->staffatt_save($data);
                        
                }
                if($con==true)
                {
                    redirect("staff/staffatt_view/");
                }else
                {
                    echo "not saved";
                }
            }
        }
    }
    public function staffatt_view($q="all",$p=1)
    {
        $this->user_model->check_permissions("staff/staffatt_view");  
        $data['menu'] = $this->load_model->menu();
        $total = $this->db->query("SELECT count(*) as total FROM `staffatt`")->result_array()[0]['total'];
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
            $sq1 .= "AND (firstname like '%".$q."%' OR "; 
            $sq1 .= "lastname like '%".$q."%' OR "; 
            $sq1 .= "designation like '%".$q."%' OR ";
            $sq1 .= "attendancestatus.status like '%".$q."%' OR "; 
            $sq1 .= "contact like '%".$q."%' )";
        }
        $total = $this->db->query("SELECT count(*) as total FROM `staffatt` inner join `staff` on staffatt.staff_id = staff.id inner join `attendancestatus` on attendancestatus.id = staffatt.status_id  WHERE staff.branch = '$branch' AND staff.status='0' AND staffatt.is_deleted='0' $sq1")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT staff.firstname,staff.lastname,staff.contact,staff.designation,attendancestatus.status,staffatt.id,staffatt.date FROM `staffatt` inner join `staff` on staffatt.staff_id = staff.id inner join `attendancestatus` on attendancestatus.id = staffatt.status_id  WHERE staff.branch = '$branch' AND staff.status='0'  AND staffatt.is_deleted='0' $sq1 LIMIT 0, $per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT staff.firstname,staff.lastname,staff.contact,staff.designation,attendancestatus.status,staffatt.id,staffatt.date FROM `staffatt` inner join `staff` on staffatt.staff_id = staff.id inner join `attendancestatus` on attendancestatus.id = staffatt.status_id  WHERE staff.branch = '$branch' AND staff.status='0'  AND staffatt.is_deleted='0' $sq1 LIMIT $offset, $per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;


        $branchid=$this->user_model->getbranch();
        
        $data['staffatt'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('staff/staffatt_view',$data);
    }
    public function actions($ref='',$value=0)
    {
        if($ref=="edit"){
            $data['menu'] = $this->load_model->menu();
            $data['base_url'] = base_url();
            $data['userInfo'] = $this->userInfo;
            $data['staffatt']=$this->staff_model->staffatt_edit($value)->result_array()[0];
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $data['statusid']=$this->db->select("*")->from('attendancestatus')->get()->result_array();
            $this->load->view('staff/staffatt_edit',$data);
         }else if($ref=="del")
         {
                $data['menu'] =$this->load_model->menu();
                $data['base_url'] = base_url();
                $data['userInfo'] = $this->userInfo;
                $check=$this->staff_model->staffatt_del($value);
                    if($check==true)
                    {
                        redirect("staff/staffatt_view/");
                    }else
                    {
                        echo "could not Delete";
                    }
          }
       }
}
