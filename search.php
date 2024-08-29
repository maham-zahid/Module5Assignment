<?php
get_template_part('template-parts/header');
?>

<main id="main" class="site-main" role="main">
    <header class="search-header">
        <h1 class="search-title">Search Results for: <?php echo get_search_query(); ?></h1>
    </header>

    <div class="search-content">
        <?php if ( have_posts() ) : ?>
            <div class="search-results">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('search-item'); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="search-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="search-details">
                            <h2 class="search-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="search-meta">
                            by <span class="search-author"><?php the_author(); ?></span>
                              on  <span class="search-date"><?php echo get_the_date(); ?></span>
                                <span class="search-categories"><?php the_category(', '); ?></span>
                            </div>
                            <div class="search-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="read-more-button">Read More</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="search-pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('&laquo; Prev', 'textdomain'),
                    'next_text' => __('Next &raquo;', 'textdomain'),
                ));
                ?>
            </div>

        <?php else : ?>
            <p class="no-results">Sorry, no results found for your search query.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_template_part('template-parts/footer'); ?>
