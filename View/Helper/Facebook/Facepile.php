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
 * // Facebook Facepile
 * echo $this->facebook_Facepile();
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://developers.facebook.com/docs/reference/plugins/send/
 */
class CodeBlender_View_Helper_Facebook_Facepile extends Zend_View_Helper_Abstract
{

    /**
     * Type flag. Either html5 or xfbml supported.
     *
     * @var string
     */
    protected $type = 'html5';

    /**
     * The URL of the page. The plugin will display photos of users who have liked this page.
     *
     * @var string
     */
    protected $href = 'http://www.triangle-solutions.com';

    /**
     * If you want the plugin to display users who have connected to your site,
     * specify your application id as this parameter. This parameter is only
     * available in the iframe version of the Facepile. If you are using the XFBML
     * version of the plugin, specify your application id when you initialize the Javascript library.
     *
     * @var int
     */
    protected $appID = null;

    /**
     * The color scheme for the like button. Options: 'light', 'dark'
     *
     * @var string
     */
    protected $colorScheme = 'light';

    /**
     * The maximum number of rows of faces to display.
     * The XFBML version will dynamically size its height; if you specify a maximum
     * of four rows of faces, but there are only enough friends to fill two rows,
     * the XFBML version of the plugin will set its height for two rows of faces.
     *
     * @var int
     */
    protected $maxRows = 1;

    /**
     * Size of the photos and social context. Default size: small.
     *
     * @var string
     */
    protected $size = 'small';

    /**
     * Width of the plugin in pixels. Default width: 200px.
     *
     * @var int
     */
    protected $width = 200;

    /**
     * Facebook Facepile
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_Facepile($params = array())
    {
        // Overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Type check
        if ($params['type'] === 'html5') {

            $string = <<<HTML
                <div class="fb-facepile" data-href="triangle-solutions.com" data-width="200" data-max-rows="1"></div>
HTML;
        } elseif ($params['type'] === 'xfbml') {

            $string = <<<HTML
                <fb:facepile href="triangle-solutions.com" width="200" max_rows="1"></fb:facepile>
HTML;
        } else {

            $string = <<<HTML
                <iframe src="//www.facebook.com/plugins/facepile.php?href=triangle-solutions.com&amp;size=small&amp;width=200&amp;max_rows=1&amp;colorscheme=light&amp;appId=259413234111137" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px;" allowTransparency="true"></iframe>
HTML;
        }

        return $string;
    }

}
