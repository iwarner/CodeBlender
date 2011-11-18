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
 * // Facebook Like Box
 * echo $this->facebook_LikeBox();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://developers.facebook.com/docs/reference/plugins/comments/
 */
class CodeBlender_View_Helper_Facebook_LikeBox extends Zend_View_Helper_Abstract
{
//stream - specifies whether to display a stream of the latest posts from the Page's wall
//header - specifies whether to display the Facebook header at the top of the plugin.
//border_color - the border color of the plugin.
//force_wall - for Places, specifies whether the stream contains posts from the Place's wall or just checkins from friends. Default value: false.

    /**
     * Type flag. Either html5 or xfbml supported.
     *
     * @var string
     */
    protected $type = 'html5';

    /**
     * the URL of the Facebook Page for this Like Box
     *
     * @var string
     */
    protected $href = 'triangle-solutions.com';

    /**
     * The width of the plugin in pixels.
     *
     * @var int
     */
    protected $width = 300;

    /**
     * The height of the plugin in pixels. The default height varies based on
     * number of faces to display, and whether the stream is displayed. With the
     * stream displayed, and 10 faces the default height is 556px. With no faces,
     * and no stream the default height is 63px.
     *
     * @var int
     */
    protected $height = 63;

    /**
     * The color scheme for the plugin. Options: 'light', 'dark'
     */
    protected $colorScheme = 'light';

    /**
     * Specifies whether or not to display profile photos in the plugin. Default value: true.
     */
    protected $showFaces = 10;

    /**
     * Facebook Comments
     */
    public function facebook_LikeBox($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Type check
        if ($params['type'] === 'html5') {

            $string = <<<HTML
                <div class="fb-like-box" data-href="facebook.com/TriangleSolutionsLtd" data-width="292" data-show-faces="true" data-stream="true" data-header="true"></div>
HTML;
        } elseif ($params['type'] === 'xfbml') {

            $string = <<<HTML
                <fb:like-box href="facebook.com/TriangleSolutionsLtd" width="292" show_faces="true" stream="true" header="true"></fb:like-box>
HTML;
        } else {

            $string = <<<HTML
                <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fplatform&amp;width=292&amp;height=590&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=true&amp;header=true&amp;appId=259413234111137" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:590px;" allowTransparency="true"></iframe>
HTML;
        }

        return $string;
    }

}
