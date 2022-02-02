<?php


namespace frontend\widgets\Shop;


use shop\readModels\Shop\ProductReadRepository;
use yii\base\Widget;

class vovaWidget extends Widget
{
    public $limit;

    private $repository;

    public function __construct(ProductReadRepository $repository, $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->render('vova', [
            'products' => $this->repository->getFeatured($this->limit)
        ]);
    }
}