<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   ExtJS
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Enable ExtJS
 *
 * @category  CodeBlender
 * @package   ExtJS
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
class CodeBlender_ExtJS_View_Helper_ExtJS_Container extends Zend_View_Helper_Abstract
{

    /**
     * @var Zend_View_Interface
     */
    public $view;

    /**
     * Base CDN url to utilize
     * @var string
     */
    protected $_extVersion = CodeBlender_ExtJS::EXTJS_VERSION;

    /**
     * Set view object
     *
     * @param  Zend_EXTJS_View_Interface $view
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Set view object
     *
     * @param  Zend_ExtJS_View_Interface $view
     * @return void
     */
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    /**
     * Enable ExtJS
     *
     * @return CodeBlender_ExtJS_View_Helper_ExtJS_Container
     */
    public function enable()
    {
        // Append the Core Theme Stylesheet
        $this->view->headLink()->prependStylesheet($this->view->jsPath . '/' . $this->_extVersion . '/resources/css/ext-all.css');
        $this->view->headLink()->prependStylesheet($this->view->jsPath . '/' . $this->_extVersion . '/resources/css/xtheme-gray.css');

        // Append the Core JavaScript Files
        $this->view->headScript()->offsetSetFile(1, $this->view->jsPath . '/' . $this->_extVersion . '/adapter/ext/ext-base.js', 'text/javascript');
        $this->view->headScript()->offsetSetFile(2, $this->view->jsPath . '/' . $this->_extVersion . '/ext-all.js', 'text/javascript');
        $this->view->headScript()->offsetSetFile(1000, $this->view->themePath . '/default/js/extjs/core.js', 'text/javascript');

        return $this;
    }

    /**
     * Enable ExtJS rowExpander
     *
     * @return CodeBlender_ExtJS_View_Helper_ExtJS_Container
     */
    public function rowExpander()
    {
        $this->view->headScript()->offsetSetFile(40, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/RowExpander.js', 'text/javascript');

        return $this;
    }

    /**
     * Enable ExtJS checkColumn
     *
     * @return CodeBlender_ExtJS_View_Helper_ExtJS_Container
     */
    public function checkColumn()
    {
        $this->view->headScript()->offsetSetFile(50, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/CheckColumn.js', 'text/javascript');

        return $this;
    }

    /**
     * Enable ExtJS fileUploadField
     *
     * @return CodeBlender_ExtJS_View_Helper_ExtJS_Container
     */
    public function fileUploadField()
    {
        $this->view->headLink()->prependStylesheet($this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/fileuploadfield/css/fileuploadfield.css');
        $this->view->headScript()->offsetSetFile(60, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/fileuploadfield/FileUploadField.js', 'text/javascript');

        return $this;
    }

    /**
     * Enable ExtJS Grid Filter
     *
     * @return CodeBlender_ExtJS_View_Helper_ExtJS_Container
     */
    public function gridFilter()
    {
        $this->view->headLink()->prependStylesheet($this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/gridfilters/css/GridFilters.css');
        $this->view->headLink()->prependStylesheet($this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/gridfilters/css/RangeMenu.css');

        $this->view->headScript()->offsetSetFile(70, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/gridfilters/menu/RangeMenu.js', 'text/javascript');
        $this->view->headScript()->offsetSetFile(71, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/gridfilters/menu/ListMenu.js', 'text/javascript');

        $this->view->headScript()->offsetSetFile(72, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/gridfilters/GridFilters.js', 'text/javascript');

        $this->view->headScript()->offsetSetFile(73, $thi->jsPath . '/' . $this->_extVersion . '/examples/ux/gridfilters/filter/Filter.js', 'text/javascript');
        $this->view->headScript()->offsetSetFile(74, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/gridfilters/filter/StringFilter.js', 'text/javascript');
        $this->view->headScript()->offsetSetFile(75, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/gridfilters/filter/DateFilter.js', 'text/javascript');
        $this->view->headScript()->offsetSetFile(76, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/gridfilters/filter/ListFilter.js', 'text/javascript');
        $this->view->headScript()->offsetSetFile(77, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/gridfilters/filter/NumericFilter.js', 'text/javascript');
        $this->view->headScript()->offsetSetFile(78, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/gridfilters/filter/BooleanFilter.js', 'text/javascript');

        return $this;
    }

    /**
     * Enable ExtJS rowEditor
     *
     * @return CodeBlender_ExtJS_View_Helper_ExtJS_Container
     */
    public function rowEditor()
    {
        $this->view->headLink()->prependStylesheet($this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/css/RowEditor.css');
        $this->view->headScript()->offsetSetFile(80, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/RowEditor.js', 'text/javascript');

        return $this;
    }

    /**
     * Enable ExtJS fieldReplicator
     *
     * @return CodeBlender_ExtJS_View_Helper_ExtJS_Container
     */
    public function fieldReplicator()
    {
        $this->view->headScript()->offsetSetFile(90, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/FieldLabeler.js', 'text/javascript');
        $this->view->headScript()->offsetSetFile(91, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/FieldReplicator.js', 'text/javascript');

        return $this;
    }

    /**
     * Enable ExtJS Spinner Field
     *
     * @return CodeBlender_ExtJS_View_Helper_ExtJS_Container
     */
    public function spinnerField()
    {
        $this->view->headLink()->appendStylesheet($this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/css/Spinner.css');
        $this->view->headScript()->offsetSetFile(92, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/Spinner.js', 'text/javascript');
        $this->view->headScript()->offsetSetFile(93, $this->view->jsPath . '/' . $this->_extVersion . '/examples/ux/SpinnerField.js', 'text/javascript');

        return $this;
    }

}
