<?php defined('ABSPATH') || exit; ?>
<?php get_header(); ?>

<main id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
    <?php comments_template('', true); // Remove if you don't want comments ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
