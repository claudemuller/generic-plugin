<?php

/*
 * @package GenericPlugin
 */
/*
Plugin Name: Generic Plugin
Plugin URI: https://dxt.rs
Description: A generic WordPress plugin base
Version: 1.0.0
Author: Claude Müller
Author URI: https://dxt.rs
License:
Text Domain: generic-plugin
 */

defined( 'ABSPATH' ) or die( 'Access denied.' );

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

register_activation_hook( __FILE__, [ 'Inc\Base\Activate', 'activate' ] );
register_deactivation_hook( __FILE__, [ 'Inc\Base\Deactivate', 'deactivate' ] );

if ( class_exists( 'Inc\\Init' ) ) {
    Inc\Init::init_services();
}