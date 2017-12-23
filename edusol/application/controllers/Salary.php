<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class salary extends CI_Controller {

    private $userInfo = array();
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("Salary_model","sm");
        $this->user_model->check_login("admin");

        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }
     public function index()
    {
        $this->user_model->check_permissions("salary/index");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("salary/advance",$data);
        $this->load->view("footer");
    }
    public function saveadv()
    {

        if($this->input->post()){
            $data=$this->input->post();
           
            $date = date("Y-m-d");
            $dat = array(
                'bothid' =>$data['emp'] ,
            'refrence'=>$data['type'],
            'month'=>$data['month'],
            'Amount'=>$data['amount'],
            'date'=>$date
             );
            $check=$this->sm->create("advancesal",$dat);
            if($check==true){
                 redirect('salary/index','refresh');
                }
                else{
                    echo "<h1>ni howa hay :'(</h1>";
                }

            
        }
    }
    public function actions($ref,$id)
    {
        if($ref=="edit" && $id!=0){
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $emp=$this->sm->id($id);
        $data['emp']=$emp;
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("salary/edit_sal",$data);
        $this->load->view("footer");

        }else if($ref=="del" && $id!=0){
           
           $dat = array(
               'is_delete'=>1
             );
             $check=$this->sm->Update("advancesal",$dat,"id",$id);
            if($check==true){
                 redirect('salary/index','refresh');
                }
                else{
                    echo "<h1>ni howa hay :'(</h1>";
                }
        }
    }
    public function update()
    {

        if($this->input->post()){
            $data=$this->input->post();
             
             $date = date("Y-m-d");
             $id=$this->input->post("advanceid",true);
            $dat = array(
                
                'bothid' =>$data['emp'] ,
            'refrence'=>$data['type'],
            'month'=>$data['month'],
            'Amount'=>$data['amount'],
            'date'=>$date
             );
             $check=$this->sm->Update("advancesal",$dat,"id",$id);
            if($check==true){
                 redirect('salary/index','refresh');
                }
                else{
                    echo "<h1>ni howa hay :'(</h1>";
                }

        }
    }
    //Allonce functions
    public function allonce()
    {
        $this->user_model->check_permissions("salary/allonce");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['allonce']=$this->sm->all('allonce');
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("salary/allonce",$data);
        $this->load->view("footer");
    }
    public function save_allonce()
    {
        if($this->input->post()){
            $data=$this->input->post();
           $branch=$this->user_model->getbranch();
           $dat = array(
                'name' =>$data['alloncename'] ,
            'amount'=>$data['allonceammount'],
            'branch'=>$branch,
           'description'=>$data['des']
             );
            $check=$this->sm->create("allonce",$dat);
            if($check==true){
                 redirect('salary/allonce','refresh');
                }
                else{
                    echo "<h1>ni howa hay :'(</h1>";
                }

            
        }
    }
     public function actionallonce($ref,$id)
    {
        if($ref=="edit" && $id!=0){
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['edit_allonce']=$this->sm->id_('allonce',$id,"id");
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("salary/allonce_edit",$data);
        $this->load->view("footer");

        }else if($ref=="del" && $id!=0){
           
           $dat = array(
               'is_delete'=>1
             );
             $check=$this->sm->Update("allonce",$dat,"id",$id);
            if($check==true){
                 redirect('salary/allonce','refresh');
                }
                else{
                    echo "<h1>ni howa hay :'(</h1>";
                }
        }
    }
    public function update_allonce()
    {

        if($this->input->post()){
            $data=$this->input->post();
             
             
             $id=$this->input->post("allonceid",true);
            $dat = array(
                'name' =>$data['alloncename'] ,
            'amount'=>$data['allonceammount'],
           'description'=>$data['des']
             );
             $check=$this->sm->Update("allonce",$dat,"id",$id);
            if($check==true){
                 redirect('salary/allonce','refresh');
                }
                else{
                    echo "<h1>ni howa hay :'(</h1>";
                }

        }
    }
    public function Assign()
    {
        $this->user_model->check_permissions("salary/Assign");
        $data=$this->sm->up();
        $data['allonce']=$this->sm->all("allonce");
       $this->sm->down("salary/assignallonce",$data);
    }
    public function saveasignalloance()
    {
        if($this->input->post()){
            $data=$this->input->post();
        foreach ($data as $key => $value) {
            foreach ($value as $k => $v) {
                $column = array('bothid' =>$v['employee']['id'] ,
                            'refrence'=>$v['employee']['type'],
                            'allowance_id'=>$v['allowance']['id'],
                            'amount'=>$v['allowance']['amount'],
                            'month'=>$v['allowance']['month']
                            );
                   $check= $this->sm->create("assign_allowance",$column);  
            }
        }
        if($check==true){
            redirect("salary/Assign","refresh");
        }else{echo "<h1>ni howa :'(</h1>";}
        }
    }
    public function Teacher_Allowance()
    {
        $this->user_model->check_permissions("Salary/Teacher_Allowance");
        $limit=10;
        $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
        $data=$this->sm->up();
        $data['employee']=$this->sm->teacher_data($limit,$offset);
        $data['offset']=$offset;
        $count=$this->sm->count('assign_allowance','teacher');
        $data['page_links']=$this->sm->dopaginate($count,$limit,3,"salary/Teacher_Allowance/");
        $this->sm->down("salary/teacher_allowance_view",$data);
    }
    public function Staff_Allowance()
    {   
        $this->user_model->check_permissions("Salary/Staff_Allowance");
        $limit=10;
        $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
        $data=$this->sm->up();
        $data['offset']=$offset;
        $count=$this->sm->count('assign_allowance','staff');
        $data['employee']=$this->sm->staff_data($limit,$offset);
        $data['page_links']=$this->sm->dopaginate($count,$limit,3,"salary/staff_Allowance/");
        $this->sm->down("salary/staff_alloance_view",$data);
    }
    public function Action_Allonce($ref="",$id=0)
    {
        if($ref=="edit"){
            $data=$this->sm->up();
            $data['allonce']=$this->sm->all("allonce");
            $data['edit']=$this->sm->id_('assign_allowance',$id,"id");
            $this->sm->down("salary/edit_allowance",$data);
        }else if($ref=="del"){
                 $dat = array(
               'is_delete'=>1
             );
             $check=$this->sm->Update("assign_allowance",$dat,"id",$id);
            if($check==true){
                 redirect('salary/assign','refresh');
                }
                else{
                    echo "<h1>ni howa hay :'(</h1>";
                }
        }else{echo "galat tareqa";}
    }
    public function Update_assign()
    { 
        if($this->input->post()){
            $data=$this->input->post();
            $id=$this->input->post('id',true);
            $column = array('bothid' =>$data['empid'] ,
                            'refrence'=>$data['type'],
                            'allowance_id'=>$data['allonce'],
                            'amount'=>$data['amount'],
                            'month'=>$data['month']
                            );
                $this->sm->update("assign_allowance",$column,'id',$id);  
        }
        if($data['type']=="teacher"){
            redirect("salary/Teacher_Allowance","refresh");
        }else{redirect("salary/Staff_Allowance","refresh");}

        
       
    }

    //++++++++++++++++++++++++++++++++++++Deduction Salary++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function Deduction()
    {
        $this->user_model->check_permissions("salary/Deduction");
        $data=$this->sm->up();
       $this->sm->down("salary/deduction",$data);
    }
    public function savededuction()
    {
         if($this->input->post()){
            $data=$this->input->post();
            $ref;
        foreach ($data as $key => $value) {
            foreach ($value as $k => $v) {
                $ref=$v['employee']['type'];
                $column = array('bothid' =>$v['employee']['id'] ,
                            'refrence'=>$v['employee']['type'],
                            'reason'=>$v['deduction']['reason'],
                            'amount'=>$v['deduction']['amount'],
                            'month'=>$v['deduction']['month']
                            );
                   $check= $this->sm->create("deduction",$column);  
            }
        }
        if($check==true && $ref=="teacher"){
            redirect("salary/teacher_deduct_view","refresh");
        }else if($check==true && $ref=="staff"){redirect("salary/staff_deduct_view","refresh");}else{echo "<h1>ni howa :'(</h1>";}
        }
    }
    public function teacher_deduct_view()
    {
        $this->user_model->check_permissions("salary/teacher_deduct_view");
        $limit=20;
        $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
        $data=$this->sm->up();
        $data['employee']=$this->sm->teacher_deduction($limit,$offset);
        $data['offset']=$offset;
        $count=$this->sm->count('deduction','teacher');
        $data['page_links']=$this->sm->dopaginate($count,$limit,3,"salary/teacher_deduct_view/");
        $this->sm->down("salary/teacher_deduct_view",$data);
    }
    public function staff_deduct_view()
    {
         $this->user_model->check_permissions("salary/staff_deduct_view");
        $limit=10;
        $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
        $data=$this->sm->up();
        $data['employee']=$this->sm->staff_deduction($limit,$offset);
        $data['offset']=$offset;
        $count=$this->sm->count('deduction','teacher');
        $data['page_links']=$this->sm->dopaginate($count,$limit,3,"salary/staff_deduct_view/");
        $this->sm->down("salary/staff_deduct_view",$data);
    }
    public function Action_Deduction($ref="",$id=0)
    {
        if($ref=="edit"){
            $data=$this->sm->up();
            $data['edit']=$this->sm->id_('deduction',$id,"id");
            $this->sm->down("salary/deduct_edit",$data);
        }else if($ref=="del"){
                 $dat = array(
               'is_delete'=>1
             );
             $check=$this->sm->Update("deduction",$dat,"id",$id);
            if($check==true){
                 redirect('salary/Deduction','refresh');
                }
                else{
                    echo "<h1>ni howa hay :'(</h1>";
                }
        }else{echo "galat tareqa";}
    }
    public function Update_deduction()
    { 
        if($this->input->post()){
            $data=$this->input->post();
            
            $id=$this->input->post('id',true);
            $column = array('bothid' =>$data['empid'] ,
                            'refrence'=>$data['type'],
                            'reason'=>$data['reason'],
                            'amount'=>$data['amount'],
                            'month'=>$data['month']
                            );
                $this->sm->update("deduction",$column,'id',$id);
        }
        if($data['type']=="teacher"){
            redirect("salary/teacher_deduct_view","refresh");
        }else{redirect("salary/staff_deduct_view","refresh");}
    }
    //++++++++++++++++++++++++++++++++++++Security Cut++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     public function Security()
    {
        $this->user_model->check_permissions("salary/Security");
        $data=$this->sm->up();
       $this->sm->down("salary/Security",$data);
    } 
    public function savesecurity()
    {
         if($this->input->post()){
            $data=$this->input->post();
          
            $ref;
        foreach ($data as $key => $value) {
            foreach ($value as $k => $v) {
                $ref=$v['employee']['type'];
                $column = array('bothid' =>$v['employee']['id'] ,
                            'refrence'=>$v['employee']['type'],
                            'security_amount'=>$v['security']['amount'],
                            'detuct_amount'=>$v['security']['amountcut'],
                            'remendar_amount'=>$v['security']['remandar'],
                            'month'=>$v['security']['month']
                            );
                   $check= $this->sm->create("security_deduct",$column);  
            }
        }
        if($check==true && $ref=="teacher"){
            
            redirect("salary/Security","refresh");
            
            
        }else if($check==true && $ref=="staff"){redirect("salary/staff_deduct_view","refresh");
        }else{echo "<h1>ni howa :'(</h1>";}
        }
    }
    public function Teacher_security_View()
    {
        $this->user_model->check_permissions("salary/Teacher_security_View");
         $limit=20;
        $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
        $data=$this->sm->up();
        $data['employee']=$this->sm->teacher_security_view($limit,$offset);
        $data['offset']=$offset;
        $count=$this->sm->count('security_deduct','teacher');
        $data['page_links']=$this->sm->dopaginate($count,$limit,3,"salary/Teacher_security_View/");
        $this->sm->down("salary/Teacher_security_View",$data);
    }
    public function Staff_security_View()
    {
        $this->user_model->check_permissions("salary/Staff_security_View");
         $limit=10;
        $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
        $data=$this->sm->up();
        $data['employee']=$this->sm->staff_security_view($limit,$offset);
        $data['offset']=$offset;
        $count=$this->sm->count('security_deduct','staff');
        $data['page_links']=$this->sm->dopaginate($count,$limit,3,"salary/Staff_security_View/");
        $this->sm->down("salary/Staff_security_View",$data);
    }
    public function Action_security($ref="",$id=0)
    {
        if($ref=="edit"){
            $data=$this->sm->up();
            $data['edit']=$this->sm->id_('security_deduct',$id,"id");
            $this->sm->down("salary/security_edit",$data);
        }else if($ref=="del"){
                 $dat = array(
               'is_delete'=>1
             );
             $check=$this->sm->Update("security_deduct",$dat,"id",$id);
            if($check==true){
                 redirect('salary/security','refresh');
                }
                else{
                    echo "<h1>ni howa hay :'(</h1>";
                }
        }else{echo "galat tareqa";}
    }
    public function Update_security($value='')
    {
       if($this->input->post()){
            $data=$this->input->post();
            
            $id=$this->input->post('id',true);
            $column = array('bothid' =>$data['empid'] ,
                            'refrence'=>$data['type'],
                            'security_amount'=>$data['amount'],
                            'detuct_amount'=>$data['amountcut'],
                            'remendar_amount'=>$data['rem'],
                            'month'=>$data['month']
                            );
                $this->sm->update("security_deduct",$column,'id',$id);
       }
        if($data['type']=="teacher"){
            redirect("salary/Teacher_security_View","refresh");
        }else{redirect("salary/staff_security_View","refresh");}
       
    }
