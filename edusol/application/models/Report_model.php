<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * staff Class
 *
 * @package     edusol
 * @subpackage  Report
 * @author      Sabeeh Murtaza
 * @link        http://facebook.com/sabeehking
 */

class Report_model extends CI_Model {
    
    private $is_super;
    private $branch;

    public function __construct()
    {
        parent::__construct();
        $this->is_super = $this->user_model->is_super();
        $this->branch = $this->user_model->getBranch();
    }

    public function getBranch()
    {
        $this->db->select("id,name"); 
        $this->db->from('branch');
        $this->db->where('is_delete','0');
        if(!$this->is_super)
            $this->db->where('id',$this->branch);
        return $this->db->get()->result_array();
    }

    public function BranchHeader()
    {
        $this->db->select("*"); 
        $this->db->from('branch');
        $this->db->where('is_delete','0');
        $this->db->where('id',$this->branch);
        return $this->db->get()->row_array();
    }

	public function ClassInfo($id=0)
	{
		if($id!=0)
		{
			$this->db->select("class_id,class.class_name");
			$this->db->from("class");
			$this->db->where("class.is_delete",0);
			$this->db->where("class.class_id",$id);
			return $this->db->get()->row();
		}
	}

	public function SectionInfo($id=0)
	{
		if($id!=0)
		{
			$this->db->select("section_id,section.section_name");
			$this->db->from("section");
			$this->db->where("section.is_delete",0);
			$this->db->where("section.section_id",$id);
			return $this->db->get()->row();
		}
	}

	public function SessionInfo($id=0)
	{
		if($id!=0)
		{
			$this->db->select("id,name");
			$this->db->from("session");
			$this->db->where("is_delete",0);
			$this->db->where("id",$id);
			return $this->db->get()->row();
		}
	}

	public function ExamInfo($id=0)
	{
		if($id!=0)
		{
			$this->db->select("id,name");
			$this->db->from("exam");
			$this->db->where("is_delete",0);
			$this->db->where("id",$id);
			return $this->db->get()->row();
		}
	}

    public function StudentDetails($id=0)
    {
        if($id!=0)
        {
            $this->db->select("student.*,class.class_name,section.section_name"); 
            $this->db->from('student');
            $this->db->join('promotion',"promotion.student_id=student.id");
            $this->db->join('class',"promotion.class_id=class.class_id");
            $this->db->join('section',"promotion.section_id=section.section_id");
            //$this->db->where('student.status','0');
            $this->db->where('promotion.id',$id);
            $this->db->where('promotion.is_delete',"0");
            $this->db->where('class.is_delete',"0");
            $this->db->where('section.is_delete',"0");
            return $this->db->get()->row();
        }
    }

    public function ExamsResult($exams=0,$student=0)
    {
        if( !empty($exams) AND !empty($student))
        {
            $data = [];
            $exam = json_decode(base64_decode($exams),true);
            unset($exam[0]);
            
            foreach($exam as $key=>$value)
            {
                $this->db->select("result.id,exam.name"); 
                $this->db->from('student');
                $this->db->join('promotion',"promotion.student_id=student.id");
                $this->db->join('result',"result.promotion_id=promotion.id");
                $this->db->join('exam',"exam.id=result.exam_id");
                //$this->db->where('student.status','0');
                $this->db->where('promotion.id',$student);
                $this->db->where('result.exam_id',$value);
                $this->db->where('promotion.is_delete',"0");
                $this->db->where('result.is_delete',"0");
                $data[] = $this->db->get()->row();
                 
            }
            return $data;
        }
    }

    public function getSessions()
    {
        return $this->db->query("SELECT * FROM `session` WHERE `is_delete`='0'")->result_array();
    }

