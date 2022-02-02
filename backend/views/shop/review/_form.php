<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\Shop\BrandForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">

            <?= $form->field($model, 'vote')->dropDownList($model->votesList(), ['prompt' => '--- Select ---']) ?>
            <?= $form->field($model, 'text')->widget(\mihaildev\ckeditor\CKEditor::className(),[
               // 'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder'),
            ]) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
