<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Lost Password / Form
 */
namespace PH7;
defined('PH7') or exit('Restricted access');

use PH7\Framework\Mvc\Request\Http, PH7\Framework\Mvc\Model\Engine\Util\Various;

class ForgotPasswordForm
{

    public static function display()
    {
        $sTable = Various::convertModToTable( (new Http)->get('mod') );

        if (isset($_POST['submit_forgot_password'])) {
            if (\PFBC\Form::isValid($_POST['submit_forgot_password']))
                new ForgotPasswordFormProcess($sTable);

            Framework\Url\Header::redirect();
        }

        $oForm = new \PFBC\Form('form_forgot_password', 500);
        $oForm->configure(array('action' => ''));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_forgot_password', 'form_forgot_password'));
        $oForm->addElement(new \PFBC\Element\Token('forgot_password'));
        $oForm->addElement(new \PFBC\Element\Email(t('Your Email:'), 'mail', array('id' => 'email', 'onblur' => 'CValid(this.value, this.id,\'user\',\'' . $sTable . '\')', 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\HTMLExternal('<span class="input_error email"></span>'));
        $oForm->addElement(new \PFBC\Element\CCaptcha(t('Captcha:'), 'captcha', array('id' => 'ccaptcha', 'onkeyup' => 'CValid(this.value, this.id)', 'description' => t('Enter the code above:'))));
        $oForm->addElement(new \PFBC\Element\HTMLExternal('<span class="input_error ccaptcha"></span>'));
        $oForm->addElement(new \PFBC\Element\Button(t('Generate a new password!'), 'submit', array('icon' => 'key')));
        $oForm->addElement(new \PFBC\Element\HTMLExternal('<script src="' . PH7_URL_STATIC . PH7_JS . 'validate.js"></script>'));
        $oForm->render();
    }

}
