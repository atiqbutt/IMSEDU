<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Voucher Class
 *
 * @package     Edusol
 * @subpackage  Fee
 * @author      Sabeeh Murtaza
 * @link        http://facebook.com/sabeehking
 */

class Voucher_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function countTotalFee($id=0)
    {
        $total = 0;
        if($id!=0)
        {
            $d = $this->db->select("invoice.student_id,invoice.fee_pack,invoice.late_fine,invoice.admin_fee,invoice.is_admitted,invoice.status,invoice.date_expire")->from("invoice")->where("invoice.is_delete","0")->where("invoice.id",$id)->get()->row();
            $e = $this->db->select("sum(fee_installment.amount) as other_fee")->from("fee_installment")->where("fee_installment.is_delete",'0')->where("invoice",$id)->get()->row();
            $add_months = @$this->db->where('invoice_id',$id)->where('is_delete',0)->get('fee_add_months')->result_array();
            $total += $d->fee_pack;
            $total += $e->other_fee;
            //$lastv = @$this->db->query("SELECT `id`,`status`,`advance`,`remaining`,`late_fine`,`fee_pack` FROM  `invoice` WHERE  `student_id` =  '".$d->student_id."' AND  `id` <  '".$id."' AND is_delete='0'  ORDER BY  `id` DESC ")->result_array()[0];
            $lastv = @$this->getLastVoucher($d->student_id,$id)[0];
            
            if(date("Y-m-d",strtotime($d->date_expire))<=date("Y-m-d") && $d->status==0)
            {
                if($lastv['advance']>0)
                $total = $total + ((($total-$lastv['advance']) * $d->late_fine) / 100);
                else
                $total = $total + (($total * $d->late_fine) / 100);
                if(!empty($add_months)) {
					foreach ($add_months as $key => $value) {
                        $total+=$value['fee'];
						$total += ($value['fee'] * $d->late_fine) / 100;
					}
				}
            }
            elseif(!empty($add_months)) {
                foreach ($add_months as $key => $value) {
                    $total+=$value['fee'];
                }
            }
            if($d->is_admitted==1)
            {
                $total += $d->admin_fee;
            }
            $total = $this->countArrears($id,$d->student_id,$total);
            return $total;
        }
    }
    
    public function getLastVoucher($pro_id,$inv_id)
    {
        //=================>getting all promotion id array of current voucher============================
            
        $student_id_actual=$this->db->select('student_id')->where('id',$pro_id)->get('promotion')->row_array()['student_id'];
        $promotion_id_assoc_array=$this->db->select('id')->where('student_id',$student_id_actual)->get('promotion')->result_array();
        if(!empty($promotion_id_assoc_array)) {
        	foreach ($promotion_id_assoc_array as $key => $value) {
	        $promotion_id_array[]=$value['id'];
	        }
        }
        else {
        	$promotion_id_array[]=$pro_id;
        }
        //var_dump($promotion_id_array);die();
        
        //=================>end of getting promotion id array logic============================
        
        return @$this->db->select('*')->where_in('invoice.student_id',$promotion_id_array)->where('invoice.id<',$inv_id)->where('invoice.is_delete',0)->order_by('invoice.id','DESC')->get('invoice')->result_array();
    }

    public function countTotalFee_WithoutArears_WithoutOtherFee($id=0)
    {
        $total = 0;
        if($id!=0)
        {
            $d = $this->db->select("invoice.student_id,invoice.fee_pack,invoice.late_fine,invoice.admin_fee,invoice.is_admitted,invoice.status,invoice.date_expire")->from("invoice")->where("invoice.is_delete","0")->where("invoice.id",$id)->get()->row();
            $total += $d->fee_pack;
            if(date("Y-m-d",strtotime($d->date_expire))<=date("Y-m-d") && $d->status==0)
            {
                $total = $total + (($total * $d->late_fine) / 100);;
            }
            if($d->is_admitted==1)
            {
                $total += $d->admin_fee;
            }
            return $total;
        }
    }

    public function countTotalFee_WithoutOtherFee($id=0)
    {
        $total = 0;
        if($id!=0)
        {
            $d = $this->db->select("invoice.student_id,invoice.fee_pack,invoice.late_fine,invoice.admin_fee,invoice.is_admitted,invoice.status,invoice.date_expire")->from("invoice")->where("invoice.is_delete","0")->where("invoice.id",$id)->get()->row();
            $total += $d->fee_pack;
            if(date("Y-m-d",strtotime($d->date_expire))<=date("Y-m-d") && $d->status==0)
            {
                $total = $total + (($total * $d->late_fine) / 100);
            }
            if($d->is_admitted==1)
            {
                $total += $d->admin_fee;
            }
            $total = $this->countArrears($id,$d->student_id,$total);
            return $total;
        }
    }

    public function getArrearsAmount($id=0,$std_id=0)
    {
        $total=0;
        $lastv = $this->db->query("SELECT `id`,`student_id`,`is_admitted`,`admin_fee`,`status`,`advance`,`remaining`,`late_fine`,`fee_pack` FROM  `invoice` WHERE `id` <>  '$id' AND  `student_id` =  '".$std_id."' AND  `id` <  '".$id."' AND is_delete='0'  ORDER BY  `id` DESC ")->row();
        if($lastv)
        {
            if($lastv->status==1)
            {
                $data['lastadv'] = $lastv->advance;
                $data['lastrem'] = $lastv->remaining;
            }else{
                $lastv_items = $this->db->select("sum(amount) as sum")->from("fee_installment")->where("invoice",$lastv->id)->where("is_delete","0")->get()->row();
                $calc_total = $lastv->fee_pack + $lastv_items->sum;
                $calc = $calc_total + (($calc_total * $lastv->late_fine) / 100);
                if($lastv->is_admitted==1) {
                    $calc+=$lastv->admin_fee;
                }
                $data['lastadv'] = 0;
                $data['lastrem'] = $calc;
            }
        $total -= $data['lastadv'];
        $total += $data['lastrem'];
        }
        return $total;
    }

    public function countArrears($id=0,$std_id=0,$total=0)
    {
        //$lastv = $this->db->query("SELECT `id`,`status`,`advance`,`remaining`,`late_fine`,`fee_pack` FROM  `invoice` WHERE  `student_id` =  '".$std_id."' AND  `id` <  '".$id."' AND is_delete='0'  ORDER BY  `id` DESC ")->result_array();
        
        
        //=================>getting all promotion id array of current voucher============================
        
        $student_id_actual=$this->db->select('student_id')->where('id',$std_id)->get('promotion')->row_array()['student_id'];
        $promotion_id_assoc_array=$this->db->select('id')->where('student_id',$student_id_actual)->get('promotion')->result_array();
        
        foreach ($promotion_id_assoc_array as $key => $value) {
	    $promotion_id_array[]=$value['id'];
	}
        //var_dump($promotion_id_array);die();
        
        //=================>end of getting promotion id array logic============================
        
        $lastv = $this->db->select('*')->where_in('invoice.student_id',$promotion_id_array)->where('invoice.id<',$id)->where('invoice.is_delete',0)->order_by('invoice.id','DESC')->get('invoice')->result_array();
        
        $data['lastadv'] = 0;
	    $data['lastrem'] = 0;
        if($lastv && $lastv[0]['status']==1)
        {
		$data['lastadv'] = $lastv[0]['advance'];
		$data['lastrem'] = $lastv[0]['remaining'];
		
		$total -= $data['lastadv'];
		$total += $data['lastrem'];
        }
        
        elseif($lastv && $lastv[0]['status']==0)
        {
	    $i=0;
	    while(isset($lastv[$i]['status']) && $lastv[$i]['status']!=1) {
	    	//var_dump($lastv[$i]['id']);
	                $lastv_items = $this->db->select("sum(amount) as sum")->from("fee_installment")->where("invoice",$lastv[$i]['id'])->where("is_delete","0")->get()->row();
	                $calc_total = $lastv[$i]['fee_pack'] + $lastv_items->sum;
	                $calc = $calc_total + (($calc_total * $lastv[$i]['late_fine']) / 100);
                    $last_add_months=@$this->db->where('invoice_id',$lastv[$i]['id'])->where('is_delete',0)->get('fee_add_months')->result_array();
                    foreach ($last_add_months as $key => $value) {
                        $calc+=$value['fee'];
						$calc += ($value['fee'] * $lastv[$i]['late_fine']) / 100;
                    }
	                
	                $data['lastadv'] = 0;
	                $data['lastrem'] += $calc;
		        $total -= $data['lastadv'];
		        $total += $calc;
		        $i++;
		        //var_dump($total);
		        //var_dump($data['lastrem']);
	        }
	        //var_dump("hello");
	        //die();
	        //last paid voucher
	    if(isset($lastv[$i]['status']) && $lastv[$i]['status']==1){
	    		//var_dump($lastv[$i]['status']);die();
		    	$data['lastadv'] = $lastv[$i]['advance'];
			$data['lastrem'] = $lastv[$i]['remaining'];
			
			$total -= $data['lastadv'];
			$total += $data['lastrem'];
		}
		 //var_dump($total);die();
		 //end last paid voucher
	        //echo "end while";die();
        }
        return $total;
    }

    public function getDiscountedFee($promotion_id='',$fee_pack='')
    {
       if($promotion_id!='' && $fee_pack!='') {
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
            return $fee_pack;
       }
    }

