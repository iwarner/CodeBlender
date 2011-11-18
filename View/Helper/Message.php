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
 * Helper
 *
 * <code>
 * // Message
 * echo $this->message();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Message extends Zend_View_Helper_Abstract
{

    /**
     * Class
     *
     * Options
     * help | error | warning | success | info
     *
     * @var string
     */
    private $class = 'help';

    /**
     * Content
     *
     * @var string
     */
    private $text = false;

    /**
     * Title
     *
     * @var string
     */
    private $title = false;

    /**
     * Message
     *
     * @param  array  $params See above
     * @return string         HTML string
     */
    public function message($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        if (empty($params['text'])) {
            throw new Zend_Exception('Message Helper requires a Text value');
            return false;
        }

        // Check to see if a Title is needed
        if (!empty($params['title'])) {
            $params['title'] = '<div class="messageTitle">' . $params['title'] . '</div>';
        }

        // Create the string
        $string = <<<HTML
          <div class="message {$params['class']}">
            {$params['title']}
            <div class="messageText">{$params['text']}</div>
          </div>
HTML;

        return $string;
    }

}
