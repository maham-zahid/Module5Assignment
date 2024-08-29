<?php
// Shortcode for Portfolio Showcase
function portfolio_showcase_shortcode() {
    ob_start();
    ?>

    <div class="portfolio-container">
       
        <div class="title-section">
            <h2>D'SIGN IS THE SOUL</h2>
            <a href="<?php echo home_url('/portfolio'); ?>" class="btn">View All</a>

        </div>

        <!-- Divider Line -->
        <hr class="divider-line">

        
        <div class="portfolio-items-wrapper">
            <?php
            // Query for posts with featured images
            $args = array(
                'post_type' => 'post', 
                'posts_per_page' => 6,
                'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
                'meta_query' => array(
                    array(
                        'key' => '_thumbnail_id',
                        'compare' => 'EXISTS'
                    )
                )
            );

            $portfolio_query = new WP_Query($args);

            if ($portfolio_query->have_posts()) :
                while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                    ?>
                    <!-- Portfolio Card -->
                    <div class="portfolio-card">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('full'); ?>
                        </a>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>
            <?php
            wp_reset_postdata();
        else :
            ?>
            <p class="no-posts-message">No posts available.</p>
            <?php
        endif;
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('portfolio_showcase', 'portfolio_showcase_shortcode');
