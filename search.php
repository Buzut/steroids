<?php
defined('ABSPATH') || exit;
get_header();
?>
<main>
    <h1>
        <?php printf(__('%s Search Results for ', 'steroids'), $wp_query->found_posts); echo get_search_query(); ?>
    </h1>

    <?php get_template_part('loop'); ?>
    <?php get_template_part('templates/pagination'); ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
