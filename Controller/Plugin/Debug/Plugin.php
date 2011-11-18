<?php

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Plugin
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://www.codeblender.net/license
 */

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Plugin
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://www.codeblender.net/license
 */
class CodeBlender_Controller_Plugin_Debug_Plugin
{

    /**
     * Transforms data into readable format
     *
     * @param  array $values
     * @return string
     */
    protected function _cleanData($values)
    {
        if (is_array($values)) {
            ksort($values);
        }

        $retVal = '<div class="pre">';

        foreach ($values as $key => $value) {

            $key = htmlspecialchars($key);

            if (is_numeric($value)) {
                $retVal .= $key . ' => ' . $value . '<br />';
            } elseif (is_string($value)) {
                $retVal .= $key . ' => \'' . htmlspecialchars($value) . '\'<br />';
            } elseif (is_array($value)) {
                $retVal .= $key . ' => ' . self::_cleanData($value);
            } elseif (is_object($value)) {
                $retVal .= $key . ' => ' . get_class($value) . ' Object()<br />';
            } elseif (is_null($value)) {
                $retVal .= $key . ' => NULL<br />';
            }
        }

        return $retVal . '</div>';
    }

}
