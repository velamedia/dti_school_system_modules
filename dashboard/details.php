<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_dashboard extends Module {

    public $version = '1.0';

    public function info() {
        return array(
            'name' => array(
                'en' => 'School management system dashboard'
            ),
            'description' => array(
                'en' => 'A school management system.'
            ),
            'frontend' => TRUE,
            'backend' => TRUE,
            'menu' => 'DTI dashboard',
            'roles'    => array(
                'view_module'
            ),
            'sections' => array(
                'dashboard'         => array(
                    'name'          => 'Dashboard',
                    'uri'           => 'admin/dashboard',
                ),
                'admissions'        => array(
                    'name'          => 'Online Admission',
                    'uri'           => 'admin/admissions',
                    'shortcuts'     => array(
                        array(
                            'name'  => 'Add new',
                            'uri'   => 'admin/admissions/add_new',
                            'class' => 'add'
                        )
                    )
                )
            )
        );
    }

    public function admin_menu(&$menu)
    {

        // Create our main menu
        add_admin_menu_place('DTI', 2);

        // Assign common items
        $menu['DTI']['dashboard']    = 'admin/dashboard';
        $menu['DTI']['admissions']   = 'admin/admissions';

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