<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends CI_Controller {

	public $userInfo;

    public function __construct()
    {
        parent::__construct();
        	$this->load->library("hajanasms");
		$this->user_model->check_login("home");
		$this->load->model("voucher_model");
		$this->userInfo = $this->user_model->userInfo("first_name,last_name");
    }

	public function index()
	{
		$this->user_model->check_permissions("voucher/index");
		$branch = $this->user_model->getBranch();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
		$data['userInfo'] = $this->userInfo;
		if($this->user_model->is_super())
		{
			$data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->result_array();
		} else {
			$data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `id`='$branch' AND `is_delete`='0'")->result_array();
		}
		for ($i=1; $i <=12 ; $i++) { 
			$data['add_months'][]=date('Y-m',strtotime("first day of +".$i." month"));
		}
		$this->load->view('header',$data);
		$this->load->view('sidebar',$data);
		$this->load->view('voucher/index',$data);
	}

	public function view($p)
	{
		if(!empty($p))
		{
			$branch = $this->user_model->getBranch();
			$data['menu'] = $this->load_model->menu();
			$data['base_url'] = base_url();
			$data['userInfo'] = $this->userInfo;
			$invoice = $this->db->query("SELECT * FROM `invoice` WHERE `id`='$p' AND `is_delete`='0'")->result_array()[0];
			$data['add_months']=@$this->db->where('invoice_id',$p)->where('is_delete',0)->get('fee_add_months')->result_array();
			$data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `id`='".$invoice['branch_id']."' AND `is_delete`='0'")->result_array()[0];
			$data['student'] = $this->db->query("SELECT `grno`,`student_name`,`father_name`,`student_contact` FROM `student` INNER JOIN `promotion` ON `promotion`.`student_id`=`student`.`id` WHERE `promotion`.`id`='".$invoice['student_id']."'")->result_array()[0];
			$data['fee'] = $this->db->query("SELECT `fee_def`.`name`,`fee_installment`.`amount` FROM `fee_installment` INNER JOIN `fee_def` ON `fee_def`.`id`=`fee_installment`.`fee_id` WHERE `fee_installment`.`invoice`='$p' AND `fee_installment`.`is_delete`='0'")->result_array();
			$tot = $this->db->query("SELECT sum(`amount`) as sum FROM `fee_installment` WHERE `invoice`='$p' AND `is_delete`='0'")->result_array()[0]['sum'];
			$data['total'] = $tot + $invoice['fee_pack'];
			//$lastv = @$this->db->query("SELECT `id`,`status`,`advance`,`remaining`,`late_fine`,`fee_pack` FROM  `invoice` WHERE `id` <>  '$p' AND `branch_id` =  '".$invoice['branch_id']."' AND  `student_id` =  '".$invoice['student_id']."' AND  `id` <  '".$p."' AND is_delete='0'  ORDER BY  `id` DESC ")->result_array();
			$lastv=$this->voucher_model->getLastVoucher($invoice['student_id'],$invoice['id']);
			
			//arrears logic
			$data['lastadv'] = 0;
			$data['lastrem'] = 0;
		        if($lastv && $lastv[0]['status']==1)
		        {
				$data['lastadv'] = $lastv[0]['advance'];
				$data['lastrem'] = $lastv[0]['remaining'];			
		        }
		        
		        elseif($lastv && $lastv[0]['status']==0)
		        {
			     $data['lastadv'] = 0;
			     $data['lastrem'] = $this->voucher_model->countArrears($invoice['id'],$invoice['student_id'],0);
		        }
			//end arrears logic
			$due = date("Y-m-d",strtotime($invoice['date_expire']));
			$date = date("Y-m-d");

			if ($due<=$date && $invoice['status']==0) {
				$per = ($data['total'] * $invoice['late_fine']) / 100;
				if(!empty($data['add_months'])) {
					foreach ($data['add_months'] as $key => $value) {
						$per += ($value['fee'] * $invoice['late_fine']) / 100;
					}
				}
				$data['net'] = $data['total'] + $per;
				$data['fine'] = $per;
			} else {
				$data['net'] = $data['total'];
				$data['fine'] = 0;
			}
			//============adding additional months fee to $data[total]====================

			if(!empty($data['add_months'])) {
				foreach ($data['add_months'] as $key => $value) {
					$data['total'] += $value['fee'];
				}
			}

			//============================================================================
			$data['invoice'] = $invoice;
			$this->load->view('header',$data);
			$this->load->view('sidebar',$data);
			$this->load->view('voucher/view',$data);
		}else {
			redirect("voucher/listv","refresh");
		}
	}
public function createUnexpectedVoucher()
	{
		$this->user_model->check_permissions("voucher/index");
		$branch = $this->user_model->getBranch();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
		$data['userInfo'] = $this->userInfo;

		if($this->user_model->is_super())
		{
			$data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->result_array();
		} else {
			$data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `id`='$branch' AND `is_delete`='0'")->result_array();
		}
		$data['session'] = $this->db->query("SELECT * FROM `session` WHERE `is_delete`='0'")->result_array();

		$this->load->view('header',$data);
		$this->load->view('sidebar',$data);
		$this->load->view('voucher/FormUnexpectedVoucher',$data);
	}

	public function creatingUnexpectedVoucher()
	{
		$data=$this->input->post();
		$branch=$data['branch'];
		$promotion_id=$data['student'];
		$fee=$data['fee'];
		
		$late_fine = (int)$this->db->query("SELECT `branch`.`late_fine` FROM `branch` WHERE `branch`.`id`=$branch AND `branch`.`is_delete`='0'")->row('late_fine');
		$date = date("Y-m-d");
		$exp_date = date("Y-m-d", strtotime('+11 days'));

		$invoice = array(
			'branch_id' => $branch,
			"student_id"=>$promotion_id,
			"fee_pack"=>0,
			"date"=>$date,
			"date_expire"=>$exp_date,
			"late_fine"=>$late_fine,
		);
		$this->db->insert("invoice",$invoice);

		$inv = $this->db->insert_id();
		if(@!empty($fee))
		{
			foreach ($fee as $k => $d) {
				if(isset($d['name']))
				{
					$install = array(
						'invoice' => $inv,
						'amount' => $d['value'],
						'fee_id' => $k
					);
					$this->db->insert('fee_installment',$install);
				}
			}
		}

		redirect("voucher/listv","refresh");
		
	}
	public function listV($q="all",$p=1)
	{
		$this->user_model->check_permissions("voucher/index");
		$data['is_super'] = $this->user_model->is_super();
		$branch = $this->user_model->getBranch();
		$data['menu'] = $this->load_model->menu();
		$data['base_url'] = base_url();
		$data['userInfo'] = $this->userInfo;
		$per_page = 50;
		$offset = ($p - 1) * $per_page;
		$ym = date("Y-m");
		//$ym = '2016-08';
		$sq = "";
        if($q!="all")
        {
			if($q=="Defaulter" or $q=="defaulter") {
				$sq .= "AND (invoice.status='0') "; 
			}else{
				$sq .= "AND (student.grno like '%".$q."%' OR "; 
				$sq .= "student.student_name like '%".$q."%' OR ";
				$sq .= "student.father_name like '%".$q."%' OR ";
				$sq .= "student.father_contact like '%".$q."%' OR ";
				$sq .= "class.class_name like '%".$q."%' OR ";
				$sq .= "section.section_name like '%".$q."%' OR ";
				$sq .= "invoice.id like '%".$q."%' )";
			}
        }
        if($this->user_model->is_super())
		{
			$data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->result_array();
			$data['voucher'] = $this->db->query("SELECT `student`.`student_name`,`student`.`grno`,`invoice`.`id` as `invoice`,`invoice`.`status`,`invoice`.`date`,`invoice`.`date_expire`,`class`.`class_name`,`section`.`section_name` FROM `invoice` INNER JOIN `promotion` ON `promotion`.`id` = `invoice`.`student_id` INNER JOIN `student` ON `student`.`id` = `promotion`.`student_id` INNER JOIN `class` ON `promotion`.`class_id` = `class`.`class_id` INNER JOIN `section` ON `promotion`.`section_id` = `section`.`section_id` WHERE `invoice`.`is_delete`='0' AND LEFT(`invoice`.`date`,7)='$ym' $sq")->result_array();
			$total = $this->db->query("SELECT count(*) as total FROM `invoice` WHERE `is_delete`='0' AND `branch_id`='$branch' AND LEFT(`date`,7)='$ym'")->result_array()[0]['total'];
		}
		else
		{
			$data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0' AND `id`='$branch'")->result_array();
			$data['voucher'] = $this->db->query("SELECT `student`.`student_name`,`student`.`grno`,`invoice`.`id` as `invoice`,`invoice`.`status`,`invoice`.`date`,`invoice`.`date_expire`,`class`.`class_name`,`section`.`section_name` FROM `invoice` INNER JOIN `promotion` ON `promotion`.`id` = `invoice`.`student_id` INNER JOIN `student` ON `student`.`id` = `promotion`.`student_id` INNER JOIN `class` ON `promotion`.`class_id` = `class`.`class_id` INNER JOIN `section` ON `promotion`.`section_id` = `section`.`section_id` WHERE `invoice`.`is_delete`='0' AND `invoice`.`branch_id`='$branch' AND LEFT(`invoice`.`date`,7)='$ym' $sq")->result_array();
			$total = $this->db->query("SELECT count(*) as total FROM `invoice` WHERE `is_delete`='0' AND `branch_id`='$branch' AND LEFT(`date`,7)='$ym'")->result_array()[0]['total'];
		}
		$data['session'] = $this->db->query("SELECT * FROM `session` WHERE `is_delete`='0'")->result_array();
		$data['q'] = $q;
		$data['searchq'] = $q;
		$data['curr'] = $p;	
		$data['end'] = ceil($total / $per_page);
		$this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('voucher/list',$data);
	}

	public function doPrint($id)
	{
		if (!empty($id)) {
			$data['base_url'] = base_url();
			$branch = $this->user_model->getBranch();
			$is_super = $this->user_model->is_super();
			if($is_super)
				$invoice = $this->db->query("SELECT * FROM `invoice` WHERE `id`='$id' AND `is_delete`='0'")->result_array()[0];
			else
				$invoice = $this->db->query("SELECT * FROM `invoice` WHERE `id`='$id' AND `is_delete`='0' AND `branch_id`='$branch'")->result_array()[0];
			$data['add_months']=@$this->db->where('invoice_id',$id)->where('is_delete',0)->get('fee_add_months')->result_array();
			$data['student'] = $this->db->query("SELECT `student`.`grno`,`student`.`student_name`,`student`.`father_name`,`student`.`student_contact`,`class`.`class_name`,`section`.`section_name` FROM `student` INNER JOIN `promotion` ON `promotion`.`student_id`=`student`.`id` INNER JOIN `class` ON `promotion`.`class_id`=`class`.`class_id` INNER JOIN `section` ON `section`.`section_id`=`promotion`.`section_id` WHERE `promotion`.`id`='".$invoice['student_id']."'")->result_array()[0];
			$data['fee'] = $this->db->query("SELECT `fee_def`.`name`,`fee_installment`.`amount` FROM `fee_installment` INNER JOIN `fee_def` ON `fee_def`.`id`=`fee_installment`.`fee_id` WHERE `fee_installment`.`invoice`='$id' AND `fee_installment`.`is_delete`='0'")->result_array();
			$tot = $this->db->query("SELECT sum(`amount`) as sum FROM `fee_installment` WHERE `invoice`='$id' AND `is_delete`='0'")->result_array()[0]['sum'];
			//$lastv = @$this->db->query("SELECT `id`,`status`,`advance`,`remaining`,`late_fine`,`fee_pack` FROM  `invoice` WHERE `id` <>  '$id' AND `branch_id` =  '".$invoice['branch_id']."' AND  `student_id` =  '".$invoice['student_id']."' AND  `id` <  '".$id."' AND is_delete='0'  ORDER BY  `id` DESC ")->result_array();
			
			$lastv=$this->voucher_model->getLastVoucher($invoice['student_id'],$invoice['id']);
			
			//arrears logic
			$data['lastadv'] = 0;
			$data['lastrem'] = 0;
		        if($lastv && $lastv[0]['status']==1)
		        {
				$data['lastadv'] = $lastv[0]['advance'];
				$data['lastrem'] = $lastv[0]['remaining'];			
		        }
		        
		        elseif($lastv && $lastv[0]['status']==0)
		        {
			     $data['lastadv'] = 0;
			     $data['lastrem'] = $this->voucher_model->countArrears($invoice['id'],$invoice['student_id'],0);
		        }
			//end arrears logic
			$data['b_header'] = $this->db->query("SELECT `title`,`tagline`,`short_address`,`phone_no`,`email`,`logo1`,`logo2` FROM `branch` WHERE `id`='".$invoice['branch_id']."' AND `is_delete`='0'")->result_array()[0];
			$data['total'] = $tot + $invoice['fee_pack'];
			foreach ($data['add_months'] as $key => $value) {
				$data['total']+=$value['fee'];
			}
			$data['invoice'] = $invoice;
			$this->load->view('printable/voucher',$data);
		}else{
			redirect("home","refresh");
		}
	}

	public function create()
	{
		if($this->input->post())
		{
			$date = $this->input->post("date",true);
			$branch = $this->input->post("branch",true);
			$class = $this->input->post("class",true);
			$fee = $this->input->post("fee",true);
			$add_months= $this->input->post("add_months",true);

			$this->db->select("promotion.id,student.disc_type,student.disc_value");
			$this->db->join("promotion","student.id=promotion.student_id");
			$this->db->where("student.status",'0');
			$this->db->where("student.branch",$branch);
			$this->db->where("promotion.class_id",$class);
			$this->db->where("promotion.is_active",'1');
			$this->db->where("promotion.is_delete",'0');
			$students = $this->db->get("student")->result_array();

			$this->db->select("tution_fee,admin_fee");
			$this->db->where("is_delete",'0');
			$this->db->where("class_id",$class);
			$c_data = $this->db->get("class")->result_array()[0];

			$this->db->select("late_fine,due_date");
			$this->db->where("is_delete",'0');
			$this->db->where("id",$branch);
			$branch_data = $this->db->get("branch")->result_array()[0];


			$fee_pack = $c_data['tution_fee'];
			$admin_fee = $c_data['admin_fee'];
			//$days = date("d");
			//$due_date = date("Y-m-d",strtotime("+".$branch_data['due_date']." days -$days days"));
			$first_day_of_date=date('Y-m-d',strtotime("$date first day of this month"));
			$due_date=date('Y-m-d',strtotime("$first_day_of_date +".$branch_data['due_date']." days"));
			$late_fine = $branch_data['late_fine'];


				foreach ($students as $key => $v) {
					$student = $v['id'];
					$disc_type = $v['disc_type'];
					$disc_value = $v['disc_value'];
					if($disc_value!=0)
					{
						if($disc_type=="percentage")
						{
							$calc = ($fee_pack * $disc_value) / 100;
							$fee_pack_final = $fee_pack - $calc;
						}else if($disc_type=="rupees")
						{
							$fee_pack_final = $fee_pack - $disc_value;
						}
					}else{
						$fee_pack_final = $fee_pack;
					}
					$invoice = array(
						'branch_id' => $branch,
						"student_id"=>$student,
						"fee_pack"=>$fee_pack_final,
						"admin_fee"=>$admin_fee,
						"date"=>$date,
						"date_expire"=>$due_date,
						"late_fine"=>$late_fine
					);
					$this->db->insert("invoice",$invoice);
					$inv = $this->db->insert_id();
					if(@!empty($fee))
					{
						foreach ($fee as $k => $d) {
							if(isset($d['name']))
							{
								$install = array(
									'invoice' => $inv,
									'amount' => $d['value'],
									'fee_id' => $k
								);
								$this->db->insert('fee_installment',$install);
							}
						}
					}
					if(@!empty($add_months)) {
						foreach ($add_months as $key => $select_month) {
							$fee_add_months=array(
								'invoice_id'=>$inv,
								'month'=>$select_month,
								'fee'=>$fee_pack_final
							);
							$this->db->insert('fee_add_months',$fee_add_months);
						}
					}
				}	
		}
		redirect("voucher/index","refresh");
	}

	public function delete($id)
	{
		if(!empty($id))
		{
			$data = array(
				"is_delete"=>"1"
			);
			$this->db->where("id",$id);
			$this->db->update("invoice",$data);
		}
		redirect("voucher/listv","refresh");
	}

	public function submit()
	{
		if($this->input->post())
		{
			$id = $this->input->post("id",true);
			$received = $this->input->post("recieved",true);
			$remaining = $this->input->post("remaining",true);
			$advance = $this->input->post("advance",true);
			$submitted_at = $this->input->post("submitted_at",true);
			$contact_number=$this->voucher_model->getVoucherContactNumber($id)['father_contact'];
			$child_name=$this->voucher_model->getVoucherContactNumber($id)['student_name'];
			$branch_name = @$this->db->query("SELECT `name` FROM `branch` WHERE `id`=".$this->user_model->getBranch()." AND `is_delete`='0'")->result_array()[0]['name'];			
			$data = array(
				"status"=>"1",
				"remaining"=>$remaining,
				"recieved"=>$received,
				"advance"=>$advance,
				"submitted_at"=>$submitted_at
			);
			$this->db->where("id",$id);
			$this->db->update("invoice",$data);
			$message="Dear Parents,\nTuition fee of your child ".$child_name." has been received Amount:".$received."\nThank you for co-operation\nPrincipal\nSLMHS DHK\n".$branch_name;
			$this->hajanasms->sendOneNumber($contact_number,$message);
		}
		redirect("voucher/listv/","refresh");
	}

	public function classPrint($b="",$c="",$s="",$sess="",$m="")
	{
		if (!empty($b) AND !empty($c) AND !empty($s) AND !empty($sess) AND !empty($m)) {
			$data['base_url'] = base_url();
			$branch = $this->user_model->getBranch();
			$is_super = $this->user_model->is_super();
			$data['students'] = [];
			$data['b_header'] = [];
			$students = $this->db->query("SELECT `student`.`id`,`promotion`.`id` as pid,`student`.`grno`,`student`.`student_name`,`student`.`father_name`,`student`.`student_contact`,`class`.`class_name`,`section`.`section_name` FROM `student` INNER JOIN `promotion` ON `promotion`.`student_id`=`student`.`id` INNER JOIN `class` ON `promotion`.`class_id`=`class`.`class_id` INNER JOIN `section` ON `section`.`section_id`=`promotion`.`section_id` WHERE `student`.`branch`='$b' AND `promotion`.`class_id`='$c' AND `promotion`.`section_id`='$s' AND `promotion`.`session_id`='$sess'")->result_array();
			foreach ($students as $key => $value) {
				$data['students'][$key] = $value;
				$id = $value['id'];
				$pid = $value['pid'];
				if($is_super)
					$data['invoice'][$key] = @$this->db->query("SELECT * FROM `invoice` WHERE `student_id`='$pid' AND `is_delete`='0' AND LEFT(`date`,7)='$m'")->result_array()[0];
				else
					$data['invoice'][$key] = @$this->db->query("SELECT * FROM `invoice` WHERE `student_id`='$pid' AND `is_delete`='0' AND `branch_id`='$branch' AND LEFT(`date`,7)='$m'")->result_array()[0];
				$data['fee'][$key] = $this->db->query("SELECT `fee_def`.`name`,`fee_installment`.`amount` FROM `fee_installment` INNER JOIN `fee_def` ON `fee_def`.`id`=`fee_installment`.`fee_id` WHERE `fee_installment`.`invoice`='".$data['invoice'][$key]['id']."' AND `fee_installment`.`is_delete`='0'")->result_array();
				$data['add_months'][$key]=@$this->db->where('invoice_id',$data['invoice'][$key]['id'])->where('is_delete',0)->get('fee_add_months')->result_array();
				$tot = $this->db->query("SELECT sum(`amount`) as sum FROM `fee_installment` WHERE `invoice`='".$data['invoice'][$key]['id']."' AND `is_delete`='0'")->result_array()[0]['sum'];
				//$lastv = @$this->db->query("SELECT `id`,`status`,`advance`,`remaining`,`late_fine`,`fee_pack` FROM  `invoice` WHERE `id` <>  '".$data['invoice'][$key]['id']."' AND `branch_id` =  '".$data['invoice'][$key]['branch_id']."' AND  `student_id` =  '".$data['invoice'][$key]['student_id']."' AND  `id` <  '".$data['invoice'][$key]['id']."' AND is_delete='0'  ORDER BY  `id` DESC ")->result_array();
				
				if(!empty($data['invoice'][$key]))
				$lastv=$this->voucher_model->getLastVoucher($data['invoice'][$key]['student_id'],$data['invoice'][$key]['id']);
				else
				$lastv=false;
				
				//arrears logic
				$data['lastadv'][$key] = 0;
				$data['lastrem'][$key] = 0;
		        if($lastv && $lastv[0]['status']==1)
		        {
				$data['lastadv'][$key] = $lastv[0]['advance'];
				$data['lastrem'][$key] = $lastv[0]['remaining'];			
		        }
		        
		        elseif($lastv && $lastv[0]['status']==0)
		        {
			     $data['lastadv'][$key] = 0;
				 $data['lastrem'][$key] = $this->voucher_model->countArrears($data['invoice'][$key]['id'],$data['invoice'][$key]['student_id'],0);
		        }
				//end arrears logic
				$data['total'][$key] = $tot + $data['invoice'][$key]['fee_pack'];
				foreach ($data['add_months'][$key] as $k => $v) {
					$data['total'][$key]+=$v['fee'];
				}
				$data['b_header'] = @$this->db->query("SELECT `title`,`tagline`,`short_address`,`phone_no`,`email`,`logo1`,`logo2` FROM `branch` WHERE `id`='$b' AND `is_delete`='0'")->result_array()[0];
			}
			$this->load->view('printable/voucher_class_wise',$data);
		}else{
			redirect("home","refresh");
		}
	}

	public function sms_defaulters($class_id='',$section_id='')
	{ 
		if($class_id!='' && $section_id!='') {
			$data = [];
			$month = date("Y-m");
			$date = date("Y-m-d");
			$students = $this->db->select("invoice.id as invoice_id,student.father_contact,student.student_name")->from("student")->join("promotion","promotion.student_id=student.id")->join("invoice","invoice.student_id=promotion.id")->where("student.status","0")->where("promotion.is_delete","0")->where("promotion.is_active","1")->where("invoice.is_delete","0")->where("invoice.status","0")->where("LEFT(invoice.date,7)",$month)->where("invoice.date_expire<",$date)->where("promotion.class_id",$class_id)->where("promotion.section_id",$section_id)->get()->result();
			foreach ($students as $key => $value) {
				$fee=$this->voucher_model->countTotalFee($value->invoice_id);
				$message="Dear Parents,\nApko matula kia jata hai k ".$value->student_name." ki tuition fees abi tak mosool nhi hoi.Guzarish hai k fees jald az jald jama krwain.\nAmount: ".$fee."\nSLMHS DHK";
				$this->hajanasms->sendOneNumber($value->father_contact,$message);
			}
			redirect("voucher/listV");	
		}
	}
	
//===========================================fee history view============================
	public function fee_history()
	{
		$this->user_model->check_permissions("voucher/fee_history");
		$branch = $this->user_model->getBranch();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
		$data['userInfo'] = $this->userInfo;
		if($this->user_model->is_super())
		{
			$data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `is_delete`='0'")->result_array();
		} else {
			$data['branch'] = $this->db->query("SELECT * FROM `branch` WHERE `id`='$branch' AND `is_delete`='0'")->result_array();
		}
		$this->load->view('header',$data);
		$this->load->view('sidebar',$data);
		$this->load->view('voucher/History',$data);
	}
//===================================show student wise history of fee==========================
	public function create_history()
	{
		$this->user_model->check_permissions("voucher/fee_history");
		$branch = $this->user_model->getBranch();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
		$data['userInfo'] = $this->userInfo;
		if($this->input->post())
		{
			
			$grno = $this->input->post("gr",true);
			//var_dump($grno);die();
			$this->db->select("student.student_name,invoice.student_id,invoice.id,section.section_name,class.class_name,student.grno,promotion.id as pid,student.father_name,student.student_contact,invoice.fee_pack,invoice.late_fine,branch.name,invoice.id,invoice.date,invoice.date_expire,branch.contact,branch.b_logo,invoice.is_admitted");
			$this->db->join("promotion","invoice.student_id=promotion.id");
			$this->db->join("student","student.id=promotion.student_id");
			$this->db->join("branch","invoice.branch_id=branch.id");
			$this->db->join("class","promotion.class_id=class.class_id");
			$this->db->join("section","promotion.section_id=section.section_id");
			$this->db->where("student.grno",$grno);
			$this->db->where("invoice.is_delete",'0');
			$this->db->where("student.branch",$branch);
			$this->db->order_by("promotion.id","DESC");
			$data['detail']= $this->db->get("invoice")->row_array();
			//var_dump($data);die();
			//var_dump('<pre>',$data['detail']);die();
			if($data['detail']=='')
				{
				redirect("voucher/fee_history","refresh");
				}
			else{
			$pro_id_array=$this->voucher_model->getPromotionArray($data['detail']['pid']);
			$this->db->select("*");
			$this->db->from("invoice");
			$this->db->where('is_delete',0);
			$this->db->where_in("invoice.student_id",$pro_id_array);
			$data['fee']=$this->db->get()->result_array();
			//var_dump($data['other_fee']);die();
			$data['b_header'] = @$this->db->query("SELECT `title`,`tagline`,`short_address`,`phone_no`,`email`,`logo1`,`logo2` FROM `branch` WHERE  `is_delete`='0'")->result_array()[0];
			$this->load->view('printable/Fee_history',$data);
			}

				
		}
	}

//==============================================getBadDebtors=========================================================

	public function getBadDebtors()
	{
		$bad_debtors=$this->voucher_model->getBadDebtors();
		var_dump('<pre>',$bad_debtors);die();
	}
	
//====================================================================================================================	
//==============================================getBadDebtors Amount=========================================================

	public function getBadDebtorsAmount()
	{
		$bad_debtors_amount=$this->voucher_model->getBadDebtorsAmount();
		var_dump('<pre>',$bad_debtors_amount);die();
	}
	
//====================================================================================================================	

	public function check_count_fee()
	{
		$res=$this->voucher_model->countTotalFee("6971");
		//var_dump($res);die();
	}
//==============================================Left student fee clearance=========================================================
	
	public function left_fee_clearance()
	{
		$this->user_model->check_permissions("voucher/left_fee_clearance");
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
		$data['userInfo'] = $this->userInfo;

		$this->load->view('header',$data);
		$this->load->view('sidebar',$data);
		$this->load->view('voucher/left_fee_clearance_form',$data);
	}

	public function clear_left_fee()
	{
		$grno=$this->input->post()['grno'];
		$branch = $this->user_model->getBranch();
		if(!empty($grno)) {
			$this->db->select('student.*,promotion.id as pro_id')->join('promotion','student.id=promotion.student_id');
			$this->db->where('student.grno',$grno)->where('student.branch',$branch)->where('student.status!=','0')->where('promotion.is_active',1)->where('promotion.is_delete',0);
			$student=$this->db->get('student')->row_array();
			if(!empty($student)) {
				$promotion_array=$this->voucher_model->getPromotionArray($student['pro_id']);
				$lastv=$this->db->where_in('student_id',$promotion_array)->where('is_delete',0)->order_by('id','DESC')->get('invoice')->row_array();
				if(!empty($lastv)) {
					redirect('voucher/view/'.$lastv['id']);
				}else{
					redirect('voucher/left_fee_clearance');
				}
			}else{
				redirect('voucher/left_fee_clearance');
			}
		}else{
			redirect('voucher/left_fee_clearance');
		}
	}

//====================================================================================================================	
//=====================================adjust arrears===============================================================

public function arrears_form($succuss='')
      {
		if($succuss=='success') {
			$data['success']=true;
		}else {
			$data['success']=false;
		}
        $this->user_model->check_permissions("Voucher/arrears_form");
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $branch=$this->user_model->getbranch();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        
        //===========================================
        
        //calling views
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('voucher/arrears_form',$data);

      }

	public function getArrearStudent()
	{
		$grno=$this->input->post()['grno'];
		$data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
		//var_dump($grno);die();
		if($grno!='') {
			$this->db->select('student.*,promotion.id as promotion_id')->where('student.grno',$grno)->where('promotion.is_active',1)->where('promotion.is_delete',0)->where('student.branch',$this->user_model->getbranch());
			$this->db->join('promotion','promotion.student_id=student.id');
			$data['student']=$this->db->get('student')->result_array()[0];

			if (empty($data['student'])) {
				redirect('Voucher/arrears_form','refresh');
			}
			else {
				$this->load->view('header',$data);
                $this->load->view('sidebar',$data);
                $this->load->view('voucher/enter_arrear',$data);
                $this->load->view('footer',$data);
			}
		}
	}

//==================================================================================================================

	public function apply_arrear()
	{
		if($this->input->post()) {
			$data=$this->input->post();
			$promotion_id=$data['promotion_id'];
			//=========================================================================
			$date=date('Y-m');
            $prev_month=date('Y-m',strtotime($date."this month"));
            $this->db->select("*");
            $this->db->from('invoice');
            $this->db->where('student_id',$promotion_id);
            $this->db->where('left(date,7)',$prev_month);
            $this->db->order_by('id','DESC');
            $prev_month_voucher=$this->db->get()->row_array();
			//=========================================================================
			if($prev_month_voucher['status']==0) {
				$arrear=array(
					"remaining"=>$prev_month_voucher['remaining']+$data['arrear'],
					"status"=>1
				);
				$this->db->where('id',$prev_month_voucher['id']);
				$this->db->update('invoice',$arrear);
			}
			else{
				$arrear=array(
					"remaining"=>$prev_month_voucher['remaining']+$data['arrear'],
				);
				$this->db->where('id',$prev_month_voucher['id']);
				$this->db->update('invoice',$arrear);
			}
			redirect(base_url().'Voucher/arrears_form/success','refresh');
		}
	}
//=========================================================================================

}
