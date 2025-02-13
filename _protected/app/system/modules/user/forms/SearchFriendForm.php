<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / User / Form
 */
namespace PH7;

use PH7\Framework\Mvc\Router\Uri, PH7\Framework\Mvc\Request\Http;

class SearchFriendForm
{

    public static function display()
    {
        $oHttpRequest = new Http;
        $sUsername = $oHttpRequest->get('username');
        $sAction = ($oHttpRequest->getExists('action')) ? 'mutual' : 'index';
        unset($oHttpRequest);

        $oForm = new \PFBC\Form('form_search', 500);
        $oForm->configure(array('action' => Uri::get('user', 'friend', $sAction, $sUsername) . PH7_SH, 'method' => 'get'));
        $oForm->addElement(new \PFBC\Element\Search(t('Search a Friend of "%0%"', $sUsername), 'looking', array('title' => t('Enter its First Name, Last Name, Username, Email address or ID of your Friend.'))));
        $oForm->addElement(new \PFBC\Element\Select(t('Browse By:'), 'order', array(SearchCoreModel::USERNAME => t('Username'), SearchCoreModel::FIRST_NAME => t('First Name'), SearchCoreModel::LAST_NAME => t('Last Name'), SearchCoreModel::EMAIL => t('Email'), SearchCoreModel::LATEST => t('Latest'), SearchCoreModel::LAST_ACTIVITY => t('Last Activity'), SearchCoreModel::VIEWS => t('Popular'), SearchCoreModel::RATING => t('Rated'))));
        $oForm->addElement(new \PFBC\Element\Select(t('Direction:'), 'sort', array(SearchCoreModel::ASC => t('Ascending'), SearchCoreModel::DESC => t('Descending'))));
        $oForm->addElement(new \PFBC\Element\Button(t('Search'),'submit', array('icon' => 'search')));
        $oForm->render();
    }

}
