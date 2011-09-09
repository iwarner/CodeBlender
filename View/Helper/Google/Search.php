<?php
/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Google
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Google Search
 *
 * <code>
 * // Include the Google Search
 * $this->google_Search();
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Google
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
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

        // Invoke the config
        $config = Zend_Registry::get('config');

        $string = <<<HTML

            <form action="{$config->google->Search}" id="cse-search-box">
              <div>
                <input type="hidden" name="cx" value="{$config->google->Cx}" />
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
