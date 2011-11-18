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
 * // Facebook Recommendations Box
 * echo $this->facebook_RecommendationsBox();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://developers.facebook.com/docs/reference/plugins/comments/
 */
class CodeBlender_View_Helper_Facebook_RecommendationsBox extends Zend_View_Helper_Abstract
{

//site - the domain to show recommendations for. The XFBML version defaults to the current domain.
//action - a comma separated list of actions to show recommendations for.
//app_id - will display recommendations for all types of actions, custom and global, associated with this app_id.
//width - the width of the plugin in pixels. Default width: 300px.
//height - the height of the plugin in pixels. Default height: 300px.
//header - specifies whether to show the Facebook header.
//colorscheme - the color scheme for the plugin. Options: 'light', 'dark'
//font - the font to display in the plugin. Options: 'arial', 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana'
//border_color - the border color of the plugin.
//linktarget - This specifies the context in which content links are opened. By default all links within the plugin will open a new window. If you want the content links to open in the same window, you can set this parameter to _top or _parent. Links to Facebook URLs will always open in a new window.
//ref - a label for tracking referrals; must be less than 50 characters and can contain alphanumeric characters and some punctuation (currently +/=-.:_). Specifying a value for the ref attribute adds the 'fb_ref' parameter to the any links back to your site which are clicked from within the plugin. Using different values for the ref parameter for different positions and configurations of this plugin within your pages allows you to track which instances are performing the best.
//max_age - a limit on recommendation and creation time of articles that are surfaced in the plugins, the default is 0 (we don’t take age into account). Otherwise the valid values are 1-180, which specifies the number of days.

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
     * The color scheme for the plugin. Options: 'light', 'dark'
     */
    protected $colorScheme = 'light';

    /**
     * Facebook Comments
     */
    public function facebook_RecommendationsBox($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Type check
        if ($params['type'] === 'html5') {

            $string = <<<HTML
                <div class="fb-recommendations" data-width="300" data-height="300" data-header="true"></div>
HTML;
        } elseif ($params['type'] === 'xfbml') {

            $string = <<<HTML
                <fb:recommendations width="300" height="300" header="true"></fb:recommendations>
HTML;
        } else {

            $string = <<<HTML
                <iframe src="//www.facebook.com/plugins/recommendations.php?site&amp;action&amp;width=300&amp;height=300&amp;header=true&amp;colorscheme=light&amp;linktarget=_blank&amp;border_color&amp;font&amp;appId=259413234111137" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:300px;" allowTransparency="true"></iframe>
HTML;
        }

        return $string;
    }

}
