<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  class
 * @author      Atif Razzaq
 * @link        http://atifrazzaq.arteck.xyz
 */
class Account extends CI_Controller {

    private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model("account_model");
        $this->user_model->check_login("admin");
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

            /*==================== Program===============================*/
    public function index($p=1)
    {
        $this->user_model->check_permissions("account/index");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $total = $this->db->query("SELECT count(*) as total FROM `program` where is_delete='0'")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $this->db->where('is_delete','0');
        $this->db->select("*"); 
        $this->db->from('program');
        $this->db->limit($per_page,$offset);
        $query = $this->db->get();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['program'] = $query->result_array();
        $data['total'] = ceil($total / $per_page);
                // calling view pages
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('account/program',$data);
        $this->load->view('footer',$data);
    }
           
    public function save_program()
    {
        if($this->input->post())
        {

            $data = $this->input->post();
            $db_insert = $this->account_model->save_program($data);
            redirect("account/index","refresh");   
        }
        else
        {
            redirect("account/index","refresh");   

        }
    }

  
   public function delete_program()
   {
            
        if($this->uri->segment(3))
        {
            $id=$this->uri->segment(3);
            $this->account_model->delete_program($id);
            redirect('account/index','refresh');    
        }
        else
        {
            redirect('account/index','refresh');    

        }
       
   }
            /*==================== Project===============================*/

   public function project($p=1)
   {

        $this->user_model->check_permissions("account/project");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $total = $this->db->query("SELECT count(*) as total FROM `project` where is_delete='0'")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $this->db->where('project.is_delete','0');
        $this->db->select("project.id,project.p_name,program.name"); 
        $this->db->from('project');
        $this->db->join('program','program.id=project.program_id');
        $this->db->limit($per_page,$offset);
        $query = $this->db->get();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['project'] = $query->result_array();
        $data['total'] = ceil($total / $per_page);

        $data['program'] = $this->db->query("SELECT id,name FROM `program` WHERE is_delete='0'")->result_array();

                // calling view pages
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('account/project',$data);
        $this->load->view('footer',$data);
   }
   public function save_project()
   {
        if($this->input->post())
         {
            $data=$this->input->post();
            $this->account_model->save_project($data);
            redirect('account/project','refresh');    

         }
        else
        {
            redirect('account/project','refresh');    

        }
   }

  public function delete_project()
   {
            
        if($this->uri->segment(3))
        {
            $id=$this->uri->segment(3);
            $this->account_model->delete_project($id);
            redirect('account/project','refresh');    
        }
        else
        {
            redirect('account/project','refresh');    

        }
       
   } 

   /*=========================Head Level 2==============================*/
   public function level2($p=1)
   {

        $this->user_model->check_permissions("account/level2");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $total = $this->db->query("SELECT count(*) as total FROM `level_2` where is_delete='0'")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $this->db->where('level_2.is_delete','0');
        $this->db->select('main_head.id,main_head.name as mh_name,level_2.name');
        $this->db->from('level_2');
        $this->db->join('main_head','main_head.id=level_2.main_head_id');
        $this->db->limit($per_page,$offset);
        $query = $this->db->get();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['project'] = $query->result_array();
        $data['total'] = ceil($total / $per_page);

        $data['main_head'] = $this->db->query("SELECT id,name FROM `main_head` WHERE is_delete='0'")->result_array();

                // calling view pages
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('account/level2',$data);
        $this->load->view('footer',$data);

   }
   public function save_level2()
   {
    if ($this->input->post())  
      {
        $data=$this->input->post();
        $this->account_model->save_level2($data);
        redirect('account/level2','refresh');    
            
      }
     else
     {
            redirect('account/level2','refresh');    

     } 
   }
   public function delete_level2()
   {
    $id=$this->uri->segment(3);
    $this->account_model->delete_level2($id);
    redirect('account/level2','refresh');    

   }

