<?php


namespace console\controllers;


use shop\entities\Shop\Product\Product;
use shop\entities\User\User;
use yii\console\Controller;

class TestController extends Controller
{
    public $user;
    public $product;
   public function __construct($id, $module,User $user,Product $product, $config = [])
   {
       $this->user=$user;
       $this->product=$product;
       parent::__construct($id, $module, $config);
   }

    public function actionTest()
   {
      \Yii::$app->queue->push(new TestJob([
           'name'=>'vova+luda=live'
       ]));
     /*\Yii::$app->mailer

         ->compose(
             ['html' => 'shop/wishlist/available-html', 'text' => 'shop/wishlist/available-text'],
             ['user' => $this->user, 'product' => $this->product]
         )
         ->setTo('ddee@dd.dd')
         ->setSubject('Product is available')
         ->send();*/
   }
}