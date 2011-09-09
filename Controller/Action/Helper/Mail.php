<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   ActionHelper
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Action Helper
 *
 * Expects mail resource to be created, ie using Gmail
 *
 * resources.mail.transport.type = "smtp"
 * resources.mail.transport.port = "587"
 * resources.mail.transport.host = "smtp.gmail.com"
 * resources.mail.transport.auth = "login"
 * resources.mail.transport.ssl = "tls"
 * resources.mail.transport.username = "user@example.com"
 * resources.mail.transport.password = "password"
 * resources.mail.defaultFrom.email = "noreply@example.com"
 * resources.mail.defaultFrom.name = "Example"
 * resources.mail.defaultReplyTo.email = "noreply@example.com"
 * resources.mail.defaultReplyTo.name = "Exmaple"
 *
 * @category  CodeBlender
 * @package   ActionHelper
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 *
 * @todo Log any errors correctly
 * @todo Catch any Log issues with the attachments
 * @todo
 */
class CodeBlender_Controller_Action_Helper_Mail extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Attachment list
     * The default behavior of Zend_Mail is to assume the attachment is a binary object
     * (application/octet-stream), it should be transferred with base64 encoding.
     *
     * @var array
     */
    protected $attachment = array();
    /**
     * Email address, name key pair of the sender
     *
     * @var array
     */
    protected $emailFrom = array();
    /**
     * Email address, name key pair of the recipient
     *
     * @var array
     */
    protected $emailTo = array();
    /**
     * Mail object
     *
     * @var object
     */
    protected $mail = false;
    /**
     * Class paramaters
     *
     * @var array
     */
    protected $params = array();
    /**
     * Email subject
     *
     * @var string
     */
    protected $subject = false;
    /**
     * Email Text - HTML
     *
     * @var string
     */
    protected $textHTML = false;
    /**
     * Email Text - Plain
     *
     * @var string
     */
    protected $textPlain = false;

    /**
     * Method to send emails out.
     * Create the parameters in the Controller like below to invoke this action helper
     *
     * <code>
     * $params = array(
     *     'emailFrom' => array($values['contactEmail'], $values['contactName']),
     *     'emailTo'   => array($config->mail->to => $config->mail->name, 'test@domain.com' => 'Tester'),
     *     'subject'   => Zend_Registry::get('siteName') . ' ' . $values['contactSubject'],
     *     'textHTML'  => $html,
     *     'textPlain' => $text
     *   );
     *
     * $mail = $this->_helper->getHelper('Mail')->sendMail($params);
     * </code>
     *
     * @param  array $params Array of attribute values
     * @return void
     */
    public function sendMail($params = array())
    {
        // Merge the two arrays to overwrite default values.
        $this->params = array_merge(get_class_vars(__CLASS__), $params);

        try {

            // Loop through the sending of the messages
            foreach ($this->params['emailTo'] as $k => $v) {

                // Instantiate Zend Mail
                $this->mail = new Zend_Mail();

                // Create the Plain Text part of the email
                if (!empty($this->params['textPlain'])) {
                    $this->mail->setBodyText($this->params['textPlain']);
                }

                // Create the HTML part of the email
                if (!empty($this->params['textHTML'])) {
                    $this->mail->setBodyHtml($this->params['textHTML']);
                }

                // Check to see if the user wishes to send Attachments
                if (!empty($this->params['attachment'])) {
                    self::_attachment();
                }

                // Check to see if the user wishes to send Attachments
                if (!empty($this->params['emailFrom'])) {
                    $this->mail->setFrom($this->params['emailFrom'][0], $this->params['emailFrom'][1]);
                    $this->mail->setReplyTo($this->params['emailFrom'][0], $this->params['emailFrom'][1]);
                }

                // Headers
                $this->mail->setDate(date(DATE_RFC2822));

                // Recipients
                $this->mail->addTo($k, $v)
                        ->setSubject($this->params['subject'])
                        ->send($this->mail->getDefaultTransport());
            }
        } catch (Exception $e) {
            Zend_Debug::dump($e->getMessage());
        }
    }

    /**
     * Method to handle the addition of attachments to the email
     * Add the necessary attachments to the parameters.
     *
     * <code>
     * 'attachment' => array(
     *     'README.txt'  => file_get_contents('/Users/iwarner/Triangle/Bash/README.txt'),
     *     'R-intro.pdf' => file_get_contents('/Users/iwarner/Desktop/R-intro.pdf')
     *   ),
     * </code>
     *
     * @return object $attachments
     */
    private function _attachment()
    {
        // Loop through the Attachment array and add them to the mail
        foreach ($this->params['attachment'] as $k => $v) {
            $at = $this->mail->createAttachment($v);
            $at->filename = $k;
        }
    }

}
