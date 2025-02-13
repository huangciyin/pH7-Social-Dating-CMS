<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Picture / Form
 */
namespace PH7;

use PH7\Framework\Session\Session, PH7\Framework\Mvc\Request\Http;

class EditAlbumForm
{

    public static function display()
    {
        if (isset($_POST['submit_edit_picture_album']))
        {
            if (\PFBC\Form::isValid($_POST['submit_edit_picture_album']))
                new EditAlbumFormProcess();

            Framework\Url\Header::redirect();
        }

        $oAlbum = (new PictureModel)->album((new Session)->get('member_id'), (new Http)->get('album_id'), 1, 0, 1);

        $oForm = new \PFBC\Form('form_edit_picture_album', 500);
        $oForm->configure(array('action' => '' ));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_edit_picture_album', 'form_edit_picture_album'));
        $oForm->addElement(new \PFBC\Element\Token('edit_album'));
        $oForm->addElement(new \PFBC\Element\Textbox(t('Name of your album:'), 'name', array('value'=>$oAlbum->name, 'required'=>1, 'validation'=>new \PFBC\Validation\Str(2,40))));
        $oForm->addElement(new \PFBC\Element\Textarea(t('Description of your album:'), 'description', array('value'=>$oAlbum->description, 'validation'=>new \PFBC\Validation\Str(2,200))));
        $oForm->addElement(new \PFBC\Element\Button);
        $oForm->render();
    }

}
