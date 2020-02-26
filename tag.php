<?php
defined('ABSPATH') || exit;
get_header();
?>
<main>
    <h1>
        <?php _e('Tag Archive: ', 'steroids'); echo single_tag_title('', false); ?>
    </h1>

    <?php get_template_part('loop'); ?>
    <?php get_template_part('templates/pagination'); ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
