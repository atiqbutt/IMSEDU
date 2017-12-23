<?php
class Showexam_model extends CI_Model{

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function showStudents()
	{
		//$this->load->database();
		$this->db->select('*');
		$this->db->from('result');
		$this->db->join(' result_subject', 'result_subject.Id = result.Id');
		$query = $this->db->get();
		return $query->result();
 
// Produces: 
// SELECT * FROM students_academic
// JOIN students_personal ON students_personal.studentId = students_academic.studentId

          //Example For Multiple Joins
//$this->db->select('*');
//$this->db->from('blogs');
//$this->db->join('comments', 'comments.id = blogs.id');
//$this->db->join('authors', 'authors.id = comments.author_id');

	}

	public function getTodayPresentStudents($class_id=0,$section_id=0,$mydate)
	{
		if($class_id!=0 AND $section_id!=0)
		{
			$this->db->select("count(student.id) as total");
			$this->db->from("promotion");
			$this->db->join("student","student.id=promotion.student_id");
			$this->db->join("class","class.class_id=promotion.class_id");
			$this->db->join("section","section.section_id=promotion.section_id");
			$this->db->join("studentatt","studentatt.student_id=promotion.student_id");
			$this->db->where("studentatt.status_id","1");
			$this->db->where("studentatt.date",$mydate);
			//$this->db->where("studentatt.date","2016-10-08");
			$this->db->where("studentatt.is_deleted","0");
			$this->db->where("section.is_delete","0");
			$this->db->where("class.is_delete","0");
			$this->db->where("student.status","0");
			$this->db->where("promotion.is_delete","0");
			$this->db->where("promotion.is_active","1");
			$this->db->where("promotion.class_id",$class_id);
			$this->db->where("promotion.section_id",$section_id);
			return $this->db->get()->row()->total;
			//var_dump($this->db->get_compiled_select());die();
		}
	}

	public function getTodayAbsentStudents($class_id=0,$section_id=0,$mydate)
	{
		if($class_id !=0 AND $section_id !=0)
		{
			$this->db->select("count(student.id) as absent");
			$this->db->from("promotion");
			$this->db->join("student","student.id=promotion.student_id");
			$this->db->join("class","class.class_id=promotion.class_id");
			$this->db->join("section","section.section_id=promotion.section_id");
			$this->db->join("studentatt","studentatt.student_id=promotion.student_id");
			$this->db->where("studentatt.status_id","2");
			$this->db->where("studentatt.date",$mydate);
			$this->db->where("studentatt.is_deleted","0");
			$this->db->where("section.is_delete","0");
			$this->db->where("class.is_delete","0");
			$this->db->where("student.status","0");
			$this->db->where("promotion.is_delete","0");
			$this->db->where("promotion.is_active","1");
			$this->db->where("promotion.class_id",$class_id);
			$this->db->where("promotion.section_id",$section_id);
			return $this->db->get()->row()->absent;
           

		}

	}

	public function getTodayLeaveStudents($class_id=0,$section_id=0,$mydate)
	{
		if($class_id !=0 AND $section_id !=0)
		{
			$this->db->select("count(student.id) as l");
			$this->db->from("promotion");
			$this->db->join("student","student.id=promotion.student_id");
			$this->db->join("class","class.class_id=promotion.class_id");
			$this->db->join("section","section.section_id=promotion.section_id");
			$this->db->join("studentatt","studentatt.student_id=promotion.student_id");
			$this->db->where("studentatt.status_id","3");
			$this->db->where("studentatt.date",$mydate);
			$this->db->where("studentatt.is_deleted","0");
			$this->db->where("section.is_delete","0");
			$this->db->where("class.is_delete","0");
			$this->db->where("student.status","0");
			$this->db->where("promotion.is_delete","0");
			$this->db->where("promotion.is_active","1");
			$this->db->where("promotion.class_id",$class_id);
			$this->db->where("promotion.section_id",$section_id);
			return $this->db->get()->row()->l;
           

		}

	}


		public function getTodayShortLeaveStudents($class_id=0,$section_id=0,$mydate)
	{
		if($class_id !=0 AND $section_id !=0)
		{
			$this->db->select("count(student.id) as s");
			$this->db->from("promotion");
			$this->db->join("student","student.id=promotion.student_id");
			$this->db->join("class","class.class_id=promotion.class_id");
			$this->db->join("section","section.section_id=promotion.section_id");
			$this->db->join("studentatt","studentatt.student_id=promotion.student_id");
			$this->db->where("studentatt.status_id","4");
			$this->db->where("studentatt.date",$mydate);
			$this->db->where("studentatt.is_deleted","0");
			$this->db->where("section.is_delete","0");
			$this->db->where("class.is_delete","0");
			$this->db->where("student.status","0");
			$this->db->where("promotion.is_delete","0");
			$this->db->where("promotion.is_active","1");
			$this->db->where("promotion.class_id",$class_id);
			$this->db->where("promotion.section_id",$section_id);
			return $this->db->get()->row()->s;
           
		}

	}

}

?>		

	

