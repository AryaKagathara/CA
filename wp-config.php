<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wnutcom_ca' );

/** Database username */
define( 'DB_USER', 'wnutcom_ca' );

/** Database password */
define( 'DB_PASSWORD', 'y*WI}@#fib19' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'cMg zFVu.c1p*C|F:m]+#g VlZ@#Qx^495Kf*aRPUkjdyv6Kb(m|XUV}>fuN$8G(' );
define( 'SECURE_AUTH_KEY',  '^<TLG$@UHR0D|FtNa|[o/qMLks{|Hs <<UvVc.O8EpIIALon/[v#yz[%][*dX=(=' );
define( 'LOGGED_IN_KEY',    '^kc2@N}cVvR6Ko~YQ~Q%50S?<@i2Vf+ZkH?;{>@(ZyNmKuvj|J[HK<8EWa>K*(D/' );
define( 'NONCE_KEY',        '!4|1UEqG3-eyD|Tb5k8Lf+dzu[J+z1x4>8a$~fc*lP*jZx$L^?P6hbOO<e0<OeI.' );
define( 'AUTH_SALT',        ',,fBedrX9ae$@o!TF95c4Z/{JwUN3h.V}2[xKmdNG=ls]vp,8odvf#;_N3+1.Ki4' );
define( 'SECURE_AUTH_SALT', '}ze(VpcV!pg4Dfh$I;<Dc/9|t.@ZoW7Y^5&L.qS::Hjk+c`-6[s3UfamkNTjO=2b' );
define( 'LOGGED_IN_SALT',   'AO-$_YN%E.f]p2Kw9u+KN-D0xrdZ`-A(=9ODhh>Zl#%B `S$JRE>8`3KY(e[fh`n' );
define( 'NONCE_SALT',       'Wp}twTB;qk[ZO:v8OyU]|6&B$%=AtvjrQ-3v=urm{t+VNSt+SrtLa+39+GD;{1jd' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
