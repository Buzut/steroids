<?php get_header(); ?>

	<main>
		<h1><?php _e('Archives', 'html5blank'); ?></h1>

		<?php get_template_part('loop'); ?>
		<?php get_template_part('pagination'); ?>
	</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
