<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Module template
 *
 * @author 		www.velamedia.biz
 * @package 	PyroCMS
 * @subpackage 	Exams Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Course_units extends Public_Controller
{

	public $id = 0;


	/**
	 * Constructor method
	 *
	 * @author www.velamedia.biz
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		// Load the required classes
		// LOAD MODELS, LANGUAGE AND HELPERS (IF REQUIRED)
			//$this->load->model('course_units');
			$this->lang->load('course_units');
			
	}
	
	/**
	 * Index method
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
	//GET DATA FROM DB
		$this->db->from($this->db->dbprefix('dti_course_units'));
		$this->db->order_by("unit_code", "asc");
		$query = $this->db->get();
		$course_units = $query->result_array();

	//SAVE POSTED DATA TO MODEL FOR SAVING TO DB
		$selected_course_units = implode(',',$this->input->post('course_units'));
		$data = array(
			'course_units' => $selected_course_units,
			'student_id'   => $this->current_user->id,
			'semester'     => 1,
			'year'         => date('Y')

		);
		
		if($data['course_units']){
			$this->db->insert($this->db->dbprefix('dti_course_units_selection'), $data);
			$inserted_record_id = $this->db->insert_id(); //the id of the inserted record

			if ($inserted_record_id != 0)
			{
				$this->session->set_flashdata('success', sprintf(lang('selected_course_units.add_success'), '') );
				redirect($this->uri->uri_string);
			}
			else
			{
				$this->session->set_flashdata('error', lang('selected_course_units.add_error') );
				redirect($this->uri->uri_string);
			}
		}	

	//RENDER VIEW
		$this->template
		->append_css('module::style.css', 'course_units')
		->append_css('module::buttons.css', 'course_units')
		->title($this->module_details['name'])
		->set('course_units', $course_units)
		->build('index');
	}

}