//===========================================Fee History===============================
    public function fee_history($month=0,$id=0)
    {
        $mnth=date("Y-m",strtotime($month));
        //var_dump($mnth);die();
        $fromDate = date("Y-m", strtotime("-1 months",strtotime($month)));
        //var_dump($fromDate);die();
        $this->db->select("*");
        $this->db->from("invoice");
        $this->db->where("invoice.student_id",$id);
        $this->db->where("LEFT(invoice.date,7)",$fromDate);
        $previous_voucher=@$this->db->get()->result_array()[0];
        //var_dump($previous_voucher);
        if(empty($previous_voucher))
        {

               return false;
        }
        else
        {      
            if($previous_voucher['status']==1) 
            {
                if($previous_voucher['remaining']!=0)
                {
                    return $previous_voucher['remaining'];
                }
                else
                {
                    return 0;
                }
            }
           
            
            elseif($previous_voucher['status']==0) 
            {
                $fine=($previous_voucher['fee_pack']*$previous_voucher['late_fine'])/100;
                return $arrear=$previous_voucher['fee_pack']+$fine;
            }
        }
    }
//===============================other fee calculations==================================

public function total_other_fee($invoice_id=0)
    {
        $this->db->select("*");
        $this->db->from("fee_installment");
        $this->db->where("invoice",$invoice_id);
        $this->db->where("is_delete",0);
        $other_fee=$this->db->get()->result_array();
        $total_other_fee=0;
        //var_dump($other_fee);
            if(!empty($other_fee))
            {
                foreach ($other_fee as $key => $value) {
                    $total_other_fee+=$value['amount'];
                }
                return $total_other_fee;
            }
            else
            {
                return 0;
            }
    }

