<?php

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Helper
 *
 * // Facebook Footer
 * echo $this->facebook_Footer(array('Links' => ''));
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/licenss
 */
class CodeBlender_View_Helper_FacebookFooter extends Zend_View_Helper_Abstract
{

    /**
     * The array of links to show in the footer.
     *
     * @var array
     */
    protected $links = false;

    /**
     * Method to display a Facebook Footer
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebookFooter($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Loop through the links
        $links = '';

        // Loop through the Footer Links
        foreach ($params['links']['footer'] as $k => $v) {

            // Check whether the link is to be a Facebook Dialog
            // If it is the href will likely be produced within that
            $pos = strstr($k, '_dialog');

            if (!empty($pos)) {

                $links .= $v . ' | ';

                // Else produce a normal link
            } else {
                $links .= '<a href="' . $v . '" title="' . $k . '" target="_new">' . $k . '</a> | ';
            }
        }

        // Trim the unwanted pipe from the end
        $links = rtrim($links, ' | ');

        // Initiate the Facebook Footer
        $string =
            <<<HTML
          <div id="footerBar">

           <div class="floatRight">
            {$this->view->facebook_Share(array(
                'description' => $params['links']['share']['description'],
                'href' => $params['links']['share']['href'],
                'link' => $params['links']['share']['link'],
                'title' => $params['links']['share']['title']
            ))}
           </div>

           <div class="floatLeft">
            {$links}
           </div>

          </div>
HTML;

        // Return the string
        return $string;
    }

}
