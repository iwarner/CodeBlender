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

// {{{ CodeBlender_View_Helper_Facebook_Analytics()

/**
 * Helper class to display the Facebook Name
 *
 * <code>
 * // Invoke the Facebook Name
 * $this->facebook_Name();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:name
 */
class CodeBlender_View_Helper_Facebook_Name
{
    // {{{ properties

    /**
     * Capitalize the text if useyou==true and loggedinuser==uid. (Default value is false.)
     *
     * @var bool
     */
    protected $capitalize = false;

    /**
     * Show only the user's first name. (Default value is false.)
     *
     * @var bool
     */
    protected $firstNameOnly = false;

    /**
     * Alternate text to display if the logged in user cannot access the user specified.
     * To specify an empty string instead of the default, use ifcantsee="".
     * (Default value is Facebook User.)
     *
     * @var string
     */
    protected $ifCantSee = 'User';

    /**
     * Link to the user's profile. (Default value is true.)
     *
     * @var bool
     */
    protected $linked = 'true';

    /**
     * Show only the user's last name. (Default value is false.)
     *
     * @var bool
     */
    protected $lastNameOnly = 'false';

    /**
     * Make the user's name possessive (e.g. Joe's instead of Joe). (Default value is false.)
     *
     * @var bool
     */
    protected $possessive = 'false';

    /**
     * Displays the primary network for the uid. (Default value is false.)
     *
     * @var bool
     */
    protected $showNetwork = 'false';

    /**
     * Use "yourself" if useyou is true. (Default value is false.)
     *
     * @var bool
     */
    protected $reflexive = 'false';

    /**
     * The Facebook ID of the subject of the sentence where this name is the
     * object of the verb of the sentence.
     * Will use the reflexive when appropriate. When subjectid is used, uid is
     * considered to be the object and uid's name is produced.
     *
     * @var bool
     */
    protected $subjectId = 'false';

    /**
     * The ID of the user or Page whose name you want to show.
     * You can also use "profileowner" on a user's profile or an application canvas page;
     * you can use "loggedinuser" only on canvas pages.
     * Required
     *
     * @var int
     */
    protected $userID = 'loggedinuser';

    /**
     * Use "you" if uid matches the logged in user. (Default value is true.)
     *
     * @var bool
     */
    protected $useYou = 'false';

    // }}}
    // {{{ facebook_Name()

    /**
     * Method to display the users Facebook name
     *
     * @param  array  $params Array of attribute values
     * @return object $this
     */
    public function facebook_Name($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        $string =
        <<<HTML
          <fb:name
            linked="{$params['linked']}"
            shownetwork="{$params['showNetwork']}"
            uid="{$params['userID']}"
            useyou="{$params['useYou']}">
          </fb:name>
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