   /*=========================Head Level 3==============================*/
   public function level3($p=1)
   {

        $this->user_model->check_permissions("account/level3");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $total = $this->db->query("SELECT count(*) as total FROM `level_3` where is_delete='0'")->result_array()[0]['total'];
        $per_page = 10;
        $offset = ($p - 1) * $per_page;
        $this->db->where('level_3.is_delete','0');
        $this->db->select('level_3.id,main_head.name as main,level_2.name as level_2_name,level_3.name as level_3_name');
        $this->db->from('level_2');
        $this->db->join('main_head','main_head.id=level_2.main_head_id');
        $this->db->join('level_3','level_2.id=level_3.level_2_id');
        $this->db->limit($per_page,$offset);
        $query = $this->db->get();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['project'] = $query->result_array();
        $data['total'] = ceil($total / $per_page);

        $data['main_head'] = $this->db->query("SELECT id,name FROM `main_head` WHERE is_delete='0'")->result_array();

                // calling view pages
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('account/level3',$data);
        $this->load->view('footer',$data);

   }
   public function save_level3()
   {
    if ($this->input->post())  
      {
        $data=$this->input->post();
        $this->account_model->save_level3($data);
        redirect('account/level3','refresh');    
            
      }
     else
     {
            redirect('account/level3','refresh');    

     } 
   }
   public function delete_level3()
   {
    $id=$this->uri->segment(3);
    $this->account_model->delete_level2($id);
    redirect('account/level2','refresh');    

   }
   /*=========================General Entry==============================*/
   public function cash_rec()
   {
       
        if($this->uri->segment(3)){
        $id=$this->uri->segment(3);
        $data['proj']=$this->account_model->All_project();
        $data['l2']=$this->account_model->All_level2();
        $data['l3']=$this->account_model->All_level3();
        $data['values']=$this->account_model->search("cash_receipt",$id);
        }else{
            $id=0;
        $data['values']=@$this->account_model->search("cash_receipt",$id);
        }
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
         
        $data['pro']=$this->account_model->All_programe();
        $data['mainhead']=$this->account_model->All_mainhead();
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("account/cash_recipt",$data);
        $this->load->view('footer');

   }
    public function cash_deposit()
   {
       
        if($this->uri->segment(3)){
        $id=$this->uri->segment(3);
        $data['proj']=$this->account_model->All_project();
        $data['l2']=$this->account_model->All_level2();
        $data['l3']=$this->account_model->All_level3();
        $data['values']=$this->account_model->search("cash_deposit",$id);
        }else{
            $id=0;
        $data['values']=@$this->account_model->search("cash_deposit",$id);
        }
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
         $fields = array('b_name','b_code','id','Account_no');
         $data['bank']=$this->account_model->all($fields);
        $data['pro']=$this->account_model->All_programe();
        $data['mainhead']=$this->account_model->All_mainhead();
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("account/cash_deposit",$data);
        $this->load->view('footer');

   }
    public function save_cash_deposit()
   {
      
       if($this->input->post()){
            $data=$this->input->post();
            $this->load->library('upload');
            $url = $this->do_upload();
           $check=$this->account_model->save_cash_deposit($data);
           if($check!=""){
               redirect("account/cash_deposit/".$check,"refresh");
           }else{echo "No save data";}
       }else{redirect("account/cash_deposit","refresh");}
   }
   public function cash_vou()
   {
        if($this->uri->segment(3)){
        $id=$this->uri->segment(3);
        $data['proj']=$this->account_model->All_project();
        $data['l2']=$this->account_model->All_level2();
        $data['l3']=$this->account_model->All_level3();
        $data['values']=$this->account_model->search("cash_voucher",$id);
        }else{
            $id=0;
        $data['values']=@$this->account_model->search("cash_voucher",$id);
        }
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $data['pro']=$this->account_model->All_programe();
        $data['mainhead']=$this->account_model->All_mainhead();
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("account/cash_vou",$data);
        $this->load->view('footer');

   }
   public function save_cash_recipt()
   {
      
       if($this->input->post()){
            $data=$this->input->post();
            
           $check=$this->account_model->save_cash_recipt($data);
           if($check!=""){
               redirect("account/cash_rec/".$check,"refresh");
           }else{echo "No save data";}
       }else{redirect("account/cash_rec","refresh");}
   }
    public function save_cash_voucher()
   {
      
       if($this->input->post()){
            $data=$this->input->post();
            // var_dump($data);
           $check=$this->account_model->save_cash_voucher($data);
           if($check!=""){
               redirect("account/cash_vou/".$check,"refresh");
           }else{echo "No save data";}
       }else{redirect("account/cash_vou","refresh");}
   }
   public function cash_recipt_view($p=1)
   {
       $branch=$this->user_model->getbranch();
        $limit=20;
        $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
        $data=$this->account_model->up();
        $data['offset']=$offset;
        $count = $this->db->query("SELECT count(*) as total FROM `cash_receipt` where branch=$branch")->result_array()[0]['total'];
        $data['recipt']=$this->account_model->All_recipt($limit,$offset);
        $data['pro']=$this->account_model->All_programe();
        $data['mainhead']=$this->account_model->All_mainhead();
        $data['page_links']=$this->account_model->dopaginate($count,$limit,3,"account/cash_recipt_view/");
        $this->account_model->down("account/cash_recipt_view",$data);
      
   }

