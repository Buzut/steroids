<?php
defined('ABSPATH') || exit;

add_theme_support('html5');
add_theme_support('menus');
add_theme_support('title-tag');
// add_theme_support('woocommerce'); // uncomment if the theme is WooCommerce compatible

// Add Thumbnail Theme Support
add_theme_support('post-thumbnails');


// Add support for custom backgrounds
// https://codex.wordpress.org/Custom_Backgrounds
// add_theme_support('custom-background', array(
//     'default-color' => 'FFF',
//     'default-image' => get_template_directory_uri() . '/img/bg.jpg'
// ));

// Add Support for Custom Header
// https://codex.wordpress.org/Custom_Headers
// add_theme_support('custom-header', array(
//     'default-image' => get_template_directory_uri() . '/img/headers/default.jpg',
//     'header-text' => false,
//     'default-text-color' => '000',
//     'width' => 1000,
//     'height' => 198,
//     'random-default' => false,
//     'wp-head-callback' => $wphead_cb,
//     'admin-head-callback' => $adminhead_cb,
//     'admin-preview-callback' => $adminpreview_cb
// ));

// add_theme_support('disable-custom-colors');
// add_theme_support('disable-custom-font-sizes');

// add_theme_support('editor-styles');
// add_editor_style('styles/editor.min.css');

// Localisation Support
load_theme_textdomain('steroids', get_template_directory() . '/languages');

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

// Remove p tag auto insertion
remove_filter('the_excerpt', 'wpautop');
remove_filter('the_content', 'wpautop');

add_filter('auto_update_plugin', '__return_true'); // Auto update plugins
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
