<?php


namespace shop\forms\manage\Shop\Product;


use shop\entities\Shop\Discount;
use yii\base\Model;

class DiscountForm extends Model
{
    public $percent;
    public $name;

    public $from_date;
    public $to_date;
    public $active;
    public $sort;

    public function __construct(Discount $tag = null, $config = [])
    {
        if ($tag) {
            $this->percent = $tag->percent;
            $this->name = $tag->name;
            $this->from_date= $tag->from_date;
            $this->to_date= $tag->to_date;
            $this->active= $tag->active;
            $this->sort= $tag->sort;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['percent', 'name','from_date','to_date','active','sort'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['percent','sort'],'integer'],
            [['active'], 'boolean'],
            //[['from_date','to_date'],  'date','format'=>'php:Y.m.d'],
           // [['from_date','to_date'],  'date','format'=>'php:Y-m-d'],

        ];
    }
}