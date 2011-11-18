<?php

/*
Plugin Name: Dev Theme Settings
Plugin URI: http://thomasgbennett.com/wp-template/dev_theme_settings
Description: This is the settings for the develop theme's demonstration.
Version: 1.0
Author: Thomas Bennett
Author URI: http://thomasgbennett.com
*/

add_action('admin_menu', 'dev_theme_settings_menu');

function dev_theme_settings_menu() {
    add_options_page('Dev Theme Settings', 'Dev Theme Settings', 'manage_options', 'tgb_dev', 'dev_theme_settings');
}

function dev_theme_settings() {
    if (!current_user_can('manage_options'))  {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    } ?>
    <div class="wrap">
        <p>Options go here</p>
    </div>
<?php 
}

?>
