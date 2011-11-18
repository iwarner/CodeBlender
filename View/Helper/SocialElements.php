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
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_SocialElements extends Zend_View_Helper_Abstract
{

    /**
     * Social Elements
     */
    public function socialElements()
    {
        $string = <<<HTML
            <div class="socialElements">

                <div class="facebookLike">
                    {$this->view->facebookLike(array('layout' => 'button_count'))}
                </div>

                <div class="twitterLike">
                    <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="SocialTriangle">Tweet</a>
                    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                </div>

                <div class="buzzLike">
                    <a title="Post to Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="small-count"></a>
                    <script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
                </div>

            </div>
HTML;

        return $string;
    }

}
