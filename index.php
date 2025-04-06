<?php

/*
 * Plugin Name:       Post View Count
 * Description:       This a plugin for display how many times a post or page has been viewed.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Bristy
 * Text Domain:       pvc
*/



function add_post_views_to_content($content){
    if (is_single()) {
        $views = wpb_set_post_views(get_the_ID());
        $content .= '<p><strong>' . esc_html($views) . '</strong></p>';
    }
    return $content;
}

add_filter('the_content', 'add_post_views_to_content');

function wpb_set_post_views( $postID ) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta( $postID, $count_key, true );
    if ($count == '') {
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '1' );
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


function wpb_get_post_views( $postID ) {
    $key = 'wpb_post_views_count';
    $count = get_post_meta( $postID, $key, true );

    if ( $count == '' ) {
        return "0 views";
    }

    return $count . ' views';
}



function show_post_views_to_content($content){
    if (is_single()) {
        $views = wpb_get_post_views(get_the_ID());
        $content .= '<p><strong>' . esc_html($views) . '</strong></p>';
    }
    return $content;
}

add_filter('the_content', 'show_post_views_to_content');



?>