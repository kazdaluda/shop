<?php

/* @var $this yii\web\View */
/* @var $brand shop\entities\Shop\Brand */
/* @var $model shop\forms\manage\Shop\BrandForm */

$this->title = 'Update Review';
$this->params['breadcrumbs'][] = ['label' => 'Review', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'review_'.$rview->id, 'url' => ['view', 'product_id' => $rview->product,'id'=>$rview->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
