<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  Account
 * @author      Atif Alvi
 * @link        http://facebook.com/prince.atif5
 */

class Account_model extends MY_Model {
   
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('user_model');
        $this->load->library("hajanasms");
        
    }
    
            //saving data into sql
	public function save_program($data)
	{
                $branch=$this->user_model->getbranch();
 
            $fields = array(

                            'name'=>$data['name'] ,
                            'branch'=>$branch
                );
              
             return $this->db->insert('program',$fields);
                 
	}


   public function delete_program($id)
   {
                    
                       $fields_class=array('is_delete'=>'1');
                       $this->db->where('id',$id);
                return $this->db->update('program',$fields_class);
   }
    
    public function save_project($data)
    {
            $fields = array(
                             'p_name' => $data['name'], 
                             'program_id' =>$data['program'] , 
                           );
            return $this->db->insert('project',$fields);
    }
    public function delete_project($id)
   {
                    
                       $fields=array('is_delete'=>'1');
                       $this->db->where('id',$id);
                return $this->db->update('project',$fields);
   }

    public function save_level2($data)
    {
            $fields = array(
                             'name' => $data['name'], 
                             'main_head_id' =>$data['main_head'] , 
                           );
            return $this->db->insert('level_2',$fields);
    }
    public function delete_level2($id)
    {

                       $fields=array('is_delete'=>'1');
                       $this->db->where('id',$id);
                return $this->db->update('level_2',$fields);

    }
    public function save_level3($data)
    {
     
            $fields = array(
                             'name' => $data['name'], 
                             'level_2_id' =>$data['level2'] , 
                           );
            return $this->db->insert('level_3',$fields); 
    }
    public function All_programe()
    {
            $branch=$this->user_model->getbranch();
        
            return $this->db->query("SELECT id,name FROM `program` WHERE is_delete='0' and branch=$branch")->result_array();
    }
    public function All_project()
    {
            return $this->db->query("SELECT id,p_name FROM `project` WHERE is_delete='0'")->result_array();
    }
     public function All_level2()
    {
            return $this->db->query("SELECT id,name FROM `level_2` WHERE is_delete='0'")->result_array();
    }
     public function All_level3()
    {
            return $this->db->query("SELECT id,name FROM `level_3` WHERE is_delete='0'")->result_array();
    }
    public function All_mainhead()
    {
            return $this->db->query("SELECT id,name FROM `main_head` WHERE is_delete='0'")->result_array();
    }
    public function save_cash_recipt($data)
    {
           $date= date('Y-m-d H:i:s');
           $branch=$this->user_model->getbranch();
           $id=$this->user_model->userInfo('id')['id'];
        $fields = array('project_id' =>$data['project'] ,
                         'main_head_id'=>$data['main_head'] ,
                         'level_2_id'=>$data['level2'] ,
                         'level_3_id'=>$data['level3'],
                         'branch'=>$branch,
                         'to_receipt'=>$data['to'],
                         'amount'=>$data['amount'],
                         'description'=>$data['description'],
                         'date'=>$data['date'],
                         'created_by'=>$id ,'created_date'=>$date);
       $this->db->insert('cash_receipt',$fields);
       $aid=$this->db->insert_id();
       return $aid;
    }
    
   public function save_cash_deposit($data,$url="NULL")
    {
           $date= date('Y-m-d H:i:s');
           $branch=$this->user_model->getbranch();
           $id=$this->user_model->userInfo('id')['id'];
        $fields = array('project_id' =>$data['project'] ,
                         'main_head_id'=>$data['main_head'] ,
                         'level_2_id'=>$data['level2'] ,
                         'level_3_id'=>$data['level3'],
                         'submit_by'=>$data['submit_by'],
                         'bank_id'=>$data['bank'],
                         'slip_no'=>$data['slip_no'],
                         'slip_pic'=>$url,
                         'branch'=>$branch,
                         'amount'=>$data['amount'],
                         'description'=>$data['description'],
                         'date'=>$data['date'],
                         'created_by'=>$id ,'created_date'=>$date);
        $balance=$this->db->select('o_balance')->where('id',$data['bank'])->get('bank_def')->result_array()[0]['o_balance'];
       $newbalance=$balance+$data['amount'];
       $fieldsbank=array('o_balance'=>$newbalance);
       $this->db->where('id',$data['bank']);
 	$this->db->update('bank_def',$fieldsbank);
       $this->db->insert('cash_deposit',$fields);
       $aid=$this->db->insert_id();
      $history=array('Slip_name'=>"Cash deposit",
      		'befor_add_amount'=>$balance,
      		'new_amount_add/sub'=>$data['amount'],
      		'newbalnce'=>$newbalance,
      		'bank_id'=>$data['bank']);
      $this->db->insert('balance_history',$history);	
	  $this->send_cash_deposit_sms($data['bank'],$data['slip_no'],$data['amount'],$data['date']);
       return $aid;
    }
    public function save_cash_voucher($data)
    {
           $date= date('Y-m-d H:i:s');
           $branch=$this->user_model->getbranch();
           $id=$this->user_model->userInfo('id')['id'];
        $fields = array('project_id' =>$data['project'] ,
                         'main_head_id'=>$data['main_head'] ,
                         'level_2_id'=>$data['level2'] ,
                         'level_3_id'=>$data['level3'],
                         'from_voucher'=>$data['from'],
                         'amount'=>$data['amount'],
                         'branch'=>$branch,
                         'description'=>$data['description'],
                         'date'=>$data['date'],
                         'created_by'=>$id ,'created_date'=>$date);
       $this->db->insert('cash_voucher',$fields);
       $aid=$this->db->insert_id();
       return $aid;
    }
    public function All_recipt($limit,$offset)
    {
            $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_receipt.amount,cash_receipt.date,cash_receipt.to_receipt,cash_receipt.id,cash_receipt.description"); 
        $this->db->from('cash_receipt');
        $this->db->join('project', 'project.id=cash_receipt.project_id');
        $this->db->join('main_head', 'main_head.id=cash_receipt.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_receipt.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_receipt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_receipt.is_delete',0)->where('cash_receipt.branch',$branch);
        $query = $this->db->limit($limit,$offset)->get()->result_array(); 
        return $query;     
    }
    public function All_recipt_record($program='',$project='',$main_head='',$level2='',$level3='')
    {
        //var_dump($program);die();
        $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_receipt.amount,cash_receipt.date,cash_receipt.to_receipt,cash_receipt.id,cash_receipt.description"); 
        $this->db->from('cash_receipt');
        $this->db->join('project', 'project.id=cash_receipt.project_id');
        $this->db->join('main_head', 'main_head.id=cash_receipt.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_receipt.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_receipt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_receipt.is_delete',0)->where('cash_receipt.branch',$branch);
        if($program=='') {

        }
        else if($program!='' && $project!='' && $main_head!='' && $level2!='' && $level3!='')
        {
         $this->db->where('project.program_id',$program)->where('cash_receipt.project_id',$project)->where('cash_receipt.main_head_id',$main_head)->where('cash_receipt.level_2_id',$level2)->where('cash_receipt.level_3_id',$level3);
        }
        else if($program!='' && $project!='' && $main_head!='' && $level2!='')
        {
         $this->db->where('project.program_id',$program)->where('cash_receipt.project_id',$project)->where('cash_receipt.main_head_id',$main_head)->where('cash_receipt.level_2_id',$level2);
        }
        else if($program!='' && $project!='' && $main_head!='' )
        {
         $this->db->where('project.program_id',$program)->where('cash_receipt.project_id',$project)->where('cash_receipt.main_head_id',$main_head);
        }
        else if($program!='' && $project!='')
        {
         $this->db->where('project.program_id',$program)->where('cash_receipt.project_id',$project);
        }
        elseif($program!='')
        {
         $this->db->where('project.program_id',$program);
        }
        $query = $this->db->get()->result_array(); 
        return $query;     
    }
    public function All_vouc($limit,$offset)
    {
            $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_voucher.amount,cash_voucher.date,cash_voucher.from_voucher,cash_voucher.id,cash_voucher.description"); 
        $this->db->from('cash_voucher');
        $this->db->join('project', 'project.id=cash_voucher.project_id');
        $this->db->join('main_head', 'main_head.id=cash_voucher.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_voucher.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_voucher.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_voucher.is_delete',0)->where('cash_voucher.branch',$branch);
        $query = $this->db->limit($limit,$offset)->get()->result_array(); 
        return $query;
    }
    public function All_vou_record($program='',$project='',$main_head='',$level2='',$level3='')
    {
        //var_dump($program);die();
        $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_voucher.amount,cash_voucher.date,cash_voucher.from_voucher,cash_voucher.id,cash_voucher.description"); 
        $this->db->from('cash_voucher');
        $this->db->join('project', 'project.id=cash_voucher.project_id');
        $this->db->join('main_head', 'main_head.id=cash_voucher.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_voucher.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_voucher.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_voucher.is_delete',0)->where('cash_voucher.branch',$branch);
        if($program=='') {

        }
        else if($program!='' && $project!='' && $main_head!='' && $level2!='' && $level3!='')
        {
         $this->db->where('project.program_id',$program)->where('cash_voucher.project_id',$project)->where('cash_voucher.main_head_id',$main_head)->where('cash_voucher.level_2_id',$level2)->where('cash_voucher.level_3_id',$level3);
        }
        else if($program!='' && $project!='' && $main_head!='' && $level2!='')
        {
         $this->db->where('project.program_id',$program)->where('cash_voucher.project_id',$project)->where('cash_voucher.main_head_id',$main_head)->where('cash_voucher.level_2_id',$level2);
        }
        else if($program!='' && $project!='' && $main_head!='' )
        {
         $this->db->where('project.program_id',$program)->where('cash_voucher.project_id',$project)->where('cash_voucher.main_head_id',$main_head);
        }
        else if($program!='' && $project!='')
        {
         $this->db->where('project.program_id',$program)->where('cash_voucher.project_id',$project);
        }
        elseif($program!='')
        {
         $this->db->where('project.program_id',$program);
        }
        $query = $this->db->get()->result_array(); 
        return $query;     
    }
    //=============================Bank Defination================================//
    
    public function savebank($data)
    {
           $id =$this->user_model->userinfo('id')['id'];
           $branch=$this->user_model->getbranch();
           $date=date('Y-m-d');
           $bank_field = array('b_name' =>$data['bnk_name'] ,
                           'b_code'=>$data['b_code'] ,
                           'Account_no'=>$data['a_num'],
                           'title'=>$data['title'] ,
                           'purpose'=>$data['purpose'] ,
                           'o_balance'=>$data['o_balnce'],
                           'user_id'=>$id,
                           'branch'=>$branch,
                           'creat_date'=>$date
                                );
        $bool=$this->create('bank_def',$bank_field);
        return $bool;
 
    }
    public function count()
    {
            $branch=$this->user_model->getbranch();
            $count=$this->db->select('*')->from('bank_def')->where('branch',$branch)->get()->result_array();
            $count=count($count);
            return $count;
    }
    public function bank_list($limit=0,$offset=0)
    {
           $branch=$this->user_model->getbranch();
           $this->db->select('*');
           $this->db->from('bank_def')->where('branch',$branch);
           return $this->db->limit($limit,$offset)->get()->result_array();
    }
    public function all($value=array())
    {    $branch=$this->user_model->getbranch();
        if($value==null){
         $this->db->select('*');
           $this->db->from('bank_def')->where('branch',$branch);
           return $this->db->get()->result_array();
            }else{
                    $this->db->select($value);
           $this->db->from('bank_def')->where('branch',$branch)->where('is_active',1);
           return $this->db->get()->result_array();
            }
    }
    //==============================Bank Payment=====================================//
    public function save_payment($data,$url=null)
    {
            $branch=$this->user_model->getbranch();
             $date= date('Y-m-d H:i:s');
           $id=$this->user_model->userInfo('id')['id'];
        $fields = array('project_id' =>$data['project'] ,
                         'main_head_id'=>$data['main_head'] ,
                         'level_2_id'=>$data['level2'] ,
                         'level_3_id'=>$data['level3'],
                         'bank_id'=>$data['bank'],
                         'cheque#'=>$data['cheque'],
                         'cheque_pic'=>$url,
                         'branch'=>$branch,
                         'to_payment'=>$data['to'],
                         'amount'=>$data['amount'],
                         'description'=>$data['description'],
                         'date'=>$data['date'],
                         'created_by'=>$id ,'created_date'=>$date);
       $this->db->insert('bank_payment',$fields);
      $aid=$this->db->insert_id();
       return $aid;
    }
    public function All_payment($limit=0,$offset=0)
    {
         $branch=$this->user_model->getbranch();   
        $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_payment.amount,bank_payment.date,bank_payment.to_payment,bank_payment.id,bank_payment.description"); 
        $this->db->from('bank_payment');
        $this->db->join('project', 'project.id=bank_payment.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_payment.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_payment.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_payment.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_payment.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_payment.is_delete',0)->where('bank_payment.branch',$branch);
        $query = $this->db->limit($limit,$offset)->get()->result_array();
        return $query;     
    }
    public function All_payment_record($bank='',$program='',$project='',$main_head='',$level2='',$level3='')
    {
        //var_dump($program);die();
        $branch=$this->user_model->getbranch();
        $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_payment.amount,bank_payment.date,bank_payment.to_payment,bank_payment.id"); 
        $this->db->from('bank_payment');
        $this->db->join('project', 'project.id=bank_payment.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_payment.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_payment.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_payment.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_payment.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_payment.is_delete',0)->where('bank_payment.branch',$branch);
        if($program=='' OR $bank=='') {

        }
        else if($bank!='' && $program!='' && $project!='' && $main_head!='' && $level2!='' && $level3!='')
        {
         $this->db->where('bank_payment.bank_id',$bank)->where('project.program_id',$program)->where('bank_payment.project_id',$project)->where('bank_payment.main_head_id',$main_head)->where('bank_payment.level_2_id',$level2)->where('bank_payment.level_3_id',$level3);
        }
        else if($bank!='' && $program!='' && $project!='' && $main_head!='' && $level2!='')
        {
         $this->db->where('bank_payment.bank_id',$bank)->where('project.program_id',$program)->where('bank_payment.project_id',$project)->where('bank_payment.main_head_id',$main_head)->where('bank_payment.level_2_id',$level2);
        }
        else if($bank!='' && $program!='' && $project!='' && $main_head!='' )
        {
         $this->db->where('bank_payment.bank_id',$bank)->where('project.program_id',$program)->where('bank_payment.project_id',$project)->where('bank_payment.main_head_id',$main_head);
        }
        else if($bank!='' && $program!='' && $project!='')
        {
         $this->db->where('bank_payment.bank_id',$bank)->where('project.program_id',$program)->where('bank_payment.project_id',$project);
        }
        elseif($bank!='' && $program!='')
        {
         $this->db->where('bank_payment.bank_id',$bank)->where('project.program_id',$program);
        }else if($bank!='')
        {
         $this->db->where('bank_payment.bank_id',$bank);
        }
        $query = $this->db->get()->result_array(); 
        return $query;     
    }
    //==============================Bank Recipt=====================================//
    public function save_recpt($data,$url=null)
    {
             $branch=$this->user_model->getbranch();
             $date= date('Y-m-d H:i:s');
           $id=$this->user_model->userInfo('id')['id'];
        $fields = array('project_id' =>$data['project'] ,
                         'main_head_id'=>$data['main_head'] ,
                         'level_2_id'=>$data['level2'] ,
                         'level_3_id'=>$data['level3'],
                         'bank_id'=>$data['bank'],
                         'cheque#'=>$data['cheque'],
                         'cheque_pic'=>$url,
                         'branch'=>$branch,
                         'from_recpt'=>$data['from'],
                         'amount'=>$data['amount'],
                         'description'=>$data['description'],
                         'date'=>$data['date'],
                         'created_by'=>$id ,'created_date'=>$date);
       $this->db->insert('bank_recpt',$fields);
      $aid=$this->db->insert_id();
	  	$this->send_bank_receipt_sms($data['bank'],$data['cheque'],$data['amount'],$data['date']);
       return $aid;
    }
    public function All_bankrecipt($limit=0,$offset=0)
    {
            $branch=$this->user_model->getbranch();
        $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_recpt.amount,bank_recpt.date,bank_recpt.from_recpt,bank_recpt.id,bank_recpt.description"); 
        $this->db->from('bank_recpt');
        $this->db->join('project', 'project.id=bank_recpt.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_recpt.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_recpt.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_recpt.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_recpt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_recpt.is_delete',0)->where('bank_recpt.branch',$branch);
        $query = $this->db->limit($limit,$offset)->get()->result_array();
        return $query;     
    }
    public function All_Bankrecipt_record($bank='',$program='',$project='',$main_head='',$level2='',$level3='')
    {
        //var_dump($program);die();
        $branch=$this->user_model->getbranch();
        $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_recpt.amount,bank_recpt.date,bank_recpt.from_recpt,bank_recpt.id"); 
        $this->db->from('bank_recpt');
        $this->db->join('project', 'project.id=bank_recpt.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_recpt.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_recpt.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_recpt.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_recpt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_recpt.is_delete',0)->where('bank_recpt.branch',$branch);
        if($program=='' OR $bank!='') {

        }
        else if($bank!='' && $program!='' && $project!='' && $main_head!='' && $level2!='' && $level3!='')
        {
         $this->db->where('bank_recpt.bank_id',$bank)->where('project.program_id',$program)->where('bank_recpt.project_id',$project)->where('bank_recpt.main_head_id',$main_head)->where('bank_recpt.level_2_id',$level2)->where('bank_recpt.level_3_id',$level3);
        }
        else if($bank!='' && $program!='' && $project!='' && $main_head!='' && $level2!='')
        {
         $this->db->where('bank_recpt.bank_id',$bank)->where('project.program_id',$program)->where('bank_recpt.project_id',$project)->where('bank_recpt.main_head_id',$main_head)->where('bank_recpt.level_2_id',$level2);
        }
        else if($bank!='' && $program!='' && $project!='' && $main_head!='' )
        {
         $this->db->where('bank_recpt.bank_id',$bank)->where('project.program_id',$program)->where('bank_recpt.project_id',$project)->where('bank_recpt.main_head_id',$main_head);
        }
        else if($bank!='' && $program!='' && $project!='')
        {
         $this->db->where('bank_recpt.bank_id',$bank)->where('project.program_id',$program)->where('bank_recpt.project_id',$project);
        }
        elseif($bank!='' && $program!='')
        {
         $this->db->where('bank_recpt.bank_id',$bank)->where('project.program_id',$program);
        }else if($bank!='')
        {
         $this->db->where('bank_recpt.bank_id',$bank);
        }
        $query = $this->db->get()->result_array(); 
        return $query;     
    }
    public function All_cashdeposit($limit=0,$offset=0){
        
        $branch=$this->user_model->getbranch();
        $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_deposit.amount,cash_deposit.date,cash_deposit.submit_by,cash_deposit.id,cash_deposit.description"); 
        $this->db->from('cash_deposit');
        $this->db->join('project', 'project.id=cash_deposit.project_id');
        $this->db->join('bank_def', 'bank_def.id=cash_deposit.bank_id');
        $this->db->join('main_head', 'main_head.id=cash_deposit.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_deposit.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_deposit.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_deposit.is_delete',0)->where('cash_deposit.branch',$branch);
        $query = $this->db->limit($limit,$offset)->get()->result_array();
        return $query;  
    }
    public function All_CashDeposit_record($bank='',$program='',$project='',$main_head='',$level2='',$level3='')
    {
        //var_dump($program);die();
        $branch=$this->user_model->getbranch();
        $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_deposit.amount,cash_deposit.date,cash_deposit.submit_by,cash_deposit.id,cash_deposit.description"); 
        $this->db->from('cash_deposit');
        $this->db->join('project', 'project.id=cash_deposit.project_id');
        $this->db->join('bank_def', 'bank_def.id=cash_deposit.bank_id');
        $this->db->join('main_head', 'main_head.id=cash_deposit.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_deposit.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_deposit.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_deposit.is_delete',0)->where('cash_deposit.branch',$branch);
        if($program=='' OR $bank=='') {

        }
        else if($bank!='' && $program!='' && $project!='' && $main_head!='' && $level2!='' && $level3!='')
        {
         $this->db->where('cash_deposit.bank_id',$bank)->where('project.program_id',$program)->where('cash_deposit.project_id',$project)->where('cash_deposit.main_head_id',$main_head)->where('cash_deposit.level_2_id',$level2)->where('cash_deposit.level_3_id',$level3);
        }
        else if($bank!='' && $program!='' && $project!='' && $main_head!='' && $level2!='')
        {
         $this->db->where('cash_deposit.bank_id',$bank)->where('project.program_id',$program)->where('cash_deposit.project_id',$project)->where('cash_deposit.main_head_id',$main_head)->where('cash_deposit.level_2_id',$level2);
        }
        else if($bank!='' && $program!='' && $project!='' && $main_head!='' )
        {
         $this->db->where('cash_deposit.bank_id',$bank)->where('project.program_id',$program)->where('cash_deposit.project_id',$project)->where('cash_deposit.main_head_id',$main_head);
        }
        else if($bank!='' && $program!='' && $project!='')
        {
         $this->db->where('cash_deposit.bank_id',$bank)->where('project.program_id',$program)->where('cash_deposit.project_id',$project);
        }
        elseif($bank!='' && $program!='')
        {
         $this->db->where('cash_deposit.bank_id',$bank)->where('project.program_id',$program);
        }else if($bank!='')
        {
         $this->db->where('cash_deposit.bank_id',$bank);
        }
        $query = $this->db->get()->result_array(); 
        return $query;     
    }


    public function search($t="",$id)
    {
       return  $this->db->from($t)->where('id',$id)->where('is_delete',0)->get()->result_array()[0];
    }
    public function print_invoce($t="",$id,$col=array())
    {
        return $this->db->select($col)->from($t)->where('id',$id)->get()->result_array()[0];
    }
    public function Search_datewise_cashpay($data){
           
            $branch=$this->user_model->getbranch();
            
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_receipt.amount,cash_receipt.date,cash_receipt.to_receipt,cash_receipt.id"); 
        $this->db->from('cash_receipt');
        $this->db->join('project', 'project.id=cash_receipt.project_id');
        $this->db->join('main_head', 'main_head.id=cash_receipt.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_receipt.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_receipt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_receipt.is_delete',0)->where('cash_receipt.branch',$branch)->where('cash_receipt.date >=', $data['date1'])->where('cash_receipt.date <=',$data['date2']);;
        $query = $this->db->get()->result_array();
         return $query;
    }

    //==============================SMS=====================================//

    // bank name
	// account #
	// slip #
	// amount
	// date

        public function send_cash_deposit_sms($bank_id=0,$slips_no=0,$amount=0,$date=0)
    {
        if($bank_id!=0 AND $slips_no!=0 AND $amount!=0 AND $date!=0)
		{
			$branch=$this->user_model->getbranch();
            $branch_name = $this->db->select("name")->from("branch")->where("id",$branch)->get()->row()->name;
			$bank = $this->db->select("b_name,Account_no")->from("bank_def")->where("is_active","1")->where("id",$bank_id)->get()->row();
			$numbers = ["+923363268658","+923337241654"];
			//$msg = "SLM High School daharki has deposited:\nAmount: $amount in bank ".$bank->b_name."\nAcc #: ".$bank->Account_no." and slip # is $slips_no\nDate: $date";
			$msg = "SLMHS DHK ".$branch_name." has deposited amount: ".$amount." in bank ".$bank->b_name."\nThank You\nPrincipal\nSLMHS DHK\n".$branch_name;
            $this->hajanasms->sendManyNumber($numbers,$msg);
		}
    }

    public function send_bank_receipt_sms($bank_id=0,$cheque_no=0,$amount=0,$date=0)
    {
        if($bank_id!=0 AND $cheque_no!=0 AND $amount!=0 AND $date!=0)
		{
			$branch=$this->user_model->getbranch();
			$bank = $this->db->select("b_name")->from("bank_def")->where("is_active","1")->where("id",$bank_id)->get()->row();
			$api = $this->db->select("code")->from("api")->where("is_delete","0")->where("branch_id",$branch)->get()->row()->code;
			$numbers = ["+923363268658","+923337241654"];
			$msg = "SLM High School daharki has recieved:\nAmount: $amount in bank ".$bank->b_name."\nCheque # is $cheque_no\nDate: $date";
			$options = [];
			$result = $this->smsgateway->sendMessageToManyNumbers($numbers, $msg, $api, $options);
		}
    }

}

