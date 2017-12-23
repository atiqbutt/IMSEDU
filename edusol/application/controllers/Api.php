<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  
 * @author      Salman Siddiqui
 * @link       
 */

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo "Welcome to edusolutions web API</br>Please provide method to initiate";
    }

    public function login()
    {
        
        $cnic = $this->input->post('cnic');
        $login = $this->db->query("SELECT * FROM student WHERE father_cnic = '$cnic' ")->result_array();
        if($login){
            $response = array();
            array_push($response,array("msg"=>"true"));
            echo json_encode($response);
        }
        else{
            $response = array();
            array_push($response,array("msg"=>"false"));
            echo json_encode($response);
        }
    }
    public function getStudents()
    {
        
        $cnic = $this->input->post('cnic');
        $login = $this->db->query("SELECT * FROM student WHERE father_cnic = '$cnic'")->result_array();
        $i = 0;
        $response = array();
        foreach ($login as $row)
         {
            $a = $row['id'];
            $promotion = $this->db->query("SELECT * FROM promotion WHERE student_id = '$a' AND is_active = 1")->row_array();
            $image = "";
            if($row['img'] == ""){
                $image = "https://rajeshindia-production.s3.amazonaws.com/uploads/management/image/3/Dummy_Image_Man.jpg";
            }
            else{
                $image = base_url().$row['img'];
            }
            array_push($response,array("id".$i=>$row['id'],"promid".$i=>$promotion['id'],"img".$i=>$image,"name".$i=>$row['student_name']));
            $i++;
         }
         echo json_encode($response);
    }
    
    public function getLastMonthAttendance()
    {
        
        $id = $this->input->post('id');
        $firstDateOfLastMonth = date('Y-m-d', strtotime('first day of last month'));
        $lastDateOfLastMonth = date('Y-m-d', strtotime('last day of last month'));
        $attandence = $this->db->query("SELECT * FROM studentatt WHERE student_id = '$id' AND `date` BETWEEN '$firstDateOfLastMonth' AND  '$lastDateOfLastMonth' ")->result_array();
        $i = 0;
        $response = array();
        foreach ($attandence as $row)
         {
              
            array_push($response,array("date".$i=>$row['date'],"status".$i=>$row['status_id']));
            $i++;
         }
         echo json_encode($response);
        
    }    
    
    public function getCurrentMonthAttendance()
    {
        
        $id = $this->input->post('id');
        $firstDateOfThisMonth = date('Y-m-d', strtotime('first day of this month'));
        $currentDateOfThisMonth = date('Y-m-d');
        $attandence = $this->db->query("SELECT * FROM studentatt WHERE student_id = '$id' AND `date` BETWEEN '$firstDateOfThisMonth' AND    '$currentDateOfThisMonth'")->result_array();
        $i = 0;
        $response = array();
        foreach ($attandence as $row)
         {
            array_push($response,array("date".$i=>$row['date'],"status".$i=>$row['status_id']));
            $i++;
         }
         echo json_encode($response);
        
    }  
    
    
    public function getResult()
    {
        
        $promId = $this->input->post('id');
        
        $result = $this->db->query("SELECT * FROM result WHERE promotion_id = '$promId' AND is_delete = 0")->result_array();
        $i = 0;
        $response = array();
        foreach ($result as $row)
         {
            $a = $row['exam_id'];
          $exam = $this->db->query("SELECT * FROM exam WHERE id = '$a' AND is_delete = 0")->row_array();
          $b = $exam["etype_id"];
          $examType = $this->db->query("SELECT * FROM exam_type WHERE id = '$b' AND is_delete = 0")->row_array();
            array_push($response,array("id".$i=>$row['id'],"total_marks".$i=>$row['total_marks'],"obtain_marks".$i=>$row['obtained_marks']
            	,"position".$i=>$row['position'],"grade".$i=>$row['grade'],"attendance".$i=>$row['attendance'],"startTime".$i=>$exam['start']
            	,"end".$i=>$exam['end'],"examType".$i=>$examType['name']));
            $i++;
         }
         echo json_encode($response);
        
    }  

    public function getSubjectsResult()
    {
        
        $resultId = $this->input->post('id');
        
        $result = $this->db->query("SELECT * FROM result_subject WHERE result_id = '$resultId' AND is_delete = 0")->result_array();
        $i = 0;
        $response = array();
        foreach ($result as $row)
         {
         	$a = $row['subject_id'];
         	$sub = $this->db->query("SELECT * FROM subject WHERE id = '$a' AND is_deleted = 0")->row_array();
            array_push($response,array("subName".$i=>$sub['name'],"total_marks".$i=>$row['total_marks'],"obtain_marks".$i=>$row['obtained_marks']
            	,"passing_marks".$i=>$row['passing_marks'],"paper_date".$i=>$row['paper_date']));
            $i++;
         }
         echo json_encode($response);
        
    } 
    public function getFee()
    {
        
        $promId = $this->input->post('id');
        //$studentId= $this->db->query("SELECT * FROM promotion WHERE student_id = '$promId' AND is_delete = 0")->result_array();
        $result = $this->db->query("SELECT * FROM invoice WHERE student_id = '$promId' AND is_delete = 0")->result_array();
        $i = 0;
        $remaining = "";
        $response = array();
        //$result = $this->db->query("SELECT * FROM invoice WHERE student_id = '$promId' AND is_delete = 0")->result_array();
            $size =  sizeof($result);
            foreach ($result as $row)
               {
           
            $this->load->model('Voucher_model');
        
                 $remaining = $this->Voucher_model->countTotalFee($row['id']);
                 array_push($response,array("feeAmount".$i=>$row['fee_pack'],"recieved".$i=>$row['recieved'],"remaining".$i=>$row['remaining']
            	,"advance".$i=>$row['advance'],"date".$i=>$row['date'],"date_expire".$i=>$row['date_expire'],"submitted_at".$i=>$row['submitted_at']
            	,"rem".$i=>$remaining ));
            
            $i++;
                }
       
        
        
        
        /*foreach($studentId as $rows){
            $a = $rows['id'];
            
        }*/
        
       
         echo json_encode($response);
        
    } 
    
    public function updateToken(){
        $cnic = $this->input->post('cnic');
        $token = $this->input->post('token');
        $this->db->query("UPDATE `student` SET `token`='$token' WHERE `father_cnic` = '$cnic'");	
}


