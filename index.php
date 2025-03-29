<?php

/*
 * Plugin Name:       Post View count
 * Description:       This a plugin for display how many times a post or page has been viewed.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Bristy
 * Text Domain:       pvc
*/


function post_view_count($content){

    $word_count       = str_word_count( wp_strip_all_tags( $content ) );
	$words_per_minute = 200;
    $reading_time = ceil( $word_count / $words_per_minute );
    $content .= '<strong>Estimated reading time: </strong>' . $reading_time . ' min';
    return $content;

}

add_filter( 'the_content', 'post_view_count' );

?>