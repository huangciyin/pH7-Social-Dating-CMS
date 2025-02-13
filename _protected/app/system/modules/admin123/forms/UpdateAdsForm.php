<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Admin / From
 */
namespace PH7;

use PH7\Framework\Parse\SysVar, PH7\Framework\Navigation\Page;

class UpdateAdsForm
{

    public static function display()
    {
        if (isset($_POST['submit_update_ads']))
        {
            if (\PFBC\Form::isValid($_POST['submit_update_ads']))
                new UpdateAdsFormProcess;

            Framework\Url\Header::redirect();
        }

        $oPage = new Page;
        $oAdsModel = new AdsCoreModel;
        $sTable = AdsCore::getTable();
        $sCSRFToken = (new Framework\Security\CSRF\Token)->generate('ads');
        $oPage->getTotalPages($oAdsModel->total($sTable), 10);
        $oAds = $oAdsModel->get(null, $oPage->getFirstItem(), $oPage->getNbItemsByPage(), $sTable);
        unset($oPage, $oAdsModel);

        $oSysVar = new SysVar;

        foreach ($oAds as $oRow)
        {
            $oForm = new \PFBC\Form('form_update_ads', 500);
            $oForm->configure(array('action' => ''));
            $oForm->addElement(new \PFBC\Element\Hidden('submit_update_ads', 'form_update_ads'));
            $oForm->addElement(new \PFBC\Element\Token('update_ads'));

            // Begin ads div tags
            $oForm->addElement(new \PFBC\Element\HTMLExternal('<div id="ad_' . $oRow->adsId . '">'));

            $oForm->addElement(new \PFBC\Element\Hidden('id_ads', $oRow->adsId));
            $oForm->addElement(new \PFBC\Element\Textbox(t('Title:'), 'title', array('value' => $oRow->name, 'required' => 1, 'validation' => new \PFBC\Validation\Str(2, 40))));
            $oForm->addElement(new \PFBC\Element\HTMLExternal('<p>' . t('Preview Ad:') . '</p>'));
            $oForm->addElement(new \PFBC\Element\HTMLExternal($oSysVar->parse($oRow->code)));

            // ID textarea form was generated with "mt_rand" because it is faster than "uniqid"
            // See also this discussion we asked: http://stackoverflow.com/questions/9152600/uniqid-versus-mt-rand-php-function
            $oForm->addElement(new \PFBC\Element\Textarea(t('Advertisement:'), 'code', array('id' => mt_rand(), 'value' => $oSysVar->parse($oRow->code), 'required' => 1)));
            // mt_rand() function for generate an ID different if it causes problems in the display.
            $oForm->addElement(new \PFBC\Element\Button(t('Update'), 'submit', array('id' => mt_rand())));

            if (AdsCore::getTable() == 'Ads') // This feature is not available for affiliate banners
                $oForm->addElement(new \PFBC\Element\HTMLExternal(t('Views: %0% | Clicks: %1%', $oRow->views, $oRow->clicks) . ' | '));

            $oForm->addElement(new \PFBC\Element\HTMLExternal('<a class="medium_button" href="javascript:void(0)" onclick="ads(\'delete\',' . $oRow->adsId . ',\'' . $sCSRFToken . '\')">' . t('Delete') . '</a> | '));

            if ($oRow->active == 1)
                $oForm->addElement(new \PFBC\Element\HTMLExternal('<a class="medium_button" href="javascript:void(0)" onclick="ads(\'deactivate\',' . $oRow->adsId . ',\'' . $sCSRFToken . '\')">' . t('Deactivate') . '</a>'));
            else
                $oForm->addElement(new \PFBC\Element\HTMLExternal('<a class="medium_button" href="javascript:void(0)" onclick="ads(\'activate\',' . $oRow->adsId . ',\'' . $sCSRFToken . '\')">' . t('Activate') . '</a>'));

            // End ads div tags
            $oForm->addElement(new \PFBC\Element\HTMLExternal('</div>'));

            $oForm->render();
        }
    }

}
