<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.09.2021
 * Time: 15:25
 */

namespace shop\services\auth;


use shop\entities\User;
use shop\repositories\UserRepository;
use shop\forms\auth\PasswordResetRequestForm;
use shop\forms\auth\ResetPasswordForm;
use yii\mail\MailerInterface;


class PasswordResetService
{

    private $mailer;
    private $users;
    public function __construct( MailerInterface $mailer,UserRepository $users)
    {
        $this->users=$users;
        $this->mailer=$mailer;
    }

    public function request(PasswordResetRequestForm $form,$id)
  {
    $user=$this->users->getByEmail($form->email);
     if (!$user->isActive()){
         throw new \DomainException('User is not active');
     }
     if ($user->id!=$id){
         throw new \DomainException('User is not site');
     }

      $user->requestPasswordResset();

     $this->users->save($user);
      $sent= $this
          ->mailer
          ->compose(
              ['html'=>'auth/reset/passwordResetToken-html','text'=>'auth/reset/passwordResetToken-text'],
              ['user'=>$user]
          )

          ->setTo($user->email)
          ->setSubject('Password reset form ' . \Yii::$app->name)
          ->send();
      if (!$sent){
          throw new \RuntimeException('Sending error');
      }
  }
  public function validateToken($token)
  {
    if (empty($token)|| !is_string($token)){
        throw new \DomainException('Password reset token cannot');
    }
    if (!$this->users->existsByPasswordResetToken($token)){
        throw new \DomainException('Wrong password reset token');
    }
  }
  public function reset(string $token, ResetPasswordForm $form)
  {

     $user=$this->users->getByPasswordRestToken($token);

      $user->resetPassword($form->password);

     $this->users->save($user);
  }


}





















