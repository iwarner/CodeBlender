<?php
/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   CodeBlender_ExtJS
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Enable ExtJS
 *
 * Usage
 * // Enable ExtJS
 * $this->ExtJS()->enable();
 *
 * @category  CodeBlender
 * @package   CodeBlender_ExtJS
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
class CodeBlender_ExtJS_View_Helper_ExtJS
{
    /**
     * @var Zend_View_Interface
     */
    public $view;

    /**
     * @var CodeBlender_ExtJs_View_Helper_ExtJS_Container
     */
    protected $_container;

    /**
     * Initialize helper
     *
     * Retrieve container from registry or create new container and store in
     * registry.
     *
     * @return void
     */
    public function __construct()
    {
        $registry = Zend_Registry::getInstance();

        if (!isset($registry[__CLASS__])) {
            $container = new CodeBlender_ExtJS_View_Helper_ExtJS_Container();
            $registry[__CLASS__] = $container;
        }

        $this->_container = $registry[__CLASS__];
    }

    /**
     * Set view object
     *
     * @param  CodeBlender_ExtJS_View_Interface $view
     * @return void
     */
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
        $this->_container->setView($view);
    }

    /**
     * Return extjs container
     *
     * @return CodeBlender_ExtJS_View_Helper_ExtJS_Container
     */
    public function extjs()
    {
        return $this->_container;
    }

    /**
     * Proxy to container methods
     *
     * @param  string $method
     * @param  array $args
     * @return mixed
     * @throws CodeBlender_ExtJS_View_Exception For invalid method calls
     */
    public function __call($method, $args)
    {
        if (!method_exists($this->_container, $method)) {
            throw new Zend_Exception(sprintf('Invalid method "%s" called on extjs view helper', $method));
        }

        return call_user_func_array(array($this->_container, $method), $args);
    }
}
