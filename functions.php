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
 * Callback function for comments
 */

function custom_comment_format($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-meta">
            
            <span class="comment-icon">
                <i class="fas fa-comment"></i> 
            </span>
            
            <span class="comment-author" style="color: red;">
                <?php comment_author(); ?>
            </span> 
            <span class="comment-said-on" style="color: grey;">
                said on
            </span>
            <span class="comment-date" style="color: grey;">
                <?php comment_date(); ?>
            </span>
            <span class="comment-time" style="color: grey;">
                at <?php comment_time(); ?>
            </span>
        </div>
        
        
        <div class="comment-content" style="color: grey; text-align: left;">
            <?php comment_text(); ?>
        </div>

   
        <div class="comment-reply" style="text-align: right;">
            <?php comment_reply_link( array_merge( $args, array(
                'reply_text' => '<i class="fas fa-reply"></i> reply',
                'depth'      => $depth,
                'max_depth'  => $args['max_depth']
            ) ) ); ?>
        </div>
    </li>
    <?php
}

function my_theme_widgets_init() {
    register_sidebar( array(
        'name'          => 'Primary Sidebar',
        'id'            => 'primary-sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'my_theme_widgets_init' );



/*
 * Enqueue the theme's stylesheet
 */
function wp_blog_theme_enqueue_styles() {
    wp_enqueue_style('wp-blog-theme-style', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'wp_blog_theme_enqueue_styles');
?>

