<?php
/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Google
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Google Adsense
 *
 * <code>
 * // Include the Google Analytics Tracking icon
 * $this->google_Adsense();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Google
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Google_Adsense
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
     * Method to generate the needed google code for the required Ad Slot.
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function google_Adsense($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // If the client ID is blank then use the one from the config
        if (empty($params['client'])) {

            // Invoke the config
            $config = Zend_Registry::get('config');

            // Set the Adsense client ID
            $params['client'] = $config->google->Adsense;
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

         <script type="text/javascript"
          src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
         </script>
HTML;

        return $string;
    }
}
