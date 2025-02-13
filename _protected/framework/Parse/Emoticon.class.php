<?php
/**
 * @title            Emoticon Class
 * @desc             Parse the emoticon code.
 *
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license          GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package          PH7 / Framework / Parse
 * @version          1.1
 */

namespace PH7\Framework\Parse;
defined('PH7') or exit('Restricted access');

use PH7\Framework\Layout\Optimization;

class Emoticon extends \PH7\Framework\Service\Emoticon
{

    /**
     * Parse the contents.
     *
     * @static
     * @param string $sContents
     * @param boolean $bIsDataUri Default: TRUE
     * @return string Contents
     */
    public static function init($sContents, $bIsDataUri = true)
    {
        $aEmoticons = static::gets();

        foreach ($aEmoticons as $sEmoticonKey => $aEmoticon)
            if ($bIsDataUri)
                $sContents = str_ireplace(static::getCode($aEmoticon), '<img src=\'' . Optimization::dataUri(static::getPath($sEmoticonKey)) . '\' alt=\'' . static::getName($aEmoticon) . '\' />', $sContents);
            else
                $sContents = str_ireplace(static::getCode($aEmoticon), '<img src=\'' . static::getUrl($sEmoticonKey) . '\' alt=\'' . static::getName($aEmoticon) . '\' />', $sContents);

        return $sContents;
    }

}
