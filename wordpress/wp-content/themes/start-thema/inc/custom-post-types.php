<?php
// Register a simple 'project' CPT as example
function cleanstarter_register_cpt_project() {
    $labels = array(
        'name'               => _x( 'Projects', 'post type general name', 'cleanstarterext' ),
        'singular_name'      => _x( 'Project', 'post type singular name', 'cleanstarterext' ),
        'menu_name'          => _x( 'Projects', 'admin menu', 'cleanstarterext' ),
        'name_admin_bar'     => _x( 'Project', 'add new on admin bar', 'cleanstarterext' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_in_rest'       => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'projects' ),
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );
    register_post_type( 'project', $args );
}
add_action( 'init', 'cleanstarter_register_cpt_project' );
