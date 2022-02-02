<?php
namespace shop\jobs\Shop\Product;

use shop\entities\Shop\Product\Product;
use shop\entities\User\User;
use shop\jobs\Job;
use shop\repositories\UserRepository;
use yii\mail\MailerInterface;


class ProductAvailabilityNotification extends Job
{
   public $product;


   public function __construct(Product $product)
   {

       $this->product=$product;

   }
  /* public function execute($queue): void
   {
      /\yii::$app->mailer
           ->compose(

           )
           ->setTo('gggg@ffff.ff')
           ->setSubject('Product is available')
           ->send();
       //file_put_contents(__DIR__.'/1.txt','vova');
       $listerner=$this->resolveHandler();
       $listerner($this,$queue);
   }
    private function resolveHandler():callable
    {

        return [\yii::createObject(static::class.'Handler'),'handle'];
    }
    /* public function execute($queue)
     {

       $handler=[\yii::$container->get(static::class.'Handler'),'handle'];
       $handler($this,$queue);
        //foreach ($this->getUsers()->getAllByProductInWishList($this->product->id) as $user){
        foreach ([1] as $user){
            $rr=\yii::$container->get(UserRepository::class);
            \yii::$app->mailer
                ->compose(

                )
                ->setTo('gggg@ffff.ff')
                ->setSubject('Product is available')
                ->send();*/

         /* if ($user->isActive()){
              try{
                  $this->sendEmailNotification($user,$this->product);
              }catch (\Exception $e){
                  \yii::$app->errorHandler->handleException($e);
              }
          }
      }*
   }*/
  /* private function sendEmailNotification(User $user,Product $product)
   {
      // file_put_contents(__DIR__.'/1.txt','vova');
       $sent = $this->getMailer()
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
   private function getUsers()
   {
       return \yii::$container->get(UserRepository::class);
   }
   private function getMailer()
   {
       return \yii::$container->get(MailerInterface::class);
   }*/
}























