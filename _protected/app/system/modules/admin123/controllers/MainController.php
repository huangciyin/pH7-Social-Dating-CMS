<?php
/**
 * @title          Main Controller
 *
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Admin / Controller
 * @version        1.0
 */
namespace PH7;

use PH7\Framework\Mvc\Model\DbConfig;

class MainController extends Controller
{

    public function index()
    {
        // Add Validate-Site JS file if needed
        if (ValidateSiteCore::needInject($this->session)) {
            $this->design->addJs(PH7_LAYOUT . PH7_SYS . PH7_MOD . 'validate-site' . PH7_SH . PH7_TPL . PH7_TPL_MOD_NAME . PH7_SH . PH7_JS, 'validationbox.js');
        }

        $this->view->page_title = t('Admin Panel');
        $this->view->h1_title = t('Dashboard');
        $this->view->h2_title = t('Hello <em>%0%</em>, welcome to your site!', $this->session->get('admin_first_name'));
        $this->view->h3_title = t('How are you today?');

        $this->view->is_news_feed = (bool) DbConfig::getSetting('isSoftwareNewsFeed');

        $this->checkUpdates();

        $this->addStats();

        $this->output();
    }

    public function stat()
    {
        $this->view->page_title = t('Statistics');
        $this->view->h1_title = t('Site statistics');

        $this->addStats();

        $this->output();
    }

    public function login()
    {
        // Prohibit the referencing in search engines of admin page
        $this->view->header = '<meta name="robots" content="noindex" />';

        $this->view->page_title = t('Sign in to Admin Panel');
        $this->view->page_h1 = t('Sign in');
        $this->output();
    }

    public function logout()
    {
        (new Admin)->logout();
    }

