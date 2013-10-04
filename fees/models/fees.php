<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 *
 * @author 		www.velamedia.biz
 * @package 	PyroCMS
 * @subpackage 	Students School Fees Records Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Fees extends MY_Model {

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

	public function insert_new_payable_item($data)
	{
		$this->db->insert($this->db->dbprefix('dti_fees_payable_items'), $data);
		return $this->db->insert_id(); //return the id of the inserted record
	}

	public function insert_new_fees_paid_record($data)
	{
		$i=0;
		foreach ($data['course_payable_item_ids'] as $payable_item_id) {
			$data_array = array(
				'student_id'      => $data['student_id'],
				'year'            => $data['year'],
				'course_id'       => $data['course_id'],
				'payable_item_id' => $payable_item_id,
				'amount_paid'     => ($data['payable_item_amount'][$i])? $data['payable_item_amount'][$i]:0,
				'balance'         => ($data['payable_item_balance'][$i])? $data['payable_item_balance'][$i]:0,
				'date_paid'       => $data['date_paid']
			);

			$this->db->insert($this->db->dbprefix('dti_fees_paid'), $data_array);
		$i++;
		}

		return $this->db->insert_id(); //return the id of the last inserted record
	}

	public function update_course($data)
	{
		$this->db->update($this->db->dbprefix('dti_exams'), $data);
		return $this->db->insert_id(); //return the id of the inserted record
	}

	public function years()
	{
		$first_select_option = array('' => '');
		foreach (range(date('Y')-1, date('Y')+5) as $year) {
			$years[$year] = $year;
		}

		$years = $first_select_option + $years;
		
		return $years;
	}

	public function semesters()
	{
		return $semesters = array('' =>'', '1' => 'Semester 1', '2' => 'Semester 2');
	}

	public function get_all_courses()
	{
		$this->db->from($this->db->dbprefix('dti_courses'));
		$this->db->order_by("name", "asc");
		$query = $this->db->get();
		$result  = $query->result_array();
		
		$first_select_option = array(0 => '');
		foreach ($result as $course) {
			$courses[$course['id']] = $course['name'];
		}

		$courses = $first_select_option + $courses;
		return $courses;
	}
	
	public function get_course_students($selected_course)
	{
		//get course code
		$course_id = $selected_course['course'];
		$courses_table = $this->db->dbprefix('dti_courses');
		$query = $this->db->query("SELECT `course_code` FROM `$courses_table` WHERE `id`='$course_id'");
		$course_code_object  = $query->row();
		$course_code = $course_code_object->course_code;

		$dti_profiles_table = $this->db->dbprefix('profiles');
        $query = $this->db->query("SELECT `user_id` FROM `$dti_profiles_table` WHERE `course_of_study`='$course_code'");
		$results  = $query->result_array();

		$fetched_data = null;
		foreach ($results as $result) {
			//$course_units = explode(',',$result['course_units']);
			//print_r($data);
			//if (in_array($course_unitid, $course_units)) {
				$student_ids[] = $result['user_id'];
			//}
		}

		return $student_ids;
	}

	public function get_student_profiles($student_ids)
	{
	
		$first_select_option = array(0 => '');
		foreach ($student_ids as $student_id) {
			$row = $this->ion_auth->get_user($student_id);  //create new user property that contains user object
			$students[$row->id] = $row->display_name;
		}

		$students = ($students)? $first_select_option + $students: $first_select_option;
		return $students;
	}

	public function get_course_payable_items($course_id)
	{
		$dti_fees_payable_items_table = $this->db->dbprefix('dti_fees_payable_items');
        $query = $this->db->query("SELECT * FROM `$dti_fees_payable_items_table` WHERE `course`='$course_id'");
		$results  = $query->result_array();

		return $results;
	}

	public function get_course_fees_paid($course_id){
		$dti_fees_paid_table = $this->db->dbprefix('dti_fees_paid');
		$current_year = date('Y');

        //echo "SELECT  `student_id` ,  `amount_paid` ,  `balance` FROM `$dti_fees_paid_table` WHERE `course_id`='$course_id' AND `year` ='$current_year' ORDER BY `date_paid` DESC";
        $query = $this->db->query("SELECT  `student_id` ,  `amount_paid` ,  `balance` FROM `$dti_fees_paid_table` WHERE `course_id`='$course_id' AND `year` ='$current_year' ORDER BY `date_paid` DESC");
		$results  = $query->result_array();

		return $results;
	}

	public function get_student_fees_records($student_id, $year){
		$selected_year = ($year)? $year:date('Y');
		$dti_fees_paid_table = $this->db->dbprefix('dti_fees_paid');

        $query = $this->db->query("SELECT * FROM `$dti_fees_paid_table` WHERE `student_id`='$student_id' AND `year` ='$selected_year' ORDER BY `payable_item_id` ASC ");
		$results  = $query->result_array();

		return $results;
	}

	public function get_payable_item($payable_item_id){
		$dti_fees_payable_items = $this->db->dbprefix('dti_fees_payable_items');

        $query = $this->db->query("SELECT `name` FROM `$dti_fees_payable_items` WHERE `id`='$payable_item_id'");
		$payable_item  = $query->row();

		return $payable_item;
	}

	// public function get_course_fees_paid($course_id){
	// 	$dti_fees_paid_table = $this->db->dbprefix('dti_fees_paid');
	// 	$current_year = date('Y');

 //        //echo "SELECT  `student_id` ,  `amount_paid` ,  `balance` FROM `$dti_fees_paid_table` WHERE `course_id`='$course_id' AND `year` ='$current_year' ORDER BY `date_paid` DESC";
 //        $query = $this->db->query("SELECT  `student_id` ,  `amount_paid` ,  `balance` FROM `$dti_fees_paid_table` WHERE `course_id`='$course_id' AND `year` ='$current_year' ORDER BY `date_paid` DESC");
	// 	$results  = $query->result_array();

	// 	return $results;
	// }
	
}