    public function cash_recipt_print($program='',$project='',$main_head='',$level2='',$level3='')
   {
         $branch=$this->user_model->getbranch();
        $data['b_header'] = $this->db->query("SELECT name,title,tagline,short_address,phone_no,email,logo1,logo2 from branch where id='$branch' AND is_delete='0'")->result_array()[0];
        $count = $this->db->query("SELECT count(*) as total FROM `cash_receipt` where branch=$branch")->result_array()[0]['total'];
        $data['recipt']=$this->account_model->All_recipt_record($program,$project,$main_head,$level2,$level3);
        $this->load->view("account/cash_recipt_print",$data);
   }

   public function cash_vou_view($p=1)
   {
        $branch=$this->user_model->getbranch();
        $limit=20;
        $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
        $data=$this->account_model->up();
        $data['offset']=$offset;
        $count = $this->db->query("SELECT count(*) as total FROM `cash_voucher`  where branch=$branch")->result_array()[0]['total'];
        $data['vou']=$this->account_model->All_vouc($limit,$offset);
        $data['pro']=$this->account_model->All_programe();
        $data['mainhead']=$this->account_model->All_mainhead();
        $data['page_links']=$this->account_model->dopaginate($count,$limit,3,"account/cash_vou_view/");
        $this->account_model->down("account/cash_vou_view",$data);
       
   }
    public function cash_vou_print($program='',$project='',$main_head='',$level2='',$level3='')
   {
         $branch=$this->user_model->getbranch();
        $data['b_header'] = $this->db->query("SELECT name,title,tagline,short_address,phone_no,email,logo1,logo2 from branch where id='$branch' AND is_delete='0'")->result_array()[0];
        $data['recipt']=$this->account_model->All_vou_record($program,$project,$main_head,$level2,$level3);
        $this->load->view("account/cash_vou_print",$data);
   }
   public function datewise_recpt($p=1)
   {
         $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $branch=$this->user_model->getbranch();
        $total = $this->db->query("SELECT count(*) as total FROM `cash_receipt` where branch=$branch ")->result_array()[0]['total'];
        $limit = 10;
        $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
        $data['offset']=$offset;
        $data['recipt']=$this->account_model->All_recipt($limit,$offset);
        $data['page_links']=$this->account_model->dopaginate($total,$limit,3,"account/date_srch_recpt/");
        $this->account_model->down("account/date_srch_recpt",$data);
   }
    public function datewise_vou($p=1)
   {
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        $total = $this->db->query("SELECT count(*) as total FROM `cash_receipt`")->result_array()[0]['total'];
        $limit = 10;
        $offset = ($p - 1) * $limit;
        $data['vou']=$this->account_model->All_vouc($limit,$offset);
       $data['total'] = ceil($total / $limit);
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view("account/date_srch_vou",$data);
        $this->load->view("footer");
   }
//===========================================Bank defination ========================================

            public function definekhata()
            {
            //$this->user_model->check_permissions("Account/definekhata");
                $data=$this->account_model->up();
                $this->account_model->down("account/bankdefine",$data);
            }   
            public function savekhata()
            {
            if($this->input->post()){
            $data=$this->input->post();
            $bool=$this->account_model->savebank($data);
            if($bool==true){

            redirect('account/B_list','refresh');
            }else{
            echo "<h1>Some error ocurred</h1>";
            }

            }
            }
            public function B_list()
            {
            //$this->user_model->check_permissions("account/B_list");
            $limit=10;
            $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
            $data=$this->account_model->up();
            $data['bank']=$this->account_model->bank_list($limit,$offset);
            $data['offset']=$offset;
            $count=$this->account_model->count();
            $data['page_links']=$this->account_model->dopaginate($count,$limit,3,"account/B_list/");
            $this->account_model->down("account/bank_list",$data);
            }
            public function st_change($id=0,$st=0)
            {
            if($st==1){
            $update_fileds=array('is_active' =>1 );
            $this->account_model->Update('bank_def',$update_fileds,"id",$id);
            }else if($st==0){
            $update_fileds=array('is_active' =>0);
            $this->account_model->Update('bank_def',$update_fileds,"id",$id);
            }

            redirect('account/B_list','refresh');
            }
    //==============================Bank Payment=====================================//

