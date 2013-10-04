<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_perfomance extends Module {

    public $version = '1.0';

    public function info() {
        return array(
            'name' => array(
                'en' => 'Perfomance Module'
            ),
            'description' => array(
                'en' => 'Students Perfomance records.'
            ),
            'frontend' => TRUE,
            'backend' => TRUE,
            'menu' => 'DTI',
            'roles'    => array(
                'view_module'
            )
            // ),
            // 'shortcuts' => array(
            //     array(
            //         'name'  => 'exams:shortcuts:create_exam',
            //         'uri'   => 'admin/exams/new_exam',
            //         'class' => 'add'
            //     ),
            //     array(
            //         'name'  => 'exams:shortcuts:post_exam_results',
            //         'uri'   => 'admin/exams/post_results',
            //         'class' => 'add'
            //     )
            // )
        );
    }

    public function admin_menu(&$menu)
    {

        // Create our main menu
        //add_admin_menu_place('DTI', 2);

        // Assign common items
       // $menu['DTI']['Perfomance']    = 'admin/perfomance';

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