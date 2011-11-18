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
 * // Facebook Live Stream
 * echo $this->facebook_LiveStream();
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://developers.facebook.com/docs/reference/plugins/send/
 */
class CodeBlender_View_Helper_Facebook_LiveStream extends Zend_View_Helper_Abstract
{

    /**
     * Type flag. Either html5 or xfbml supported.
     */
    protected $type = 'html5';

    /**
     * The URL to like. The XFBML version defaults to the current page.
     */
    protected $href = 'http://www.triangle-solutions.com';

    /**
     * The font to display in the button.
     * Options: 'arial', 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana'
     *
     * @var string
     */
    protected $font = 'arial';

    /**
     * The color scheme for the like button. Options: 'light', 'dark'
     *
     * @var int
     */
    protected $colorScheme = 'light';

    /**
     * A label for tracking referrals; must be less than 50 characters
     * and can contain alphanumeric characters and some punctuation (currently +/=-.:_).
     * The ref attribute causes two parameters to be added to the URL when a user
     * clicks a link from a stream story about a Like action:
     *
     * @var int
     */
    protected $ref = '';

    /**
     * Facebook Send Button
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_LiveStream($params = array())
    {
        // Overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Type check
        if ($params['type'] === 'html5') {

            $string = <<<HTML
                <div class="fb-live-stream" data-event-app-id="259413234111137" data-width="400" data-height="500" data-always-post-to-friends="false"></div>
HTML;
        } else {

            $string = <<<HTML
                <fb:live-stream event_app_id="259413234111137" width="400" height="500" always_post_to_friends="false"></fb:live-stream>
HTML;
        }

        return $string;
    }

}
