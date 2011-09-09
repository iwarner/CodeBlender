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
 * Feature component
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Layout
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Layout_Feature
{
    /**
     * Method to create a Feature element for a web site
     *
     * @param  string $featureText
     * @return string
     */
    public function layout_Feature($featureText)
    {
        $string = '
          <div id="main-feature">
           <div class="feature-contents" style="height:19px;">
            <h2>' . $featureText . '</h2>
           </div>
          </div>';

        return $string;
    }
}
