<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Forum / Form
 */
namespace PH7;

use PH7\Framework\Mvc\Model\DbConfig;

class ReplyMsgForm
{

    public static function display()
    {
        if (isset($_POST['submit_reply']))
        {
            if (\PFBC\Form::isValid($_POST['submit_reply']))
                new ReplyMsgFormProcess();

            Framework\Url\Header::redirect();
        }

        $oForm = new \PFBC\Form('form_reply', '100%');
        $oForm->configure(array('action' => '' ));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_reply', 'form_reply'));
        $oForm->addElement(new \PFBC\Element\Token('reply'));
        $oForm->addElement(new \PFBC\Element\CKEditor(t('Message:'), 'message', array('required' => 1, 'validation'=>new \PFBC\Validation\Str(4))));
        if (DbConfig::getSetting('isCaptchaForum'))
        {
            $oForm->addElement(new \PFBC\Element\CCaptcha(t('Captcha:'), 'captcha', array('id'=>'ccaptcha','onkeyup'=>'CValid(this.value, this.id)','description'=>t('Enter the code above:'))));
            $oForm->addElement(new \PFBC\Element\HTMLExternal('<span class="input_error ccaptcha"></span>'));
        }
        $oForm->addElement(new \PFBC\Element\Button);
        $oForm->addElement(new \PFBC\Element\HTMLExternal('<script src="'.PH7_URL_STATIC.PH7_JS.'validate.js"></script>'));
        $oForm->render();
    }

}
