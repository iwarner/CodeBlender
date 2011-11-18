<?php

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    CodeBlenderDebug
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://www.codeblender.net/license
 */

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    CodeBlenderDebug
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://www.codeblender.net/license
 */
class CodeBlender_Application_Resource_CodeBlenderDebug extends Zend_Application_Resource_ResourceAbstract
{

    /**
     * @var boolean
     */
    protected $_init = false;

    /**
     * @var boolean
     */
    protected $_enabled = false;

    /**
     * @var array
     */
    protected $_params = array();

    /**
     * Defined by Zend_Application_Resource_Resource
     */
    public function init()
    {
        if (!$this->_init && $this->getEnabled()) {

            // Execute once
            $this->_init = true;

            // Plugin options
            $options = $this->getParams();

            // bootstrap database
            if (!empty($options['Database']['enabled'])) {
                if ($this->getBootstrap()->hasPluginResource('db')) {
                    $this->getBootstrap()->bootstrap('db');
                }
            }

            // Normalize base_path with realpath
            if (isset($options['File']['basePath'])) {
                $options['File']['basePath'] = realpath($options['File']['basePath']);
            }

            // Register namespace
            $autoloader = Zend_Loader_Autoloader::getInstance();
            $autoloader->registerNamespace('CodeBlenderDebug');

            // Ensure frontcontroller is initializated
            $this->getBootstrap()->bootstrap('frontController');

            // Instantiate plugin
            $debug = new CodeBlender_Controller_Plugin_Debug($options);

            // Add plugin to front controller
            $frontController = $this->getBootstrap()->getResource('frontController');
            $frontController->registerPlugin($debug);
        }
    }

    /**
     * Set plugin options
     *
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->_params = $params;
    }

    /**
     * Return plugin options
     *
     * @return array
     */
    public function getParams()
    {
        return $this->_params;
    }

    /**
     * Activate plugin
     *
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->_enabled = (boolean) $enabled;
    }

    /**
     * Return true if plugin should be enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->_enabled;
    }

}
