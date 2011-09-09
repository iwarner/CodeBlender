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

// {{{ CodeBlender_View_Helper_Facebook_Frame()

/**
 * Helper class to produce the Facebook iFrame
 *
 * // Invoke the Frame Button Helper
 * {$this->FacebookFrame(array(
 *    'src' => 'http://lovefootball.triangle-solutions.com/track/index/'
 *   ))}
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 *
 * @todo Fix up the properties
 */
class CodeBlender_View_Helper_Facebook_Frame
{
    // {{{ properties

    /**
     * Vars to set the defaults
     */
    private $defaults = array(

      // Required
      'src'            => false, // String The URL of the iframe. Signed GET parameters are appended to the URL to prove that the frame was loaded through Facebook, as described in the forms section. These parameters also include one named fb_sig_in_iframe to indicate this context.

      // Optional
      'ext_send_ss'    => false, // Bool   Setting this to true requires that the session secret (fb_sig_ss) be passed
      'frameborder'    => '0',   // Int    Indicates whether to show (1) or hide (0) an iframe border. (default 1)
      'height'         => 1,   // Int    Indicates the height of the iframe.
      'include_fb_sig' => false, // Bool   Setting this to false indicates that credential information is not sent to the site in the iframe. (Default true.)
      'scrolling'      => 'no',  // String Indicates whether to show scrollbars. (default value is yes) - use "yes", "no", or "auto" (not "true" or "false")
      'name'           => false, // String The name of the iframe. You must name the iframe when resizable is enabled.
      'resizable'      => false, // Bool   Gives the ability to set the iframe's size using the JavaScript API. See Resizable_IFrame for details. You must specify a name for this iframe. This option cannot be used when smartsize is enabled.
      'smartsize'      => false, // Bool   This parameter smartly sizes the iframe to fit the remaining space on the page and disables the outer scrollbars. If you include more than one smartsizing iframe, they automatically distribute the size appropriately. (default false)
      'style'          => false, // String Indicates a custom inline style for the iframe.
      'width'          => '1',   // Int    Indicates the width of the iframe.
    );

    // }}}
    // {{{ facebook_Frame()

    /**
     * Method to display a Facebook IFrame
     *
     * @param  array  $params Array of attribute values
     * @return string
     *
     * @link   http://wiki.developers.facebook.com/index.php/Fb:iframe
     */
    public function facebook_Frame($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge($this->defaults, $params);

        // Initiate the Facebook IFrame Tag
        $string =
        <<<HTML
          <fb:iframe
           src="{$params['src']}"
           width="{$params['width']}"
           height="{$params['height']}"
           scrolling="{$params['scrolling']}"
           style="margin: 0px; padding: 0px;"
           frameborder="{$params['frameborder']}"
           />
HTML;

        // Return the string
        return $string;
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