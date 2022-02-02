<?php
namespace shop\services;

use shop\forms\ContactForm;
use yii\mail\MailerInterface;

class ContactService
{

  private $adminEmail;
  private $mail;

  public function __construct($adminEmail, MailerInterface $mail)
  {
      $this->mail=$mail;
      $this->adminEmail=$adminEmail;
  }
  public function send(ContactForm $form)
  {
      $sent=$this->mail->compose()
          ->setTo($this->adminEmail)
          ->setSubject($form->subject)
          ->setTextBody($form->body)
          ->send();

      if (!$sent){
          throw new \RuntimeException('Sending error');
      }
  }
}















