<?php
/**
 * @title          Constants File
 *
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @link           http://software.hizup.com
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / Config
 */

namespace PH7;
defined('PH7') or exit('Restricted access');

################################### VARIABLES ###################################

#################### PATH ####################

#################### URL ####################


################################### CONSTANTS ###################################

#################### OTHER ####################

/***** VARIOUS *****/

define ( 'PH7_DOT', '.' );
define ( 'PH7_INTERNET_NEEDED', true ); // Please never change it if you don't know what you are doing

/***** TIME ZONE ****/

define( 'PH7_DEFAULT_TIMEZONE', 'America/Chicago' );

/***** ADMIN MODULE NAME *****/

define ( 'PH7_ADMIN_MOD', 'admin123' );

/***** PATTERN USERNAME (for 'Members', 'Affiliates' and 'Admins') *****/

define ( 'PH7_USERNAME_PATTERN', '[\w-]' );

/***** ADMIN ID (for sending email by an admin) *****/

define ( 'PH7_ADMIN_ID', 0000 ); // Don't change it please, without the permission of Pierre-Henry!

/***** ADMIN USERNAME (for sending email by an admin) *****/

define ( 'PH7_ADMIN_USERNAME', 'admin' ); // Don't change it please, without the permission of Pierre-Henry!

/***** GHOST ID *****/

define ( 'PH7_GHOST_ID', 1 ); // Don't change it please, without the permission of Pierre-Henry!

/***** GHOST USERNAME *****/

define ( 'PH7_GHOST_USERNAME', 'ghost' ); // Don't change it please, without the permission of Pierre-Henry!

/***** MAXIMUM LENGTH VALUE (for the username, email and URL) *****/

define ( 'PH7_MAX_USERNAME_LENGTH', 40 ); // Warning: don't change it because the number of the username is based on the length field (varchar(40)) of the database
define ( 'PH7_MAX_EMAIL_LENGTH', 120 );
define ( 'PH7_MAX_URL_LENGTH', 120 );

/***** DESIGN *****/

define ( 'PH7_WIDTH_SEARCH_FORM', 160 );

/***** SECURITY *****/

/*** DDoS Attack ***/
define ( 'PH7_DDOS_DELAY_SLEEP', 40 );
define ( 'PH7_DDOS_MAX_COOKIE_PAGE_LOAD', 99999999 );
define ( 'PH7_DDOS_MAX_SESSION_PAGE_LOAD', 999 );


/***** TABLE PREFIX *****/

define ( 'PH7_TABLE_PREFIX', 'pH7_' ); // Warning: don't change this value!

/***** PAGE *****/

define ( 'PH7_PAGE_EXT', '.html' );

/***** DATA *****/

define ( 'PH7_DATA', 'data/' );
define ( 'PH7_LOG', 'log' . PH7_DS );
define ( 'PH7_TMP', 'tmp' . PH7_DS );
define ( 'PH7_CACHE', 'cache' . PH7_DS );
define ( 'PH7_BACKUP', 'backup' . PH7_DS );
define ( 'PH7_SQL', 'sql' . PH7_DS );

/***** APP *****/

define ( 'PH7_SYS', 'system/' );

/***** MODULES *****/

define ( 'PH7_MOD', 'modules/' );
define ( 'PH7_CTRL', 'controllers/' );
define ( 'PH7_MODELS', 'models/' );
define ( 'PH7_VIEWS', 'views/' );
define ( 'PH7_FORMS', 'forms/' );
define ( 'PH7_INC', 'inc/' );
define ( 'PH7_LANG', 'lang/' );
define ( 'PH7_QUERY', 'query' . PH7_DS );
define ( 'PH7_CONFIG', 'config' . PH7_DS );
define ( 'PH7_CONFIG_FILE', 'config.ini' );

/***** REPOSITORY *****/

define ( 'PH7_REPOSITORY', '_repository' . PH7_DS );

/***** TEMPLATES & STATIC *****/

