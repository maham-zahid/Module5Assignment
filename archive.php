<?php
get_header(); // Include the header.php template
?>

<div class="archive-section">
    <div class="heading-row">
        <h2>
            <?php
            // Display the archive title dynamically
            if (is_category()) {
                single_cat_title('Category: ');
            } elseif (is_tag()) {
                single_tag_title('Tag: ');
            } elseif (is_day()) {
                echo 'Daily Archives: ' . get_the_date();
            } elseif (is_month()) {
                echo 'Monthly Archives: ' . get_the_date('F Y');
            } elseif (is_year()) {
                echo 'Yearly Archives: ' . get_the_date('Y');
            } else {
                echo 'Archives';
            }
            ?>
        </h2>
        <hr class="section-divider">
    </div>

    <div class="archive-posts">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post(); ?>
                <div class="archive-post">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo get_the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                    <hr>
                </div>
            <?php endwhile;

            // Pagination
            the_posts_pagination(array(
                'prev_text' => __('<i class="fas fa-chevron-left"></i> Previous'),
                'next_text' => __('Next <i class="fas fa-chevron-right"></i>'),
            ));
        else :
            echo '<p>No posts found.</p>';
        endif;
        ?>
    </div>
</div>

<?php
get_footer(); // Include the footer.php template
?>