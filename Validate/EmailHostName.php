<?php
/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Validate
 * @copyright Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Validates all fields are equal
 *
 * @category  CodeBlender
 * @package   Validate
 * @copyright Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
class CodeBlender_Validate_EmailHostName extends Zend_Validate_Abstract
{
    /**
     * Validation key
     */
    const NOT_REGISTERED = 'notRegistered';

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $_messageTemplates = array(self::NOT_REGISTERED => 'Hostname not registered');

    /**
     * Construct
     *
     */
    public function __construct()
    {
    }

    /**
     * Validate to a context
     *
     * @param  string $value
     * @param  array|string $context
     * @return boolean
     */
    public function isValid($value)
    {
        Zend_Debug::dump($value);
//        Zend_Debug::dump($this->_field);

        // Set value
//        $this->_setValue($value);
//
//        if ($context === null && $this->_context === null) {
//            throw new Zend_Exception(sprintf('Validator "%s" contexts is not setup', get_class($this)));
//        }
//
//        // Use instance context if not provided
//        $context = ($context === null) ? $this->_context : $context;
//
//        // Validate string
//        if (is_string($context) && $value == $context) {
//             return true;
//        }
//
//        // Validate from array
//        if (is_array($context) && isset($context[$this->_field]) && $value == $context[$this->_field]) {
//            return true;
//        }

        $this->_error(self::NOT_REGISTERED);
        return false;
    }
}
