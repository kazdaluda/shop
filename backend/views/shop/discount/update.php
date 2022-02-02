<?php

use kartik\widgets\DateTimePicker;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user shop\entities\User\User */


$this->title = 'Update Discount: ' . $user->id;
$this->params['breadcrumbs'][] = ['label' => 'Discount', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="user-update">

    <?php $form=\yii\widgets\ActiveForm::begin() ; ?>
    <?= $form->field($model,'name')->textInput(['maxLength'=>true]) ?>
    <?= $form->field($model,'percent')->textInput(['maxLength'=>true]) ?>

    <?= $form->field($model,'sort')->textInput(['maxLength'=>true]) ?>
    <?=  $form->field($model, 'from_date')->widget(DateTimePicker::className(),[
        'name' => 'dp_1',
        'type' => DateTimePicker::TYPE_INPUT,
        'options' => ['placeholder' => 'Ввод даты'],
        'convertFormat' => true,
        'value'=> date("Y-m-d",(integer) $model->from_date),

        'pluginOptions' => [
            'format' => 'yyyy.MM.dd',

            'autoclose'=>true,
            'weekStart'=>1, //неделя начинается с понедельника
            'startDate' => '01.05.2015 00:00', //самая ранняя возможная дата
            'todayBtn'=>true, //снизу кнопка "сегодня"
        ]
    ]); ?>
    <?=  $form->field($model, 'to_date')->widget(DateTimePicker::className(),[
        'name' => 'dp_1',
        'type' => DateTimePicker::TYPE_INPUT,
        'options' => ['placeholder' => 'Ввод даты/времени...'],
        'convertFormat' => true,
        'value'=> date("Y.m.d",(integer) $model->to_date),
        //'value'=> date("d.m.Y h:i",(integer) $model->to_date),
        'pluginOptions' => [
            // 'format' => 'dd.MM.yyyy hh:i',
            'format' => 'yyyy.MM.dd',
            'autoclose'=>true,
            'weekStart'=>1, //неделя начинается с понедельника
            'startDate' => '01.05.2015 00:00', //самая ранняя возможная дата
            'todayBtn'=>true, //снизу кнопка "сегодня"
        ]
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php \yii\widgets\ActiveForm::end() ?>



</div>