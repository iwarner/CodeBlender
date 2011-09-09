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
class CodeBlender_Validate_Confirm extends Zend_Validate_Abstract
{
    /**
     * Validation key for not equal
     */
    const NOT_MATCH = 'notMatch';

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $_messageTemplates = array(self::NOT_MATCH => 'Values are not the same');

    /**
     * Field to validate with
     *
     * @var string
     */
    protected $_field;

    /**
     * Context
     *
     * @var string|array
     */
    protected $_context;

    /**
     * Construct
     *
     */
    public function __construct($field, $context = null)
    {
        $this->_field   = $field;
        $this->_context = $context;
    }

    /**
     * Validate to a context
     *
     * @param  string $value
     * @param  array|string $context
     * @return boolean
     */
    public function isValid($value, $context = null)
    {
        // Set value
        $this->_setValue($value);

        if ($context === null && $this->_context === null) {
            throw new Zend_Exception(sprintf('Validator "%s" contexts is not setup', get_class($this)));
        }

        // Use instance context if not provided
        $context = ($context === null) ? $this->_context : $context;

        // Validate string
        if (is_string($context) && $value == $context) {
             return true;
        }

        // Validate from array
        if (is_array($context) && isset($context[$this->_field]) && $value == $context[$this->_field]) {
            return true;
        }

        $this->_error(self::NOT_MATCH);
        return false;
    }
}
