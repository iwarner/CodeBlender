<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   BootStrap
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Resource
 *
 * @category  CodeBlender
 * @package   BootStrap
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
class CodeBlender_Application_Resource_Codeblenderview extends Zend_Application_Resource_ResourceAbstract
{

    /**
     * View
     */
    public function init()
    {
        $bootstrap = $this->getBootstrap();
        $frontController = $bootstrap->getResource('frontController');
        $frontController->registerPlugin(new Zend_Controller_Plugin_ErrorHandler(array('module' => 'core')));

        // Set up the view params
        $view = $bootstrap->getResource('view');
        $path = $bootstrap->getOption('path');

        // Set the consistent View paramaters needed
        $view->assetPath = $path['assets'];
        $view->imagePath = $path['assets'] . '/images';
        $view->cssPath = $path['assets'] . '/css';
        $view->themePath = $path['assets'] . '/theme';
        $view->jsPath = $path['assets'] . '/js';
    }

}
