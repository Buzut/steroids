<?php
defined('ABSPATH') || exit;

/**
 * All the functions defined below are called by default
 * you can disable them by commenting their hooks/filters
 */

// Deactivate rarely used post embedding
// https://wordpress.stackexchange.com/q/211701/77030
function steroids_deregister_wp_embed() {
    wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'steroids_deregister_wp_embed');

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function steroids_clean_dynamic_nav($args = '') {
    $args['container'] = false;
    return $args;
}
add_filter('wp_nav_menu_args', 'steroids_clean_dynamic_nav');

// Remove invalid rel attribute values in the categorylist
function steroids_clean_category_list($thelist) {
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}
add_filter('the_category', 'steroids_clean_category_list');

// Remove wp_head() injected Recent Comment styles
function steroids_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', [
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ]);
}
add_action('widgets_init', 'steroids_remove_recent_comments_style');

// Convert css links to HTML5
function steroids_clean_style_tag($html, $handle, $href, $media) {
    $stripped_type = str_replace(" type='text/css'", '', $html);
    $stripped_id = str_replace( " id='$handle-css' ", '', $stripped_type);
    return str_replace(" media='all' /", '', $stripped_id);
}
add_filter('style_loader_tag', 'steroids_clean_style_tag', 10, 4); // Convert css links to HTML5

// Remove query string from static files
function steroids_remove_cssjs_ver($src) {
    if (strpos($src, '?ver='))
    $src = remove_query_arg('ver', $src);
    return $src;
}
add_filter('style_loader_src', 'steroids_remove_cssjs_ver', 10, 2);
add_filter('script_loader_src', 'steroids_remove_cssjs_ver', 10, 2);

// Remove counter-productive auto dns prefetch
function steroids_remove_dns_prefetch($hints, $relation_type) {
    if ('dns-prefetch' === $relation_type) return array_diff(wp_dependencies_unique_hosts(), $hints);
    return $hints;
}
add_filter('wp_resource_hints', 'steroids_remove_dns_prefetch', 10, 2);
