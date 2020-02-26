<?php
defined('ABSPATH') || exit;
get_header();
?>
<main>
	<h1>
        <?php _e('Categories for ', 'steroids'); single_cat_title(); ?>
    </h1>

	<?php get_template_part('loop'); ?>
	<?php get_template_part('templates/pagination'); ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
