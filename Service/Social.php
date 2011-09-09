<?php

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Service
 * @copyright  Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Class
 *
 * @category   CodeBlender
 * @package    Service
 * @copyright  Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_Service_Social
{

    /**
     * Logged in users basic information
     */
    public $me = false;
    /**
     * Social Network
     */
    public $facebook = false;
    /**
     * Config
     */
    private $config = false;
    /**
     * Login Parameters
     */
    public $loginParameters = array(
        'canvas' => 1,
        'fbconnect' => 0,
        'redirect_uri' => false,
        'scope' => false
    );

    /**
     * Method to instantiate the required social class
     * at this points this supports Bebo or Facebook PHP classes
     */
    public function createSocialClass($appID = false, $secret = false)
    {
        // Config
        $config = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('facebook');

        if ($appID) {
            $config['appID'] = $appID;
        }

        if ($secret) {
            $config['secret'] = $secret;
        }

        // Instantiate the required network class
        $this->facebook = new CodeBlender_Service_Social_Facebook_Facebook(array(
            'appId' => $config['appID'],
            'secret' => $config['secret'],
          ));

        return $this;
    }

    /**
     * Method to proxy the Social Network require_login method
     * Simply redirects the user to the general Allow Access page
     *
     * @param  array $permissions
     * @return CodeBlender_Service_Social Provides a fluent interface
     */
    public function requireLogin($params = array())
    {
        // Get User ID
        $userID = $this->facebook->getUser();

        if ($userID) {

            try {
                $userProfile = $this->facebook->api('/me');
            } catch (Exception $e) {
                $userID = null;
            }
        }

        // Login or logout url will be needed depending on current user state.
        if ($userID) {

        } else {

            // Merge the array of paramaters with the defaults
            $params   = array_merge($this->loginParameters, $params);
            $loginURL = $this->facebook->getLoginUrl($params);

            // Redirect with Javascript
            echo '<script type="text/javascript">top.location.href="' . $loginURL . '";</script>';
            exit();
        }
    }

    /**
     * Call method to alias Facebook calls
     *
     * @param  string $action
     * @param  string $arguments
     * @return CodeBlender_Service_Social Provides a fluent interface
     */
    public function __call($action, $arguments)
    {
        // Check to see if the method exists in the API Client first
        if (method_exists($this->facebook, $action)) {
            $object = $this->facebook;
        } else {
            $object = $this->facebook->api_client;
        }

        return call_user_func_array(array($object, $action), $arguments);
    }

}
