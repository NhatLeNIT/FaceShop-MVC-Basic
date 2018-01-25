<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 29-May-17
 * Time: 13:59
 */
class MailLibrary
{
    private $email = '';
    private $pass = '';

    public function init($email, $pass)
    {
        $this->email = $email;
        $this->pass = $pass;
    }

    public function sendMail($from, $to, $subject, $message)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $subject = "=?UTF-8?B?" . base64_encode($subject) . "?=\n";

        require_once('mail/class.phpmailer.php');
        //include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPDebug = 1;                     // enables SMTP debug information (for testing)
        // 1 = errors and messages
        // 2 = messages only
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port = 465;                   // set the SMTP port for the GMAIL server
        $mail->Username = $this->email;  // GMAIL username
        $mail->Password = $this->pass;  // GMAIL password or App password

        $mail->SetFrom($from, $from);

        $mail->AddReplyTo($from, $from);

        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->IsHTML(true);
        $mail->AddAddress($to, "");

        if (!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }
}