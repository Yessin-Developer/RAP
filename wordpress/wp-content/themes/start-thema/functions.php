<?php
/**
 * RAP Wonen Theme Functions
 */

if ( ! function_exists( 'rap_wonen_setup' ) ) :
function rap_wonen_setup() {
    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Add RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Post thumbnails
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1568, 9999 );

    // HTML5 support
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );

    // Custom logo support
    add_theme_support( 'custom-logo', array(
        'height'      => 40,
        'width'       => 40,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Register nav menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'rap-wonen' ),
    ) );
}
endif;
add_action( 'after_setup_theme', 'rap_wonen_setup' );

// Enqueue styles & scripts
function rap_wonen_scripts() {
    wp_enqueue_style( 'rap-wonen-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );

    // Example asset - if you add assets/dist/main.js later
    if ( file_exists( get_template_directory() . '/assets/dist/main.js' ) ) {
        wp_enqueue_script( 'rap-wonen-main', get_template_directory_uri() . '/assets/dist/main.js', array('jquery'), filemtime( get_template_directory() . '/assets/dist/main.js' ), true );
    }
}
add_action( 'wp_enqueue_scripts', 'rap_wonen_scripts' );

// Fallback menu if no menu is set
function rap_wonen_fallback_menu() {
    echo '<ul>';
    echo '<li class="menu-item menu-item-has-children"><a href="#">Woningconcepten</a></li>';
    echo '<li class="menu-item menu-item-has-children"><a href="#">Kernwaarden</a></li>';
    echo '<li class="menu-item menu-item-has-children"><a href="#">Voor wie</a></li>';
    echo '<li class="menu-item menu-item-has-children"><a href="#">Over RAP Wonen</a></li>';
    echo '<li class="menu-item"><a href="#">Projecten</a></li>';
    echo '<li class="menu-item"><a href="#">Nieuws</a></li>';
    echo '</ul>';
}

// Include extra files
require get_template_directory() . '/inc/custom-post-types.php';
require get_template_directory() . '/inc/template-tags.php';

// ACF local JSON loader (optional)
if ( file_exists( get_template_directory() . '/inc/acf.php' ) ) {
    require get_template_directory() . '/inc/acf.php';
}

