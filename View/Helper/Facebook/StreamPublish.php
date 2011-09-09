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

// {{{ CodeBlender_View_Helper_Facebook_StreamPublish()

/**
 * Helper class to display the popup Stream Publish Dialog.
 *
 * This FBJS method publishes a post into the stream on the Wall of a user or a Facebook Page, group, or event connected to the user.
 * By default, this call publishes to the current session user's Wall, but if you specify a user ID, Facebook Page ID, group ID,
 * or event ID as the target_id, then the post appears on the Wall of the target, and not the user posting the item.
 *
 * <code>
 * // Invoke the Frame Button Helper
 * $this->facebook_StreamPublish();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Facebook.streamPublish
 * @see        http://wiki.developers.facebook.com/index.php/Attachment_%28Streams%29
 *
 * @todo Allow more than one Action Link to be created by Looping through an Array
 */
class CodeBlender_View_Helper_Facebook_StreamPublish
{
    // {{{ properties

    /**
     * Set the action link text
     *
     * @var string
     */
    protected $actionText = '';

    /**
     * Set the action link URL
     *
     * @var string
     */
    protected $actionURL = '';

    /**
     * A subtitle for the post that should describe why the user posted the item or the action the user took.
     * This field can contain plain text only, as well as the {*actor*} token, which gets replaced by a link
     * to the profile of the session user. The caption should fit on one line in a user's stream; make sure
     * you account for the width of any thumbnail.
     *
     * @var string
     */
    protected $caption = '';

    /**
     * Descriptive text about the story. This field can contain plain text only and should be no longer
     * than is necessary for a reader to understand the story. Facebook displays the first 300 or so
     * characters of text by default; users can see the remaining text by clicking a "See More" link that
     * we append automatically to long stories, or attachments with more than one image.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Set the image path for the Image media type.
     *
     * @var string
     */
    protected $imagePath = '';

    /**
     * Set the image URL for the Image media type.
     *
     * @var string
     */
    protected $imageURL = '';

    /**
     * The title of the post. The post should fit on one line in a user's stream;
     * make sure you account for the width of any thumbnail.
     *
     * @var string
     */
    protected $name = '';

    /**
     * The ID of the user, Page, group, or event where you are publishing the content.
     * If you specify a target_id, the post appears on the Wall of the target profile, Page, group, or event,
     * not on the Wall of the user who published the post.
     * This mimics the action of posting on a friend's Wall on Facebook itself..
     *
     * @var string
     */
    protected $targetID = 'null';

    /**
     * Whether to show the opening and closing <script> tags
     *
     * @var bool
     */
    protected $showScriptTag = true;

    /**
     * The URL to the source of the post referenced in the name. The URL should not be longer than 1024 characters.
     *
     * @var string
     */
    protected $URL = '';

    /**
     * The message the user enters for the post at the time of publication.
     *
     * @var /string
     */
    protected $userMessage = false;

    /**
     * Text you provide the user as a prompt to specify a user_message.
     * This appears above the box where the user enters a custom message. For example, "What's on your mind?"
     *
     * @var string
     */
    protected $userMessagePrompt = 'Add your own comment:';

    // }}}
    // {{{ facebook_StreamPublish()

    /**
     * Method to create a Facebook Stream Publish Dialog
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_StreamPublish($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        $string = '';

        // Show the Script Tag if required
        if ($params['showScriptTag']) {
            $string .=
            <<<HTML
                <script type="text/javascript">
HTML;
        }

        // Check to see if a user message is required
        if (empty($params['userMessage'])) {
            $userMessage = 'null';
        } else {
            $userMessage = '\'' . $params['userMessage'] . '\'';
        }

        // Initiate the Stream Publish Dialog Box
        $string .=
        <<<HTML

            // Create the required Attachment
            var attachment = {
                'media'   : [{
                  'type'  : 'image',
                  'src'   : '{$params['imagePath']}',
                  'href'  : '{$params['imageURL']}'
                  }],
                'name'        : '{$params['name']}',
                'href'        : '{$params['URL']}',
                'caption'     : '{$params['caption']}',
                'description' : '{$params['description']}'
            };

            // Create the Action Links for the Post
            var actionLinks = [{
              'text' : '{$params['actionText']}',
              'href' : '{$params['actionURL']}'
             }];

            Facebook.streamPublish(null, attachment, actionLinks, {$params['targetID']}, '{$params['userMessagePrompt']}');
HTML;

        // Show the Script Tag if required
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