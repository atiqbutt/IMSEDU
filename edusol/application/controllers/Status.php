<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class status extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("status_model");
        $this->user_model->check_login("admin");

        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

 
    public function index($q="all",$p=1)
    {
       $this->user_model->check_permissions("status/index");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $data['branchid']=$this->user_model->getbranch();
        $branch = $this->user_model->getBranch();
        

          $q = urldecode($q);
        $p = $p<1?1:$p;
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
          $sq1 = "";
        if($q!="all")
        {
            $sq1 .= "AND (name like '%".$q."%' OR ";
            $sq1 .= "type like '%".$q."%' OR "; 
            $sq1 .= "description like '%".$q."%' )";
        }
        $total = $this->db->query("SELECT count(*) as total FROM `status` where is_delete='0' AND branch='$branch' $sq1")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT * FROM `status` where is_delete='0' AND branch='$branch' $sq1 LIMIT 0, $per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT * FROM `status` where is_delete='0' AND branch='$branch' $sq1 LIMIT $offset, $per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['teachers'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('status/status_add',$data);
    }

    public function save()
    {
        if($this->input->post())
      {
        $data = $this->input->post();
        $db_insert = $this->status_model->save($data);
        redirect("status/index","refresh");
       }
       else
       {
         echo "galt";
        //redirect("status/index","refresh");
       } 
    }

    public function edit()
    {
            $this->user_model->check_permissions("status/index");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
             $id = $this->uri->segment(3);
             $data['val']= $this->db->where('id',$id)->get('status')->result();
             $data['userInfo'] = $this->userInfo;
             $data['base_url'] = base_url();
             
             $this->load->view('header',$data);
             $this->load->view('sidebar',$data);
        
             $this->load->view('status/status_edit',$data);


      
    }

    public function update()
    {
        $data = $this->input->post();
        $db_update = $this->status_model->update($data);
        redirect("status/index","refresh");


   }
   // public function status($p=1)
   // {
   //      $total = $this->db->query("SELECT count(*) as total FROM `teacher` inner join status on teacher.status = status.id")->result_array()[0]['total'];
   //      $per_page = 10;
   //      $offset = ($p - 1) * $per_page;
   //      $this->db->select("*"); 
   //      $this->db->from('status');
   //      $this->db->join('teacher','teacher.status = status.id');
   //      $this->db->limit($per_page,$offset);
   //      $query = $this->db->get();
   //      $data['base_url'] = base_url();
   //      $data['userInfo'] = $this->userInfo;
   //      $data['teachers'] = $query->result_array();
   //      $data['total'] = ceil($total / $per_page);
   //      $this->load->view('header',$data);
   //      $this->load->view('sidebar',$data);
   //      $this->load->view('teacher/status',$data);


   // }
   public function status_update()
   {
           $data=$this->input->post();
           $this->status_model->status_update($data);
          redirect('status/index');
   }

   public function delete(){

            $id=$this->uri->segment(3);
            $this->status_model->delete($id);
            redirect ('status/index','refresh');
   }
  


}
