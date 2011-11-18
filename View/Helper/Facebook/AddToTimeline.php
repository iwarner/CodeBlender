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
 * // Facebook Add To Timeline
 * echo $this->facebook_AddToTimeline();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://developers.facebook.com/docs/reference/plugins/comments/
 */
class CodeBlender_View_Helper_Facebook_AddToTimeline extends Zend_View_Helper_Abstract
{

    /**
     * Type flag. Either html5, xfbml or iframe supported.
     */
    protected $type = 'html5';

    /**
     * Specifies whether to show faces underneath the Login button.
     */
    protected $showFace = 'false';

    /**
     * The mode of the plugin: defaults to box.
     */
    protected $mode = 'box';

    /**
     * A comma separated list of extended permissions.
     * By default the Login button prompts users for their public information.
     * If your application needs to access other parts of the user's profile that may be private,
     * your application can request extended permissions.
     */
    protected $perms = null;

    /**
     * Facebook Comments
     */
    public function facebook_AddToTimeline($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Type check
        if ($params['type'] === 'html5') {

            $string = <<<HTML
                <div class="fb-add-to-timeline" data-show-faces="true" data-mode="button"></div>
HTML;
        } elseif ($params['type'] === 'xfbml') {

            $string = <<<HTML
                <fb:add-to-timeline show-faces="true" mode="button"></fb:add-to-timeline>
HTML;
        } else {

            $string = <<<HTML
                <iframe src="www.facebook.com/plugins/add_to_timeline.php?show-faces=true&amp;mode=button&amp;appId=APP_ID" scrolling="no" frameborder="0" style="border:none; overflow:hidden;" allowTransparency="true"></iframe>
HTML;
        }

        return $string;
    }

}
