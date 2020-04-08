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
