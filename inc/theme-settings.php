<?php
defined('ABSPATH') || exit;
require dirname(__DIR__, 1) . '/config.php';

// Hide update notif
function steroids_hide_updates() {
    global $wp_version;
    return(object) ['last_checked' => time(), 'version_checked' => $wp_version];
}

// Activate the hide updates ƒn for all users but the first registered one
// Remove the condition if you want to hide them for all users
if (DISABLE_UI_UPDATES && (get_current_user_id() !== 1 || DISABLE_UI_UPDATES_FOR_FIRST_ADMIN)) {
    add_filter('pre_site_transient_update_core', 'remove_core_updates'); // hide updates for WordPress itself
    add_filter('pre_site_transient_update_plugins', 'remove_core_updates'); // hide updates for all plugins
    add_filter('pre_site_transient_update_themes', 'remove_core_updates'); // hide updates for all themes
}

if (THEME_SUPPORT_HTML5) add_theme_support('html5');
if (THEME_SUPPORT_MENUS) add_theme_support('menus');
if (THEME_SUPPORT_WOOCOMMERCE) add_theme_support('woocommerce');
if (THEME_SUPPORT_TITLE_TAG) add_theme_support('title-tag');
if (THEME_SUPPORT_EXCERPT) add_post_type_support('page', 'excerpt');
if (THEME_SUPPORT_POST_THUMBNAIL) add_theme_support('post-thumbnails');

// Remove p tag auto insertion
if (REMOVE_AUTO_P_TAG) {
    remove_filter('the_excerpt', 'wpautop');
    remove_filter('the_content', 'wpautop');

    add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
    add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
}

// Remove css file added for Gutenberg since wp 5.x
// most of the time not needed, especially if Gutenberg isn't used
function steroids_deactivate_gutenberg_css() {
    wp_dequeue_style('wp-block-library');
}

if (DEACTIVATE_GUTENBERG_DEFAULT_CSS) add_action('wp_enqueue_scripts', 'steroids_deactivate_gutenberg_css');

// Use a more recent version of jQuery than the stock one & get rid of jQuery migrate
// This jQuery will be loaded only if needed by a plugin
function steroids_upgrade_jquery(&$scripts) {
    if (!is_admin() && UNLOAD_JQUERY) $scripts->remove('jquery');

    // If any plugin needs it, it'll load jQuery 3.5.1 (lighter and more modern that WP stock one)
    // can be commented if jQuery won't be needed in any way
    $scripts->add('jquery', get_template_directory_uri() . '/scripts/jquery.js', [], false);
}

if (OVERRIDE_JQUERY) add_filter('wp_default_scripts', 'steroids_upgrade_jquery');

// Convert css links to HTML5
function steroids_clean_style_tag($html, $handle, $href, $media) {
    $stripped_type = str_replace(" type='text/css'", '', $html);
    $stripped_id = str_replace( " id='$handle-css' ", '', $stripped_type);
    return str_replace(" media='all' /", '', $stripped_id);
}
add_filter('style_loader_tag', 'steroids_clean_style_tag', 10, 4); // Convert css links to HTML5

// Remove query string from static files
function steroids_remove_cssjs_ver($src) {
    if (strpos($src, '?ver='))
    $src = remove_query_arg('ver', $src);
    return $src;
}

if (REMOVE_QUERY_STRING) {
    add_filter('style_loader_src', 'steroids_remove_cssjs_ver', 10, 2);
    add_filter('script_loader_src', 'steroids_remove_cssjs_ver', 10, 2);
}

// Remove counter-productive auto dns prefetch
function steroids_remove_dns_prefetch($hints, $relation_type) {
    if ('dns-prefetch' === $relation_type) return array_diff(wp_dependencies_unique_hosts(), $hints);
    return $hints;
}

if (REMOVE_DNS_PREFETCH) add_filter('wp_resource_hints', 'steroids_remove_dns_prefetch', 10, 2);

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function steroids_remove_thumbnail_dimensions($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

if (REMOVE_THUMBNAIL_IMG_WIDTH_HEIGHT) {
    add_filter('post_thumbnail_html', 'steroids_remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
    add_filter('image_send_to_editor', 'steroids_remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
}

// Replace all non ASCII chars from media names
// https://wpartisan.me/tutorials/rename-clean-wordpress-media-filenames
if (REPLACE_NON_ASCII_IN_IMG_NAME) {
    add_filter('sanitize_file_name', function ($filename) {
        $sanitized_filename = remove_accents($filename); // Convert to ASCII

        // Standard replacements
        $invalid = [
            ' '   => '-',
            '%20' => '-',
            '_'   => '-',
        ];
        $sanitized_filename = str_replace(array_keys($invalid), array_values($invalid), $sanitized_filename);

        $sanitized_filename = preg_replace('/[^A-Za-z0-9-\. ]/', '', $sanitized_filename); // Remove all non-alphanumeric except .
        $sanitized_filename = preg_replace('/\.(?=.*\.)/', '', $sanitized_filename); // Remove all but last .
        $sanitized_filename = preg_replace('/-+/', '-', $sanitized_filename); // Replace any more than one - in a row
        $sanitized_filename = str_replace('-.', '.', $sanitized_filename); // Remove last - if at the end
        $sanitized_filename = strtolower($sanitized_filename); // Lowercase

        return $sanitized_filename;
    }, 10, 1);
}

// Replace src img by large image
// prevents from keeping huge uncompressed images and eventually serving that to visitors
// also replace auto-scaling
// https://make.wordpress.org/core/2019/10/09/introducing-handling-of-big-images-in-wordpress-5-3/
function steroids_replace_uploaded_image($image_data) {
    // var_dump($image_data);
    if (!isset($image_data['sizes']['large'])) return $image_data;

    $upload_dir = wp_upload_dir();
    $uploaded_image_location = $upload_dir['basedir'] . '/' . $image_data['file'];
    $banner_image_location = $upload_dir['path'] . '/' . $image_data['sizes']['large']['file'];

    unlink($uploaded_image_location);
    rename($banner_image_location, $uploaded_image_location);

    $image_data['width'] = $image_data['sizes']['large']['width'];
    $image_data['height'] = $image_data['sizes']['large']['height'];
    unset($image_data['sizes']['large']);

    return $image_data;
}

if (REPLACE_SRC_IMG_FILE_BY_LARGE_IMG) {
    add_filter('big_image_size_threshold', '__return_false');
    add_filter('wp_generate_attachment_metadata', 'steroids_replace_uploaded_image');
}
