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
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Feature extends Zend_View_Helper_Abstract
{

    /**
     * Feature
     */
    public function feature($featureText)
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
