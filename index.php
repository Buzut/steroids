<?php get_header(); ?>

	<main>
		<h1><?php _e('Latest Posts', 'steroids'); ?></h1>

		<?php get_template_part('loop'); ?>
		<?php get_template_part('pagination'); ?>
	</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
