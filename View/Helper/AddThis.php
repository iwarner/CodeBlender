<?php
/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage FeedBack
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Helper class to display the Add This Display Code
 *
 * All the config elements are run from the main config file
 *
 * <code>
 * // Include the Add This Button Element
 * $this->addThis();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage FeedBack
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://addthis.com
 */
class CodeBlender_View_Helper_AddThis
{
    /**
     * Method to render the Add This Button
     *
     * @return string
     */
    public function addThis()
    {
        // Create the analytics tracking code
        $string =
        <<<HTML
            <script type="text/javascript">
            var addthis_config = {
                 username: "iwarner",
                 data_use_flash: false
            }
            </script>

            <a href="http://www.addthis.com/bookmark.php?v=250"
                class="addthis_button"><img
                src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif"
                width="125" height="16" border="0" alt="Share" /></a>

            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
HTML;

        return $string;
    }
}
