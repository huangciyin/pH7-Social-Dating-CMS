<?php
/**
 * @title            Core Controller Class
 * @desc             Base class for controllers.
 *
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2011-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license          GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package          PH7 / Framework / Mvc / Controller
 * @version          1.2
 */

namespace PH7\Framework\Mvc\Controller;
defined('PH7') or exit('Restricted access');

use
PH7\Framework\Security\Ban\Ban,
PH7\Framework\Ip\Ip,
PH7\Framework\Geo\Ip\Geo,
PH7\Framework\Http\Http,
PH7\Framework\Mvc\Router\Uri,
PH7\Framework\Module\Various as SysMod,
PH7\Framework\Mvc\Model as M;

abstract class Controller extends \PH7\Framework\Core\Core
{

    public function __construct()
    {
        parent::__construct();

        $this->_ddosProtection();

        /***** Assign the values for Registry Class *****/

        // URL
        $this->registry->site_url = PH7_URL_ROOT;
        $this->registry->url_relative = PH7_RELATIVE;
        $this->registry->page_ext = PH7_PAGE_EXT;

        // Site Name
        $this->registry->site_name = M\DbConfig::getSetting('siteName');


        /***** Internationalization *****/
        // Default path language
        $this->lang->load('global', PH7_PATH_APP_LANG);


        /***** PH7Tpl Template Engine initialization *****/
        /*** Assign the global variables ***/

        /*** Objects ***/
        $this->view->config = $this->config;
        $this->view->design = $this->design;

        /***** Info *****/
        $oInfo = M\DbConfig::getMetaMain(PH7_LANG_NAME);

        $aMetaVars = [
            'site_name' => $this->registry->site_name,
            'page_title' => $oInfo->pageTitle,
            'slogan' => $oInfo->slogan,
            'meta_description' => $oInfo->metaDescription,
            'meta_keywords' => $oInfo->metaKeywords,
            'meta_author' => $oInfo->metaAuthor,
            'meta_robots' => $oInfo->metaRobots,
            'meta_copyright' => $oInfo->metaCopyright,
            'meta_rating' => $oInfo->metaRating,
            'meta_distribution' => $oInfo->metaDistribution,
            'meta_category' => $oInfo->metaCategory,
            'header' => 0, // Default value of header contents
            'is_disclaimer' => (bool) M\DbConfig::getSetting('disclaimer'), // Displays a disclaimer to enter to the site. This is useful for sites with adult content
            'is_cookie_consent_bar' => (bool) M\DbConfig::getSetting('cookieConsentBar'), // Displays a header cookie information bar
            /* Put user's Geo details (country/city) into the template variables */
            'country' => Geo::getCountry(),
            'city' => Geo::getCity()
        ];

        $this->view->assigns($aMetaVars);

        $aModsEnabled = [
            'is_connect_enabled' => SysMod::isEnabled('connect'),
            'is_affiliate_enabled' => SysMod::isEnabled('affiliate'),
            'is_game_enabled' => SysMod::isEnabled('game'),
            'is_chat_enabled' => SysMod::isEnabled('chat'),
            'is_chatroulette_enabled' => SysMod::isEnabled('chatroulette'),
            'is_picture_enabled' => SysMod::isEnabled('picture'),
            'is_video_enabled' => SysMod::isEnabled('video'),
            'is_hotornot_enabled' => SysMod::isEnabled('hotornot'),
            'is_forum_enabled' => SysMod::isEnabled('forum'),
            'is_note_enabled' => SysMod::isEnabled('note'),
            'is_blog_enabled' => SysMod::isEnabled('blog'),
            'is_newsletter_enabled' => SysMod::isEnabled('newsletter'),
            'is_invite_enabled' => SysMod::isEnabled('invite'),
            'is_webcam_enabled' => SysMod::isEnabled('webcam')
        ];
        $this->view->assigns($aModsEnabled);
        unset($oInfo, $aMetaVars, $aModsEnabled);

        /**
         * This below PHP condition is not necessary because if there is no session,
         * the get() method of the \PH7\Framework\Session\Session object an empty value and revisit this avoids having undefined variables in some modules (such as the "connect" module).
         */
        //if (\PH7\UserCore::auth()) {
            $this->view->count_unread_mail = \PH7\MailCoreModel::countUnreadMsg($this->session->get('member_id'));
            $this->view->count_pen_friend_request = \PH7\FriendCoreModel::getPending($this->session->get('member_id'));
        //}

        /***** Display *****/
        $this->view->setTemplateDir($this->registry->path_module_views . PH7_TPL_MOD_NAME);

        /***** End Template Engine PH7Tpl *****/

        $this->_checkPerms();
        $this->_checkModStatus();
        $this->_checkBanStatus();
        $this->_checkSiteStatus();
    }

