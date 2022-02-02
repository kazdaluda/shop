<?php
namespace shop\jobs\Shop;

 abstract class Job implements \zhuravljov\yii\queue\Job
{
   public function execute($queue)
   {
      // file_put_contents(__DIR__.'/2.txt','ddddd');
      /* \yii::$app->mailer
           ->compose(

           )
           ->setTo('gggg@ffff.ff')
           ->setSubject('Product is available')
           ->send();*/
       $listerner=$this->resolveHandler();
       $listerner($this,$queue);
   }
   private function resolveHandler():callable
   {
       return [\yii::createObject(static::class.'Handler'),'handle'];
   }
 }