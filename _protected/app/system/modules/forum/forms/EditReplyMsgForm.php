<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Forum / Form
 */
namespace PH7;

use PH7\Framework\Session\Session, PH7\Framework\Mvc\Request\Http;

class EditReplyMsgForm
{

    public static function display()
    {
        if (isset($_POST['submit_edit_reply_msg']))
        {
            if (\PFBC\Form::isValid($_POST['submit_edit_reply_msg']))
                new EditReplyMsgFormProcess();

            Framework\Url\Header::redirect();
        }

        $oHttpRequest = new Http;
        $oMsg = (new ForumModel)->getMessage($oHttpRequest->get('topic_id'), $oHttpRequest->get('message_id'), (new Session)->get('member_id'), 1, 0, 1);
        unset($oHttpRequest);

        $oForm = new \PFBC\Form('form_edit_reply_msg', '100%');
        $oForm->configure(array('action' => '' ));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_edit_reply_msg', 'form_edit_reply_msg'));
        $oForm->addElement(new \PFBC\Element\Token('edit_reply_msg'));
        $oForm->addElement(new \PFBC\Element\CKEditor(t('Message:'), 'message', array('value'=>$oMsg->message, 'required' => 1, 'validation'=>new \PFBC\Validation\Str(4))));
        $oForm->addElement(new \PFBC\Element\Button);
        $oForm->render();
    }

}
