<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  Transport
 * @author      Atif Razzaq
 * @link        http://atifrazzaq.arteck.xyz
 */
class Transport extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("transport_model");
        $this->user_model->check_login("admin");
$this->load->library('form_validation');

        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

     public function index()
    {
      $this->stop();
    }
      public function stop()
      {
        $this->user_model->check_permissions("transport/stop");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $branch=$this->user_model->getbranch();
        
          



        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['stop'] = $this->transport_model->getstop();
        $data['city'] = $this->db->select("city_name,city_id")->from("city")->get()->result_array();
        
            if($this->user_model->is_super())
                $data['branch'] = $this->db->select("name,id")->from("branch")->get()->result_array();
            else
                $data['branch'] = $this->db->select("name,id")->from("branch")->where("id",$branch)->get()->result_array();


            //calling views
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('transport/add_stop',$data);
        $this->load->view('footer',$data);
      }
    public function save_stop()
    {
        if($this->input->post())
        {
            $data = $this->input->post();
            $db_insert = $this->transport_model->save_stop($data);
            redirect("transport/stop","refresh");
        }
        else
        {
            redirect("transport/stop","refresh");
        }
    }
        
      public function coster_service($q="all",$p=1)
      {
        $this->user_model->check_permissions("transport/coster_service");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $branch=$this->user_model->getbranch();

           $q = urldecode($q);
        $p = $p<1?1:$p;
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
          $sq1 = "";
        if($q!="all")
        {
            $sq1 .= "AND (province.province_name like '%".$q."%' OR ";
            $sq1 .= "district.name like '%".$q."%' OR "; 
            $sq1 .= "country.country_name like '%".$q."%' )";
        }
        $total = $this->db->query("SELECT count(*) as total FROM `student` inner join `promotion` on promotion.student_id=student.id inner join `class` on promotion.class_id=class.class_id inner join `transport` on student.id=transport.student_id inner join `stop` on transport.stop_id=stop.id where transport.is_active='1' AND promotion.is_active='1' AND student.branch='$branch' AND transport.is_delete='0' $sq1")->result_array()[0]['total'];
         if($total<=$offset)
         {
                    $query = $this->db->query("SELECT * FROM `student` inner join `promotion` on promotion.student_id=student.id inner join `class` on promotion.class_id=class.class_id inner join `transport` on student.id=transport.student_id inner join `stop` on transport.stop_id=stop.id where transport.is_active='1' AND promotion.is_active='1' AND transport.is_delete='0' AND student.branch='$branch' $sq1 LIMIT 0, $per_page");
                $p=1;
                }else
        $query = $this->db->query("SELECT * FROM `student` inner join `promotion` on promotion.student_id=student.id inner join `class` on promotion.class_id=class.class_id inner join `transport` on student.id=transport.student_id inner join `stop` on  transport.stop_id=stop.id where transport.is_active='1' AND promotion.is_active='1' AND transport.is_delete='0' AND student.branch='$branch' $sq1 LIMIT $offset, $per_page");

        
        $data['q'] = $q;
        $data['curr'] = $p;
        $data['searchq'] = $q;


        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['coster'] = $query->result_array();
        $data['end'] = ceil($total / $per_page);
            //===========================================
        
            //calling views
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('transport/coster_form',$data);

      }
      public function get_student()
      {
       
        if($this->input->post('grno')){
            $gr=$this->input->post('grno');
            $this->form_validation->set_rules('grno','GR No','required|alpha_numeric|is_unique[transport.grno]');
            $this->form_validation->set_message('is_unique', 'The %s is already taken Transport Service');
         if($this->form_validation->run() == TRUE) 
        {
        
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $branch=$this->user_model->getbranch();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['student']=$this->transport_model->get_student($gr);
        $data['city'] = $this->db->select("city_name,city_id")->from("city")->where("is_delete",'0')->get()->result_array();
        $this->db->where('grno',$gr);
        $this->db->select("*"); 
        $this->db->from('student');
        $this->db->join('promotion', 'promotion.student_id=student.id');
        $this->db->join('class', 'promotion.class_id=class.class_id');
        $query=$this->db->get();
        if($query->num_rows() == 1)
         {
             $query=$query->result_array();

        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('transport/coster_form_student',$data);
        $this->load->view('footer',$data);
        }
        else{

            echo "No data Found Accourding to this GR #";
            redirect('transport/coster_service','refresh');
        } 
    }
    else{
        $this->coster_service();
    }
}
    else{
            redirect('transport/coster_service','refresh');

    }
      }
      public function save_student_transport()
      {
        if ($this->input->post()) {
            $data=$this->input->post();
            $this->transport_model->save_student_transport($data);
            redirect('transport/coster_service','refresh');

        }
        else
        {
                redirect('transport/coster_service','refresh');
        }
      }

  public function search()
  {
    $gr=$this->input->post('grno');
    $this->db->where('student_name',$gr);
    $data['student']=$this->db->get('student');
      if($data['student']->num_rows() > 1){

        echo "find";
      }
      else
      {
        echo "not found";
      }

  }  

  public function deactive()
    {   
        if($this->uri->segment(3))
         {
             $id=$this->uri->segment(3);
             $this->transport_model->deactive($id);
             redirect('transport/coster_service','refresh');
         }
         else
         {
             redirect('transport/coster_service','refresh');

         }
    }

    public function active()
    {
        if($this->uri->segment(3))
        {
            $id=$this->uri->segment(3);
            $this->transport_model->active($id);
             redirect('transport/coster_service','refresh');

        }
        else
        {
             redirect('transport/coster_service','refresh');
            
        }
    }
    

   public function delete()
   {
        if($this->uri->segment(3))
        {
            $id=$this->uri->segment(3);
            $this->transport_model->delete($id);
            redirect('transport/stop','refresh');   
        }
        else
        {
            redirect('transport/stop','refresh');   

          
        }
       
   }
   public function delete_trans()
   {
        if($this->uri->segment(3))
        {
            $id=$this->uri->segment(3);
            $this->transport_model->delete_trans($id);
            redirect('transport/coster_service','refresh');   
        }
        else
        {
            redirect('transport/coster_service','refresh');   

          
        }
       
   }

}
