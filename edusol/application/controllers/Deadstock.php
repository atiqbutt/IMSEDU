<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deadstock extends CI_Controller {

	private $userInfo = array();
    private $is_super;
    private $branch;

    public function __construct()
    {
        parent::__construct();
		$this->load->model('report_model');
		$this->user_model->check_login("Deadstock");
		$this->userInfo = $this->user_model->userInfo("first_name,last_name");
        $this->is_super = $this->user_model->is_super();
        $this->branch = $this->user_model->getBranch();
    }

	public function add()
	{
		$this->user_model->check_permissions("Deadstock/add");
		$data['menu'] = $this->load_model->menu();
		$data['base_url'] = base_url();
		$data['userInfo'] = $this->userInfo;

		if($this->is_super)
		$data['branch']=$this->db->select('id,name')->where('is_delete',0)->get('branch')->result_array();
		else
		$data['branch']=$this->db->select('id,name')->where('is_delete',0)->where('id',$this->branch)->get('branch')->result_array();


		$this->load->view('header',$data);
		$this->load->view('sidebar',$data);
		$this->load->view('deadstock/add',$data);
		$this->load->view('footer',$data);
	}

	public function save()
	{
		$data=$this->input->post();
		$data['date']=date('Y-m-d');
		$this->db->insert('deadstock',$data);
		redirect('Deadstock/view','refresh');
	}

	public function view()
	{
		$this->user_model->check_permissions("Deadstock/view");
		$data['menu'] = $this->load_model->menu();
		$data['base_url'] = base_url();
		$data['userInfo'] = $this->userInfo;
		$data['is_super'] = $this->is_super;

		$this->db->select('deadstock.*,branch.name as branch_name');
		$this->db->join('branch','branch.id=deadstock.branch');
		if(!$this->is_super)
		$this->db->where('branch',$this->branch);
		$this->db->where('deadstock.is_delete',0);
		$data['deadstock']=$this->db->get('deadstock')->result_array();		

		$this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('deadstock/view',$data);
	}

	public function edit($id='')
	{
		$data['menu'] = $this->load_model->menu();
		$data['base_url'] = base_url();
		$data['userInfo'] = $this->userInfo;
		if($this->is_super)
		$data['branch']=$this->db->select('id,name')->where('is_delete',0)->get('branch')->result_array();
		else
		$data['branch']=$this->db->select('id,name')->where('is_delete',0)->where('id',$this->branch)->get('branch')->result_array();
		
		if($id=!'') {
			$data['deadstock']=$this->db->where('id',$id)->get('deadstock')->row_array();
			$this->load->view('header',$data);
			$this->load->view('sidebar',$data);
			$this->load->view('deadstock/edit',$data);
			$this->load->view('footer',$data);
		}
		else {
			echo "Invalid id";
		}
	}

	public function update()
	{
		$data=$this->input->post();
		$this->db->where('id',$data['id']);
		$this->db->update('deadstock',$data);
		redirect('Deadstock/view','refresh');
	}

	public function print_dead($branch='')
	{
		if($branch!='') {
			$data['b_header']= $this->report_model->BranchHeader();
			$this->db->select('deadstock.*,branch.name as branch_name');
			$this->db->join('branch','branch.id=deadstock.branch');
			if(!$this->is_super)
			$this->db->where('branch',$this->branch);
			$this->db->where('deadstock.is_delete',0);
			$data['deadstock']=$this->db->get('deadstock')->result_array();
			$this->load->view('deadstock/print',$data);
		}
	}


}
