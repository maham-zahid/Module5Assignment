<?php
/**
 * Template Name:Archive Page
 */
get_template_part('template-parts/header');
?>

<main id="main" class="site-main" role="main">
    <header class="custom-archive-header">
        <?php
        the_archive_title( '<h1 class="custom-archive-title">', '</h1>' );
        ?>
    </header>

    <div class="custom-archive-content">
        <?php if ( have_posts() ) : ?>
            <div class="custom-post-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('custom-post-item'); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="custom-post-thumbnail">
                                <?php the_post_thumbnail( 'medium' ); ?>
                            </div>
                        <?php endif; ?>

                        <div class="custom-post-content">
                            <h2 class="custom-post-title"><?php the_title(); ?></h2>
                            <div class="custom-post-meta">
                                <?php
                                echo '<span class="custom-post-author">' . get_the_author() . '</span>';
                                echo '<span class="custom-post-date">' . get_the_date() . '</span>';
                                ?>
                            </div>
                            <div class="custom-post-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="custom-read-more">Read More</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="custom-navigation">
                <?php the_posts_navigation(); ?>
            </div>

        <?php else : ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_template_part('template-parts/footer'); ?>