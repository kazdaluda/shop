<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model shop\entities\User\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">



    <p>
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
                    'username',
                    //'auth_key',
                    // 'password_hash',
                    'verification_token',
                    'email:email',
                    'phone',
                    [
                        'attribute'=>'status',
                        'filter'=>\shop\helpers\UserHelper::statuslist(),
                        'value'=>function(\shop\entities\User\User $user){
                            return \shop\helpers\UserHelper::statusLabel($user->status);
                        },
                        'format'=>'raw'
                    ],
                    [
                       'label'=>'Role',
                       'value'=>implode(', ',\yii\helpers\ArrayHelper::getColumn(Yii::$app->authManager->getRolesByUser($model->id), 'description')),
                        'format'=>'raw'
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                    //'verification_token',
                ],
            ]) ?>
        </div>

    </div>

</div>