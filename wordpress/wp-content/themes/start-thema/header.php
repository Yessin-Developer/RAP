<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-container">
        <!-- Logo -->
        <a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2025/12/Logo.png' ) ); ?>" alt="RAP Wonen" class="site-logo-full">
        </a>

        <!-- Navigation Menu -->
        <nav class="site-nav">
            <?php 
            wp_nav_menu( array( 
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => 'rap_wonen_fallback_menu'
            ) ); 
            ?>
        </nav>

        <!-- CTA Button -->
        <div class="header-cta">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="cta-button">
                Bezoek plannen
                <span class="cta-button-arrow"></span>
            </a>
        </div>
    </div>
</header>

<main id="site-content" role="main">
