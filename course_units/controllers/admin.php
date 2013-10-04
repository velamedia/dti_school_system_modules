<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * @author 		www.velamedia.biz
 * @package 	PyroCMS
 * @subpackage 	School Course Units Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Admin extends Admin_Controller
{
	
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
			$this->load->model('course_units');
			$this->lang->load('course_units');

		// $this->template->append_css('module::admin/dashboard.css')
	    //                ->append_js('module::admin/flot.js')
	    //                ->append_js('module::admin/dashboard.js');
	}

	public function index()
	{
		//GET DATA FROM MODEL
			$course_units = $this->course_units->get_all_course_units();

		//RENDER TEMPLATE
			
			$this->template
			->append_css('module::blue_tablesorter_style.css', 'dashboard')
			->append_js('module::jquery.tablesorter.min.js', 'dashboard')
			->set('course_units', $course_units)
			->title($this->module_details['name'])
			->build('admin/index');
	}

	public function new_course_unit()
	{
		//GET DATA FROM MODEL
			$courses = $this->course_units->get_all_courses();

		//SAVE POSTED DATA TO MODEL FOR SAVING TO DB
			$data = array(
				'name'      => $this->input->post('name'),
				'unit_code' => $this->input->post('unit_code'),
				'cf' => $this->input->post('cf'),
				'course' => $this->input->post('course')
			);

			if($data['name']){

				$inserted_record_id = $this->course_units->insert_course_unit($data); //the id of the inserted record
				if ($inserted_record_id != 0)
				{
					$this->session->set_flashdata('success', sprintf(lang('course_units.add_success'), $data['name']) );
					redirect('admin/course_units');
				}
				else
				{
					$this->session->set_flashdata('error', lang('course_units.add_error') );
					redirect($this->uri->uri_string);
				}
			}

		//RENDER TEMPLATE
			$this->template
			//->append_css('module::chosen.css', 'exams')
			//->append_js('module::chosen.jquery.js', 'exams')
			->title($this->module_details['name'])
			//->set('years', $years)
			->set('courses', $courses)
			->build('admin/new_course_unit');
	}

	public function edit_course_unit($id)
	{
		//GET DATA FROM MODEL
			$course_unit = $this->course_units->get_course_unit($id);
			$courses = $this->course_units->get_all_courses();

		//SAVE POSTED DATA TO MODEL FOR SAVING TO DB
			$data = array(
				'name'      => $this->input->post('name'),
				'unit_code' => $this->input->post('unit_code'),
				'cf' => $this->input->post('cf'),
				'course' => $this->input->post('course')
			);

			if($data['name']){

				$affected_rows = $this->course_units->update_course_unit($id, $data);

				if ($affected_rows > 0)
				{
					$this->session->set_flashdata('success', sprintf(lang('course_unit.update_success'), $data['name']) );
					redirect($this->uri->uri_string);
				}
				else
				{
					$this->session->set_flashdata('error', lang('course_unit.update_error') );
					redirect($this->uri->uri_string);
				}
			}

		//RENDER TEMPLATE
			$this->template
			//->append_css('module::chosen.css', 'exams')
			//->append_js('module::chosen.jquery.js', 'exams')
			->title($this->module_details['name'])
			->set('course_unit', $course_unit)
			->set('courses', $courses)
			->build('admin/edit_course_unit');
	}
	
}
