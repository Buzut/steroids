<?php
defined('ABSPATH') || exit;

// Use a more recent version of jQuery than the stock one & get rid of jQuery migrate
// This jQuery will be loaded only if needed by a plugin
function steroids_upgrade_jquery(&$scripts) {
    if (!is_admin()) $scripts->remove('jquery');

    // If any plugin needs it, it'll load jQuery 3.5.1 (lighter and more modern that WP stock one)
    // can be commented if jQuery won't be needed in any way
    $scripts->add('jquery', get_template_directory_uri() . '/scripts/jquery.js', [], false);
}
add_filter('wp_default_scripts', 'steroids_upgrade_jquery');

// Load styles (herder.php)
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
