<?php

namespace shop\entities\Shop;

use shop\entities\Shop\queries\DiscountQuery;
use yii\db\ActiveRecord;

/**
 * @property integer $percent
 * @property string $name
 * @property string $from_date
 * @property string $to_date
 * @property bool $active
 * @property integer $sort
 */
class Discount extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    public static function create($percent, $name, $fromDate, $toDate, $sort): self
    {
        $discount = new static();
        $discount->percent = $percent;
        $discount->name = $name;
        $discount->from_date = $fromDate;
        $discount->to_date = $toDate;
        $discount->sort = $sort;
        $discount->active = true;
        return $discount;
    }

    public function edit($percent, $name, $fromDate, $toDate, $sort): void
    {
        $this->percent = $percent;
        $this->name = $name;
        $this->from_date = $fromDate;
        $this->to_date = $toDate;
        $this->sort = $sort;
    }

    public function isActive()
    {
        if ($this->active){
            return true;
        }
        return false;
    }


    public function activate(): void
    {
        $this->active = true;
    }

    public function draft(): void
    {
        $this->active = false;
    }

    public function isEnabled($discount): bool
    {

        if (strtotime($discount->to_date)>time()&& time()>strtotime($discount->from_date)){
            return true;
        }
        return false;
    }

    public static function tableName(): string
    {
        return '{{%shop_discounts}}';
    }

    public static function find(): DiscountQuery
    {
        return new DiscountQuery(static::class);
    }
}