    public function B_payment()
    {
        $data=$this->account_model->up();
        if($this->uri->segment(3)){
        $id=$this->uri->segment(3);
        $data['proj']=$this->account_model->All_project();
        $data['l2']=$this->account_model->All_level2();
        $data['l3']=$this->account_model->All_level3();
        $data['values']=$this->account_model->search("bank_payment",$id);
        }else{
            $id=0;
        $data['values']=@$this->account_model->search("bank_payment",$id);
        }
        
        
         $data['pro']=$this->account_model->All_programe();
        $data['mainhead']=$this->account_model->All_mainhead();
         $fields = array('b_name','b_code','id');
         $data['bank']=$this->account_model->all($fields);
        $this->account_model->down("account/bank_payment",$data);
    }
    public function save_cash_payment()
    {
        if($this->input->post()){
           $this->load->library('upload');
            $url = $this->do_upload();
            $data=$this->input->post();
            
           $check=$this->account_model->save_payment($data,$url);
            
           if($check!=""){
               //echo "<h1>save data</h1>";
               redirect("account/Bank_payment_view/".$check,"refresh");
           }else{echo "No save data";}
       }else{redirect("account/B_payment","refresh");}
    }

    private function do_upload()
    {
        $type = explode('.', $_FILES["pic"]["name"]);
        $type = $type[count($type)-1];
        $url = "./images/".uniqid(rand()).'.'.$type;
        if (in_array($type, array("png","jpg","jpeg","gif")))
            if(move_uploaded_file($_FILES["pic"]["tmp_name"], $url))
                return $url;
        return ""; 
    }
    public function Bank_payment_view()
   {
            $limit=10;
            $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
         $data=$this->account_model->up();
        $count = $this->db->query("SELECT count(*) as total FROM `bank_payment`")->result_array()[0]['total'];
        $data['offset']=$offset;
        $fields = array('b_name','b_code','id');
        $data['pay']=$this->account_model->All_payment($limit,$offset);
        $data['pro']=$this->account_model->All_programe();
         $data['bank']=$this->account_model->all($fields);
        $data['mainhead']=$this->account_model->All_mainhead();
       $data['page_links']=$this->account_model->dopaginate($count,$limit,3,"account/Bank_payment_view/");
         $this->account_model->down("account/bank_paymnt_view",$data);
   }

    public function Bank_payment_print($bank='',$program='',$project='',$main_head='',$level2='',$level3='')
   {
         $branch=$this->user_model->getbranch();
        $data['b_header'] = $this->db->query("SELECT name,title,tagline,short_address,phone_no,email,logo1,logo2 from branch where id='$branch' AND is_delete='0'")->result_array()[0];
        $data['pay']=$this->account_model->All_payment_record($bank,$program,$project,$main_head,$level2,$level3);
        $this->load->view("account/bank_paymnt_print",$data);
   }

 //==============================Bank Recipt=====================================//

    public function B_recipt()
    {
         $data=$this->account_model->up();
         if($this->uri->segment(3)){
        $id=$this->uri->segment(3);
        $data['proj']=$this->account_model->All_project();
        $data['l2']=$this->account_model->All_level2();
        $data['l3']=$this->account_model->All_level3();
        $data['values']=$this->account_model->search("bank_recpt",$id);
        }else{
            $id=0;
        $data['values']=@$this->account_model->search("bank_recpt",$id);
        }
         $fields = array('b_name','b_code','id');
         $data['pro']=$this->account_model->All_programe();
        $data['mainhead']=$this->account_model->All_mainhead();
         $data['bank']=$this->account_model->all($fields);
        $this->account_model->down("account/bank_recipt",$data);
    }
    public function save_cash_recpt()
    {
        if($this->input->post()){
            $data=$this->input->post();
            $url = $this->do_upload();
            $this->load->library('upload');
           $check=$this->account_model->save_recpt($data,$url);
           if($check!=""){
               //echo "<h1>save data</h1>";
               redirect("account/B_recipt/".$check,"refresh");
           }else{echo "No save data";}
       }else{redirect("account/B_recipt","refresh");}
    }
     public function Bank_recpt_view()
   {
            $limit=10;
            $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
         $data=$this->account_model->up();
        $count = $this->db->query("SELECT count(*) as total FROM `bank_payment`")->result_array()[0]['total'];
        $data['offset']=$offset;
        $fields = array('b_name','b_code','id');
        $data['pay']=$this->account_model->All_bankrecipt($limit,$offset);
        $data['pro']=$this->account_model->All_programe();
         $data['bank']=$this->account_model->all($fields);
        $data['mainhead']=$this->account_model->All_mainhead();
       $data['page_links']=$this->account_model->dopaginate($count,$limit,3,"account/Bank_recpt_view/");
         $this->account_model->down("account/bank_recpt_view",$data);
   }
    public function Bank_recipt_print($bank='',$program='',$project='',$main_head='',$level2='',$level3='')
   {
         $branch=$this->user_model->getbranch();
        $data['b_header'] = $this->db->query("SELECT name,title,tagline,short_address,phone_no,email,logo1,logo2 from branch where id='$branch' AND is_delete='0'")->result_array()[0];
        $data['recipt']=$this->account_model->All_Bankrecipt_record($bank,$program,$project,$main_head,$level2,$level3);
        $this->load->view("account/bank_recipt_print",$data);
   }
    public function cash_deposit_view()
   {
            $limit=10;
            $offset=$this->uri->segment(3)?$this->uri->segment(3): 0;
         $data=$this->account_model->up();
        $count = $this->db->query("SELECT count(*) as total FROM `cash_deposit`")->result_array()[0]['total'];
        $data['offset']=$offset;
        $fields = array('b_name','b_code','id');
        $data['pay']=$this->account_model->All_cashdeposit($limit,$offset);
        $data['pro']=$this->account_model->All_programe();
         $data['bank']=$this->account_model->all($fields);
        $data['mainhead']=$this->account_model->All_mainhead();
       $data['page_links']=$this->account_model->dopaginate($count,$limit,3,"account/cash_deposit_view/");
         $this->account_model->down("account/cash_depositview",$data);
   }
     public function cash_depositprint($bank='',$program='',$project='',$main_head='',$level2='',$level3='')
   {
         $branch=$this->user_model->getbranch();
        $data['b_header'] = $this->db->query("SELECT name,title,tagline,short_address,phone_no,email,logo1,logo2 from branch where id='$branch' AND is_delete='0'")->result_array()[0];
        $data['recipt']=$this->account_model->All_CashDeposit_record($bank,$program,$project,$main_head,$level2,$level3);
        $this->load->view("account/cash_depositprint",$data);
   }

