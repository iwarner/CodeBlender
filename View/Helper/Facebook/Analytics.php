<?php

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @version    SVN: $Id: $
 */

/**
 * Helper class to display the Facebook Google Analytics FBML
 *
 * <code>
 * // Invoke the Google Analytics
 * {$this->facebook_Analytics(array('uacct' => '123465798'))}
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 *
 * @todo Fix up the properties
 */
class CodeBlender_View_Helper_Facebook_Analytics
{

    /**
     * Vars to set the defaults
     */
    private $defaults = array(
        'uacct' => '' // String Your Urchin / Google Analytics account ID.
    );

    /**
     * Method to get a standar
     *
     * @param  array  $params Array of attribute values
     * @return string
     *
     * @link   http://wiki.developers.facebook.com/index.php/Fb:google-analytics
     */
    public function facebook_Analytics($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge($this->defaults, $params);

        // Create the message string
        $string =
                <<<HTML
          <fb:google-analytics uacct="{$params['uacct']}" />
HTML;

        return $string;
    }

}
