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
                    {$this->view->facebook_LikeButton(array('layout' => 'button_count'))}
                </div>

                <div class="twitterLike">
                    {$this->view->tweetButton(array('count' => 'horizontal', 'via' => 'SocialTriangle'))}
                </div>

                <div class="buzzLike">
                    {$this->view->google_PlusButton()}
                </div>

            </div>
HTML;

        return $string;
    }

}
