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
 * // Facebook Send Button
 * echo $this->facebook_SendButton();
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://developers.facebook.com/docs/reference/plugins/send/
 */
class CodeBlender_View_Helper_Facebook_SendButton extends Zend_View_Helper_Abstract
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
    public function facebook_SendButton($params = array())
    {
        // Overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        $width = '';
        $ref = '';

        // Type check
        if ($params['type'] === 'html5') {

            if ($params['ref']) {
                $ref = ' data-ref="' . $params['ref'] . '"';
            }

            $string = <<<HTML
                <div class="fb-send" data-href="{$params['href']}" data-colorscheme="{$params['colorScheme']}" data-font="{$params['font']}"{$ref}></div>
HTML;
        } else {

            if ($params['ref']) {
                $ref = ' ref="' . $params['ref'] . '"';
            }

            $string = <<<HTML
                <fb:send href="{$params['href']}" colorscheme="{$params['colorScheme']}" font="{$params['font']}"{$ref}></fb:send>
HTML;
        }

        return $string;
    }

}
