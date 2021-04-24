<?php
defined('ABSPATH') || exit;

/**
 * For more clarity, functions have been grouped into seperate files:
 * Functions that are meant to be called directly into templated (inc/templates.php)
 * Functions related to WooCommerce have their own file (inc/woocommerce.php)
 *
 * The only exception is add_header_scripts in default-functions.php. It is disabled because
 * it doesn't allow to load both module & legacy script tag. It is instead hardcoded.
 */

require 'inc/theme-support.php';
require 'inc/default-functions.php';
require 'inc/assets-management.php';
require 'inc/image-management.php';
require 'inc/navigation.php';
require 'inc/sidebar.php';
require 'inc/admin.php';
require 'inc/templates.php';
// require 'inc/woocommerce.php'; // include WooCommerce ƒ file if needed
