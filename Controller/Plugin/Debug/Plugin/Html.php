<?php

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Plugin
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://www.codeblender.net/license
 */

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Plugin
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://www.codeblender.net/license
 */
class CodeBlender_Controller_Plugin_Debug_Plugin_Html implements CodeBlender_Controller_Plugin_Debug_Plugin_Interface
{

    /**
     * Contains plugin identifier name
     *
     * @var string
     */
    protected $_identifier = 'html';

    /**
     * Gets identifier for this plugin
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->_identifier;
    }

    /**
     * Returns the base64 encoded icon
     *
     * @return string
     */
    public function getIconData()
    {
        return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAEdSURBVDjLjZIxTgNBDEXfbDZIlIgmCKWgSpMGxEk4AHehgavQcJY0KRKJJiBQLkCR7PxvmiTsbrJoLY1sy/Ibe+an9XodtqkfSUd+Op0mTlgpidFodKpGRAAwn8/pstI2AHvfbi6KAkndgHZx31iP2/CTE3Q1A0ji6fUjsiFn8fJ4k44mSCmR0sl3QhJXF2fYwftXPl5hsVg0Xr0d2yZnIwWbqrlyOZlMDtc+v33H9eUQO7ACOZAC2Ye8qqIJqCfZRtnIIBnVQH8AdQOqylTZWPBwX+zGj93ZrXU7ZLlcxj5vArYi5/Iweh+BNQCbrVl8/uAMvjvvJbBU/++6rVarGI/HB0BbI4PBgNlsRtGlsL4CK7sAfQX2L6CPwH4BZf1E9tbX5ioAAAAASUVORK5CYII=';
    }

    /**
     * Gets menu tab for the Debugbar
     *
     * @return string
     */
    public function getTab()
    {
        return 'HTML';
    }

    /**
     * Gets content panel for the Debugbar
     *
     * @return string
     */
    public function getPanel()
    {
        $body = Zend_Controller_Front::getInstance()->getResponse()->getBody();
        $length = round(strlen($body)/1024, 2);

        $panel = <<<HTML

            <h4>HTML Information</h4>

            <script type="text/javascript" charset="utf-8">

                var CodeBlenderHtmlLoad = window.onload;

                window.onload = function()
                {
                    if (CodeBlenderHtmlLoad) {
                        CodeBlenderHtmlLoad();
                    }

                    jQuery("#CodeBlender_Html_Tagcount").html(document.getElementsByTagName("*").length);
                    jQuery("#CodeBlender_Html_Stylecount").html(jQuery("link[rel*=stylesheet]").length);
                    jQuery("#CodeBlender_Html_Scriptcount").html(jQuery("script[src]").length);
                    jQuery("#CodeBlender_Html_Imgcount").html(jQuery("img[src]").length);
                };
            </script>

            <span id="CodeBlender_Html_Tagcount"></span>
            Tags<br />
            HTML Size: {$length}K<br />
            <span id="CodeBlender_Html_Stylecount"></span> Stylesheet Files<br />
            <span id="CodeBlender_Html_Scriptcount"></span> Javascript Files<br />
            <span id="CodeBlender_Html_Imgcount"></span> Images<br />
HTML;

        return $panel;
    }

}
