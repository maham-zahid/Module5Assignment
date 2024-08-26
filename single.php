<?php
/*  SinglePost Blog Page */

get_template_part('template-parts/header');
get_template_part('template-parts/services-highlight');
?>

<div class="single-post-container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
        <article class="single-post">
            <!-- Post Title -->
            <h1 class="post-title"><?php the_title(); ?></h1>
            
           <!-- Post Meta -->
           <div class="post-meta">
           by <span class="author"> <?php the_author(); ?></span>
              on  <span class="date"><?php the_date(); ?></span> 
                <span class="comments"><?php comments_number('No comments', '1 comment', '% comments'); ?></span>
            </div>
            <!-- Divider Line -->
            <hr class="divider-line">
            
            <!-- Post Content -->
            <div class="post-content">
                <?php the_content(); ?>
            </div>

            <!-- Tags Section -->
            <div class="post-tags">
                <h2 class="tags-heading">TAGS:</h2>
                <?php the_tags('<span class="tag">', '</span><span class="tag">', '</span>'); ?>
            </div>


           <!-- Comments Template -->
           <?php comments_template(); ?>

        </article>

    <?php endwhile; endif; ?>
</div>


<?php
 get_template_part('template-parts/footer');
?>