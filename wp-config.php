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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ibtic' );

/** Database username */
define( 'DB_USER', 'root');

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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

define('AUTH_KEY',         '$=RRZ:=B#PFCpBNzOcd.Ck@5 -<7d<_Ro^B*rJIZ=Dx0v]XpuatK;jnBq$yW-hLm');
define('SECURE_AUTH_KEY',  'HS[_B+5z 3{E7k+Zw}-CUyp0;2(b<NhhF6%yG_?1^E+5VAsqj?>}99J{Oh]b(A]Q');
define('LOGGED_IN_KEY',    'C_A#2lc+5E/6AhE^tN#giku&35+8:u13j&jh<Pt`rL.C6Wctu0(f-U?^l9c@-9>?');
define('NONCE_KEY',        'X++nkF|D1(P{~x=|Ha6f-)dP$:b6^48,?h^-T;SSl!+`t[Z-p_*LlGWtdK:xdbsU');
define('AUTH_SALT',        '#D~KF$1st}C$|NDb6uwbArWJN07J+3WX:rdEK|f2.Rg%K;aqvtBszN)A-;JV};};');
define('SECURE_AUTH_SALT', 'L+lCfFXm2T+2t}P6T/#SX{u 0p.7 7k/d=/>-_?Yi+$tiP(w)#s^Q-fT917U=w{m');
define('LOGGED_IN_SALT',   '~J41V]6/v:?<|-,D<qG?8QS,[GKAtG_n@3|m&N}(:-]-oXwy0vF_~6skij?}v1w2');
define('NONCE_SALT',       '8S7^!Rk^!2 $*K+aKEcMRL(?1yFp ]ASx_}tZ-M[99i55Q-,%C66|H3]T%GL+U&a');

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */
 define( 'ENVIRONMENT', 'local' );
// define( 'ENVIRONMENT', 'production' );
define('SECRET_CAPTCHA', '0xcFd66a5dA42B543c998aC8FA36b6eA548899c990');
//define('EMAIL_CAU_EDUCACIO', 'educacio@fundaciobit.org');
define('EMAIL_CAU_EDUCACIO', 'maciaforteza@ibsteam.cat');

/* FTP */
define('FS_METHOD','direct');
define('FTP_SSL',false);


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