    public function SectionWiseExamStudents($branch=0,$class=0,$section=0,$exam=0)
    {
        if($branch!=0 AND $class!=0 AND $section!=0 AND $exam!=0)
        {
            $this->db->select('(LEFT(result.position, (char_length(result.position) - 2)) * 1) as position_refined, result.id as result_id,student.grno,student.dob,student.student_name,student.father_name,result.obtained_marks,result.total_marks, result.position,result.attendance');
            $this->db->from('result');
            $this->db->join('promotion','promotion.id=result.promotion_id');
            $this->db->join('student','student.id=promotion.student_id');
            //$this->db->where('student.status',0);
            $this->db->where('promotion.is_delete',0);
            $this->db->where('promotion.class_id',$class);
            $this->db->where('promotion.section_id',$section);
            $this->db->where('student.branch',$branch);
            $this->db->where('result.exam_id',$exam);
            $this->db->order_by('result.obtained_marks','DESC');
            return $this->db->get()->result();
           
        }
    }

    public function SectionWiseStudents($branch=0,$class=0,$section=0,$session=0)
    {
        if($branch!=0 AND $class!=0 AND $section!=0 AND $session!=0)
        {
            $this->db->select('promotion.id, student.grno, student.student_name, student.father_name');
            $this->db->from('student');
            $this->db->join('promotion','student.id=promotion.student_id');
            //$this->db->where('student.status',0);
            $this->db->where('promotion.is_delete',0);
            $this->db->where('promotion.class_id',$class);
            $this->db->where('promotion.section_id',$section);
            $this->db->where('promotion.session_id',$session);
            $this->db->where('student.branch',$branch);
            return $this->db->get()->result();
        }
    }

	public function getSubjectMarks($result=0)
	{
		if($result!=0)
		{
			$this->db->select("rs.total_marks,rs.passing_marks,rs.obtained_marks");
			$this->db->from("result_subject as rs");
                        $this->db->join('subject','subject.id=rs.subject_id');
			$this->db->where("rs.is_delete",0)->where('subject.is_deleted',0);
			$this->db->where("rs.result_id",$result);
			return $this->db->get()->result();
		}
	}

	public function getSubjectMark($id=0)
	{
		if($id!=0)
		{
			$this->db->select("rs.total_marks,rs.passing_marks,rs.obtained_marks,rs.paper_date");
			$this->db->from("result_subject as rs");
			$this->db->where("rs.is_delete",0);
			$this->db->where("rs.id",$id);
			return $this->db->get()->row();
		}
	}

	public function getSubjectNames($result=0)
	{
		if($result!=0)
		{
			$this->db->select("result_subject.id, subject.name,result_subject.passing_marks,result_subject.total_marks");
			$this->db->from("subject");
			$this->db->join("result_subject","result_subject.subject_id=subject.id");
			$this->db->where("result_subject.is_delete",0);
			$this->db->where("subject.is_deleted",0);
			$this->db->where("result_subject.result_id",$result);
			return $this->db->get()->result();
		}
	}

	public function getClassSubjectNames($class=0,$section=0)
	{
		if($class!=0 AND $section!=0)
		{
			$this->db->select("id,name");
			$this->db->from("subject");
			$this->db->where("is_deleted",0);
			$this->db->where("class_id",$class);
			$this->db->where("section_id",$section);
			return $this->db->get()->result();
		}
	}

    public function getHeader($exam,$session)
    {
        return "                            </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='super_container' style='margin-top:100px;'>
                <div class='page_break clear'>
                    <div class='watermark_wrapper'>
                        <div class='watermark'></div>
                    </div>
                    <div class='super_wrapper'>
                        <div class='wrapper left2 left'>
                            <div class='header'>
                                <div class='wd-100 clear'>
                                    <div class=' text-left left '>
                                        <img src='http://imsdadlaghari.com/edusol/images/1420573990590abfad82170.png' style='width:50px;height:50px;'>
                                    </div>
                                    <div class=' text-left right '>
                                        <img src='http://imsdadlaghari.com/edusol/images/1420573990590abfad82170.png' style='width:50px;height:50px;'>
                                    </div>
                                    <div style=''>
                                        <center><h1>IQRA MODEL SCHOOL DADLAGHARI</h1></center>
                                        <center><i><h3 style='color:#000 !important;'>$exam Consolidate Sheet For session $session</h3></i></center>
                                        <center><h3 class='boxed' style='margin-top:0px !important;font-size:23px;'>Result Sheet</h3></center>
                                    </div>
                                </div>
                            
                            </div>
                            <div class='body'>
                                <table class='tbl1'>";
    }

}

