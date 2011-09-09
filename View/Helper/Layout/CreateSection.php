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
 * Helper class to create the section for the content boxes
 *
 * <code>
 * $string .= $this->layout_CreateSection(array('boxLeft' => $boxLeft, 'boxRight' => $boxRight));
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Layout
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Layout_CreateSection
{
    /**
     * Vars to set the defaults
     */
    private $defaults = array(
      'backGround' => false, // String
      'box'        => false, // String
      'boxLeft'    => false, // String
      'boxRight'   => false, // String
      'style'      => false, // String
      'styleLeft'  => false, // String
      'styleRight' => false  // String
     );

    /**
     * Method to create a section layout always clears after.
     *
     * @return string
     */
    public function layout_CreateSection($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge($this->defaults, $params);

        // Set certain paramaters to null.
        $string = '';

        // Sort out whether this box has body content
        if (!empty($params['backGround'])) {
            $params['backGround'] = 'style="background: url(' . $params['backGround'] . ') no-repeat top right"';
        }

        // Sort out whether this box has body content
        if (!empty($params['styleLeft'])) {
            $params['styleLeft'] = 'style="' . $params['styleLeft'] . '"';
        }

        // Sort out whether this box has body content
        if (!empty($params['styleRight'])) {
            $params['styleRight'] = 'style="' . $params['styleRight'] . '"';
        }

        // If this is a boxLeft then produce the correct code for this.
        if ($params['boxLeft']) {
            $string .= '<div class="boxFloatLeft" ' .  $params['backGround'] . ' ' . $params['styleLeft'] . '>';
            $string .= $params['boxLeft'];
            $string .= '</div>';
        }

        // If this is a boxRight then produce the correct code for this.
        if ($params['boxRight']) {
            $string .= '<div class="boxFloatRight" ' .  $params['backGround'] . ' ' . $params['styleRight'] . '>';
            $string .= $params['boxRight'];
            $string .= '</div>';
        }

        // If this is a centre box then create the code for this.
        if ($params['box']) {
            $string .= '<div class="boxFloatCenter" ' .  $params['backGround'] . ' ' . $params['style'] . '>';
            $string .= $params['box'];
            $string .= '</div>';
        }

        $string .= '<div class="clear"></div>';

        return $string;
    }
}
