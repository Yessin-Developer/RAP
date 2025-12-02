<?php
// Helper template tags for the theme
if ( ! function_exists( 'cleanstarter_posted_on' ) ) :
    function cleanstarter_posted_on() {
        echo esc_html( get_the_date() );
    }
endif;
