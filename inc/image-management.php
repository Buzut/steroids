<?php
defined('ABSPATH') || exit;

add_image_size('large', 700, '', true); // Large Thumbnail
add_image_size('medium', 250, '', true); // Medium Thumbnail
add_image_size('small', 120, '', true); // Small Thumbnail
// add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function steroids_remove_thumbnail_dimensions($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}
add_filter('post_thumbnail_html', 'steroids_remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'steroids_remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

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
// add_filter('big_image_size_threshold', '__return_false');
// add_filter('wp_generate_attachment_metadata', 'steroids_replace_uploaded_image');

// Insert custom image size in media gallery
// just add the size's name you defined in the theme support section with add_image_size ƒ
function steroids_set_ui_image_sizes($sizes) {
    $custom_sizes = ['small' => 'Small'];

    return array_merge($sizes, $custom_sizes);
}
// add_filter('image_size_names_choose', 'steroids_set_ui_image_sizes');

// https://developer.wordpress.org/reference/hooks/jpeg_quality/
// add_filter('jpeg_quality', function($arg){ return 50; }); // How to compress images
// add_filter('wp_calculate_image_srcset_meta', '__return_null'); // Remove srcset
