<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fee extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("class_model");
       // $this->load->model("teacher_model");
        $this->user_model->check_login("admin");

        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

    public function index($p=1)
    {
        $this->view($p);
    }
    
    public function view($p=1)
    {
        $this->user_model->check_permissions("fee/view");
        $data['is_super'] = $this->user_model->is_super();
         $branch=$this->user_model->getbranch();
        $data['menu'] = $this->load_model->menu();
        $total = $this->db->query("SELECT count(*) as total FROM `fee_def` where is_delete='0' and branch_id=$branch")->result_array()[0]['total'];
        $per_page = 20;
        $offset = ($p - 1) * $per_page;
        $this->db->select("fee_def.id,fee_def.name,fee_def.amount,class.class_name as c_name,branch.name as b_name"); 
        $this->db->from('fee_def');
        $this->db->join('class','fee_def.class_id = class.class_id');
        $this->db->join('branch','fee_def.branch_id = branch.id');
        $this->db->where('fee_def.is_delete','0')->where('fee_def.branch_id',$branch);
        $this->db->limit($per_page,$offset);
        $query = $this->db->get();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['fee'] = $query->result_array();
        $data['total'] = ceil($total / $per_page);
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('fee/view',$data);
    }

    public function add()
    {
        $this->user_model->check_permissions("fee/add");
        $branch = $this->user_model->getbranch();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        if($this->user_model->is_super())
            $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result_array();
        else
            $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result_array();
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('fee/add',$data);
    }
    
    public function save()
    {
        if($this->input->post())
        {
            $branch = $this->input->post("branch",true);
            $class = $this->input->post("class",true);
            $name = $this->input->post("name",true);
            $amount = $this->input->post("amount",true);

            $data = array(
                "branch_id"=>$branch,
                "class_id"=>$class,
                "name"=>$name,
                "amount"=>$amount
            );

            $this->db->insert("fee_def",$data);
            redirect("fee/view","refresh");
        }
    }

    public function delete($p)
    {
        if(!empty($p))
        {
            $data = array(
                "is_delete"=>"1"
            );
            $this->db->where("id",$p);
            $this->db->update("fee_def",$data);
            redirect("fee/view","refresh");
        }
    }

    public function edit($p=1)
    {
        $branch = $this->user_model->getbranch();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        if($this->user_model->is_super())
        {
            $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result_array();
            $data['class'] = $this->db->select("class_name,class_id")->from("class")->get()->result_array();
        }
        else
        {
            $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result_array();
            $data['class'] = $this->db->select("class_name,class_id")->from("class")->where("branch",$branch)->get()->result_array();
        }
        $data['data'] = $this->db->select("name,amount,id,class_id,branch_id")->from("fee_def")->where("id",$p)->get()->result_array()[0];
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('fee/edit',$data);
    }

    public function update()
    {
        if($this->input->post())
        {
            $id = $this->input->post("id",true);
            $branch = $this->input->post("branch",true);
            $class = $this->input->post("class",true);
            $name = $this->input->post("name",true);
            $amount = $this->input->post("amount",true);

            $data = array(
                "branch_id"=>$branch,
                "class_id"=>$class,
                "name"=>$name,
                "amount"=>$amount
            );

            $this->db->where("id",$id);
            $this->db->update("fee_def",$data);
            redirect("fee/view","refresh");
        }
    }

}
