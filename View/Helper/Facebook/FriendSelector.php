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

// {{{ CodeBlender_View_Helper_Facebook_FriendSelector()

/**
 * Helper class to produce the fb:friend-selector
 *
 * <code>
 * // Invoke the Friend Selector Helper
 * $this->facebook_FriendSelector();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:friend-selector
 *
    include_lists   bool    Indicates whether or not to include friend lists in the suggested options. (Default value is false.)
    prefill_id  bool    A single user ID to pre-populate in the selector. If the viewing user cannot see the prefilled user's name due to privacy, then this parameter will be ignored. Note that this cannot be used inside an <fb:request-form>. (Default value is null.)
 */
class CodeBlender_View_Helper_Facebook_FriendSelector
{
    // {{{ properties

    /**
     * The user whose friends you can select. (Default value is the uid of the currently logged-in user.)
     *
     * Required
     *
     * @var int
     */
    protected $userID = 'loggedinuser';

    /**
     * The name of the form element. (Default value is friend_selector_name.)
     *
     * @var string
     */
    protected $name = 'friend_selector_name';

    /**
     * The name of the hidden form element that contains the user ID of the selected friend.
     * If you are using this tag inside fb:request-form, do not override the default.
     * (Default value is friend_selector_id.)
     *
     * @var string
     */
    protected $idName = 'friend_selector_id';

    /**
     * Indicates whether or not to include the logged in user in the suggested options.
     * (Default value is false.)
     *
     * @var bool
     */
    protected $includeMe = false;

    /**
     * A list of user IDs to exclude from the selector. (comma-separated)
     *
     * @var array
     */
    protected $excludeIDs = false;

    /**
     * Indicates whether or not to include friend lists in the suggested options.
     * (Default value is false.)
     *
     * @var bool
     */
    protected $includeLists = false;

    /**
     * A single user ID to pre-populate in the selector.
     * If the viewing user cannot see the prefilled user's name due to privacy, then this parameter will be ignored.
     * Note that this cannot be used inside an <fb:request-form>. (Default value is null.)
     *
     * @var bool
     */
    protected $prefillID = null;

    // }}}
    // {{{ facebook_ProfilePic()

    /**
     * Method to display the users profile picture
     * Turns into an img tag for the specified user's or Facebook Page's profile picture.
     *
     * @param  array  $params Array of attribute values
     * @return object $this
     */
    public function facebook_FriendSelector($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        $string =
        <<<HTML
          <fb:friend-selector
            uid="{$params['userID']}"
            name="{$params['name']}"
            idname="{$params['idName']}"
            include_me="{$params['includeMe']}"
            exclude_ids="{$params['excludeIDs']}"
            include_lists="{$params['includeLists']}"
            prefill_id="{$params['prefillID']}"
           />
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