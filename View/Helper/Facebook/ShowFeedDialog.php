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

// {{{ CodeBlender_View_Helper_Facebook_ShowFeedDialog()

/**
 * Helper class to display the popup Feed Dialog
 *
 * <code>
 * // Invoke the Frame Button Helper
 * $this->facebook_ShowFeedDialog(array(
 *   ));
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Facebook.showFeedDialog
 */
class CodeBlender_View_Helper_Facebook_ShowFeedDialog
{
    // {{{ properties

    /**
     * This contains additional markup for a short story.
     *
     * @var string
     */
    protected $bodyGeneral = '';

    /**
     * This is a JavaScript function to be called after the dialog has been accepted or rejected by the user.
     * Note that due to concerns of abuse (rewarding users for publishing to their Feed, for example)
     * it is not possible to determine whether the user clicked "Publish" or canceled the dialog.
     * This function is passed three arguments: postId, exception, and data. postId is the ID of the
     * post created by the Feed form. exception is currently not used (but is used by FB.Connect.streamPublish).
     * data currently has one defined key: user_message, which contains the message entered by the user after the Feed form is accepted.
     *
     * @var function
     */
    protected $continuation = '\'\'';

    /**
     * Whether to show the opening and closing <script> tags
     *
     * @var bool
     */
    protected $showScriptTag = true;

    /**
     * This is the user ID of the friend of the Feed story actor.
     * If this parameter is used, the Feed story template must include the {*target*} token.
     * The story will be published to the friend's Feed, and a one-line story will be published to the user's Feed.
     *
     * @var int
     */
    protected $targetID = '\'\'';

    /**
     * The ID for a previously registered template bundle.
     * You can register a template bundle at Feed Template Console or by using feed.registerTemplateBundle.
     *
     * @var int
     */
    protected $templateBundleID = false;

    /**
     * This is the data for the template. For information on forming the template_data array, see Template Data.
     *
     * @var object
     */
    protected $templateData = '\'\'';

    /**
     * Either a simple JavaScript object containing single property, value,
     * which is set to the content that the user enters into the Feed form,
     * or a simple string containing the same data.
     * This message should have been entered by the user (for example, in a comment field on your site).
     * The user can then edit this text. When the user publishes the Feed form,
     * Facebook sets the value property to whatever text the user typed (if an object was passed in),
     * and passes it to the callback.
     *
     * @var object/string
     */
    protected $userMessage = '';

    /**
     * The label (which could be in the form of a question) that appears above
     * the text box on the Feed form next to the Facebook-provided question, "What's on your mind?".
     *
     * @var string
     */
    protected $userMessagePrompt = '';

    // }}}
    // {{{ facebook_ShowFeedDialog()

    /**
     * Method to display a Facebook Add Section Button
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_ShowFeedDialog($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        $string = '';

        // Show the Script Tag
        if ($params['showScriptTag']) {
            $string .=
            <<<HTML
                <script type="text/javascript">
HTML;
        }

        // Initiate the Facebook Add Section Button
        $string .=
        <<<HTML
             Facebook.showFeedDialog(
               {$params['templateBundleID']},
               {$params['templateData']},
               '{$params['bodyGeneral']}',
               {$params['targetID']},
               {$params['continuation']},
               '{$params['userMessagePrompt']}',
               '{$params['userMessage']}'
              );
HTML;

        // Show the Script Tag
        if ($params['showScriptTag']) {
            $string .=
            <<<HTML
                </script>
HTML;
        }

        // Return the string
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