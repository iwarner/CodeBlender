<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @version    SVN: $Id: $
 */

// {{{ CodeBlender_View_Helper_Facebook_Title()

/**
 * Helper class to produce the fb:title
 *
 * <code>
 * // Invoke the Frame Button Helper
 * $this->facebook_Title()->setTitle('Test This');
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:title
 *
 * @todo Fix up the properties
 */
class CodeBlender_View_Helper_Facebook_Title
{
    // {{{ properties

    /**
     * Property to hold the Title element
     *
     * @var string
     */
    protected $title;

    // }}}
    // {{{ facebook_Title()

    /**
     * Method to set the page's <title> tag to its contents.
     * Alternatively, when used inside fb:comments, sets the title for the Wall.
     *
     * @param  array  $params Array of attribute values
     * @return object $this
     */
    public function facebook_Title(array $params)
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        $string =
        <<<HTML
          <fb:title>{$params['title']}</fb:title>
HTML;

        return $string;
    }

    // }}}

}

// }}}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */