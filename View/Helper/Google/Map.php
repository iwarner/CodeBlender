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
 * @category   CodeBlender
 * @package    Helper
 * @copyright  Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Google_Map extends Zend_View_Helper_Abstract
{

    /**
     * Message that pops up when the browser is incompatible with Google Maps.
     * Set to empty string to disable.
     *
     * @var string $browser_alert
     */
    public $alert_browser = 'Sorry, the Google Maps API is not compatible with this browser.';

    /**
     * Message when javascript is disabled. Set to empty string to disable.
     *
     * @var string $js_alert
     */
    public $alert_js = '<b>Javascript must be enabled in order to use Google Maps.</b>';

    /**
     * YOUR GooglMap API KEY for your site. (http://maps.google.com/apis/maps/signup.html)
     *
     * @var string $api_key
     */
    public $apiKey = '';

    /**
     * GoogleMapAPI uses the Yahoo geocode lookup API. This is the application
     * ID for YOUR application. This is set upon instantiating the GoogleMapAPI
     * object. (http://developer.yahoo.net/faq/index.html#appid)
     *
     * @var string $app_id
     */
    public $appID = 'gMapID';

    /**
     * If you want to set a boundary for the map then provide a boundary area.
     * This constitutes a NE and a SW point to make up the rectangle at any zoom
     *
     * @var string $boundaryNE
     */
    public $boundaryNE = '51.1492, 0.0273';

    /**
     * If you want to set a boundary for the map then provide a boundary area.
     * This constitutes a NE and a SW point to make up the rectangle at any zoom
     *
     * @var string $boundarySW
     */
    public $boundarySW = '51.1073, -0.0462';

    /**
     * Factor by which to fudge the boundaries so that when we zoom encompass,
     * the markers aren't too close to the edge
     *
     * @var float $bounds_fudge
     */
    public $bounds_fudge = 0.01;

    /**
     * Map center calculated automatically as markers are added to the map.
     *
     * @var float $center_coords
     */
    public $center_coords = '51.127, -0.015';

    /**
     * Determines the map control type small -> show move/center controls
     * large -> show move/center/zoom controls
     *
     * @var string $control_size
     */
    public $control_size = 'small';

    /**
     * Determines if to/from directions are included inside info window
     *
     * @var boolean $directions
     */
    public $directions = false;

    /**
     * @var array $driving_dir_text
     */
    public $driving_dir_text = array(
        'dir_to' => 'Start address: (include addr, city st/region)',
        'to_button_value' => 'Get Directions',
        'to_button_type' => 'submit',
        'dir_from' => 'End address: (include addr, city st/region)',
        'from_button_value' => 'Get Directions',
        'from_button_type' => 'submit',
        'dir_text' => 'Directions: ',
        'dir_tohere' => 'To here',
        'dir_fromhere' => 'From here'
    );

    /**
     * PEAR::DB DSN for geocode caching. example:
     * $dsn = 'mysql://user:pass@localhost/dbname';
     *
     * @var string $dsn
     */
    public $dsn = null;

    /**
     * Determines if map markers bring up an info window
     *
     * @var boolean $info_window
     */
    public $info_window = true;

    /**
     * @var string $lookup_server
     */
    public $lookup_server =
        array('GOOGLE' => 'maps.google.com', 'YAHOO' => 'api.local.yahoo.com');

    /**
     * What server geocode lookups come from
     *
     * YAHOO  Yahoo! API. US geocode lookups only.
     * GOOGLE Google Maps. This can do international lookups, but not an
     *                     official API service so no guarantees.
     *
     * Note: GOOGLE is the default lookup service, please read the Yahoo! terms
     * of service before using their API.
     *
     * @var string $lookup_service service name
     */
    public $lookup_service = 'GOOGLE';

    /**
     * enables map controls (zoom/move/center)
     *
     * @var boolean
     */
    public $map_controls = true;

    /**
     * Determines the map height
     *
     * @var string $map_height
     */
    public $map_height = '600px';

    /**
     * Current map id, set when you instantiate the GoogleMapAPI object.
     *
     * @var string $map_id
     */
    public $map_id = null;

    /**
     * Default map type (G_NORMAL_MAP/G_SATELLITE_MAP/G_HYBRID_MAP)
     *
     * @var string $map_type
     */
    public $map_type = 'G_NORMAL_MAP';

    /**
     * Determines the map width
     *
     * @var string $map_width
     */
    public $map_width = '79%';

    /**
     * Specifies whether the markers can be added with a click.
     *
     * @var boolean $markerClickable
     */
    public $markerClickable = true;

    /**
     * Specifies whether the markers should be draggable or not.
     *
     * @var boolean $markerDraggable
     */
    public $markerDraggable = false;

    /**
     * Use onLoad() to load the map javascript. if enabled, be sure to include
     * on your webpage: <html onload="onLoad()">
     *
     * @var string $onload
     */
    public $onload = true;

    /**
     * Enables overview map control
     *
     * @var boolean $overview_control
     */
    public $overview_control = false;

    /**
     * Enables scale map control
     *
     * @var boolean $scale_control
     */
    public $scale_control = true;

    /**
     * Determines if sidebar is enabled
     *
     * @var boolean $sidebar
     */
    public $sidebar = true;

    /**
     * sidebar <div> used along with this map.
     *
     * @var string $sidebar_id
     */
    public $sidebar_id = null;

    /**
     * Use the first suggestion by a google lookup if exact match not found
     *
     * @var float $use_suggest
     */
    public $type_controls = true;

    /**
     * Use the first suggestion by a google lookup if exact match not found
     *
     * @var float $use_suggest
     */
    public $use_suggest = false;

    /**
     * Determines if info window appears with a click or mouseover
     *
     * @var string $window_trigger click/mouseover
     */
    public $window_trigger = 'click';

    /**
     * Determines the default zoom level
     *
     * @var integer $zoom
     */
    public $zoom = 14;

    /**
     * Determines if we should zoom to minimum level (above this->zoom value)
     * that will encompass all markers
     *
     * @var boolean $zoom_encompass
     */
    public $zoom_encompass = true;

    /**
     * Determines the maximum zoom level
     *
     * @var integer $zoom_max
     */
    public $zoom_max = 17;

    /**
     * Determines the minimum zoom level
     *
     * @var integer $zoom_min
     */
    public $zoom_min = 13;

    /**
     * Database cache table name
     *
     * @var string $_db_cache_table
     */
    public $_db_cache_table = 'GEOCODES';

    /**
     * Icon info array
     *
     * @var array $_icons
     */
    public $_icons = array();

    /**
     * List of added markers
     *
     * @var array $_markers
     */
    public $_markers = array();

    /**
     * Max latitude $_max_lat
     *
     * @var float $_max_lat
     */
    public $_max_lat = -1000000;

    /**
     * Maximum longitude of all markers
     *
     * @var float $_max_lon
     */
    public $_max_lon = -1000000;

    /**
     * Min latitude
     *
     * @var float $_min_lat
     */
    public $_min_lat = 1000000;

    /**
     * Minimum longitude of all markers
     *
     * @var float $_min_lon
     */
    public $_min_lon = 1000000;

    /**
     * Array of added polylines
     *
     * @var array $_polylines
     */
    public $_polylines = array();

    /**
     * Version number
     *
     * @var string $_version
     */
    public $_version = 2;

    /**
     * Class constructor
     *
     * @param  string $map_id The id for this map
     * @param  string $app_id Your provider App ID
     * @return void
     */
    public function google_Map($mapID = 'gMap', $appID)
    {
        $this->mapID = $mapID;
        $this->sidebarID = 'sidebar_' . $mapID;
        $this->appID = $appID;
    }

    /**
     * Adds a map marker by address
     *
     * @param  string $address The map address to mark (street/city/state/zip)
     * @param  string $title   The title display in the sidebar
     * @param  string $html    The HTML block to display in the info bubble.
     * @return mixed
     */
    public function addMarkerByAddress($address, $title = '', $html = '')
    {
        if (($_geocode = $this->getGeocode($address)) === false) {
            return false;
        }

        return $this->addMarkerByCoords($_geocode['lon'], $_geocode['lat'], $title, $html);
    }

    /**
     * Adds a map marker by geocode
     *
     * @param  string $lon   The map longitude (horizontal)
     * @param  string $lat   The map latitude (vertical)
     * @param  string $title The title display in the sidebar
     * @param  mixed  $html  The HTML block to display in the info bubble, if
     *                       empty, title is used, if array then tabs are created
     * @return int           Count of markers generated
     */
    public function addMarkerByCoords($lon, $lat, $title = '', $html = '')
    {
        $_marker['lon'] = $lon;
        $_marker['lat'] = $lat;
        $_marker['html'] = (is_array($html) || strlen($html) > 0) ? $html : $title;
        $_marker['title'] = $title;

        $this->_markers[] = $_marker;
        $this->adjustCenterCoords($_marker['lon'], $_marker['lat']);

        return count($this->_markers) - 1;
    }

    /**
     * Adds a map polyline by address if color, weight and opacity are not
     * defined, use the google maps defaults
     *
     * @param  string $address1 The map address to draw from
     * @param  string $address2 The map address to draw to
     * @param  string $color    The color of the line (format: #000000)
     * @param  string $weight   The weight of the line in pixels
     * @param  string $opacity  The line opacity (percentage)
     * @return mixed
     */
    public function addPolyLineByAddress($address1, $address2, $color = '', $weight = 0, $opacity = 0)
    {
        if (($_geocode1 = $this->getGeocode($address1)) === false) {
            return false;
        }

        if (($_geocode2 = $this->getGeocode($address2)) === false) {
            return false;
        }

        return $this->addPolyLineByCoords($_geocode1['lon'], $_geocode1['lat'], $_geocode2['lon'], $_geocode2['lat'], $color, $weight, $opacity);
    }

    /**
     * Adds a map polyline by map coordinates if color, weight and opacity are
     * not defined, use the google maps defaults
     *
     * @param  string $lon1    The map longitude to draw from
     * @param  string $lat1    The map latitude to draw from
     * @param  string $lon2    The map longitude to draw to
     * @param  string $lat2    The map latitude to draw to
     * @param  string $adjust  Whether to adjust the center to include polylines
     * @param  string $color   The color of the line (format: #000000)
     * @param  string $weight  The weight of the line in pixels
     * @param  string $opacity The line opacity (percentage)
     * @return int
     */
    public function addPolyLineByCoords($lon1, $lat1, $lon2, $lat2, $adjust = false, $color = '#FF0000', $weight = 3, $opacity = 40)
    {
        $_polyline['lon1'] = $lon1;
        $_polyline['lat1'] = $lat1;
        $_polyline['lon2'] = $lon2;
        $_polyline['lat2'] = $lat2;
        $_polyline['color'] = $color;
        $_polyline['weight'] = $weight;
        $_polyline['opacity'] = $opacity;

        $this->_polylines[] = $_polyline;

        if ($adjust) {
            $this->adjustCenterCoords($_polyline['lon1'], $_polyline['lat1']);
            $this->adjustCenterCoords($_polyline['lon2'], $_polyline['lat2']);
        }

        return count($this->_polylines) - 1;
    }

    /**
     * Adjust map center coordinates by the given lat/lon point
     *
     * @param  string $lon The map latitude (horizontal)
     * @param  string $lat The map latitude (vertical)
     * @return boolean
     */
    public function adjustCenterCoords($lon, $lat)
    {
        if (strlen((string) $lon) == 0 || strlen((string) $lat) == 0) {
            return false;
        }

        $this->_max_lon = (float) max($lon, $this->_max_lon);
        $this->_min_lon = (float) min($lon, $this->_min_lon);
        $this->_max_lat = (float) max($lat, $this->_max_lat);
        $this->_min_lat = (float) min($lat, $this->_min_lat);

        $this->center_lon = (float) ($this->_min_lon + $this->_max_lon) / 2;
        $this->center_lat = (float) ($this->_min_lat + $this->_max_lat) / 2;

        return true;
    }

    /**
     * Generate an array of params for a new marker icon image iconShadowImage
     * is optional If anchor coords are not supplied, we use the center point of
     * the image by default. Can be called statically. For private use by
     * addMarkerIcon() and setMarkerIcon()
     *
     * @param  string $iconImage         URL to icon image
     * @param  string $iconShadowImage   URL to shadow image
     * @param  string $iconAnchorX       X coordinate for icon anchor point
     * @param  string $iconAnchorY       Y coordinate for icon anchor point
     * @param  string $infoWindowAnchorX X coordinate for info window anchor point
     * @param  string $infoWindowAnchorY Y coordinate for info window anchor point
     * @return string
     */
    public function createMarkerIcon($iconImage, $iconShadowImage = '', $iconAnchorX = 'x', $iconAnchorY = 'x', $infoWindowAnchorX = 'x', $infoWindowAnchorY = 'x')
    {
        $_icon_image_path = strpos($iconImage, 'http') === 0 ? $iconImage : $_SERVER['DOCUMENT_ROOT'] . $iconImage;

        if (!($_image_info = @getimagesize($_icon_image_path))) {
            die('GoogleMapAPI:createMarkerIcon: Error reading image: ' . $iconImage);
        }

        if ($iconShadowImage) {
            $_shadow_image_path = strpos($iconShadowImage, 'http') === 0 ? $iconShadowImage : $_SERVER['DOCUMENT_ROOT'] . $iconShadowImage;

            if (!($_shadow_info = @getimagesize($_shadow_image_path))) {
                die('GoogleMapAPI:createMarkerIcon: Error reading image: ' . $iconShadowImage);
            }
        }

        if ($iconAnchorX === 'x') {
            $iconAnchorX = (int) ($_image_info[0] / 2);
        }

        if ($iconAnchorY === 'x') {
            $iconAnchorY = (int) ($_image_info[1] / 2);
        }

        if ($infoWindowAnchorX === 'x') {
            $infoWindowAnchorX = (int) ($_image_info[0] / 2);
        }

        if ($infoWindowAnchorY === 'x') {
            $infoWindowAnchorY = (int) ($_image_info[1] / 2);
        }

        $icon_info = array(
            'image' => $iconImage,
            'iconWidth' => $_image_info[0],
            'iconHeight' => $_image_info[1],
            'iconAnchorX' => $iconAnchorX,
            'iconAnchorY' => $iconAnchorY,
            'infoWindowAnchorX' => $infoWindowAnchorX,
            'infoWindowAnchorY' => $infoWindowAnchorY
        );

        if ($iconShadowImage) {
            $icon_info = array_merge($icon_info, array('shadow' => $iconShadowImage, 'shadowWidth' => $_shadow_info[0],
                'shadowHeight' => $_shadow_info[1]));
        }

        return $icon_info;
    }

    /**
     * Add an icon to go with the correspondingly added marker
     *
     * @param  string $iconImage         URL to icon image
     * @param  string $iconShadowImage   URL to shadow image
     * @param  string $iconAnchorX       X coordinate for icon anchor point
     * @param  string $iconAnchorY       Y coordinate for icon anchor point
     * @param  string $infoWindowAnchorX X coordinate for info window anchor point
     * @param  string $infoWindowAnchorY Y coordinate for info window anchor point
     * @return int
     */
    public function addMarkerIcon($iconImage, $iconShadowImage = '', $iconAnchorX = 'x', $iconAnchorY = 'x', $infoWindowAnchorX = 'x', $infoWindowAnchorY = 'x')
    {
        $this->_icons[] = $this->createMarkerIcon($iconImage, $iconShadowImage, $iconAnchorX, $iconAnchorY, $infoWindowAnchorX, $infoWindowAnchorY);

        return count($this->_icons) - 1;
    }

    /**
     * Return map header JavaScript (goes between <head></head>) tag.
     *
     * @param  boolean $source Return source only
     * @return string  $string
     */
    public function getHeaderJS($source = false)
    {
        if (empty($source)) {
            $string = '<script type="text/javascript" src="http://maps.google.com/maps?file=api&v=' . $this->_version . '&key=' . $this->api_key . '" >';
            $string .= '/* <![CDATA[ */ /* ]]> */</script>';
        } else {
            $string = 'http://maps.google.com/maps?file=api&v=' . $this->_version . '&key=' . $this->api_key;
        }

        return $string;
    }

    /**
     * Return JavaScript to set onload function
     *
     * @return string
     */
    public function getOnLoad()
    {
        return '<script type="text/javascript">//<![CDATA[window.onload=onLoad;//]]></script>';
    }

    /**
     * Return map JavaScript
     *
     * @return string
     */
    public function getMapJS()
    {
        $_output = '
          <script type="text/javascript">
          /* <![CDATA[ */
           var points  = [];
           var markers = [];
           var counter = 0;';

        if ($this->sidebar) {
            $_output .= '
              var sidebar_html = "";
              var marker_html  = [];';
        }

        if ($this->directions) {
            $_output .= '
              var to_htmls   = [];
              var from_htmls = [];';
        }

        if (!empty($this->_icons)) {

            $_output .= 'var icon = [];';

            $exist_icn = array();

            for ($i = 0; $this->_icons[$i]; $i++) {

                $info = $this->_icons[$i];

                // Hash the icon data to see if we've already got this one; if
                // so, save some javascript
                $icon_key = md5(serialize($info));

                if (!is_numeric($exist_icn[$icon_key])) {

                    $exist_icn[$icon_key] = $i;
                    $_output .= "icon[$i] = new GIcon();";
                    $_output .= sprintf('icon[%s].image = "%s";', $i, $info['image']);

                    if ($info['shadow']) {
                        $_output .= sprintf('icon[%s].shadow = "%s";', $i, $info['shadow']);
                        $_output .= sprintf('icon[%s].shadowSize = new GSize(%s, %s);', $i, $info['shadowWidth'], $info['shadowHeight']);
                    }

                    $_output .= sprintf('icon[%s].iconSize = new GSize(%s,%s);', $i, $info['iconWidth'], $info['iconHeight']);
                    $_output .= sprintf('icon[%s].iconAnchor = new GPoint(%s,%s);', $i, $info['iconAnchorX'], $info['iconAnchorY']);
                    $_output .= sprintf('icon[%s].infoWindowAnchor = new GPoint(%s,%s);', $i, $info['infoWindowAnchorX'], $info['infoWindowAnchorY']);
                } else {
                    $_output .= "icon[$i] = icon[$exist_icn[$icon_key]];";
                }
            }
        }

        $_output .= 'var map = null;';

        if ($this->onload) {
            $_output .= 'function onLoad() {';
        }

        if (!empty($this->alert_browser)) {
            $_output .= 'if (GBrowserIsCompatible()) {';
        }

        $_output .= '
          var mapObj  = document.getElementById("' . $this->map_id . '");

          if (mapObj != "undefined" && mapObj != null) {
            map = new GMap2(document.getElementById("' . $this->map_id . '")
          );';

        if (isset($this->center_lat) && isset($this->center_lon)) {
            $_output .= 'map.setCenter(new GLatLng(' . $this->center_coords . '), ' .
                $this->zoom . ', ' . $this->map_type . ');';
        }

        // Set the Min and Max zoom levels.
        $_output .= '
          var mt = map.getMapTypes();

          for (var i=0; i<mt.length; i++) {
            mt[i].getMinimumResolution = function() {return ' . $this->zoom_min . ';}
            mt[i].getMaximumResolution = function() {return ' . $this->zoom_max . ';}
          }';

        // Zoom so that all markers are in the viewport
        if ($this->zoom_encompass && count($this->_markers) > 1) {

            // Increase bounds by fudge factor to keep markers away from edges
            $_len_lon = $this->_max_lon - $this->_min_lon;
            $_len_lat = $this->_max_lat - $this->_min_lat;

            $this->_min_lon -= $_len_lon * $this->bounds_fudge;
            $this->_max_lon += $_len_lon * $this->bounds_fudge;
            $this->_min_lat -= $_len_lat * $this->bounds_fudge;
            $this->_max_lat += $_len_lat * $this->bounds_fudge;

            $_output .= "var bds = new GLatLngBounds(new GLatLng($this->_min_lat, $this->_min_lon),
              new GLatLng($this->_max_lat, $this->_max_lon));";
            $_output .= 'map.setZoom(map.getBoundsZoomLevel(bds));';
        }

        // Add a click listener to the map to allow for markers to be added
        // Once added they are not removable by a click need to delete in form.
        if (!empty($this->markerClickable)) {
            $_output .= '
              GEvent.addListener(map, "click", function(overlay, point) {
                map.addOverlay(new GMarker(point));
              });';
        }

        // Add a move listener to restrict the boundary range for the map
        if (!is_null($this->boundarySW) && !is_null($this->boundaryNE)) {
            $_output .= '
              GEvent.addListener(map, "move", function() { checkBounds(); });

              var allowedBounds = new GLatLngBounds(
                new GLatLng(' . $this->boundarySW . '), new GLatLng(' . $this->boundaryNE . '));

              function checkBounds() {

               if (allowedBounds.contains(map.getCenter())) { return; }

                var C = map.getCenter();
                var X = C.lng();
                var Y = C.lat();

                var AmaxX = allowedBounds.getNorthEast().lng();
                var AmaxY = allowedBounds.getNorthEast().lat();
                var AminX = allowedBounds.getSouthWest().lng();
                var AminY = allowedBounds.getSouthWest().lat();

                if (X < AminX) { X = AminX; }
                if (X > AmaxX) { X = AmaxX; }
                if (Y < AminY) { Y = AminY; }
                if (Y > AmaxY) { Y = AmaxY; }

                map.setCenter(new GLatLng(Y, X));
              }';
        }

        if ($this->map_controls) {
            if ($this->control_size == 'large') {
                $_output .= 'map.addControl(new GLargeMapControl());';
            } else {
                $_output .= 'map.addControl(new GSmallMapControl());';
            }
        }

        if ($this->type_controls) {
            $_output .= 'map.addControl(new GMapTypeControl());';
        }

        if ($this->scale_control) {
            $_output .= 'map.addControl(new GScaleControl());';
        }

        if ($this->overview_control) {
            $_output .= 'map.addControl(new GOverviewMapControl());';
        }

        $_output .= $this->getAddMarkerJS();
        $_output .= $this->getPolylineJS();

        if ($this->sidebar) {
            $_output .= 'document.getElementById("' . $this->sidebar_id . '") . innerHTML = "<ul class=\"gmapSidebar\">" + sidebar_html + "</ul>";';
        }

        $_output .= '}';

        if (!empty($this->alert_browser)) {
            $_output .= '
              } else {
                alert("' . $this->alert_browser . '");
              }';
        }

        if ($this->onload) {
            $_output .= '}';
        }

        // Include the markers JS
        $_output .= $this->getCreateMarkerJS();

        // Utility functions used to distinguish between tabbed and non-tabbed info windows
        $_output .= '
          function isArray(a) {return isObject(a) && a.constructor == Array;}
          function isObject(a) {return (a && typeof a == \'object\') || isFunction(a);}
          function isFunction(a) {return typeof a == \'function\';}';

        if ($this->sidebar) {
            $_output .= '
              function click_sidebar(idx) {
                if (isArray(marker_html[idx])) { markers[idx].openInfoWindowTabsHtml(marker_html[idx]); }
                  else { markers[idx].openInfoWindowHtml(marker_html[idx]); }
              }';
        }

        $_output .= '
          function showInfoWindow(idx, html) {
            map.centerAtLatLng(points[idx]);
            markers[idx].openInfoWindowHtml(html);
          }';

        if ($this->directions) {
            $_output .= '
              function tohere(idx) {
                markers[idx].openInfoWindowHtml(to_htmls[idx]);
              }

              function fromhere(idx) {
                markers[idx].openInfoWindowHtml(from_htmls[idx]);
              }';
        }

        $_output .= '
            /* ]]> */
          </script>';

        return $_output;
    }

    /**
     * Overridable function for generating js to add markers
     *
     * @return string
     */
    public function getAddMarkerJS()
    {
        // Constant: width in pixels of each tab heading (set by google)
        $SINGLE_TAB_WIDTH = 88;
        $i = 0;
        $_output = '';

        foreach ($this->_markers as $_marker) {

            if (is_array($_marker['html'])) {

                // Warning: you can't have two tabs with the same header.
                $ti = 0;
                $num_tabs = count($_marker['html']);
                $tab_obs = array();

                foreach ($_marker['html'] as $tab => $info) {

                    if ($ti == 0 && $num_tabs > 2) {
                        $width_style = sprintf(' style=\"width: %spx\"', $num_tabs * $SINGLE_TAB_WIDTH);
                    } else {
                        $width_style = '';
                    }

                    $tab = str_replace('"', '\"', $tab);
                    $info = str_replace('"', '\"', $info);
                    $tab_obs[] = sprintf('new GInfoWindowTab("%s", "%s")', $tab, '<div id=\"gmapmarker\"' . $width_style . '>' . $info . '</div>');

                    $ti++;
                }

                $iw_html = '[' . join(',', $tab_obs) . ']';
            } else {
                $iw_html = sprintf('"%s"', str_replace('"', '\"', '<div id="gmapmarker">' . $_marker['html'] . '</div>'));
            }

            $_output .= sprintf('var point = new GLatLng(%s,%s);', $_marker['lat'], $_marker['lon']) . "\n";
            $_output .= '
              var marker = createMarker(point, "' . str_replace('"', '\"', $_marker['title']) . '", ' . $iw_html . ', ' . $i . ');' . "\n";

            $_output .= 'map.addOverlay(marker);' . "\n";
            $i++;
        }

        return $_output;
    }

    /**
     * Overridable function to generate the JavaScript for creating a marker.
     *
     * @return string
     */
    public function getCreateMarkerJS()
    {
        $_output = '';

        $_output .= '
          function createMarker(point, title, html, n) {
            if(n >= ' . sizeof($this->_icons) . ') {
              n = ' . (sizeof($this->_icons) - 1) . ';
            }
          ';

        // Start the additions, default the tooltip to the title.
        $additions = ', {title:title';

        // If user defined icons exist then add them to the Marker creation.
        if ($this->_icons) {
            $additions .= ',icon:icon[n]';
        }

        // If user defined icons exist then add them to the Marker creation.
        if ($this->markerDraggable) {
            $additions .= ',draggable:true';
        }

        $additions .= '}';

        $_output .= 'var marker = new GMarker(point ' . $additions . ');' . "\n";

        if ($this->directions) {

            // WARNING: If you are using a tabbed info window AND directions:
            // this uses an UNDOCUMENTED field of the GInfoWindowTab object,
            // contentElem. Google may CHANGE this name or other aspects of their
            // GInfoWindowTab implementation without warning and BREAK this code.
            // NOTE: If you are NOT using a tabbed info window, you'll be fine.
            $_output .= 'var tabFlag = isArray(html);' . "\n";
            $_output .= 'if(!tabFlag) { html = [{"contentElem": html}]; }' . "\n";
            $_output .= sprintf(
                "to_htmls[counter] = html[0].contentElem + '<p /><form class=\"gmapDir\" id=\"gmapDirTo\" style=\"white-space: nowrap;\" action=\"http://maps.google.com/maps\" method=\"get\" target=\"_blank\">' +
                 '<span class=\"gmapDirHead\" id=\"gmapDirHeadTo\">%s<strong>%s</strong> - <a href=\"javascript:fromhere(' + counter + ')\">%s</a></span>' +
                 '<p class=\"gmapDirItem\" id=\"gmapDirItemTo\"><label for=\"gmapDirSaddr\" class=\"gmapDirLabel\" id=\"gmapDirLabelTo\">%s<br /></label>' +
                 '<input type=\"text\" size=\"40\" maxlength=\"40\" name=\"saddr\" class=\"gmapTextBox\" id=\"gmapDirSaddr\" value=\"\" onfocus=\"this.style.backgroundColor = \'#e0e0e0\';\" onblur=\"this.style.backgroundColor = \'#ffffff\';\" />' +
                 '<span class=\"gmapDirBtns\" id=\"gmapDirBtnsTo\"><input value=\"%s\" type=\"%s\" class=\"gmapDirButton\" id=\"gmapDirButtonTo\" /></span></p>' +
                 '<input type=\"hidden\" name=\"daddr\" value=\"' +
                 point.y + ',' + point.x + \"(\" + title.replace(new RegExp(/\"/g),'&quot;') + \")\" + '\" /></form>';
                  from_htmls[counter] = html[0].contentElem + '<p /><form class=\"gmapDir\" id=\"gmapDirFrom\" style=\"white-space: nowrap;\" action=\"http://maps.google.com/maps\" method=\"get\" target=\"_blank\">' +
                 '<span class=\"gmapDirHead\" id=\"gmapDirHeadFrom\">%s<a href=\"javascript:tohere(' + counter + ')\">%s</a> - <strong>%s</strong></span>' +
                 '<p class=\"gmapDirItem\" id=\"gmapDirItemFrom\"><label for=\"gmapDirSaddr\" class=\"gmapDirLabel\" id=\"gmapDirLabelFrom\">%s<br /></label>' +
                 '<input type=\"text\" size=\"40\" maxlength=\"40\" name=\"saddr\" class=\"gmapTextBox\" id=\"gmapDirSaddr\" value=\"\" onfocus=\"this.style.backgroundColor = \'#e0e0e0\';\" onblur=\"this.style.backgroundColor = \'#ffffff\';\" />' +
                 '<span class=\"gmapDirBtns\" id=\"gmapDirBtnsFrom\"><input value=\"%s\" type=\"%s\" class=\"gmapDirButton\" id=\"gmapDirButtonFrom\" /></span></p' +
                 '<input type=\"hidden\" name=\"daddr\" value=\"' +
                 point.y + ',' + point.x + \"(\" + title.replace(new RegExp(/\"/g),'&quot;') + \")\" + '\" /></form>';
                 html[0].contentElem = html[0].contentElem + '<p /><div id=\"gmapDirHead\" class=\"gmapDir\" style=\"white-space: nowrap;\">%s<a href=\"javascript:tohere(' + counter + ')\">%s</a> - <a href=\"javascript:fromhere(' + counter + ')\">%s</a></div>';\n", $this->driving_dir_text['dir_text'], $this->driving_dir_text['dir_tohere'], $this->driving_dir_text['dir_fromhere'], $this->driving_dir_text['dir_to'], $this->driving_dir_text['to_button_value'], $this->driving_dir_text['to_button_type'], $this->driving_dir_text['dir_text'], $this->driving_dir_text['dir_tohere'], $this->driving_dir_text['dir_fromhere'], $this->driving_dir_text['dir_from'], $this->driving_dir_text['from_button_value'], $this->driving_dir_text['from_button_type'], $this->driving_dir_text['dir_text'], $this->driving_dir_text['dir_tohere'], $this->driving_dir_text['dir_fromhere']
            );

            $_output .= 'if(!tabFlag) { html = html[0].contentElem; }';
        }

        if ($this->info_window) {
            $_output .= '
              if (isArray(html)) {
                GEvent.addListener(marker, "' . $this->window_trigger .
                '", function() { marker.openInfoWindowTabsHtml(html, {maxUrl:html}); }); }';
            $_output .= '
              else { GEvent.addListener(marker, "' . $this->window_trigger .
                '", function() { marker.openInfoWindowHtml(html, {maxUrl:html}); }); }';
        }

        if ($this->markerDraggable) {
            $_output .= '
              GEvent.addListener(marker, "dragstart", function() { map.closeInfoWindow(); });
              GEvent.addListener(marker, "dragend", function() { marker.openInfoWindowHtml("Just bouncing"); });';
        }

        $_output .= 'points[counter]  = point;';
        $_output .= 'markers[counter] = marker;';

        if ($this->sidebar) {
            $_output .= 'marker_html[counter] = html;';
            $_output .= "sidebar_html += '<li class=\"gmapSidebarItem\" id=\"gmapSidebarItem_'+ counter +'\"><a href=\"javascript:click_sidebar(' + counter + ')\">' + title + '</a></li>';";
        }

        $_output .= 'counter++;';
        $_output .= 'return marker;';
        $_output .= '}';

        return $_output;
    }

    /**
     * Return map
     *
     * @return string
     */
    public function getMap()
    {
        $_output = '<script type="text/javascript">//<![CDATA[ ' . "\n";
        $_output .= 'if (GBrowserIsCompatible()) {' . "\n";

        if (strlen($this->map_width) > 0 && strlen($this->map_height) > 0) {
            $_output .=
                'document.write(\'<div id="' . $this->map_id . '" style="float:right;border:1px solid;width:' .
                $this->map_width . '; height:' . $this->map_height . '"></div>\');' . "\n";
        } else {
            $_output .=
                'document.write(\'<div id="' . $this->map_id . '"></div>\');' . "\n";
        }

        $_output .= '}';

        if (!empty($this->alert_js)) {
            $_output .= ' else {' . "\n";
            $_output .= 'document.write(\'' . $this->alert_js . '\');' . "\n";
            $_output .= '}' . "\n";
        }

        $_output .= '//]]></script>' . "\n";

        if (!empty($this->alert_js)) {
            $_output .= '<noscript>' . $this->alert_js . '</noscript>' . "\n";
        }

        return $_output;
    }

    /**
     * Get the geocode lat/lon points from given address look in cache first,
     * otherwise get from Yahoo/Google
     *
     * @param  string $address
     * @return mixed
     */
    public function getGeocode($address)
    {
        if (empty($address)) {
            return false;
        }

        $_geocode = false;

        if (($_geocode = $this->getCache($address)) === false) {
            if (($_geocode = $this->geoGetCoords($address)) !== false) {
                $this->putCache($address, $_geocode['lon'], $_geocode['lat']);
            }
        }

        return $_geocode;
    }

    /**
     * Get the geocode lat/lon points from cache for given address
     *
     * @param  string $address
     * @return mixed
     */
    public function getCache($address)
    {
        if (!isset($this->dsn)) {
            return false;
        }

        $_ret = array();

        // PEAR DB
        // require_once 'DB.php';

        $_db = & DB::connect($this->dsn);

        if (PEAR::isError($_db)) {
            die($_db->getMessage());
        }

        $_res = & $_db->query("SELECT lon,lat FROM {$this->_db_cache_table} where address = ?", $address);

        if (PEAR::isError($_res)) {
            die($_res->getMessage());
        }

        if ($_row = $_res->fetchRow()) {
            $_ret['lon'] = $_row[0];
            $_ret['lat'] = $_row[1];
        }

        $_db->disconnect();

        return!empty($_ret) ? $_ret : false;
    }

    /**
     * Get geocode lat/lon points for given address from Yahoo
     *
     * @param  string $address
     * @return mixed
     */
    public function geoGetCoords($address, $depth = 0)
    {
        switch ($this->lookup_service) {

            case 'GOOGLE':

                $_url = sprintf('http://%s/maps/geo?&q=%s&output=csv&key=%s', $this->lookup_server['GOOGLE'], rawurlencode($address), $this->api_key);

                $_result = false;

                if ($_result = $this->fetchURL($_url)) {

                    $_result_parts = explode(',', $_result);

                    if ($_result_parts[0] != 200) {
                        return false;
                    }

                    $_coords['lat'] = $_result_parts[2];
                    $_coords['lon'] = $_result_parts[3];
                }

                break;

            case 'YAHOO':
            default:

                $_url = 'http://%s/MapsService/V1/geocode';
                $_url .= sprintf('?appid=%s&location=%s', $this->lookup_server['YAHOO'], $this->app_id, rawurlencode($address));

                $_result = false;

                if ($_result = $this->fetchURL($_url)) {

                    preg_match('!<Latitude>(.*)</Latitude><Longitude>(.*)</Longitude>!U', $_result, $_match);

                    $_coords['lon'] = $_match[2];
                    $_coords['lat'] = $_match[1];
                }

                break;
        }

        return $_coords;
    }

    /**
     * Fetch a URL. Override this method to change the way URLs are fetched.
     *
     * @param  string $url
     * @return string
     */
    public function fetchURL($url)
    {
        return file_get_contents($url);
    }

    /**
     * Get distance between to geocoords using great circle distance formula
     *
     * @param  float  $lat1
     * @param  float  $lat2
     * @param  float  $lon1
     * @param  float  $lon2
     * @param  float  $unit M=miles, K=kilometers, N=nautical miles, I=inches, F=feet
     * @return string
     */
    public function geoGetDistance($lat1, $lon1, $lat2, $lon2, $unit = 'M')
    {
        // calculate miles
        $M = 69.09 * rad2deg(acos(sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lon1 - $lon2))));

        switch (strtoupper($unit)) {

            case 'K':
                // kilometers
                return $M * 1.609344;
                break;

            case 'N':
                // nautical miles
                return $M * 0.868976242;
                break;

            case 'F':
                // feet
                return $M * 5280;
                break;

            case 'I':
                // inches
                return $M * 63360;
                break;

            case 'M':
            default:
                // miles
                return $M;
                break;
        }
    }

    /**
     * Overridable function to generate polyline JavaScript
     *
     * @return string
     */
    public function getPolylineJS()
    {
        $_output = '';

//        foreach ($this->_polylines as $_polyline) {
//            $_output .= 'points.push(new GPoint(' . $_polyline['lat1'] . ', ' . $_polyline['lon1'] . '));';
//        }
//
//        $_output .= 'map.addOverlay(new GPolyline(points));';

        foreach ($this->_polylines as $_polyline) {
            $_output .= '
            var polyline = new GPolyline([new GLatLng(' .
                $_polyline['lat1'] . ', ' . $_polyline['lon1'] . '),new GLatLng(' .
                $_polyline['lat2'] . ', ' . $_polyline['lon2'] . ')], "' .
                $_polyline['color'] . '", ' . $_polyline['weight'] . ', ' .
                $_polyline['opacity'] / 100.0 . ');' . "\n";

            $_output .= 'map.addOverlay(polyline);' . "\n";
        }

        return $_output;
    }

    /**
     * Return sidebar HTML
     *
     * @return string
     */
    public function getSidebar()
    {
        return '<div id="' . $this->sidebar_id . '" style="overflow:auto;height:600px;float:left;width:20%;border:1px solid"></div>';
    }

    /**
     * Put the geocode lat/lon points into cache for given address
     *
     * @param  string  $address
     * @param  string  $lon     The map latitude (horizontal)
     * @param  string  $lat     The map latitude (vertical)
     * @return boolean
     */
    public function putCache($address, $lon, $lat)
    {
        if (!isset($this->dsn) || (strlen($address) == 0 || strlen($lon) == 0 || strlen($lat) == 0)) {
            return false;
        }

        // PEAR DB
        // require_once 'DB.php';

        $_db = & DB::connect($this->dsn);

        if (PEAR::isError($_db)) {
            die($_db->getMessage());
        }

        $_res = & $_db->query('insert into ? values (?, ?, ?)', array($this->_db_cache_table, $address, $lon, $lat));

        if (PEAR::isError($_res)) {
            die($_res->getMessage());
        }

        $_db->disconnect();

        return true;
    }

    /**
     * Set browser alert message for incompatible browsers
     *
     * @param  string $message
     * @return void
     */
    public function setAlertBrowser($message)
    {
        $this->alert_browser = $message;
    }

    /**
     * Set <noscript> message when javascript is disabled
     *
     * @param  string $message
     * @return void
     */
    public function setAlertJS($message)
    {
        $this->alert_js = $message;
    }

    /**
     * Sets YOUR Google Map API key
     *
     * @param  string $key
     * @return void
     */
    public function setAPIKey($key)
    {
        $this->apiKey = $key;
    }

    /**
     * Set the boundaries for the map
     *
     * <code>
     * $map->setBoundaries('51.1073, -0.0462', '51.1073, -0.0462');
     * </code>
     *
     * @param  string $sw
     * @param  string $ne
     * @return void
     */
    public function setBoundaries($sw, $ne)
    {
        $this->boundarySW = $sw;
        $this->boundaryNE = $ne;
    }

    /**
     * Set the boundary fudge factor
     *
     * @return void
     */
    public function setBoundsFudge($val)
    {
        $this->bounds_fudge = $val;
    }

    /**
     * Set map center coordinates to lat/lon point
     *
     * <code>
     * $map->setCenterCoords('51.1073, -0.0462');
     * </code>
     *
     * @param  string $centerCoords latitude longitude
     * @return void
     */
    public function setCenterCoords($centerCoords)
    {
        $this->center_coords = $centerCoords;
    }

    /**
     * Sets the map control size (large/small)
     *
     * @param  string $size Either large or small
     * @return void
     */
    public function setControlSize($size = 'large')
    {
        $this->control_size = $size;
    }

    /**
     * Enables map directions inside info window
     *
     * @param  boolean $flag
     * @return void
     */
    public function setDirections($flag = true)
    {
        $this->directions = $flag;
    }

    /**
     * Sets the PEAR::DB dsn
     *
     * @param  string $dsn
     * @return void
     */
    public function setDSN($dsn)
    {
        $this->dsn = $dsn;
    }

    /**
     * Enable map marker info windows
     *
     * @param  boolean $flag
     * @return void
     */
    public function setInfoWindow($flag = true)
    {
        $this->info_window = $flag;
    }

    /**
     * Set the info window trigger action
     *
     * @param  string $message Either click or mouseover
     * @return void
     */
    public function setInfoWindowTrigger($type = 'click')
    {
        switch ($type) {

            case 'mouseover':
                $this->window_trigger = 'mouseover';
                break;

            default:
                $this->window_trigger = 'click';
                break;
        }
    }

    /**
     * Set the lookup service to use for geocode lookups default is YAHOO, you
     * can also use GOOGLE. NOTE: GOOGLE can do intl lookups, but is not an
     * official API, so use at your own risk.
     *
     * @param  string $server Either GOOGLE or YAHOO
     * @return void
     */
    public function setLookupService($service = 'GOOGLE')
    {
        switch ($service) {

            case 'GOOGLE':
                $this->lookup_service = 'GOOGLE';
                break;

            case 'YAHOO':
            default:
                $this->lookup_service = 'YAHOO';
                break;
        }
    }

    /**
     * Sets the flag to display the map controls (zoom/move)
     *
     * @param  boolean $flag
     * @return void
     */
    public function setMapControls($flag = true)
    {
        $this->map_controls = $flag;
    }

    /**
     * Sets the width of the map
     *
     * @param  string  $width
     * @param  string  $height
     * @param  string  $type   % or px
     * @return void
     */
    public function setMapDimensions($width, $height, $type)
    {
        $this->map_width = $width . $type;
        $this->map_height = $height . $type;
    }

    /**
     * Set default map type (map/satellite/hybrid)
     *
     * @param  string $type Either map, hybrid or satelite
     * @return void
     */
    public function setMapType($type = 'map')
    {
        switch ($type) {

            case 'hybrid':
                $this->map_type = 'G_HYBRID_MAP';
                break;

            case 'satellite':
                $this->map_type = 'G_SATELLITE_MAP';
                break;

            case 'map':
            default:
                $this->map_type = 'G_NORMAL_MAP';
                break;
        }
    }

    /**
     * Method to say whether the markers should be clickable.
     *
     * @param  boolean $flag
     * @return void
     */
    public function setMarkerClickable($flag = true)
    {
        $this->markerClickable = $flag;
    }

    /**
     * Method to say whether the markers should be draggable.
     *
     * @param  boolean $flag
     * @return void
     */
    public function setMarkerDraggable($flag = true)
    {
        $this->markerDraggable = $flag;
    }

    /**
     * Set the marker icon for ALL markers on the map
     *
     * @param  string $iconImage
     * @param  string $iconShadowImage
     * @param  string $iconAnchorX
     * @param  string $iconAnchorY
     * @param  string $infoWindowAnchorX
     * @param  string $infoWindowAnchorY
     * @return void
     */
    public function setMarkerIcon($iconImage, $iconShadowImage = '', $iconAnchorX = 'x', $iconAnchorY = 'x', $infoWindowAnchorX = 'x', $infoWindowAnchorY = 'x')
    {
        $this->_icons = array($this->createMarkerIcon($iconImage, $iconShadowImage, $iconAnchorX, $iconAnchorY, $infoWindowAnchorX, $infoWindowAnchorY));
    }

    /**
     * Enables onload
     *
     * @param  boolean $flag
     * @return void
     */
    public function setOnLoad($flag = true)
    {
        $this->onload = $flag;
    }

    /**
     * Enables the overview map control
     *
     * @param  boolean $flag
     * @return void
     */
    public function setOverviewControl($flag = true)
    {
        $this->overview_control = $flag;
    }

    /**
     * Enables the scale map control
     *
     * @param  boolean $flag
     * @return void
     */
    public function setScaleControl($flag = true)
    {
        $this->scale_control = $flag;
    }

    /**
     * Enables sidebar
     *
     * @param  boolean $flag
     * @return void
     */
    public function setSidebar($flag = true)
    {
        $this->sidebar = $flag;
    }

    /**
     * Enables the type controls (map/satellite/hybrid)
     *
     * @param  boolean $flag
     * @return void
     */
    public function setTypeControls($flag = true)
    {
        $this->type_controls = $flag;
    }

    /**
     * Enable zoom to encompass markers
     *
     * @param  boolean $flag
     * @return void
     */
    public function setZoomEncompass($flag = true)
    {
        $this->zoom_encompass = $flag;
    }

    /**
     * Sets the zoom level; maximum and minimum map zoom level
     *
     * @param  int    $level
     * @param  int    $min
     * @param  int    $max
     * @return void
     */
    public function setZoomLevel($level = 14, $min = 13, $max = 17)
    {
        $this->zoom = $level;
        $this->zoom_max = $min;
        $this->zoom_min = $max;
    }

}
