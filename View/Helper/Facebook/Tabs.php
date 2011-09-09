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

// {{{ CodeBlender_View_Helper_Facebook_Tabs()

/**
 * Helper class to display a Facebook tabs used to hide and display content.
 * Showing/hiding of the tabs themselves is handled by the helper, but
 * you can specify additional html element IDs to be shown/hidden, as well as
 * any javascript to run on the onclick event when the tab is selected.
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Facebook
 * @copyright  Copyright (c) 2000-2009 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 *
 * @todo Fix up the properties
 */
class CodeBlender_View_Helper_Facebook_Tabs
{
    // {{{ properties

    /**
     * Explanation of parameters
     * This default can serve as an example of how to lay out parameters
     * label: label of the tab
     * onclick: javascript to be executed on click
     * clicktoshow: any IDs of additional elements to show (CSV)
     * clicktohide: any IDs of additional elements to hide (CSV)
     *
     * It is your responsibility to ensure these are correct and don't clash
     * with any of your tab IDs etc. Also take care to escape your onclick JS
     * correctly if you are using quotes in it.
     */
    private $default_tab = array('label'       => 'Home',
                                 'onclick'     => 'return false;',
                                 'clicktoshow' => '',
                                 'clicktohide' => '');

    /**
     * Your params array needs to have the left tabs before the right tabs
     * in the array if both are present.
     */
   /* private $defaults = array(
        'left'  => array(
                    'unique_id1' => $default_tab
                  ),
        'right' => array(
                    'unique_id2' => $default_tab
                   )
    );*/



    // }}}
    // {{{ facebook_Tabs()

    /**
     * Method to get a set of dynamic Facebook tabs
     *
     * @param  array  $params Array of attribute values
     * @param  string $selected unique_id of tab to be selected initially
     * @return string
     *
     */
    public function facebook_Tabs($params, $selected)
    {
        // Merge the two arrays to overwrite default values.
        //$params = array_merge($this->defaults, $params);

        $string = '';

        if (!empty($params)) {

        // Create the html string
        $string = '<div class="tabs clearfix">
                       <center>';

            foreach ($params as $tabs) {
                foreach ($tabs as $tab_id => $details) {
                    $selected_ids[] = $tab_id.'_s';
                    $unselected_ids[] = $tab_id;
                }
            }

            //loop over left/right aligned sets of tabs
            foreach ($params as $align => $tabs) {
                $string .= "
                <div class='${align}_tabs'>
                    <ul id='toggle_tabs_unused' class='toggle_tabs clearfix'>";

                $count = 0;
                //loop over set of tabs
                foreach ($tabs as $tab_id => $details) {
                    if ($count == 0) {
                        $string .= '<li class="first">';
                    } else {
                        $string .= '<li>';
                    }

                    /**
                     * Both selected and unselected tabs are present but are
                     * set to hidden and revealed as necessary.
                     */

                    //SELECTED TAB
                    $string .= "<a id='${tab_id}_s' class='selected' ";
                    if($selected != $tab_id) {
                        $string .= 'style="display: none;" ';
                    }
                    $string .= '>' . $details['label'] . '</a>';

                    //UNSELECTED TAB
                    $string .= "<a id='${tab_id}' ";
                    if ($selected == $tab_id) {
                        $string .= 'style="display: none;" ';
                    }

                    //add onclick JS if present
                    if (!empty($details['onclick'])) {
                        $string .= 'onclick="' . $details['onclick'] . '" ';
                    }

                    //clicktoshow
                    $csv = $tab_id.'_s,';
                    foreach ($unselected_ids as $id) {
                        if ($id != $tab_id) {
                            $csv .= $id . ',';
                        }
                    }
                    $csv = rtrim($csv, ','); //trim trailing comma
                    //add additional clicktoshows if present
                    if (!empty($details['clicktoshow'])) {
                        $csv .= ','.$details['clicktoshow'];
                    }
                    $string .= "clicktoshow='$csv' ";

                    //clicktohide
                    $csv = $tab_id . ',';
                    foreach ($selected_ids as $id) {
                        if ($id != $tab_id.'_s') {
                            $csv .= $id . ',';
                        }
                    }
                    $csv = rtrim($csv, ','); //trim trailing comma
                    //add additional clicktohides if present
                    if (!empty($details['clicktohide'])) {
                        $csv .= ','.$details['clicktohide'];
                    }
                    $string .= "clicktohide='$csv' ";
                    //label
                    $string .= '>' . $details['label'] . '</a></li>';
                    $count++;
                }

            $string .= '</ul>
                      </div>';
            }

            $string .= '</center>
                    </div>';

        }
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