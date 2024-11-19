<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Заполнение данных по респонденту';

?>

<style>
    .blockView {
        -webkit-box-shadow: 0px 5px 21px -4px rgba(7, 49, 81, 0.2);
        -moz-box-shadow: 0px 5px 21px -4px rgba(7, 49, 81, 0.2);
        box-shadow: 0px 5px 21px -4px rgba(7, 49, 81, 0.2);
        border-radius: 5px;
    }
</style>

<div class="container-fluid">
    <div class="blockView p-2">
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        <?= Html::a(
            'Вернуться назад',
            ['view-common-risk?key=' . $modelСhild->key],
            [
                'class' => 'btn btn-sm btn-outline-danger mb-1',
            ]
        ); ?>
        <?php
        $form = ActiveForm::begin(); ?>
        <div class="container">
            <?= $form->field($modelСhild, 'key', [
                'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
            ])->hiddenInput(['readonly' => true, 'class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6'])->label(false) ?>
            <?= $form->field($modelСhild, 'class', [
                'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
            ])->dropdownList(
                Yii::$app->riskComponent->trainingClassIndividualSTR($modelСhild->class_individual),
                ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
            )->label('Выберете класс: ') ?>
            <?= $form->field($modelСhild, 'class_letter', [
                'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
            ])->dropdownList(
                Yii::$app->riskComponent->trainingClassLetter(),
                ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
            )->label('Выберете класс: ') ?>
            <?= $form->field($modelСhild, 'name_responsible_person_individual', [
                'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
            ])->textInput(['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelСhild, 'testing_date', [
                'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
            ])->textInput(['type'=>'date', 'format'=>'dd.mm.Y', 'class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
        </div>
        <hr>
        <h6 class="text-center">Оценка уровня реактивной и личностной тревожности (по Ч.Д. Спилбергеру, ЮЛ. Ханину)</h6>
        <div class="text-center text-danger"><i>Над вопросами не нужно долго задумываться, поскольку нет ни правильных ни неправильных ответов: А - нет, это не так (1); В - пожалуй, так (2); С – верно (3); D - совершенно верно (4). Выберите нужный вариант</i></div>

        <div class="container">
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_1', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_2', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_3', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_4', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_5', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_6', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_7', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_8', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_9', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_10', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_11', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_12', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_13', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_14', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_15', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_16', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_17', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_18', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_19', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_20', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_21', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_22', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_23', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_24', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_25', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_26', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_27', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_28', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_29', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_30', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_31', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_32', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_33', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_34', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_35', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_36', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_37', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_38', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_39', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
            <?= $form->field($modelRiskQuestionnaireSpielberger, 'field_40', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireSpielberger->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>

        </div>
        <hr>
        <h6 class="text-center">ОПРОСНИК на наличие симптомов беспокойства и нервозности, которые могут возникать у ребенка при получении поручений от учителей, родителей (законных представителей), особенно при коротких сроках выполнения; при расспросах ребенка об успехах и неудачах в школе и вне школы; при возникновении проблем в общении со сверстниками</h6>
        <div class="text-center text-danger"><i>(выберите нужное – выбирается один наиболее подходящий на взгляд анкетируемого ответ) – для родителей (законных представителей) и классного руководителя:</i></div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 border-right">
                <h5 class="text-center mt-2 text-primary">Заполняется классным руководителем:</h5>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_1_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_2_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_3_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_4_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_5_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_6_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_7_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <h5 class="text-center mt-2 text-primary">Заполняется родителем:</h5>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_1_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_2_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_3_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_4_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_5_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_6_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireOne, 'field_7_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireOne->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
            </div>
        </div>

        <hr>
        <hr>
        <h6 class="text-center">ОПРОСНИК индикации возможных причин тревожности</h6>
        <div class="text-center text-danger"><i>(по мнению ребенка, родителя (законного представителя) и педагога):</i></div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 border-right">
                <h5 class="text-center mt-2 text-primary">Заполняется классным руководителем:</h5>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_1_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_2_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_3_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_4_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_5_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_6_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_7_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_8_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 border-right">
                <h5 class="text-center mt-2 text-primary">Заполняется родителем:</h5>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_1_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_2_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_3_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_4_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_5_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_6_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_7_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_8_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <h5 class="text-center mt-2 text-primary">Заполняется ребенком:</h5>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_1_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_2_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_3_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_4_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_5_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_6_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_7_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireTwo, 'field_8_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireTwo->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
            </div>
        </div>

        <hr>
        <hr>
        <h6 class="text-center">Меры профилактики, реализуемые в отношении ребенка со стороны учителей (классного руководителя)</h6>
        <div class="text-center text-danger"><i>оценивается по мнению классного руководителя и ребенка:</i></div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 border-right">
                <h5 class="text-center mt-2 text-primary">Заполняется классным руководителем:</h5>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_1_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_2_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_3_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_4_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_5_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_6_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_7_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <h5 class="text-center mt-2 text-primary">Заполняется ребенком:</h5>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_1_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_2_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_3_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_4_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_5_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_6_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireThree, 'field_7_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireThree->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
            </div>
        </div>

        <hr>
        <hr>
        <h6 class="text-center">Меры профилактики, реализуемые в отношении ребенка со стороны родителей - законных представителей</h6>
        <div class="text-center text-danger"><i>оценивается по мнению родителей -законных представителей и ребенка):</i></div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 border-right">
                <h5 class="text-center mt-2 text-primary">Заполняется родителем:</h5>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_1_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_2_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_3_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_4_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_5_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_6_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_7_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_8_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_9_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_10_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <h5 class="text-center mt-2 text-primary">Заполняется ребенком:</h5>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_1_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_2_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_3_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_4_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_5_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_6_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_7_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_8_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_9_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFour, 'field_10_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFour->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>

            </div>
        </div>

        <hr>
        <hr>
        <h6 class="text-center">ОПРОСНИК формы проявления агрессии у ребенка</h6>
        <div class="text-center text-danger"><i>(для родителей (законных представителей) и классного руководителя):</i></div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 border-right">
                <h5 class="text-center mt-2 text-primary">Заполняется классным руководителем:</h5>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_1_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_2_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_3_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_4_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_5_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_6_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_7_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <h5 class="text-center mt-2 text-primary">Заполняется родителем:</h5>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_1_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_2_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_3_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_4_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_5_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_6_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireFive, 'field_7_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireFive->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
            </div>
        </div>

        <hr>
        <hr>
        <h6 class="text-center">Опросник индикации возможных причин агрессивности ребенка</h6>
        <div class="text-center text-danger"><i>(по мнению ребенка, родителя (законного представителя) и педагога):</i></div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 border-right">
                <h5 class="text-center mt-2 text-primary">Заполняется классным руководителем:</h5>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_1_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_2_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_3_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_4_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_5_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_6_teacher', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 border-right">
                <h5 class="text-center mt-2 text-primary">Заполняется родителем:</h5>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_1_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_2_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_3_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_4_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_5_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_6_parent', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <h5 class="text-center mt-2 text-primary">Заполняется ребенком:</h5>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_1_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_2_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_3_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_4_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_5_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
                <?= $form->field($modelRiskQuestionnaireSix, 'field_6_chile', [
                    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
                    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
                ])->dropdownList(
                    $modelRiskQuestionnaireSix->decodingValues(),
                    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
                ) ?>
            </div>
        </div>


        <hr>
        <hr>
        <div class="container">
            <h6 class="text-center">Опросник агрессивности Басса – Дарки</h6>
            <div class="text-center text-danger"><i>Опросник состоит из 75 утверждений, на которые анкетируемый (интервьюируемый) отвечает "да" или "нет"</i></div>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_1', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_2', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_3', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_4', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_5', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_6', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_7', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_8', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_9', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_10', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_11', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_12', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_13', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_14', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_15', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_16', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_17', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_18', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_19', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_20', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_21', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_22', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_23', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_24', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_25', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_26', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_27', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_28', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_29', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_30', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_31', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_32', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_33', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_34', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_35', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_36', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_37', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_38', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_39', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_40', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_41', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_42', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_43', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_44', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_45', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_46', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_47', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_48', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_49', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_50', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_51', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_52', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_53', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_54', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_55', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_56', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_57', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_58', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_59', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_60', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_61', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_62', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_63', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_64', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_65', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_66', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_67', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_68', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_69', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_70', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_71', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_72', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_73', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_74', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
            <?= $form->field($modelRiskQuestionnaireBassDarck, 'field_75', ['options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'], 'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-10 col-xl-10 font-weight-bold mt-1'],])->dropdownList($modelRiskQuestionnaireBassDarck->decodingValues(), ['class' => 'form-control col-sm-12 col-md-12 col-lg-2 col-xl-2']) ?>
        </div>
        <!--<script type="text/javascript">
            document.oncontextmenu = new Function('return false')
            document.body.oncut = new Function('return false');
            document.body.oncopy = new Function('return false');
            document.body.onpaste = new Function('return false');
        </script>-->

        <br>
        <div class="form-group">
            <?= Html::submitButton(
                'Сохранить',
                ['class' => 'btn btn-outline-primary mt-3 px-5 radius-30 btn-sm btn-block']
            ) ?>
        </div>
        <br>
        <?php
        ActiveForm::end(); ?>
    </div>
</div>


<?php
$js = <<< JS

JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>



