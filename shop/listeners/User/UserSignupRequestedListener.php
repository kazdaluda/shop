<?php


namespace shop\listeners\User;



use shop\entities\User\events\UserSignUpRequested;
use yii\mail\MailerInterface;

class UserSignupRequestedListener
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    public function handle(UserSignUpRequested $event): void
    {

        $sent= $this->mailer
            ->compose(
                ['html' => 'auth/signup/passwordResetToken-html', 'text' => 'auth/signup/passwordResetToken-text'],
                ['user' => $event->user]
            )

            ->setTo($event->user->email)
            ->setSubject('Password reset for ' . \Yii::$app->name)
            ->send();
        if (!$sent){
            throw new \RuntimeException('Email sending error.');
        }
    }

}