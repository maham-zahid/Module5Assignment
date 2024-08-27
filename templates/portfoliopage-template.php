<?php
/* Template Name: Portfolio Page */

get_template_part('template-parts/header');
get_template_part('template-parts/services-highlight');
?>

<div class="portfolio-container">
    <!-- Title and Navigation Buttons -->
    <div class="title-section">
        <h2>D'SIGN IS THE SOUL</h2>
        <div class="nav-buttons">
            <a href="#" class="btn advertising-link">Advertising</a>
            <a href="#" class="btn multimedia-link">Multimedia</a>
            <a href="#" class="btn photography-link active">Photography</a>
        </div>
    </div>
    <!-- Divider -->
    <hr class="divider-line">

    <!-- Portfolio Items Grid -->
    <div class="portfolio-items-wrapper">
        <?php
        // Set up the query for posts with featured images
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'posts_per_page' => 15,
            'paged' => $paged,
            'meta_key' => '_thumbnail_id', // Ensures only posts with featured images are included
        );
        $portfolio_query = new WP_Query($args);

        // Loop through the posts and display featured images
        if ($portfolio_query->have_posts()) :
            while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
        ?>
                <div class="portfolio-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium'); // Adjust size as needed ?>
                    </a>
                </div>
        <?php
            endwhile;
        else :
            echo '<p>No posts found.</p>';
        endif;

        // Reset Post Data
        wp_reset_postdata();
        ?>
    </div>

    <!-- Pagination Controls -->
    <div class="pagination-wrapper">
    <?php
    echo paginate_links(array(
        'total' => $portfolio_query->max_num_pages,
        'current' => get_query_var('paged') ? get_query_var('paged') : 1,
        'format' => '?paged=%#%', // Pagination format
        'prev_text' => '<i class="fas fa-chevron-left"></i>', 
        'next_text' => '<i class="fas fa-chevron-right"></i>', 
    ));
    ?>
    </div>

</div>


<?php
 get_template_part('template-parts/footer');
?>