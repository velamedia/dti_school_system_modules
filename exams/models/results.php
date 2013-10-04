<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 *
 * @author 		www.velamedia.biz
 * @package 	PyroCMS
 * @subpackage 	Exams Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Results extends MY_Model {

	public function __construct()
	{
		switch (ENVIRONMENT)
		{
			case 'local':
			case 'dev':
				$this->db->db_debug = TRUE;
			break;

			case 'development':
				$this->db->db_debug = TRUE;
			break;

			case 'qa':
			case 'live':
				$this->db->db_debug = FALSE;
			break;

			default:
				$this->db->db_debug = FALSE;
		}
	}

	public function get_exam($exam)
	{
		$this->db->from($this->db->dbprefix('dti_exams'));
		$this->db->where('id', $exam); 
		$query = $this->db->get();

		return $query->row();
	}

	public function get_course_units_done($exam, $course)
	{
		if($course !=''){
			//get course id
			$courses_table = $this->db->dbprefix('dti_courses');
			$query = $this->db->query("SELECT `id` FROM `$courses_table` WHERE `course_code`='$course'");
			$course_id_object  = $query->row();
			$course_id = $course_id_object->id;

			$exam_results_table = $this->db->dbprefix('dti_exam_results');
	        $query = $this->db->query("SELECT DISTINCT `course_unit_id` FROM `$exam_results_table` WHERE `exam_id`='$exam' AND `course_id`='$course_id'");
	        $course_unit_ids  = $query->result_array();
	    }else{
	    	$exam_results_table = $this->db->dbprefix('dti_exam_results');
	        $query = $this->db->query("SELECT DISTINCT `course_unit_id` FROM `$exam_results_table` WHERE `exam_id`='$exam'");
	        $course_unit_ids  = $query->result_array();
	    }

		return $course_unit_ids;
	}

	public function get_course_units($course_units)
	{
		foreach ($course_units as $course_unit) {
			$course_units_ids[] = $course_unit['course_unit_id'];
		}
		$course_units_idss = implode(',', $course_units_ids);

		$course_units_table = $this->db->dbprefix('dti_course_units');
		
        $query = $this->db->query("SELECT * FROM `$course_units_table` WHERE `id` IN ($course_units_idss)");
        $course_units  = $query->result_array();

		return $course_units;
	}

	public function get_all_course_units()
	{
		$this->db->from($this->db->dbprefix('dti_course_units'));
		$this->db->order_by("unit_code", "asc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_courses($course_units)
	{
		
		foreach ($course_units as $course_unit) {
			$course_unit_id = $course_unit['course_unit_id'];

			$course_units_table = $this->db->dbprefix('dti_course_units');
        	$query = $this->db->query("SELECT `course` FROM `$course_units_table` WHERE `id`='$course_unit_id'");
       		
			$courses[] = $query->row();
		}
		
		foreach ($courses as $course) {
			$course_key = $course->course;
			if (!isset($myArr[$course_key])) {
				$myArr[$course_key] = array($course);
			} 
			else {
				//$myArr[$course_key][] = $course;
			 }
			

		}
		
		return $myArr;
	}

	public function get_course($course_id)
	{
		$this->db->from($this->db->dbprefix('dti_courses'));
		$this->db->where('id', $course_id); 
		$query = $this->db->get();

		return $query->row();
	}

	public function get_exam_results($exam,$course)
	{

		$courses_table = $this->db->dbprefix('dti_courses');
		$course_units_table = $this->db->dbprefix('dti_course_units');
		$exam_results_table = $this->db->dbprefix('dti_exam_results');

		//get course id
		$query = $this->db->query("SELECT `id` FROM `$courses_table` WHERE `course_code`='$course'");
		$course_id_object  = $query->row();
		$course_id = $course_id_object->id;

		//get results and course in that exam
		$query = $this->db->query("SELECT * FROM `$exam_results_table` WHERE `exam_id`='$exam' AND `course_id`='$course_id'");
		$exam_results_array  = $query->result_array();
		
		
		return $exam_results_array;
	}

	public function get_exam_students($exam,$course)
	{
	
		$courses_table = $this->db->dbprefix('dti_courses');
		$course_units_table = $this->db->dbprefix('dti_course_units');
		$exam_results_table = $this->db->dbprefix('dti_exam_results');

		//get course id
		$query = $this->db->query("SELECT `id` FROM `$courses_table` WHERE `course_code`='$course'");
		$course_id_object  = $query->row();
		$course_id = $course_id_object->id;

		$query = $this->db->query("SELECT DISTINCT `student_id` FROM `$exam_results_table` WHERE `exam_id`='$exam' AND `course_id`='$course_id'");
		$student_ids  = $query->result_array();

		return $student_ids;
	}

	public function get_student_profiles($student_ids)
	{
	
		foreach ($student_ids as $student_id) {
			$row = $this->ion_auth->get_user($student_id);  //create new user property that contains user object
			$students[] = $row;
		}

		return $students;
	}

	public function get_student_exam_records($student_id)
	{
		$selected_year = $year;
		
		$courses_table = $this->db->dbprefix('dti_courses');
		$course_units_table = $this->db->dbprefix('dti_course_units');
		$exam_results_table = $this->db->dbprefix('dti_exam_results');

		// //get course id
		// $query = $this->db->query("SELECT `id` FROM `$courses_table` WHERE `course_code`='$course'");
		// $course_id_object  = $query->row();
		// $course_id = $course_id_object->id;

		$query = $this->db->query("SELECT DISTINCT `exam_id` FROM `$exam_results_table` WHERE `student_id`='$student_id'");
		$exams  = $query->result_array();

		return $exams;
	}


	public function get_exams_data($exams_ids)
	{
		
		$exams_table = $this->db->dbprefix('dti_exams');

		foreach ($exams_ids as $exam_id) {
			$id = $exam_id['exam_id'];
			$query = $this->db->query("SELECT * FROM `$exams_table` WHERE `id`='$id'");
			$exam  = $query->row();

			$exams_data[] = $exam;
		}
	
		return $exams_data;
	}

	public function get_student_exam_results($student_id, $exam_id)
	{
		$exam_results_table = $this->db->dbprefix('dti_exam_results');

		$query = $this->db->query("SELECT * FROM `$exam_results_table` WHERE `student_id`='$student_id' AND `exam_id` ='$exam_id'");
		$exam_results  = $query->result_array();

		return $exam_results;
	}
}