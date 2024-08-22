<?php
/**
 * Template Name: Home Page
 */
get_template_part('template-parts/header');
 ?>
 
<div class="page-container">
    <?php
    // Start the loop.
    while (have_posts()):
        the_post();
        ?>
        <section class="slider-image">
            <div class="slider-image-container">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/slider-image.png'); ?>" alt="Slider Image">
                <div class="slider-text">
                    <h1>Gearing up the ideas</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non urna eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </section>
    <?php
    endwhile;
    ?>
</div>

<?php
get_template_part('template-parts/services-highlight');
?>

<?php get_template_part('template-parts/footer');?>
