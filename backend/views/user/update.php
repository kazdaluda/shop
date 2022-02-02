<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user shop\entities\User\User */


$this->title = 'Update User: ' . $user->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="user-update">

    <?php $form=\yii\widgets\ActiveForm::begin() ; ?>
    <?= $form->field($model,'username')->textInput(['maxLength'=>true]) ?>
    <?= $form->field($model,'email')->textInput(['maxLength'=>true]) ?>
    <?= $form->field($model,'status')->textInput(['maxLength'=>true]) ?>
    <?= $form->field($model,'phone')->textInput(['maxLength'=>true]) ?>
    <?= $form->field($model,'role')->dropDownList($model->rolesList()) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php \yii\widgets\ActiveForm::end() ?>



</div>