    /**
     * Output Stream Views.
     *
     * @final
     * @param string $sFile Specify another display file instead of the default layout file. Default NULL
     * @return void
     */
    final public function output($sFile = null)
    {
        /**
         * Remove database information for the tpl files in order to prevent any attack attempt.
         **/
        \PH7\Framework\Mvc\Router\FrontController::getInstance()->_removeDatabaseInfo();

       /**
        * Destroy all object instances of PDO and close the connection to the database before the display and the start of the template and free memory
        */
        M\Engine\Db::free();

       /**
        * Output our template and encoding.
        */

        $sFile = (!empty($sFile)) ? $sFile : $this->view->getMainPage();

        // header('Content-type: text/html; charset=' . PH7_ENCODING);
        $this->view->display($sFile, PH7_PATH_TPL . PH7_TPL_NAME . PH7_DS);
        $this->view->clean();  // Clean Template Data
    }

    /**
     * Includes a template file in the main layout.
     * Note: For viewing you need to use the \PH7\Framework\Mvc\Controller::output() method.
     *
     * @final
     * @param string $sFile
     * @return void
     */
    final public function manualTplInclude($sFile)
    {
        $this->view->manual_include = $sFile;
    }

    /**
     * Set a Not Found Error Message with HTTP 404 Code Status.
     *
     * @final
     * @param string $sMsg Default is empty ('')
     * @param boolean $b404Status For the Ajax blocks and others, we cannot put the HTTP 404 error code, so the attribute must be set to FALSE. Default TRUE
     * @return void Quits the page with the exit() function
     */
    final public function displayPageNotFound($sMsg = '', $b404Status = true)
    {
        if ($b404Status) Http::setHeadersByCode(404);

        $this->view->page_title = (!empty($sMsg)) ? t('%0% - Page Not Found', $sMsg) : t('Page Not Found');
        $this->view->h1_title = (!empty($sMsg)) ? $sMsg : t('Whoops! The page you requested was not found.');

        $sErrorDesc = t('You may have clicked an expired link or mistyped the address. Some web addresses are case sensitive.') . '<br />
        <strong><em>' . t('Suggestions:') . '</em></strong><br />
        <a href="' . $this->registry->site_url . '">' . t('Return home') . '</a><br />';

        if (!\PH7\UserCore::auth())
        {
            $sErrorDesc .=
            '<a href="' . Uri::get('user','signup','step1') . '">' . t('Join Now') . '</a><br />
             <a href="' . Uri::get('user','main','login') . '">' . t('Login') . '</a><br />';
        }

        $sErrorDesc .= '<a href="javascript:history.back();">' . t('Go back to the previous page') . '</a><br />';

        $this->view->error_desc = $sErrorDesc;

        $this->view->pOH_not_found = 1;
        $this->output();
        exit;
    }

    /**
     * Set an Access Denied page.
     *
     * @final
     * @param boolean $b403Status Set the Forbidden status. For the Ajax blocks and others, we cannot put the HTTP 403 error code, so the attribute must be set to FALSE. Default TRUE
     * @return void Quits the page with the exit() function
     */
    final public function displayPageDenied($b403Status = true)
    {
        if ($b403Status) Http::setHeadersByCode(403);

        $sTitle = t('Access Denied!');
        $this->view->page_title = $sTitle;
        $this->view->h1_title = $sTitle;
        $this->view->error_desc = t('Oops! You are not authorized to access this page!');

        $this->view->pOH_not_found = 1;
        $this->output();
        exit;
    }

    /**
     * Check if the module is not disabled, otherwise we displayed a Not Found page.
     *
     * @return void If the module is disabled, displays the Not Found page and exit the script.
     */
    final private function _checkModStatus()
    {
        if (!SysMod::isEnabled($this->registry->module))
            $this->displayPageNotFound();
    }

    /**
     * Add permissions if the Permission file of the module exists.
     *
     * @return void
     */
    final private function _checkPerms()
    {
        if (is_file($this->registry->path_module_config . 'Permission.php'))
        {
            require $this->registry->path_module_config . 'Permission.php';
            new \PH7\Permission;
        }
    }

    /**
     * Check if the site has been banned for the visitor.
     * Displays the banishment page if a banned IP address is found.
     *
     * @return void If banned, exit the script after displaying the ban page.
     */
    final private function _checkBanStatus()
    {
        if (Ban::isIp(Ip::get()))
        {
            \PH7\Framework\Page\Page::banned();
        }
    }

    /**
     * The maintenance page is not displayed for the "Admin" module and if the administrator is logged.
     *
     * @return void If the status if maintenance, exit the script after displaying the maintenance page.
     */
    final private function _checkSiteStatus()
    {
        if (M\DbConfig::getSetting('siteStatus') === M\DbConfig::MAINTENANCE_SITE
            && !\PH7\AdminCore::auth() && $this->registry->module !== PH7_ADMIN_MOD)
        {
            \PH7\Framework\Page\Page::maintenance(3600); // 1 hour for the duration time of the Service Unavailable HTTP status.
        }
    }

    /**
     *  Securing the server for DDoS attack only! Not for the attacks DoS.
     *
     * @return void
     */
    final private function _ddosProtection()
    {
        if (!isDebug() && M\DbConfig::getSetting('DDoS'))
        {
            $oDDoS = new \PH7\Framework\Security\DDoS\Stop;
            if ($oDDoS->cookie() || $oDDoS->session()) {
                $oDDoS->wait();
            }
            unset($oDDoS);
        }
    }

}
