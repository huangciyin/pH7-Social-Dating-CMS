<?php
/**
 * @title            Module Class
 *
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license          GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package          PH7 / Framework / Module
 * @version          0.1
 */

namespace PH7\Framework\Module;
defined('PH7') or exit('Restricted access');

class Module implements Mixer
{

    private $_sModName;

    public function __construct()
    {

    }

    public function cms()
    {

    }

    public function framework()
    {

    }

    public function mixer()
    {
        switch ($this->_sModName)
        {


        }
    }

}




