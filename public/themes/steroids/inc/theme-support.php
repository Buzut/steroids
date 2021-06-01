<?php
defined('ABSPATH') || exit;

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
