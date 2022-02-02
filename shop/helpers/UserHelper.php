<?php
namespace shop\helpers;

use shop\entities\User\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class UserHelper
{
 public static function statuslist():array
 {
     return [
       User::STATUS_INACTIVE=>'Wait',
       User::STATUS_ACTIVE=>'Active',
     ];
 }
 public static function statusName($status):string
 {
     return ArrayHelper::getValue(self::statuslist(),$status);
 }
 public static function statusLabel($status):string
 {
     switch ($status){
         case User::STATUS_INACTIVE:
             $class='label label-default';
             break;
         case User::STATUS_ACTIVE:
             $class='label label-success';
             break;
         default:
             $class='label label-default';
     }
     return Html::tag('span', ArrayHelper::getValue(self::statuslist(),$status),
         ['class'=>$class]);

 }

}