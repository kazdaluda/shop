<?php


namespace shop\repositories\Shop;


use shop\entities\Shop\Discount;

class DiscountRepository
{
    public function get($id): Discount
    {
        if (!$tag = Discount::findOne($id)) {
            throw new NotFoundException('Tag is not found.');
        }
        return $tag;
    }

    public function findByName($name)
    {
        return Discount::findOne(['name' => $name]);
    }

    public function save(Discount $tag): void
    {
        if (!$tag->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Discount $tag): void
    {
        if (!$tag->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}