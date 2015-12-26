<?php
/**
 * This script computing requirements of the software.
 * It was written in order to be standarlone and can be used in different projects.
 * If you want to use in your project, please keep the license and contact the developer in writing in order to have permission from the redistribution of the script.
 *
 * @package        Install
 * @file           requirements
 * @author         Pierre-Henry Soria
 * @email          <hello@ph7cms.com>
 * @copyright      (c) 2011-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        Lesser General Public License (LGPL) (http://www.gnu.org/copyleft/lesser.html)
 * @language       (PHP) and (HTML5 + CSS)
 * @since          2011/10/25
 * @version        Last revision: 2013/09/14
 */

defined('PH7') or exit('Restricted access');

$aErrors = array();

if (version_compare(PHP_VERSION, PH7_REQUIRE_SERVER_VERSION, '<')) {
    $aErrors[] = 'Your PHP version is ' . PHP_VERSION . '. pH7CMS requires PHP ' . PH7_REQUIRE_SERVER_VERSION . ' or newer.';
}

if (!extension_loaded ('pdo_mysql')) {
    $aErrors[] = 'Please install "PDO" PHP extension with MySQL driver.';
}

if (!extension_loaded('zip')) {
    $aErrors[] = 'Please install "Zip" compression PHP extension.';
}

if (!extension_loaded('zlib')) {
    $aErrors[] = 'Please install "Zlib" compression PHP extension.';
}

if (!extension_loaded('gd')) {
    $aErrors[] = 'Please install "GD" graphics PHP extension.';
}

if (!function_exists('curl_init')) {
    $aErrors[] = 'Please install "cURL" PHP library.';
}

if (!extension_loaded('mbstring')) {
    $aErrors[] = 'Please install "mbstring" PHP extension.';
}

$iErrors = (!empty($aErrors)) ? count($aErrors) : 0;

if ($iErrors > 0) {
    echo '<!doctype html><html><head><meta charset="utf-8"><title>Requirements - Installation of pH7CMS</title><style>body{background:#EFEFEF;color:#555;font:normal 10pt Arial,Helvetica,sans-serif;margin:0;padding:0}.center{margin-left:auto;margin-right:auto;text-align:center;width:80%}.error{color:red;font-size:13px}.success{color:green}.success,.error{font-weight:bold}.italic{font-style:italic}.underline{text-decoration:underline}</style></head><body><div class="center">';

    printf('<h3 class="error underline italic">You have %d error(s):</h3>', $iErrors);

    for ($i = 0; $i < $iErrors; $i++) {
        printf('<p class="error">%d) %s</p>', $i+1, $aErrors[$i]);
    }

    echo '</div></body></html>';

    exit(1);
}
