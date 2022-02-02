<?php

namespace shop\listeners\Shop\Product;

use shop\entities\Shop\Product\events\ProductAppearedInStock;
use shop\entities\Shop\Product\Product;
use shop\entities\User\User;
use shop\jobs\Shop\Product\ProductAvailabilityNotification;
use shop\repositories\UserRepository;
use yii\base\ErrorHandler;
use yii\mail\MailerInterface;
use zhuravljov\yii\queue\Queue;

class ProductAppearedInStockListener
{
   /* private $queue;
    private $users;
    public function __construct(UserRepository $users, \zhuravljov\yii\queue\db\Queue $queue)
    {

        $this->users=$users;
        $this->queue=$queue;
    }
    public function handle(ProductAppearedInStock $event)
    {

        if ($event->product->isActive()){

            $this->queue->push(new ProductAvailabilityNotification($event->product,$this->users));
        }
    }*/
     private $users;
     private $mailer;
     private $errorHandler;

     public function __construct(UserRepository $users, MailerInterface $mailer, ErrorHandler $errorHandler)
     {

         $this->users = $users;
         $this->mailer = $mailer;
         $this->errorHandler = $errorHandler;
     }

     public function handle(ProductAppearedInStock $event): void
     {

         if ($event->product->isActive()) {

             foreach ($this->users->getAllByProductInWishList($event->product->id) as $user) {

                 if ($user->isActive()) {

                     try {
                         $this->sendEmailNotification($user, $event->product);
                     } catch (\Exception $e) {
                         $this->errorHandler->handleException($e);
                     }
                 }
             }
         }
     }

     private function sendEmailNotification(User $user, Product $product): void
     {

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