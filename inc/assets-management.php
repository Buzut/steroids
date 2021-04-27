<?php
defined('ABSPATH') || exit;

// Load styles (header.php)
function steroids_add_styles() {
    wp_register_style('my-stylesheet-name', get_template_directory_uri() . '/styles/any-style.css', [], '1.0');
    wp_enqueue_style('my-stylesheet-name'); // Enqueue it!
}
// add_action('wp_enqueue_scripts', 'steroids_add_styles');

// Load scripts (header.php)
function steroids_add_header_scripts() {
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('my-script-name', get_template_directory_uri() . '/scripts/any-script.js', [], '1.0');
        wp_enqueue_script('my-script-name');
    }
}
// add_action('init', 'steroids_add_header_scripts');
