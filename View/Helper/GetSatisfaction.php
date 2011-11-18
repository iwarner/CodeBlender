<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Helper
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Helper
 *
 * Config Options
 *
 * getSatisfaction.color = ""
 * getSatisfaction.name = ""
 * getSatisfaction.placement = ""
 * getSatisfaction.product = ""
 * getSatisfaction.tab = ""
 *
 * <code>
 * // Get Satisfaction
 * echo $this->feedBack_GetSatisfaction();
 * </code>
 *
 * @category  CodeBlender
 * @package   Helper
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 * @see       http://getsatisfaction.com/explore/widgets
 */
class CodeBlender_View_Helper_GetSatisfaction extends Zend_View_Helper_Abstract
{

    /**
     * getSatisfaction
     */
    public function getSatisfaction()
    {
        // Config
        $config = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('getSatisfaction');

        // Product
        if ($config['product']) {
            $product = '&amp;product=' . $config['name'];
        } else {
            $product = '';
        }

        $string =
            <<<HTML
            <style type='text/css'>
                @import url('http://s3.amazonaws.com/getsatisfaction.com/feedback/feedback.css');
            </style>

            <script type='text/javascript' src='http://s3.amazonaws.com/getsatisfaction.com/feedback/feedback.js'></script>

            <script type="text/javascript" charset="utf-8">
                var tab_options       = {}
                tab_options.placement = "{$config['placement']}";
                tab_options.color     = "#{$config['color']}";
                GSFN.feedback('http://getsatisfaction.com/{$config['name']}/feedback/topics/new?display=overlay{$product}&amp;style={$config['tab']}', tab_options);
            </script>
HTML;

        return $string;
    }

}
