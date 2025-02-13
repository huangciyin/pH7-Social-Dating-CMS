<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Newsletter / Form
 */
namespace PH7;

class MsgForm
{

    public static function display()
    {
        if (isset($_POST['submit_msg']))
        {
            if (\PFBC\Form::isValid($_POST['submit_msg']))
                new MsgFormProcess();

            Framework\Url\Header::redirect();
        }

        $oForm = new \PFBC\Form('form_msg', 650);
        $oForm->configure(array('action'=> '' ));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_msg', 'form_msg'));
        $oForm->addElement(new \PFBC\Element\Token('msg'));
        $oForm->addElement(new \PFBC\Element\HTMLExternal('<p class="center italic bold">' . t('ATTENTION! Sending emails may take several tens of minutes/hours.') . '<br />' . t('Once the form is sent, do not close the browser page!') . '</p>'));
        $oForm->addElement(new \PFBC\Element\Checkbox('', 'only_subscribers', array('1' => t('Only subscribers to the newsletter:'))));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Subject:'), 'subject', array('validation'=>new \PFBC\Validation\Str(5,80), 'required'=> 1)));
        $oForm->addElement(new \PFBC\Element\CKEditor(t('Body:'), 'body', array('required'=> 1)));
        $oForm->addElement(new \PFBC\Element\Button(t('Send!'), 'submit'));
        $oForm->render();
    }

}
