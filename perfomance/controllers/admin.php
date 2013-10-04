<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * @author 		www.velamedia.biz
 * @package 	PyroCMS
 * @subpackage 	School perfomance Module
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
			$this->load->model('perfomance');
			$this->load->model('results');
			$this->lang->load('perfomance');

		// $this->template->append_css('module::admin/dashboard.css')
	    //                ->append_js('module::admin/flot.js')
	    //                ->append_js('module::admin/dashboard.js');
	}

	public function index()
	{
		//GET DATA FROM MODEL
			//$exams = $this->exam->get_all_exams_records();

		//RENDER TEMPLATE
			
			$this->template
			->append_css('module::blue_tablesorter_style.css', 'perfomance')
			->append_js('module::jquery.tablesorter.min.js', 'perfomance')
			//->set('exams', $exams)
			->title($this->module_details['name'])
			->build('admin/index');
	}

	// //list courses done for that exam
	// public function results($null, $exam_id)
	// {
	// 	// //GET DATA FROM MODEL
	// 	$exam = $this->results->get_exam($exam_id);
	// 	$course_units_done = $this->results->get_course_units_done($exam_id,$course='');
	// 	$courses_done = $this->results->get_courses($course_units_done);
		

	// 	//RENDER TEMPLATE
	// 		$this->template
	// 		->append_css('module::blue_tablesorter_style.css', 'exams')
	// 		->append_js('module::jquery.tablesorter.min.js', 'exams')
	// 		->title($this->module_details['name'])
	// 		->set('exam', $exam)
	// 		->set('course_units_done', $course_units_done)
	// 		->set('courses_done', $courses_done)
	// 		->build('admin/results/courses');
	// }

	// public function course_units_results($exam_id, $course)
	// {
	// 	// //GET DATA FROM MODEL
	// 	$exam_results = $this->results->get_exam_results($exam_id, $course);
	// 	$course_units_done_ids = $this->results->get_course_units_done($exam_id,$course);
	// 	$course_units = $this->results->get_course_units($course_units_done_ids);
	// 	$all_course_units = $this->results->get_all_course_units();
	// 	$exam_students = $this->results->get_exam_students($exam_id,$course);
	// 	//print_r($exam_students);

	// 	//RENDER TEMPLATE
	// 		$this->template
	// 		->append_css('module::blue_tablesorter_style.css', 'exams')
	// 		->append_js('module::jquery.tablesorter.min.js', 'exams')
	// 		->title($this->module_details['name'])
	// 		->set('course_units', $course_units)
	// 		->set('exam_results', $exam_results)
	// 		->set('all_course_units', $all_course_units)
	// 		->set('exam_students', $exam_students)
	// 		->build('admin/results/course');
	// }
}
