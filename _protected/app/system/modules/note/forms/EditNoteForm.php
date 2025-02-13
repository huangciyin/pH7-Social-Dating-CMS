<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Note / Form
 */
namespace PH7;

use
PH7\Framework\Str\Str,
PH7\Framework\Session\Session,
PH7\Framework\Security\CSRF\Token,
PH7\Framework\Mvc\Request\Http,
PH7\Framework\Mvc\Router\Uri;

class EditNoteForm
{

    public static function display()
    {

        if (isset($_POST['submit_edit_note']))
        {
            if (\PFBC\Form::isValid($_POST['submit_edit_note']))
                new EditNoteFormProcess();

            Framework\Url\Header::redirect();
        }

        // Generate edit form post of the note
        $oNoteModel = new NoteModel;

        $iNoteId = (new Http)->get('id', 'int');
        $iProfileId = (new Session)->get('member_id');
        $sPostId = $oNoteModel->getPostId($iNoteId);
        $oPost = $oNoteModel->readPost($sPostId, $iProfileId);

        if (!empty($oPost) && (new Str)->equals($iNoteId, $oPost->noteId))
        {
            $oCategoryData = $oNoteModel->getCategory(null, 0, 300);

            $aCategoryNames = array();
            foreach ($oCategoryData as $oId)
                $aCategoryNames[$oId->categoryId] = $oId->name;

            $aSelectedCategories = array();
            $oCategoryIds = $oNoteModel->getCategory($iNoteId, 0, 300);
            unset($oNoteModel);

            foreach ($oCategoryIds as $iId)
                $aSelectedCategories[] = $iId->categoryId;

            $oForm = new \PFBC\Form('form_note', 650);
            $oForm->configure(array('action' => ''));
            $oForm->addElement(new \PFBC\Element\Hidden('submit_edit_note', 'form_note'));
            $oForm->addElement(new \PFBC\Element\Token('edit_note'));
            $oForm->addElement(new \PFBC\Element\Textbox(t('Title of article:'), 'title', array('value' => $oPost->title, 'validation' => new \PFBC\Validation\Str(2, 100), 'required' => 1)));
            $oForm->addElement(new \PFBC\Element\Textbox(t('Article ID:'), 'post_id', array('value' => $oPost->postId, 'description' => Uri::get('note', 'main', 'read', (new Session)->get('member_username')).'/<strong><span class="your-address">'.$oPost->postId.'</span><span class="post_id"></span></strong>', 'title' => t('Article ID will be the name of the url.'), 'data-profile_id' => $iProfileId, 'id' => 'post_id', 'validation' => new \PFBC\Validation\Str(2, 60), 'required' => 1)));
            $oForm->addElement(new \PFBC\Element\HTMLExternal('<div class="label_flow">'));
            $oForm->addElement(new \PFBC\Element\Checkbox(t('Categories:'), 'category_id', $aCategoryNames, array('description' => t('Select a category that fits the best for your article. You can select up to three different categories'), 'value' => $aSelectedCategories, 'required' => 1)));
            $oForm->addElement(new \PFBC\Element\HTMLExternal('</div>'));
            $oForm->addElement(new \PFBC\Element\CKEditor(t('Contents:'), 'content', array('value' => $oPost->content, 'description' => t('Content of the article'), 'validation' => new \PFBC\Validation\Str(30), 'required' => 1)));
            $oForm->addElement(new \PFBC\Element\Textbox(t('The language of your post:'), 'lang_id', array('value' => $oPost->langId, 'description' => t('EX: "en", "fr", "es", "js"'), 'validation' => new \PFBC\Validation\Str(2, 2), 'required' => 1)));
            $oForm->addElement(new \PFBC\Element\Textbox(t('Slogan:'), 'slogan', array('value' => $oPost->slogan, 'validation' => new \PFBC\Validation\Str(2, 200))));
            $oForm->addElement(new \PFBC\Element\File(t('Thumbnail:'), 'thumb', array('accept' => 'image/*')));

            if (!empty($oPost->thumb))
                $oForm->addElement(new \PFBC\Element\HTMLExternal('<p><br /><img src="' . PH7_URL_DATA_SYS_MOD . 'note/' . PH7_IMG . $oPost->username . PH7_SH . $oPost->thumb . '" alt="' . t('Thumbnail') . '" title="' . t('The current thumbnail of your post.') . '" class="avatar" /></p>'));

            if (!empty($oPost->thumb))
                $oForm->addElement(new \PFBC\Element\HTMLExternal('<a href="' . Uri::get('note', 'main', 'removethumb', $oPost->noteId . (new Token)->url(), false) . '">' . t('Remove this thumbnail?') . '</a>'));

            $oForm->addElement(new \PFBC\Element\Textbox(t('Tags:'), 'tags', array('value' => $oPost->tags, 'description' => t('Separate keywords by commas and without spaces between the commas.'), 'validation' => new \PFBC\Validation\Str(2, 200))));
            $oForm->addElement(new \PFBC\Element\Textbox(t('Title (meta tag):'), 'page_title', array('value' => $oPost->pageTitle, 'validation' => new \PFBC\Validation\Str(2, 100), 'required' => 1)));
            $oForm->addElement(new \PFBC\Element\Textbox(t('Description (meta tag):'), 'meta_description', array('validation' => new \PFBC\Validation\Str(2, 200), 'value' => $oPost->metaDescription)));
            $oForm->addElement(new \PFBC\Element\Textbox(t('Keywords (meta tag):'), 'meta_keywords', array('description' => t('Separate keywords by commas and without spaces between the commas.'), 'validation' => new \PFBC\Validation\Str(2, 200), 'value' => $oPost->metaKeywords)));
            $oForm->addElement(new \PFBC\Element\Textbox(t('Robots (meta tag):'), 'meta_robots', array('validation' => new \PFBC\Validation\Str(2, 50), 'value' => $oPost->metaRobots)));
            $oForm->addElement(new \PFBC\Element\Textbox(t('Author (meta tag):'), 'meta_author', array('validation' => new \PFBC\Validation\Str(2, 50), 'value' => $oPost->metaAuthor)));
            $oForm->addElement(new \PFBC\Element\Textbox(t('Copyright (meta tag):'), 'meta_copyright', array('validation' => new \PFBC\Validation\Str(2, 50), 'value' => $oPost->metaCopyright)));
            $oForm->addElement(new \PFBC\Element\Radio(t('Enable Comment:'), 'enable_comment', array('1' => t('Enable'), '0' => t('Disable')), array('value' => $oPost->enableComment, 'required' => 1)));
            $oForm->addElement(new \PFBC\Element\Button);
            $oForm->addElement(new \PFBC\Element\HTMLExternal('<script src="' . PH7_URL_TPL_SYS_MOD . 'note/' . PH7_TPL . PH7_TPL_MOD_NAME . PH7_SH . PH7_JS . 'common.js"></script>'));
            $oForm->render();
        }
        else
            echo '<p class="center bold">' . t('Post Not Found!') . '</p>';
    }

}

