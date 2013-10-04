<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * @author 		www.velamedia.biz
 * @package 	PyroCMS
 * @subpackage 	School Exams Module
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
			$this->load->model('exam');
			$this->load->model('results');
			$this->lang->load('exams');

		// $this->template->append_css('module::admin/dashboard.css')
	    //                ->append_js('module::admin/flot.js')
	    //                ->append_js('module::admin/dashboard.js');
	}

	public function index()
	{
		//GET DATA FROM MODEL
			$exams = $this->exam->get_all_exams_records();

		//RENDER TEMPLATE
			
			$this->template
			->append_css('module::blue_tablesorter_style.css', 'exams')
			->append_js('module::jquery.tablesorter.min.js', 'exams')
			->set('exams', $exams)
			->title($this->module_details['name'])
			->build('admin/index');
	}

	public function post_results()
	{
		//GET DATA FROM MODEL
			//$years = $this->exam->years();
			$semesters = $this->exam->semesters();
			$courses = $this->exam->get_all_courses();
			

		//SELECT STUDENTS USING POSTED PARAMS
			$exam_params = array(
				'year'        => $this->input->post('year'),
				'semester'    => $this->input->post('semester')
			);

			$exams = $this->exam->get_specific_exams_records($exam_params);
			//array_pop($data); //remove the last array element (course_unit) to create needed exam_params array

			if($this->input->post('course')){
				$course_units_params = array('course' => $this->input->post('course'));
				$course_units = $this->exam->get_specific_course_units($course_units_params);
			}

			$student_ids_params = array(
				'year'        => $this->input->post('year'),
				'semester'    => $this->input->post('semester'),
				'course'      => $this->input->post('course'),
				'course_unit' => $this->input->post('course_unit')
			);

			$student_ids = $this->exam->get_course_unit_students($student_ids_params);
			$students = $this->exam->get_student_profiles($student_ids);
			
			if($this->input->post('scores')[0] != '' and $this->input->post('year') !='' and $this->input->post('semester') !='' and $this->input->post('course') !='' and $this->input->post('course_unit') !=''){
				
				$posted_data = $this->input->post();

				$inserted_record_id = $this->exam->post_exam_results($posted_data);
				if ($inserted_record_id != 0)
				{
					$this->session->set_flashdata('success', sprintf(lang('exams.post_results.add_success')) );
					redirect('admin/exams');
				}else{
					$this->session->set_flashdata('error', lang('exams.post_results.add_error') );
					redirect($this->uri->uri_string);
				}
			}


		//RENDER TEMPLATE
			
			$this->template
			->title($this->module_details['name'])
			//->set('years', $years)
			->set('semesters', $semesters)
			->set('exams', $exams)
			->set('courses', $courses)
			->set('course_units', $course_units)
			->set('students', $students)
			->build('admin/post_results');
	}

	public function new_exam()
	{
		//GET DATA FROM MODEL
			//$years = $this->exam->years();
			$semesters = $this->exam->semesters();

		//SAVE POSTED DATA TO MODEL FOR SAVING TO DB
			$data = array(
				'name'      => $this->input->post('name'),
				'year'      => $this->input->post('year'),
				'semester'  => $this->input->post('semester')
			);

			if($data['name']){

				$inserted_record_id = $this->exam->insert_exam($data); //the id of the inserted record
				if ($inserted_record_id != 0)
				{
					$this->session->set_flashdata('success', sprintf(lang('exams.add_success'), $data['name']) );
					redirect($this->uri->uri_string);
				}
				else
				{
					$this->session->set_flashdata('error', lang('exams.add_error') );
					redirect($this->uri->uri_string);
				}
			}

		//RENDER TEMPLATE
			$this->template
			->append_css('module::chosen.css', 'exams')
			->append_js('module::chosen.jquery.js', 'exams')
			->title($this->module_details['name'])
			//->set('years', $years)
			->set('semesters', $semesters)
			->build('admin/new_exam');
	}

	//list courses done for that exam
	public function results($null, $exam_id)
	{
		// //GET DATA FROM MODEL
		$exam = $this->results->get_exam($exam_id);
		$course_units_done = $this->results->get_course_units_done($exam_id,$course='');
		$courses_done = $this->results->get_courses($course_units_done);
		

		//RENDER TEMPLATE
			$this->template
			->append_css('module::blue_tablesorter_style.css', 'exams')
			->append_js('module::jquery.tablesorter.min.js', 'exams')
			->title($this->module_details['name'])
			->set('exam', $exam)
			->set('course_units_done', $course_units_done)
			->set('courses_done', $courses_done)
			->build('admin/results/courses');
	}

	public function course_units_results($exam_id, $course)
	{
		// //GET DATA FROM MODEL
		$exam_results = $this->results->get_exam_results($exam_id, $course);
		$course_units_done_ids = $this->results->get_course_units_done($exam_id,$course);
		$course_units = $this->results->get_course_units($course_units_done_ids);
		$all_course_units = $this->results->get_all_course_units();
		$exam_students = $this->results->get_exam_students($exam_id,$course);
		//print_r($exam_students);

		//RENDER TEMPLATE
			$this->template
			->append_css('module::blue_tablesorter_style.css', 'exams')
			->append_js('module::jquery.tablesorter.min.js', 'exams')
			->title($this->module_details['name'])
			->set('course_units', $course_units)
			->set('exam_results', $exam_results)
			->set('all_course_units', $all_course_units)
			->set('exam_students', $exam_students)
			->build('admin/results/course');
	}

	//student's exam records
	public function student($student_id)
	{
		//GET DATA FROM MODEL
			$student = $this->ion_auth->get_user($student_id);
			$exams = $this->results->get_student_exam_records($student_id);
			$exams_data = $this->results->get_exams_data($exams);

		//RENDER TEMPLATE
			
			$this->template
			->append_css('module::style.css', 'exams')
			->append_css('module::blue_tablesorter_style.css', 'exams')
			->append_js('module::jquery.tablesorter.min.js', 'exams')
			->title($this->module_details['name'])
			->set('student', $student)
			->set('exams_data', $exams_data)
			->build('admin/results/student');
	}

	//student's exam record (for only 1 exam)
	public function student_exam_record($student_id,$null,$exam)
	{
		//GET DATA FROM MODEL
			$student = $this->ion_auth->get_user($student_id);
			$exam_data = $this->results->get_exam($exam);
			$exam_results = $this->results->get_student_exam_results($student_id, $exam);

		//RENDER TEMPLATE
			
			$this->template
			->append_css('module::style.css', 'exams')
			->append_css('module::blue_tablesorter_style.css', 'exams')
			->append_js('module::jquery.tablesorter.min.js', 'exams')
			->title($this->module_details['name'])
			->set('student', $student)
			->set('exam_data', $exam_data)
			->set('exam_results', $exam_results)
			->build('admin/results/student_exam_record');
	}
}
