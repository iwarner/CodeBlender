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
 * @see        http://developers.facebook.com/docs/reference/javascript/
 */
class CodeBlender_View_Helper_Facebook_OpenGraph extends Zend_View_Helper_Abstract
{

    /**
     * Helper
     */
    public function facebook_OpenGraph()
    {
        // Config
        $config = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getOption('facebook');
        $string = '';

        if (!empty($config)) {

            $string = <<<HTML

            <meta property="og:description" content="{$this->view->ogDescription}" />
            <meta property="og:image" content="{$this->view->imagePath}{$this->view->ogImage}" />
            <meta property="og:site_name" content="Triangle Solutions" />
            <meta property="og:title" content="{$this->view->ogTitle}" />
            <meta property="og:type" content="article" />
            <meta property="og:url" content="{$this->view->ogURL}" />
            <meta property="fb:app_id" content="{$config['appID']}" />
HTML;
        }

        return $string;
    }

}
