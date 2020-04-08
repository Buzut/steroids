<?php
defined('ABSPATH') || exit;

/**
 * All the functions defined below are called by default
 * you can disable them by commenting their hooks/filters
 */

function steroids_remove_jquery(&$scripts) {
    if (!is_admin()) $scripts->remove('jquery');

    // If any plugin needs it, it'll load jQuery 3.3.1 (lighter and more modern that WP stock one)
    // can be commented if jQuery won't be needed in any way
    $scripts->add('jquery', get_template_directory_uri() . '/js/jquery.min.js', [], false);
}
add_filter('wp_default_scripts', 'steroids_remove_jquery');

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

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function steroids_remove_thumbnail_dimensions($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}
add_filter('post_thumbnail_html', 'steroids_remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'steroids_remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Load styles
function steroids_add_styles() {
    wp_register_style('steroids', get_template_directory_uri() . '/styles/main.min.css', [], '1.0');
    wp_enqueue_style('steroids'); // Enqueue it!
}
add_action('wp_enqueue_scripts', 'steroids_add_styles');

// Load scripts (header.php)
// not loaded by default because it can't use modules scripts, preferer hardcoding for module
function steroids_add_header_scripts() {
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('mydefaultscript', get_template_directory_uri() . '/js/main.min.js', [], '1.0');
        wp_enqueue_script('mydefaultscript');
    }
}
// add_action('init', 'steroids_add_header_scripts');


/*------------------------------------*\
    Hooks & filters
\*------------------------------------*/

// Add sensible defaults
add_filter('auto_update_plugin', '__return_true'); // Auto update plugins

// Remove annoying default
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)

// Remove p tag auto insertion
remove_filter('the_excerpt', 'wpautop');
remove_filter('the_content', 'wpautop');

remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'rest_output_link_wp_head', 10); // Disable REST API link tag
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10); // Disable oEmbed Discovery Links
remove_action('template_redirect', 'rest_output_link_header', 11, 0); // Disable REST API link in HTTP headers

// Remove emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
