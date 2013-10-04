<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 *
 * @author 		www.velamedia.biz
 * @package 	PyroCMS
 * @subpackage 	Perfomance Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Perfomance extends MY_Model {

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

	// public function years()
	// {
	// 	$first_select_option = array('' => '');
	// 	foreach (range(date('Y'), 2000) as $year) {
	// 		$years[$year] = $year;
	// 	}

	// 	//$years = array_merge($first_select_option, $years);
		
	// 	return $years;
	// }

	// public function semesters()
	// {
	// 	return $semesters = array('' =>'', '1' => 'Semester 1', '2' => 'Semester 2');
	// }

	public function get_student_exams_records($student_id)
	{

		$this->db->order_by("id", "desc");
		$exams = $this->db->get_where($this->db->dbprefix('dti_exam_results'), $student_id)->result_array();
		print_r($exams);
		// foreach ($exams as $exam) {
		// 	$selected_exams[$exam['id']] = $exam['name'];
		// }

		return $exams;
	}

	// public function get_all_courses()
	// {
	// 	$this->db->from($this->db->dbprefix('dti_courses'));
	// 	$this->db->order_by("name", "asc");
	// 	$query = $this->db->get();
	// 	$result  = $query->result_array();
		
	// 	$first_select_option = array(0 => '');
	// 	foreach ($result as $course) {
	// 		$courses[$course['id']] = $course['name'];
	// 	}

	// 	$courses = $first_select_option + $courses;
	// 	return $courses;
	// }

	// public function get_all_course_units()
	// {
	// 	$this->db->from($this->db->dbprefix('dti_course_units'));
	// 	$this->db->order_by("unit_code", "asc");
	// 	$query = $this->db->get();
	// 	$result  = $query->result_array();
		
	// 	$first_select_option = array('' => '');
	// 	foreach ($result as $course_unit) {
	// 		$course_units[$course_unit['unit_code']] = $course_unit['name'];
	// 	}

	// 	$course_units = array_merge($first_select_option, $course_units);
	// 	return $course_units;
	// }

	// public function get_specific_course_units($course_units_params)
	// {
	// 	$this->db->order_by("name", "asc");
	// 	$course_units = $this->db->get_where($this->db->dbprefix('dti_course_units'), $course_units_params)->result_array();

	// 	$first_select_option = array(0 => '');
	// 	foreach ($course_units as $course_unit) {
	// 		$selected_course_units[$course_unit['id']] = $course_unit['name'];
	// 	}
	// 	$selected_course_units = $first_select_option + $selected_course_units;
		
	// 	return $selected_course_units;
	// }

	// public function get_course_unit_students($data)
	// {
		
	// 	$year = $data['year'];
	// 	$semester = $data['semester'];
	// 	$course_unitid = $data['course_unit'];
	// 	$course_id = $data['course'];

	// 	//get course code
	// 	$courses_table = $this->db->dbprefix('dti_courses');
	// 	$query = $this->db->query("SELECT `course_code` FROM `$courses_table` WHERE `id`='$course_id'");
	// 	$course_code_object  = $query->row();
	// 	$course_code = $course_code_object->course_code;

	// 	$dti_profiles_table = $this->db->dbprefix('profiles');
 //        $query = $this->db->query("SELECT `user_id` FROM `$dti_profiles_table` WHERE `course_of_study`='$course_code'");
	// 	$results  = $query->result_array();

	// 	$fetched_data = null;
	// 	foreach ($results as $result) {
	// 		//$course_units = explode(',',$result['course_units']);
	// 		//print_r($data);
	// 		//if (in_array($course_unitid, $course_units)) {
	// 			$student_ids[] = $result['user_id'];
	// 		//}
	// 	}

	// 	return $student_ids;
	// }

	// public function get_student_profiles($student_ids)
	// {
	
	// 	foreach ($student_ids as $student_id) {
	// 		$row = $this->ion_auth->get_user($student_id);  //create new user property that contains user object
	// 		$students[] = $row;
	// 	}

	// 	return $students;
	// }
	
	// public function post_exam_results($posted_data)
	// {
	// 	// //get course unit id
	// 	// $course_units_table = $this->db->dbprefix('dti_course_units');
	// 	// $course_unit = $posted_data['course_unit'];
 //  //       $query = $this->db->query("SELECT `id` FROM `$course_units_table` WHERE `unit_code`='$course_unit'");
 //  //       $course_unit_id  = $query->row();
 //  //       $course_unitid = $course_unit_id->id;

	// 	$i =0;
	// 	foreach ($posted_data['student_ids'] as $student_id) {
	// 		$data = array(
	// 			'exam_id'        => $posted_data['exam'],
	// 			'student_id'     => $student_id,
	// 			'course_unit_id' => $posted_data['course_unit'],
	// 			'course_id'      => $posted_data['course'],
	// 			'score'          => $posted_data['scores'][$i],
	// 			'grade'          => $posted_data['grades'][$i]
	// 		);
			
	// 		$this->db->insert($this->db->dbprefix('dti_exam_results'), $data);
	// 	$i++;
	// 	}

	// 	return $this->db->insert_id();
	// }
}