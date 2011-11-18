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
 * // Google Search
 * echo $this->google_Search();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Google_Search
{

    /**
     * The Publisher ID
     *
     * @var string
     */
    protected $client = false;

    /**
     * Method to generate the needed google code for the required search box
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function google_Search($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge(get_class_vars(__CLASS__), $params);

        // Config
        $config = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('google');

        $string = <<<HTML

            <form action="{$config['Search']}" id="cse-search-box">
              <div>
                <input type="hidden" name="cx" value="{$config['Cx']}" />
                <input type="hidden" name="cof" value="FORID:9" />
                <input type="hidden" name="ie" value="ISO-8859-1" />
                <input type="text" name="q" size="30" />
                <input type="submit" name="sa" value="Search" />
              </div>
            </form>
            <script type="text/javascript" src="http://www.google.co.uk/cse/brand?form=cse-search-box&amp;lang=en"></script>
HTML;

        return $string;
    }

}
