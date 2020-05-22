<?php
defined('ABSPATH') || exit;

/**
 * All the functions defined below aren't called by default
 * To enable one, just uncomment its hook/filter
 */

// remove css file added for Gutenberg since wp 5.x
// most of the time not needed, especially if Gutenberg isn't used
function steroids_deactivate_gutenberg_css() {
    wp_dequeue_style('wp-block-library');
}
// add_action('wp_enqueue_scripts', 'steroids_deactivate_gutenberg_css');
