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
 * // Facebook Like Button
 * echo $this->facebook_LikeButton();
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
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://developers.facebook.com/docs/reference/plugins/like/
 */
class CodeBlender_View_Helper_Facebook_LikeButton extends Zend_View_Helper_Abstract
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
     * Specifies whether to include a Send button with the Like button.
     * This only works with the XFBML version.
     */
    protected $send = 'false';

    /**
     * Three layout options
     * standard - Minimum width: 225 pixels. Default width: 450 pixels. Height: 35 pixels (without photos) or 80 pixels (with photos).
     * button_count - Minimum width: 90 pixels. Default width: 90 pixels. Height: 20 pixels.
     * box_count - Minimum width: 55 pixels. Default width: 55 pixels. Height: 65 pixels.
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
    protected $width = null;

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
     * Facebook Like Button
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_LikeButton($params = array())
    {
        // Overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        $showFaces = '';
        $width = '';
        $ref = '';

        // Type check
        if ($params['type'] === 'html5') {

            if ($params['showFaces'] && $params['layout'] === 'standard') {
                $showFaces = ' data-show-faces="' . $params['showFaces'] . '"';
            }

            if ($params['width']) {
                $width = ' data-width="' . $params['width'] . '"';
            }

            if ($params['ref']) {
                $ref = ' data-ref="' . $params['ref'] . '"';
            }

            $string = <<<HTML
                <div class="fb-like" data-action="{$params['action']}" data-href="{$params['href']}" data-layout="{$params['layout']}" data-send="{$params['send']}" data-colorscheme="{$params['colorScheme']}" data-font="{$params['font']}"{$showFaces}{$width}{$ref}></div>
HTML;
        } else {

            if ($params['showFaces'] && $params['layout'] === 'standard') {
                $showFaces = ' show-faces="' . $params['showFaces'] . '"';
            }

            if ($params['width']) {
                $width = ' width="' . $params['width'] . '"';
            }

            if ($params['ref']) {
                $ref = ' ref="' . $params['ref'] . '"';
            }

            $string = <<<HTML
                <fb:like action="{$params['action']}" href="{$params['href']}" layout="{$params['layout']}" send="{$params['send']}" colorscheme="{$params['colorScheme']}" font="{$params['font']}"{$showFaces}{$width}{$ref}></fb:like>
HTML;
        }

        return $string;
    }

}
