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

    public function YearlyIncomeReport($year='')
    {
        $branch=$this->report_model->getBranch()[0];
        if($year=='')
        $year=date('Y');
        $yearly_month_array=array("$year-01"=>'',"$year-02"=>'',"$year-03"=>'',"$year-04"=>'',"$year-05"=>'',"$year-06"=>'',"$year-07"=>'',"$year-08"=>'',"$year-09"=>'',"$year-10"=>'',"$year-11"=>'',"$year-12"=>'');
        $monthly_values=array("$year-01"=>'',"$year-02"=>'',"$year-03"=>'',"$year-04"=>'',"$year-05"=>'',"$year-06"=>'',"$year-07"=>'',"$year-08"=>'',"$year-09"=>'',"$year-10"=>'',"$year-11"=>'',"$year-12"=>'');
        //var_dump('<pre>',$yearly_month_array);die();
        foreach ($yearly_month_array as $selected_month=>$value) {
            $this->db->select('*');
            $this->db->from('invoice');
            $this->db->where('left(invoice.date,7)',$selected_month);
            $this->db->where('branch_id',$branch['id']);
            $this->db->where('is_delete',0);
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
                 //var_dump($selected_month);die();    
                 //if($selected_month=='2016-08')
                 //var_dump('<pre>',$voucher);die();
                 $fee_pack=$voucher['fee_pack'];

//=====================getting promotion id and checking if student has been given discount and subtracting discount if given=========================================
                 $promotion_id=$voucher['student_id'];
                 $this->db->select('student.grno,student.student_name,student.disc_type,student.disc_value');
                 $this->db->join('student','promotion.student_id=student.id');
                 $this->db->where('promotion.id',$promotion_id);
                 $discount=$this->db->get('promotion')->row_array();
                 if(!empty($discount['disc_type'])) {
                    if($discount['disc_type']=="percentage")
						{
							$disc = ($fee_pack * $discount['disc_value']) / 100;
							$fee_pack = $fee_pack - $disc;
						}elseif($discount['disc_type']=="rupees")
						{
							$fee_pack = $fee_pack - $discount['disc_value'];
						}
                 }
//===================================================================================================================================


//===================>adding admission fee if student has been admitted too===========================================================
                 if($voucher['is_admitted']==1) {
                     $fee_pack+=$voucher['admin_fee'];
                 }
//====================================================================================================================================

//===================>if previous voucher not paid add arrears+fine to feepack========================================================
                $prev_month=date('Y-m',strtotime('-1 month',strtotime($selected_month)));
                $this->db->select('*');
                $this->db->where('is_delete',0);
                $this->db->where('student_id',$voucher['student_id']);
                $this->db->where('LEFT(date,7)',$prev_month);
                //$this->db->where('status',0);
                $prev_month_vouchers=$this->db->get('invoice')->result_array();
                $arrears=0;
                if(!empty($prev_month_vouchers)){
                    foreach ($prev_month_vouchers as $current_voucher) {
                        if($current_voucher['status']==0) {
                            if(!empty($discount['disc_type'])) {
                                    if($discount['disc_type']=="percentage")
                                    {
                                        $arrear_disc = ($current_voucher['fee_pack'] * $discount['disc_value']) / 100;
                                        $arrear_fee_pack = $current_voucher['fee_pack'] - $disc;
                                    }elseif($discount['disc_type']=="rupees")
                                    {
                                        $arrear_fee_pack = $current_voucher['fee_pack'] - $discount['disc_value'];
                                    }
                                    $fine = ($current_voucher['fee_pack']*$current_voucher['late_fine'])/100;
                                    $arrear_fee_pack+=$fine;
                                    $arrears+=$arrear_fee_pack;
                                    
                                }
                                
                                if($current_voucher['is_admitted']==1) {
                                    $arrears+=$current_voucher['admin_fee'];
                                }

                                $current_voucher_id=$current_voucher['id'];
                                $this->db->select('fee_installment.amount');
                                $this->db->where('fee_installment.is_delete',0);
                                $this->db->where('fee_installment.invoice',$current_voucher_id);
                                $this->db->join('invoice','invoice.id=fee_installment.invoice');
                                $prev_other_fee=$this->db->get('fee_installment')->result_array();

                                foreach ($prev_other_fee as  $selected_prev_other_fee) {
                                    $arrears+=$selected_prev_other_fee['amount'];
                                }
                        }
                        elseif ($current_voucher['status']==1) {
                            $arrears+=$current_voucher['remaining'];
                        }
         
                    }
                }

                $fee_pack+=$arrears;
//====================================================================================================================================

//============================>checking for other fee, if present add to total fee=====================================================

                $voucher_id=$voucher['id'];
                $this->db->select('fee_installment.amount');
                $this->db->where('fee_installment.is_delete',0);
                $this->db->where('fee_installment.invoice',$voucher_id);
                $this->db->join('invoice','invoice.id=fee_installment.invoice');
                $other_fee=$this->db->get('fee_installment')->result_array();

                foreach ($other_fee as  $selected_other_fee) {
                    $fee_pack+=$selected_other_fee['amount'];
                }

//=====================================================================================================================================

                $monthly_values[$selected_month]['total_fee']+=$fee_pack;
                $monthly_values[$selected_month]['fee_recieved']+=$voucher['recieved'];                
                $monthly_values[$selected_month]['fee_remaining']+=$fee_pack-$voucher['recieved'];                
            }
        }//end of yealy vouchers foreach

//=====================================get total expense month wise=====================================================================
        reset($monthly_values);
        foreach ($monthly_values as $month_name => $v) {
            $this->db->select('sum(amount)');
            $this->db->where('left(date,7)',$month_name);
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
        $this->load->view('report/YearlyIncomeReport',$data);
    }
    
    

}

