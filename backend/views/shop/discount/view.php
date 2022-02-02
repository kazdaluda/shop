<?php

use shop\entities\Shop\Discount;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model shop\entities\User\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Discount', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <p>
        <?php if ($model->isActive()): ?>
            <?= Html::a('Draft', ['draft', 'id' => $model->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?= Html::a('Activate', ['activate', 'id' => $model->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="box">
        <div class="box-body">


            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'percent',
                    'sort',

                    [
                        'attribute'=>'active',
                        'filter'=>\shop\helpers\DiscountHelper::statuslist(),
                        'value'=>function(Discount $user){
                            return \shop\helpers\DiscountHelper::statusLabel($user->active);
                        },
                        'format'=>'raw'
                    ],

                    'from_date',
                    'to_date',
                    //'verification_token',
                ],
            ]) ?>
        </div>

    </div>

</div>