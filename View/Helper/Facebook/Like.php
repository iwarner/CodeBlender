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
 * Helper class to produce the Facebook Like button
 *
 * // Invoke the Facebook Footer
 * echo $this->facebook_Like(array());
 *
 * Open Graph tags, the following six are required:
 * og:title - The title of the entity.
 * og:type - The type of entity. You must select a type from the list of Open Graph types.
 * og:image - The URL to an image that represents the entity. Images must be at least 50 pixels by 50 pixels. Square images work best, but you are allowed to use images up to three times as wide as they are tall.
 * og:url - The canonical, permanent URL of the page representing the entity. When you use Open Graph tags, the Like button posts a link to the og:url instead of the URL in the Like button code.
 * og:site_name - A human-readable name for your site, e.g., "IMDb".
 * fb:admins or fb:app_id - A comma-separated list of either the Facebook IDs of page administrators or a Facebook Platform application ID. At a minimum, include only your own Facebook ID.
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Facebook_Like extends Zend_View_Helper_Abstract
{

    /**
     * The URL to like. The XFBML version defaults to the current page.
     */
    protected $href = false;

    /**
     * Specifies whether to include a Send button with the Like button.
     * This only works with the XFBML version.
     */
    protected $send = false;

    /**
     * Displays the total number of likes to the right of the button.
     * Minimum width: 90 pixels. Default width: 90 pixels. Height: 20 pixels.
     *
     * button_count, standard, box_count
     */
    protected $layout = 'button_count';

    /**
     * Specifies whether to display profile photos below the button (standard layout only)
     *
     * @var string
     */
    protected $showFaces = 'false';

    /**
     * The width of the Like button.
     *
     * @var int
     */
    protected $width = 90;

    /**
     * The verb to display on the button. Options: 'like', 'recommend'
     *
     * @var string
     */
    protected $action = 'like';

    /**
     * The font to display in the button.
     * Options: 'arial', 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana'
     *
     * @var string
     */
    protected $font = 'tahoma';

    /**
     * The color scheme for the like button. Options: 'light', 'dark'
     *
     * @var int
     */
    protected $colorScheme = 'light';

    /**
     * A label for tracking referrals; must be less than 50 characters and can contain alphanumeric characters and some punctuation (currently +/=-.:_). The ref attribute causes two parameters to be added to the URL when a user clicks a link from a stream story about a Like action:
     *
     * @var int
     */
    protected $ref = '';


    /**
     * Method to display a Facebook Footer
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_Like($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        if (!$params['href']) {
            $href = 'href="' . $params['href'] . '"';
        } else {
            $href = '';
        }

        // Initiate the Facebook Footer
        $string = <<<HTML
            <fb:like
                action="{$params['action']}"
                {$href}
                layout="{$params['layout']}"
                show_faces="{$params['showFaces']}"
                width="{$params['width']}"
                font="{$params['font']}"
                ref="{$params['ref']}"
                colorscheme="{$params['colorScheme']}">
            </fb:like>
HTML;

        // Return the string
        return $string;
    }

}
