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
class Course_units extends MY_Model {

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

	public function insert_course_unit($data)
	{
		$this->db->insert($this->db->dbprefix('dti_course_units'), $data);
		return $this->db->insert_id(); //return the id of the inserted record
	}

	public function update_course_unit($id, $data)
	{
		$this->db->update($this->db->dbprefix('dti_course_units'), $data, array('id' => $id));
		return $this->db->affected_rows();
	}

	public function get_all_course_units()
	{
		$this->db->from($this->db->dbprefix('dti_course_units'));
		$this->db->order_by("unit_code", "asc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_course_unit($id)
	{
		return $this->db->get_where($this->db->dbprefix('dti_course_units'), array('id' => $id))->row();
	}

	public function get_course($id)
	{
		return $this->db->get_where($this->db->dbprefix('dti_courses'), array('id' => $id))->row();
	}
	
	public function get_all_courses()
	{
		$this->db->from($this->db->dbprefix('dti_courses'));
		$this->db->order_by("name", "asc");
		$query = $this->db->get();
		$result = $query->result_array();

		$first_option = array(0 => '');
		foreach ($result as $course) {
			$courses[$course['id']] = $course['name'];
		}
		$courses = $first_option + $courses;

		return $courses;
	}
	
}