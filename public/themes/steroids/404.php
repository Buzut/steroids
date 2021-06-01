<?php
defined('ABSPATH') || exit;
get_header();
?>

<main id="post-404">
    <h1><?= __('Page not found', 'steroids') ?></h1>
    <h2>
        <a href="<?= home_url() ?>"><?= __('Return home?', 'steroids') ?></a>
    </h2>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
