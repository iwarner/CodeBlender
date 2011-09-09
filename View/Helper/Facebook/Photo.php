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

// {{{ CodeBlender_View_Helper_Facebook_Photo()

/**
 * Helper class to produce render a Facebook Photo Tag
 *
 * <code>
 * // Invoke the Photo Helper
 * $this->facebook_Photo();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:profile-pic
 */
class CodeBlender_View_Helper_Facebook_Photo
{
    // {{{ properties

    /**
     * An API-supplied pid of the photo.
     * The pid cannot be longer than 50 characters.
     *
     * @var string
     */
    protected $pId = false;

    /**
     * (Deprecated) If the pid is not an API-supplied pid,
     * this should be the ID parameter in the query string used to find the pid.
     * This property is not supported in the XFBML variant of this tag and is deprecated for the FBML variant.
     *
     * @var int
     */
    protected $userID = false;

    /**
     * The size of the photo to display. (Default value is normal.).
     * Other valid values are thumb (t) (75px width),
     * small (s) (max of 130px width or height), and normal (n) (max of 604px width or height).
     *
     * @var string
     */
    protected $size = 'thumb';

    /**
     * The image's alignment. (Default value is left.) and the only other valid value is right.
     *
     * @var string
     */
    protected $align = 'left';

    // }}}
    // {{{ facebook_ProfilePic()

    /**
     * Method to display the users profile picture
     * Turns into an img tag for the specified user's or Facebook Page's profile picture.
     *
     * @param  array  $params Array of attribute values
     * @return object $this
     */
    public function facebook_Photo(array $params)
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        $string =
        <<<HTML
            <fb:photo
              pid="{$params['pId']}"
              align="{$params['align']}"
              size="{$params['size']}">
            </fb:photo>
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