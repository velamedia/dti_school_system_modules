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
			$this->load->model('courses');
			$this->lang->load('courses');

		// $this->template->append_css('module::admin/dashboard.css')
	    //                ->append_js('module::admin/flot.js')
	    //                ->append_js('module::admin/dashboard.js');
	}

	public function index()
	{
		//GET DATA FROM MODEL
			$courses = $this->courses->get_all_courses();

		//RENDER TEMPLATE
			
			$this->template
			->append_css('module::blue_tablesorter_style.css', 'dashboard')
			->append_js('module::jquery.tablesorter.min.js', 'dashboard')
			->set('courses', $courses)
			->title($this->module_details['name'])
			->build('admin/index');
	}

	public function new_course()
	{
		//GET DATA FROM MODEL
			// $years = $this->exam->years();
			// $semesters = $this->exam->semesters();

		//SAVE POSTED DATA TO MODEL FOR SAVING TO DB
			$data = array(
				'name'      => $this->input->post('name'),
				'course_code' => $this->input->post('course_code'),
				'course_duration' => $this->input->post('course_duration')
			);

			if($data['name']){

				$inserted_record_id = $this->courses->insert_course($data); //the id of the inserted record
				if ($inserted_record_id != 0)
				{
					$this->session->set_flashdata('success', sprintf(lang('courses.add_success'), $data['name']) );
					redirect('admin/courses');
				}
				else
				{
					$this->session->set_flashdata('error', lang('courses.add_error') );
					redirect($this->uri->uri_string);
				}
			}

		//RENDER TEMPLATE
			$this->template
			//->append_css('module::chosen.css', 'exams')
			//->append_js('module::chosen.jquery.js', 'exams')
			->title($this->module_details['name'])
			//->set('years', $years)
			//->set('semesters', $semesters)
			->build('admin/new_course');
	}

	public function edit_course($id)
	{

		//GET DATA FROM MODELS
			$course = $this->courses->get_course($id);

		//SAVE POSTED DATA TO MODEL FOR SAVING TO DB
			$data = array(
				'name'      => $this->input->post('name'),
				'course_code' => $this->input->post('course_code'),
				'course_duration' => $this->input->post('course_duration')
			);

			if($data['name']){

				$affected_rows = $this->courses->update_course($id, $data);

				if ($affected_rows > 0)
				{
					$this->session->set_flashdata('success', sprintf(lang('courses.update_success'), $data['name']) );
					redirect('admin/courses');
				}
				else
				{
					$this->session->set_flashdata('error', lang('courses.update_error') );
					redirect($this->uri->uri_string);
				}
			}

		//RENDER TEMPLATE
			$this->template
			//->append_css('module::chosen.css', 'exams')
			//->append_js('module::chosen.jquery.js', 'exams')
			->title($this->module_details['name'])
			->set('course', $course)
			->build('admin/edit_course');
	}
	
}
