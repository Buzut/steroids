<?php
/** Assets management */
const OVERRIDE_JQUERY = true; // Get rid of jQuery Migrate and use jQuery 3.6

// Works with OVERRIDE_JQUERY
// Unload jQuery by default, loading it only if a plugin requires it
// Your code won't be able to rely on jQuery
const UNLOAD_JQUERY = true;

const REMOVE_QUERY_STRING = true; // Remove query strings from CSS & JS assets
const REMOVE_DNS_PREFETCH = true; // Remove useless DNS prefetch queries

/** Theme support */
// https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/
const REMOVE_AUTO_P_TAG = TRUE;
const THEME_SUPPORT_HTML5 = true;
const THEME_SUPPORT_MENUS = true;
const THEME_SUPPORT_EXCERPT = true;
const THEME_SUPPORT_TITLE_TAG = true;
const THEME_SUPPORT_WOOCOMMERCE = false;
const THEME_SUPPORT_POST_THUMBNAIL = true;
const DEACTIVATE_GUTENBERG_DEFAULT_CSS = false;

/** Image management */
const REMOVE_THUMBNAIL_IMG_WIDTH_HEIGHT = true; // Remove default HTML width/height that prevents fluid images
const REMOVE_SRCSET = false;
const IMG_COMPRESS_QUALITY = 80;
const REPLACE_NON_ASCII_IN_IMG_NAME = true;
const REPLACE_SRC_IMG_FILE_BY_LARGE_IMG = false; // Get rid of source image file and only store the big generated image

/** Admin */
// By default, still show updates to user whose id = 1 (first registered user & admin)
const DISABLE_UI_UPDATES = false;
const DISABLE_UI_UPDATES_FOR_FIRST_ADMIN = false; // Hide updates to first admin
