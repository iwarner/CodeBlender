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
class CodeBlender_Controller_Plugin_Debug_Plugin_File implements CodeBlender_Controller_Plugin_Debug_Plugin_Interface
{
    /**
     * Contains plugin identifier name
     *
     * @var string
     */
    protected $_identifier = 'file';

    /**
     * Base path of this application
     * String is used to strip it from filenames
     *
     * @var string
     */
    protected $_basePath;

    /**
     * Stores included files
     *
     * @var array
     */
    protected $_includedFiles = null;

    /**
     * Stores name of own extension library
     *
     * @var string
     */
    protected $_library;

    /**
     * Setting Options
     *
     * basePath:
     * This will normally not your document root of your webserver, its your
     * application root directory with /application, /library and /public
     *
     * library:
     * Your own library extension(s)
     *
     * @param array $options
     * @return void
     */
    public function __construct(array $options = array())
    {
        isset($options['basePath']) || $options['basePath'] = $_SERVER['DOCUMENT_ROOT'];
        isset($options['library']) || $options['library']   = null;

        $this->_basePath = $options['basePath'];
        is_array($options['library']) || $options['library'] = array($options['library']);
        $this->_library = array_merge($options['library'], array('Zend', 'CodeBlender'));
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
     */
    public function getIconData()
    {
        return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAADPSURBVCjPdZFNCsIwEEZHPYdSz1DaHsMzuPM6RRcewSO4caPQ3sBDKCK02p+08DmZtGkKlQ+GhHm8MBmiFQUU2ng0B7khClTdQqdBiX1Ma1qMgbDlxh0XnJHiit2JNq5HgAo3KEx7BFAM/PMI0CDB2KNvh1gjHZBi8OR448GnAkeNDEDvKZDh2Xl4cBcwtcKXkZdYLJBYwCCFPDRpMEjNyKcDPC4RbXuPiWKkNABPOuNhItegz0pGFkD+y3p0s48DDB43dU7+eLWes3gdn5Y/LD9Y6skuWXcAAAAASUVORK5CYII=';
    }

    /**
     * Gets menu tab for the Debugbar
     *
     * @return string
     */
    public function getTab()
    {
        return count($this->_getIncludedFiles()) . ' Files';
    }

    /**
     * Gets content panel for the Debugbar
     *
     * @return string
     */
    public function getPanel()
    {
        $included = $this->_getIncludedFiles();
        $html     = '<h4>File Information</h4>';
        $html    .= count($included).' Files Included<br />';
        $size     = 0;

        foreach ($included as $file) {
            $size += filesize($file);
        }

        $html .= 'Total Size: '. round($size/1024, 1).'K<br />';
        $html .= 'Basepath: ' . $this->_basePath . '<br />';

        $libraryFiles = array();

        foreach ($this->_library as $key => $value) {
            if ('' != $value) {
                $libraryFiles[$key] = '<h4>' . $value . ' Library Files</h4>';
            }
        }

        $html .= '<h4>Application Files</h4>';

        foreach ($included as $file) {

            $file = str_replace($this->_basePath, '', $file);
            $inUserLib = false;

        	foreach ($this->_library as $key => $library)
        	{
        		if ('' != $library && false !== strstr($file, $library)) {
        			$libraryFiles[$key] .= $file . '<br />';
        			$inUserLib = TRUE;
        		}
        	}

        	if (!$inUserLib) {
    			$html .= $file . '<br />';
        	}
        }

    	$html .= implode('', $libraryFiles);

        return $html;
    }

    /**
     * Gets included files
     *
     * @return array
     */
    protected function _getIncludedFiles()
    {
        if (null !== $this->_includedFiles) {
            return $this->_includedFiles;
        }

        $this->_includedFiles = get_included_files();
        sort($this->_includedFiles);
        return $this->_includedFiles;
    }
}
