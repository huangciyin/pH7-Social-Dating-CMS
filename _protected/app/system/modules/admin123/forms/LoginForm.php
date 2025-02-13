<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Admin / From
 */
namespace PH7;

use PH7\Framework\Session\Session;

class LoginForm
{

    public static function display()
    {
        if (isset($_POST['submit_admin_login']))
        {
            if (\PFBC\Form::isValid($_POST['submit_admin_login']))
                new LoginFormProcess;

            Framework\Url\Header::redirect();
        }

        $oForm = new \PFBC\Form('form_admin_login', 500);
        $oForm->configure(array('action' => ''));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_admin_login', 'form_admin_login'));
        $oForm->addElement(new \PFBC\Element\Token('login'));
        $oForm->addElement(new \PFBC\Element\Email(t('Your Email:'), 'mail', array('required'=>1)));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Your Username:'), 'username', array('required'=>1)));
        $oForm->addElement(new \PFBC\Element\Password(t('Your Password:'), 'password', array('required'=>1)));

        if ((new Session)->exists('captcha_admin_enabled'))
        {
            $oForm->addElement(new \PFBC\Element\CCaptcha(t('Captcha:'), 'captcha', array('id'=>'ccaptcha','onkeyup'=>'CValid(this.value, this.id)','description'=>t('Enter the code above:'))));
            $oForm->addElement(new \PFBC\Element\HTMLExternal('<span class="input_error ccaptcha"></span>'));
        }

        $oForm->addElement(new \PFBC\Element\Button(t('Login'),'submit', array('icon'=>'key')));
        $oForm->addElement(new \PFBC\Element\HTMLExternal('<script src="'.PH7_URL_STATIC.PH7_JS.'validate.js"></script>'));
        $oForm->render();
    }

}