public function other_fee($invoice_id=0)
    {
        $this->db->select("*");
        $this->db->from("fee_installment");
        $this->db->where("invoice",$invoice_id);
        $this->db->where("is_delete",0);
        $other_fee=$this->db->get()->result_array();
        //var_dump($other_fee);
            if(!empty($other_fee))
            {
                return $other_fee;
            }
            else
            {
                return false;
            }
    }

    public function getBadDebtors()
    {
       $this->db->select('promotion.id as promotion_id,student.id as student_id,student.student_name,student.status');
       $this->db->join('promotion','promotion.student_id=student.id');
       $this->db->where('student.status!=',0);
       $this->db->where('student.branch',$this->user_model->getBranch());
       $non_active_students= $this->db->get('student')->result_array();

       foreach ($non_active_students as $key=> $selected_student) {
           $this->db->select('*');
           $this->db->where('student_id',$selected_student['promotion_id']);
           $this->db->where('is_delete',0);
           $non_active_students[$key]['vouchers']=$this->db->get('invoice')->result_array();
       }

    //if u want to revert back to old query delele order_by clause and change row_array to result_array from above query

       foreach ($non_active_students as $key => $selected_student) {
           if(empty($selected_student['vouchers']))
                unset($non_active_students[$key]);
       }

       foreach ($non_active_students as $key => $selected_student) {
           $total_vouchers_of_selected_student=count($selected_student['vouchers']);
           $start_deleteting=false;
           for ($i=$total_vouchers_of_selected_student-1; $i>=0 ; $i--) {
               if($selected_student['vouchers'][$i]['status']==1)
               $start_deleteting=true;
               if($start_deleteting==true)
               unset($selected_student['vouchers'][$i]);
           }
       }

       return $non_active_students; 

    }

    //old logic changed for multi_month vouchers
    
    public function getBadDebtorsAmount()
    {   
        $bad_debtors_amount=0;
        $BadDebtors=$this->getBadDebtors();
        foreach ($BadDebtors as $selectedBadDebtors) {
            foreach ($selectedBadDebtors['vouchers'] as $selected_voucher) {
                $fee_pack=$selected_voucher['fee_pack'];
                if($selected_voucher['is_admitted']==1)
                $fee_pack+=$selected_voucher['admin_fee'];
                $bad_debtors_amount+=$fee_pack;
                $sum_add_months=@$this->db->query("select sum(fee) as total_add_months from fee_add_months where invoice_id=".$selected_voucher['fee_pack'])->row_array()['total_add_months'];
                $bad_debtors_amount+=$sum_add_months;
            }
        }
        return $bad_debtors_amount;
    }

    // public function getBadDebtorsAmount()
    // {   $bad_debtors_amount=0;
    //     $BadDebtors=$this->getBadDebtors();
    //     foreach ($BadDebtors as $selectedBadDebtors) {
    //         $bad_debtors_amount+=$this->countTotalFee($selectedBadDebtors['vouchers']['id']);
    //     }
    //     return $bad_debtors_amount;
    // }
    
    public function getVoucherContactNumber($id='')
    {
        if($id!='') {
            return $this->db->select('student.student_name,student.father_contact')->join('promotion','invoice.student_id=promotion.id')->join('student','student.id=promotion.student_id')->where('invoice.id',$id)->get('invoice')->row_array();
        }
    }
    
    public function getPromotionArray($pro_id='')
    {
	//=================>getting all promotion id array of current voucher============================
            
        $student_id_actual=$this->db->select('student_id')->where('id',$pro_id)->get('promotion')->row_array()['student_id'];
        $promotion_id_assoc_array=$this->db->select('id')->where('student_id',$student_id_actual)->get('promotion')->result_array();
        if(!empty($promotion_id_assoc_array)) {
        	foreach ($promotion_id_assoc_array as $key => $value) {
	        $promotion_id_array[]=$value['id'];
	        }
        }
        else {
        	$promotion_id_array[]=$pro_id;
        }
        //var_dump($promotion_id_array);die();
        
        //=================>end of getting promotion id array logic============================
        return $promotion_id_array;
    }
    

}

