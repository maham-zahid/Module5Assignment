<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="container">
            <!-- Logo -->
            <div class="site-logo">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Site Logo">
                </a>
            </div>

            <!-- Navigation Menu -->
            <nav class="main-nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'menu_class'     => 'nav-links',
                ));
                ?>
            </nav>
       
            <!-- Search Bar -->
            <div class="search-bar">
            <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="text" class="search-field" value="<?php echo get_search_query(); ?>" name="s" >
                <button type="submit">
                    <i class="fas fa-search"></i> 
                </button>
            </form>
        </div>
    </div>
</header>

 <!-- Slider Image-->
<section class="slider-image">
    <div class="slider-image-container">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/slider-image.png" alt="Slider Image">
        <div class="slider-text">
            <h1>Gearing up the ideas</h1>
            <p>Transform your ideas into impactful solutions with our innovative approach. Discover new possibilities and make a difference with our expertise.</p>
            
        </div>
    </div>
</section>

    <?php wp_body_open(); ?>