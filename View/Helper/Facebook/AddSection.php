<?php

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Helper
 *
 * The button appears only if the application has already called
 * profile.setInfo or profile.setFBML and set info for that user.
 *
 * Also produces some extra markup to only show if the user has
 * authenticated the application
 *
 * <code>
 * // Invoke the Frame Button Helper
 * $this->facebook_AddSection(array(
 *    'section' => 'profile'
 *   ));
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:add-section-button
 */
class CodeBlender_View_Helper_Facebook_AddSection
{

    /**
     * Specifies the return path for the Authorisation of the application
     *
     * @var string
     */
    protected $path = false;
    /**
     * Specifies whether to add a condensed profile box to the main
     * profile (profile) or an application info section to the Info tab (info).
     *
     * @var string
     */
    protected $section = 'profile';

    /**
     * Method to display a Facebook Add Section Button
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_AddSection($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Check to see if path is false is so use Facebook Path in config
        if (empty($params['path'])) {

            // Invoke the config from the registry
            $config = Zend_Registry::get('config');

            // Create the path
            $params['path'] = $config->facebook->path;
        }

        // Initiate the Facebook Add Section Button
        $string = <<<HTML

          <fb:if-is-app-user>

           <fb:else>
            Please <a href="{$params['path']}" requirelogin="1" title="Authrise Application">Authorise</a> to add to your profile.
           </fb:else>

           <div align="center">
             <fb:add-section-button section="{$params['section']}" />
           </div>

           <br />

          </fb:if-is-app-user>
HTML;

        // Return the string
        return $string;
    }

}
