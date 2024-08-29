<?php
/**
 * Template Name: Contact Page
 */
get_template_part('template-parts/header');
get_template_part('template-parts/services-highlight');
?>

<div class="contact-page-wrapper">
    <h1 class="contact-heading">Contact Us</h1>

    <div class="contact-content">

    <div class= "contact-form">
        <?php the_content(); ?>
     </div>

        <!-- Right side with Contact Details -->
        <div class="contact-details">
            <h2 class="contact-details-heading">Let's Connect</h2>
            <p class="contact-address"><strong>Address:</strong> Your address here</p>
            <p class="contact-email"><strong>Email:</strong> your.email@example.com</p>
            <p class="contact-phone"><strong>Phone:</strong> +123 456 7890</p>
            <p class="contact-location"><strong>Location:</strong> Your location details here</p>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/footer'); ?>