    protected function addStats()
    {
        // Adding the common CSS for the chart.
        $this->design->addCss(PH7_LAYOUT . PH7_SYS . PH7_MOD . $this->registry->module . PH7_SH . PH7_TPL . PH7_TPL_MOD_NAME . PH7_SH . PH7_CSS, 'general.css');

        $oStatModel = new StatisticCoreModel;

        // Get the since date of the website
        $this->view->since_date = $this->dateTime->get(StatisticCoreModel::getSiteSinceDate())->date();


        //---------- Number of Logins Members ----------//

        // All Members
        $this->view->today_login_members = $oStatModel->totalLogins('Members', 1);
        $this->view->week_login_members = $oStatModel->totalLogins('Members', 7);
        $this->view->month_login_members = $oStatModel->totalLogins('Members', 31);
        $this->view->year_login_members = $oStatModel->totalLogins('Members', 365);
        $this->view->login_members = $oStatModel->totalLogins();

        // Men Members
        $this->view->today_login_male_members = $oStatModel->totalLogins('Members', 1, 'male');
        $this->view->week_login_male_members = $oStatModel->totalLogins('Members', 7, 'male');
        $this->view->month_login_male_members = $oStatModel->totalLogins('Members', 31, 'male');
        $this->view->year_login_male_members = $oStatModel->totalLogins('Members', 365, 'male');
        $this->view->login_male_members = $oStatModel->totalLogins('Members', 0, 'male');

        // Women Members
        $this->view->today_login_female_members = $oStatModel->totalLogins('Members', 1, 'female');
        $this->view->week_login_female_members = $oStatModel->totalLogins('Members', 7, 'female');
        $this->view->month_login_female_members = $oStatModel->totalLogins('Members', 31, 'female');
        $this->view->year_login_female_members = $oStatModel->totalLogins('Members', 365, 'female');
        $this->view->login_female_members = $oStatModel->totalLogins('Members', 0, 'female');

        // Couple Members
        $this->view->today_login_couple_members = $oStatModel->totalLogins('Members', 1, 'couple');
        $this->view->week_login_couple_members = $oStatModel->totalLogins('Members', 7, 'couple');
        $this->view->month_login_couple_members = $oStatModel->totalLogins('Members', 31, 'couple');
        $this->view->year_login_couple_members = $oStatModel->totalLogins('Members', 365, 'couple');
        $this->view->login_couple_members = $oStatModel->totalLogins('Members', 0, 'couple');


        //---------- Number of Logins Affiliates ----------//

        // All Affiliates
        $this->view->today_login_affiliate = $oStatModel->totalLogins('Affiliates', 1);
        $this->view->week_login_affiliate = $oStatModel->totalLogins('Affiliates', 7);
        $this->view->month_login_affiliate = $oStatModel->totalLogins('Affiliates', 31);
        $this->view->year_login_affiliate = $oStatModel->totalLogins('Affiliates', 365);
        $this->view->login_affiliate = $oStatModel->totalLogins('Affiliates');

        // Men Affiliates
        $this->view->today_login_male_affiliate = $oStatModel->totalLogins('Affiliates', 1, 'male');
        $this->view->week_login_male_affiliate = $oStatModel->totalLogins('Affiliates', 7, 'male');
        $this->view->month_login_male_affiliate = $oStatModel->totalLogins('Affiliates', 31, 'male');
        $this->view->year_login_male_affiliate = $oStatModel->totalLogins('Affiliates', 365, 'male');
        $this->view->login_male_affiliate = $oStatModel->totalLogins('Affiliates', 0, 'male');

        // Women Affiliates
        $this->view->today_login_female_affiliate = $oStatModel->totalLogins('Affiliates', 1, 'female');
        $this->view->week_login_female_affiliate = $oStatModel->totalLogins('Affiliates', 7, 'female');
        $this->view->month_login_female_affiliate = $oStatModel->totalLogins('Affiliates', 31, 'female');
        $this->view->year_login_female_affiliate = $oStatModel->totalLogins('Affiliates', 365, 'female');
        $this->view->login_female_affiliate = $oStatModel->totalLogins('Affiliates', 0, 'female');


        //---------- Number of Logins Admins ----------//

        // All Admins
        $this->view->today_login_admins = $oStatModel->totalLogins('Admins', 1);
        $this->view->week_login_admins = $oStatModel->totalLogins('Admins', 7);
        $this->view->month_login_admins = $oStatModel->totalLogins('Admins', 31);
        $this->view->year_login_admins = $oStatModel->totalLogins('Admins', 365);
        $this->view->login_admins = $oStatModel->totalLogins('Admins');

        // Men Admins
        $this->view->today_login_male_admins = $oStatModel->totalLogins('Admins', 1, 'male');
        $this->view->week_login_male_admins = $oStatModel->totalLogins('Admins', 7, 'male');
        $this->view->month_login_male_admins = $oStatModel->totalLogins('Admins', 31, 'male');
        $this->view->year_login_male_admins = $oStatModel->totalLogins('Admins', 365, 'male');
        $this->view->login_male_admins = $oStatModel->totalLogins('Admins', 0, 'male');

        // Women Admins
        $this->view->today_login_female_admins = $oStatModel->totalLogins('Admins', 1, 'female');
        $this->view->week_login_female_admins = $oStatModel->totalLogins('Admins', 7, 'female');
        $this->view->month_login_female_admins = $oStatModel->totalLogins('Admins', 31, 'female');
        $this->view->year_login_female_admins = $oStatModel->totalLogins('Admins', 365, 'female');
        $this->view->login_female_admins = $oStatModel->totalLogins('Admins', 0, 'female');


        //---------- Members Registrations ----------//

        // All Members
        $this->view->today_total_members = $oStatModel->totalMembers(1);
        $this->view->week_total_members = $oStatModel->totalMembers(7);
        $this->view->month_total_members = $oStatModel->totalMembers(31);
        $this->view->year_total_members = $oStatModel->totalMembers(365);
        $this->view->total_members = $oStatModel->totalMembers();

        // Men Members
        $this->view->today_total_male_members = $oStatModel->totalMembers(1, 'male');
        $this->view->week_total_male_members = $oStatModel->totalMembers(7, 'male');
        $this->view->month_total_male_members = $oStatModel->totalMembers(31, 'male');
        $this->view->year_total_male_members = $oStatModel->totalMembers(365, 'male');
        $this->view->total_male_members = $oStatModel->totalMembers(0, 'male');

        // Women Members
        $this->view->today_total_female_members = $oStatModel->totalMembers(1, 'female');
        $this->view->week_total_female_members = $oStatModel->totalMembers(7, 'female');
        $this->view->month_total_female_members = $oStatModel->totalMembers(31, 'female');
        $this->view->year_total_female_members = $oStatModel->totalMembers(365, 'female');
        $this->view->total_female_members = $oStatModel->totalMembers(0, 'female');

        // Couple Members
        $this->view->today_total_couple_members = $oStatModel->totalMembers(1, 'couple');
        $this->view->week_total_couple_members = $oStatModel->totalMembers(7, 'couple');
        $this->view->month_total_couple_members = $oStatModel->totalMembers(31, 'couple');
        $this->view->year_total_couple_members = $oStatModel->totalMembers(365, 'couple');
        $this->view->total_couple_members = $oStatModel->totalMembers(0, 'couple');


        //---------- Affiliates Registrations ----------//

        // All Affiliates
        $this->view->today_total_affiliate = $oStatModel->totalAffiliates(1);
        $this->view->week_total_affiliate = $oStatModel->totalAffiliates(7);
        $this->view->month_total_affiliate = $oStatModel->totalAffiliates(31);
        $this->view->year_total_affiliate = $oStatModel->totalAffiliates(365);
        $this->view->total_affiliate = $oStatModel->totalAffiliates();

        // Men Affiliates
        $this->view->today_total_male_affiliate = $oStatModel->totalAffiliates(1, 'male');
        $this->view->week_total_male_affiliate = $oStatModel->totalAffiliates(7, 'male');
        $this->view->month_total_male_affiliate = $oStatModel->totalAffiliates(31, 'male');
        $this->view->year_total_male_affiliate = $oStatModel->totalAffiliates(365, 'male');
        $this->view->total_male_affiliate = $oStatModel->totalAffiliates(0, 'male');

        // Women Affiliates
        $this->view->today_total_female_affiliate = $oStatModel->totalAffiliates(1, 'female');
        $this->view->week_total_female_affiliate = $oStatModel->totalAffiliates(7, 'female');
        $this->view->month_total_female_affiliate = $oStatModel->totalAffiliates(31, 'female');
        $this->view->year_total_female_affiliate = $oStatModel->totalAffiliates(365, 'female');
        $this->view->total_female_affiliate = $oStatModel->totalAffiliates(0, 'female');


        //---------- Admins Registrations ----------//

        // All Admins
        $this->view->today_total_admins = $oStatModel->totalAdmins(1);
        $this->view->week_total_admins = $oStatModel->totalAdmins(7);
        $this->view->month_total_admins = $oStatModel->totalAdmins(31);
        $this->view->year_total_admins = $oStatModel->totalAdmins(365);
        $this->view->total_admins = $oStatModel->totalAdmins();

        // Men Admins
        $this->view->today_total_male_admins = $oStatModel->totalAdmins(1, 'male');
        $this->view->week_total_male_admins = $oStatModel->totalAdmins(7, 'male');
        $this->view->month_total_male_admins = $oStatModel->totalAdmins(31, 'male');
        $this->view->year_total_male_admins = $oStatModel->totalAdmins(365, 'male');
        $this->view->total_male_admins = $oStatModel->totalAdmins(0, 'male');

        // Women Admins
        $this->view->today_total_female_admins = $oStatModel->totalAdmins(1, 'female');
        $this->view->week_total_female_admins = $oStatModel->totalAdmins(7, 'female');
        $this->view->month_total_female_admins = $oStatModel->totalAdmins(31, 'female');
        $this->view->year_total_female_admins = $oStatModel->totalAdmins(365, 'female');
        $this->view->total_female_admins = $oStatModel->totalAdmins(0, 'female');


        //---------- Blogs ----------//

        $this->view->today_total_blogs = $oStatModel->totalBlogs(1);
        $this->view->week_total_blogs = $oStatModel->totalBlogs(7);
        $this->view->month_total_blogs = $oStatModel->totalBlogs(31);
        $this->view->year_total_blogs = $oStatModel->totalBlogs(365);
        $this->view->total_blogs = $oStatModel->totalBlogs();


        //---------- Notes ----------//

        $this->view->today_total_notes = $oStatModel->totalNotes(1);
        $this->view->week_total_notes = $oStatModel->totalNotes(7);
        $this->view->month_total_notes = $oStatModel->totalNotes(31);
        $this->view->year_total_notes = $oStatModel->totalNotes(365);
        $this->view->total_notes = $oStatModel->totalNotes();


        //---------- Messages ----------//

        $this->view->today_total_mails = $oStatModel->totalMails(1);
        $this->view->week_total_mails = $oStatModel->totalMails(7);
        $this->view->month_total_mails = $oStatModel->totalMails(31);
        $this->view->year_total_mails = $oStatModel->totalMails(365);
        $this->view->total_mails = $oStatModel->totalMails();


        //---------- Comments ----------//

        // Profile Comments
        $this->view->today_total_profile_comments = $oStatModel->totalProfileComments(1);
        $this->view->week_total_profile_comments = $oStatModel->totalProfileComments(7);
        $this->view->month_total_profile_comments = $oStatModel->totalProfileComments(31);
        $this->view->year_total_profile_comments = $oStatModel->totalProfileComments(365);
        $this->view->total_profile_comments = $oStatModel->totalProfileComments();

        // Picture Comments
        $this->view->today_total_picture_comments = $oStatModel->totalPictureComments(1);
        $this->view->week_total_picture_comments = $oStatModel->totalPictureComments(7);
        $this->view->month_total_picture_comments = $oStatModel->totalPictureComments(31);
        $this->view->year_total_picture_comments = $oStatModel->totalPictureComments(365);
        $this->view->total_picture_comments = $oStatModel->totalPictureComments();

        // Video Comments
        $this->view->today_total_video_comments = $oStatModel->totalVideoComments(1);
        $this->view->week_total_video_comments = $oStatModel->totalVideoComments(7);
        $this->view->month_total_video_comments = $oStatModel->totalVideoComments(31);
        $this->view->year_total_video_comments = $oStatModel->totalVideoComments(365);
        $this->view->total_video_comments = $oStatModel->totalVideoComments();

        // Blog Comments
        $this->view->today_total_blog_comments = $oStatModel->totalBlogComments(1);
        $this->view->week_total_blog_comments = $oStatModel->totalBlogComments(7);
        $this->view->month_total_blog_comments = $oStatModel->totalBlogComments(31);
        $this->view->year_total_blog_comments = $oStatModel->totalBlogComments(365);
        $this->view->total_blog_comments = $oStatModel->totalBlogComments();

        // Note Comments
        $this->view->today_total_note_comments = $oStatModel->totalNoteComments(1);
        $this->view->week_total_note_comments = $oStatModel->totalNoteComments(7);
        $this->view->month_total_note_comments = $oStatModel->totalNoteComments(31);
        $this->view->year_total_note_comments = $oStatModel->totalNoteComments(365);
        $this->view->total_note_comments = $oStatModel->totalNoteComments();

        // Game Comments
        $this->view->today_total_game_comments = $oStatModel->totalGameComments(1);
        $this->view->week_total_game_comments = $oStatModel->totalGameComments(7);
        $this->view->month_total_game_comments = $oStatModel->totalGameComments(31);
        $this->view->year_total_game_comments = $oStatModel->totalGameComments(365);
        $this->view->total_game_comments = $oStatModel->totalGameComments();


        unset($oStatModel);
    }

    protected function checkUpdates()
    {
        if (Framework\Security\Version::isUpdates())
        {
            $aLatestVerInfo = Framework\Security\Version::getLatestInfo();
            $sLatestVer = t('%0% build %1%', $aLatestVerInfo['version'], $aLatestVerInfo['build']);

            $this->design->setMessage(t('%software_name% <strong>%0%</strong> is available! Please <a href="%1%" target="_blank">update it now</a> and keep your site safe and stable.', $sLatestVer, Framework\Core\Kernel::SOFTWARE_LICENSE_KEY_URL));
        }
    }

}
