<?php
define( 'WP_CACHE', true );
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u482551446_zGu8Y' );

/** Database username */
define( 'DB_USER', 'u482551446_F69CN' );

/** Database password */
define( 'DB_PASSWORD', 'oNysZ1zE5h' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'E*u]?)gxK4ln$G }V0L;5I]n5X~{<iMg)($jJ@64#Qy%G_W;8S|TL4EbUsEJ%Cs-' );
define( 'SECURE_AUTH_KEY',   'qk=)mKcG=8[#anml;9$t+P%&sTx>p<~v+lw$_OfrQXT>@C=U1_<$6`KHwhi;xD n' );
define( 'LOGGED_IN_KEY',     '|fqK$OZWZ`99/5|^vtCoy1Zx1,usCQjoeFi|G^@Un>]lun;}kNJ!gTQ4>%GdF=<1' );
define( 'NONCE_KEY',         '!$9gM u=&mHtcW4V;e+rr1MxG1_=OPPpu<c~U,~T:kN</1^7qP+?Z/SQna=/nsjd' );
define( 'AUTH_SALT',         '{uO!c75e2k.,iH~ov,`Q:#2ArNj9K|C)pZuj=XdI}~rIl= 4HgK)Kft&6#!Q.[I]' );
define( 'SECURE_AUTH_SALT',  '+C4/QB&#E20}=,#deUk5T,p06}E} SyyA%bP<@),>q5qg;QuN)b}$AIU&j%NE%R&' );
define( 'LOGGED_IN_SALT',    'z)}t]L&7e~i{]aLt XIP nxp?(4>F4&tta2h:9b{*?LdP*bd8J9V8[ta<f8K77S4' );
define( 'NONCE_SALT',        '{^ael.(JnStQ[%H^%%gM$YyvB2I@;I o:Eu0;IJ|~OIn;V,>])rq%)?#U&ZZkd?/' );
define( 'WP_CACHE_KEY_SALT', 'OCl-7^P1,hRMF1y<(/49q%:la!YF7NHkG-kC3[@AVI3d]nZs?H]=.zSrPFsMTy?.' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '73803f41fd313f05f5c3db497f49133e' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
