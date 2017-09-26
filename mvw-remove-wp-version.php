<?php

/*

Plugin Name: Remove wordpress version
Plugin URI: http://www.maartenvanwingerden.nl/mvw-remove-wp-version
Version: 1.0.0
Author: Maarten van Wingerden
Author URI: http://www.maartenvanwingerden.nl/
Description: Removes wordpress meta generator tag and removes WP version from urls


*/

	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/* Remove wp version from style,script urls */
function mvw_remove_wp_version_strings( $src ) {

    global $wp_version;
    parse_str( parse_url($src, PHP_URL_QUERY), $query );
    if ( !empty( $query['ver'] ) && $query['ver'] === $wp_version ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;

}
add_filter( 'script_loader_src', 'mvw_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'mvw_remove_wp_version_strings' );

/* Remove meta tag generator */

function mvw_remove_meta_version() {
    return '';
}
add_filter( 'the_generator', 'mvw_remove_meta_version' );
