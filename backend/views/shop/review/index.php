<?php

use shop\entities\Blog\Post\Comment;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Blog\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Review';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    'user_id',
                    'product',
                    'created_at:datetime',
                    [
                        'attribute' => 'active',
                        'filter' => $searchModel->activeList(),
                        'format' => 'boolean',
                    ],
                    [
                            'class' => ActionColumn::class,

                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
