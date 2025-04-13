<?php
/**
 * Plugin Name: GS Custom Testimonial
 * Description: GS Custom Testimonial is a lightweight and fully customizable Elementor widget plugin that allows you to display client testimonials in a stylish and responsive layout. Designed with performance and flexibility in mind, this widget supports Swiper.js integration, custom styling, and a smooth user experience.
 * Version: 1.0
 * Author: Md.Sabit Hasan
 * Author URI: https://github.com/Sabit-Hasan
 * Github Plugin URI: https://github.com/Sabit-Hasan/gs-custom-testimonial
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: gs-custom-testimonial
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Enqueue Swiper assets for frontend
add_action( 'elementor/frontend/after_enqueue_scripts', function() {
    wp_enqueue_script( 'swiper' );
    wp_enqueue_style( 'swiper' );
} );

// Register widget only if Elementor is loaded
function register_custom_widget() {
    // Only load widget if Elementor is active
    if ( did_action( 'elementor/loaded' ) ) {
        require_once plugin_dir_path( __FILE__ ) . 'widget.php';
        \Elementor\Plugin::instance()->widgets_manager->register( new \GS_Custom_Testimonial() );
    }
}
add_action( 'elementor/widgets/widgets_registered', 'register_custom_widget' );

// Show admin notice if Elementor is not active
function gs_custom_testimonial_admin_notice() {
    if ( ! did_action( 'elementor/loaded' ) ) {
        echo '<div class="notice notice-warning is-dismissible"><p><strong>GS Custom Testimonial</strong> requires Elementor to be installed and activated.</p></div>';
    }
}
add_action( 'admin_notices', 'gs_custom_testimonial_admin_notice' );
