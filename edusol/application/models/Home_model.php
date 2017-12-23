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

class Home_model extends MY_Model {
   
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('user_model');
    }

    public function get_profit_distribute()
    {
        $month = date("Y-m");
		$month_last = date("Y-m",strtotime(date('Y-m')." -1 month"));
        
	
        if($this->user_model->is_super()){
            $paid_salry=$this->db->query("SELECT sum(total_amount) as total FROM `salary` where is_paid=1")->result_array()[0]['total'];
        $overall_expense=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` where main_head_id=4")->result_array()[0]['total'];
        $asset_cash=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` WHERE main_head_id=1 ")->result_array()[0]['total'];	 		
        $cash_recpt=$this->db->query("SELECT sum(amount) as total FROM `cash_voucher` where    main_head_id=5")->result_array()[0]['total'];
        $total_fee= $this->db->query("SELECT sum(`recieved`) as total FROM `invoice` WHERE `status`='1'  and is_delete=0")->result_array()[0]['total'];
        $incom=$total_fee+$cash_recpt;
		$incom-$overall_expense-$asset_cash-$paid_salry;
        }else{
            $branch=$this->user_model->getbranch();
            $paid_salry=$this->db->query("SELECT sum(total_amount) as total FROM `salary` where is_paid=1 and branch=$branch")->result_array()[0]['total'];
        $overall_expense=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` where branch=$branch and main_head_id=4")->result_array()[0]['total'];
        $asset_cash=$this->db->query("SELECT sum(amount) as total FROM `cash_receipt` WHERE main_head_id=1 and `branch`='$branch'")->result_array()[0]['total'];	 		
        $cash_recpt=$this->db->query("SELECT sum(amount) as total FROM `cash_voucher` where  branch=$branch and main_head_id=5")->result_array()[0]['total'];
        $total_fee= $this->db->query("SELECT sum(`recieved`) as total FROM `invoice` WHERE `status`='1' AND `branch_id`='$branch' and is_delete=0")->result_array()[0]['total'];
        $incom=$total_fee+$cash_recpt;
		return $incom-$overall_expense-$asset_cash-$paid_salry;
        }
    }    

}