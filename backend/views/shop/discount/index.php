<?php

use shop\entities\Shop\Discount;
use shop\helpers\DiscountHelper;
use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\forms\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Discount';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">



    <p>
        <?= Html::a('Create Discount', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name',
                    [
                        'attribute'=>'active',
                        'filter'=>DiscountHelper::statuslist(),
                        'value'=>function(Discount $user){
                            return DiscountHelper::statusLabel($user->active);
                        },
                        'format'=>'raw'
                    ],
                    'percent',
                    'from_date',
                    'to_date',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>

</div>