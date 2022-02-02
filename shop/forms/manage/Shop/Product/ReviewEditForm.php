<?php

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Product\Review;
use yii\base\Model;

class ReviewEditForm extends Model
{
    public $vote;
    public $text;
    public $_review;


    public function __construct(Review $review=null, $config = [])
    {
        if ($review){
            $this->vote = $review->vote;
            $this->text = $review->text;
            $this->_review = $review;
        }

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['vote', 'text'], 'required'],
            [['vote'], 'in', 'range' => [1, 2, 3, 4, 5]],
            ['text', 'string'],

        ];
    }
    public function votesList(): array
    {
        return [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        ];
    }
}