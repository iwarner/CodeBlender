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
 * google.analytics = ""
 *
 * <code>
 * // Google Analytics Tracking
 * echo $this->google_Analytics();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Google_Analytics extends Zend_View_Helper_Abstract
{

    /**
     * Google Analytics
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
