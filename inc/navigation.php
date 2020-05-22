<?php
defined('ABSPATH') || exit;

// Define navigation
// add as many as you need and reference them in register_nav_menus ƒ below
// https://developer.wordpress.org/reference/functions/wp_nav_menu/
function steroids_primary_nav() {
    wp_nav_menu([
        'theme_location'  => 'primary',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
    ]);
}

// Register navigation
// https://codex.wordpress.org/Function_Reference/register_nav_menus
function steroids_register_nav_menus() {
    register_nav_menus([
        'primary' => 'Header menu'
        // 'sidebar-menu' => __('Sidebar Menu', 'steroids'), // Sidebar Navigation
        // 'extra-menu' => __('Extra Menu', 'steroids') // Extra Navigation if needed (duplicate as many as you need!)
    ]);
}
add_action('init', 'steroids_register_nav_menus');
