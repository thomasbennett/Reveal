<?php

/*
Plugin Name: TimThumb meets TinyMCE
Version: 1.0
Plugin URI: http://www.reflectionmedia.ro/2009/10/image-resize-plugin/
Description: Integrates TimThumb with TinyMCE
Author: Reflection Media
Author URI: http://www.reflectionmedia.ro/
*/

// http://codex.wordpress.org/TinyMCE
// http://codex.wordpress.org/TinyMCE_Custom_Buttons

function ttplugin_addbuttons() {
	add_filter("mce_external_plugins", "add_ttplugin_tinymce_plugin");
	add_filter('mce_buttons', 'register_ttplugin_button');
}

function register_ttplugin_button($buttons) {
   array_push($buttons, "|", "ttplugin");
   return $buttons;
}

function add_ttplugin_tinymce_plugin($plugin_array) {
   $plugin_array['ttplugin'] = WP_PLUGIN_URL.'/timthumb-mce/ttplugin/editor_plugin.js';
   return $plugin_array;
}

// init process for button control
add_action('init', 'ttplugin_addbuttons');