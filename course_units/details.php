<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_course_units extends Module {

    public $version = '1.0';

    public function info() {
        return array(
            'name' => array(
                'en' => 'Course Units Module'
            ),
            'description' => array(
                'en' => 'Course units offered in the institution.'
            ),
            'frontend' => TRUE,
            'backend' => TRUE,
            'menu' => 'DTI',
            'roles'    => array(
                'view_module'
            ),
            'shortcuts' => array(
                array(
                    'name'  => 'course_units:shortcuts:new',
                    'uri'   => 'admin/course_units/new_course_unit',
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
        $menu['DTI']['Course units']    = 'admin/course_units';

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