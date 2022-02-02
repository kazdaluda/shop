<?php


namespace console\controllers;


use shop\entities\Shop\Product\Product;
use shop\entities\User\User;
use yii\base\Object;
use zhuravljov\yii\queue\Job;

class TestJob extends Object implements Job
{

    public $name;


  public function execute($queue)
  {
      //file_put_contents(__DIR__.'/2.txt',$this->name);
      \yii::$app->mailer
          ->compose(

          )
          ->setTo('gggg@ffff.ff')
          ->setSubject('Product is available')
          ->send();


  }
}