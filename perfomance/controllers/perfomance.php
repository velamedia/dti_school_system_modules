<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Module template
 *
 * @author 		www.velamedia.biz
 * @package 	PyroCMS
 * @subpackage 	Perfomance Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Perfomance extends Public_Controller
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

			$this->lang->load('perfomance');
			$this->load->model('perfomance');
			
	}
	
	/**
	 * Index method
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
	//GET DATA FROM MODEL
		$user_session = $this->session->all_userdata();
		$exams = $this->exam->get_student_exams_records(array('student_id' => $user_session['user_id']));

	//RENDER VIEW
		$this->template
		->append_css('module::style.css', 'perfomance')
		->title($this->module_details['name'])
		->build('index');
	}

}