<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Module template
 *
 * @author 		jjperezaguinaga
 * @package 	PyroCMS
 * @subpackage 	Contractors Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Dashboard extends Public_Controller
{

	public $id = 0;


	/**
	 * Constructor method
	 *
	 * @author jjperezaguinaga
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		// Load the required classes
		// LOAD MODELS, LANGUAGE AND HELPERS (IF REQUIRED)

			$this->lang->load('dashboard');
			
	}
	
	/**
	 * Index method
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
	//RENDER VIEW
		$this->template
		->append_css('module::style.css', 'dashboard')
		->title($this->module_details['name'])
		->build('index');
	}

}