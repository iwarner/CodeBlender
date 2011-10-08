<?php
/**
 * CodeBlender
 *
 * @category   CodeBlender
 * @package    Helpers
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */

/**
 * Class to produce the Login Form
 *
 * This is a generic form for a user login scenario - requiring Email / Password combination.
 *
 * @category   CodeBlender
 * @package    Helpers
 * @copyright  Copyright (c) 2000-2010 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license    http://codeblender.net/license
 */
class CodeBlender_View_Helper_Layout_LoginForm extends Zend_Form
{
    /**
     * Method to initiate global elements for this controller
     *
     * @return void
     */
    public function layout_LoginForm()
    {
        // Set ID of the form
        $this->setName('loginForm');
        $this->setAction('/user/login');

        // Elements for the Credenials Group
        $this->addElement('text', 'loginEmail', array(
          'filters'        => array('StringTrim', 'StringToLower'),
          'label'          => 'Email:',
          'required'       => true,
          'validators'     => array('EmailAddress')
         ));

        $this->addElement('password', 'loginPassword', array(
          'filters'        => array('StringTrim'),
          'label'          => 'Password:',
          'required'       => true,
          'validators'     => array(array('regex', false, array('/^[a-zA-Z0-9_]{6,20}$/i')))
         ));

        $this->addElement('checkbox', 'loginRememberMe', array(
          'label'          => 'Remember Me',
          'checkedValue'   => true,
          'uncheckedValue' => false,
          'value'          => false
         ));

        // submit
        $this->addElement('Submit', 'login', array(
          'label' => 'Login',
          'class' => 'submit'
         ));

        // We want to display a 'failed authentication' message if necessary;
        // we'll do that with the form 'description', so we need to add that decorator.
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'dl', 'class' => 'login')),
            array('Description', array('placement' => 'prepend')),
            'Form'
        ));

        return $this;
    }
}
