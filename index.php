<?php
get_template_part('template-parts/header');
get_template_part('template-parts/services-highlight');
?>

<div class="main-container">
    <div class="blog-section">
        <div class="heading-row">
            <h2>LET'S BLOG</h2>
            <hr class="section-divider">
        </div>

        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 5,
            'paged' => $paged,
        );
    
        $blog_query = new WP_Query($args);

    
        if ($blog_query->have_posts()) :
            while ($blog_query->have_posts()) : $blog_query->the_post();
                $post_date = get_the_date('d M Y'); 
                $post_author = get_the_author();
                $post_comments = get_comments_number();
                $is_active = is_singular() ? 'active' : ''; 
                
                // Retrieve categories
                $categories = get_the_category();
                $category_list = '';
                if (!empty($categories)) {
                    $category_links = array();
                    foreach ($categories as $category) {
                        $category_links[] = '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                    }
                    $category_list = implode(', ', $category_links); 
                } else {
                    $category_list = 'Uncategorized'; 
                }
                ?>
                <div class="blog-post <?php echo esc_attr($is_active); ?>">
                    <div class="blog-post-row">
                        <div class="blog-post-date">
                            <a href="<?php echo esc_url(get_permalink()); ?>" class="post-date-link"><?php echo esc_html($post_date); ?></a>
                        </div>
                        <div class="blog-vertical-line"></div> 
                        <div class="blog-post-heading">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>
                    </div>
                    <div class="blog-post-content">
                        <div class="post-thumbnail">
                            <?php if (has_post_thumbnail()) { ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="blog-post-meta">
                            <div class="meta-wrapper">
                                <div class="post-meta-info">
                                    <p>by <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="post-author-link"><?php echo esc_html($post_author); ?></a> 
                                    on <a href="<?php echo esc_url(get_permalink()); ?>" class="post-date-link"><?php echo esc_html($post_date); ?></a></p>
                                    <p>
                                        <span class="post-comment-count"><?php echo esc_html($post_comments . ' ' . _n('Comment', 'Comments', $post_comments, 'wp-blog-theme')); ?></span>
                                        <span class="vertical-line">|</span>
                                        <span class="post-category-links"><?php echo $category_list; ?></span>
                                    </p>
                                </div>
                            </div>
                            <hr class="blog-post-divider">
                            <div class="blog-post-excerpt">
                                <?php echo wp_trim_words(get_the_content(), 40, '...'); ?>
                                <a href="<?php the_permalink(); ?>" class="read-more-link">Read More</a>
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
                'current' => $paged,
                'prev_text' => __('<i class="fas fa-chevron-left"></i>'),
                'next_text' => __('<i class="fas fa-chevron-right"></i>'),
            ));
            ?>
        </div>

        <?php
    
        wp_reset_postdata();
        ?>
    </div>

    <?php get_sidebar(); ?>
</div>

<?php get_template_part('template-parts/footer'); ?>
