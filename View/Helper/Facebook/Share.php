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

// {{{ CodeBlender_View_Helper_Facebook_Share()

/**
 * Helper class to produce the Facebook Share Box
 *
 * <code>
 * // Invoke the Share Button Helper
 * $this->facebook_Share(array(
 *    'description' => 'Share Text',
 *    'href'        => $this->path,
 *    'link'        => array('image_src' => '../Assets/Site/badge.gif'),
 *    'title'       => 'Title'
 *   ))
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://wiki.developers.facebook.com/index.php/Fb:share-button
 * @see        http://www.facebook.com/share_partners.php
 */
class CodeBlender_View_Helper_Facebook_Share
{
    // {{{ properties

    /**
     * The type of share button. When used as an FBML tag, valid values are url,
     * to render a share of the URL specified with the href attribute, and meta,
     * to render a share with the given data. When used as an XFBML tag, the value must be url.
     *
     * @var string
     */
    protected $class = 'meta';

    /**
     * The Description area of the share button
     *
     * @var string
     */
    protected $description = false;

    /**
     * The reference URL to share. This attribute is required for the url class only.
     *
     * @var string
     */
    protected $href = false;

    /**
     * Type of content being shared can be: "audio", "image", "video", "news", "blog" and "mult".
     *
     * @var string
     */
    protected $medium = 'mult';

    /**
     * The metadata about the shared item. See descriptions of the necessary data.
     * The meta class may contain this attribute. (This attribute is not supported in XFBML.)
     *
     * @var string
     */
    protected $meta = false;

    /**
     * The content (such as image thumbnails) for the shared item.
     * See descriptions of the necessary data. The meta class may contain this attribute.
     * (This attribute is not supported in XFBML.)
     *
     * @var array
     */
    protected $link = false;

    /**
     * The Title area of the share button
     *
     * @var string
     */
    protected $title = false;

    /**
     * This attribute must be one of: button, icon, link, or icon_link.
     * The value for the attribute indicates whether the Share button will
     * be rendered as a button, icon, link, or link and icon, respectively;
     * it does not affect functionality. (This attribute is only supported in XFBML.)
     * (Default value is icon_link.)
     *
     * @var string
     */
    protected $type = 'icon_link';

    /**
     * The content for the videos
     *
     * @var array
     */
    protected $video = false;

    // }}}
    // {{{ facebook_Share()

    /**
     * Method to display a Share Button
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function facebook_Share($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Initiate the Share Tag
        $string =
        <<<HTML
         <fb:share-button class="{$params['class']}">
          <link rel="target_url" href="{$params['href']}" />
          <meta name="medium" content="{$params['medium']}" />
          <meta name="title" content="{$params['title']}" />
          <meta name="description" content="{$params['description']}" />
HTML;

        // Check to see if the link param is valid
        if ($params['video']) {

            // Loop through the link options
            foreach ($params['video'] as $k => $v) {

                $string .=
                <<<HTML
                   <meta name="{$k}" content="{$v}" />
HTML;
            }
        }

        // Check to see if the link param is valid
        if ($params['link']) {

            // Loop through the link options
            foreach ($params['link'] as $k => $v) {

                $string .=
                <<<HTML
                   <link rel="{$k}" href="{$v}" />
HTML;
            }
        }

        // Complete the Share Tag
        $string .=
        <<<HTML
          </fb:share-button>
HTML;

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