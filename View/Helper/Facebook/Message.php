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

// {{{ CodeBlender_View_Helper_Facebook_Message()

/**
 * Helper class to display the Facebook Message element
 *
 * <code>
 * // Invoke the Leaderboards
 * $this->FacebookMessage(array(
 *    'title' => 'Success Message',
 *    'text'  => 'Your account was added correctly',
 *    'type'  => 'success'
 *   ))
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:message
 *
 * @todo Allow the title to be optional.
 * @todo Transform this to use the setters method
 * @todo Fix up the properties
 */
class CodeBlender_View_Helper_Facebook_Message
{
    // {{{ properties

    /**
     * Vars to set the defaults
     */
    private $defaults = array(
      'title' => '',       // String Text to display in the message
      'text'  => '',       // String Text to display in the message
      'type'  => 'success' // String error, explanation, or success.
     );

    // }}}
    // {{{ facebook_Message()

    /**
     * Method to get a standard Facebook message
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_Message($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge($this->defaults, $params);

        // Create the message string
        $string =
        <<<HTML
          <fb:{$params['type']}>
           <fb:message>{$params['title']}</fb:message>
           {$params['text']}
          </fb:{$params['type']}>
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