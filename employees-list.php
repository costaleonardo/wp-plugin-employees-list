<?php

/*
  Plugin Name: Employee List
  Description: Create, read, update, and delete employee info.
  Version: 1.0
  Author: Leonardo da Costa
  Author URI: https://github.com/costaleonardo
 */

global $jal_db_version;
$jal_db_version = '1.0';

function jal_install() {
    global $wpdb;
    global $jal_db_version;

    $table_name = $wpdb->prefix . 'employee_list';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name tinytext NOT NULL,
		address text NOT NULL,
		role text NOT NULL,
		contact bigint(12), 
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'jal_db_version', $jal_db_version );
}
register_activation_hook( __FILE__, 'jal_install' );

function employee_menu() {
    // Add plugin menu
    add_menu_page('employee_list', // page title
        'Employee Listing', // menu title
        'manage_options', // capabilities
        'Employee_Listing', // menu slug
        'employee_read' // function
    );

    // Add submenu
    add_submenu_page('Employee_Listing',
        'employee_insert',
        'Employee Insert',
        'manage_options',
        'Employee_Insert',
        'employee_post'
    );

    add_submenu_page( null,
        'employee_update',
        'Employee Update',
        'manage_options',
        'Employee_Update',
        'employee_update'
    );

    add_submenu_page( null,
        'employee_delete',
        'Employee Delete',
        'manage_options',
        'Employee_Delete',
        'employee_delete'
    );
}

add_action('admin_menu', 'employee_menu');


// returns the root directory path of particular plugin
define('ROOTDIR', plugin_dir_path(__FILE__));

require_once(ROOTDIR . 'employees-list-read.php');
require_once(ROOTDIR.'employees-list-post.php');
require_once(ROOTDIR.'employees-list-update.php');
require_once(ROOTDIR.'employees-list-delete.php');
?>