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

// {{{ CodeBlender_View_Helper_Facebook_Bookmark()

/**
 * Helper class to render a button that lets a user bookmark your application
 * or Facebook Connect website so a link to your application appears on the user's profile.
 * Make sure you specify a Bookmark URL in your application settings.
 *
 * If the user already bookmarked your application, the bookmark doesn't appear.
 *
 * <code>
 * // Invoke the Frame Button Helper
 * $this->facebook_Bookmark();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:bookmark
 */
class CodeBlender_View_Helper_Facebook_Bookmark
{
    // {{{ facebook_AddSection()

    /**
     * Method to display a Facebook Bookmark button
     *
     * @return string
     */
    public function facebook_Bookmark()
    {
        // Initiate the Facebook Bookmark Button
        $string = <<<HTML
          <fb:bookmark></fb:bookmark>
HTML;

        // Return the string
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