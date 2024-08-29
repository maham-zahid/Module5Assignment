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

// Register Portfolio Widget
function register_portfolio_widget() {
    register_widget('Portfolio_Widget');
}
add_action('widgets_init', 'register_portfolio_widget');

class Portfolio_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'portfolio_widget', // Base ID
            'Portfolio Widget', // Name
            array('description' => __('Displays a grid of posts with featured images.')) // Args
        );
    }

    public function widget($args, $instance) {
        // Output the widget content
        echo $args['before_widget'];

        // Widget title
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Divider line
        echo '<hr class="portfolio-divider">';

        // Query for latest 6 posts
        $query_args = array(
            'post_type' => 'post', // Use 'post' for standard posts, replace with 'portfolio' if it's a custom post type
            'posts_per_page' => 6
        );

        $query = new WP_Query($query_args);

        if ($query->have_posts()) {
            echo '<div class="portfolio-grid">';

            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <div class="portfolio-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="portfolio-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                    </a>
                </div>
                <?php
            }

            echo '</div>'; // End .portfolio-grid
        } else {
            echo '<p>No posts found.</p>';
        }

        wp_reset_postdata();
        echo $args['after_widget'];
    }

    public function form($instance) {
        // Widget admin form
        $title = !empty($instance['title']) ? $instance['title'] : __('Portfolio', 'text_domain');
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }
}

// Register and load the widget
function load_portfolio_widget() {
    register_widget('Portfolio_Widget');
}
add_action('widgets_init', 'load_portfolio_widget');

// Enqueue the custom CSS for the portfolio widget
function portfolio_widget_styles() {
    wp_enqueue_style('portfolio-widget-style', get_template_directory_uri() . '/css/portfolio-widget.css');
}
add_action('wp_enqueue_scripts', 'portfolio_widget_styles');


/*
 * Enqueue the theme's stylesheet
 */
function wp_blog_theme_enqueue_styles() {
    wp_enqueue_style('wp-blog-theme-style', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'wp_blog_theme_enqueue_styles');



function register_theme_options_menu() {
    add_menu_page(
        __( 'Theme Options', 'textdomain' ), // Page title
        __( 'Theme Options', 'textdomain' ), // Menu title
        'manage_options',                    // Capability
        'theme-options',                     // Menu slug
        'display_theme_options_page',        // Callback function
        '',                                  // Icon URL (optional)
        61                                   // Position (optional)
    );
}
add_action( 'admin_menu', 'register_theme_options_menu' );

function display_theme_options_page() {
    ?>
    <div class="wrap">
        <h1><?php _e( 'Theme Options', 'textdomain' ); ?></h1>
        <form method="post" action="options.php">
            <?php
            // Output security fields for the registered setting
            settings_fields( 'theme_options_group' );

            // Output setting sections and their fields
            do_settings_sections( 'theme-options' );

            // Output save settings button
            submit_button();
            ?>
        </form>
    </div>
    <?php
}



function register_theme_font_setting() {
    // Register a new setting for "theme-options" page
    register_setting( 'theme_options_group', 'theme_font_style' );

    // Add a new section to the "theme-options" page
    add_settings_section(
        'theme_font_section',
        __( 'Theme Font Settings', 'textdomain' ),
        'theme_font_section_callback',
        'theme-options'
    );

    // Add a new field to the "theme_font_section"
    add_settings_field(
        'theme_font_style',
        __( 'Font Style', 'textdomain' ),
        'theme_font_style_field_callback',
        'theme-options',
        'theme_font_section'
    );
}
add_action( 'admin_init', 'register_theme_font_setting' );

function theme_font_section_callback() {
    echo __( 'Select the font style for your theme.', 'textdomain' );
}

function theme_font_style_field_callback() {
    // Get the current font style value
    $font_style = get_option( 'theme_font_style', 'Arial' );
    ?>
    <select name="theme_font_style">
        <option value="Arial" <?php selected( $font_style, 'Arial' ); ?>>Arial</option>
        <option value="Verdana" <?php selected( $font_style, 'Verdana' ); ?>>Verdana</option>
        <option value="Times New Roman" <?php selected( $font_style, 'Times New Roman' ); ?>>Times New Roman</option>
        <option value="Georgia" <?php selected( $font_style, 'Georgia' ); ?>>Georgia</option>
        <option value="Courier New" <?php selected( $font_style, 'Courier New' ); ?>>Courier New</option>
    </select>
    <?php
}

// Register the color picker settings and add them to the theme options page
function register_theme_color_settings() {
    // Register the header background color setting
    register_setting( 'theme_options_group', 'header_background_color' );
    
    // Register the footer background color setting
    register_setting( 'theme_options_group', 'footer_background_color' );

    // Add a new section for the header and footer background colors
    add_settings_section(
        'theme_color_section',
        __( 'Header and Footer Background Colors', 'textdomain' ),
        'theme_color_section_callback',
        'theme-options'
    );

    // Add the color picker field for header background color
    add_settings_field(
        'header_background_color',
        __( 'Header Background Color', 'textdomain' ),
        'header_background_color_field_callback',
        'theme-options',
        'theme_color_section'
    );

    // Add the color picker field for footer background color
    add_settings_field(
        'footer_background_color',
        __( 'Footer Background Color', 'textdomain' ),
        'footer_background_color_field_callback',
        'theme-options',
        'theme_color_section'
    );
}
add_action( 'admin_init', 'register_theme_color_settings' );

// Callback for the theme color section
function theme_color_section_callback() {
    echo __( 'Select background colors for the header and footer.', 'textdomain' );
}

// Callback for the header background color field
function header_background_color_field_callback() {
    $header_color = get_option( 'header_background_color', '#ffffff' );
    ?>
    <input type="text" name="header_background_color" value="<?php echo esc_attr( $header_color ); ?>" class="wp-color-picker-field" data-default-color="#ffffff">
    <?php
}

// Callback for the footer background color field
function footer_background_color_field_callback() {
    $footer_color = get_option( 'footer_background_color', '#ffffff' );
    ?>
    <input type="text" name="footer_background_color" value="<?php echo esc_attr( $footer_color ); ?>" class="wp-color-picker-field" data-default-color="#ffffff">
    <?php
}

// Enqueue the WordPress color picker script and styles
function enqueue_color_picker( $hook_suffix ) {
    // Only add the color picker on the theme options page
    if ( 'toplevel_page_theme-options' !== $hook_suffix ) {
        return;
    }

    // Enqueue the color picker style
    wp_enqueue_style( 'wp-color-picker' );

    // Enqueue the script to initialize the color picker
    wp_enqueue_script(
        'theme-options-color-picker',
        get_template_directory_uri() . '/assets/js/color-picker.js',
        array( 'wp-color-picker' ),
        false,
        true
    );
}
add_action( 'admin_enqueue_scripts', 'enqueue_color_picker' );

// Apply the header and footer background colors from the theme options
function apply_custom_background_colors() {
    $header_color = get_option( 'header_background_color', '#ffffff' );
    $footer_color = get_option( 'footer_background_color', '#ffffff' );
    echo '<style type="text/css">
        .site-header {
            background-color: ' . esc_attr( $header_color ) . ';
        }
        .site-footer {
            background-color: ' . esc_attr( $footer_color ) . ';
        }
    </style>';
}
add_action( 'wp_head', 'apply_custom_background_colors' );

?>

