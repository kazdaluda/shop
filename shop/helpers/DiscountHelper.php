<?php


namespace shop\helpers;


use shop\entities\Shop\Discount;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class DiscountHelper
{
    public static function statuslist():array
    {
        return [
            Discount::STATUS_INACTIVE=>'Wait',
            Discount::STATUS_ACTIVE=>'Active',
        ];
    }
    public static function statusName($status):string
    {
        return ArrayHelper::getValue(self::statuslist(),$status);
    }
    public static function statusLabel($status):string
    {
        switch ($status){
            case Discount::STATUS_INACTIVE:
                $class='label label-default';
                break;
            case Discount::STATUS_ACTIVE:
                $class='label label-success';
                break;
            default:
                $class='label label-default';
        }
        return Html::tag('span', ArrayHelper::getValue(self::statuslist(),$status),
            ['class'=>$class]);

    }
}