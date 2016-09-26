<?php

/*
Plugin Name: Cool Coming Soon
Plugin URI: http://www.AtlasGondal.com/
Description: Simple, Super Cool Coming Coon and Maintenance plugin with full customization and complete display controls.
Version: 1.0
Author: Atlas Gondal
Author URI: http://www.AtlasGondal.com/
License: GPL v2 or higher
License URI: License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

define( 'CCS_VERSION', '1.0'); // Plugin Version Number

function cool_coming_soon_nav(){

    add_options_page( 'Cool Coming Soon', 'Cool Coming Soon', 'manage_options', 'cool-coming-soon-settings', 'include_cool_coming_soon_settings_page' );

}


add_action( 'admin_menu', 'cool_coming_soon_nav' );

class cool_coming_soon_default_data {
    static function install() {
        if(!isset($ccs_default_data)){
            $ccs_default_data = new stdClass();
        }
        $ccs_default_data->name                         = 'Cool Coming Soon';
        $ccs_default_data->maintenance_mode             = 1;
        $ccs_default_data->bg_options                   = 'bg';
        $ccs_default_data->background_url               = plugins_url( 'inc/assets/img/bg.jpg', __FILE__ );
        $ccs_default_data->logo_url                     = plugins_url( 'inc/assets/img/logo.png', __FILE__ );
        $ccs_default_data->page_title                   = 'Coming Soon';
        $ccs_default_data->heading                      = 'Coming Soon';
        $ccs_default_data->description                  = 'The website is under construction! <br/>We are working very hard to give you the best experience.';
        $ccs_default_data->date                         = '2016-10-11';

        if(!isset($ccs_default_display_data)){
            $ccs_default_display_data = new stdClass();
        }
        $ccs_default_display_data->display_background   = 'Yes';
        $ccs_default_display_data->display_logo         = 'Yes';
        $ccs_default_display_data->display_title        = 'Yes';
        $ccs_default_display_data->display_description  = 'Yes';
        $ccs_default_display_data->display_date         = 'Yes';


        add_option('cool_coming_soon_data', $ccs_default_data);
        add_option('cool_coming_soon_display', $ccs_default_display_data);
    }
}
register_activation_hook( __FILE__, array( 'cool_coming_soon_default_data', 'install' ) );

class cool_coming_soon_default_data_delete {
    static function uninstall() {
        delete_option( 'cool_coming_soon_data' );
        delete_option( 'cool_coming_soon_display' );
    }
}
register_deactivation_hook( __FILE__, array( 'cool_coming_soon_default_data_delete', 'uninstall' ) );

function include_cool_coming_soon_settings_page(){

    include(plugin_dir_path(__FILE__) . 'cool-coming-soon-settings.php');

}

function ccs_maintenance_template_redirect() {

    $maintenance_mode = get_option('cool_coming_soon_data');

    if( !is_user_logged_in() ){
        if($maintenance_mode->maintenance_mode == 1){
            $coming_soon_file = plugin_dir_path( __FILE__ ).'/inc/index.php';
            include($coming_soon_file);
            exit();

        }
    }

}
add_action( 'template_redirect','ccs_maintenance_template_redirect');