//++++++++++++++++++++++++++++++++++++Create Salary++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    
    public function creat_salry()
    {
        $this->user_model->check_permissions("salary/creat_salry");
        $data=$this->sm->up();
       $this->sm->down("salary/create_sal",$data);
    }
    public function NextPage()
    {   
        if($this->input->post()){
        $data=$this->sm->up();
 
        $field=$this->input->post();

        $type=$field['type'];
        $month=$field['month'];
        $d=$this->sm->get('salary',$month,$type);

        $date=date('Y-m');
        $current= date_parse($date);
        $sel=date_parse($month);
        //var_dump(($sel['year'] <=$current['year']) && ($sel['month'] <=$current['month']) || (count($d) != 0) );die();
     
if($month<$date && count($d) == 0  ){
        $data['type']=$type;
        $data['month']=$month;
        $data['allonce']=$this->sm->get_assign_allonce($type,$month);
        $data['employee']=$this->sm->all_emp($type);
        $data['advance']=$this->sm->advance_all($type,$month);
        $data['deduction']=$this->sm->deduction_all($type,$month);
        $data['security']=$this->sm->security_all($type,$month);
        $this->sm->down("salary/Next_salary",$data);
        }else{
          $this->sm->down("salary/back",$data);}
        }else{echo "<h1>could not Permision Go Back</h1>";}


    }
    public function save_salary($value='')
    {
        $data=$this->input->post();
      
       $uid= $this->user_model->userInfo("id")['id'];
        $branch=$this->user_model->getbranch();
        $type=$data['type'];
        $month=$data['month'];
        $date=date('Y,m,d');
        foreach ($data['emp'] as $key => $value) {
            $field = array('bothid' =>$value['id'] ,
                            'refrence'=>$type,
                            'branch'=>$branch,
                            'total_amount'=>$value['total'],
                            'month'=>$month,                            
                            'user_id'=>$uid,
                             'create_date'=>$date
                             );
                        
                 $check=$this->sm->create('salary',$field);            
                   }
                   if($check==true && $type=="teacher"){
                       redirect('salary/view_salary','refresh');
                   }else{redirect('salary/view_salary','refresh');}

    }
    public function Teachersalary_view()
    {
        $this->user_model->check_permissions("salary/Teachersalary_view");
        $limit=200;
        $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
        $data=$this->sm->up();
        $data['employee']=$this->sm->Teacher_salary($limit,$offset);
        $data['offset']=$offset;
        $count=$this->sm->count_salery('salary','teacher');
        $data['page_links']=$this->sm->dopaginate($count,$limit,3,"salary/Teachersalary_view/");
        $this->sm->down("salary/teacher_salary_view",$data);
    }
    public function staff_salary_view()
    {
        $this->user_model->check_permissions("salary/staff_salary_view");
         $limit=200;
        $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
        $data=$this->sm->up();
        $data['employee']=$this->sm->staff_salary($limit,$offset);
        $data['offset']=$offset;
        $count=$this->sm->count_salery('salary','staff');
        $data['page_links']=$this->sm->dopaginate($count,$limit,3,"salary/staff_salary_view/");
        $this->sm->down("salary/staff_salary_view",$data);
    }
   
    public function teacher_sal_search($v='')
    {
        $re=$this->sm->Teacher_salary1($v);
        echo json_encode($re);
    }
    public function staff_sal_search($v='')
    {
        $re=$this->sm->staff_salary1($v);
        echo json_encode($re);
    }
      public function Action_salary($id=0)
    {
        $data=$this->sm->up();
        $ret=$this->sm->id_('salary',$id,'id');
        $branch=$this->user_model->getbranch();
        $data['branch']=$this->sm->id_('branch',$branch,'id');
        $ref=$ret['refrence'];
        $data['ret']=$ret;
        $data['create_date']=$ret['create_date'];
        $month=$ret['month'];
        $data['sal_id']=$id;
        $bothid=$ret['bothid'];
        $data['bothid']=$bothid;
        $data['month']=$month;
        $data['invoice']=$ret['id'];
        $data['allonce']=$this->sm->get_assign_allonce_id($ref,$month,$bothid);
        $data['employee']=$this->sm->emp_id($ref,$bothid);
        $data['advance']=$this->sm->advance_all_id($ref,$month,$bothid);
        $data['deduction']=$this->sm->deduction_all_id($ref,$month,$bothid);
        $data['security']=$this->sm->security_all_id($ref,$month,$bothid);
        $this->sm->down("salary/history",$data);
    }
     public function view_salary()
    {
        $this->user_model->check_permissions("salary/view_salary");
        $data=$this->sm->up();
       $this->sm->down("salary/view",$data);
    }
    public function salary_view()
    {
       if($this->input->post()){
        $data=$this->input->post();
        $data=$this->sm->up();
        $field=$this->input->post();
        $type=$field['type'];
        $month=$field['month'];
        $d=$this->sm->get('salary',$month,$type);
        $date=date('Y-m');
        $current= date_parse($date);
        $sel=date_parse($month);
        $data['type']=$type;
        $data['month']=$month;
        $data['allonce']=$this->sm->get_assign_allonce($type,$month);
        $data['employee']=$this->sm->salary_emp($type,$month);
        $data['advance']=$this->sm->advance_all($type,$month);
        $data['deduction']=$this->sm->deduction_all($type,$month);
        $data['security']=$this->sm->security_all($type,$month);
        $this->sm->down("salary/salary_view",$data);
       }
       }
       public function is_paid($id=0)
       {
        $this->sm->update_salary($id);
        redirect("salary/Action_salary/".$id,"refresh"); 
       }
       public function printview($type,$month){
          $branch=$this->user_model->getBranch();
          $data['type']=$type;
        $data['month']=$month;
         $data['b_header']= $this->db->query("SELECT * FROM `branch` WHERE is_delete='0' AND id='$branch'")->row_array();
         $data['allonce']=$this->sm->get_assign_allonce($type,$month);
        $data['employee']=$this->sm->salary_emp($type,$month);
        $data['advance']=$this->sm->advance_all($type,$month);
        $data['deduction']=$this->sm->deduction_all($type,$month);
        $data['security']=$this->sm->security_all($type,$month);
         $this->load->view("salary/print_detail_head",$data);
        }


}