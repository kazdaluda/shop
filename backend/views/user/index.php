<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\forms\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">



    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
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
                    [
                        'attribute'=> 'username',
                        'value'=>function(\shop\entities\User\User $user){
                            return Html::a(Html::encode($user->username),['view','id'=>$user->id]);
                        },
                        'format'=>'raw',
                    ],

                    //'auth_key',
                    //'password_hash',
                    //'password_reset_token',
                    'email:email',
                    [
                       'attribute'=>'role',
                       'class'=>\backend\widgets\grid\RoleColumn::class,
                       'filter'=>$searchModel->rolesList(),
                    ],
                    [
                        'attribute'=>'status',
                        'filter'=>\shop\helpers\UserHelper::statuslist(),
                        'value'=>function(\shop\entities\User\User $user){
                            return \shop\helpers\UserHelper::statusLabel($user->status);
                        },
                        'format'=>'raw'
                    ],
                    [
                        'attribute'=> 'updated_at',
                        'filter'=>\kartik\widgets\DatePicker::widget([
                            'model'=>$searchModel,
                            'attribute'=>'date_from',
                            'attribute2'=>'date_to',
                            'type'=>\kartik\date\DatePicker::TYPE_RANGE,
                            'separator'=>'-',
                            'pluginOptions' => [
                                'todayHighlight'=>true,
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]),
                        'format'=>'datetime',
                    ],

                    //'verification_token',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>

</div>