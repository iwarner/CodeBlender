<?php
/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Plugin
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://www.codeblender.net/license
 */

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Plugin
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://www.codeblender.net/license
 */
class CodeBlender_Controller_Plugin_Debug_Plugin_Php extends CodeBlender_Controller_Plugin_Debug_Plugin implements CodeBlender_Controller_Plugin_Debug_Plugin_Interface
{
    /**
     * Contains plugin identifier name
     *
     * @var string
     */
    protected $_identifier = 'Php';

    /**
     * Gets identifier for this plugin
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->_identifier;
    }

    /**
     * Returns the base64 encoded icon
     *
     * @return string
     */
    public function getIconData()
    {
        return 'data:image/gif;base64,R0lGODlhEAAQAJEAAAAAAICAwNfX1wAAACH5BAQAAAAALAAAAAAQABAAAAItjI+py80C3RFANGhpDNhQUH0hGGraaKInVKnoy7JgfM6055letWjTluhIhpICADs=';
    }

    /**
     * Gets menu tab for the Debugbar
     *
     * @return string
     */
    public function getTab()
    {
        return 'PHP Info';
    }

    /**
     * Gets content panel for the Debugbar
     *
     * @return string
     */
    public function getPanel()
    {
        ob_start();
        phpinfo();
        $html = ob_get_clean();

        return $html;
    }
}
