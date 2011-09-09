<?php
/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Helpers
 * @copyright Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Helper class to display the Get Satisfaction Display Code
 *
 * All the config elements are run from the main config file
 *
 * <code>
 * // Include the Get Satisfaction Feedback Element
 * $this->feedBack_GetSatisfaction();
 * </code>
 *
 * @category  CodeBlender
 * @package   Helpers
 * @copyright Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 * @see       http://getsatisfaction.com
 */
class CodeBlender_View_Helper_GetSatisfaction
{
    /**
     * Method to render the Get Satisfaction Feedback Tab.
     *
     * @return string
     */
    public function getSatisfaction()
    {
        // Invoke the Config
        $config = Zend_Registry::get('config');

        // Check to see if a product is set.
        if ($config->getSatisfaction->product) {
            $product = '&amp;product=' . $config->getSatisfaction->name;
        } else {
            $product = '';
        }

        // Create the analytics tracking code
        $string =
        <<<HTML
          <style type='text/css'>@import url('http://s3.amazonaws.com/getsatisfaction.com/feedback/feedback.css');</style>
          <script type='text/javascript' src='http://s3.amazonaws.com/getsatisfaction.com/feedback/feedback.js'></script>

          <script type="text/javascript" charset="utf-8">
           var tab_options       = {}
           tab_options.placement = "{$config->getSatisfaction->placement}";
           tab_options.color     = "#{$config->getSatisfaction->color}";
           GSFN.feedback('http://getsatisfaction.com/{$config->getSatisfaction->name}/feedback/topics/new?display=overlay{$product}&amp;style={$config->getSatisfaction->tab}', tab_options);
          </script>
HTML;

        return $string;
    }
}
