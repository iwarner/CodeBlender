<?php
/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   CodeBlender_ExtJS
 * @copyright Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Enable ExtJS
 *
 * Make sure the below is included in the site config
 *
 * Usage
 * ;; ExtJS Enabled ;;
 * extjs.enabled = true
 *
 * @category  CodeBlender
 * @package   CodeBlender_ExtJS
 * @copyright Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
class CodeBlender_ExtJS
{
    /**
     *  @const string Available ExtJS Version
     */
    const EXTJS_VERSION = 'ext-3.3.1';

    /**
     * ExtJS-enable a view instance
     *
     * @param  Zend_View_Interface $view
     * @return void
     */
    public static function enableView(Zend_View_Interface $view)
    {
        if (false === $view->getPluginLoader('helper')->getPaths('CodeBlender_ExtJS_View_Helper')) {
            $view->addHelperPath('CodeBlender/ExtJS/View/Helper', 'CodeBlender_ExtJS_View_Helper');
        }
    }
}
