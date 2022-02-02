<?php


namespace shop\jobs\Shop\Product;


use shop\entities\Shop\Product\Product;
use shop\entities\User\User;
use shop\repositories\UserRepository;
use yii\mail\MailerInterface;

class ProductAvailabilityNotificationHandler
{
    private $users;
    private $mailer;

    public function __construct(UserRepository $users,MailerInterface $mailer)
    {

        $this->users=$users;
        $this->mailer=$mailer;
    }
    public function handle(ProductAvailabilityNotification $job)
    {

        foreach ($this->users->getAllByProductInWishList($job->product->id) as $user){
           if ($user->isActive()){
                try{
                    $this->sendEmailNotification($user,$job->product);
                }catch (\Exception $e){
                    \yii::$app->errorHandler->handleException($e);
                }
            }
        }
    }
    private function sendEmailNotification(User $user,Product $product)
    {
        // file_put_contents(__DIR__.'/1.txt','vova');
        $sent = $this->mailer
            ->compose(
                ['html' => 'shop/wishlist/available-html', 'text' => 'shop/wishlist/available-text'],
                ['user' => $user, 'product' => $product]
            )
            ->setTo($user->email)
            ->setSubject('Product is available')
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Email sending error to ' . $user->email);
        }
    }
}


















