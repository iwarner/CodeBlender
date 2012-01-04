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
class CodeBlender_Controller_Plugin_Debug_Plugin_Doctrine implements CodeBlender_Controller_Plugin_Debug_Plugin_Interface
{
    /**
     * Contains plugin identifier name
     *
     * @var string
     */
    protected $_identifier = 'doctrine';

    /**
     * Create CodeBlender_Controller_Plugin_Debug_Plugin_Auth
     *
     * @var    string $user
     * @var    string $role
     * @return void
     */
    public function __construct(array $options = array())
    {
    }

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
     **/
    public function getIconData()
    {
        return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAidJREFUeNqUk9tLFHEUxz+/mdnZnV1Tt5ttWVC+pBG+9RAYRNBDICT5D1hgL/VQWRAVEfVoCGURhCBFEj6IRkRFF7BAxPZlIbvZBTQq0q677u5c9tdvZyPaS1QHZh7OnPM93/me8xWC4rAnR6WbuAdSYjRvwWzaVFpSFEZpwvvwGnu4GwJB5OwMfwutNKHXrQFrASJcjTM+RPJMh/wvALOpRVh7+pC6gahegjMxQvLsTvnPAHkN5NxbhB5AfptDy4OMD5PsrQwiRElz5uoJvKdjaMsb0FesxX3yEBGsQiY/YWxopWpvv/gjg8zgSXJvEojapVid5wl3DRLc3qWYfCz8ztgQqf6DsiJA5vZFmZuKIyI1kPyC9zJOvjLYuh9zx2Hk5/doNXU4Dwawpx7JMgA3cVe9VT4YRl/djHOnDzd+vQDSdgiz7QAy9RUcG29ytPwOcrPTiEX1RI7fQqhJeDbSdRVmTn30CLUfhfnvZEdOI7PpChoYAVWo5rmOz0R6XoER4ueTx/IKsv8m/S8G+sp1OK8ukzq1DS1cS85OY+3qwWhs8W8ic+UIzv1LSqMoWjRWziCwsV1dkQWKnjf9WIm3z2/OR1Y12zcvqHWG0RbG0GIN5QDm+s3C3LrbXxmBECK6rLCdgWN+M5a6hew8oc7eIoOJUqulr/VI+8Y5pJP2p+VmnkEogrZ4FaGO7jJ3ikpezV+k93wC790L31R6faNPu5K1fwgwAMKf1kgHZKePAAAAAElFTkSuQmCC';
    }

    /**
     * Gets menu tab for the Debugbar
     *
     * @return string
     */
    public function getTab()
    {
    	return 'Doctrine';
    }

    /**
     * Gets content panel for the Debugbar
     *
     * @return string
     */
    public function getPanel()
    {
        return '';
    }
}
