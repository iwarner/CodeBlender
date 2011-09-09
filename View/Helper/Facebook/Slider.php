<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @version    SVN: $Id: $
 */

// {{{ CodeBlender_View_Helper_Facebook_Slider()

/**
 * Helper class to produce the Facebook JS Slider
 *
 * // Invoke the Facebook Slider Helper
 * $string .= $this->facebook_Slider();
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 *
 * @todo Fix up the properties
 */
class CodeBlender_View_Helper_Facebook_Slider extends Zend_View_Helper_Abstract
{
    // {{{ properties

    /**
     * Vars to set the defaults
     */
    private $defaults = array(
      'name'         => '',  // unique name for slider
      'min'          => 0,   // minimum value for slider
      'max'          => 10,  // maximum value for slider
      'width'        => 100, // width of slider
      'initialValue' => 5    // initial slider value
     );

    // }}}
    // {{{ facebook_Slider()

    /**
     * Method to display a Facebook Slider Object
     *
     * @param  array  $params Array of attribute values
     * @return string
     *
     * @link   http://wiki.developers.facebook.com/index.php/Fb:swf
     */
    public function facebook_Slider($params = array())
    {
        $this->config = Zend_Registry::get('config');

        // Merge the two arrays to overwrite default values.
        $params = array_merge($this->defaults, $params);

        // Load in specific Site Stylesheet if it exists.
        $filename     = 'css/slider.css';
        $fileRevision = 'v0.02';
        $appendResult = self::appendFile($filename, $fileRevision);

        // Load in default Large Leaderboard JavaScript

        // Load in specific Site JavaScript file if it exists
        $filename     = 'javascript/slider.js';
        $fileRevision = 'v0.02';
        $appendResult = self::appendFile($filename, $fileRevision);

        // Initiate the HTML and JavaScript
        $string =
        <<<HTML
          <div id='{$params['name']}_slider'></div>
          <input type='hidden' value='' id='{$params['name']}_count' name='{$params['name']}_count' />
          <script type='text/javascript'>
              new slider( document.getElementById( "{$params['name']}_slider" ), {$params['min']}, {$params['max']}, {$params['width']}, document.getElementById( "{$params['name']}_count" ), {$params['initialValue']} );
          </script>
HTML;

        return $string;
    }

    // }}}
    // {{{ appendFile()
    /**
     * appends a CSS or JS file to the page header
     *
     * @return bool
     * @param string $filePath
     * @param string $fileRevision[optional]
     * @param bool   $isTheme
     */
    private function appendFile($filePath, $fileRevision = 'v1.0', $isTheme = true)
    {
        if($isTheme == true) {
            $filename = 'themes/facebook/' . $filePath;
        } else {
            $filename = $this->config->fb->appCallBack . $filePath;//
        }

        if (file_exists($filename)) {
            $filename = $this->config->fb->appCallBack . $filename;
            $filename .=  '?' . $fileRevision;
            if(strpos($filename, '.css') != false) {
                $this->view->headLink()->appendStylesheet($filename);
            } else {
                $this->view->headScript()->appendFile($filename);
            }

            return true;
        } else {
            return false;
        }
    }

    // }}}

}

// }}}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */