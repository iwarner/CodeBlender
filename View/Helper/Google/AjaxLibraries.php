<?php
/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Helper
 *
 * <code>
 * // Invoke Google Ajax Libraries Helper
 * $this->google_AjaxLibraries(array(
 *   'library' => 'ext-core',
 *   'version' => 3
 *  ));
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
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
    protected $library = false;
    /**
     * The list of available libraries that Google Load offers
     *
     * @var array
     */
    protected $libraryArray = array(
        'chrome-frame', 'dojo', 'ext-core', 'jquery', 'jqueryui', 'mootools',
        'prototype', 'scriptaculous', 'swfobject', 'yui', 'webfont'
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
    protected $version = false;

    /**
     * Method to generate the needed google code for the required Ad Slot.
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

        // Append the Facebook Feature Loader
        $this->view->headScript()->prependFile('http://www.google.com/jsapi', 'text/javascript');

        // Check if a version is supplied
        if (!empty($this->params['version'])) {
            $version = ', \'' . $this->params['version'] . '\'';
        } else {
            $version = '';
        }

        $this->view->headScript()->captureStart('APPEND');
        ?>
        // Load the Library
        google.load('<?php echo $this->params['library'] ?>'<?php echo $version ?>);
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
