<?php
/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Plugin
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://www.codeblender.net/license
 */

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Plugin
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://www.codeblender.net/license
 */
class CodeBlender_Controller_Plugin_Debug extends Zend_Controller_Plugin_Abstract
{

    /**
     * Contains options to change Debug Bar behaviour
     *
     * @var array
     */
    protected $_options = array(
        'plugins' => array('CodeBlender' => null, 'ZendFramework' => null),
        'zIndex' => 255,
        'jqueryPath' => 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js'
    );

    /**
     * Contains registered plugins
     *
     * @var array
     */
    protected $_plugins = array();

    /**
     * Standard plugins
     *
     * @var array
     */
    public static $standardPlugins = array(
        'Auth', 'CodeBlender', 'ZendFramework', 'Cache', 'Database', 'Exception', 'File',
        'Html', 'Memory', 'Php', 'Registry', 'Text', 'Time', 'Todo', 'Variables');

    /**
     * Creates a new instance of the Debug Bar
     *
     * @param  array $options
     * @throws Zend_Controller_Exception
     * @return void
     */
    public function __construct($options = null)
    {
        // Check that options are set
        if (isset($options)) {

            // Verify that adapter parameters are in an array.
            if (!is_array($options)) {
                throw new Zend_Exception('Parameters must be in an array or a Zend_Config object');
            }

            $this->setOptions($options);
        }

        // Loading already defined plugins
        $this->_loadPlugins();
    }

    /**
     * Sets options of the Debug Bar
     *
     * @param array $options
     * @return CodeBlenderDebug_Controller_Plugin_Debug
     */
    public function setOptions(array $options = array())
    {
        if (isset($options['jqueryPath'])) {
            $this->_options['jqueryPath'] = $options['jqueryPath'];
        }

        if (isset($options['zIndex'])) {
            $this->_options['zIndex'] = $options['zIndex'];
        }

        if (isset($options['plugins'])) {
            $this->_options['plugins'] = $options['plugins'];
        }

        return $this;
    }

    /**
     * Load plugins set in config option
     *
     * @return void;
     */
    protected function _loadPlugins()
    {
        // Loop through the plugin options
        foreach ($this->_options['plugins'] as $plugin => $options) {

            if (is_numeric($plugin)) {

                // Plugin passed as array value instead of key
                $plugin = $options;
                $options = array();
            }

            // Register an instance
            if (is_object($plugin) && in_array('CodeBlender_Controller_Plugin_Debug_Plugin_Interface', class_implements($plugin))) {
                $this->registerPlugin($plugin);
                continue;
            }

            if (!is_string($plugin)) {
                throw new Zend_Exception('Invalid plugin name', 1);
            }

            $plugin = ucfirst($plugin);

            if (in_array($plugin, CodeBlender_Controller_Plugin_Debug::$standardPlugins)) {

                // standard plugin
                $pluginClass = 'CodeBlender_Controller_Plugin_Debug_Plugin_' . $plugin;
            } else {

                // We use a custom plugin
                if (!preg_match('~^[\w]+$~D', $plugin)) {
                    throw new Zend_Exception("CodeBlender: Invalid plugin name [$plugin]");
                }

                $pluginClass = $plugin;
            }

            $object = new $pluginClass($options);
            $this->registerPlugin($object);
        }
    }

    /**
     * Register a new plugin in the Debug Bar
     *
     * @param  CodeBlenderDebug_Controller_Plugin_Debug_Plugin_Interface
     * @return CodeBlenderDebug_Controller_Plugin_Debug
     */
    public function registerPlugin(CodeBlender_Controller_Plugin_Debug_Plugin_Interface $plugin)
    {
        $this->_plugins[$plugin->getIdentifier()] = $plugin;
        return $this;
    }

    /**
     * Unregister a plugin in the Debug Bar
     *
     * @param  string $plugin
     * @return CodeBlenderDebug_Controller_Plugin_Debug
     */
    public function unregisterPlugin($plugin)
    {
        if (false !== strpos($plugin, '_')) {

            foreach ($this->_plugins as $key => $_plugin) {

                if ($plugin == get_class($_plugin)) {
                    unset($this->_plugins[$key]);
                }
            }
        } else {

            $plugin = strtolower($plugin);

            if (isset($this->_plugins[$plugin])) {
                unset($this->_plugins[$plugin]);
            }
        }

        return $this;
    }

    /**
     * Get a registered plugin in the Debug Bar
     *
     * @param  string $identifier
     * @return CodeBlenderDebug_Controller_Plugin_Debug_Plugin_Interface
     */
    public function getPlugin($identifier)
    {
        $identifier = strtolower($identifier);

        if (isset($this->_plugins[$identifier])) {
            return $this->_plugins[$identifier];
        }

        return false;
    }

