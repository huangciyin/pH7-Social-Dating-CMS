<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2013-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Field / Form
 */
namespace PH7;

use PH7\Framework\Mvc\Request\Http, PH7\Framework\Config\Config;

class EditFieldForm
{

    public static function display()
    {
        if (isset($_POST['submit_edit_field']))
        {
            if (\PFBC\Form::isValid($_POST['submit_edit_field']))
                new EditFieldFormProcess;

            Framework\Url\Header::redirect();
        }

        $sFieldPattern = Config::getInstance()->values['module.setting']['field.pattern'];

        $oForm = new \PFBC\Form('form_edit_field', 550);
        $oForm->configure(array('action' => ''));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_edit_field', 'form_edit_field'));
        $oForm->addElement(new \PFBC\Element\Token('edit_field'));
        $oForm->addElement(new \PFBC\Element\Select(t('Field Type:'), 'type', array('textbox' => t('Text Box'), 'number' => t('Number')), array('value' => 'textbox', 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Field Name:'), 'name', array('description' => t('Field Name must contain 2-30 alphanumeric characters ([a-z], [A-Z], [0-9] and [_], [-]).'), 'value' => (new Http)->get('name'), 'pattern' => $sFieldPattern, 'required' => 1, 'validation'=> new \PFBC\Validation\RegExp($sFieldPattern))));
        $oForm->addElement(new \PFBC\Element\Number(t('Length Field:'), 'length', array('value' => 255, 'required' => 1)));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Default Field Value'), 'value', array('validation'=>new \PFBC\Validation\Str(2,120))));
        $oForm->addElement(new \PFBC\Element\Button(t('Edit')));
        $oForm->render();
    }

}
