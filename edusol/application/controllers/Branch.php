<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->user_model->check_login("admin");
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

	public function index()
	{
        $this->user_model->check_permissions("branch/view");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
		$this->load->view('user/view',$data);
	}

    public function add()
	{
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('branch/add',$data);
	}

    public function save()
    {
        $data['menu'] = $this->load_model->menu();
        if($this->input->post())
        {
            $name = $this->input->post("name",true);
            $address = $this->input->post("address",true);
            $contact = $this->input->post("contact",true);
            $b_head = $this->input->post("b_head",true);
            $b_h_contact = $this->input->post("b_h_contact",true);
            $c_person = $this->input->post("c_person",true);
            $title = $this->input->post("title",true);
            $tagline = $this->input->post("tagline",true);
            $short_address = $this->input->post("short_address",true);
            $phone_no = $this->input->post("phone_no",true);
            $email = $this->input->post("email",true);
            $due_date = $this->input->post("due_date",true);
            $late_fine = $this->input->post("late_fine",true);

            if(!empty($name) AND !empty($address) AND !empty($contact) AND !empty($b_head) AND !empty($b_h_contact) AND !empty($c_person) AND !empty($title) AND !empty($tagline) AND !empty($short_address) AND !empty($phone_no) AND !empty($email) AND !empty($due_date) AND !empty($late_fine))
            {
                $this->load->library('upload');
                $b_logo = $this->do_upload($_FILES["b_logo"]);
                $url1 = $this->do_upload($_FILES["logo1"]);
                $url2 = $this->do_upload($_FILES["logo2"]);
                $data = array(
                'name'=>$name,
                'address'=>$address,
                'contact'=>$contact,
                'b_head'=>$b_head,
                'b_h_contact'=>$b_h_contact,
                'c_person'=>$c_person,
                'title'=>$title,
                'tagline'=>$tagline,
                'short_address'=>$short_address,
                'phone_no'=>$phone_no,
                'email'=>$email,
                'logo1'=>$url1,
                'logo2'=>$url2,
                'b_logo'=>$b_logo,
                'due_date'=>$due_date,
                'late_fine'=>$late_fine
                );

                $this->db->insert('branch',$data);

                $branch_id = $this->db->insert_id();

                $d = array(
                    "branch_id"=> $branch_id,
                    "title"=> "Default",
                    "remarks"=> "For Default Users."
                );

                $this->db->insert("role",$d);

                redirect("branch/view","refresh");
            }else{
                redirect("branch/add","refresh");
            }
        }
    }

    public function view($p=1)
    {
        $this->user_model->check_permissions("branch/view");
        $data['menu'] = $this->load_model->menu();
        $total = $this->db->query("SELECT count(*) as total FROM `branch`")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $this->db->select("id,name,address,contact,b_head,b_h_contact,c_person,is_delete"); 
        $this->db->from('branch');
        $this->db->limit($per_page,$offset);
        $query = $this->db->get();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['branches'] = $query->result_array();
        $data['total'] = ceil($total / $per_page);
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('branch/view',$data);
    }

    public function deactivate($p=0)
    {
        $data = array(
            "is_delete"=>"1"
        );

        $this->db->where("id",$p);
        $this->db->update("branch",$data);
        redirect("branch/view","refresh");
    }

    public function activate($p=0)
    {
        $data = array(
            "is_delete"=>"0"
        );

        $this->db->where("id",$p);
        $this->db->update("branch",$data);
        redirect("branch/view","refresh");
    }
    
    public function edit($p=0)
    {
        $this->db->select("*"); 
        $this->db->from('branch');
        $this->db->where("is_delete","0");
        $this->db->where("id",$p);
        $query = $this->db->get();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['branch'] = $query->result_array()[0];
        $this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('branch/edit',$data);
    }
    
    public function update()
    {
        if($this->input->post())
        {
            $id = $this->input->post("id",true);
            $name = $this->input->post("name",true);
            $address = $this->input->post("address",true);
            $contact = $this->input->post("contact",true);
            $b_head = $this->input->post("b_head",true);
            $b_h_contact = $this->input->post("b_h_contact",true);
            $c_person = $this->input->post("c_person",true);
            $title = $this->input->post("title",true);
            $tagline = $this->input->post("tagline",true);
            $short_address = $this->input->post("short_address",true);
            $phone_no = $this->input->post("phone_no",true);
            $email = $this->input->post("email",true);
            $b_logo_old = $this->input->post("b_logo_old",true);
            $logo1_old = $this->input->post("logo1_old",true);
            $logo2_old = $this->input->post("logo2_old",true);
            $due_date = $this->input->post("due_date",true);
            $late_fine = $this->input->post("late_fine",true);

            if(!empty($name) AND !empty($address) AND !empty($contact) AND !empty($b_head) AND !empty($b_h_contact) AND !empty($c_person) AND !empty($title) AND !empty($tagline) AND !empty($short_address) AND !empty($phone_no) AND !empty($email) AND !empty($due_date) AND !empty($late_fine))
            {
                $this->load->library('upload');

                if(!empty($_FILES['b_logo']['name']))
                {
                    $b_logo = $this->do_upload($_FILES["b_logo"]);
                }else{
                    $b_logo = $b_logo_old;
                }
                if(!empty($_FILES['logo1']['name']))
                {
                    $url1 = $this->do_upload($_FILES["logo1"]);
                }else{
                    $url1 = $logo1_old;                }
                if(!empty($_FILES['logo2']['name']))
                {
                    $url2 = $this->do_upload($_FILES["logo2"]);
                }else{
                    $url2 = $logo2_old;
                }
                $data = array(
                'name'=>$name,
                'address'=>$address,
                'contact'=>$contact,
                'b_head'=>$b_head,
                'b_h_contact'=>$b_h_contact,
                'c_person'=>$c_person,
                'title'=>$title,
                'tagline'=>$tagline,
                'short_address'=>$short_address,
                'phone_no'=>$phone_no,
                'email'=>$email,
                'logo1'=>$url1,
                'logo2'=>$url2,
                'b_logo'=>$b_logo,
                'due_date'=>$due_date,
                'late_fine'=>$late_fine
                );
                $this->db->where('id',$id);
                $this->db->update('branch',$data);
                redirect("branch/view","refresh");
            }else{
                redirect("branch/edit/$id","refresh");
            }
        }
    }

    private function do_upload($p)
    {
        $type = explode('.', $p["name"]);
        $type = $type[count($type)-1];
        $url = "images/".uniqid(rand()).'.'.$type;
        if (in_array($type, array("png","jpg","jpeg","gif")))
            if(move_uploaded_file($p["tmp_name"], $url))
                return $url;
        return ""; 
    }

}
