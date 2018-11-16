<?php defined('ABSPATH') || exit; ?>
<?php get_header(); ?>

	<main id="post-404">
		<h1><?php _e('Page not found', 'steroids'); ?></h1>
		<h2>
			<a href="<?= home_url() ?>"><?php _e('Return home?', 'steroids'); ?></a>
		</h2>
	</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
