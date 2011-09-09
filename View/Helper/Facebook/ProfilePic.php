<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @version    SVN: $Id: $
 */

// {{{ CodeBlender_View_Helper_Facebook_ProfilePic()

/**
 * Helper class to produce the fb:profile-pic
 *
 * <code>
 * // Invoke the Frame Button Helper
 * $this->facebook_ProfilePic();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:profile-pic
 */
class CodeBlender_View_Helper_Facebook_ProfilePic
{
    // {{{ properties

    /**
     * Property to set a style class for the profile picture.
     *
     * @var string
     */
    protected $class = 'profilePic';

    /**
     * (For use with Facebook Connect only.) When set to true,
     * it returns the Facebook favicon image, which gets overlaid on
     * top of the user's profile picture on a site.
     *
     * @var bool
     */
    protected $facebookLogo = false;

    /**
     * Height of the image
     *
     * @var int
     */
    protected $height = false;

    /**
     * Make the image a link to the user's profile. (Default value is true.)
     *
     * @var bool
     */
    protected $linked = 'true';

    /**
     * The size of the image to display. (Default value is thumb.).
     * Other valid values are:
     * thumb (t) (50px wide)
     * small (s) (100px wide)
     * normal (n) (200px wide)
     * and square (q) (50px by 50px)
     * Or, you can specify width and height settings instead, just like an img tag.
     *
     * @var string
     */
    protected $size = 'square';

    /**
     * The user ID of the profile or Facebook Page for the picture you want to display.
     * On a canvas page, you can also use "loggedinuser".
     *
     * Required
     *
     * @var int
     */
    protected $userID = 'loggedinuser';

    /**
     * Width of the image
     *
     * @var int
     */
    protected $width = false;

    // }}}
    // {{{ facebook_ProfilePic()

    /**
     * Method to display the users profile picture
     * Turns into an img tag for the specified user's or Facebook Page's profile picture.
     *
     * @param  array  $params Array of attribute values
     * @return object $this
     */
    public function facebook_ProfilePic(array $params)
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        $string =
        <<<HTML
            <fb:profile-pic
              class="{$params['class']}"
              uid="{$params['userID']}"
              linked="{$params['linked']}"
              size="{$params['size']}">
            </fb:profile-pic>
HTML;

        return $string;
    }

    // }}}

}

// }}}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */