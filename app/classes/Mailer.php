<?php

namespace App\Classes;

/**
 * This example shows how to extend PHPMailer to simplify your coding.
 * If PHPMailer doesn't do something the way you want it to, or your code
 * contains too much boilerplate, don't edit the library files,
 * create a subclass instead and customise that.
 * That way all your changes will be retained when PHPMailer is updated.
 */

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Async PHP
use Spatie\Async\Pool;

/**
 * Use PHPMailer as a base class and extend it
 */
class Mailer extends PHPMailer
{
    private $_user;
    /**
     * myPHPMailer constructor.
     *
     * @param bool|null $exceptions
     * @param string    $body A default HTML message body
     */
    public function __construct($exceptions = true)
    {
        //Don't forget to do this or other things may not be set correctly!
        parent::__construct($exceptions);
        //Set a default 'From' address
        $this->setFrom(CONTACT_EMAIL, CONTACT_EMAIL_NAME);
        // $this->_user = new User();
    }

    //Extend the send function
    /**
     * Mailer sendMessage.
     *
     * @param string    $nessage A default HTML message body
     * @param string    $subject Subject of the mail
     * @param array|object    $to Recipients
     * @param array|object    $from Sender
     */
    public function sendMessage(
        $message,
        $subject,
        $to = array('email' => 'johndoe@gmail.com', 'first_name' => 'John', 'last_name' => 'Doe'),
        $from = array('email' => CONTACT_EMAIL, 'name' => CONTACT_EMAIL_NAME),
        $is_multiple_to = false,
        $to_verified_email = true
    ) {

        // Fetch template
        // $template = file_get_contents('../assets/templates/craft.html');
        $template = file_get_contents(APP_ASSETS_PATH . '/templates/email.html');
        $message = str_replace('[message]', trim($message), trim($template));

        //Set a default 'From' address
        if ($from) {
            $this->setFrom($from['email'], $from['name'], 0);
        }

        // Set Subject 
        $this->Subject = $subject;
        if ($is_multiple_to) {
            foreach ($to as $to_add) {
                $this->addAddress($to_add);
            }
        } else {
            $to_name = isset($to['name']) ? $to['name'] : $to['first_name'] . ' ' . $to['last_name'];
            $this->addAddress($to['email'], $to_name);
        }

        // $this->addBCC($to['email'], $to_name);
        //Set an HTML and plain-text message, import relative image references
        $this->msgHTML($message, './assets/images/');

        // $this->Subject = '[Yay for me!] ' . $this->Subject;
        if (parent::send()) {
            // echo 'I sent a message with subject ' . $this->Subject;
            // Clear Addresses
            $this->clearAddresses();
            // $this->clearBCCs()
            return true;
        }

        return false;
    }
}
