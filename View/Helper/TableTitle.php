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
 * Component to produce the page title, this contains the page Title text and
 * all the relevant action icons needed for the page.
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_TableTitle extends Zend_View_Helper_Abstract
{

    /**
     * Vars to set the defaults
     */
    private $defaults = array(
        'extra' => false, // String Extra content
        'icons' => false, // Bool   Icons array
        'title' => false, // String Any extra style classes that need adding
    );

    /**
     * Method to produce the dynamic admin title element.
     *
     * Icons are added using the Image Helper please consult this to see available
     * attributes.
     *
     * <usage>
     * // HTML Title Header
     * $params = array(
     *  'Title' => 'Table Title',
     *  'Icons' => array('add.gif' => array('Title' => 'Add Fixture'))
     *  );
     *
     * $title = $this->TableTitle($params);
     * </usage>
     *
     * @param  array  $params See above
     * @return string         HTML
     */
    public function tableTitle($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge($this->defaults, $params);

        $string =
            <<<HTML
          <table class="tbl" summary="Title">
           <tr>
            <td class="tbl_title">{$params['title']}</td>
HTML;

        // If extra html is given, add it before the icons (like a drop-down)
        if (!empty($params['extra'])) {
            $string .= $params['extra'];
        }

        // Only show icons if if icons paramater is set in the Options array
        if (!empty($params['icons'])) {

            // Loop through the Icons
            foreach ($params['icons'] as $k => $v) {

                $string .=
                    <<<HTML
                  <td width="100px">
                   {$this->view->Image(array('Alt' => $v['title'], 'Icon' => 'redmond', 'JavaScript' => 'id="zebraAdd"', 'Path' => $k, 'URL' => '#'))}
                  </td>
HTML;
            }
        }

        // End the string
        $string .=
            <<<HTML
           </tr>
          </table>
HTML;

        return $string;
    }

}
