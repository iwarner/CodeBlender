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

// {{{ CodeBlender_View_Helper_Facebook_AppsaholicsAdvert()

/**
 * Helper class to produce the Appsaholics Advert for the views.
 *
 * <code>
 * // Include the Social Media Tracking icon
 * $this->facebook_AppsaholicsAdvert(array('publisherID' => ''));
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://www.socialmedia.com/         Coporate site.
 * @see        http://apps.facebook.com/appsaholic Facebook application.
 *
 * @todo Fix up the properties
 */
class CodeBlender_View_Helper_Facebook_AppsaholicsAdvert
{
    // {{{ properties

    /**
     * Vars to set the defaults
     */
    private $defaults = array(
      'publisherID' => false // String The Social Media Publisher ID
     );

    // }}}
    // {{{ facebook_AppsaholicsAdvert()

    /**
     * Method to render the SocialMedia Tracking Dot in a Facebook iFrame
     *
     * @param  array  $params Array of attribute values for the Content Box
     * @return string
     */
    public function facebook_AppsaholicsAdvert($params)
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge($this->defaults, $params);

        $string =
        <<<HTML
          <fb:iframe src="http://ads.socialmedia.com/facebook/monetize.php?width=728&height=90&pubid={$params['publisherID']}&bordercolor="
            border="0" width="728" height="90"  name="socialmedia_ad" scrolling="no" frameborder="0" />

          <fb:iframe src='http://adtracker.socialmedia.com/track/' width='1' height='1' />
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