<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
		$this->user_model->check_login("home");
		$this->load->model("voucher_model");
    }

	public function index()
	{
		$branch = $this->user_model->getBranch();
		$data['menu'] = $this->load_model->menu();
		$data['base_url'] = base_url();
		$data['userInfo'] = $this->user_model->userInfo("first_name,last_name");
		$month = date("Y-m");
		$month_last = date("Y-m",strtotime(date('Y-m')." -1 month"));
                $data['userInfo'] = $this->user_model->userInfo("first_name,last_name");
		$date=date("Y-m-d");
                 $year=date('Y');
		$lastyear=date('Y', strtotime(date('Y-m')." -1 year"));
		if($this->user_model->is_super())
		{
    $data['total']['bank_recpt_curr']=$this->db->query("SELECT sum(amount) as total FROM `bank_recpt` where main_head_id=5  and LEFT(`date`,7)='$month'")->result_array()[0]['total'];
			$data['total']['branch'] = $this->db->query("SELECT count(*) as total FROM `branch` WHERE `is_delete`='0'")->result_array()[0]['total'];
			$data['total']['student'] = $this->db->query("SELECT count(*) as total FROM `student` INNER JOIN `promotion` ON `promotion`.`student_id`=`student`.`id` inner join `class` on `class`.`class_id`=`promotion`.`class_id` inner join `section` on `section`.`section_id`=`promotion`.`section_id`  WHERE `student`.`status`='0' AND `promotion`.`is_active`='1' AND `promotion`.`is_delete`='0' and `class`.`is_delete`=0 and `section`.`is_delete`=0")->result_array()[0]['total'];
			$data['total']['staff'] = $this->db->query("SELECT count(*) as total FROM `staff` WHERE `status`='0'")->result_array()[0]['total'];
			$data['total']['teacher'] = $this->db->query("SELECT count(*) as total FROM `teacher` WHERE `status`='0'")->result_array()[0]['total'];
			$data['total']['class'] = $this->db->query("SELECT count(*) as total FROM `class` WHERE `is_delete`='0'")->result_array()[0]['total'];
			$data['total']['section'] = $this->db->query("SELECT count(*) as total FROM `section` WHERE `is_delete`='0'")->result_array()[0]['total'];
			//$data['total']['fee_recieved'] = $this->db->query("SELECT sum(`recieved`) as total FROM `invoice` WHERE `is_delete`='0' AND `status`='1' AND LEFT(`date`,7)='$month'")->result_array()[0]['total'];
			$last_total_recipt=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` where  main_head_id=4 and left(date,7)='$month_last'")->result_array()[0]['total'];
			$last_total_payemnt=$this->db->query("SELECT sum(amount) as total FROM `cash_voucher` where  main_head_id=4 and left(date,7)='$month_last'")->result_array()[0]['total'];
			$last_total_deposit=$this->db->query("SELECT sum(amount) as total FROM `cash_deposit` where  main_head_id=4 and left(date,7)='$month_last'")->result_array()[0]['total'];
			$last_total_bankpaymnt=$this->db->query("SELECT sum(amount) as total FROM `bank_payment` where  main_head_id=4 and left(date,7)='$month_last'")->result_array()[0]['total'];
			$last_total_bankrecpt=$this->db->query("SELECT sum(amount) as total FROM `bank_recpt` where  main_head_id=4 and left(date,7)='$month_last'")->result_array()[0]['total'];
			$data['total']['last_expense'] = $last_total_recipt+$last_total_payemnt+$last_total_deposit+$last_total_bankpaymnt+$last_total_bankrecpt;
			$data['total']['balance'] = $this->db->query("SELECT sum(o_balance) as total FROM `bank_def`")->result_array()[0]['total'];


$paid_salry=$this->db->query("SELECT sum(total_amount) as total FROM `salary` where  is_paid=1 ")->result_array()[0]['total'];
$data['total']['paid_salry']=$paid_salry;
			$curr_total_recipt=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` where  main_head_id=4 and left(date,7)='$month'")->result_array()[0]['total'];
			$curr_total_payemnt=$this->db->query("SELECT sum(amount) as total FROM `cash_voucher` where  main_head_id=4 and left(date,7)='$month'")->result_array()[0]['total'];
			$curr_total_deposit=$this->db->query("SELECT sum(amount) as total FROM `cash_deposit` where  main_head_id=4 and left(date,7)='$month'")->result_array()[0]['total'];
			$curr_total_bankpaymnt=$this->db->query("SELECT sum(amount) as total FROM `bank_payment` where  main_head_id=4 and left(date,7)='$month'")->result_array()[0]['total'];
			$curr_total_bankrecpt=$this->db->query("SELECT sum(amount) as total FROM `bank_recpt` where  main_head_id=4 and left(date,7)='$month'")->result_array()[0]['total'];
			$data['total']['curr_expense'] = $curr_total_recipt+$curr_total_payemnt+$curr_total_deposit+$curr_total_bankpaymnt+$curr_total_bankrecpt;
			
			$today_total_recipt=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` where  main_head_id=4 and date='$date'")->result_array()[0]['total'];
			$today_total_payemnt=$this->db->query("SELECT sum(amount) as total FROM `cash_voucher` where  main_head_id=4 and date='$date'")->result_array()[0]['total'];
			$today_total_deposit=$this->db->query("SELECT sum(amount) as total FROM `cash_deposit` where  main_head_id=4 and date='$date'")->result_array()[0]['total'];
			$today_total_bankpaymnt=$this->db->query("SELECT sum(amount) as total FROM `bank_payment` where  main_head_id=4 and date='$date'")->result_array()[0]['total'];
			$today_total_bankrecpt=$this->db->query("SELECT sum(amount) as total FROM `bank_recpt` where  main_head_id=4 and date='$date'")->result_array()[0]['total'];
			$data['total']['today_expense'] = $today_total_recipt+$today_total_payemnt+$today_total_deposit+$today_total_bankpaymnt+$today_total_bankrecpt;
            $data['total']['fee_recieved_last'] = $this->db->query("SELECT sum(`recieved`) as total FROM `invoice` INNER join promotion on promotion.id=invoice.student_id inner join student on promotion.student_id=student.id WHERE invoice.status='1' and invoice.is_delete=0  AND LEFT(invoice.date,7)='$month_last'")->result_array()[0]['total'];
             $total_fee= $this->db->query("SELECT sum(`recieved`) as total FROM `invoice` INNER join promotion on promotion.id=invoice.student_id inner join student on promotion.student_id=student.id WHERE invoice.status='1'  and invoice.is_delete=0 ")->result_array()[0]['total'];
		$cash_deposit=$this->db->query("SELECT SUM( amount ) AS total FROM  `cash_deposit` WHERE  main_head_id =5")->result_array()[0]['total'];
		$data['total']['last_cash_deposit']=$this->db->query("SELECT SUM( amount ) AS total FROM  `cash_deposit` WHERE  main_head_id =5 and left(date,7)='$month_last' and is_delete='0'")->result_array()[0]['total'];
		$data['total']['curr_cash_deposit']=$this->db->query("SELECT SUM( amount ) AS total FROM  `cash_deposit` WHERE  main_head_id =5 and left(date,7)='$month'")->result_array()[0]['total'];
		//$total_fee-$cash_deposit;
$data['total']['cash_hand']=$total_fee-$cash_deposit;	
 $cash_recpt=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` where main_head_id=5 ")->result_array()[0]['total'];
$cashreceipt=$this->db->query("SELECT sum(amount) as total FROM `cash_voucher` where main_head_id=5 ")->result_array()[0]['total'];     
   $bank_recpt=$this->db->query("SELECT sum(amount) as total FROM `bank_recpt` where main_head_id=5")->result_array()[0]['total'];
	$data['total']['incom']=$total_fee+$cashreceipt;
	
	$data['total']['salary_pen']=$this->db->query("SELECT sum(total_amount) as total FROM `salary` where month='$month_last' and is_paid=0 ")->result_array()[0]['total'];
        $data['total']['overall_expense']=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` where  main_head_id=4")->result_array()[0]['total'];
$data['total']['profit']=$data['total']['incom']- $data['total']['overall_expense'];
			$data['total']['today_fee_recieved'] = $this->db->query("SELECT sum(`recieved`) as total FROM `invoice` WHERE `is_delete`='0' AND `status`='1' AND `submitted_at`='$date'")->result_array()[0]['total'];
			$data['total']['fee_remaining'] = $this->db->query("SELECT sum(`remaining`) as total FROM `invoice` WHERE `is_delete`='0' AND `status`='1' AND LEFT(`date`,7)='$month'")->result_array()[0]['total'];
$data['branches']=$this->db->query("SELECT branch.name as bname,(SELECT count(*) as total FROM `student` INNER JOIN `promotion` ON `promotion`.`student_id`=`student`.`id` inner join `class` on `class`.`class_id`=`promotion`.`class_id` inner join `section` on `section`.`section_id`=`promotion`.`section_id`  WHERE `student`.`status`='0' AND `promotion`.`is_active`='1' AND `promotion`.`is_delete`='0' and `class`.`is_delete`=0 and `section`.`is_delete`=0 and student.branch=branch.id) as std_count from branch WHERE branch.is_delete='0'   ")->result_array();
 $data['att_present']=$this->db->query("SELECT  COUNT(studentatt.id) as att_count,(Select COUNT(student.id) as total from student WHERE  student.status='0') as std_count from studentatt INNER join student on student.id=studentatt.student_id WHERE is_deleted='0' AND date='$date' AND status_id='1'")->result_array()[0];
		    $data['att_leave']=$this->db->query("SELECT  COUNT(studentatt.id) as att_count,(Select COUNT(student.id) as total from student WHERE  student.status='0') as std_count from studentatt INNER join student on student.id=studentatt.student_id WHERE is_deleted='0' AND date='$date' AND status_id='3'")->result_array()[0];
		    $data['att_shortleave']=$this->db->query("SELECT  COUNT(studentatt.id) as att_count,(Select COUNT(student.id) as total from student WHERE  student.status='0') as std_count from studentatt INNER join student on student.id=studentatt.student_id WHERE is_deleted='0' AND date='$date' AND status_id='4'")->result_array()[0];
		    $data['att_absent']=$this->db->query("SELECT  COUNT(studentatt.id) as att_count,(Select COUNT(student.id) as total from student WHERE  student.status='0' ) as std_count from studentatt INNER join student on student.id=studentatt.student_id WHERE is_deleted='0' AND date='$date' AND status_id='2'")->result_array()[0];
$data['graph_student']=$this->db->query("SELECT COUNT(id) as count,month(date_of_admission) as MonthNum FROM `student` WHERE year(date_of_admission)='$year' group by month(date_of_admission)")->result_array();

            $data['graph_studentlast']=$this->db->query("SELECT COUNT(id) as count,month(date_of_admission) as MonthNum FROM `student` WHERE year(date_of_admission)='$lastyear' group by month(date_of_admission)")->result_array();		
            $data['total']['fee_due_inv'] = $this->db->query("SELECT sum(`fee_pack`) as total FROM `invoice` WHERE `is_delete`='0' AND `status`='0' AND `date_expire`>'$date' AND LEFT(`date`,7)='$month'")->result_array()[0]['total'];
			$data['total']['fee_defaulter_inv'] = $this->db->query("SELECT sum(`fee_pack`) as total FROM `invoice` WHERE `is_delete`='0' AND `status`='0' AND `date_expire`<='$date' AND LEFT(`date`,7)='$month'")->result_array()[0]['total'];
			$data['total']['fee_arrears_sub'] = $this->db->query("SELECT sum(`remaining`) as total FROM `invoice` WHERE `is_delete`='0' AND `status`='1' AND LEFT(`date`,7)='$month_last'")->row()->total;
			$data['total']['fee_arrears_nsub'] = $this->db->query("SELECT  sum( round( (fee_pack + ( (late_fine * fee_pack) / 100 ) ) ,2) ) as total FROM  `invoice` WHERE `is_delete` =  '0' AND `status`='0' AND LEFT(  `date` , 7 ) =  '$month_last'")->row()->total;
			//=========================================================calculating expected fee==================================================================================================================================
			//$data['total']['fee_expected'] = $this->db->query("SELECT  sum(student.monthly_fee) as total FROM  `student` inner join `promotion` on `promotion`.`student_id`=`student`.`id` WHERE promotion.`is_delete` =  '0' AND student.`status`='0' AND promotion.is_active = '1'")->row()->total;
			//====================================================================================================================================================================================================================
		  $data['total']['other_fee']=$this->db->query("SELECT SUM( fee_installment.amount ) AS total FROM invoice INNER JOIN fee_installment ON invoice.id = fee_installment.invoice inner join `promotion` on `promotion`.`id`=`invoice`.`student_id` inner join `student` ON `student`.`id`=`promotion`.`student_id` WHERE invoice.is_delete =0 AND invoice.status=1 and promotion.is_delete='0' and promotion.`is_active`='1' and `student`.`status`='0'")->row()->total;
$data['total']['overall_expense']=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` where main_head_id=4")->result_array()[0]['total'];
}else{
     $data['total']['other_fee']=$this->db->query("SELECT SUM( fee_installment.amount ) AS total FROM invoice INNER JOIN fee_installment ON invoice.id = fee_installment.invoice inner join `promotion` on `promotion`.`id`=`invoice`.`student_id` inner join `student` ON `student`.`id`=`promotion`.`student_id` WHERE invoice.is_delete =0 AND invoice.status=1 and promotion.is_delete='0' and promotion.`is_active`='1' and student.`branch`='$branch' and `student`.`status`='0'")->row()->total;

			$data['total']['branch'] = $this->db->query("SELECT count(*) as total FROM `branch` WHERE `is_delete`='0'")->result_array()[0]['total'];
			$data['total']['student'] = $this->db->query("SELECT count(*) as total FROM `student` INNER JOIN `promotion` ON `promotion`.`student_id`=`student`.`id` inner join `class` on `class`.`class_id`=`promotion`.`class_id` inner join `section` on `section`.`section_id`=`promotion`.`section_id`  WHERE `student`.`status`='0' AND `student`.`branch`='$branch' AND `promotion`.`is_active`='1' AND `promotion`.`is_delete`='0' and `class`.`is_delete`=0 and `section`.`is_delete`=0")->result_array()[0]['total'];
			$data['total']['staff'] = $this->db->query("SELECT count(*) as total FROM `staff` WHERE `status`='0' AND `branch`='$branch'")->result_array()[0]['total'];
			$data['total']['teacher'] = $this->db->query("SELECT count(*) as total FROM `teacher` WHERE `status`='0' AND `branch`='$branch'")->result_array()[0]['total'];
			$data['total']['balance'] = $this->db->query("SELECT sum(o_balance) as total FROM `bank_def` where branch=$branch")->result_array()[0]['total'];
			
			$data['total']['last_cash_deposit']=$this->db->query("SELECT SUM(amount ) AS total FROM  `cash_deposit` WHERE  main_head_id =5 and branch=$branch and left(date,7)='$month_last' and is_delete='0'")->result_array()[0]['total'];
		$data['total']['curr_cash_deposit']=$this->db->query("SELECT SUM( amount ) AS total FROM  `cash_deposit` WHERE  main_head_id =5 and left(date,7)='$month' and branch=$branch and is_delete='0'")->result_array()[0]['total'];
		$data['total']['salary_pen']=$this->db->query("SELECT sum(total_amount) as total FROM `salary` where month='$month_last' and is_paid=0 and branch=$branch")->result_array()[0]['total'];
		$paid_salry=$this->db->query("SELECT sum(total_amount) as total FROM `salary` where is_paid=1 and branch=$branch and month='$month_last'")->result_array()[0]['total'];
			
			$data['total']['paid_salry']=$paid_salry;
			
			$last_total_recipt=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` where branch=$branch and main_head_id=4 and left(date,7)='$month_last'")->result_array()[0]['total'];
			$last_total_payemnt=$this->db->query("SELECT sum(amount) as total FROM `cash_voucher` where branch=$branch and main_head_id=4 and left(date,7)='$month_last'")->result_array()[0]['total'];
			$last_total_deposit=$this->db->query("SELECT sum(amount) as total FROM `cash_deposit` where branch=$branch and main_head_id=4 and left(date,7)='$month_last'")->result_array()[0]['total'];
			$last_total_bankpaymnt=$this->db->query("SELECT sum(amount) as total FROM `bank_payment` where branch=$branch and main_head_id=4 and left(date,7)='$month_last'")->result_array()[0]['total'];
			$last_total_bankrecpt=$this->db->query("SELECT sum(amount) as total FROM `bank_recpt` where branch=$branch and main_head_id=4 and left(date,7)='$month_last'")->result_array()[0]['total'];
			$data['total']['last_expense'] = $last_total_recipt+$last_total_payemnt+$last_total_deposit+$last_total_bankpaymnt+$last_total_bankrecpt;

			$curr_total_recipt=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` where branch=$branch and main_head_id=4 and left(date,7)='$month'")->result_array()[0]['total'];
			$curr_total_payemnt=$this->db->query("SELECT sum(amount) as total FROM `cash_voucher` where branch=$branch and main_head_id=4 and left(date,7)='$month'")->result_array()[0]['total'];
			$curr_total_deposit=$this->db->query("SELECT sum(amount) as total FROM `cash_deposit` where branch=$branch and main_head_id=4 and left(date,7)='$month'")->result_array()[0]['total'];
			$curr_total_bankpaymnt=$this->db->query("SELECT sum(amount) as total FROM `bank_payment` where branch=$branch and main_head_id=4 and left(date,7)='$month'")->result_array()[0]['total'];
			$curr_total_bankrecpt=$this->db->query("SELECT sum(amount) as total FROM `bank_recpt` where branch=$branch and main_head_id=4 and left(date,7)='$month'")->result_array()[0]['total'];
			$data['total']['curr_expense'] = $curr_total_recipt+$curr_total_payemnt+$curr_total_deposit+$curr_total_bankpaymnt+$curr_total_bankrecpt;
			
			$today_total_recipt=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` where branch=$branch and main_head_id=4 and date='$date'")->result_array()[0]['total'];
			$today_total_payemnt=$this->db->query("SELECT sum(amount) as total FROM `cash_voucher` where branch=$branch and main_head_id=4 and date='$date'")->result_array()[0]['total'];
			$today_total_deposit=$this->db->query("SELECT sum(amount) as total FROM `cash_deposit` where branch=$branch and main_head_id=4 and date='$date'")->result_array()[0]['total'];
			$today_total_bankpaymnt=$this->db->query("SELECT sum(amount) as total FROM `bank_payment` where branch=$branch and main_head_id=4 and date='$date'")->result_array()[0]['total'];
			$today_total_bankrecpt=$this->db->query("SELECT sum(amount) as total FROM `bank_recpt` where branch=$branch and main_head_id=4 and date='$date'")->result_array()[0]['total'];
			$data['total']['today_expense'] = $today_total_recipt+$today_total_payemnt+$today_total_deposit+$today_total_bankpaymnt+$today_total_bankrecpt;
			
			$data['total']['class'] = $this->db->query("SELECT count(*) as total FROM `class` WHERE `is_delete`='0' AND `branch`='$branch'")->result_array()[0]['total'];
			$data['total']['section'] = $this->db->query("SELECT count(*) as total FROM `section` WHERE `is_delete`='0' AND `branch`='$branch'")->result_array()[0]['total'];
			$data['total']['fee_recieved'] = $this->db->query("SELECT sum(`recieved`) as total FROM `invoice` WHERE `is_delete`='0' AND `status`='1' AND `branch_id`='$branch' AND LEFT(`date`,7)='$month'")->result_array()[0]['total'];
			$data['total']['fee_recieved_last'] = $this->db->query("SELECT sum(`recieved`) as total FROM `invoice` INNER join promotion on promotion.id=invoice.student_id inner join student on promotion.student_id=student.id WHERE invoice.status='1' AND invoice.branch_id='$branch' and invoice.is_delete=0   AND LEFT(invoice.date,7)='$month_last'")->result_array()[0]['total'];
			
			 $total_fee= $this->db->query("SELECT sum(`recieved`) as total FROM `invoice` INNER join promotion on promotion.id=invoice.student_id inner join student on promotion.student_id=student.id WHERE invoice.status='1' AND invoice.branch_id='$branch' and invoice.is_delete=0 ")->result_array()[0]['total'];
		$cash_deposit=$this->db->query("SELECT SUM( amount ) AS total FROM  `cash_deposit` WHERE branch =$branch AND main_head_id =5")->result_array()[0]['total'];
		//$total_fee-$cash_deposit;
		$data['total']['overall_expense']=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` where branch=$branch and main_head_id=4")->result_array()[0]['total'];
               
        $cash_recpt=$this->db->query("SELECT sum(amount) as total FROM `cash_voucher` where  branch=$branch")->result_array()[0]['total'];
        $bank_recpt=$this->db->query("SELECT sum(amount) as total FROM `bank_recpt` where main_head_id=5 and branch=$branch")->result_array()[0]['total'];
	
$data['total']['incom']=$total_fee+$cash_recpt;

	$val1=$data['total']['incom'];
$data['total']['bank_recpt']=$bank_recpt;
$data['total']['bank_recpt_curr']=$this->db->query("SELECT sum(amount) as total FROM `bank_recpt` where main_head_id=5 and branch=$branch and LEFT(`date`,7)='$month'")->result_array()[0]['total'];
	$val=($data['total']['curr_expense']+$data['total']['last_expense']);
	$data['total']['profit']=$data['total']['incom']-$data['total']['overall_expense'];
	$data['total']['cash_hand']=$data['total']['incom']-$cash_deposit-$data['total']['overall_expense'];

	
			$data['total']['today_fee_recieved'] = $this->db->query("SELECT sum(`recieved`) as total FROM `invoice` WHERE `is_delete`='0' AND `status`='1' AND `branch_id`='$branch' AND `submitted_at`='$date'")->result_array()[0]['total'];
			//$data['total']['fee_remaining'] = $this->db->query("SELECT sum(`remaining`) as total FROM `invoice` WHERE `is_delete`='0' AND `status`='1' AND `branch_id`='$branch' AND LEFT(`date`,7)='$month'")->result_array()[0]['total'];
			$data['total']['fee_due_inv'] = $this->db->query("SELECT sum(`fee_pack`) as total FROM `invoice` WHERE `is_delete`='0' AND `status`='0' AND `date_expire`>'$date' AND `branch_id`='$branch' AND LEFT(`date`,7)='$month'")->result_array()[0]['total'];
			$data['total']['fee_defaulter_inv'] = $this->db->query("SELECT sum(`fee_pack`) as total FROM `invoice` WHERE `is_delete`='0' AND `status`='0' AND `date_expire`<='$date' AND `branch_id`='$branch' AND LEFT(`date`,7)='$month'")->result_array()[0]['total'];
            $data['total']['fee_arrears_sub'] = $this->db->query("SELECT sum(`remaining`) as total FROM `invoice` WHERE `branch_id` =  '$branch' AND `is_delete`='0' AND `status`='1' AND LEFT(`date`,7)='$month_last'")->row()->total;
            $data['total']['fee_arrears_nsub'] = $this->db->query("SELECT  sum( round( (fee_pack + ( (late_fine * fee_pack) / 100 ) ) ,2) ) as total FROM  `invoice` WHERE `branch_id`='$branch' AND `is_delete` =  '0' AND `status`='0' AND LEFT(  `date` , 7 ) =  '$month_last'")->row()->total;
//=======================================================calculting expected fee=========================================================================================================
			$this->db->select('invoice.*');
            $this->db->from('invoice');
            $this->db->join('promotion','invoice.student_id=promotion.id');
            $this->db->join('student','student.id=promotion.student_id');
            $this->db->where('student.status',0);
            $this->db->where('promotion.is_delete',0);
            $this->db->where('promotion.is_active',1);
            $this->db->where('left(invoice.date,7)',date('Y-m'));
            $this->db->where('invoice.branch_id',$this->user_model->getBranch());
            $this->db->where('invoice.is_delete',0);
            $this_month_vouchers=$this->db->get()->result_array();
			$expected_fee=0;

			foreach ($this_month_vouchers as $key => $voucher) {
           
                $calc_fee=$this->voucher_model->countTotalFee($voucher['id']);
                $expected_fee+=$calc_fee;
                               
            }

			$data['total']['fee_expected'] =round($expected_fee);
			//$data['total']['fee_expected'] = $this->db->query("SELECT  sum(student.monthly_fee) as total FROM  `student` inner join `promotion` on `promotion`.`student_id`=`student`.`id` WHERE promotion.`is_delete` =  '0' AND student.`status`='0' AND promotion.is_active = '1' and student.branch='$branch'")->row()->total;
//=====================================================================================================================================================================================
//$data['total']['fee_remaining']=0;
$data['total']['fee_remaining']=$data['total']['fee_expected']-$data['total']['fee_recieved'];
$data['branches']=$this->db->query("SELECT branch.name as bname,(SELECT count(*) as total FROM `student` INNER JOIN `promotion` ON `promotion`.`student_id`=`student`.`id` inner join `class` on `class`.`class_id`=`promotion`.`class_id` inner join `section` on `section`.`section_id`=`promotion`.`section_id`  WHERE `student`.`status`='0' AND `promotion`.`is_active`='1' AND `promotion`.`is_delete`='0' and `class`.`is_delete`=0 and `section`.`is_delete`=0 and student.branch=branch.id ) as std_count from branch WHERE branch.is_delete='0' and branch.id='$branch'")->result_array();
 $data['att_present']=$this->db->query("SELECT  COUNT(studentatt.id) as att_count,(Select COUNT(student.id) as total from student WHERE  student.status='0' AND branch='$branch') as std_count from studentatt INNER join student on student.id=studentatt.student_id WHERE studentatt
.is_deleted='0' AND studentatt.date='$date' AND studentatt.status_id='1' AND student.branch='$branch'")->result_array()[0];
		    $data['att_leave']=$this->db->query("SELECT  COUNT(studentatt.id) as att_count,(Select COUNT(student.id) as total from student WHERE  student.status='0' AND branch='$branch') as std_count from studentatt INNER join student on student.id=studentatt.student_id WHERE studentatt.is_deleted='0' AND studentatt.date='$date' AND studentatt.status_id='3' AND student.branch='$branch'")->result_array()[0];
		    $data['att_shortleave']=$this->db->query("SELECT  COUNT(studentatt.id) as att_count,(Select COUNT(student.id) as total from student WHERE  student.status='0' AND branch='$branch') as std_count from studentatt INNER join student on student.id=studentatt.student_id WHERE studentatt.is_deleted='0' AND studentatt.date='$date' AND studentatt.status_id='4' AND student.branch='$branch'")->result_array()[0];
		    $data['att_absent']=$this->db->query("SELECT  COUNT(studentatt.id) as att_count,(Select COUNT(student.id) as total from student WHERE  student.status='0' AND branch='$branch') as std_count from studentatt INNER join student on student.id=studentatt.student_id WHERE studentatt.is_deleted='0' AND studentatt.date='$date' AND studentatt.status_id='2' AND student.branch='$branch'")->result_array()[0];
$data['graph_student']=$this->db->query("SELECT COUNT(id) as count,month(date_of_admission) as MonthNum FROM `student` WHERE year(date_of_admission)='$year' AND branch='$branch' group by month(date_of_admission)")->result_array();

            $data['graph_studentlast']=$this->db->query("SELECT COUNT(id) as count,month(date_of_admission) as MonthNum FROM `student` WHERE year(date_of_admission)='$lastyear' AND branch='$branch' group by month(date_of_admission)")->result_array();		
}
		$this->load->view('header',$data);
		$this->load->view('sidebar',$data);
		$this->load->view('home/dashboard',$data);
	}
}
