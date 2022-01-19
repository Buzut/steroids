<?php
namespace Steroids;
defined('ABSPATH') || exit;

add_image_size('large', 700, '', true); // Large Thumbnail
add_image_size('medium', 250, '', true); // Medium Thumbnail
add_image_size('small', 120, '', true); // Small Thumbnail
// add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

// Remove image sizes that won't be used to save server space
// comment what you want to keep
// add_filter('intermediate_image_sizes_advanced', function ($sizes){
//     unset($sizes['thumbnail']);
//     unset($sizes['medium']);
//     unset($sizes['medium_large']);
//     unset($sizes['large']);
//     unset($sizes['1536x1536']); // 2x medium-large size
//     unset($sizes['2048x2048']); // 2x large size
//     return $sizes;
// });

// Insert custom image size in media gallery
// just add the size's name you defined in the theme support section with add_image_size ƒ
// add_filter('image_size_names_choose', function ($sizes) {
//     $custom_sizes = ['small' => 'Small'];
//     return array_merge($sizes, $custom_sizes);
// });
