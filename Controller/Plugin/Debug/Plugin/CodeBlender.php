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
class CodeBlender_Controller_Plugin_Debug_Plugin_CodeBlender implements CodeBlender_Controller_Plugin_Debug_Plugin_Interface
{

    /**
     * Contains plugin identifier name
     *
     * @var string
     */
    protected $_identifier = 'codeblender';

    /**
     * Debug Bar Version Number
     *
     * @var string
     */
    protected $_version = '1.01';

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
        return 'data:image/png;base64,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';
    }

    /**
     * Gets menu tab
     *
     * @return string
     */
    public function getTab()
    {
        return 'v' . $this->_version;
    }

    /**
     * Gets content panel
     *
     * @return string
     */
    public function getPanel()
    {
        $date = date('Y');

        $html = <<<HTML

			<h4>
				CodeBlender Debug Bar
			</h4>

            <p>
            	This project is hosted at

            	<a href="http://github.com/iwarner/CodeBlender-Debug" title="CodeBlender project Home">
            	    http://github.com/iwarner/CodeBlender-Debug
        	    </a>

            	and released under the BSD License, we are actively looking for contributors to this project.
			</p>

			<h4>
				Useful Macros
			</h4>

			<p>
			    Add these as URL parameters.<br />

				<b>CBDDISABLE</b> - remove the debug bar from a request.
				                    For exmple on the home page add /index/index/CBDDISABLE/true<br />
				<b>CBDRESET</b>   - Reset timers by sending CBDRESET as a GET/POST parameter
			</p>

			<h4>
				Information
			</h4>

			<p>
				Please visit
				<a href="http://www.codeblender.net/" title="CodeBlender">
					CodeBlender
				</a>
				for an overview of the whole project.
				<br />
                Includes icons from the
                <a href="http://www.famfamfam.com/lab/icons/silk/" title="Silk Icons">Silk Icon set</a> by Mark James</p>
            </p>

			<p>
				&copy;{$date}

				<a href="http://www.triangle-solutions.com/" title="Triangle Solutions Ltd">
					Triangle Solutions Ltd
				</a>
			</p>
HTML;

        return $html;
    }

}
