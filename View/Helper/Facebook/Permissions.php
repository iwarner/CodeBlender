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

// {{{ CodeBlender_View_Helper_Facebook_Permissions()

/**
 * Helper class that renders the content of the tag as a link that, when clicked,
 * initiates a dialog requesting the specified extended permissions from the user.
 * You can prompt the user for a series of permissions.
 *
 * If the user has already granted a permission, a dialog for that permission does not appear.
 * If the user has not already authorized the application before clicking the link, he or she
 * is prompted to authorize it before being prompted for the permission.
 *
 * You can prompt a user to approve the following extended permissions for your application:
 * Allowing email to be sent to the user
 * Reading from a user's stream
 * Publishing posts to a user's stream
 * Granting offline access (what used to be known as an infinite session) for your application
 * Updating user status
 * Uploading and tagging photos
 * Creating and modifying events
 * Setting a user's RSVP status for an event
 * Sending SMS to the user
 * Uploading videos to user profiles
 * Writing, editing, and deleting notes on user profiles
 * Posting links to user profiles
 *
 * // Invoke the permissions dialog
 * $this->facebook_Permissions(array(
 *   'perms' => 'email',
 *   'text'  => 'Button'
 *  ));
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:prompt-permission
 */
class CodeBlender_View_Helper_Facebook_Permissions
{
    // {{{ properties

    /**
     * The FBJS that will be called if the user grants the requested permission.
     *
     * @var string
     */
    protected $nextFBJS = false;

    /**
     * A comma-separated string representing the extended permissions being requested.
     * Specify any of the following permissions:
     * email, read_stream, publish_stream, offline_access, status_update, photo_upload,
     * create_event, rsvp_event, sms, video_upload, create_note, share_item.
     *
     * @var string
     */
    protected $perms = 'email';

    /**
     * Text to display between the permissions Tag.
     *
     * @var string
     */
    protected $text = false;

    // }}}
    // {{{ facebook_Permissions()

    /**
     * Method to display a Facebook Permissions dialog
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_Permissions($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Initiate the Facebook Add Section Button
        $string =
        <<<HTML
          <fb:prompt-permission perms="{$params['perms']}" next_fbjs="{$params['nextFBJS']}">
           {$params['text']}
          </fb:prompt-permission>
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