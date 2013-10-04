<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 *
 * @author 		www.velamedia.biz
 * @package 	PyroCMS
 * @subpackage 	School Management System Dashboard
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Admin extends Admin_Controller
{
	
	/**
	 * Constructor method
	 *
	 * @author Yorick Peterse - PyroCMS Dev Team
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		// Load the required classes
		// LOAD MODELS, LANGUAGE AND HELPERS (IF REQUIRED)
			$this->lang->load('dashboard');

		// $this->template->append_css('module::admin/dashboard.css')
	    //                ->append_js('module::admin/flot.js')
	    //                ->append_js('module::admin/dashboard.js');
	}

	public function index()
	{
		//LIKELY TO GET DATA FROM MODEL
		//RENDER TEMPLATE
			
			$this->template
			->append_css('module::style.css', 'dashboard')
			->title($this->module_details['name'])
			->build('admin/index');
	}
	
}
