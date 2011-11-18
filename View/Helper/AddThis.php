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
 * Config Options
 * addThis.username = ""
 *
 * <code>
 * // Add This
 * echo $this->addThis();
 * </code>
 *
 * @category  CodeBlender
 * @package   Helper
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 * @see       http://www.addthis.com/developers
 */
class CodeBlender_View_Helper_AddThis extends Zend_View_Helper_Abstract
{

    /**
     * addThis
     */
    public function addThis()
    {
        // Config
        $config = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('addThis');

        $string =
            <<<HTML
            <script type="text/javascript">
            var addthis_config = {
                 username       : "{$config['username']}",
                 data_use_flash : false
            }
            </script>

            <a href="http://www.addthis.com/bookmark.php?v=250" class="addthis_button"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Share" /></a>

            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
HTML;

        return $string;
    }

}
