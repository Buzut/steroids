<?php
/* Template Name: Demo Page Template */

defined('ABSPATH') || exit;
get_header();
?>
<main>
    <h1><?php the_title(); ?></h1>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php the_content(); ?>
        <?php comments_template('', true); // Remove if you don't want comments ?>
    </article>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
