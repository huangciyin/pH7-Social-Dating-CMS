<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2013-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Admin / From
 */
namespace PH7;

use PH7\Framework\Mvc\Model\Design as Design;

class StyleForm
{

    public static function display()
    {
        if (isset($_POST['submit_style']))
        {
            if (\PFBC\Form::isValid($_POST['submit_style']))
                new StyleFormProcess;
            Framework\Url\Header::redirect();
        }

        $oForm = new \PFBC\Form('form_style');
        $oForm->configure(array('action' => ''));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_style', 'form_style'));
        $oForm->addElement(new \PFBC\Element\Token('style'));
        $oForm->addElement(new \PFBC\Element\Textarea(t('Your custon CSS code'), 'code', array('value' => (new Design)->customCode('css'), 'description' => t("WARNING! Here, you don't need to add the %0% tags.", '<b><i>&lt;style&gt;&lt;/style&gt;</i></b>'), 'style' => 'height:450px')));
        $oForm->addElement(new \PFBC\Element\Button);
        $oForm->render();
    }

}
