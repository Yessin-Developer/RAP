<?php
// Clean Starter Theme - functions.php (extended)
if ( ! function_exists( 'cleanstarter_setup' ) ) :
function cleanstarter_setup() {
    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Add RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Post thumbnails
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1568, 9999 );

    // HTML5 support
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );

    // Register nav menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'cleanstarterext' ),
    ) );
}
endif;
add_action( 'after_setup_theme', 'cleanstarter_setup' );

// Enqueue styles & scripts (example: main.css, main.js)
function cleanstarter_scripts() {
    wp_enqueue_style( 'cleanstarter-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );

    // Example asset - if you add assets/dist/main.js later
    if ( file_exists( get_template_directory() . '/assets/dist/main.js' ) ) {
        wp_enqueue_script( 'cleanstarter-main', get_template_directory_uri() . '/assets/dist/main.js', array('jquery'), filemtime( get_template_directory() . '/assets/dist/main.js' ), true );
    }
}
add_action( 'wp_enqueue_scripts', 'cleanstarter_scripts' );

// Include extra files
require get_template_directory() . '/inc/custom-post-types.php';
require get_template_directory() . '/inc/template-tags.php';

// ACF local JSON loader (optional)
if ( file_exists( get_template_directory() . '/inc/acf.php' ) ) {
    require get_template_directory() . '/inc/acf.php';
}
