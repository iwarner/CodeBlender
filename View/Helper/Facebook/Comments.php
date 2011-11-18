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
 * <code>
 * // Facebook Comments
 * echo $this->facebook_Comments();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://developers.facebook.com/docs/reference/plugins/comments/
 */
class CodeBlender_View_Helper_Facebook_Comments extends Zend_View_Helper_Abstract
{

    /**
     * Type flag. Either html5 or xfbml supported.
     */
    protected $type = 'html5';

    /**
     * The URL for this Comments plugin.
     * News feed stories on Facebook will link to this URL.
     */
    protected $href = 'triangle-solutions.com';

    /**
     * The width of the plugin in pixels.
     * Minimum recommended width: 400px.
     */
    protected $width = 520;

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

        // Type check
        if ($params['type'] === 'html5') {

            $string = <<<HTML
                <div class="fb-comments" data-href="{$params['href']}" data-num-posts="{$params['numPosts']}" data-width="{$params['width']}" data-colorscheme="{$params['colorScheme']}"></div>
HTML;
        } else {

            $string = <<<HTML
                <fb:comments href="{$params['href']}" num_posts="{$params['numPosts']}" width="{$params['width']}" colorscheme="{$params['colorScheme']}"></fb:comments>
HTML;
        }

        return $string;
    }

}
