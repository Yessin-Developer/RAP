<?php
/**
 * Local WordPress configuration
 * Place this in your WordPress root as wp-config.php
 */

// ** Database settings ** //
define( 'DB_NAME', getenv('DB_NAME') ?: 'wordpress' );
define( 'DB_USER', getenv('DB_USER') ?: 'wordpress' );
define( 'DB_PASSWORD', getenv('DB_PASSWORD') ?: 'wordpress' );
define( 'DB_HOST', getenv('DB_HOST') ?: 'db' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

// ** Authentication Unique Keys and Salts ** //
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

// ** WordPress Database Table prefix ** //
$table_prefix = getenv('DB_PREFIX') ?: 'wp_';

// ** WordPress debugging mode ** //
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
define( 'SCRIPT_DEBUG', true );

// ** Site URL Configuration ** //
define( 'WP_HOME', getenv('WP_HOME') ?: 'https://rap.local' );
define( 'WP_SITEURL', getenv('WP_SITEURL') ?: 'https://rap.local' );

// ** HTTPS detection ** //
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
    $_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

