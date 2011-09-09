<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   BootStrap
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Resource
 *
 * @category  CodeBlender
 * @package   BootStrap
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
class CodeBlender_Application_Resource_Restrouter extends Zend_Application_Resource_ResourceAbstract
{

    /**
     * @var Zend_Controller_Router_Rewrite
     */
    protected $_restRouter;


    /**
     * Defined by Zend_Application_Resource_Resource
     *
     * @return Zend_Controller_Router_Rewrite
     */
    public function init()
    {
        return $this->getRestRouter();
    }

    /**
     * Retrieve router object
     *
     * @return Zend_Controller_Router_Rewrite
     */
    public function getRestRouter()
    {
        if (null === $this->_restRouter) {

            $options = $this->getOptions();
            $bootstrap = $this->getBootstrap();

            $frontController = Zend_Controller_Front::getInstance();

            // Module check
            if (!empty($options['module'])) {
                $restRoute = new Zend_Rest_Route($frontController, array(), array($options['module']));
            } else {
                $restRoute = new Zend_Rest_Route($frontController, array(), array(
                            'default' => explode(',', $options['routes'])
                        ));
            }

            $this->_restRouter = $frontController->getRouter();
            $this->_restRouter->addRoute('rest', $restRoute);
        }
    }

}
