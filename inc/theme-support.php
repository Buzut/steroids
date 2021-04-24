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

// Remove css file added for Gutenberg since wp 5.x
// most of the time not needed, especially if Gutenberg isn't used
function steroids_deactivate_gutenberg_css() {
    wp_dequeue_style('wp-block-library');
}
// add_action('wp_enqueue_scripts', 'steroids_deactivate_gutenberg_css');

// add_theme_support('disable-custom-colors');
// add_theme_support('disable-custom-font-sizes');

// add_theme_support('editor-styles');
// add_editor_style('styles/editor.min.css');

// Localisation Support
load_theme_textdomain('steroids', get_template_directory() . '/languages');

// Remove p tag auto insertion
remove_filter('the_excerpt', 'wpautop');
remove_filter('the_content', 'wpautop');

add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
