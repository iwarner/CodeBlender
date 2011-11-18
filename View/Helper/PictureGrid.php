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
 * <code>
 * // Picture Grid
 * echo $this->PictureGrid(array(
 *   'columns' => 3,
 *   'images'  => array(0 => array('alt' => 'Test This', 'id' => '1', 'path' => '/Site/icon.png'))
 *  ));
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_PictureGrid extends Zend_View_Helper_Abstract
{

    /**
     * Vars to set the defaults
     */
    private $defaults = array(
        'columns' => 5, // Int   The number of required columns
        'dialog' => false, // Bool  Whether the links will contain Facebook Dialog popup boxes.
        'images' => array() // Array Uses the Image Helper: (url or uid, link url (or enter 'PROFILE' to auto link to profile when using uid), width, height, alt, title)
    );

    /**
     * pictureGrid
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function pictureGrid($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge($this->defaults, $params);

        // Setup the String
        $string = '';

        // Make sure we have a list of images
        if (!empty($params['images'])) {

            // Create the opening PictureGrid Div
            $string =
                <<<HTML
              <div class="pictureGrid">
HTML;

            // Create the colcount
            $colCount = 0;

            // Loop through the images array
            foreach ($params['images'] as $image) {

                // If the cols count is reached then clear the DIV
                if ($colCount % $params['columns'] == 0 && $colCount != 0) {
                    $string .= '<br class="clearboth" />';
                }

                $title = substr($image['alt'], 0, 10);

                // Open the Image Div Box
                $string .=
                    <<<HTML
                  <div id="{$image['id']}" class="outerBorder">

                   <div class="innerBorder">
                    {$this->view->Image($image)}
                   </div>

                   <div class="title">
                    {$title}...
                   </div>

                  </div>
HTML;

                // If the link is going to generate a Facebook Dialog Box then create this.
                if ($params['dialog']) {
                    $string .= $this->view->FacebookDialog(array(
                        'content' => $image['dialogContent'],
                        'dialogID' => 'dialog_' . $image['id'],
                        'title' => $image['alt'],
                        ));
                }

                $colCount++;
            }

            // Close the PictureGrid Div
            $string .=
                <<<HTML
              </div>
HTML;

            // If there is no Image array then report this
        } else {
            $string .=
                <<<HTML
              No Images To Display
HTML;
        }

        // Return the string
        return $string;
    }

}
