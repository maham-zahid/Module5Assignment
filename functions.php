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
?>

