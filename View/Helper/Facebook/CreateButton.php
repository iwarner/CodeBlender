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

// {{{ CodeBlender_View_Helper_Facebook_CreateButton()

/**
 * Helper class to display a standalone Facebook Create button independent of a Dashboard
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 *
 * @todo Fix up the properties
 */
class CodeBlender_View_Helper_Facebook_CreateButton
{
    // {{{ properties

    /**
     * Vars to set the defaults
     */
    private $defaults = array(
      'text'  => '',       // String Text to display in the button
      'href'  => 'create', // Link for the button to go when clicked
      'style' => ''
     );

    // }}}
    // {{{ facebook_CreateButton()

    /**
     * Method to get a Facebook create button
     *
     * @param  array  $params Array of attribute values
     * @return string
     *
     * @link   http://wiki.developers.facebook.com/index.php/Fb:create
     */
    public function facebook_CreateButton($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge($this->defaults, $params);

        // Create the message string
        $string = <<<HTML
            <div class="dh_new_media_shell" style="${params['style']}">
                <a class="dh_new_media" href="${params['href']}">
                    <div class="tr">
                        <div class="bl">
                            <div class="br">
                                <span>${params['text']}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
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