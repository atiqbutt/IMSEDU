<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Report Class
 *
 * @package     edusol
 * @subpackage  Report
 * @author      Sabeeh Murtaza
 * @link        http://facebook.com/sabeehking
 */
class Report extends CI_Controller {

    private $userInfo = array();
    private $is_super;
    private $branch;

    public function __construct()
    {
        parent::__construct();
        $this->user_model->check_login("report");
        $this->userInfo = $this->user_model->userInfo("first_name,last_name");
        $this->is_super = $this->user_model->is_super();
        $this->branch = $this->user_model->getBranch();
        $this->load->model("report_model");
        $this->load->model("voucher_model");
    }

    public function index()
    {
            $this->user_model->check_permissions("Report/index");
            $data['menu'] = $this->load_model->menu();
            $data['base_url'] = base_url();
            $data['userInfo'] = $this->userInfo;
            $data['branch'] = $this->report_model->getBranch();
            $data['session'] = $this->report_model->getSessions();
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('report/index',$data);
            $this->load->view('footer',$data);
    }

    public function SectionWiseResultReport()
    {
        if($this->input->post())
        {
            $branch=$this->user_model->getBranch();
            $class=$this->input->post("class",true);
            $section=$this->input->post("section",true);
            $exam=$this->input->post("exam",true);
            $session=$this->input->post("session",true);
            $data['is_super'] = $this->is_super;
            $data['menu'] = $this->load_model->menu();
            $data['student']=$this->report_model->SectionWiseExamStudents($branch,$class,$section,$exam);
            $data['b_header']= $this->report_model->BranchHeader();
            $data['class']= $this->report_model->ClassInfo($class)->class_name;
            $data['section']= $this->report_model->SectionInfo($section)->section_name;
            $data['session']= $this->report_model->SessionInfo($session)->name;
            $data['exam']= $this->report_model->ExamInfo($exam)->name;
            $this->load->view("report/SectionWiseResultReport",$data);
        }
    }

    public function MultiExamReportSelection()
    {
            $this->user_model->check_permissions("Report/MultiExamReportSelection");
            $data['menu'] = $this->load_model->menu();
            $data['base_url'] = base_url();
            $data['userInfo'] = $this->userInfo;
            $data['branch'] = $this->report_model->getBranch();
            $data['session'] = $this->report_model->getSessions();
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('report/MultiExamReportSelection',$data);
            $this->load->view('footer',$data);
    }

    public function MultiExamReportList()
    {
        if($this->input->post())
        {
            $this->user_model->check_permissions("Report/MultiExamReportSelection");
            $branch = $this->input->post("branch",true);
            $class = $this->input->post("class",true);
            $section = $this->input->post("section",true);
            $session = $this->input->post("session",true);
            $exams = $this->input->post("exams",true);
            $data['menu'] = $this->load_model->menu();
            $data['userInfo'] = $this->userInfo;
            $data['base_url'] = base_url();
            $data['exams'] = base64_encode(json_encode($exams));
            $data['printAllEncoded'] = base64_encode(json_encode(array($branch,$class,$section,$session)));
            $data['student']=$this->report_model->SectionWiseStudents($branch,$class,$section,$session);
            $this->load->view('header',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('report/MultiExamReportList',$data);
            $this->load->view('footer',$data);
        }
    }

    public function MultiExamReportPrint()
    {
        $this->user_model->check_permissions("Report/MultiExamReportSelection");
        if($this->uri->segment(3) AND $this->uri->segment(4) AND $this->uri->segment(5))
        {
            $exams = $this->uri->segment(3);
            $printAllEncoded = json_decode(base64_decode($this->uri->segment(4)));
            $student = $this->uri->segment(5);
            $data['result']=$this->report_model->ExamsResult($exams,$student);
            //var_dump("<pre>",$data['result']);die();
            $data['student']=$this->report_model->StudentDetails($student);
            $data['subjects']=$this->report_model->getClassSubjectNames($printAllEncoded[1],$printAllEncoded[2]);
            $data['b_header']= $this->report_model->BranchHeader();
            $this->load->view('report/MultiExamReportPrint',$data);
        }
    }

    public function MultiExamReportPrintAll()
    {
        $this->user_model->check_permissions("Report/MultiExamReportSelection");
        if($this->uri->segment(3) AND $this->uri->segment(4))
        {
            $exams = $this->uri->segment(3);
            $printAllEncoded = json_decode(base64_decode($this->uri->segment(4)));
            $data['students']=$this->report_model->SectionWiseStudents($printAllEncoded[0],$printAllEncoded[1],$printAllEncoded[2],$printAllEncoded[3]);
            $data['b_header']= $this->report_model->BranchHeader();
            $data['subjects']=$this->report_model->getClassSubjectNames($printAllEncoded[1],$printAllEncoded[2]);
            $data['exams']= $exams;
            $this->load->view('report/MultiExamReportPrintAll',$data);
        }
    }

    public function YearlyFeeReport_select_month()
      {
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        
        //===========================================
        
        //calling views
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('report/select_yearly_FeeReport_month',$data);

      }

    public function YearlyFeeReport($year='')
    {
        if($this->input->post('year'))
    	$year=$this->input->post('year');
        $branch=$this->report_model->getBranch()[0];
        if($year=='')
        $year=date('Y');
        $yearly_month_array=array("$year-01"=>'',"$year-02"=>'',"$year-03"=>'',"$year-04"=>'',"$year-05"=>'',"$year-06"=>'',"$year-07"=>'',"$year-08"=>'',"$year-09"=>'',"$year-10"=>'',"$year-11"=>'',"$year-12"=>'');
        $monthly_values=array("$year-01"=>'',"$year-02"=>'',"$year-03"=>'',"$year-04"=>'',"$year-05"=>'',"$year-06"=>'',"$year-07"=>'',"$year-08"=>'',"$year-09"=>'',"$year-10"=>'',"$year-11"=>'',"$year-12"=>'');
        //var_dump('<pre>',$yearly_month_array);die();
        foreach ($yearly_month_array as $selected_month=>$value) {
            $this->db->select('invoice.*');
            $this->db->from('invoice');
            $this->db->join('promotion','invoice.student_id=promotion.id');
            $this->db->join('student','student.id=promotion.student_id');
            //$this->db->where('student.status',0);
            //$this->db->where('promotion.is_delete',0);
            //$this->db->where('promotion.is_active',1);
            $this->db->where('left(invoice.date,7)',$selected_month);
            $this->db->where('invoice.branch_id',$branch['id']);
            $this->db->where('invoice.is_delete',0);
            $yearly_month_array[$selected_month]=$this->db->get()->result_array();
        }
        //var_dump('<pre>',$yearly_month_array);die();
        foreach ($yearly_month_array as $selected_month=>$all_vouchers) {
            //var_dump($selected_month);die();    
            //if($selected_month=='2016-08')
            //var_dump('<pre>',$all_vouchers);
            $data['b_header']= $this->report_model->BranchHeader();
            $monthly_values[$selected_month]['total_fee']=0;
            $monthly_values[$selected_month]['fee_recieved']=0;
            $monthly_values[$selected_month]['fee_remaining']=0;
            foreach ($all_vouchers as $key => $voucher) {
           
                $calc_fee=$this->voucher_model->countTotalFee($voucher['id']);

                $monthly_values[$selected_month]['total_fee']+=$calc_fee;
                $monthly_values[$selected_month]['fee_recieved']+=$voucher['recieved'];                
                $monthly_values[$selected_month]['fee_remaining']+=$calc_fee-$voucher['recieved'];                
            }
        }//end of yealy vouchers foreach

//=====================================get total expense month wise=====================================================================
        reset($monthly_values);
        foreach ($monthly_values as $month_name => $v) {
            $this->db->select('sum(amount)');
            $this->db->where('left(date,7)',$month_name);
            $this->db->where('branch',$branch['id']);
            $monthly_values[$month_name]['total_expense']=$this->db->get('cash_receipt')->result_array()[0]['sum(amount)'];
        }
        
//======================================================================================================================================

//====================================monthly profit= monthly fee recieved - monthly expense============================================
        // reset($monthly_values);
        // foreach ($monthly_values as $month_namee => $va) {
        //      $monthly_values[$month_namee]['monthly_profit']=$monthly_values[$month_namee]['fee_recieved']-$monthly_values[$month_namee]['total_expense'];
        // }

//=======================================================================================================================================
        //var_dump('<pre>',$monthly_values);die();
        $data['monthly_values']=$monthly_values;
        $this->load->view('report/YearlyFeeReport',$data);
    }
   
    public function FinalAccountReport_select_month()
      {
        $data['is_super'] = $this->user_model->is_super();
        $data['menu'] = $this->load_model->menu();
        $data['base_url'] = base_url();
        $data['userInfo'] = $this->userInfo;
        
        //===========================================
        
        //calling views
        $this->load->view('header',$data);
        $this->load->view('sidebar',$data);
        $this->load->view('report/select_final_accountReport_month',$data);

      }
   
    public function FinalAccountReport($year='')
    {
    	if($this->input->post('year'))
    	$year=$this->input->post('year');
        $branch=$this->report_model->getBranch()[0];
        $data['branch_name']=$this->report_model->getBranch()[0]['name'];
        $data['b_header']= $this->report_model->BranchHeader();
        if($year=='')
        $year=date('Y');
        $next_year=(string)$year+1;
        $yearly_month_array=array("$year-07"=>'',"$year-08"=>'',"$year-09"=>'',"$year-10"=>'',"$year-11"=>'',"$year-12"=>'',"$next_year-01"=>'',"$next_year-02"=>'',"$next_year-03"=>'',"$next_year-04"=>'',"$next_year-05"=>'',"$next_year-06"=>'');
        $monthly_values=array("$year-07"=>'',"$year-08"=>'',"$year-09"=>'',"$year-10"=>'',"$year-11"=>'',"$year-12"=>'',"$next_year-01"=>'',"$next_year-02"=>'',"$next_year-03"=>'',"$next_year-04"=>'',"$next_year-05"=>'',"$next_year-06"=>'');
        foreach ($yearly_month_array as $selected_month=>$value) {
            $this->db->select('invoice.*');
            $this->db->from('invoice');
            $this->db->join('promotion','invoice.student_id=promotion.id');
            $this->db->join('student','student.id=promotion.student_id');
            //$this->db->where('student.status',0);
            //$this->db->where('promotion.is_delete',0);
            //$this->db->where('promotion.is_active',1);
            $this->db->where('left(invoice.date,7)',$selected_month);
            $this->db->where('invoice.branch_id',$branch['id']);
            $this->db->where('invoice.is_delete',0);
            $yearly_month_array[$selected_month]=$this->db->get()->result_array();
        }
        foreach ($yearly_month_array as $selected_month=>$all_vouchers) {

            $monthly_values[$selected_month]['fee_recieved']=0;
            foreach ($all_vouchers as $key => $voucher) {       
                $monthly_values[$selected_month]['fee_recieved']+=$voucher['recieved'];                           
            }
        }//end of yealy vouchers foreach

//=====================================get total cash receipts(table cash vouchers) month wise=====================================================================

        reset($monthly_values);
        foreach ($monthly_values as $month_name => $v) {
            $this->db->select('sum(amount)');
            $this->db->where('left(date,7)',$month_name);
            $this->db->where('is_delete',0);
            $this->db->where('main_head_id',5);
            $this->db->where('branch',$branch['id']);
            $monthly_values[$month_name]['total_cash_receipts']=$this->db->get('cash_voucher')->result_array()[0]['sum(amount)'];
        }

//======================================================================================================================================

//=====================================get total cash Deposit month wise=====================================================================

        reset($monthly_values);
        foreach ($monthly_values as $month_name => $v) {
            $this->db->select('sum(amount)');
            $this->db->where('left(date,7)',$month_name);
            $this->db->where('is_delete',0);
            $this->db->where('branch',$branch['id']);
            $monthly_values[$month_name]['total_cash_deposit']=$this->db->get('cash_deposit')->result_array()[0]['sum(amount)'];
        }

//======================================================================================================================================

//=====================================get total Bank Recept(BHR) month wise=====================================================================

        reset($monthly_values);
        foreach ($monthly_values as $month_name => $v) {
            $this->db->select('sum(amount)');
            $this->db->where('left(date,7)',$month_name);
            $this->db->where('is_delete',0);
            $this->db->where('branch',$branch['id']);
            $monthly_values[$month_name]['total_bank_receipt']=$this->db->get('bank_recpt')->result_array()[0]['sum(amount)'];
        }

//======================================================================================================================================

//=====================================get total expense month wise=====================================================================
        reset($monthly_values);
        foreach ($monthly_values as $month_name => $v) {
            $this->db->select('sum(amount)');
            $this->db->where('left(date,7)',$month_name);
            $this->db->where('is_delete',0);
            $this->db->where('main_head_id',4);
            $this->db->where('branch',$branch['id']);
            $monthly_values[$month_name]['total_expense']=$this->db->get('cash_receipt')->result_array()[0]['sum(amount)'];
        }
        
//======================================================================================================================================

//=====================================get total salary paid month wise=====================================================================

        reset($monthly_values);
        foreach ($monthly_values as $month_name => $v) {
            $this->db->select('sum(total_amount)');
            $this->db->where('month',$month_name);
            $this->db->where('is_paid',1);
            $this->db->where('is_delete',0);
            $this->db->where('branch',$branch['id']);
            $monthly_values[$month_name]['total_salary']=$this->db->get('salary')->result_array()[0]['sum(total_amount)'];
        }

//======================================================================================================================================

//====================================monthly profit= monthly fee recieved - monthly expense============================================
        reset($monthly_values);
        foreach ($monthly_values as $month_namee => $va) {
             $monthly_values[$month_namee]['monthly_profit']=($monthly_values[$month_namee]['fee_recieved']+$monthly_values[$month_namee]['total_cash_receipts'])-$monthly_values[$month_namee]['total_salary']-$monthly_values[$month_namee]['total_expense'];
        }

//=======================================================================================================================================
        //var_dump('<pre>',$monthly_values);die();
        $data['monthly_values']=$monthly_values;
        $this->load->view('report/FinalAccountReport',$data);
    }
    
    public function OtherFeeReport($year='')
    {
        $branch=$this->report_model->getBranch()[0];
        $data['branch_name']=$this->report_model->getBranch()[0]['name'];
        $data['b_header']= $this->report_model->BranchHeader();
        if($year=='')
        $year=date('Y');
        $yearly_month_array=array("$year-01"=>'',"$year-02"=>'',"$year-03"=>'',"$year-04"=>'',"$year-05"=>'',"$year-06"=>'',"$year-07"=>'',"$year-08"=>'',"$year-09"=>'',"$year-10"=>'',"$year-11"=>'',"$year-12"=>'');
        $monthly_values=array("$year-01"=>'',"$year-02"=>'',"$year-03"=>'',"$year-04"=>'',"$year-05"=>'',"$year-06"=>'',"$year-07"=>'',"$year-08"=>'',"$year-09"=>'',"$year-10"=>'',"$year-11"=>'',"$year-12"=>'');
        foreach ($yearly_month_array as $selected_month=>$value) {
            $this->db->select('invoice.*');
            $this->db->from('invoice');
            $this->db->join('promotion','invoice.student_id=promotion.id');
            $this->db->join('student','student.id=promotion.student_id');
            //$this->db->where('student.status',0);
            //$this->db->where('promotion.is_delete',0);
            //$this->db->where('promotion.is_active',1);
            $this->db->where('left(invoice.date,7)',$selected_month);
            $this->db->where('invoice.branch_id',$branch['id']);
            $this->db->where('invoice.is_delete',0);
            $yearly_month_array[$selected_month]=$this->db->get()->result_array();
        }
        foreach ($yearly_month_array as $selected_month=>$all_vouchers) {

            $monthly_values[$selected_month]['total_fee_WithoutOtherFee']=0;
            $monthly_values[$selected_month]['total_other_fee']=0;
            foreach ($all_vouchers as $key => $voucher) {
                $calc_fee=$this->voucher_model->countTotalFee_WithoutOtherFee($voucher['id']);
                $other_fees=$this->voucher_model->other_fee($voucher['id']);

                $monthly_values[$selected_month]['total_fee_WithoutOtherFee']+=$voucher['recieved'];
                if($other_fees) {
                    foreach ($other_fees as $selected_other_fee) {
                        $monthly_values[$selected_month]['total_other_fee']+=$selected_other_fee['amount'];
                    } 
                }
            }
        }//end of yealy vouchers foreach


        //var_dump('<pre>',$monthly_values);die();
        $data['monthly_values']=$monthly_values;
        $this->load->view('report/OtherFeeReport',$data);
    }

    public function billing_summary()
    {
        $data['month']=$month=$this->input->post('month');
		$this->user_model->check_permissions("report/billing_summary");
		$data['is_super'] = $this->user_model->is_super();
		$branch = $this->user_model->getBranch();
		$data['menu'] = $this->load_model->menu();
		$data['base_url'] = base_url();
		$data['userInfo'] = $this->userInfo;
        $voucher_classwise=[];
        $values_classwise=[];

        if(!empty($month)) {
            if($data['is_super']){
            $classes=$this->db->where('is_delete',0)->get('class')->result_array();
             }else{
               $classes=$this->db->where('is_delete',0)->where('branch',$branch)->get('class')->result_array();
             }
            foreach ($classes as $key => $selected_class) {
                $this->db->select('class.class_name,invoice.*');
                $this->db->join('promotion','promotion.id=invoice.student_id');
                $this->db->join('class','promotion.class_id=class.class_id');
                $this->db->where('invoice.is_delete',0);
                $this->db->where('invoice.branch_id',$branch);
                $this->db->where('promotion.class_id',$selected_class['class_id']);
                $this->db->where('left(invoice.date,7)',$month);
                $voucher_classwise[$selected_class['class_name']]=$this->db->get('invoice')->result_array();
                //var_dump($voucher_classwise);die();
            }
            //var_dump('<pre>',$voucher_classwise);die();
            foreach ($voucher_classwise as $k => $selected_class) {
                $total_expected_fee=0;
                $total_fee_recieved=0;
                $total_other_fee=0;
                $total_arrear=0;
                $total_remaining=0;
                foreach ($selected_class as $key => $selected_voucher) {
                    $total_expected_fee+=$this->voucher_model->countTotalFee_WithoutArears_WithoutOtherFee($selected_voucher['id']);
                    //$total_expected_fee+=$selected_voucher['fee_pack'];
                    $total_fee_recieved+=$selected_voucher['recieved'];
                    $total_other_fee+=$this->voucher_model->total_other_fee($selected_voucher['id']);
                    $total_arrear+=$this->voucher_model->getArrearsAmount($selected_voucher['id'],$selected_voucher['student_id']);
                }
                //var_dump($total_remaining);die();
                $values_classwise[$k]['total_expected_fee']=$total_expected_fee;
                $values_classwise[$k]['total_fee_recieved']=$total_fee_recieved;
                $values_classwise[$k]['total_other_fee']=$total_other_fee;
                $values_classwise[$k]['total_arrear']=$total_arrear;
                $values_classwise[$k]['total_remaining']=$total_expected_fee+$total_other_fee+$total_arrear-$total_fee_recieved;
            }
            //var_dump($values_classwise);die();
        }

        $data['values_classwise']=$values_classwise;
          //var_dump("<pre>",$data['values_classwise']);die();
		$this->load->view('header',$data);
		$this->load->view('sidebar',$data);
        $this->load->view('report/billing_summary',$data);
    }

    public function billing_summary_print($month='')
    {
        $data['month']=$month;
		//$this->user_model->check_permissions("report/billing_summary_print");
        $data['b_header']= $this->report_model->BranchHeader();
		$data['is_super'] = $this->user_model->is_super();
		$branch = $this->user_model->getBranch();
		$data['base_url'] = base_url();
		$data['userInfo'] = $this->userInfo;
        $voucher_classwise=[];
        $values_classwise=[];

        if(!empty($month)) {
            if($data['is_super']){
            $classes=$this->db->where('is_delete',0)->get('class')->result_array();
             }else{
               $classes=$this->db->where('is_delete',0)->where('branch',$branch)->get('class')->result_array();
             }
            foreach ($classes as $key => $selected_class) {
                $this->db->select('class.class_name,invoice.*');
                $this->db->join('promotion','promotion.id=invoice.student_id');
                $this->db->join('class','promotion.class_id=class.class_id');
                $this->db->where('invoice.is_delete',0);
                $this->db->where('invoice.branch_id',$branch);
                $this->db->where('promotion.class_id',$selected_class['class_id']);
                $this->db->where('left(invoice.date,7)',$month);
                $voucher_classwise[$selected_class['class_name']]=$this->db->get('invoice')->result_array();
                //var_dump($voucher_classwise);die();
            }
            //var_dump('<pre>',$voucher_classwise);die();
            foreach ($voucher_classwise as $k => $selected_class) {
                $total_expected_fee=0;
                $total_fee_recieved=0;
                $total_other_fee=0;
                $total_arrear=0;
                $total_remaining=0;
                foreach ($selected_class as $key => $selected_voucher) {
                    $total_expected_fee+=$this->voucher_model->countTotalFee_WithoutArears_WithoutOtherFee($selected_voucher['id']);
                    //$total_expected_fee+=$selected_voucher['fee_pack'];
                    $total_fee_recieved+=$selected_voucher['recieved'];
                    $total_other_fee+=$this->voucher_model->total_other_fee($selected_voucher['id']);
                    $total_arrear+=$this->voucher_model->getArrearsAmount($selected_voucher['id'],$selected_voucher['student_id']);
                }
                //var_dump($total_remaining);die();
                $values_classwise[$k]['total_expected_fee']=$total_expected_fee;
                $values_classwise[$k]['total_fee_recieved']=$total_fee_recieved;
                $values_classwise[$k]['total_other_fee']=$total_other_fee;
                $values_classwise[$k]['total_arrear']=$total_arrear;
                $values_classwise[$k]['total_remaining']=$total_expected_fee+$total_other_fee+$total_arrear-$total_fee_recieved;
            }
            //var_dump($values_classwise);die();
        }

        $data['values_classwise']=$values_classwise;

        $this->load->view('report/billing_summary_print',$data);
    }
    

}

