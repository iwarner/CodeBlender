<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Helper
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Helper
 *
 * @category  CodeBlender
 * @package   Helper
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
class CodeBlender_View_Helper_StrapLine extends Zend_View_Helper_Abstract
{

    /**
     * Strap Line
     *
     * @param  string $text
     * @return object $headLink
     */
    public function strapLine($text, $id = 'freeQuote', $showImage = true)
    {
        // Whether to show the Image
        if ($showImage) {

            $image = '
              <div id="tagImage">
                <a id="' . $id . '" href="/core/contact">Contact Triangle Solutions for a free quote for your next project.</a>
              </div>
            ';
        } else {
            $image = '';
        }

        $string = <<<HTML

            {$image}

            <h1 id="tagLine">{$text}</h1>

            <div class="clear"></div>
            <div class="dividerLine"></div>
HTML;

        return $string;
    }

}
