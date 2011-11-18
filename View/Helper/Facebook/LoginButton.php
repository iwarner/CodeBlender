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
 * // Facebook Login Button
 * echo $this->facebook_LoginButton();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://developers.facebook.com/docs/reference/plugins/comments/
 */
class CodeBlender_View_Helper_Facebook_LoginButton extends Zend_View_Helper_Abstract
{

    /**
     * Type flag. Either html5 or xfbml supported.
     */
    protected $type = 'html5';

    /**
     * Specifies whether to show faces underneath the Login button.
     */
    protected $showFaces = 'false';

    /**
     * The width of the plugin in pixels. Default width: 200px.
     */
    protected $width = 200;

    /**
     * The maximum number of rows of profile pictures to display. Default value: 1.
     */
    protected $maxRows = 1;

    /**
     * a comma separated list of extended permissions. By default the Login button
     * prompts users for their public information. If your application needs to
     * access other parts of the user's profile that may be private, your application
     * can request extended permissions. A complete list of extended permissions can be found here.
     */
    protected $perms = null;

    /**
     * Facebook Comments
     */
    public function facebook_LoginButton($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Type check
        if ($params['type'] === 'html5') {

            $string = <<<HTML
                <div class="fb-login-button" data-show-faces="true" data-width="200" data-max-rows="1"></div>
HTML;
        } else {

            $string = <<<HTML
                <fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>
HTML;
        }

        return $string;
    }

}
