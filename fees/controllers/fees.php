<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Module template
 *
 * @author 		www.velamedia.biz
 * @package 	PyroCMS
 * @subpackage 	Students School Fees Records Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Fees extends Public_Controller
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
			//$this->load->model('courses');
			$this->lang->load('courses');
			
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
		// $this->db->from($this->db->dbprefix('dti_courses'));
		// $this->db->order_by("unit_code", "asc");
		// $query = $this->db->get();
		// $courses = $query->result_array();

	//SAVE POSTED DATA TO MODEL FOR SAVING TO DB
		$selected_courses = implode(',',$this->input->post('courses'));
		$data = array(
			'courses' => $selected_courses,
			'student_id'   => $this->current_user->id,
			'semester'     => 1,
			'year'         => date('Y')

		);
		
		if($data['courses']){
			$this->db->insert($this->db->dbprefix('dti_courses_selection'), $data);
			$inserted_record_id = $this->db->insert_id(); //the id of the inserted record

			if ($inserted_record_id != 0)
			{
				$this->session->set_flashdata('success', sprintf(lang('selected_courses.add_success'), '') );
				redirect($this->uri->uri_string);
			}
			else
			{
				$this->session->set_flashdata('error', lang('selected_courses.add_error') );
				redirect($this->uri->uri_string);
			}
		}	

	//RENDER VIEW
		$this->template
		->append_css('module::style.css', 'courses')
		->append_css('module::buttons.css', 'courses')
		->title($this->module_details['name'])
		//->set('courses', $courses)
		->build('index');
	}

}