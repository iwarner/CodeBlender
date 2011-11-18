<?php

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Debug component for Views to print out basic information. This is driven from
 * a config debug paramater
 *
 * <code>
 * // Invoke the Debug element.
 * {$this->debug()}
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Debug extends Zend_View_Helper_Abstract
{

    /**
     * Method to print a debug area for a view.
     *
     * @return string
     */
    public function debug()
    {
        // Get the request paramaters
        $request = Zend_Controller_Front::getInstance()->getRequest()->getParams();

        // Create the string variable
        $string = <<<HTML
          <div id="debugArea">
            <b>Debug Area</b>
            <hr />
HTML;

        // Run the isfacebook method
        $string .= self::_isFacebook();

        // Run the isTodo method
        $string .= '<b>Todo</b>';
        $string .= self::_isTodo();

        // Output the Request Paramaters
        $string .= '<b>Paramaters</b><br />';
        $string .= Zend_Debug::dump($request, '<b>All Params</b>', false);
        $string .= Zend_Debug::dump($_REQUEST, '<b>Request Paramaters</b>', false);

        // Get the Auth Instance
        $auth = Zend_Auth::getInstance();

        // Check if this user is logged in
        if ($auth->hasIdentity()) {
            $string .= Zend_Debug::dump($auth->getIdentity(), '<b>Zend Auth</b>', false);
        }

        // If Files is not empty then output these
        if (!empty($_FILES)) {
            $string .= Zend_Debug::dump($_FILES, '<b>Files</b>', false);
        }

        // End the DIV
        $string .= '</div>';

        return $string;
    }

    /**
     * Method to determine if this is on Facebook and to show
     * additional information in the Debug area
     *
     * @return string
     */
    private function _isFacebook()
    {
        $string = '';

        // Check to see if this is on a Facebook Social Application
        // If it is give some additional information
        if (!empty($request['fb_sig'])) {

            if (!empty($request['fb_sig_canvas_user'])) {
                $user = $request['fb_sig_canvas_user'];
            } elseif (!empty($request['fb_sig_user'])) {
                $user = $request['fb_sig_user'];
            } else {
                $user = '';
            }

            $string = <<<HTML
              <b>This is a Facebook Application</b><br />
              The user <fb:name uid="{$user}" useyou="false" /> has not allowed access.
              <hr />
HTML;
        }

        return $string;
    }

    /**
     * Method to show any Todo elements on this page
     *
     * Requires a $this->todo() variable within the view
     *
     * <code>
     * $this->todo = '
     *   <pre>
     *   01. Todo element
     *   </pre>';
     * </code>
     *
     * @return string
     */
    private function _isTodo()
    {
        $string = '';

        // Check to see if Todo points are present
        if (!empty($this->view->todo)) {
            $string = '<pre>' . $this->view->todo . '</pre><hr />';
        }

        return $string;
    }

}
