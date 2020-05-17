<?php
defined('ABSPATH') || exit;

/**
 * For more clarity, functions have been grouped into four files:
 * Sensible defaults that are enabled by default (inc/default-functions.php)
 * Optional functions & ƒ that need configuration (inc/custom-functions.php)
 * Functions that are meant to be called directly into templated (inc/template-functions.php)
 * Functions related to WooCommerce have their own file (inc/woocommerce-functions.php)
 *
 * The only exception is add_header_scripts in default-functions.php. It is disabled because
 * it doesn't allow to load both module & legacy script tag. It is instead hardcoded.
 */

require 'inc/default-functions.php';
require 'inc/custom-functions.php';
require 'inc/template-functions.php';
// require 'inc/woocommerce-functions.php'; // include WooCommerce ƒ file if needed

// Theme support
add_theme_support('html5');
add_theme_support('menus');
// add_theme_support('woocommerce'); // uncomment if the theme is WooCommerce compatible

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
});

// Add Thumbnail Theme Support
add_theme_support('post-thumbnails');
add_image_size('large', 700, '', true); // Large Thumbnail
add_image_size('medium', 250, '', true); // Medium Thumbnail
add_image_size('small', 120, '', true); // Small Thumbnail
// add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

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

// Localisation Support
load_theme_textdomain('steroids', get_template_directory() . '/languages');
