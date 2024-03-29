<?php
defined('ABSPATH') || exit;
$assets_version = file_get_contents(__DIR__ . '/assets-version');
$body_classes = (is_array($args) && isset($args['body_classes']) && is_array($args['body_classes'])) ? implode(' ', $args['body_classes']) : '';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <link href="<?= get_template_directory_uri() ?>/img/icons/touch.png" rel="icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <?php Steroids\add_styles($args); ?>
        <link rel="preload" as="script" href="<?= get_template_directory_uri() ?>/scripts/build/main-<?= $assets_version ?>.js">
        <script async type="module" src="<?= get_template_directory_uri() ?>/scripts/build/main-<?= $assets_version ?>.js"></script>
        <script async nomodule src="<?= get_template_directory_uri() ?>/scripts/build/main-<?= $assets_version ?>.iife.js"></script>
        <?php wp_head(); ?>
        <?php if (IS_DEV) : ?>
            <script>
                document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] +
                ':35729/livereload.js?snipver=1"></' + 'script>')
            </script>
        <?php endif; ?>
    </head>

    <body <?php body_class($body_classes); ?>>
        <header>
            <div class="logo">
                <a href="<?= home_url() ?>">
                    <img src="<?= get_template_directory_uri() ?>/img/logo.jpg" alt="Logo" class="logo-img">
                </a>
            </div>

            <nav class="nav">
                <?php Steroids\show_menu('primary'); ?>
            </nav>
        </header>
