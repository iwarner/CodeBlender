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

// {{{ CodeBlender_View_Helper_Facebook_DialogFBJS()

/**
 * Helper class to produce the Facebook FBJS Dialog Box
 *
 * <code>
 * // Invoke the Dialog FBJS Helper
 * $this->facebook_DialogFBJS(array(
 *   'buttons' => array(array('type' => 'button', 'value' => 'Close', 'extra' => 'close_dialog="true"')),
 *   'content' => 'Testing'
 *  ));
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/FBJS#Dialogs
 */
class CodeBlender_View_Helper_Facebook_DialogFBJS
{
    // {{{ properties

    /**
     * An event handler that fires when the user selects the button designed as
     * "cancel" (right most button). If this event doesn't return false the dialog will be hidden.
     *
     * @var string
     */
    protected $onCancel = false;

    /**
     * An event handler that fires when the user selects the button designed
     * as "confirm" (left most button). If this event doesn't return false the dialog will be hidden.
     *
     * @var string
     */
    protected $onConfirm = false;

    /**
     * (only applicable for DIALOG_CONTEXTUAL). Sets the context of a dialog,
     * which basically means where the cursor arrow is pointing.
     *
     * @var string
     */
    protected $setContext = false;

    /**
     * Allows you to set the style of the parent dialog node
     *
     * @var string
     */
    protected $setStyle = false;

    /**
     * Displays a dialog with Confirm and Cancel buttons. title and content
     * can be either strings or pre-rendered FBML blocks.
     *
     * @var array
     */
    protected $showChoice = false;

    /**
     * Displays a dialog with only a confirm button. title and content can
     * be either strings or pre-rendered FBML blocks.
     *
     * @var array
     */
    protected $showMessage = false;

    /**
     * Type can be either Dialog.DIALOG_POP or Dialog.DIALOG_CONTEXTUAL.
     *
     * DIALOG_POP
     * This is the type of dialog that shows up when you delete a wall post.
     *
     * DIALOG_CONTEXTUAL
     * This is type of dialog that shows up when you delete a minifeed story.
     *
     * @var string
     */
    protected $type = 'POP';

    // }}}
    // {{{ facebook_DialogFBJS()

    /**
     * Method to display a dialog box
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_DialogFBJS($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        $string = '';

        // Check to make sure this is a Contextual dialog and SetContext and showChoice are set
        if ($params['type'] == 'CONTEXTUAL' && !empty($params['setContext'])) {

            $setContext = <<<HTML
              dialog.showChoice('{$params['showChoice']['title']}', '{$params['showMessage']['content']}', '{$params['showMessage']['buttonConfirm']}', '{$params['showMessage']['buttonCancel']}');
              dialog.setContext({$params['setContext']});
HTML;
        } else {
            $setContext = '';
        }

        // Check to make sure this is a POP dialog and showMessage is set
        if ($params['type'] == 'POP' && !empty($params['showMessage'])) {

            $showMessage = <<<HTML
              dialog.showMessage('{$params['showMessage']['title']}', '{$params['showMessage']['content']}', '{$params['showMessage']['buttonConfirm']}');
HTML;
        } else {
            $showMessages = '';
        }

        // Complete the FBML string to return
        $string .= <<<HTML
           var dialog = new Dialog(Dialog.DIALOG_{$params['type']});
           {$setContext}
           {$showMessage}

HTML;

        return $string;
    }

    // }}}s

}

// }}}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */