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

// {{{ CodeBlender_View_Helper_Facebook_DialogFBML()

/**
 * Helper class to produce the Facebook FBML Dialog Box and associated hyperlink if required
 *
 * <code>
 * // Invoke the Dialog FBML Helper
 * $this->facebook_DialogFBML(array(
 *   'buttons' => array(array('type' => 'button', 'value' => 'Close', 'extra' => 'close_dialog="true"')),
 *   'content' => 'Testing'
 *  ));
 *
 * // To activate a dialog from a Link use:
 * clicktoshowdialog="dialog_id"
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:dialog
 *
 * @todo Get the FBJS and Standard versions working
 */
class CodeBlender_View_Helper_Facebook_DialogFBML
{
    // {{{ properties


    /**
     * Indicates whether to display a Cancel button to close the dialog.
     *
     * @var bool
     */
    protected $cancelButton = 'false';

    /**
     * Array of buttons to display
     *
     * @var array
     */
    protected $buttons = false;

    /**
     * The fb:dialog-content tag is a child of fb:dialog and represents
     * the content that gets displayed inside the popup dialog when it appears.
     *
     * @var string
     */
    protected $content = false;

    /**
     * The unique identifier for your dialog, which is used to invoke your dialog.
     *
     * @var string
     */
    protected $dialogID = false;

    /**
     * Text to display for the URL and Title tag
     *
     * @var string
     */
    protected $linkText = false;

    /**
     * Title of the dialog box
     *
     * @var string
     */
    protected $title = false;

    // }}}
    // {{{ facebook_DialogFBML()

    /**
     * Method to display a dialog box
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_DialogFBML($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Create the FBML string to return
        $dialogString = <<<HTML
          <fb:dialog id="{$params['dialogID']}" cancel_button="{$params['cancelButton']}">
HTML;

        // Check to see if this Dialog box requires a title
        if ($params['title']) {
            $dialogString .= <<<HTML
               <fb:dialog-title>{$params['title']}</fb:dialog-title>
HTML;
        }

        // Create the array of buttons to show
        if (!empty($params['buttons'])) {

            $buttons = '';

            foreach ($params['buttons'] as $k => $v) {

                $buttons .= '<fb:dialog-button type="' . $v['type'] . '" value="' . $v['value'] . '" ' . $v['extra'] . ' />';
            }

        } else {
            $buttons = '';
        }

        // Complete the FBML string to return
        $dialogString .= <<<HTML
           <fb:dialog-content>
            {$params['content']}
           </fb:dialog-content>

           {$buttons}

          </fb:dialog>
HTML;

        // Whether to create an associated Link for the Dialog box.
        if (!empty($params['linkText'])) {

            // Create the necessary link to activate the Dialog.
            $dialogString .= <<<HTML
              <a href="#" clicktoshowdialog="{$params['dialogID']}" title="{$params['linkText']}">{$params['linkText']}</a>
HTML;
        }

        // Return the array
        return $dialogString;
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