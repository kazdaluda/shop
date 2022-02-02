<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $brand shop\entities\Shop\Brand */

$this->title = 'Review';
$this->params['breadcrumbs'][] = ['label' => 'Review', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?php if ($rview->isActive()): ?>
            <?= Html::a('Draft', ['draft', 'productId'=>$rview->product,'id' => $rview->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?= Html::a('Activate', ['activate', 'productId'=>$rview->product,'id' => $rview->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('Update', ['update', 'product_id' => $rview->product,'id'=>$rview->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'product_id' => $rview->product,'id'=>$rview->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $rview,
                'attributes' => [
                    //'id',
                    'user_id',
                    'vote',
                    'product',
                    [
                        'attribute' => 'text',
                        'format' => 'raw',
                    ],
                    'created_at:datetime',
                    'active',
                ],
            ]) ?>
        </div>
    </div>


</div>
