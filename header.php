<?php
defined('ABSPATH') || exit;
$assets_version = file_get_contents(__DIR__ . '/assets-version');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <title><?php wp_title(''); ?><?php if (wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
        <link href="<?= get_template_directory_uri() ?>/img/icons/touch.png" rel="icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/styles/main-<?= $assets_version ?>.min.css">
        <script async type="module" src="/js/main-<?= $assets_version ?>.esm.min.js"></script>
        <script async nomodule src="/js/main.iife-<?= $assets_version ?>.min.js"></script>
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <header>
                <div class="logo">
                    <a href="<?= home_url() ?>">
                        <img src="<?= get_template_directory_uri() ?>/img/logo.jpg" alt="Logo" class="logo-img">
                    </a>
                </div>

                <nav class="nav">
                    <?php steroids_primary_nav(); ?>
                </nav>
        </header>
