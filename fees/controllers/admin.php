<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * @author 		www.velamedia.biz
 * @package 	PyroCMS
 * @subpackage 	Students School Fees Records Module
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
			$this->load->model('fees');
			$this->lang->load('fees');

		// $this->template->append_css('module::admin/dashboard.css')
	    //                ->append_js('module::admin/flot.js')
	    //                ->append_js('module::admin/dashboard.js');
	}

	public function index()
	{
		//GET DATA FROM MODEL
			

		//RENDER TEMPLATE
			
			$this->template
			->append_css('module::style.css', 'fees')
			->append_css('module::blue_tablesorter_style.css', 'fees')
			->append_js('module::jquery.tablesorter.min.js', 'fees')
			->append_js('module::highcharts.js', 'fees')
			// ->append_js('https://ajax.googleapis.com/ajax/libs/mootools/1.4.5/mootools-yui-compressed.js')
			// ->append_js('https://ajax.googleapis.com/ajax/libs/prototype/1.7.0.0/prototype.js')
			// ->append_js('http://code.highcharts.com/highcharts.js')
			// ->append_js('http://code.highcharts.com/adapters/mootools-adapter.js')
			// ->append_js('http://code.highcharts.com/adapters/prototype-adapter.js')
			// ->append_js('http://code.highcharts.com/highcharts-more.js')
			->title($this->module_details['name'])
			->build('admin/index');
	}

	public function new_payable_item()
	{
		//GET DATA FROM MODEL
			$courses = $this->fees->get_all_courses();

		//SAVE POSTED DATA TO MODEL FOR SAVING TO DB
			$data = array(
				'name'      => $this->input->post('name'),
				'course' => $this->input->post('course')
			);

			if($data['name']){

				$inserted_record_id = $this->fees->insert_new_payable_item($data); //the id of the inserted record
				if ($inserted_record_id != 0)
				{
					$this->session->set_flashdata('success', sprintf(lang('fees.new_payable_item.add_success'), $data['name']) );
					redirect($this->uri->uri_string);
				}
				else
				{
					$this->session->set_flashdata('error', lang('fees.new_payable_item.add_error') );
					redirect($this->uri->uri_string);
				}
			}

		//RENDER TEMPLATE
			$this->template
			//->append_css('module::chosen.css', 'exams')
			//->append_js('module::chosen.jquery.js', 'exams')
			->title($this->module_details['name'])
			->set('courses', $courses)
			->build('admin/new_payable_item');
	}

	public function new_record()
	{
		//GET DATA FROM MODEL
			$years = $this->fees->years();
			$semesters = $this->fees->semesters();
			$courses = $this->fees->get_all_courses();

		if($this->input->post('course')){
			$selected_course = array('course' => $this->input->post('course'));
			$course_students_ids = $this->fees->get_course_students($selected_course);
			$course_students_profiles = $this->fees->get_student_profiles($course_students_ids);

			$course_payable_items = $this->fees->get_course_payable_items($this->input->post('course'));
		}

		//SAVE POSTED DATA TO MODEL FOR SAVING TO DB
			$data = array(
				'student_id'      => $this->input->post('student'),
				'year'      => $this->input->post('year'),
				'course_id' => $this->input->post('course'),
				'course_payable_item_ids' => $this->input->post('course_payable_item_ids'),
				'payable_item_amount' => $this->input->post('payable_item_amount'),
				'payable_item_balance' => $this->input->post('payable_item_balance'),
				'date_paid' => $this->input->post('date_paid')
			);

			if($data['payable_item_amount']){

				$inserted_record_id = $this->fees->insert_new_fees_paid_record($data); //the id of the inserted record
				if ($inserted_record_id != 0)
				{
					$this->session->set_flashdata('success', sprintf(lang('fees.paid.add_success'), $data['name']) );
					redirect($this->uri->uri_string);
				}
				else
				{
					$this->session->set_flashdata('error', lang('fees.paid.add_error') );
					redirect($this->uri->uri_string);
				}
			}
			
		//RENDER TEMPLATE
			$this->template
			->append_css('module::jquery-ui-1.8.18.custom.css', 'fees')
			->append_js('module::jquery.ui.core.js', 'fees')
			->append_js('module::jquery.ui.datepicker.js', 'fees')
			->title($this->module_details['name'])
			->set('years', $years)
			->set('semesters', $semesters)
			->set('courses', $courses)
			->set('course_students_profiles', $course_students_profiles)
			->set('course_payable_items', $course_payable_items)
			->build('admin/new_record');
	}
	

	//student's fees records
	public function student($student_id,$year)
	{
		//GET DATA FROM MODEL
			$student = $this->ion_auth->get_user($student_id);
			$student_fees = $this->fees->get_student_fees_records($student_id,$year);

		//RENDER TEMPLATE
			
			$this->template
			->append_css('module::style.css', 'fees')
			->append_css('module::blue_tablesorter_style.css', 'fees')
			->append_js('module::jquery.tablesorter.min.js', 'fees')
			->title($this->module_details['name'])
			->set('student', $student)
			->set('student_fees', $student_fees)
			->build('admin/student');
	}
}
