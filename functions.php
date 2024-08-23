<?php

// Theme setup
function headermenu_setup() {
    // Register navigation menu
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'Header Menu')
    ));
}
add_action('after_setup_theme', 'headermenu_setup');


function customtheme_setup() {
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'customtheme_setup');

/**
 * Include the portfolio shortcode file
 */
require get_template_directory() . '/template-parts/portfolio-showcase.php';


    /**
 * Enqueue the theme's stylesheet
 */
function wp_blog_theme_enqueue_styles() {
    wp_enqueue_style('wp-blog-theme-style', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'wp_blog_theme_enqueue_styles');
?>

