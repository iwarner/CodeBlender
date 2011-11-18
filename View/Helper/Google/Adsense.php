<?php

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Helper
 *
 * Config Options
 * google.adsenseID = ""
 *
 * <code>
 * // Google Adsense
 * echo $this->google_Adsense();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see
 */
class CodeBlender_View_Helper_Google_Adsense extends Zend_View_Helper_Abstract
{

    /**
     * The Publisher ID
     *
     * @var string
     */
    protected $client = false;

    /**
     * Height
     *
     * @var string
     */
    protected $height = 60;

    /**
     * Ad Slot
     *
     * @var string
     */
    protected $slot = false;

    /**
     * Width
     *
     * @var string
     */
    protected $width = 468;

    /**
     * googleAdsense
     */
    public function google_Adsense($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // If the client ID is blank then use the one from the config
        if (empty($params['client'])) {

            // Config
            $config = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('google');

            // Adsense client ID
            $params['client'] = $config['adsenseID'];
        }

        $string = <<<HTML
            <script type="text/javascript">
            <!--
                google_ad_client = "{$params['client']}";
                google_ad_slot   = "{$params['slot']}";
                google_ad_width  = {$params['width']};
                google_ad_height = {$params['height']};
            //-->
            </script>

            <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
HTML;

        return $string;
    }

}
