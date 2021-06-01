<?php defined('ABSPATH') || exit; ?>

<form class="search" method="get" action="<?= home_url() ?>" role="search">
    <input class="search-input" type="search" name="s" placeholder="<?= __('To search, type and hit enter.', 'steroids') ?>">
    <button class="search-submit" type="submit"><?= __('Search', 'steroids') ?></button>
</form>
