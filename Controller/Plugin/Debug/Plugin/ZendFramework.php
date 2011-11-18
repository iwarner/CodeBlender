<?php

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Plugin
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://www.codeblender.net/license
 */

/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Plugin
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://www.codeblender.net/license
 */
class CodeBlender_Controller_Plugin_Debug_Plugin_ZendFramework implements CodeBlender_Controller_Plugin_Debug_Plugin_Interface
{

    /**
     * Contains plugin identifier name
     *
     * @var string
     */
    protected $_identifier = 'zendframework';

    /**
     * Zend Framework Version Number
     *
     * @var string
     */
    protected $_version = Zend_Version::VERSION;

    /**
     * Gets identifier for this plugin
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->_identifier;
    }

    /**
     * Returns the base64 encoded icon
     *
     * @return string
     */
    public function getIconData()
    {
        return 'data:image/gif;base64,R0lGODlhEAAQAPcAAPb7/ef2+VepAGKzAIC8SavSiYS9Stvt0uTx4fX6+ur1632+QMLgrGOuApDIZO738drs0Ofz5t7v2MfjtPP6+t7v12SzAcvnyX2+PaPRhH2+Qmy3H3K5LPP6+cXkwIHAR2+4JHi7NePz8YC/Rc3ozfH49XK5KXq9OrzdpNzu1YrEUqrVkdzw5uTw4d/v2dDow5zOeO3279Hq0m+4JqrUhpnMbeHw3N3w6Mflwm22HmazBODy7tfu3un06r7gsuXy4sTisIzGXvH59ny9PdPr1rXZpMzlu36/Q5bLb+Pw3tDnxNHr1Lfbm+b199/x62q1Fp3NcdjszqTPh/L599vt04/GWmazCPb7/LHZnW63I3W6MXa7MmGuAt/y7Gq1E2m0Eb7cp9frzZLJaO/489bu3HW3N7rerN/v2q7WjIjEVuLx343FVrDXj9nt0cTjvW2zIoPBSNjv4OT09IXDUpvLeeHw3dPqyNLpxs/nwHe8OIvFWrPaoGe0C5zMb83mvHm8Oen06a3Xl9XqyoC/Qr/htWe0DofDU4nFWbPYk7ndqZ/PfYPBTMPhrqHRgoLBSujz55PKadHpxfX6+6LNeqPQfNXt2pPIYH2+O7vcoHi4OOf2+PL5+NTs2N3u1mi1E7XZl4zEVJjLaZHGauby5KTShmSzBO/38s/oz3i7MtbrzMHiuYTCT4fDTtXqye327uDv3JDHXu328JnMcu738LLanvD49ZTJYpPKauX19tvv44jBWo7GWpfKZ+Dv27XcpcrluXu8ONTs16zXleT08qfUjKzUlc7pzm63HaTRfZXKZuj06HG4KavViGe0EcDfqcjmxaDQgZrNdOHz77/ep4/HYL3esnW6LobCS3S5K57OctDp0JXKbez17N7x6cbkwLTZlbXXmLrcnrvdodHr06PQe8jkt5jIa93v13m8OI7CW3O6L3a7Nb7gs6nUjmu2GqjTgZjKaKLQeZnMc4LAReL08rTbopbLbuTx4KDOdtbry7DYmrvfrrPaoXK5K5zOegAAACH5BAEAAAAALAAAAAAQABAAAAhMAAEIHEiwoMGDCBMOlCKgoUMuHghInEiggEOHAC5eJNhQ4UAuAjwIJLCR4AEBDQS2uHiAYLGOHjNqlCmgYAONApQ0jBGzp8+fQH8GBAA7';
    }

    /**
     * Gets menu tab
     *
     * @return string
     */
    public function getTab()
    {
        return 'v' . $this->_version;
    }

    /**
     * Gets content panel
     *
     * @return string
     */
    public function getPanel()
    {
//        $channel = new Zend_Feed_Rss('http://framework.zend.com/security/feed');
        $string = '';

//        foreach ($channel as $item) {
//            $string .= '<a href="' . $item->link() . '" title="' . $item->title() . '" target="_new">' . $item->title() . '</a><br />';
//        }

        $html = <<<HTML

			<h4>
				<b>Zend Framework</b>
			</h4>

			<p>
				{$string}
			</p>
HTML;

        return $html;
    }

}
