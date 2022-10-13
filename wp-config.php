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

define( 'DB_NAME', "meta_code" );


/** Database username */

define( 'DB_USER', "root" );


/** Database password */

define( 'DB_PASSWORD', "" );


/** Database hostname */

define( 'DB_HOST', "localhost" );


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

define('AUTH_KEY',         'HjfdA8ipaHpuOqCnqKze1Oq5X8ms1gndbS8vMivOBBfSTal2JYmXTMgBlQXv505O');

define('SECURE_AUTH_KEY',  '2vr9wlnz5JJmsNvXq3zD7cVOfFk2oOkPnZubCGAqynwl9LHwBy6NzhnVZCKDPzzV');

define('LOGGED_IN_KEY',    'IcAT7olj516jfrMZKoBhXQQu5VpuARkRxedklt5dS6Nue1ybKBL5q99n4zS2MAiB');

define('NONCE_KEY',        'furNbHYoO9YMOiQZLXxQATwFDNDOqUO1fCco66VhsBsQOzq4KsH7mRFyKr5QFGy8');

define('AUTH_SALT',        'wMaJcaWKasHboGMFmvOC3ssHLql2HrdFrdMUjXjGT34zETxV6ZtzNCG8yW30Xcz9');

define('SECURE_AUTH_SALT', 'VtUExqyCrBoKQdkA7JlVWz71MOMQHD9GA8Nr6H5niAJbWFDwTmSuN3l4uZUayh9J');

define('LOGGED_IN_SALT',   'YN42MU2qvH0O8ZrOG4fOfjH5F7QrKBOR6rOJCoFToKSj5XgAPKZpT31ry8B06bLu');

define('NONCE_SALT',       '4PQp7LI2MWl4knkNnq5nuunLnjMEJTv1dFb2MoC7SQ2CCtC5CJ4rYb75qL3GB4sx');


/**

 * Other customizations.

 */

define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define( 'WP_TEMP_DIR', 'C:/wamp64/www/public/metacode/wp-content/uploads' );



/**#@-*/


/**

 * WordPress database table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'hguy_';


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

define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */




define( 'DISABLE_WP_CRON', true );
define( 'WP_SITEURL', 'http://public/metacode/' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', dirname(__FILE__) . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

