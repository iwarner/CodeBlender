<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
<<<<<<< HEAD
 * @package   CodeBlender_ExtJS
<<<<<<< HEAD
 * @copyright Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
=======
 * @package   ExtJS
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
>>>>>>> d539a4e... refactored helpers in CodeBlender
=======
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
>>>>>>> 173b71bdcc66c2b9dba9c5362e8bc62d78bc7ff0
 * @license   http://codeblender.net/license
 */

/**
 * ExtJS
 *
 * Make sure the below is included in the site config
 *
 * Usage
 * ;; ExtJS Enabled ;;
 * extjs.enabled = true
 *
 * @category  CodeBlender
<<<<<<< HEAD
 * @package   CodeBlender_ExtJS
<<<<<<< HEAD
 * @copyright Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
=======
 * @package   ExtJS
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
>>>>>>> d539a4e... refactored helpers in CodeBlender
=======
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
>>>>>>> 173b71bdcc66c2b9dba9c5362e8bc62d78bc7ff0
 * @license   http://codeblender.net/license
 */
class CodeBlender_ExtJS
{
    /**
     *  @const string Available ExtJS Version
     */
    const EXTJS_VERSION = 'extjs';

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
