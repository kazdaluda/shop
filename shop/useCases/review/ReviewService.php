<?php
namespace shop\useCases\review;

use shop\repositories\Shop\ProductRepository;


class ReviewService
{

    private $product;

  public function __construct(ProductRepository $product)
  {
      $this->product=$product;

  }

  public function create($user_id,$vote,$text,$product_id)
  {
      $product=$this->product->get($product_id);
      $product->addReview($user_id,$vote,$text);
      $this->product->save($product);

  }
}