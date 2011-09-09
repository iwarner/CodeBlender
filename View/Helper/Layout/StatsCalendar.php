<?php
/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Layout
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Component for calendar
 *
 * @category   CodeBlender
 * @package    Helpers
 * @subpackage Layout
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Layout_StatsCalendar extends Zend_View_Helper_Abstract
{
    /**
     * Method to provide a PHP calendar for various uses within the site.
     *
     * <code>
     * $calendar = Calendar_StatsCalendar::Calendar();
     *
     * // Process the text to view element
     * echo $text = $calendar['string'];
     * </code>
     *
     * @param  string $path
     * @return array        HTML output and other elements.
     */
    public function layout_StatsCalendar($path, $ajaxDIV = 'calendar1')
    {
        $now_year     = date('Y');
        $now_month    = date('m');
        $now_day      = date('d');
        $now_year_to  = date('Y');
        $now_month_to = date('m');
        $now_day_to   = date('d');
        $string       = '';

        // Process the GET variables.
        if (!isset($_GET['y'])) $year  = $now_year;  else $year  = $_GET['y'];
        if (!isset($_GET['m'])) $month = $now_month; else $month = $_GET['m'];
        if (!isset($_GET['d'])) $day   = $now_day;   else $day   = $_GET['d'];

        if (!isset($_GET['y_range']))    $y_range    = $now_year;  else $now_year     = $_GET['y_range'];
        if (!isset($_GET['m_range']))    $m_range    = $now_month; else $now_month    = $_GET['m_range'];
        if (!isset($_GET['d_range']))    $d_range    = $now_day;   else $now_day      = $_GET['d_range'];
        if (!isset($_GET['y_range_to'])) $y_range_to = $now_year;  else $now_year_to  = $_GET['y_range_to'];
        if (!isset($_GET['m_range_to'])) $m_range_to = $now_month; else $now_month_to = $_GET['m_range_to'];
        if (!isset($_GET['d_range_to'])) $d_range_to = $now_day;   else $now_day_to   = $_GET['d_range_to'];

        // Build the month
        $Calendar = new Calendar_Month_Weekdays($year, $month);
        // $Decorator = new Calendar_DataEvent();

        // Build an array of the month names to be used in the calendar.
        $array_months = array(
          1 => 'January', 2 => 'February', 3 => 'March',      4 => 'April',    5 => 'May',       6 => 'June',
          7 => 'July',    8 => 'August',   9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');

        // Create the path to the page in question.
        $ajaxPath = $path . '/ajax/true/';

        // Construct strings for next/previous links
        $PMonth = $Calendar->prevMonth('object');

        $prev = $ajaxPath . '?y=' . $PMonth->thisYear() . '&m=' .
          $PMonth->thisMonth() . '&d=' . $PMonth->thisDay();

        $NMonth = $Calendar->nextMonth('object');

        $next = $ajaxPath . '?y=' . $NMonth->thisYear() . '&m=' .
          $NMonth->thisMonth() . '&d=' . $NMonth->thisDay();

        // Construct links for the current and todays months
        $current = $path . '?y=' . $Calendar->thisYear() . '&m=' .
          $Calendar->thisMonth(). '&show_month';

        $today = $ajaxPath . '?y=' . $now_year . '&m=' .
          $now_month . '&d=' . $now_day;

        // Build the list of selected days.
        $selectedDays = array(new Calendar_Day($year, $month, $day));

        // Build the days in the month
        $Calendar->build($selectedDays);

        // Build the string for the actual calendar display.
        $string .= '
          <div id="calendar1">
          <div class="calendar">';

        // Produce the range selection element
        $string .= '
          <form action="' . $path . '" method="GET">
            From:
            <select name="d_range">
             ' . self::getDateOptions($now_day) . '
            </select>
            <select name="m_range">
             ' . self::getDateOptions($now_month, 1, 13) . '
            </select>
            <select name="y_range">
             ' . self::getDateOptions($now_year, date('Y'), date('Y') + 2) . '
            </select>
            To:
            <select name="d_range_to">
             ' . self::getDateOptions($now_day_to) . '
            </select>
            <select name="m_range_to">
             ' . self::getDateOptions($now_month_to, 1, 13) . '
            </select>
            <select name="y_range_to">
             ' . self::getDateOptions($now_year_to, date('Y'), date('Y') + 2) . '
            </select>
            <input type="submit" value="Submit" />
          </form><br />';

        $string .= '
          <form id="form_id" name="form_name" action="' . $path . '" method="GET"
            onsubmit="new Ajax.Updater(\'' . $ajaxDIV . '\', \'' . $ajaxPath . '\', {method:\'get\', asynchronous:true, parameters:Form.serialize(this)}); return false;">
          <table summary="Calendar">
           <tr>
            <td class="month" colspan="2">
             <a href="' . $current . '" title="Month View">' . date('F Y', $Calendar->getTimeStamp()) . '</a></td>
            <td class="month" colspan="5">
             <input type="button" value="Today" onclick="new getAjax(\'' . $ajaxDIV . '\', \'' . $today . '\'); return false;" />
             <select name="m">
               ' . self::getDateOptions($now_month, 1, 13) . '
             </select>
             <select name="y">
               ' . self::getDateOptions($now_year, date('Y'), date('Y') + 2) . '
             </select>
             <input type="submit" value="Go" />
             <input type="button" value="&lt;&lt;" onclick="new getAjax(\'' . $ajaxDIV . '\', \'' . $prev . '\'); return false;" />
             <input type="button" value="&gt;&gt;" onclick="new getAjax(\'' . $ajaxDIV . '\', \'' . $next . '\'); return false;" />
            </td>
           </tr>
           <tr>
            <th class="weekdays">Mon</th>
            <th class="weekdays">Tue</th>
            <th class="weekdays">Wed</th>
            <th class="weekdays">Thu</th>
            <th class="weekdays">Fri</th>
            <th class="weekdays">Sat</th>
            <th class="weekdays">Sun</th>
           </tr>';

        while ($Day = $Calendar->fetch()) {

            // Build a link string for each day
            $link = $path .
              '?y=' . $Day->thisYear() .
              '&m=' . $Day->thisMonth() .
              '&d=' . $Day->thisDay();

            // isFirst() to find start of week
            if ($Day->isFirst()) {
                $string .= '<tr>';
                $return['month_start'] = $Day->thisMonth(true);
            }

            if ($Day->isSelected()) {
               $string .= '<td class="selected">' . $Day->thisDay() . '</td>';
               $return['day'] = $Day->thisDay(true);
            } elseif ($Day->isEmpty()) {
                $string .= '<td class="empty">&nbsp;</td>';
            } else {
                $string .= '<td class="day"><a href="' . $link . '"
                  title="Day View">' . $Day->thisDay() . '</a></td>';
            }

            // isLast() to find end of week
            if ($Day->isLast()) {
                $string .= '</tr>';
                $return['month_end'] = $Day->thisMonth(true);
            }
        }

        $string .= '
            </table>
            </form>
           </div>
          </div>';

        $return['string'] = $string;

        return $return;
    }

    /**
     * Method to provide some of the date selections for the calendar pull downs
     *
     * <code>
     * $options = self::_getDateOptions();
     * </code>
     *
     * @param  int     $selected
     * @param  int     $start
     * @param  int     $end
     * @return array             HTML select options string.
     */
    public function getDateOptions($selected = null, $start = 1, $end = 32)
    {
        $options = '';

        // Check to see if the start is higher than the end if so then make --
        if ($start > $end) {

            // Loop through the given start and finish elements.
            for ($i = $start; $i >= $end; $i--) {

                $options .= '<option value="' . $i . '"';

                if (isset($selected) && $selected == $i) {
                    $options .= ' selected="selected" ';
                }

                // Need options to show the number as another date format.
                $options .= '>' . $i . '</options>';
            }

        } else {

            // Loop through the given start and finish elements.
            for ($i = $start; $i <= $end; $i++) {

                $options .= '<option value="' . $i . '"';

                if (isset($selected) && $selected == $i) {
                    $options .= ' selected="selected" ';
                }

                // Need options to show the number as another date format.
                $options .= '>' . $i . '</options>';
            }
        }

        return $options;
    }
}
