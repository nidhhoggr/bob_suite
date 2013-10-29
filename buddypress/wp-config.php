<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'suprali1_buddypress');

/** MySQL database username */
define('DB_USER', 'suprali1');

/** MySQL database password */
define('DB_PASSWORD', 'A1genda666!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '>OG~q?&1:oO/HBmtl_ZS&u9U`-tE,~:Bd)X`O+) +|%>YBCYJzM8Kh#p-gXul0BZ');
define('SECURE_AUTH_KEY',  'S)hcq_Pkl;NN|X]S4Dm22~Y;GaF){=kD8cgC@.N`|f`gCpwzk]>%zTx~yeKOFy`r');
define('LOGGED_IN_KEY',    '6W+McG.tp/Hr_oy:/v{=$hbc#/h>=NG{@^hZ#m=/GO2u#LobQV(-gLX?MX>XolNO');
define('NONCE_KEY',        '>Gr4:n9`Y-CU4Q5_o7PP1a2+cnwXv#ASt|Vn%!JF$[2W Twf<$!7H/|HpJxB%dq~');
define('AUTH_SALT',        'W`QIxeKpfH7o>rh}/DB0U?:8U#G<MRS3I-x~/{E+T]@7Ebyzz7$1?Z=/jG.fmL9e');
define('SECURE_AUTH_SALT', 'V2VJ:`9-9ex3b~L(-Ybdn$!NpAIn!-/)F{>BHXl<y`d|q:K[ -)BWnpKC0&VITI6');
define('LOGGED_IN_SALT',   'cC,4px1KM#dApA8nqXWKMh;C&=)L)4nX>cw+pX8]-u7F+844h^|O_k,&r^U{Ycq@');
define('NONCE_SALT',       'tITse><n(}+c#`[-Njk`cN~3,$$`AK[#N13VN>GJlS?w}&l~}1Nm65uK|)Nsg2:M');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
