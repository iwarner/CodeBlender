<?php
/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Layout
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Component to display an informational message.
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Layout
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Layout_Message extends Zend_View_Helper_Abstract
{
    /**
     * Body of the message box
     *
     * @var string
     */
    private $text = false;

    /**
     * Title of the message box
     *
     * @var string
     */
    private $title = false;

    /**
     * Method to produce the informational message.
     *
     * @param  array  $params See above
     * @return string         HTML string
     */
    public function layout_Message($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        if (empty($params['text'])) {
            throw new Zend_Exception('Message Helper requires a Text value');
            return false;
        }

        // Check to see if a Title is needed
        if (!empty($params['title'])) {
            $params['title'] = '<b>' . $params['title'] . '</b><br />';
        }

        // Create the string
        $string = <<<HTML
          <div class="message {$params['class']}">
            {$params['title']}
            {$params['text']}
          </div>
HTML;

        return $string;
    }
}
