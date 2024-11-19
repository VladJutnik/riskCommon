<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Печать заключения коллективного риска';
?>
<style>
    .blockView {
        -webkit-box-shadow: 0px 5px 21px -4px rgba(7, 49, 81, 0.2);
        -moz-box-shadow: 0px 5px 21px -4px rgba(7, 49, 81, 0.2);
        box-shadow: 0px 5px 21px -4px rgba(7, 49, 81, 0.2);
        border-radius: 5px;
    }
</style>
<div class="container">
    <div class="blockView  p-2">
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        <h5 class="text-center text-danger"><i>(Вам необходимо внести три ключа 1-4, 5-9, 10-11 классов)</i></h5>
        <?
        $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'field1_4')->textInput(['maxlength' => true]); ?>
        <?= $form->field($model, 'field5_9')->textInput(['maxlength' => true]); ?>
        <?= $form->field($model, 'field10_11')->textInput(['maxlength' => true]); ?>
        <div class="form-group">
            <?= Html::submitButton(
                'Скачать заключение',
                ['class' => 'btn btn-sm btn-outline-primary mt-3 px-5 radius-30 btn-block']
            ) ?>
        </div>


        <?php
        ActiveForm::end(); ?>
    </div>