    /**
     * Defined by Zend_Controller_Plugin_Abstract
     */
    public function preDispatch()
    {
        // Check whether the bar should be disabled
        if (self::_disable()) {
            return false;
        }

        $collapsed = isset($_COOKIE['CodeBlenderCollapsed']) ? $_COOKIE['CodeBlenderCollapsed'] : 0;

        $view = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');

        $view->headStyle()->captureStart('APPEND');
        ?>
        #CodeBlender_debug h4 { font-weight: bold; }
        #CodeBlender_debug    { font:11px/1.5em verdana, sans-serif; position:fixed; bottom:5px; left:5px; color:#000; z-index:<?php echo $this->_options['zIndex']; ?>; }
        #CodeBlender_debug ol { margin:10px 0px; padding:0 25px; }
        #CodeBlender_debug li { margin:0 0 10px 0; }
        #CodeBlender_debug .clickable { cursor:pointer; }
        #CodeBlender_toggler { font-weight:bold; background:#BFBFBF; }
        .CodeBlender_span    { border: 1px solid #999; border-right:0px; background:#DFDFDF; padding: 5px 5px; }
        .CodeBlender_last    { border: 1px solid #999; }
        .CodeBlender_panel   { text-align:left; position:absolute; bottom:22px; width:804px; max-height:500px; overflow:auto; display:none; background:#E8E8E8; padding:5px; border: 1px solid #999; }
        .CodeBlender_panel .pre { font: 11px/1.5em Monaco, Lucida Console, monospace; margin:0 0 0 22px; }
        #CodeBlender_exception  { border:1px solid #CD0A0A; display: block; }
        <?php
        $view->headStyle()->captureEnd();

        $view->headScript()->captureStart('PREPEND');
        ?>
        if (typeof jQuery == "undefined") {
        var scriptObj  = document.createElement("script");
        scriptObj.src  = "<?php echo $this->_options['jqueryPath']; ?>";
        scriptObj.type = "text/javascript";
        var head=document.getElementsByTagName("head")[0];
        head.insertBefore(scriptObj,head.firstChild);
        }

        var CodeBlenderLoad = window.onload;

        window.onload = function()
        {
        if (CodeBlenderLoad) {
        CodeBlenderLoad();
        }

        CodeBlenderCollapsed();
        };

        function CodeBlenderCollapsed()
        {
        if (<?php echo $collapsed; ?> == 1) {
        CodeBlenderPanel();
        jQuery("#CodeBlender_toggler").html('&#187;');
        return jQuery("#CodeBlender_debug").css("left", "-" + parseInt(jQuery("#CodeBlender_debug").outerWidth() - jQuery("#CodeBlender_toggler").outerWidth() + 1) + "px");
        }
        }

        function CodeBlenderPanel(name)
        {
        jQuery(".CodeBlender_panel").each(function(i) {
        if (jQuery(this).css("display") == "block") {
        jQuery(this).slideUp();
        } else {
        if (jQuery(this).attr("id") == name) {
        jQuery(this).slideDown();
        } else {
        jQuery(this).slideUp();
        }
        }
        });
        }

        function CodeBlenderSlideBar()
        {
        if (jQuery("#CodeBlender_debug").position().left > 0) {
        document.cookie = "CodeBlenderCollapsed=1;expires=;path=/";
        CodeBlenderPanel();
        jQuery("#CodeBlender_toggler").html('&#187;');
        return jQuery("#CodeBlender_debug").animate({left:"-" + parseInt(jQuery("#CodeBlender_debug").outerWidth() - jQuery("#CodeBlender_toggler").outerWidth() + 1) + "px"}, "normal", "swing");
        } else {
        document.cookie = "CodeBlenderCollapsed=0;expires=;path=/";
        jQuery("#CodeBlender_toggler").html('&#171;');
        return jQuery("#CodeBlender").animate({left:"5px"}, "normal", "swing");
        }
        }

        function CodeBlenderToggleElement(name, whenHidden, whenVisible)
        {
        if (jQuery(name).css("display") == "none") {
        jQuery(whenVisible).show();
        jQuery(whenHidden).hide();
        } else {
        jQuery(whenVisible).hide();
        jQuery(whenHidden).show();
        }

        jQuery(name).slideToggle();
        }
        <?php
        $view->headScript()->captureEnd();
    }

    /**
     * Defined by Zend_Controller_Plugin_Abstract
     */
    public function dispatchLoopShutdown()
    {
        // Check whether the bar should be disabled
        if (self::_disable()) {
            return false;
        }

        $html = '';

        // Creating menu tab for all registered plugins
        foreach ($this->_plugins as $plugin) {

            $panel = $plugin->getPanel();

            if ($panel == '') {
                continue;
            }

            $html .= '<div id="CodeBlender_' . $plugin->getIdentifier() . '" class="CodeBlender_panel">' . $panel . '</div>';
        }

        $html .= '<div id="CodeBlender_info">';

        // Creating panel content for all registered plugins
        foreach ($this->_plugins as $plugin) {

            $tab = $plugin->getTab();

            if ($tab == '') {
                continue;
            }

            $html .= '
              <span class="CodeBlender_span clickable" onclick="CodeBlenderPanel(\'CodeBlender_' . $plugin->getIdentifier() . '\');">
                  <img src="' . $plugin->getIconData() . '" style="vertical-align:middle" alt="' . $plugin->getIdentifier() . '" title="' . $plugin->getIdentifier() . '" />
                  ' . $tab . '
              </span>';
        }

        $html .= '<span class="CodeBlender_span CodeBlender_last clickable" id="CodeBlender_toggler" onclick="CodeBlenderSlideBar()">&#171;</span>
                  </div>';

        $response = $this->getResponse();
        $response->setBody(str_ireplace('</body>', '<div id="CodeBlender_debug">' . $html . '</div></body>', $response->getBody()));
    }

    /**
     * Deermine whether to show the debug bar based on the user controlled
     * parameter CBDDISABLE or whether this is a AJAX request
     *
     * @return boolean
     */
    private function _disable()
    {
        // Allow the user to switch of the bar with the Disable phrase
        $disable = Zend_Controller_Front::getInstance()->getRequest()->getParam('CBDDISABLE');

        // Do not display the Bar if this is an AJAX request or disabled
        if ($this->getRequest()->isXmlHttpRequest() || $disable) {
            return true;
        }

        return false;
    }

//    /**
//     * Returns date for the requested icon
//     *
//     * @return string
//     */
//    protected function _icon($kind)
//    {
//        switch ($kind) {
//
//            case 'error':
//			    return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAIsSURBVDjLpVNLSJQBEP7+h6uu62vLVAJDW1KQTMrINQ1vPQzq1GOpa9EppGOHLh0kCEKL7JBEhVCHihAsESyJiE4FWShGRmauu7KYiv6Pma+DGoFrBQ7MzGFmPr5vmDFIYj1mr1WYfrHPovA9VVOqbC7e/1rS9ZlrAVDYHig5WB0oPtBI0TNrUiC5yhP9jeF4X8NPcWfopoY48XT39PjjXeF0vWkZqOjd7LJYrmGasHPCCJbHwhS9/F8M4s8baid764Xi0Ilfp5voorpJfn2wwx/r3l77TwZUvR+qajXVn8PnvocYfXYH6k2ioOaCpaIdf11ivDcayyiMVudsOYqFb60gARJYHG9DbqQFmSVNjaO3K2NpAeK90ZCqtgcrjkP9aUCXp0moetDFEeRXnYCKXhm+uTW0CkBFu4JlxzZkFlbASz4CQGQVBFeEwZm8geyiMuRVntzsL3oXV+YMkvjRsydC1U+lhwZsWXgHb+oWVAEzIwvzyVlk5igsi7DymmHlHsFQR50rjl+981Jy1Fw6Gu0ObTtnU+cgs28AKgDiy+Awpj5OACBAhZ/qh2HOo6i+NeA73jUAML4/qWux8mt6NjW1w599CS9xb0mSEqQBEDAtwqALUmBaG5FV3oYPnTHMjAwetlWksyByaukxQg2wQ9FlccaK/OXA3/uAEUDp3rNIDQ1ctSk6kHh1/jRFoaL4M4snEMeD73gQx4M4PsT1IZ5AfYH68tZY7zv/ApRMY9mnuVMvAAAAAElFTkSuQmCC';
//                break;
//
//            case 'text':
//                return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAHhSURBVDjLpZI9SJVxFMZ/r2YFflw/kcQsiJt5b1ije0tDtbQ3GtFQYwVNFbQ1ujRFa1MUJKQ4VhYqd7K4gopK3UIly+57nnMaXjHjqotnOfDnnOd/nt85SURwkDi02+ODqbsldxUlD0mvHw09ubSXQF1t8512nGJ/Uz/5lnxi0tB+E9QI3D//+EfVqhtppGxUNzCzmf0Ekojg4fS9cBeSoyzHQNuZxNyYXp5ZM5Mk1ZkZT688b6thIBenG/N4OB5B4InciYBCVyGnEBHO+/LH3SFKQuF4OEs/51ndXMXC8Ajqknrcg1O5PGa2h4CJUqVES0OO7sYevv2qoFBmJ/4gF4boaOrg6rPLYWaYiVfDo0my8w5uj12PQleB0vcp5I6HsHAUoqUhR29zH+5B4IxNTvDmxljy3x2YCYUwZVlbzXJh9UKeQY6t2m0Lt94Oh5loPdqK3EkjzZi4MM/Y9Db3MTv/mYWVxaqkw9IOATNR7B5ABHPrZQrtg9sb8XDKa1+QOwsri4zeHD9SAzE1wxBTXz9xtvMc5ZU5lirLSKIz18nJnhOZjb22YKkhd4odg5icpcoyL669TAAujlyIvmPHSWXY1ti1AmZ8mJ3ElP1ips1/YM3H300g+W+51nc95YPEX8fEbdA2ReVYAAAAAElFTkSuQmCC';
//                break;
//
//            case 'auth':
//                return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAJ3SURBVDjLpZNtSNNRFIcNKunF1rZWBMJqKaSiX9RP1dClsjldA42slW0q5oxZiuHrlqllLayoaJa2jbm1Lc3QUZpKFmmaTMsaRp+kMgjBheSmTL2//kqMBJlFHx44XM7vOfdyuH4A/P6HFQ9zo7cpa/mM6RvCrVDzaVDy6C5JJKv6rwSnIhlFd0R0Up/GwF2KWyl01CTSkM/dQoQRzAurCjRCGnRUUE2FaoSL0HExiYVzsQwcj6RNrSqo4W5Gh6Yc4+1qDDTkIy+GhYK4nTgdz0H2PrrHUJzs71NQn86enPn+CVN9GnzruoYR63mMPbkC59gQzDl7pt7rc9f7FNyUhPY6Bx9gwt4E9zszhWWpdg6ZcS8j3O7zCTuEpnXB+3MNZkUUZu0NmHE8XsL91oSWwiiEc3MeseLrN6woYCWa/Zl8ozyQ3w3Hl2lYy0SwlCUvsVi/Gv2JwITnYPDun2Hy6jYuEzAF1jUBCVYpO6kXo+NuGMeBAgcgfwNkvgBOPgUqXgKvP7rBFvRhE1crp8Vq1noFYSlacVyqGk0D86gbART9BDk9BFnPCNJbCY5aCFL1Cyhtp0RWAp74MsKSrkq9guHyvfMTtmLc1togpZoyqYmyNoITzVTYRJCiXYBIQ3CwFqi83o3JDhX6C0M8XsGIMoQ4OyuRlq1DdZcLkmbgGDX1iIEKNxAcbgTEOqC4ZRaJ6Ub86K7CYFEo8Qo+GBQlQyXBczLZpbloaQ9k1NUz/kD2myBBKxRZpa5hVcQslalatoUxizxAVVrN3CW21bFj9F858Q9dnIRmDyeuybM71uxmH9BNBB1q6zybV7H9s1Ue4PM3/gu/AEbfqfWy2twsAAAAAElFTkSuQmCC';
//                break;
//
//            default:
//                return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAHhSURBVDjLpZI9SJVxFMZ/r2YFflw/kcQsiJt5b1ije0tDtbQ3GtFQYwVNFbQ1ujRFa1MUJKQ4VhYqd7K4gopK3UIly+57nnMaXjHjqotnOfDnnOd/nt85SURwkDi02+ODqbsldxUlD0mvHw09ubSXQF1t8512nGJ/Uz/5lnxi0tB+E9QI3D//+EfVqhtppGxUNzCzmf0Ekojg4fS9cBeSoyzHQNuZxNyYXp5ZM5Mk1ZkZT688b6thIBenG/N4OB5B4InciYBCVyGnEBHO+/LH3SFKQuF4OEs/51ndXMXC8Ajqknrcg1O5PGa2h4CJUqVES0OO7sYevv2qoFBmJ/4gF4boaOrg6rPLYWaYiVfDo0my8w5uj12PQleB0vcp5I6HsHAUoqUhR29zH+5B4IxNTvDmxljy3x2YCYUwZVlbzXJh9UKeQY6t2m0Lt94Oh5loPdqK3EkjzZi4MM/Y9Db3MTv/mYWVxaqkw9IOATNR7B5ABHPrZQrtg9sb8XDKa1+QOwsri4zeHD9SAzE1wxBTXz9xtvMc5ZU5lirLSKIz18nJnhOZjb22YKkhd4odg5icpcoyL669TAAujlyIvmPHSWXY1ti1AmZ8mJ3ElP1ips1/YM3H300g+W+51nc95YPEX8fEbdA2ReVYAAAAAElFTkSuQmCC';
//                break;
//        }
//    }
}
