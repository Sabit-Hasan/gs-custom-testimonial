<?php
/**
 * Plugin Name: GS Custom Testimonial
 * Description: A custom Elementor widget that displays "Hello World"
 * Version: 1.0
 * Author: Md.Sabit Hasan
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'elementor/frontend/after_enqueue_scripts', function() {
    wp_enqueue_script( 'swiper' );
    wp_enqueue_style( 'swiper' );
} );


function register_custom_widget() {
    require_once plugin_dir_path( __FILE__ ) . 'widget.php';
	\Elementor\Plugin::instance()->widgets_manager->register( new \GS_Custom_Testimonial() );
}
add_action( 'elementor/widgets/widgets_registered', 'register_custom_widget' );
