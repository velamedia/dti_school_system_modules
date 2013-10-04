<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_courses extends Module {

    public $version = '1.0';

    public function info() {
        return array(
            'name' => array(
                'en' => 'Courses Module'
            ),
            'description' => array(
                'en' => 'Courses offered in the institution.'
            ),
            'frontend' => TRUE,
            'backend' => TRUE,
            'menu' => 'DTI',
            'roles'    => array(
                'view_module'
            ),
            'shortcuts' => array(
                array(
                    'name'  => 'courses:shortcuts:new',
                    'uri'   => 'admin/courses/new_course',
                    'class' => 'add'
                )
            )
        );
    }

    public function admin_menu(&$menu)
    {

        // Create our main menu
        add_admin_menu_place('DTI', 2);

        // Assign common items
        $menu['DTI']['Courses']    = 'admin/courses';

    }

    public function install() {
        return TRUE;
    }

    public function uninstall() {
        return TRUE; //Not interested in uninstalling this for the time being.
    }

    public function upgrade($old_version) {
        // Your Upgrade Logic
        return TRUE;
    }

    public function help() {
        // Return a string containing help info
        // You could include a file and return it here.
        return "<h4>Overview</h4>
    <p>Dairy Training Institute - Naivasha school management system.</p>";
    }

}

/* End of file details.php */