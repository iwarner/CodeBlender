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
 * <code>
 * // Wibiya Toolbar
 * echo $this->wibiya();
 * </code>
 *
 * @category  CodeBlender
 * @package   Helper
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 * @see       http://www.wibiya.com
 */
class CodeBlender_View_Helper_Wibiya extends Zend_View_Helper_Abstract
{
    /**
     * wibiya
     */
    public function wibiya()
    {
        // Config
        $config = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('wibiya');

        $string =
        <<<HTML
          <script src="http://toolbar.wibiya.com/toolbarLoader.php?toolbarId={$config['toolbarID']}" type="text/javascript"></script>
HTML;

        return $string;
    }
}
