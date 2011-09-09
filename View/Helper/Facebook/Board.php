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

// {{{ CodeBlender_View_Helper_Facebook_Board()

/**
 * Helper class to produce the Facebook Board
 *
 * <code>
 * // Invoke the Invite Helper and add elements
 * $this->facebook_Board();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:board
 *
 * @todo Sort out the Callback and Return URL.
 */
class CodeBlender_View_Helper_Facebook_Board
{
    // {{{ properties

    /**
     * Indicates whether the viewing user can create a topic on this board. (Default value is true.)
     *
     * @var bool
     */
    protected $canCreateTopic = 'true';

    /**
     * Indicates whether the viewing user can delete any post or topic on this board. (Default value is false.)
     *
     * @var bool
     */
    protected $canDelete = 'false';

    /**
     * The URL to refetch this configuration. (Default value is the current page.)
     *
     * @var string
     */
    protected $callBackURL = false;

    /**
     * Indicates whether the viewing user can mark a post as relevant or irrelevant. (Default value is false.)
     *
     * @var bool
     */
    protected $canMark = 'false';

    /**
     * Indicates whether the viewing user can post on this board. (Default value is true.)
     *
     * @var bool
     */
    protected $canPost = 'true';

    /**
     * The maximum number of topics to show in the box. (Default value is 3.)
     *
     * @var int
     */
    protected $numTopics = 5;

    /**
     * The URL where the user is returned after selecting a "back" link. (Default value is the current page.)
     *
     * @var string
     */
    protected $returnURL = false;

    /**
     * Title of the Board
     *
     * @var string
     */
    protected $title = false;

    /**
     * The unique identifier for this board.
     * The board name can contain alphanumeric characters (Aa-Zz, 0-9), hyphens (-) and underscores (_) only.
     *
     * @var string
     */
    protected $xID = false;

    // }}}
    // {{{ facebook_Board()

    /**
     * Method to display a discussion board for a unique identifier. Facebook
     * handles see all page, topic display, posting and storage.
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_Board($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Create the FBML string to return
        $string =
        <<<HTML
          <fb:board

           xid="{$params['xID']}"
           canpost="{$params['canPost']}"
           candelete="{$params['canDelete']}"
           canmark="{$params['canMark']}"
           cancreatetopic="{$params['canCreate']}"
           numtopics="{$params['numberTopics']}">

           <fb:title>{$title}</fb:title>

          </fb:board>
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