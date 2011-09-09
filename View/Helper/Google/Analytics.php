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
 * Helper class to produce the Google Analytics Javascript Code
 *
 * The Publisher ID should be defined within the config file:
 * google.Analytics = UA-3150249-16
 *
 * <code>
 * // Include the Google Analytics Tracking icon
 * $this->google_Analytics();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Google
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Google_Analytics
{
    /**
     * Method to render the Google Analytics code
     *
     * @return string
     */
    public function google_Analytics()
    {
        // Config
        $google = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('google');


        // Create the analytics tracking code
        $string =
        <<<HTML
            <script type="text/javascript">

              var _gaq = _gaq || [];
              _gaq.push(['_setAccount', '{$google['analytics']}']);
              _gaq.push(['_trackPageview']);

              (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
              })();

            </script>
HTML;

        return $string;
    }
}
