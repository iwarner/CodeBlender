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
 * A View calls this View Helper to output the AJAX Rating element. This Helper
 * will automatically appened the Javascript and CSS needed to make this work.
 *
 * This Helper requires two database models Rating and RatingUser.
 *
 * The rating system is done Via Facebook AJAX, it requires the Rating module to
 * be activated in the config file of the site:
 * modules.rating = modules/rating/controllers
 *
 * <code>
 * {$this->Rating(array('class' => 'userVote', 'ratingID' => 1, 'text' => 'Your Rating', 'type' => 'user'))}
 * {$this->Rating(array('class' => 'avgVote',  'ratingID' => 1, 'static' => true, 'text' => 'Avg Rating'))}
 * </code>
 *
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 * @see        http://masugadesign.com/the-lab/scripts/unobtrusive-ajax-star-rating-bar/
 */
class CodeBlender_View_Helper_Rating extends Zend_View_Helper_Abstract
{

    /**
     * Vars to set the defaults for the Rating element
     */
    private $defaults = array(
        'class' => '', // String Extra class wrapper to position absolutely
        'ratingID' => 1, // Int    Unique ID of the rating element
        'static' => false, // Bool   Whether the user can vote or not
        'text' => 'Rating', // String What text to add
        'type' => 'site', // String Flag to say whether the rating box is to show site votes or user only ('site' 'user' default 'site')
        'units' => 5, // Int    How many stars to show
        'unitWidth' => 30, // Int    Width of these stars
    );

    /**
     * Method to display a rating system.
     *
     * @param  array  $params Array of attribute values
     * @return string
     */
    public function Rating($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $params = array_merge($this->defaults, $params);

        // Set up the variable to hold the output
        $string = '';

        // Invoke the config argument
        $this->config = Zend_Registry::get('config');

        // If this element is to just show the user's vote then get the data
        if ($params['type'] == 'user') {

            // Query to get Users Rating for this element
            $class = $this->config->path->models . 'RatingUser';
            $table = new $class();
            $where = array('user_id = ?' => $this->view->userID, 'rating_id = ?' => $params['ratingID']);
            $row = $table->fetchRow($where);

            // How many votes total
            $votes = $count = 1;
            $currentRating = $row->rating;
        } else {

            // Query to get Rating, Value for the current rating element
            $class = $this->config->path->models . 'Game';
            $table = new $class();
            $result = $table->find($params['ratingID']);
            $row = $result->current();

            // Insert the ID in the DB if it doesn't exist already
            if (count($row) < 1) {
                $data = array('id' => $params['ratingID']);
                $table->insert($data);
            }

            // Determine the amount of votes there are for this rating element
            if (empty($row->total_rating) || $row->total_rating < 1) {
                $count = 1;
                $votes = 0;
                $currentRating = 0;
            } else {

                // How many votes total
                $votes = $count = $row->total_rating;
                $currentRating = $row->total_value;
            }
        }

        // Plural form votes / vote
        $tense = ($count == 1) ? 'vote' : 'votes';

        // Draw the rating bar
        $ratingWidth = number_format($currentRating / $count, 2) * $params['unitWidth'];
        $rating1 = number_format($currentRating / $count, 1);
        $rating2 = number_format($currentRating / $count, 2);

        // Get the width of each unit
        $width = $params['unitWidth'] * $params['units'];

        // Append the Facebook AJAX Javascript file
        self::appendFile();

        // Append the HTML onto the output variable
        $string .=
            <<<HTML
          <div class="{$params['class']}">
          <div id="unit_long{$params['class']}" class="ratingBlock">
HTML;

        // If this is static block then don't allow the rating to be updated.
        if ($params['static']) {

            $string .=
                <<<HTML

                <ul id="unit_ul{$params['ratingID']}" class="unit-rating" style="width:{$width}px;">
                 <li class="current-rating" style="width: {$ratingWidth}px;">Currently {$rating2} / {$params['units']}</li>
                </ul>

                <p class="static">{$params['text']}: <b>{$rating1}</b> ({$count} {$tense})</p>
HTML;

            // If not static then the user can vote if they have not done so already.
        } else {

            // Loop from 1 to the number of units / stars
            $stars = '';

            for ($i = 1; $i <= $params['units']; $i++) {

                // If the user hasn't yet voted, draw the voting stars and allow the vote
                if (!$voted) {

                    // Create the Stars and AJAX link
                    $stars .=
                        <<<HTML
                     <li>
                      <a href="#"
                        onclick="ajaxAction(
                          'unit_long{$params['class']}',
                          '{$this->config->fb->appCallBack}rating/index/index/ajax/true/',
                          'fb_sig_user/{$this->view->userID}/vote/{$i}/ratingID/{$params['ratingID']}/units/{$params['units']}',
                          Ajax.JSON
                         ); return false;"
                        title="{$i} out of {$params['units']}" class="r{$i}-unit rater" rel="nofollow">
                       {$i}
                      </a>
                     </li>
HTML;
                }
            }

            // If the user has voted change the class to voted
            if ($voted) {
                $class = 'class="voted"';
            } else {
                $class = '';
            }

            $string .=
                <<<HTML
              <ul id="unit_ul{$params['ratingID']}" class="unit-rating" style="width:{$width}px;">
               <li class="current-rating" style="width: {$ratingWidth}px;">Currently {$rating2} / {$params['units']}</li>
               {$stars}
              </ul>

              <p {$class}>{$params['text']}: <b>{$rating1}</b> ({$votes} {$tense})</p>
HTML;
        }

        $string .=
            <<<HTML
           </div>
          </div>
HTML;

        return $string;
    }

    /**
     * appends a CSS or JS file to the page header
     *
     * @param  string $fileRevision[optional]
     * @return bool
     */
    private function appendFile($fileRevision = 'v1.00')
    {
        $filename = $this->config->fb->appCallBack . 'themes/facebook/javascript/faceBookAJAX.js?' . $fileRevision . time();
        $this->view->headScript()->appendFile($filename);
    }

}
