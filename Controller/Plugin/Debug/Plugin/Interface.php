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
interface CodeBlender_Controller_Plugin_Debug_Plugin_Interface
{

    /**
     * Has to return html code for the menu tab
     *
     * @return string
     */
    public function getTab();

    /**
     * Has to return html code for the content panel
     *
     * @return string
     */
    public function getPanel();

    /**
     * Has to return a unique identifier for the specific plugin
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Return the path to an icon
     *
     * @return string
     */
    public function getIconData();
}
