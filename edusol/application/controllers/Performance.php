<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Performance extends CI_Controller {
    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('performance_model','pm');
        $this->load->model('teacher_model','te');
        $this->load->model('staff_model','st');
        $this->user_model->check_login("admin");
        $this->load->model("user_model");
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }
    public function attributes($p=1)
    {
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $total = $this->db->query("SELECT count(*) as total FROM `attributes`")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $query=$this->pm->all();
        $data['attributes'] = $query->result_array();
        $data['total'] = ceil($total / $per_page);
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("performance/attributes_add",$data);
        $this->load->view("footer");

    }
    public function saveattribute()
    {   
        $id=$this->input->post("id",true);
        if($id>0){
            $up = array('attributename' =>$this->input->post('attribute_name',true));
            $check=$this->pm->updateattribute($up,$id);
            if($check==true){
                redirect("performance/attributes/","rfresh");
            }else{
                echo "could not Update";
            }
        }else{
        $data = array('attributename' =>$this->input->post('attribute_name',true)  );
        $check=$this->pm->saveattribute($data);
        if($check==true){
            redirect("performance/attributes/","refresh");
        }else{
            echo "Could not Saved";
        }
        }
    }
    public function actions($ref="",$value=0)
    {
        if($ref=="edit"){
            $data['menu'] = $this->load_model->menu();
            $data['base_url'] = base_url();
            $data['userInfo'] = $this->userInfo;
            $data['attribute']=$this->pm->id($value)[0];
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view("performance/editattribute",$data);
            $this->load->view("footer");

        }else if($ref=="del"){
             $check=$this->pm->attributedel($value);
             if($check==true){
                redirect("performance/attributes/","refresh");
            }else
            {
                echo "could not Delete";
            } 
        }
    }
    public function response($p=1)
    {
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $total = $this->db->query("SELECT count(*) as total FROM `keyresponsibility`")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $query=$this->pm->allkey();
        $data['response'] = $query->result_array();
        $data['total'] = ceil($total / $per_page);
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("performance/keyrespons_add",$data);
        $this->load->view("footer");
    }
    public function savekey($value='')
    {
         
        $id=$this->input->post("id",true);
        if($id>0){
            $up = array('key' =>$this->input->post('key',true));
            $check=$this->pm->updatekey($up,$id);
            if($check==true){
                redirect("performance/response/","rfresh");
            }else{
                echo "could not Update";
            }
        }else{
        $data = array('key' =>$this->input->post('key',true)  );
        $check=$this->pm->savekey($data);
        if($check==true){
            redirect("performance/response/","refresh");
        }else{
            echo "Could not Saved";
        }
        }
    }
    public function actionskey($ref="",$value=0)
    {
       if($ref=="edit"){
            $data['menu'] = $this->load_model->menu();
            $data['base_url'] = base_url();
            $data['userInfo'] = $this->userInfo;
            $data['response']=$this->pm->idkey($value)[0];
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view("performance/editkey",$data);
            $this->load->view("footer");

        }else if($ref=="del"){
             $check=$this->pm->keydel($value);
             if($check==true){
                redirect("performance/response/","refresh");
            }else
            {
                echo "could not Delete";
            } 
        }
    }
    public function performa()
    {   
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['review']=$this->pm->reviewtype();
        $data['teacher']=$this->te->all();
        $data['staff']=$this->st->staffall();
        $data['grade']=$this->pm->Get_grade();
        $data['attri']=$this->pm->Get_attribute();
        $data['res']=$this->pm->Get_keyresposbility(); 
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("performance/performa",$data);
        $this->load->view('footer');
        
    }
    public function emp_info()
    {
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("performance/emp_info",$data);
        $this->load->view('footer');
    }
    public function saveemp_info()
    {
        $data=$this->input->post();
        $dat = array('employe_id' =>$data['emp_id'] ,
                    'type'=>$data['type'],
                    'Contract_type'=>$data['ctype'],
                    'Contract_end'=>$data['ced'],
                    'confirmation_due'=>$data['cdd'],
                    'tottaltenure'=>$data['tenure'],
                    'benifits'=>$data['benifits'],
                    'review_period'=>$data['period'],
                    'department'=>$data['department'],
                    'grade'=>$data['grade']
                     );
        $check=$this->pm->saveemp($dat);
        if($check==true){
            redirect("performance/emp_info","refresh");
        }else{
            echo "could not saved";
        }
    }
    public function Save_apraise()
    {     $dat=$this->input->post();
       // var_dump($dat);
        $data = array('type'=>$dat['typereview'] ,
        
                'empid'=>$dat['empid'],
                'attritotalgrade'=>$dat['attritotal'],
                'keytotalgrade'=>$dat['keyfinal'],
                'Aggregatescore'=>$dat['finalforum'],
                    'finalgrade'=>$dat['fgrade']
                        );
        $id=$this->pm->save_apraise($data);
        $atrid=$dat['attributeid'];
        $atrgrad=$dat['attrigrades'];
        $coun=count($atrid);
        for ($i=0; $i<$coun ; $i++) { 
          $attri = array('apraiseid' =>$id ,
                         'atributeid'=>$atrid[$i],
                         'gradeid'=>$atrgrad[$i]);
        $this->pm->Save_attri($attri);  
        }
        $keyid=$dat['keyid'];
        $keyachivment=$dat['achivment'];
        $keygrade=$dat['keygrades'];
        $keytotal=count($keyid);
        for ($i=0; $i <$keytotal; $i++) { 
            $keyarray = array('apraiseid' =>$id ,
            
                         'keyresponseid'=>$keyid[$i],
                         'achivment'=>$keyachivment[$i],
                         'gradeid'=>$keygrade[$i]    );
        $this->pm->Save_key($keyarray); 
        }
        redirect("performance/Show_apraise","refresh");
    }
    public function Show_apraise($p=1)
    {
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $total = $this->db->query("SELECT count(*) as total FROM `apraisedata`")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $query=$this->pm->All_apraise();
        $data['apraise'] = $query->result_array();
        $data['total'] = ceil($total / $per_page);
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("performance/performaview",$data);
        $this->load->view("footer");
    }
    public function single_performance($ref="",$val="")
    {
         $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['data']=$this->pm->getdata($ref,$val);
        $data['review']=$this->pm->reviewtype();
         $data['grade']=$this->pm->Get_grade();
         $data['attri']=$this->pm->getattribute($val);
         $data['keyre']=$this->pm->Get_keyrespon($val);
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("performance/singleview",$data);
        $this->load->view("footer");
    }
    public function Appraise_del($value=0)
    {
         $check=$this->pm->Appraise_del($value);
             if($check==true){
                redirect("performance/Show_apraise/","refresh");
            }else
            {
                echo "could not Delete";
            } 
    }

}