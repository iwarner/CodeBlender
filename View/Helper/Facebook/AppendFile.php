<?php

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

/**
 * Helper class to include a Facebook External Javascript File
 * Issue with External Scripts on Jasvascript is that they cannot be
 * used on Tab or Profile surfaces.
 *
 * // Invoke the Facebook Append File
 * $this->facebook_AppendFile(array(
 *    'psth' => 'path'
 *  ))
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 *
 * @todo Make this work with CSS or Javascript
 */
class CodeBlender_View_Helper_Facebook_AppendFile extends Zend_View_Helper_Abstract
{

    /**
     * The Cache breaking increment to append to the file
     *
     * @var string
     */
    protected $increment = '1.00';
    /**
     * Full path to the file that is to be appended.
     *
     * @var string
     */
    protected $path = false;
    /**
     * Full path to the file that is to be appended.
     *
     * @var string
     */
    protected $pathLocal = false;

    /**
     * Method to determine whether to append the file as
     * an external Javascript or read the file and output
     * HTML.
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_AppendFile(array $params)
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Get the request paramaters
        $request = Zend_Controller_Front::getInstance()->getRequest()->getParams();

        // Check to see if this user is on a Profile Tab
        if (empty($request['fb_sig_in_profile_tab'])) {

            // Append the file as normal
            $this->view->headScript()->appendFile($params['path'] . '?v=' . $params['increment']);
            return false;

            // Read the file and return the Contents
        } else {

            // Read the contents of the file
            $jsCode = file_get_contents($params['pathLocal']);

            if (is_bool($jsCode) && $jsCode == false) {

                // treat error
                $handle = fopen($params['pathLocal'], 'r');
                $jsCode = '';
                while (!feof($handle)) {
                    $jsCode .= fread($handle, 1024);
                }
                fclose($handle);
            } else {

                // handle good case
                $string = '<script type="text/javascript">' . $jsCode . '</script>';
            }

            return $string;
        }
    }

}
