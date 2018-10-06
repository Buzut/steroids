<?php

/**
 * All the functions defined below aren't called by default
 * To enable one, just uncomment its hook/filter
 */

// Define navigation
// add as many as you need and reference them in register_nav_menus ƒ below
// https://developer.wordpress.org/reference/functions/wp_nav_menu/
function steroids_primary_nav() {
	wp_nav_menu([
		'theme_location'  => 'header-menu',
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

// Define Sidebar Widget Area 1 (add as many as you need)
// register_sidebar([
//     'name' => __('Widget Area 1', 'steroids'),
//     'description' => __('Description for this widget-area...', 'steroids'),
//     'id' => 'widget-area-1',
//     'before_widget' => '<div id="%1$s" class="%2$s">',
//     'after_widget' => '</div>',
//     'before_title' => '<h3>',
//     'after_title' => '</h3>'
// ]);

// Remove image sizes that won't be used to save server space
// comment what you want to keep
function steroids_unset_image_sizes($sizes){
    // unset($sizes['thumbnail']);
    // unset($sizes['medium']);
    // unset($sizes['medium_large']);
    // unset($sizes['large']);
    return $sizes;
}
// add_filter('intermediate_image_sizes_advanced', 'steroids_unset_image_sizes');

// Replace src img by large image
// prevents from keeping huge uncompressed images and eventually serving that to visitors
function steroids_replace_uploaded_image($image_data) {
    if (!isset($image_data['sizes']['large'])) return $image_data;

    $upload_dir = wp_upload_dir();
    $uploaded_image_location = $upload_dir['basedir'] . '/' .$image_data['file'];
    $banner_image_location = $upload_dir['path'] . '/' .$image_data['sizes']['large']['file'];

    unlink($uploaded_image_location);
    rename($banner_image_location, $uploaded_image_location);

    $image_data['width'] = $image_data['sizes']['large']['width'];
    $image_data['height'] = $image_data['sizes']['large']['height'];
    unset($image_data['sizes']['large']);

    return $image_data;
}
// add_filter('wp_generate_attachment_metadata', 'steroids_replace_uploaded_image');

// Insert custom image size in media gallery
// just add the size's name you defined in the theme support section with add_image_size ƒ
function steroids_set_ui_image_sizes($sizes) {
    $custom_sizes = ['small' => 'Small'];

    return array_merge($sizes, $custom_sizes);
}
// add_filter('image_size_names_choose', 'steroids_set_ui_image_sizes');


// Custom View Article link to Post
function steroids_view_article($more) {
    global $post;
    return '… <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'steroids') . '</a>';
}
// add_filter('excerpt_more', 'steroids_view_article');

// Remove Admin bar
function steroids_remove_admin_bar() {
    return false;
}
// add_filter('show_admin_bar', 'steroids_remove_admin_bar');


/*------------------------------------*\
	Hooks & filters
\*------------------------------------*/

// https://developer.wordpress.org/reference/hooks/jpeg_quality/
// add_filter('jpeg_quality', function($arg){ return 50; }); // How to compress images
// add_filter('wp_calculate_image_srcset_meta', '__return_null'); // Remove srcset
// add_filter('user_can_richedit' , '__return_false', 50); // remove visual editor
