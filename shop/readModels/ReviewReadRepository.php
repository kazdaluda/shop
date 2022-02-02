<?php


namespace shop\readModels;
use shop\entities\Shop\Product\Review;

class ReviewReadRepository
{
  public function getAll($id)
  {
      return Review::find()->where(['product'=>$id])->all();
  }
  public function save(Review $review)
  {
      $review->save();
  }
}