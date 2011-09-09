<?php
/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Layout
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Helper class to create the content box
 *
 * <code>
 * $boxLeft = $this->layout_ContentBox(array(
 *   'body'     => $html,
 *   'class'    => 'nopadding',
 *   'position' => 'Left'
 *  ));
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Layout
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Layout_ContentBox
{
    // {{{ properties

    /**
     * Vars to set the defaults
     */
    private $defaults = array(
      'body'            => false,    // String The body HTML for the content box
      'class'           => false,    // String Any extra style classes that need appending
      'contentClass'    => false,    // String Any extra style classes that need appending
      'div'             => false,    // String Name the div of the box
      'height'          => false,    // Int    The Height of the box default is 385px
      'position'        => 'Center', // String Position of the box either Left Right or Center
      'showHide'        => false,    // Bool   Whether to show the Hide / Show links
      'styleBoxContent' => false,    // String Whether to overide the default style
      'title'           => false,    // String The Body box Title
      'visibility'      => 'visible' // String The visibility of the box either visible hidden or collapse
     );

    /**
     * Method to create a content box.
     *
     * @param  array  $params Array of attribute values for the Content Box
     * @return string
     */
    public function layout_ContentBox($params)
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge($this->defaults, $params);

        // Create the unique DIV ID for the box
        if (!empty($params['div'])) {
            $divID = 'id="' . rand(0, 1000000) . '"';
        } else {
            $divID = '';
        }

        // Create the visibility of the box
        if (!empty($params['visibilty'])) {
            $visibility = 'style="visibility: ' . $params['visibility'] . '"';
        } else {
            $visibility = '';
        }

        // Allow an arbitrary Height to be set default is 385px
        if (!empty($params['height'])) {
            $params['height'] = 'style="height: ' . $params['height'] . 'px;"';
        }

        // Sort out whether this box has a title
        if (!empty($params['title'])) {
            $params['title'] = '<div class="boxTitle">' . $params['title'] . '</div>';
        }

        // Sort out the style for the BoxContent
        if (!empty($params['styleBoxContent'])) {
            $params['styleBoxContent'] = 'style="' . $params['styleBoxContent'] . '"';
        }

        // Create the string
        $string =
        <<<HTML
          <div class="box{$params['position']} {$params['class']}" {$params['height']}>

           {$params['title']}

           <div class="boxContent {$params['contentClass']}" {$params['styleBoxContent']}>
HTML;

        // Add in the ability to hide the box
        if ($params['showHide']) {
            $string .=
            <<<HTML
              <div style="float: right; padding-left: 10px;">
               [<a href="#" onclick="hideSlide('{$div}')" title="Hide">Hide</a>]
               [<a href="#" onclick="showSlide('{$div}')" title="Show">Show</a>]
              </div>
HTML;
        }

        // Complete the string
        $string .=
        <<<HTML

            <div {$divID} {$visibility}>
             {$params['body']}
            </div>

           </div>

          </div>
HTML;

        return $string;
    }
}
