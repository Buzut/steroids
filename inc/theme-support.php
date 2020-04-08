<?php
defined('ABSPATH') || exit;

if (function_exists('add_theme_support')) {
    // Declare HTML5
    add_theme_support('html5');

    // Add Menu Support
    add_theme_support('menus');

    // WooCommerce support (uncomment only if building WooCommerce theme)
    // add_theme_support('woocommerce');

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
    //     'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
    //     'header-text'			=> false,
    //     'default-text-color'		=> '000',
    //     'width'				=> 1000,
    //     'height'			=> 198,
    //     'random-default'		=> false,
    //     'wp-head-callback'		=> $wphead_cb,
    //     'admin-head-callback'		=> $adminhead_cb,
    //     'admin-preview-callback'	=> $adminpreview_cb
    // ));

    // Localisation Support
    load_theme_textdomain('steroids', get_template_directory() . '/languages');
}