        public function print_cash()
        {
        $post_data=$this->input->post();
        $data['title']=$post_data['invoice_name'];
       
        $id=$post_data['id'];
         $branch=$this->user_model->getbranch();
         $data['b_header'] = $this->db->query("SELECT `title`,`tagline`,`short_address`,`phone_no`,`email`,`logo1`,`logo2` FROM `branch` WHERE `id`='$branch' AND `is_delete`='0'")->result_array()[0];
         $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `id`='$branch' AND `is_delete`='0'")->result_array()[0];
         if($post_data['invoice_name']=="Cash Payment"){
             $col= array('id' ,'date','to_receipt','amount','level_3_id' );
             $data['val']=$this->account_model->print_invoce("cash_receipt",$id,$col);
         }else if($post_data['invoice_name']=="Cash Receipt"){
             $col= array('id' ,'date','from_voucher','amount','level_3_id' );
             $data['val']=$this->account_model->print_invoce("cash_voucher",$id,$col);
         }
           $this->load->view('account/print_invoice',$data);
         
        }
        public function print_bank()
        {
        $post_data=$this->input->post();
        // var_dump($post_data);die();
        $data['title']=$post_data['invoice_name'];
        $id=$post_data['id'];
         $branch=$this->user_model->getbranch();
         $data['b_header'] = $this->db->query("SELECT `title`,`tagline`,`short_address`,`phone_no`,`email`,`logo1`,`logo2` FROM `branch` WHERE `id`='$branch' AND `is_delete`='0'")->result_array()[0];
         $data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `id`='$branch' AND `is_delete`='0'")->result_array()[0];
          if($post_data['invoice_name']=="Bank Receipt"){
              $col= array('id','level_3_id' ,'date','from_recpt','amount','bank_id','cheque#' );
                $data['val']=$this->account_model->print_invoce("bank_recpt",$id,$col);
         }else if($post_data['invoice_name']=="Bank Payment"){
             $col= array('id','level_3_id' ,'date','to_payment','amount','bank_id','cheque#' );
                $data['val']=$this->account_model->print_invoce("bank_payment",$id,$col);
         }else if($post_data['invoice_name']=="Cash Deposit"){
             $col= array('id','level_3_id' ,'date','submit_by','amount','bank_id','slip_no' );
                $data['val']=$this->account_model->print_invoce("cash_deposit",$id,$col);
         }
           $this->load->view('account/print_invoice_2',$data);
         
        }
        public function journal(){
             $data=$this->account_model->up();
             $this->account_model->down("account/journal",$data); 
        }
         public function searchdate(){
       
       if($this->input->post()){
        $data1=$this->input->post();
        $data=$this->account_model->up();
           $data['rec']=$this->account_model->Search_datewise_cashpay($data1);
           $this->account_model->down("account/date_wise_view",$data);
       }
}

}
