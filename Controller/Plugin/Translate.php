<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Plugin
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Create and handle the Translation
 *
 * @category  CodeBlender
 * @package   Plugin
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
class CodeBlender_Controller_Plugin_Translate extends Zend_Controller_Plugin_Abstract
{

    /**
     * Method to set the locale on each request
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        // Bootstrap
        $bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $translate = $bootstrap->getResource('translate');

        // Locale
        $locale = new Zend_Locale();

        // Default
        $defaultLanguage = 'en';

        if (!$translate->isAvailable($locale->getLanguage())) {
            $translate->setLocale($defaultLanguage);
        }
    }

}
