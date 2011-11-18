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
 * // For Displaying an Image based on the Config assetPath
 * echo $this->image(array(
 *   'path' => 'Site/header.jpg'
 *  ));
 *
 * // For displaying an Icon based in the global icons folder
 * echo $this->image(array(
 *   'icon' => 'redmond',
 *   'path' => 'save_16.gif'
 *  ));
 *
 * // For displaying a Facebook Dialog Box
 * echo $this->image(array(
 *   'path'       => 'Site/help.png',
 *   'javaScript' => 'clicktoshowdialog="<FB:DIALOG ID>"',
 *   'url'        => '#'
 *  ));
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Image extends Zend_View_Helper_Abstract
{

    /**
     * Vars to set the defaults
     */
    private $defaults = array(
        // Image
        'alt' => 'Image', // String Alt / Title text
        'class' => 'image', // String Class for the Image tag
        'height' => false, // Int    Height of the image
        'icon' => false, // String Name of the directory where the icons resides
        'imageScript' => false, // String Javascript elements for the image
        'path' => false, // String Path to the image
        'useAssetPath' => true, // Bool   Whether to use the Asset Path or not
        'width' => false, // Int    Width of the image
        // Link
        'hrefScript' => false, // String Javascript elements
        'target' => '_self', // String Target for the Link
        'url' => false    // String URL for the hyperlink
    );

    /**
     * Image
     *
     * @param  array  $params See above
     * @return string         HTML
     */
    public function image($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $this->params = array_merge($this->defaults, $params);

        $string = '';

        // Check for the image Path
        if (empty($this->params['path'])) {
            throw new Zend_Exception('No Path passed to image helper so cant find image');
        }

        // Check that we have an XHTML compliant ALT tag
        if (empty($this->params['alt'])) {
            throw new Zend_Exception('Alt element not found');
        }

        if (empty($this->params['width'])) {
            $width = '';
        } else {
            $width = 'width="' . $this->params['width'] . '"';
        }

        if (empty($this->params['height'])) {
            $height = '';
        } else {
            $height = 'height="' . $this->params['height'] . '"';
        }

        // Get the Path of the image / check to see if this is an Icon
        self::imagePath();

        // Check to see if we want to link the image
        if ($this->params['url']) {

            $string .= <<<HTML
              <a href="{$this->params['url']}" title="{$this->params['alt']}" target="{$this->params['target']}" {$this->params['hrefScript']}>
HTML;
        }

        // Create the Image String
        $string .= <<<HTML
          <img src="{$this->path}" class="{$this->params['class']}" {$width} {$height} alt="{$this->params['alt']}" title="{$this->params['alt']}" {$this->params['imageScript']} />
HTML;

        // Complete the HREF URL if required
        if ($this->params['url']) {
            $string .= '</a>';
        }

        return $string;
    }

    /**
     * Method to get the correct Path for the image
     *
     * @return void
     */
    private function imagePath()
    {
        // Check to see that this is not an Icon
        if (empty($this->params['icon'])) {

            // Check to make sure this does not begin with http - if so use assetPath
            if ($this->params['useAssetPath']) {
                $this->path = $this->view->imagePath . $this->params['path'];
            } else {
                $this->path = $this->params['path'];
            }

            // Else Check to see if this should be an Icon.
        } else {
            $this->path = $this->view->iconPath . $this->params['icon'] . '/' . $this->params['path'];
        }
    }

}
