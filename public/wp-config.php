<?php

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually".
|
*/

require dirname(__DIR__, 1) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->safeLoad();

// DB config
$table_prefix = $_ENV['TABLE_PREFIX'];
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_CHARSET', $_ENV['DB_CHARSET']);
define('DB_COLLATE', $_ENV['DB_COLLATE']);

// Paths config
define('WP_HOME', $_ENV['WP_HOME']);
define('WP_SITEURL', $_ENV['WP_SITEURL']);
define('WP_CONTENT_DIR', __DIR__);
define('WP_CONTENT_URL', WP_HOME);
define('WP_ADMIN_DIR', __DIR__ . '/wp');

// WordPress options
define('IS_DEV', filter_var($_ENV['IS_DEV'], FILTER_VALIDATE_BOOLEAN));
define('WP_DEBUG', filter_var($_ENV['WP_DEBUG'], FILTER_VALIDATE_BOOLEAN));
define('WP_DEBUG_DISPLAY', filter_var($_ENV['WP_DEBUG_DISPLAY'], FILTER_VALIDATE_BOOLEAN));
define('WP_DEBUG_LOG', $_ENV['WP_DEBUG_LOG']);

define('DISABLE_WP_CRON', $_ENV['DISABLE_WP_CRON']);
define('DISABLE_WP_CRON', filter_var($_ENV['DISALLOW_FILE_EDIT'], FILTER_VALIDATE_BOOLEAN));
define('DISALLOW_FILE_EDIT', filter_var($_ENV['DISALLOW_FILE_EDIT'], FILTER_VALIDATE_BOOLEAN)); // Disable UI src files editor
define('DISALLOW_FILE_MODS', filter_var($_ENV['DISALLOW_FILE_MODS'], FILTER_VALIDATE_BOOLEAN)); // Disable modifications on all files (and updates)
define('AUTOMATIC_UPDATER_DISABLED', filter_var($_ENV['AUTOMATIC_UPDATER_DISABLED'], FILTER_VALIDATE_BOOLEAN)); // Disable auto updates
define('WP_POST_REVISIONS', $_ENV['WP_POST_REVISIONS']); // Number of revisions to save

// Security salts
define('AUTH_KEY', $_ENV['AUTH_KEY']);
define('SECURE_AUTH_KEY', $_ENV['SECURE_AUTH_KEY']);
define('LOGGED_IN_KEY', $_ENV['LOGGED_IN_KEY']);
define('NONCE_KEY', $_ENV['NONCE_KEY']);
define('AUTH_SALT', $_ENV['AUTH_SALT']);
define('SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT']);
define('LOGGED_IN_SALT', $_ENV['LOGGED_IN_SALT']);
define('NONCE_SALT', $_ENV['NONCE_SALT']);

if (!defined('ABSPATH')) define('ABSPATH', __DIR__ . '/');
require_once __DIR__ . '/wp/wp-settings.php';
