<?php
namespace Steroids;
defined('ABSPATH') || exit;

// Define navigation
// add as many as you need and reference them in register_nav_menus ƒ below
// add
// https://developer.wordpress.org/reference/functions/wp_nav_menu/
function show_menu($location) {
    wp_nav_menu([
        'theme_location'  => $location,
        'menu' => '',
        'container' => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id' => '',
        'menu_class' => 'menu',
        'menu_id' => '',
        'echo' => true,
        'fallback_cb' => 'wp_page_menu',
        'before' => '',
        'after' => '',
        'link_before' => '',
        'link_after' => '',
        'items_wrap' => '<ul>%3$s</ul>',
        'depth' => 0,
        'walker' => ''
    ]);
}

// Register navigation
// https://codex.wordpress.org/Function_Reference/register_nav_menus
add_action('init', function () {
    register_nav_menus([
        'primary' => 'Header menu',
        // 'sidebar-menu' => __('Sidebar Menu', 'steroids'), // Sidebar Navigation
        // 'extra-menu' => __('Extra Menu', 'steroids') // Extra Navigation if needed (duplicate as many as you need!)
    ]);
});

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function clean_dynamic_nav($args = '') {
    $args['container'] = false;
    return $args;
}
add_filter('wp_nav_menu_args', 'Steroids\clean_dynamic_nav');
