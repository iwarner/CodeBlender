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
 * // Plus Button
 * echo $this->google_PlusButton();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://www.google.com/webmasters/+1/button/
 */
class CodeBlender_View_Helper_Google_PlusButton extends Zend_View_Helper_Abstract
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
     *
     * Blank URL will mean the widget will use the current page, including paramaters.
     */
    protected $URL = '';

    /**
     * Via User
     */
    protected $via = false;

    /**
     * Tweet Button
     */
    public function google_PlusButton($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        $string = <<<HTML

            <script type='text/javascript'>
              window.___gcfg = {lang: 'en-GB'};

              (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
              })();
            </script>

            <!-- Place this tag where you want the +1 button to render -->
            <g:plusone size='small' count='false' href='http://www.zxclasses.com'></g:plusone>

HTML;

        return $string;
    }

}
