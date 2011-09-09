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

// {{{ CodeBlender_View_Helper_Facebook_Wall()

/**
 * Helper class to produce the Facebook Wall
 *
 * // Invoke the Facebook Wall
 * $string .= $this->facebook_Wall();
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 *
 * @todo Fix up the properties
 */
class CodeBlender_View_Helper_Facebook_Wall extends Zend_View_Helper_Abstract
{
    // {{{ properties

    /**
     * Vars to set the defaults for the request invite forms
     */
    private $defaults = array(
      'canPost'      => true,
      'canDelete'    => false,
      'canMark'      => true,
      'canCreate'    => true,
      'numberTopics' => 5,
      'callbackUrl'  => false,
      'returnUrl'    => false
     );

    // }}}
    // {{{ facebook_Wall()

    /**
     * Method to create a facebook wall component
     *
     * @param  array  $content
     * @param  bool   $anon
     * @return string
     */
    public function facebook_Wall($content, $anon = false)
    {
        // Initilise the string and start the Wall CSS
        $string =
        <<<HTML
          <fb:wall></fb:wall>
          <div class="wallkit_frame clearfix">
HTML;

        // Loop through the content array to produce the wall posts.
        foreach ($content as $k => $v) {

            $string .=
            <<<HTML
              <div class="wallkit_post">
               <div class="wallkit_profilepic">
HTML;

            // If the request is anonymous then show the anonymous image
            if (empty($v['anon'])) {
                $string .= '<fb:profile-pic uid="' . $k . '" size="thumb" linked="true" />';
            } else {
                $string .= '<img src="' . $this->view->assetPath . 'Site/anon.png" width="50" height="50" title="Anonymous" alt="Anonymous" />';
            }

            if (!empty($v['text'])) {
                $text = stripslashes($v['text']);
            } else {
                $text = '';
            }

            $string .=
            <<<HTML
               </div>

               <div class="wallkit_postcontent">

                <h4>{$v['title']}</h4>
                {$text}
HTML;

            // If links are present then render these
            if (!empty($v['links'])) {

                $string .= '<div class="wallkit_actionset">';
                $links   = '';

                // Loop through the links array and generate wall action links
                foreach ($v['links'] as $link) {
                    $links .= '<a href="' . $link['url'] . '">' . $link['text'] . '</a> - ';
                }

                $string .= rtrim($links, ' - ') . '</div>';
            }

            $string .= '</div></div>';
        }

        $string .= '</div>';

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