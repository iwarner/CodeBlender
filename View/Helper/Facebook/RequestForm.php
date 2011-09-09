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

// {{{ CodeBlender_View_Helper_Facebook_RequestForm()

/**
 * Helper class to produce the Facebook Request Form - this is used to send
 * invites and requests to users.
 *
 * The path set in the action parameter will be posted the following variables that
 * should be processed:
 *
 * typeahead string Content the user typed into the multi-selector box.
 * ids       array  Zero-based array containing user IDs the user invited.
 *
 * // Create the Invite box from the Helper
 * $html =
 * <<<HTML
 *   <fb:name uid="{$this->userID}" firstnameonly="true" shownetwork="false" />,
 *   thought you would like to check out the {$this->fbTitle} application for Facebook.
 * HTML;
 *
 * $path = 'http://www.facebook.com/add.php?api_key=' . $this->fbAPI . '&next=?inviteID=' . $this->userID;
 *
 * $params = array(
 *  'actionText'  => 'Invite your friends to ' . $this->fbTitle,
 *  'friendArray' => $this->friends,
 *  'type'        => $this->fbTitle
 * );
 *
 * // Invoke the Invite Helper and add elements
 * $string .= $this->facebook_RequestForm($html, 'Add ' . $this->fbTitle, $path, $params);
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 *
 * @todo Fix up the properties
 */
class CodeBlender_View_Helper_Facebook_RequestForm
{
    // {{{ properties

    /**
     * Vars to set the defaults for the request invite forms
     */
    private $defaults = array(

      'friendArray'    => false,             // Array  friendIDs to exclude from the list
      'max'            => 35,                // INT    Maximum number of users that can be selected.
      'method'         => 'POST',            // String Form method
      'title'          => false,             // String Form method

      // Request Form
      'action'         => 'invite',          // String The page where a user gets redirected on Send or Skip
      'invite'         => true,              // Bool   Whether this is an invite or request
      'content'        => false,             // String Content of the invitation
      'type'           => 'general',         // String Type of request or invitation to generate. For example, "event."

      // Full Only
      'actionText'     => 'Invite Friends',  // String Message to show as the title to the invite box
      'bypass'         => 'skip',            // String Version of the button wanted. Set to "step", "cancel", or "skip" results in Skip This Step, Cancel, or Skip
      'cols'           => 5,                 // INT    Number of cols of friends to show - 2 / 3 or 5
      'emailInvite'    => true,              // Bool   Whether to show qn email invitation section
      'rows'           => 5,                 // INT    Number of rows of friends to show between 3-10.
      'showBorder'     => true,              // Bool   Whether to show the border

      // Condensed Only
      'condensed'      => false,             // Bool   Whether the Multi Friend select is condensed
      'selectedRows'   => 7,                 // INT    Number of rows of friends to display between 5-15; or set it to 0 if you want a single box for both selected and unselected friends
      'unselectedRows' => 10,                // INT    Number of rows of friends to display between 4-15

      //  FB:req-choice parameters
      'url'            => false,             // INT    The URL to which the button should take the user upon click. must be an absolute.
      'label'          => false              // INT    Specifies the text to display on this button.
     );

    // }}}
    // {{{ facebook_RequestForm()

    /**
     * Method to return Invite Page canvas FBML
     *
     * @param  string $text   Invitation text
     * @param  string $title  Required choice title
     * @param  string $path   Path user will go to when they click add on invite
     * @param  array  $params Array of attribute values for the board.
     * @return string
     */
    public function facebook_RequestForm($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge($this->defaults, $params);

        // Create the choice component for the user that receives the invitation or request
        $fbChoice = htmlentities('<fb:req-choice url="' . $params['url'] . '" label="' . $params['label'] . '" />');

        // If the friendArray is an array then comma seperate and exclude these
        // from the invite section.
        if (is_array($params['friendArray'])) {
            $userIDs = implode(',', $params['friendArray']);
        } else {
            $userIDs = '';
        }

        // Convert the text into HTML Enties
        $content = htmlentities($params['content']);

        // Create the String for the request form
        $string =
        <<<HTML
          <fb:request-form
           action  = "{$params['action']}"
           method  = "{$params['method']}"
           invite  = "{$params['invite']}"
           type    = "{$params['type']}"
           content = "{$content} {$fbChoice}">

           <fb:multi-friend-selector
            exclude_ids="{$userIDs}"
            max="{$params['max']}"
HTML;

        if (!$params['condensed']) {

            $string .=
            <<<HTML
              actiontext="{$params['actionText']}"
              bypass="{$params['bypass']}"
              rows="{$params['rows']}"
              cols="{$params['cols']}"
              email_invite="{$params['emailInvite']}"
              showborder="{$params['showBorder']}" />
HTML;
        } else {
            $string .=
            <<<HTML
              condensed="true"
              selected_rows="{$params['selectedRows']}"
              unselected_rows="{$params['unselectedRows']}" />

              <fb:request-form-submit />
HTML;
        }

        // Complete the Request form
        $string .=
        <<<HTML
          </fb:request-form>
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