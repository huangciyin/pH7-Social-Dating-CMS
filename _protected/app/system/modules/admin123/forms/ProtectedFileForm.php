<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Admin / From
 */
namespace PH7;
defined('PH7') or exit('Restricted access');

class ProtectedFileForm
{

    public static function display()
    {
        if (isset($_POST['submit_file']))
        {
            if (\PFBC\Form::isValid($_POST['submit_file']))
                new ProtectedFileFormProcess;

            Framework\Url\Header::redirect();
        }

        $rData = file_get_contents(PH7_PATH_PROTECTED . $_GET['file']);

        $oForm = new \PFBC\Form('form_file');
        $oForm->configure(array('action' => ''));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_file', 'form_file'));
        $oForm->addElement(new \PFBC\Element\Token('file'));
        $oForm->addElement(new \PFBC\Element\Textarea(t('File Content'), 'content', array('value' => $rData, 'style' => 'height:650px', 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Button);
        $oForm->render();
    }

}
