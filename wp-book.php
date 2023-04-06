<?php
/**
 * Plugin name: WP Book
 * Description: This Plugin has features like, upon activation it will create custom post type book, hierarchical taxonomy Book Category, non-hierarchical taxonomy Book Tag, custom meta box to save book meta information, custom dashboard widget which shows the top 5 book categories
 * Version: 1.0.0
 * Author: Nishit Satodiya
 * Author URI: not available
 */

//if someone directly access through url header, die!
if(!defined('ABSPATH')){
    header('Location:/your_header/');
    die();
}

//function called upon activation of plugin
function wp_book_activation_func(){
    partials\base\wp_book_activation::active();
}
register_activation_hook(__FILE__, 'wp_book_activation_func' );

function wp_book_deactivation_func(){
    partials\base\wp_book_deactivation::active();
}
register_deactivation_hook(__FILE__, 'wp_book_deactivation_func' );

//register all services for plugin
if( class_exists( 'partials\\init' ) ) {
    partials\init::register_services();
}