define ( 'PH7_LAYOUT', 'templates/' );
define ( 'PH7_TPL', 'themes/' );
define ( 'PH7_CSS', 'css/' );
define ( 'PH7_IMG', 'img/' );
define ( 'PH7_JS', 'js/' );

/***** STATIC *****/

define ( 'PH7_STATIC', 'static/' );

#################### PATH ####################

/***** DATA *****/


/*** PUBLIC DATA ***/

define ( 'PH7_PATH_PUBLIC_DATA', PH7_PATH_ROOT . PH7_DATA );
define ( 'PH7_PATH_PUBLIC_DATA_SYS', PH7_PATH_PUBLIC_DATA . PH7_SYS );
define ( 'PH7_PATH_PUBLIC_DATA_SYS_MOD', PH7_PATH_PUBLIC_DATA . PH7_SYS . PH7_MOD );
define ( 'PH7_PATH_PUBLIC_DATA_MOD', PH7_PATH_PUBLIC_DATA . PH7_MOD );

/*** PROTECTED DATA ***/

define ( 'PH7_PATH_DATA', PH7_PATH_PROTECTED . PH7_DATA );
define ( 'PH7_PATH_LOG', PH7_PATH_DATA . PH7_LOG );
define ( 'PH7_PATH_TMP', PH7_PATH_DATA . PH7_TMP );
define ( 'PH7_PATH_CACHE', PH7_PATH_DATA . PH7_CACHE );
define ( 'PH7_PATH_BACKUP', PH7_PATH_DATA . PH7_BACKUP );
define ( 'PH7_PATH_BACKUP_SQL', PH7_PATH_BACKUP . PH7_SQL );


/***** APP *****/

define ( 'PH7_PATH_APP_CONFIG', PH7_PATH_APP . 'configs/' );
define ( 'PH7_PATH_APP_LANG', PH7_PATH_APP . 'langs/' );
define ( 'PH7_PATH_SYS', PH7_PATH_APP . PH7_SYS );

/***** MODULES *****/

define ( 'PH7_PATH_MOD', PH7_PATH_APP . PH7_MOD );
define ( 'PH7_PATH_SYS_MOD', PH7_PATH_SYS . PH7_MOD );

/***** REPOSITORY *****/

define ( 'PH7_PATH_REPOSITORY', PH7_PATH_ROOT . PH7_REPOSITORY );

/***** TEMPLATES *****/

define ( 'PH7_PATH_TPL', PH7_PATH_ROOT . PH7_LAYOUT . PH7_TPL );
define ( 'PH7_PATH_TPL_MOD', PH7_PATH_ROOT . PH7_LAYOUT . PH7_MOD );
define ( 'PH7_PATH_TPL_SYS_MOD', PH7_PATH_ROOT . PH7_LAYOUT . PH7_SYS . PH7_MOD );

/***** STATIC *****/

define ( 'PH7_PATH_STATIC', PH7_PATH_ROOT . PH7_STATIC );

#################### URL (PUBLIC) ####################

/***** DATA *****/

define ( 'PH7_URL_DATA', PH7_RELATIVE . PH7_DATA );
define ( 'PH7_URL_DATA_SYS', PH7_URL_DATA . PH7_SYS );
define ( 'PH7_URL_DATA_SYS_MOD', PH7_URL_DATA . PH7_SYS . PH7_MOD );
define ( 'PH7_URL_DATA_MOD', PH7_URL_DATA . PH7_MOD );

/***** STATIC *****/

define ( 'PH7_URL_STATIC', PH7_RELATIVE . PH7_STATIC );

/***** TEMPLATES *****/

define ( 'PH7_URL_TPL', PH7_RELATIVE . PH7_LAYOUT . PH7_TPL );
define ( 'PH7_URL_TPL_MOD', PH7_RELATIVE . PH7_LAYOUT . PH7_MOD );
define ( 'PH7_URL_TPL_SYS_MOD', PH7_RELATIVE . PH7_LAYOUT . PH7_SYS . PH7_MOD );
