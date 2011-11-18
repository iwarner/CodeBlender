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
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://developers.facebook.com/docs/reference/javascript/
 */
class CodeBlender_View_Helper_Facebook_JavascriptSDK extends Zend_View_Helper_Abstract
{

    /**
     * Helper
     */
    public function facebook_JavascriptSDK()
    {
        // Config
        $config = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('facebook');
        $string = '';

        if (!empty($config)) {

            $string = <<<HTML

                <div id="fb-root"></div>

                <script type="text/javascript">

                    window.fbAsyncInit = function()
                    {
                        FB._https = true;

                        FB.init({
                            appId  : {$config['appID']},
                            oauth  : true,
                            status : true,
                            cookie : true,
                            xfbml  : true
                          });

                        FB.Canvas.setAutoResize();
                    };

                    (function()
                    {
                        var e = document.createElement('script'); e.async = true;
                        e.src = document.location.protocol + '//connect.facebook.net/{$config['locale']}/all.js';
                        document.getElementById('fb-root').appendChild(e);
                    }());

                </script>
HTML;
        }

        return $string;
    }

}
