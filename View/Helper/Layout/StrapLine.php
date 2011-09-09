<?php
/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Helper
 * @copyright Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Helper class to render the top H1 strapline for each page.
 *
 * @category  CodeBlender
 * @package   Helper
 * @copyright Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
class CodeBlender_View_Helper_Layout_StrapLine
{
    /**
     * Method to append any needed stylesheets into the main Template
     *
     * @param  string $text
     * @return object $headLink
     */
    public function layout_StrapLine($text, $id = 'freeQuote', $showImage = true)
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
