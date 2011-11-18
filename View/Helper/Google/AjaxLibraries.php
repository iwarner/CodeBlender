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
 * // Google Ajax Libraries
 * echo $this->google_AjaxLibraries();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://code.google.com/apis/ajaxlibs/
 */
class CodeBlender_View_Helper_Google_AjaxLibraries extends Zend_View_Helper_Abstract
{

    /**
     * The library to load
     *
     * @var string
     */
    protected $library = 'jquery';

    /**
     * The list of available libraries that Google Load offers
     *
     * @var array
     */
    protected $libraryArray = array(
        'chrome-frame',
        'dojo',
        'ext-core',
        'jquery',
        'jqueryui',
        'mootools',
        'prototype',
        'scriptaculous',
        'swfobject',
        'yui',
        'webfont'
    );

    /**
     * The version number to laod
     *
     * The versioning system allows your application to specify a desired version with as
     * much precision as it needs. By dropping version fields, you end up wild carding a
     * field. For instance, consider a set of versions:
     *
     * @var string
     */
    protected $version = 1;

    /**
     * googleAjaxLibraries
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function google_AjaxLibraries($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $this->params = array_merge(get_class_vars(__CLASS__), $params);

        // Check that the given library is valid by checking the Library Array
        if (!self::_checkValidLibrary()) {
            return false;
        }

        // Prepend JS File
        $this->view->headScript()->prependFile('https://www.google.com/jsapi', 'text/javascript');

        // Capture JS
        $this->view->headScript()->captureStart('APPEND');
        ?>
        // Load JS Library
        google.load('<?php echo $this->params['library'] ?>', <?php echo $this->params['version'] ?>);
        <?php
        $this->view->headScript()->captureEnd();
    }

    /**
     * Method to check that the Library given is valid
     *
     * @return bool
     */
    private function _checkValidLibrary()
    {
        // Check that the given library is in the libraryArray
        if (in_array($this->params['library'], $this->libraryArray)) {
            return true;
        }

        return false;
    }

}
