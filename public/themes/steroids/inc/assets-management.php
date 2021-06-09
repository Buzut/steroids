<?php
namespace Steroids;

defined('ABSPATH') || exit;

// Ad stylesheets based on template params
function add_styles($args) {
    $assets_version = file_get_contents(__DIR__ . '/../assets-version');
    echo '<link rel="preload" as="style" href="' . get_template_directory_uri() . '/styles/build/critical-' . $assets_version . '.css">';
    echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/styles/build/critical-' . $assets_version . '.css">';
    echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/styles/build/lazy-' . $assets_version . '.css" media="print" onload="this.media=\'all\'">';

    if (!is_array($args) || !count($args)) return;

    foreach ($args as $stylesheet) {
        if (is_array($stylesheet)) {
            $name = $stylesheet['name'];

            if (array_key_exists('lazy', $stylesheet)) $lazy = $stylesheet['lazy'];
            else $lazy = false;
        }

        else {
            $name = $stylesheet;
            $lazy = false;
        }

        if ($lazy) echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/styles/build/' . $name . '-' . $assets_version . '.css" media="print" onload="this.media=\'all\'">';

        else {
            echo '<link rel="preload" as="style" href="' . get_template_directory_uri() . '/styles/build/' . $name . '-' . $assets_version . '.css">';
            echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/styles/build/' . $name . '-' . $assets_version . '.css">';
        }
    }
}

// Load styles (header.php)
function enqueue_styles() {
    wp_register_style('my-stylesheet-name', get_template_directory_uri() . '/styles/any-style.css', [], '1.0');
    wp_enqueue_style('my-stylesheet-name'); // Enqueue it!
}
// add_action('wp_enqueue_scripts', 'Steroids\enqueue_styles');

// Load scripts (header.php)
function enqueue_header_scripts() {
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('my-script-name', get_template_directory_uri() . '/scripts/any-script.js', [], '1.0');
        wp_enqueue_script('my-script-name');
    }
}
// add_action('init', 'Steroids\enqueue_header_scripts');
