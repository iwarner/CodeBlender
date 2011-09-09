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
 * ACL Plugin
 *
 * 1. Create the ACL list, including types, roles and resources.
 * 2. Assume if no session that everyone is a guest.
 * 3. Only certain users can access entire modules, Deny as default.
 * 4. Also allow certain users to gain access to controllers within modules.
 *
 * @category  CodeBlender
 * @package   Plugin
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 *
 * @todo Navigation should be optional
 */
class CodeBlender_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{

    /**
     * Method
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session(CODEBLENDER_SITENAME));
        $acl = new Default_Model_Library_Acl($auth);

        // Check whether the user is logged in or not; and assign roles accordingly.
        if ($auth->hasIdentity()) {
            $role = $auth->getIdentity()->type;
        } else {
            $role = 'guest';
        }

        // Check if they can view the Module - Controller - Action combination.
        if ($acl->has($request->getParam('module') . $request->getParam('controller') . $request->getParam('action'))) {
            $access = $acl->isAllowed($role, $request->getParam('module') . $request->getParam('controller') . $request->getParam('action'), 'view');

            // Check if they can view the Module - Controller combination.
        } elseif ($acl->has($request->getParam('module') . $request->getParam('controller'))) {
            $access = $acl->isAllowed($role, $request->getParam('module') . $request->getParam('controller'), 'view');

            // // Check if they can view the Module
        } elseif ($acl->has($request->getParam('module'))) {
            $access = $acl->isAllowed($role, $request->getParam('module'), 'view');

        }

        // If the user has no access then redirect them to the specified login page
        if (empty($access)) {

            // Get the config
            $config = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('users');

            // See if the user has specified a different place to redirect users too.
            if (isset($config['noAccess'])) {
                $request->setModuleName($config['noAccess']['module'])->setControllerName($config['noAccess']['controller'])->setActionName($config['noAccess']['action']);
            } else {
                $request->setModuleName('users')->setControllerName('login')->setActionName('index');
            }
        }

        // Set the ACL to the registry
        Zend_Registry::set('acl', $acl);

        // Get the View Resource
        $view = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');

        // Add in the ACL and Role for the Navigation
        $view->navigation()->setAcl($acl)->setRole($role);
        Zend_View_Helper_Navigation_HelperAbstract::setDefaultAcl($acl);
        Zend_View_Helper_Navigation_HelperAbstract::setDefaultRole($role);
    }

}
