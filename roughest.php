<?php
/*
Plugin Name: Instant Estimate Calculator
Plugin URI: https://inlandapp.com/custom-plugins/roughest
Description: RoughEst Instant Estimate Calculator allows website visitors to easily and instantly calculate a rough price range estimate for your services.
Version: 1.0
Author: Inland Applications
Author URI: https://inlandapp.com
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: rough-estimate-calculator
*/

// Exit if accessed directly
if(!defined('ABSPATH')){
  exit;
}

// Load Scripts
require_once(plugin_dir_path(__FILE__).'/includes/roughest-scripts.php');

// Load Class
require_once(plugin_dir_path(__FILE__).'/includes/roughest-class.php');

// Register Widget
function register_roughest_sqft(){
  register_widget('RoughEst_Sqft_Widget');
}
// Register Widget
function register_roughest_run(){
  register_widget('RoughEst_Run_Widget');
}

// Hook in function
add_action('widgets_init', 'register_roughest_sqft');
add_action('widgets_init', 'register_roughest_run');