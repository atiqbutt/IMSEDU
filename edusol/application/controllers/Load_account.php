<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Load_account extends CI_Controller {

	private $userInfo = array();

    public function __construct()
    {
        parent::__construct();
		$this->load->model("user_model");
        $this->load->model("Teacher_model");

		//$this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }
        public function proagainstproject($v=0)
        {
        if(!empty($v))
        {
            $result = $this->db->query("SELECT id,p_name FROM `project` where program_id='$v' and is_delete='0'")->result_array();
            foreach ($result as $key => $value) {
                echo "<option value='".$value['id']."'>".$value['p_name']."</option>";
            }
        }
        else
            echo "";

        }

    
    public function level2_db($v="")
    {
            if(!empty($v))
            {
                $result = $this->db->query("SELECT `id`,`name` FROM `level_2` WHERE `main_head_id`='$v'  AND is_delete='0'")->result_array();
                foreach ($result as $key => $value) {
                    echo "<option value='".$value['id']."'>".$value['name']."</option>";
                }
            }
            else
                echo "";
     
    }
    public function level3_db($v=0)
    {
            if(!empty($v))
            {
                $result = $this->db->query("SELECT level_3.id,level_3.name FROM `level_3`inner join level_2 on level_2.id=level_3.level_2_id WHERE level_3.level_2_id='$v' and level_3.is_delete='0'")->result_array();
                foreach ($result as $key => $value) {
                    echo "<option value='".$value['id']."'>".$value['name']."</option>";
                }
            }
            else
                echo "";
     
    }
     public function level2_view($id=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT level_3.id,main_head.name as main,level_2.name as level_2_name,level_3.name as level_3_name FROM `level_2` inner JOIN `main_head` ON main_head.id=level_2.main_head_id inner join `level_3` on level_2.id=level_3.level_2_id WHERE level_2.id='$id' AND level_2.is_delete='0'")->result_array();
                 $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['level_3_name']." </td>";
             $return .= "<td>".$value['level_2_name']." </td>";
             $return .= "<td>".$value['main']."</td>";
             $return .= "<td>
             <a href='".base_url()."account/delete_level3/".$value['id']."'><i class='fa fa-trash'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
    public function main_head_view($id=0)
    {
            if(!empty($id))
             {
                 $result = $this->db->query("SELECT main_head.id,main_head.name as mh_name,level_2.name as name FROM `level_2` inner JOIN `main_head` ON main_head.id=level_2.main_head_id  WHERE main_head.id='$id' AND level_2.is_delete='0'")->result_array();
                 $return="";
                 $i=1;
                 foreach ($result as $key => $value) {

                         $return .= "<tr>";
             $return .= "<td>".$i++."</td>";
             $return .= "<td>".$value['name']." </td>";
             $return .= "<td>".$value['mh_name']." </td>";
             $return .= "<td>
             <a href='".base_url()."account/delete_level3/".$value['id']."'><i class='fa fa-trash'></i></a></td>";
             $return .= "</tr>";
        
                 }
                 echo $return;
            }
            else
                echo "";
        
    }
    //_+++++++++++++++++++++++++++++++++++Cash recipt+++++++++++++++++++++++++++++++++
    public function programe_against($v=0)
    {
        $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_receipt.amount,cash_receipt.date,cash_receipt.to_receipt,cash_receipt.id,cash_receipt.description"); 
        $this->db->from('cash_receipt');
        $this->db->join('project', 'project.id=cash_receipt.project_id');
        $this->db->join('main_head', 'main_head.id=cash_receipt.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_receipt.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_receipt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_receipt.is_delete',0)->where('cash_receipt.branch',$branch)->where('project.program_id',$v);
        $query = $this->db->get()->result_array();
        $return="";
        $i=1;
        foreach ($query as $key => $value) 
        {
            $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['programename']."</td>";
            $return .= "<td>".$value['p_name']."</td>";
            $return .= "<td>".$value['headname']."</td>";
            $return .= "<td>".$value['level2name']."</td>";
            $return .= "<td>".$value['level3name']."</td>";
            
            $return .= "<td>".$value['to_receipt']."</td>";
            $return .= "<td>".$value['description']."</td>";
$return .= "<td>".$value['amount']."</td>";
            $return .= "<td>".$value['date']."</td>";
            $return .= "</tr>"; 
        }
        echo $return;
    }
    public function project_against($v=0)
    {
         $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_receipt.amount,cash_receipt.date,cash_receipt.to_receipt,cash_receipt.id,cash_receipt.description"); 
        $this->db->from('cash_receipt');
        $this->db->join('project', 'project.id=cash_receipt.project_id');
        $this->db->join('main_head', 'main_head.id=cash_receipt.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_receipt.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_receipt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_receipt.is_delete',0)->where('cash_receipt.branch',$branch)->where('project.id',$v);
        $query = $this->db->get()->result_array();
        $return="";
        $i=1;
        foreach ($query as $key => $value) 
        {
            $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['programename']."</td>";
            $return .= "<td>".$value['p_name']."</td>";
            $return .= "<td>".$value['headname']."</td>";
            $return .= "<td>".$value['level2name']."</td>";
            $return .= "<td>".$value['level3name']."</td>";
           
            $return .= "<td>".$value['to_receipt']."</td>";
            $return .= "<td>".$value['to_receipt']."</td>";
 $return .= "<td>".$value['amount']."</td>";
            $return .= "<td>".$value['date']."</td>";
            $return .= "</tr>"; 
        }
        echo $return;
    }
    public function main_head_against($v=0,$p=0)
    {
        $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_receipt.amount,cash_receipt.date,cash_receipt.to_receipt,cash_receipt.id,cash_receipt.description"); 
        $this->db->from('cash_receipt');
        $this->db->join('project', 'project.id=cash_receipt.project_id');
        $this->db->join('main_head', 'main_head.id=cash_receipt.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_receipt.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_receipt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_receipt.is_delete',0)->where('cash_receipt.branch',$branch)->where('main_head.id',$v)->where('project.program_id',$p);
        $query = $this->db->get()->result_array();
        $return="";
        $i=1;
        foreach ($query as $key => $value) 
        {
            $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['programename']."</td>";
            $return .= "<td>".$value['p_name']."</td>";
            $return .= "<td>".$value['headname']."</td>";
            $return .= "<td>".$value['level2name']."</td>";
            $return .= "<td>".$value['level3name']."</td>";
           
            $return .= "<td>".$value['to_receipt']."</td>";
            $return .= "<td>".$value['description']."</td>";
 $return .= "<td>".$value['amount']."</td>";
            $return .= "<td>".$value['date']."</td>";
            $return .= "</tr>"; 
        }
        echo $return;
    }
    public function level2_against($m=0,$v=0,$p=0)
    {
        $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_receipt.amount,cash_receipt.date,cash_receipt.to_receipt,cash_receipt.id,cash_receipt.description"); 
        $this->db->from('cash_receipt');
        $this->db->join('project', 'project.id=cash_receipt.project_id');
        $this->db->join('main_head', 'main_head.id=cash_receipt.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_receipt.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_receipt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_receipt.is_delete',0)->where('cash_receipt.branch',$branch)->where('level_2.id',$v)->where('project.id',$p)->where('main_head.id',$m);
        $query = $this->db->get()->result_array();
        $return="";
        $i=1;
        foreach ($query as $key => $value) 
        {
            $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['programename']."</td>";
            $return .= "<td>".$value['p_name']."</td>";
            $return .= "<td>".$value['headname']."</td>";
            $return .= "<td>".$value['level2name']."</td>";
            $return .= "<td>".$value['level3name']."</td>";
            
            $return .= "<td>".$value['to_receipt']."</td>";
           $return .= "<td>".$value['description']."</td>";
$return .= "<td>".$value['amount']."</td>";
            $return .= "<td>".$value['date']."</td>";
            $return .= "</tr>"; 
        }
        echo $return;
    }
    public function level3_against($m=0,$v=0,$p=0,$l2=0)
    {
        $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_receipt.amount,cash_receipt.date,cash_receipt.to_receipt,cash_receipt.id,cash_receipt.description"); 
        $this->db->from('cash_receipt');
        $this->db->join('project', 'project.id=cash_receipt.project_id');
        $this->db->join('main_head', 'main_head.id=cash_receipt.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_receipt.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_receipt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_receipt.is_delete',0)->where('cash_receipt.branch',$branch)->where('level_2.id',$l2)->where('level_3.id',$v)->where('project.id',$p)->where('main_head.id',$m);
        $query = $this->db->get()->result_array();
        $return="";
        $i=1;
        foreach ($query as $key => $value) 
        {
            $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['programename']."</td>";
            $return .= "<td>".$value['p_name']."</td>";
            $return .= "<td>".$value['headname']."</td>";
            $return .= "<td>".$value['level2name']."</td>";
            $return .= "<td>".$value['level3name']."</td>";
           
            $return .= "<td>".$value['to_receipt']."</td>";
             $return .= "<td>".$value['description']."</td>";
 $return .= "<td>".$value['amount']."</td>";
            $return .= "<td>".$value['date']."</td>";
            $return .= "</tr>"; 
        }
        echo $return;
    }
    public function datewise_recipt($d1='0000-00-00',$d2='0000-00-00')
    {
        $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_receipt.amount,cash_receipt.date,cash_receipt.to_receipt,cash_receipt.id"); 
        $this->db->from('cash_receipt');
        $this->db->join('project', 'project.id=cash_receipt.project_id');
        $this->db->join('main_head', 'main_head.id=cash_receipt.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_receipt.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_receipt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_receipt.is_delete',0)->where('cash_receipt.branch',$branch)->where('cash_receipt.date >=', $d1)->where('cash_receipt.date <=',$d2);;
        $query = $this->db->get()->result_array();
        $return="";
        $i=1;
        foreach ($query as $key => $value) 
        {
            $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['programename']."</td>";
            $return .= "<td>".$value['p_name']."</td>";
            $return .= "<td>".$value['headname']."</td>";
            $return .= "<td>".$value['level2name']."</td>";
            $return .= "<td>".$value['level3name']."</td>";
            
            $return .= "<td>".$value['to_receipt']."</td>";
          $return .= "<td>".$value['description']."</td>";
$return .= "<td>".$value['amount']."</td>";
            $return .= "<td>".$value['date']."</td>";
            $return .= "</tr>"; 
        }
        echo $return;
    }
    //+++++++++++++++++++++++++++++++++++++++++++++++Cash Voucher ++++++++++++++++++++++++++++++++++++++++++
    public function programe_against_vou($v=0)
    {
        $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_voucher.amount,cash_voucher.date,cash_voucher.from_voucher,cash_voucher.id,cash_voucher.description"); 
        $this->db->from('cash_voucher');
        $this->db->join('project', 'project.id=cash_voucher.project_id');
        $this->db->join('main_head', 'main_head.id=cash_voucher.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_voucher.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_voucher.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_voucher.is_delete',0)->where('cash_voucher.branch',$branch)->where('project.program_id',$v);
        $query = $this->db->get()->result_array();
        $return="";
        $i=1;
        foreach ($query as $key => $value) 
        {
            $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['programename']."</td>";
            $return .= "<td>".$value['p_name']."</td>";
            $return .= "<td>".$value['headname']."</td>";
            $return .= "<td>".$value['level2name']."</td>";
            $return .= "<td>".$value['level3name']."</td>";
            $return .= "<td>".$value['from_voucher']."</td>"; 
            $return .= "<td>".$value['description']."</td>";
            $return .= "<td>".$value['amount']."</td>";
            $return .= "<td>".$value['date']."</td>";
            $return .= "</tr>"; 
        }
        echo $return;
    }
    public function project_against_vou($v=0)
    {
        $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_voucher.amount,cash_voucher.date,cash_voucher.from_voucher,cash_voucher.id,cash_voucher.description"); 
        $this->db->from('cash_voucher');
        $this->db->join('project', 'project.id=cash_voucher.project_id');
        $this->db->join('main_head', 'main_head.id=cash_voucher.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_voucher.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_voucher.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_voucher.is_delete',0)->where('cash_voucher.branch',$branch)->where('project.id',$v);
        $query = $this->db->get()->result_array();
        $return="";
        $i=1;
        foreach ($query as $key => $value) 
        {
           $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['programename']."</td>";
            $return .= "<td>".$value['p_name']."</td>";
            $return .= "<td>".$value['headname']."</td>";
            $return .= "<td>".$value['level2name']."</td>";
            $return .= "<td>".$value['level3name']."</td>";
            $return .= "<td>".$value['from_voucher']."</td>";
            $return .= "<td>".$value['description']."</td>";
            $return .= "<td>".$value['amount']."</td>";
            
            $return .= "<td>".$value['date']."</td>";
            $return .= "</tr>"; 
        }
        echo $return;
    }
    public function main_head_against_vou($v=0,$p=0)
    {
        $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_voucher.amount,cash_voucher.date,cash_voucher.from_voucher,cash_voucher.id,cash_voucher.description"); 
        $this->db->from('cash_voucher');
        $this->db->join('project', 'project.id=cash_voucher.project_id');
        $this->db->join('main_head', 'main_head.id=cash_voucher.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_voucher.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_voucher.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_voucher.is_delete',0)->where('cash_voucher.branch',$branch)->where('main_head.id',$v)->where('project.program_id',$p);
        $query = $this->db->get()->result_array();
        $return="";
        $i=1;
        foreach ($query as $key => $value) 
        {
           $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['programename']."</td>";
            $return .= "<td>".$value['p_name']."</td>";
            $return .= "<td>".$value['headname']."</td>";
            $return .= "<td>".$value['level2name']."</td>";
            $return .= "<td>".$value['level3name']."</td>";
            $return .= "<td>".$value['from_voucher']."</td>";
            $return .= "<td>".$value['description']."</td>";
            $return .= "<td>".$value['amount']."</td>";
           
            $return .= "<td>".$value['date']."</td>";
            $return .= "</tr>"; 
        }
        echo $return;
    }
    public function level2_against_vou($m=0,$v=0,$p=0)
    {
        $branch=$this->user_model->getbranch();
         $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_voucher.amount,cash_voucher.date,cash_voucher.from_voucher,cash_voucher.id,cash_voucher.description"); 
        $this->db->from('cash_voucher');
        $this->db->join('project', 'project.id=cash_voucher.project_id');
        $this->db->join('main_head', 'main_head.id=cash_voucher.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_voucher.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_voucher.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_voucher.is_delete',0)->where('cash_voucher.branch',$branch)->where('level_2.id',$v)->where('project.id',$p)->where('main_head.id',$m);
        $query = $this->db->get()->result_array();
        $return="";
        $i=1;
        foreach ($query as $key => $value) 
        {
           $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['programename']."</td>";
            $return .= "<td>".$value['p_name']."</td>";
            $return .= "<td>".$value['headname']."</td>";
            $return .= "<td>".$value['level2name']."</td>";
            $return .= "<td>".$value['level3name']."</td>";
            $return .= "<td>".$value['from_voucher']."</td>";
             $return .= "<td>".$value['description']."</td>";
            $return .= "<td>".$value['amount']."</td>";
            
            $return .= "<td>".$value['date']."</td>";
            $return .= "</tr>";
        }
        echo $return;
    }
    public function level3_against_vou($m=0,$v=0,$p=0,$l2=0)
    {
        $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_voucher.amount,cash_voucher.date,cash_voucher.from_voucher,cash_voucher.id,cash_voucher.description"); 
        $this->db->from('cash_voucher');
        $this->db->join('project', 'project.id=cash_voucher.project_id');
        $this->db->join('main_head', 'main_head.id=cash_voucher.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_voucher.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_voucher.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_voucher.is_delete',0)->where('cash_voucher.branch',$branch)->where('level_2.id',$l2)->where('level_3.id',$v)->where('project.id',$p)->where('main_head.id',$m);
        $query = $this->db->get()->result_array();
        $return="";
        $i=1;
        foreach ($query as $key => $value) 
        {
           $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['programename']."</td>";
            $return .= "<td>".$value['p_name']."</td>";
            $return .= "<td>".$value['headname']."</td>";
            $return .= "<td>".$value['level2name']."</td>";
            $return .= "<td>".$value['level3name']."</td>";
            $return .= "<td>".$value['from_voucher']."</td>";
            $return .= "<td>".$value['description']."</td>";
            $return .= "<td>".$value['amount']."</td>";
            
            $return .= "<td>".$value['date']."</td>";
            $return .= "</tr>";
        }
        echo $return;
    }
    public function datewise_vou($d1='0000-00-00',$d2='0000-00-00')
    {
        $branch=$this->user_model->getbranch();
        $this->db->select("program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_voucher.amount,cash_voucher.date,cash_voucher.from_voucher,cash_voucher.id"); 
        $this->db->from('cash_voucher');
        $this->db->join('project', 'project.id=cash_voucher.project_id');
        $this->db->join('main_head', 'main_head.id=cash_voucher.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_voucher.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_voucher.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_voucher.is_delete',0)->where('cash_voucher.branch',$branch)->where('cash_voucher.date >=', $d1)->where('cash_voucher.date <=',$d2);;
        $query = $this->db->get()->result_array();
        $return="";
        $i=1;
        foreach ($query as $key => $value) 
        {
           $return .= "<tr>";
            $return .= "<td>".$i++."</td>";
            $return .= "<td>".$value['programename']."</td>";
            $return .= "<td>".$value['p_name']."</td>";
            $return .= "<td>".$value['headname']."</td>";
            $return .= "<td>".$value['level2name']."</td>";
            $return .= "<td>".$value['level3name']."</td>";
             $return .= "<td>".$value['from_voucher']."</td>";
            $return .= "<td>".$value['amount']."</td>";
           
            $return .= "<td>".$value['date']."</td>";
            $return .= "</tr>";  
        }
        echo $return;
    }

//--===================================================Bank Payment================================

public function programe_against_bank($v=0)
{
    $branch=$this->user_model->getbranch();
    $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_payment.amount,bank_payment.date,bank_payment.to_payment,bank_payment.id"); 
        $this->db->from('bank_payment');
        $this->db->join('project', 'project.id=bank_payment.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_payment.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_payment.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_payment.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_payment.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_payment.is_delete',0)->where('bank_payment.branch',$branch)->where('project.program_id',$v);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function bank_against_pay($v=0)
{
    $branch=$this->user_model->getbranch();
    $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_payment.amount,bank_payment.date,bank_payment.to_payment,bank_payment.id"); 
        $this->db->from('bank_payment');
        $this->db->join('project', 'project.id=bank_payment.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_payment.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_payment.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_payment.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_payment.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_payment.is_delete',0)->where('bank_payment.branch',$branch)->where('bank_payment.bank_id',$v);
       $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function project_against_bank($v=0)
{
     $branch=$this->user_model->getbranch();
    $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_payment.amount,bank_payment.date,bank_payment.to_payment,bank_payment.id"); 
        $this->db->from('bank_payment');
        $this->db->join('project', 'project.id=bank_payment.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_payment.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_payment.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_payment.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_payment.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_payment.is_delete',0)->where('bank_payment.branch',$branch)->where('bank_payment.project_id',$v);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function main_head_against_bank($v=0,$p=0)
{
     $branch=$this->user_model->getbranch();
    $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_payment.amount,bank_payment.date,bank_payment.to_payment,bank_payment.id"); 
        $this->db->from('bank_payment');
        $this->db->join('project', 'project.id=bank_payment.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_payment.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_payment.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_payment.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_payment.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_payment.is_delete',0)->where('bank_payment.branch',$branch)->where('bank_payment.main_head_id',$v)->where('bank_payment.project_id',$p);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function level2_against_bank($m=0,$v=0,$p=0)
{
     $branch=$this->user_model->getbranch();
    $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_payment.amount,bank_payment.date,bank_payment.to_payment,bank_payment.id"); 
        $this->db->from('bank_payment');
        $this->db->join('project', 'project.id=bank_payment.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_payment.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_payment.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_payment.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_payment.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_payment.is_delete',0)->where('bank_payment.branch',$branch)->where('level_2.id',$v)->where('project.id',$p)->where('main_head.id',$m);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function level3_against_bank($m=0,$v=0,$p=0,$l2=0)
{
     $branch=$this->user_model->getbranch();
    $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_payment.amount,bank_payment.date,bank_payment.to_payment,bank_payment.id"); 
        $this->db->from('bank_payment');
        $this->db->join('project', 'project.id=bank_payment.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_payment.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_payment.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_payment.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_payment.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_payment.is_delete',0)->where('bank_payment.branch',$branch)->where('level_2.id',$l2)->where('level_3.id',$v)->where('project.id',$p)->where('main_head.id',$m);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
//========================================Bank Receipt============================================
        public function programe_against_bank_recpt($v=0)
    {
        $branch=$this->user_model->getbranch();
        $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_recpt.amount,bank_recpt.date,bank_recpt.from_recpt,bank_recpt.id"); 
        $this->db->from('bank_recpt');
        $this->db->join('project', 'project.id=bank_recpt.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_recpt.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_recpt.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_recpt.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_recpt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_recpt.is_delete',0)->where('bank_recpt.branch',$branch)->where('project.program_id',$v);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
        public function programe_against_cash_deposit($v=0)
{
        $branch=$this->user_model->getbranch();
        $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_deposit.amount,cash_deposit.date,cash_deposit.submit_by,cash_deposit.id,cash_deposit.description"); 
        $this->db->from('cash_deposit');
        $this->db->join('project', 'project.id=cash_deposit.project_id');
        $this->db->join('bank_def', 'bank_def.id=cash_deposit.bank_id');
        $this->db->join('main_head', 'main_head.id=cash_deposit.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_deposit.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_deposit.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_deposit.is_delete',0)->where('cash_deposit.branch',$branch)->where('project.program_id',$v);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function bank_against_recpt($v=0)
{
    $branch=$this->user_model->getbranch();
    $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_recpt.amount,bank_recpt.date,bank_recpt.from_recpt,bank_recpt.id"); 
        $this->db->from('bank_recpt');
        $this->db->join('project', 'project.id=bank_recpt.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_recpt.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_recpt.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_recpt.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_recpt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_recpt.is_delete',0)->where('bank_recpt.branch',$branch)->where('bank_recpt.bank_id',$v);
       $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function bank_against_cash_deposit($v=0)
{
    $branch=$this->user_model->getbranch();
     $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_deposit.amount,cash_deposit.date,cash_deposit.submit_by,cash_deposit.id,cash_deposit.description"); 
        $this->db->from('cash_deposit');
        $this->db->join('project', 'project.id=cash_deposit.project_id');
        $this->db->join('bank_def', 'bank_def.id=cash_deposit.bank_id');
        $this->db->join('main_head', 'main_head.id=cash_deposit.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_deposit.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_deposit.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_deposit.is_delete',0)->where('cash_deposit.branch',$branch)->where('cash_deposit.bank_id',$v);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function project_against_bank_recpt($v=0)
{
    $branch=$this->user_model->getbranch();
    $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_recpt.amount,bank_recpt.date,bank_recpt.from_recpt,bank_recpt.id"); 
        $this->db->from('bank_recpt');
        $this->db->join('project', 'project.id=bank_recpt.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_recpt.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_recpt.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_recpt.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_recpt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_recpt.is_delete',0)->where('bank_recpt.branch',$branch)->where('bank_recpt.project_id',$v);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function project_against_cash_deposit($v=0)
{
    $branch=$this->user_model->getbranch();
        $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_deposit.amount,cash_deposit.date,cash_deposit.submit_by,cash_deposit.id,cash_deposit.description"); 
        $this->db->from('cash_deposit');
        $this->db->join('project', 'project.id=cash_deposit.project_id');
        $this->db->join('bank_def', 'bank_def.id=cash_deposit.bank_id');
        $this->db->join('main_head', 'main_head.id=cash_deposit.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_deposit.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_deposit.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_deposit.is_delete',0)->where('cash_deposit.branch',$branch)->where('cash_deposit.project_id',$v);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function main_head_against_bank_recpt($v=0,$p=0)
{   
    $branch=$this->user_model->getbranch();
        $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_recpt.amount,bank_recpt.date,bank_recpt.from_recpt,bank_recpt.id"); 
        $this->db->from('bank_recpt');
        $this->db->join('project', 'project.id=bank_recpt.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_recpt.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_recpt.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_recpt.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_recpt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_recpt.is_delete',0)->where('bank_recpt.branch',$branch)->where('bank_recpt.main_head_id',$v)->where('bank_recpt.project_id',$p);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function main_head_against_cash_deposit($v=0,$p=0)
{   
    $branch=$this->user_model->getbranch();
        $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_deposit.amount,cash_deposit.date,cash_deposit.submit_by,cash_deposit.id,cash_deposit.description"); 
        $this->db->from('cash_deposit');
        $this->db->join('project', 'project.id=cash_deposit.project_id');
        $this->db->join('bank_def', 'bank_def.id=cash_deposit.bank_id');
        $this->db->join('main_head', 'main_head.id=cash_deposit.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_deposit.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_deposit.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_deposit.is_delete',0)->where('cash_deposit.branch',$branch)->where('cash_deposit.main_head_id',$v)->where('cash_deposit.project_id',$p);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function level2_against_bank_recpt($m=0,$v=0,$p=0)
{
    $branch=$this->user_model->getbranch();
    $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_recpt.amount,bank_recpt.date,bank_recpt.from_recpt,bank_recpt.id"); 
        $this->db->from('bank_recpt');
        $this->db->join('project', 'project.id=bank_recpt.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_recpt.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_recpt.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_recpt.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_recpt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_recpt.is_delete',0)->where('bank_recpt.branch',$branch)->where('level_2.id',$v)->where('project.id',$p)->where('main_head.id',$m);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function level2_against_cash_deposit($m=0,$v=0,$p=0)
{
    $branch=$this->user_model->getbranch();
        $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_deposit.amount,cash_deposit.date,cash_deposit.submit_by,cash_deposit.id,cash_deposit.description"); 
        $this->db->from('cash_deposit');
        $this->db->join('project', 'project.id=cash_deposit.project_id');
        $this->db->join('bank_def', 'bank_def.id=cash_deposit.bank_id');
        $this->db->join('main_head', 'main_head.id=cash_deposit.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_deposit.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_deposit.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_deposit.is_delete',0)->where('cash_deposit.branch',$branch)->where('level_2.id',$v)->where('project.id',$p)->where('main_head.id',$m);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
public function level3_against_bank_recpt($m=0,$v=0,$p=0,$l2=0)
{
    $branch=$this->user_model->getbranch();
    $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,bank_recpt.amount,bank_recpt.date,bank_recpt.from_recpt,bank_recpt.id"); 
        $this->db->from('bank_recpt');
        $this->db->join('project', 'project.id=bank_recpt.project_id');
        $this->db->join('bank_def', 'bank_def.id=bank_recpt.bank_id');
        $this->db->join('main_head', 'main_head.id=bank_recpt.main_head_id');
        $this->db->join('level_2', ' level_2.id=bank_recpt.level_2_id');
        $this->db->join('level_3', ' level_3.id=bank_recpt.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('bank_recpt.is_delete',0)->where('bank_recpt.branch',$branch)->where('level_2.id',$l2)->where('level_3.id',$v)->where('project.id',$p)->where('main_head.id',$m);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}
    public function level3_against_cash_deposit($m=0,$v=0,$p=0,$l2=0)
{
    $branch=$this->user_model->getbranch();
     $this->db->select("bank_def.b_name,program.name as programename,project.p_name,main_head.name as headname,level_2.name as level2name,level_3.name as level3name,cash_deposit.amount,cash_deposit.date,cash_deposit.submit_by,cash_deposit.id,cash_deposit.description"); 
        $this->db->from('cash_deposit');
        $this->db->join('project', 'project.id=cash_deposit.project_id');
        $this->db->join('bank_def', 'bank_def.id=cash_deposit.bank_id');
        $this->db->join('main_head', 'main_head.id=cash_deposit.main_head_id');
        $this->db->join('level_2', ' level_2.id=cash_deposit.level_2_id');
        $this->db->join('level_3', ' level_3.id=cash_deposit.level_3_id');
        $this->db->join('program','program.id=project.program_id');
        $this->db->where('cash_deposit.is_delete',0)->where('cash_deposit.branch',$branch)->where('level_2.id',$l2)->where('level_3.id',$v)->where('project.id',$p)->where('main_head.id',$m);
        $query = $this->db->get()->result_array();
        echo json_encode($query);
}

}
