<?php
defined('ABSPATH') || exit;

/*
 * The functions defined below are meant to be called directly in the templates
 */

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function steroids_pagination() {
    global $wp_query;

    echo paginate_links([
        'format' => 'page/%#%/',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ]);
}

// If posts (or anything) are saved in Md, this ƒn will convert it into HTML
// To be used with get_the_content (for posts/pages) because the_content echoes instead of returning
// Alse be carefull because the_content doesn't any sanitisation (you can apply them later on if required)
function steroids_parse_markdown($content) {
    $Parsedown = require_once 'Parsedown.php';
    $Parsedown = new Parsedown();
    return $Parsedown->text($content);
}
