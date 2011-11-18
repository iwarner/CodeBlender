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
 * <code>
 * // Tweet Button
 * echo $this->tweetButton();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://twitter.com/about/resources/tweetbutton
 * @see        https://dev.twitter.com/docs/tweet-button
 */
class CodeBlender_View_Helper_TweetButton extends Zend_View_Helper_Abstract
{

    /**
     * Build Your Own
     */
    protected $byo = false;

    /**
     * Count positioning
     */
    protected $count = 'none';

    /**
     * Language
     */
    protected $language = 'en';

    /**
     * Related User
     */
    protected $related = false;

    /**
     * Text
     */
    protected $text = 'Twitter Text';

    /**
     * URL
     */
    protected $URL = 'http://www.example.com';

    /**
     * Via User
     */
    protected $via = false;

    /**
     * Tweet Button
     */
    public function tweetButton($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        if (!$params['byo']) {

            $string = <<<HTML
                <a href="http://twitter.com/share"
                    class="twitter-share-button"
                    data-url="{$params['URL']}"
                    data-text="{$params['text']}"
                    data-lang="{$params['language']}"
                    data-count="{$params['count']}">Tweet</a>

                <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
HTML;
        } else {

            $params['text'] = urlencode($params['text']);

            $string = <<<HTML
                http://twitter.com/share?url={$params['URL']}&amp;text={$params['text']}&amp;related={$params['related']}
HTML;
        }

        return $string;
    }

}
