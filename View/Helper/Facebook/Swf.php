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

// {{{ CodeBlender_View_Helper_Facebook_SWF()

/**
 * Helper class to produce the Facebook SWF video
 *
 * // Invoke the Facebook SWF Helper
 * $this->facebook_Swf(array(
 *   'swfSrc' => ''
 *  ))
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:swf
 *
 * @todo Use the Asset Path as default unless specified.
 */
class CodeBlender_View_Helper_Facebook_Swf
{
    // {{{ properties

    /**
     * An <embed> param. Can be any string.
     *
     * @var string
     */
    protected $align;

    /**
     * Enables the flash to talk to FBJS
     *
     * @var string
     */
    protected $fBJSBridge = false;

    /**
     * A query string of variables to be passed to the SWF as <param> tags. Can be any string.
     *
     * @var string
     */
    protected $flashVars;

    /**
     * The height of the generated flash box in pixels.
     * Must be a size as recognized by a browser (50, 50px, 50em, 50%).
     *
     * @var string
     */
    protected $height;

    /**
     * The css class name that will be added to the image tag. Can be any string.
     *
     * @var string
     */
    protected $imgClass;

    /**
     * If set, the source of the image to use before the swf object is loaded. Must be an absolute url.
     *
     * @var string
     */
    protected $imgSrc;

    /**
     * The style attribute rendered on the img tag. Can be any string.
     *
     * @var string
     */
    protected $imgStyle;

    /**
     * An <embed> param. Whether or not the SWF loops. Must be a boolean.
     *
     * @var bool
     */
    protected $loop;

    /**
     * An <embed> param. The quality at which the SWF will display.
     * Must be one of : low medium high Default is high.
     *
     * @var string
     */
    protected $quality = 'high';

    /**
     * The salign attribute from normal Flash <embed>.
     * Specify t (top), b (bottom) l (left), r (right) or a combination (tl, tr, bl, br)
     *
     * @var string
     */
    protected $sAlign;

    /**
     * The scaling to apply to the object. Specify showall, noborder, exactfit
     *
     * @var bool
     */
    protected $scale;

    /**
     * The background color of the swf. Must be a hex color.
     *
     * @var string
     */
    protected $swfBgColor;

    /**
     * The ID of the SWF
     *
     * @var string
     */
    protected $swfID = 'mySWF';

    /**
     * The source url of the flash swf file. Must be an absolute url.
     * Required
     *
     * @var string
     */
    protected $swfSrc;

    /**
     * If true, an image with the url specified by the imgsrc attribute is shown in place of the swf.
     * When clicked, the image is replaced with the SWF. Must be a boolean . Default is false.
     *
     * @var bool
     */
    protected $waitForClick = false;

    /**
     * The width of the generated flash box in pixels.
     * Must be a size as recognized by a browser (50, 50px, 50em, 50%).
     *
     * @var string
     */
    protected $width;

    /**
     * The wmode to use when rendering the swf.
     * Must be one of: transparent opaque window Default is transparent.
     *
     * @var string
     */
    protected $wmode = 'transparent';

    // }}}
    // {{{ facebook_SWF()

    /**
     * Method to display a Facebook SWF movie
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_Swf(array $params)
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        $string = '';

        // Include the fbjs bridge tag if requested
        if (!empty($params['fBJSBridge'])) {
            $string .= '<fb:fbjs-bridge />';
        }

        // URL Encode the Flash Vars
        $flashVars = self::_flashVars($params['flashVars']);

        // Create the main SWF FBML
        $string .=
        <<<HTML
          <fb:swf
            id="{$params['swfID']}"
            flashvars="{$flashVars}"
            height="{$params['height']}"
            swfsrc="{$params['swfSrc']}"
            width="{$params['width']}" />
HTML;

        return $string;
    }

    // }}}
    // {{{ _flashVars()

    /**
     * Method to create the flashVars string correctlly
     * from a passed in array
     *
     * @param  array  $flashVars Array of flashVars
     * @return string
     */
    private function _flashVars($flashVars)
    {
        // Check tha the flash vars is not empty
        if (!empty($flashVars)) {

            $varString = '';

            // Loop through the flashVars array
            foreach ($flashVars as $k => $v) {
                $varString .= '&' . $k . '=' . urlencode($v);
            }

            return $varString;

        // Else return false
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