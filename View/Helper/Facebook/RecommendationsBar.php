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
 * // Facebook Recommendations Bar
 * echo $this->facebook_RecommendationsBar();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://developers.facebook.com/docs/reference/plugins/comments/
 */
class CodeBlender_View_Helper_Facebook_RecommendationsBar extends Zend_View_Helper_Abstract
{
//href - the URL of the page. The XFBML version defaults to the current page.
//trigger - when the plugin expands. Default is when a user scrolls past the <fb:recommendations-bar/> tag. There are three options.
//onvisible - read is published when a user scrolls past the exact point where the XFBML tag is placed on the page.
//X% - where X is any positive integer less than or equal to 100. Indicates % of page scrolled past before read is triggered
//manual - use this option to manually trigger the read action. You call FB.XFBML.RecommendationsBar.markRead(href); when you want the plugin to expand. The href parameter is only necessary if the <fb:recommendations-bar/> tag includes an explicit href attribute. By default, this is the current request URL.
//read_time - The number of seconds before the plugin will expand. Default is 30 seconds
//action - The verb to display on the button. Options: 'like', 'recommend'
//side - the side of the screen where the plugin will be displayed. This will automatically adjust based on the language, or can be set explicitly.
//site - a comma separated list of domains to show recommendations for. The default is the domain of the href parameter.
//ref - a label for tracking referrals; must be less than 50 characters and can contain alphanumeric characters and some punctuation (currently +/=-.:_). The ref attribute causes two parameters to be added to the referrer URL when a user clicks a link from a stream story about a Like action:
//fb_ref - the ref parameter
//fb_source - the stream type ('home', 'profile', 'search', 'other') in which the click occurred and the story type ('oneline' or 'multiline'), concatenated with an underscore.

    /**
     * Type flag. Either html5 or xfbml supported.
     */
    protected $type = 'html5';

    /**
     * The URL for this Comments plugin.
     * News feed stories on Facebook will link to this URL.
     */
    protected $href = 'http://www.triangle-solutions.com';

    /**
     * Facebook Comments
     */
    public function facebook_RecommendationsBar($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Type check
        if ($params['type'] === 'html5') {

            $string = <<<HTML
                <div class="fb-recommendations-bar" data-href="{$params['href']}"></div>
HTML;
        } else {

            $string = <<<HTML
                <fb:recommendations-bar href="{$params['href']}"></fb:recommendations-bar>
HTML;
        }

        return $string;
    }

}
