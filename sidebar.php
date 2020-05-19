<?php defined('ABSPATH') || exit; ?>
<aside class="sidebar">
    <?php get_template_part('templates/searchform'); ?>

    <div class="sidebar-widget">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
    </div>

    <div class="sidebar-widget">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
    </div>
</aside>
