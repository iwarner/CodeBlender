<?php
/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Helpers
 * @copyright Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Helper class to render the Wibiya toolbar
 *
 * <code>
 * // Include the Wibiya Toolbar
 * $this->feedBack_Wibiya();
 * </code>
 *
 * @category  CodeBlender
 * @package   Helpers
 * @copyright Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 * @see       http://www.wibiya.com
 */
class CodeBlender_View_Helper_Wibiya
{
    /**
     * Method to render the Wibiya toolbar
     *
     * @return string
     */
    public function wibiya()
    {
        // Invoke the Config
        $config = Zend_Registry::get('config');

        // Create the analytics tracking code
        $string =
        <<<HTML
          <script src="http://toolbar.wibiya.com/toolbarLoader.php?toolbarId={$config->wibiya->toolbarID}" type="text/javascript"></script>
HTML;

        return $string;
    }
}
