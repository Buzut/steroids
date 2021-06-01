<?php
defined('ABSPATH') || exit;

// Hide comments from admin sidebar
// add_action('admin_menu', function () {
//     remove_menu_page('edit-comments.php');
// });

// // Hide comments icon from toolbar
// add_action('admin_init', function () {
//     if (is_admin_bar_showing()) {
//         remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
//     }
// });

// Hide ACF admin menu
// // add_filter('acf/settings/show_admin', function() {
//     // Allow only for first signup user
//     // return get_current_user_id() === 1;

//     // Allow for all admins
//     // return current_user_can('manage_options');

//     // Return false to hide for everyone
//     return false;
// });

// add_filter('user_can_richedit' , '__return_false', 50); // Remove visual editor
// add_filter('show_admin_bar', '__return_false'); // Remove Admin bar
