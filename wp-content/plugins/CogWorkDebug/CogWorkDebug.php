<?php
/**
 * Plugin Name: CogWorkDebug
 * Plugin URI: https:/cogwork.se
 * Description: Show PHP then logged in to site.
 * Version: 1.0
 * Author: Cogwork
 * Author URI: https:/cogwork.se
 */
 
add_action( 'init', 'show_errors' );
 
function show_errors() {
    
    if(function_exists("is_user_logged_in") && is_user_logged_in()) {
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);	
     
 }
     
}