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
 * Create and handle the Facebook Application Session
 * The session is namespaced after the SiteName
 *
 * Contains in part the Facebook elements
 *
 *   ["facebookSession"] => array(6) {
 *     ["access_token"] => string(96) "100509803347833|2.n6jaTqvoJeZPAY6r8QI5Iw__.3600.1287144000-668010822|1aQt8-iRXWRVSNAWtHbwWBlkn1U"
 *     ["expires"] => string(10) "1287144000"
 *     ["secret"] => string(24) "4ewVCexUQvbYWaxNLvJ01A__"
 *     ["session_key"] => string(52) "2.n6jaTqvoJeZPAY6r8QI5Iw__.3600.1287144000-668010822"
 *     ["sig"] => string(32) "2e751a7a61bdcdc6432d1e992d509fcf"
 *     ["uid"] => string(9) "668010822"
 *   }
 *
 *   ["facebookMe"] => array(11) {
 *     ["id"] => string(9) "668010822"
 *     ["name"] => string(10) "Ian Warner"
 *     ["first_name"] => string(3) "Ian"
 *     ["last_name"] => string(6) "Warner"
 *     ["link"] => string(31) "http://www.facebook.com/iwarner"
 *     ["about"] => string(32) "L I V E R P OO L -- Liverpool FC"
 *     ["gender"] => string(4) "male"
 *     ["timezone"] => int(9)
 *     ["locale"] => string(5) "en_GB"
 *     ["verified"] => bool(true)
 *     ["updated_time"] => string(24) "2010-07-29T11:05:45+0000"
 *
 * @category  CodeBlender
 * @package   Plugin
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 *
 * @todo Test this works with the latest Facebook PHP SDK
 */
class CodeBlender_Controller_Plugin_Facebook extends Zend_Controller_Plugin_Abstract
{

    /**
     * Method to create and manage the session data
     *
     * @param  array  $request
     * @return object
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        // Invoke the config
        $config = Zend_Registry::get('config');

        // Instantiate Social Class
        $social = new CodeBlender_Service_Social();

        // Process the required options.
        $social->createSocialClass()
            ->requireLogin(array(
                'fbconnect' => 0,
                'canvas' => 1,
                'next' => $config->facebook->path,
                'cancel_url' => $config->facebook->path,
                'req_perms' => $config->facebook->perms
            ));

        // Set up the session environment
        $session = new Zend_Session_Namespace(Zend_Registry::get('siteName'));
        $session->setExpirationSeconds(86400);

        // Check to see if the Session has the correct properties if not create it.
        if (empty($session->initialised)) {

            // Check to see if a social session exists
            if ($social->session) {

                // Create the Facebook elements
                $session->userID = $social->session['uid'];
                $session->accessToken = $social->session['access_token'];

                // If there is no Facebook ME set it
                if (empty($session->me)) {
                    $session->me = $social->facebook->api('/me');
                } else {
                    $session->me = $social->me;
                }
            }

            $session->facebookPath = $config->facebook->path;
            $session->facebookCallBack = $config->facebook->appCallBack;
            $session->initialised = true;

            // If there is a session we need to check that it has the right information in it.
            // For instance the session may expire but the user is still logged into Facebook
            // So when the session is re-done the Facebook information will not be present.
        } else {

            // If there is no Facebook ID set it
            if (empty($session->userID)) {
                $session->userID = $social->session['uid'];
                $session->accessToken = $social->session['access_token'];
            }

            // If there is no Facebook ME set it
            if (empty($session->me)) {
                $session->me = $social->facebook->api('/me');
            }
        }

        // Debug
        Zend_Debug::dump($session, 'Session', false);
        Zend_Debug::dump($social, 'Social', false);
        Zend_Debug::dump($session->me, 'Facebook Me', false);
    }

}
