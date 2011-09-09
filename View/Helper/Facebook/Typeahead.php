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

// {{{ CodeBlender_View_Helper_Facebook_Typeahead()

/**
 * Helper class to produce the Facebook Type Ahead
 *
 * // Invoke the Type Ahead FBML
 * $string .= $this->facebook_Typeahead();
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 *
 * @todo Fix up the properties
 */
class CodeBlender_View_Helper_Facebook_Typeahead
{
    // {{{ properties

    /**
     * Vars to set the defaults for the request invite forms
     */
    private $defaults = array(
      'friends' => false,       // Bool   Whether the Options array passed in is a list of Facebook uIDs, this convert these to names.
      'name'    => 'typeAhead', // String Variable name that is sent in the POST request when the form is submitted.
      'options' => false        // Array  List of type ahead options.
     );

    // }}}
    // {{{ facebook_Typeahead()

    /**
     * Method to display an FBML Type Ahead element
     *
     * @param  array  $params Array of attribute values for the board.
     * @return string
     *
     * @link   http://wiki.developers.facebook.com/index.php/Fb:typeahead-input
     */
    public function facebook_Typeahead($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge($this->defaults, $params);

        // Create the FBML string to return
        $string =
        <<<HTML
          <fb:fbml version="1.1">
           <fb:typeahead-input name="{$params['name']}">
HTML;

        // Make sure we have an Options Array
        if (!empty($params['options'])) {

            // Loop through
            foreach ($params['options'] as $k => $v) {

                // If Friends is true then treat this as a list of Facebook UIDs and
                // Convert the list to fb:names
                if (!empty($params['friends'])) {
                    $value = '<fb:name uid="' . $v . '" linked="false" />';
                    $key   = $v;
                } else {
                    $value = $v;
                    $key   = $k;
                }

                $string .=
                <<<HTML
                  <fb:typeahead-option value="{$key}">{$value}</fb:typeahead-option>
HTML;
            }
        }

        // Create the FBML string to return
        $string .=
        <<<HTML
           </fb:typeahead-input>
          </fb:fbml>
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