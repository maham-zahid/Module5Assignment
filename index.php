<?php
get_template_part('template-parts/header');
get_template_part('template-parts/services-highlight');
?>

<div class="blog-section">
    <div class="heading-row">
        <h2>LET'S BLOG</h2>
        <hr class="section-divider">
    </div>

    <?php
    // Set up the query for recent posts
    $args = array(
        'posts_per_page' => 5, // Number of posts per page
        'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
    );
    $blog_query = new WP_Query($args);

    // Loop through the posts and display blog content
    if ($blog_query->have_posts()) :
        while ($blog_query->have_posts()) : $blog_query->the_post();
            $post_date = get_the_date('d M', get_the_ID()); // Date format
            $post_author = get_the_author();
            $post_comments = get_comments_number();
            $is_active = is_singular() ? 'active' : ''; // Apply 'active' class if viewing a single post
            ?>
            <div class="blog-post <?php echo $is_active; ?>">
                <div class="blog-post-row">
                    <div class="blog-date">
                        <?php echo $post_date; ?>
                    </div>
                    <div class="blog-vertical-line"></div> 
                    <div class="blog-heading">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </div>
                </div>
                <div class="blog-content">
                    <div class="post-thumbnail">
                        <?php if (has_post_thumbnail()) { ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="blog-meta">
                    <p>by <span class="author-name"><?php echo $post_author; ?></span> on <?php echo $post_date; ?> <span class="comment-count"><?php echo $post_comments; ?></span></p>

                        <hr class="blog-divider">
                        <div class="blog-excerpt">
                            <?php echo wp_trim_words(get_the_content(), 40, '...'); ?>
                            <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
    else :
        echo '<p>No posts found.</p>';
    endif;

    // Pagination
    ?>
    <div class="pagination">
        <?php
        echo paginate_links(array(
            'total' => $blog_query->max_num_pages,
            'current' => get_query_var('paged') ? get_query_var('paged') : 1,
            'prev_text' => __('<i class="fas fa-chevron-left"></i>'),
            'next_text' => __('<i class="fas fa-chevron-right"></i>'),
        ));
        ?>
    </div>

    <?php
    // Reset Post Data
    wp_reset_postdata();
    ?>
</div>


<?php
get_template_part('template-parts/footer');
?>
