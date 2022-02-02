<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model shop\forms\manage\User\UserCreateForm */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-create">
    <?php $form=\yii\widgets\ActiveForm::begin() ; ?>
    <?= $form->field($model,'username')->textInput(['maxLength'=>true]) ?>
    <?= $form->field($model,'email')->textInput(['maxLength'=>true]) ?>
    <?= $form->field($model,'password')->textInput(['maxLength'=>true]) ?>
    <?= $form->field($model,'phone')->textInput(['maxLength'=>true]) ?>
    <?= $form->field($model,'role')->dropDownList($model->rolesList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php \yii\widgets\ActiveForm::end() ?>



</div>