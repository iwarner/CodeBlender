<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Plugin
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * AUTH Plugin
 *
 * @category  CodeBlender
 * @package   Plugin
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 *
 * @todo This includes Facebook Auth - remove if not required.
 */
class CodeBlender_Controller_Plugin_Auth extends Zend_Controller_Plugin_Abstract
{

    /**
     * Method to check the Access Control List for permissions to view a certain
     * module - controller - action
     *
     * @param  array  $request
     * @return object
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        // Use 'someNamespace' instead of 'Zend_Auth' created from SiteName
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session(CODEBLENDER_SITENAME));

        // Instantiate the DbTable auth Adapter and set credentials Make sure status is Active also
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $authAdapter->setTableName('user')
            ->setIdentityColumn('user_id')
            ->setCredentialColumn('user_id')
            ->setCredentialTreatment('? AND status = "Active"');

        // Get the Session and the Facebook userID
        $session = new Zend_Session_Namespace(CODEBLENDER_SITENAME);

        // Get the config
        $config = Zend_Registry::get('config');

        if (APPLICATION_ENV == 'production') {

            $userID = 'fb_' . $config->facebook->appID . '_user_id';
            $accessToken = 'fb_' . $config->facebook->appID . '_access_token';
            $userID = $session->$userID;

            // Save with better naming
            $session->accessToken = $session->$accessToken;
            $session->userID = $userID;
        } else {
            $userID = 668010822;
            $session->userID = $userID;
        }

        // Set the details through the AuthAdaptor
        $authAdapter->setIdentity($userID)
            ->setCredential($userID);

        // Perform the authentication query, saving the result
        $result = $auth->authenticate($authAdapter);

        // If a result is found then the
        if ($result->isValid()) {

            // Store the identity as an object where only the username and real_name have been returned
            $auth->getStorage()->write($authAdapter->getResultRowObject(array('user_id', 'type', 'name')));

            // Cant find a user that matches these user and pass combination
            // Clear the identiy and return false
        } else {
            $auth->clearIdentity();
            return false;
        }
    }

}