public function getNotice()
    {
        
        $id = $this->input->post('id');
        
        $notice = $this->db->query("SELECT * FROM notice WHERE std_id = '$id' AND is_delete = 0 ORDER BY date DESC")->result_array();
        $i = 0;
        $response = array();
        foreach ($notice as $row)
         {
            array_push($response,array("date".$i=>$row['date'],"notice".$i=>$row['notice']));
            $i++;
         }
         echo json_encode($response);
        
    }  



   public function getStatus()
    {
    	$url = 'http://fcm.googleapis.com/fcm/send';

$tokens = array();
$tokens[] = "dwdYwxqkc1o:APA91bFq-zTqczClh18EanrTbJQJqtaSJngqiiXF5IDEtMZBWwFKI-qfEhsuL-OKeZyDmtSC5ng7KsU97ZzaUF0biiyfo0GTjJal9RICbqXXdGeFy2RnCHAZME3FEtkp-bGkuSdqA9_J";

$message = array("message" =>"Test Notification");
	$fields = array(
		'registration_ids' => $tokens,
		'data' => $message
		);

	$headers = array(
		'Authorization:key = AIzaSyBm4J7iY6_4BsIDfEt77srY0U6NwmJYtdM',
		'Content-Type: application/json');

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

	$result = curl_exec($ch);
        if($result === FALSE){
		die('Curl Failed' . curl_error($ch));
	}
	curl_close($ch);
	
	echo $result;
        
    }
}
