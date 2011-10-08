<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   ActionHelper
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Facebook Request
 *
 * @category  CodeBlender
 * @package   ActionHelper
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 * @see       http://developers.facebook.com/docs/authentication/signed_request/
 *
 * @todo Use Zend Log
 */
class CodeBlender_Controller_Action_Helper_FacebookRequest extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Facebook Request
     */
    public function request($params = array())
    {
        // Config
        $config = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('facebook');

        // Merge the two arrays to overwrite default values.
        $this->params = array_merge(get_class_vars(__CLASS__), $params);

        // Signed request exists
        if (isset($_REQUEST['signed_request'])) {

            // Parse request
            $data = $this->_parseSignedRequest($_REQUEST['signed_request'], $config['secret']);
            return $data;

        } else {
            error_log('No Signed Request found');
        }


        return null;
    }

    /**
     * Parse Signed Request
     */
    private function _parseSignedRequest($signed_request, $secret)
    {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        // decode the data
        $sig = $this->_base64URLDecode($encoded_sig);
        $data = json_decode($this->_base64URLDecode($payload), true);

        if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
            error_log('Unknown algorithm. Expected HMAC-SHA256');
            return null;
        }

        // check sig
        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);

        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }

        return $data;
    }

    /**
     * Base 64 URL Decode
     */
    private function _base64URLDecode($input)
    {
        return base64_decode(strtr($input, '-_', '+/'));
    }

}
