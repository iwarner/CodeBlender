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

// {{{ CodeBlender_View_Helper_Facebook_Dashboard()

/**
 * Helper class to produce the Facebook Dashboard and Tabs
 *
 * <code>
 * // Invoke the Facebook Dashboard
 * echo $this->facebook_Dashboard('index', array($params));
 * </code>
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 *
 * @todo Seperate out the elements into different classes.
 */
class CodeBlender_View_Helper_Facebook_Dashboard
{
    // {{{ properties

    /**
     * Whether the banner image should be clickable.
     *
     * @var bool
     */
    protected $clickable = false;

    /**
     * Passed in array of navigation elements
     *
     * @var bool
     */
    protected $navigation = false;

    /**
     * Navigation page to highlight the tab
     *
     * @var string
     */
    protected $page = 'index';

    /**
     * Merged paramaters for the class
     *
     * @var string
     */
    protected $params = false;

    /**
     * Flag to show the "Facebook" FB Tabs or "Home" ones
     *
     * @var string
     */
    protected $tabs = 'Home';

    // }}}
    // {{{ facebook_Dashboard()

    /**
     * Method to create the tabs the application requires.
     *
     * @param  string $params Array of attribute values
     * @return string
     *
     * @link http://wiki.developers.facebook.com/index.php/Fb:dashboard
     * @link http://bebo.com/docs/snml/SnDashboardTag.jsp
     */
    public function facebook_Dashboard($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $this->params = array_merge(get_class_vars(__CLASS__), $params);

        $string = '';

        // Check to see if this application requires the Dashboard element
        if (!empty($this->params['navigation']['header'])) {
            $string .= self::createDashboard();
        }

        // Check to see if this application requires navigational tabs
        if (!empty($this->params['navigation']['tabs'])) {
            $className = 'createTabs' . $this->params['tabs'];
            $string   .= self::$className();
        }

        return $string;
    }

    // }}}
    // {{{ createDashboard()

    /**
     * Method to create the facebook dashboard if required
     *
     * @return string
     */
    private function createDashboard()
    {
        $string = '<fb:dashboard>';

        // Loop through the Header Links if they exist
        if (is_array($this->params['navigation']['header'])) {

            // Loop through the Navigation header elements
            foreach ($this->params['navigation']['header'] as $k => $v) {

                // Check to see if the onClick element is present if so add
                if (!empty($v['onClick'])) {
                    $onClick = ' onclick="' . $v['onClick'] . '(); return false;"';
                } else {
                    $onClick = '';
                }

                $string .=
                <<<HTML
                  <fb:action href="{$v['path']}" title="{$k}"{$onClick}>{$k}</fb:action>
HTML;
            }
        }

        // Render the create button if this exists
        if (!empty($this->params['navigation']['create'])) {

            // Check to see if the onClick element is present if so add
            if (!empty($this->params['navigation']['create']['onClick'])) {
                $onClick = ' onclick="' . $this->params['navigation']['create']['onClick'] . '(); return false;"';
            } else {
                $onClick = '';
            }

            $string .=
            <<<HTML
              <fb:create-button href="{$this->params['navigation']['create']['path']}"{$onClick}>
                {$this->params['navigation']['create']['title']}
              </fb:create-button>
HTML;
        }

        // Render the create button if this exists
        if (!empty($this->params['navigation']['help'])) {

            $string .=
            <<<HTML
              <fb:help href="{$this->params['navigation']['help']['path']}">{$this->params['navigation']['help']['title']}</fb:help>
HTML;
        }

        $string .= '</fb:dashboard>';

        return $string;
    }

    // }}}
    // {{{ createTabsFacebook()

    /**
     * Method to create the default Facebook tabs
     *
     * @return string
     */
    private function createTabsFacebook()
    {
        $string = '<fb:tabs>';

        // Loop through the tabs
        foreach ($this->params['navigation']['tabs'] as $k => $v) {

            // If the tab identifier is the same as the page then show selected
            if ($k == $this->params['page']) {
                $selected = 'selected="true"';
            } else {
                $selected = '';
            }

            // If the tab is for the right alignment then do this
            if (!empty($v[2])) {

                if ($v[2] == 'right') {
                    $align = 'align="right"';
                }

            } else {
                $align = 'align="left"';
            }

            // Create the tabs
            $string .= <<<HTML
              <fb:tab-item href="{$v[1]}" title="{$v[0]}" {$selected} {$align} />
HTML;
        }

        $string .= '</fb:tabs>';

        return $string;
    }

    // }}}
    // {{{ createTabsHome()

    /**
     * Method to create the tabs from scratch - i.e. not using the default
     * Facebook tabs. This gives more flexibility in terms of layout and
     * allows a banner image to sit behind the tabs.
     *
     * @return string
     */
    private function createTabsHome()
    {
        // Invoke required registry elements
        $siteName = Zend_Registry::get('siteName');

        // Whether to make the banner clickable
        if ($this->params['clickable']) {
            $clickable = 'onclick="document.setLocation(\'' . $this->params['clickable'] . '\')"';
            $style     = 'cursor: pointer;';
        } else {
            $clickable = '';
            $style     = '';
        }

        // Initiate the string
        $string =
        <<<HTML

          <div class="header_container" {$clickable}>
            <div class="header_spacer">&nbsp;</div>
             <div class="header_tabs">
              <div class="tabs clearfix">
               <center>
                <div class="left_tabs"><ul class="toggle_tabs" id="toggle_tabs_unused">
HTML;

        // Loop through the tabs
        foreach ($this->params['navigation']['tabs'] as $k => $v) {

            // If the tab identifier is the same as the page then show selected
            if ($k == $this->params['page']) {
                $selected = 'class="selected"';
            } else {
                $selected = '';
            }

            // If the tab is for the right alignment then do this
            if (!empty($v[2]) && $v[2] == 'right') {
                $string .= '</ul></div>';
                $string .= '<div class="right_tabs"><ul class="toggle_tabs" id="toggle_tabs_unused">';
            }

            // Add an additional class name to the list
            if (!empty($v[3])) {
                $class = 'class="' . $v[3] . '"';
            } else {
                $class = '';
            }

            // Add an additional class name to the list
            if (!empty($v[4])) {
                $target = 'target="' . $v[4] . '"';
            } else {
                $target = '';
            }

            // Create the tabs
            $string .= '<li ' . $class . '><a href="' . $v[1] . '" title="' . $v[0] . '" ' . $target . ' ' . $selected . '>' . $v[0] . '</a></li>';
        }

        $string .=
        <<<HTML
              </ul></div>
             </center>
            </div>
           </div>
          </div>
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