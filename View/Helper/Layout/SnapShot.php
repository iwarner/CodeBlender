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
 * Creates a 580 x 75 image box with caption.
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Layout_SnapShot extends Zend_View_Helper_Abstract
{

    /**
     * Alt Image text, always defaults to something
     *
     * @var string
     */
    protected $alt = 'Image';
    /**
     * Caption text
     *
     * @var string
     */
    protected $caption = false;
    /**
     * Image path
     *
     * @var string
     */
    protected $path = false;

    /**
     * Method to create a snapShot image for the page
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function layout_SnapShot($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Create the image to go into the snapshot
        $image = $this->view->layout_Image(array(
                    'alt' => $params['alt'],
                    'class' => null,
                    //'height' => $params['height'],
                    'path' => $params['path'],
                        //'width'  => $params['width']
                ));

        $caption = '';

        // Check to see if this snapshot needs a caption
        if (!empty($params['caption'])) {
            $caption = '<div class="caption">' . $params['caption'] . '</div>';
        }

        // Create the HTML string
        $string =
                <<<HTML
			<div class="snapshot"><div class="snapshotInner">{$image}</div>{$caption}</div>
HTML;

        return $string;
    }

}
