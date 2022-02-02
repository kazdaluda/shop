<?php
/** @var $products shop\entities\Shop\Product\Product[] */
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?php foreach ($products as $product): ?>
    <?php $url = Url::to(['/shop/catalog/product', 'id' =>$product->id]); ?>
    <?php if ($product->mainPhoto): ?>
        <div class="item text-center">
            <a href="<?= Html::encode($url) ?>">
                <img src="<?= Html::encode($product->mainPhoto->getThumbFileUrl('file')) ?>" alt="" class="img-responsive" />
            </a>
        </div>
    <?php endif; ?>
<?php endforeach; ?>