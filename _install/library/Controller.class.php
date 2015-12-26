<?php
/**
 * @title            Controller Core Class
 *
 * @author           Pierre-Henry Soria <hello@ph7cms.com>
 * @copyright        (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license          GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @link             http://ph7cms.com
 * @package          PH7 / Install / Library
 */

namespace PH7;
defined('PH7') or die('Restricted access');

abstract class Controller implements IController
{

    const
    SOFTWARE_NAME = 'pH7CMS',
    SOFTWARE_PREFIX_COOKIE_NAME = 'pH7',
    SOFTWARE_WEBSITE = 'http://ph7cms.com',
    SOFTWARE_LICENSE_URL = 'http://ph7cms.com/legal/license',
    SOFTWARE_HELP_URL = 'http://clients.hizup.com/support', // Help Desk URL
    SOFTWARE_LICENSE_KEY_URL = 'http://ph7cms.com/web/buysinglelicense',
    SOFTWARE_DOWNLOAD_URL = 'http://download.hizup.com/',
    SOFTWARE_REQUIREMENTS_URL = 'http://ph7cms.com/doc/en/requirements',
    SOFTWARE_HOSTING_LIST_URL = 'http://ph7cms.com/hosting',
    SOFTWARE_HOSTING_LIST_FR_URL = 'http://ph7cms.com/doc/fr/h%C3%A9bergement-web',
    SOFTWARE_EMAIL = 'ph7software@gmail.com',
    SOFTWARE_AUTHOR = 'Pierre-Henry Soria',
    SOFTWARE_LICENSE = 'GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.',
    SOFTWARE_COPYRIGHT = '© (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.',
    /** "Xmas" Version is a really "special" one as it will be released on the 24th with some unexpected features!!! Happy Christmas guys! **/
    SOFTWARE_VERSION_NAME = 'Xmas', // 1.0 and 1.1 branches were "pOH", 1.2 branch is now "pOW" and the new one should be "p[H]"
    SOFTWARE_VERSION = '1.2.7',
    SOFTWARE_BUILD = '1',
    DEFAULT_LANG = 'en',
    DEFAULT_THEME = 'base';

    protected $oView, $sCurrentLang;

    public function __construct ()
    {
        global $LANG;

        // PHP session initialization
        if (empty($_SESSION)) {
            @session_start();
        }

        // Verify and correct the time zone if necessary
        if (!ini_get('date.timezone')) {
            date_default_timezone_set(PH7_DEFAULT_TIMEZONE);
        }

        // Language initialization
        $this->sCurrentLang = (new Language)->get();
        include_once PH7_ROOT_INSTALL . 'langs/' . $this->sCurrentLang . '/install.lang.php';

        /* Smarty initialization */
        $this->oView = new \Smarty;
        $this->oView->use_sub_dirs = true;
        $this->oView->setTemplateDir(PH7_ROOT_INSTALL . 'views/' . self::DEFAULT_THEME);
        $this->oView->setCompileDir(PH7_ROOT_INSTALL . 'data/caches/smarty_compile');
        $this->oView->setCacheDir(PH7_ROOT_INSTALL  . 'data/caches/smarty_cache');
        $this->oView->setPluginsDir(PH7_ROOT_INSTALL . 'library/Smarty/plugins');
        // Smarty Cache
        $this->oView->caching = 0; // 0 = Cache disabled |  1 = Cache never expires | 2 = Set the cache duration at "cache_lifetime" attribute
        $this->oView->cache_lifetime = 86400; // 86400 seconds = 24h

        $this->oView->assign('LANG', $LANG);
        $this->oView->assign('software_name', self::SOFTWARE_NAME);
        $this->oView->assign('software_version', self::SOFTWARE_VERSION . ' Build ' . self::SOFTWARE_BUILD . ' - ' . self::SOFTWARE_VERSION_NAME);
        $this->oView->assign('software_website', self::SOFTWARE_WEBSITE);
        $this->oView->assign('software_license_url', self::SOFTWARE_LICENSE_URL);
        $this->oView->assign('software_help_url', self::SOFTWARE_HELP_URL);
        $this->oView->assign('software_license_key_url', self::SOFTWARE_LICENSE_KEY_URL);
        $this->oView->assign('software_author', self::SOFTWARE_AUTHOR);
        $this->oView->assign('software_copyright', self::SOFTWARE_COPYRIGHT);
        $this->oView->assign('software_email', self::SOFTWARE_EMAIL);
        $this->oView->assign('tpl_name', self::DEFAULT_THEME);
        $this->oView->assign('current_lang', $this->sCurrentLang);
    }
}
