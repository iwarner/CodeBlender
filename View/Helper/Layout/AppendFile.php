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
 * View Helper to append a File into the Theme. This is useful when other
 * components needs specific CSS or JavaScript this helper will add the
 * needed files into the template only when the other CodeBlender_View_Helper need them.
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Layout
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Layout_AppendFile extends Zend_View_Helper_Abstract
{
    /**
     * Method to load in the theme specific CSS for the Message element
     *
     * @param string $filePath
     * @param string $fileRevision[optional]
     * @return bool
     */
    public function layout_AppendFile($filePath, $fileRevision = '2.00')
    {
        // Get the Asset Path
        $config = Zend_Registry::get('config');

        // Create the Filename
        $filename = $config->path->assets . 'themes/' . $config->resources->layout->theme . '/style/' . $filePath;

        // Create the URI for the file
        $filename .=  '?v' . $fileRevision;

        $this->view->headLink()->appendStylesheet($filename);
    }
}
