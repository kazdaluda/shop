<?php


namespace shop\services\manage;


use shop\entities\Shop\Discount;
use shop\forms\manage\Shop\Product\DiscountForm;
use shop\repositories\Shop\DiscountRepository;

class DiscountManageService
{
    private $tags;


    public function __construct(DiscountRepository $tags)
    {
        $this->tags = $tags;

    }

    public function create(DiscountForm $form)
    {
        $tag = Discount::create(
            $form->percent,
            $form->name,
            $form->from_date,
            $form->to_date,
            $form->sort
        );
        $this->tags->save($tag);
        return $tag;
    }

    public function edit($id, DiscountForm $form): void
    {
        $product = $this->tags->get($id);
         $dis=$product->edit(
             $form->percent,
             $form->name,
             $form->from_date,
             $form->to_date,
             $form->sort
         );
        $this->tags->save($product);
    }

    public function activate($id): void
    {
        $product = $this->tags->get($id);
        $product->activate();
        $this->tags->save($product);
    }

    public function draft($id): void
    {
        $product = $this->tags->get($id);
          $product->draft();
        $this->tags->save($product);
    }

    public function remove($id): void
    {
        $dis = $this->tags->get($id);
        $this->tags->remove($dis);

    }

}