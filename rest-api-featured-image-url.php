<?php
/*
* Plugin Name: WP REST API Featured Image URL
* Plugin URI: https://github.com/misfist/wp-rest-api-featured-post-url
* Description: Adds featured image url to posts endpoint.
* Version: 0.1
* Author: Pea
* Author URI: http://misfist.com
* License: GPLv3
* */

define( 'REST_API_NAMESPACE', 'rest-sites-list/v2' );

/**
 * Add fields to Rest API return data
 * https://1fix.io/blog/2015/06/26/adding-fields-wp-rest-api/
 */

function pea_rest_prepare_post( $data, $post, $request ) {
    $_data = $data->data;
    $thumbnail_id = get_post_thumbnail_id( $post->ID );
    $thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );
    $thumbnail_full = wp_get_attachment_image_src( $thumbnail_id, 'full' );
    $_data['featured_image_thumbnail_url'] = $thumbnail[0];
    $_data['featured_image_thumbnail_full_url'] = $thumbnail_full[0];
    $_data['featured_image_thumbnail_title'] = get_the_title( $thumbnail_id );
    $_data['featured_image_thumbnail_caption'] = get_the_excerpt( $thumbnail_id );
    $data->data = $_data;
    return $data;
}
add_filter( 'rest_prepare_post', 'pea_rest_prepare_post', 10, 3 );


?>