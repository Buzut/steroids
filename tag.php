<?php get_header(); ?>

	<main>
        <h1><?php _e('Tag Archive: ', 'html5blank'); echo single_tag_title('', false); ?></h1>

        <?php get_template_part('loop'); ?>
        <?php get_template_part('pagination'); ?>
	</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
