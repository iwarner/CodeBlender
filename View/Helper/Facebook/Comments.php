<?php

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Helper
 *
 * <code>
 *     // Invoke the Facebook Comments Helper
 *     echo $this->facebook_Comments();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2000-2001 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:comments
 */
class CodeBlender_View_Helper_Facebook_Comments
{

    /**
     * The URL for this Comments plugin.
     * News feed stories on Facebook will link to this URL.
     */
    protected $HREF = false;

    /**
     * The width of the plugin in pixels.
     * Minimum recommended width: 400px.
     */
    protected $width = 580;

    /**
     * The number of comments to show by default. Default: 10. Minimum: 1
     */
    protected $numPosts = 10;

    /**
     * The color scheme for the plugin. Options: 'light', 'dark'
     */
    protected $colorScheme = 'light';


    /**
     * Facebook Comments
     */
    public function facebook_Comments($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        $string = <<<HTML
            <fb:comments
                href="{$params['HREF']}"
                num_posts="{$params['numPosts']}"
                width="{$params['width']}"
                colorscheme="{$params['colorScheme']}">
            </fb:comments>
HTML;

        return $string;
    }

}
