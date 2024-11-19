<?php

use yii\captcha\Captcha;

?>
<?= $form->field($model, 'key', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->textInput(['readonly' => true, 'class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
<?= $form->field($model, 'class_individual', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->trainingClassIndividualSTR($modelF->class),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'name_responsible_person_individual', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->textInput(['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>
<?= $form->field($model, 'violation_posture', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldBBBB(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'visual_impairment', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldBBBB(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<div class="classRedonly">
    <div class="text-center m-2 text-danger">
        <h5>
            Фактор риска «СОКРАЩЕНИЕ ОПТИМАЛЬНОГО РАССТОЯНИЯ ОТ ОРГАНА ЗРЕНИЯ ДО РАБОЧЕЙ ПОВЕРХНОСТИ»
        </h5>
    </div>
    <div class= " ">
        <h5>1. Какое количество сантиметров от органа зрения до объекта различения является для ребенка привычным во время учебных занятий :</h5>
    </div>
<?= $form->field($model, 'fieldIndividualTheme1_1', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldIndividualTheme1_2', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldIndividualTheme1_3', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<div class="text-center m-2 text-danger">
    <h5>
        Фактор риска «Отсутствие ГИМНАСТИКИ ДЛЯ ГЛАЗ в течение учебного дня»
    </h5>
</div>
<div class="  ">
    <h5>2. Участие в гимнастике и практическим навыкам :</h5>
</div>
<?= $form->field($model, 'fieldIndividualTheme2_1', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldIndividualTheme2_2', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldIndividualTheme2_3', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<div class="text-center m-2 text-danger">
    <h5>
        Фактор риска «Отсутствие ГИМНАСТИКИ ДЛЯ МЫШЦ СПИНЫ И ШЕИ в течение учебного дня»
    </h5>
</div>
<div class="  ">
    <h5>3. Участие в гимнастике и практическим навыкам:</h5>
</div>
<?= $form->field($model, 'fieldIndividualTheme3_1', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldIndividualTheme3_2', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<div class="text-center m-2 text-danger">
    <h5>
       Фактор риска «НЕРАЦИОНАЛЬНОЕ ИСПОЛЬЗОВАНИЕ ЭЛЕКТРОННЫХ СРЕДСТВ ОБУЧЕНИЯ И СРЕДСТВ МОБИЛЬНОЙ СВЯЗИ»
    </h5>
</div>
<div class="  ">
    <h5>4. Средняя суммарная продолжительность использования электронных средств обучения (включая интерактивные доски, интерактивные панели, компьютеры, ноутбуки, планшеты) и средств мобильной связи (сотовые телефоны) в течение одного дня:</h5>
</div>
<?= $form->field($model, 'fieldIndividualTheme4_1', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldIndividualTheme4_2', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<div class="text-center m-2 text-danger">
    <h5>
        Фактор риска «ДЕФИЦИТ ВРЕМЕНИ НАХОЖДЕНИЯ РЕБЕНКА НА УЛИЦЕ»
    </h5>
</div>
<div class="  ">
    <h5>5. Средняя суммарная продолжительность нахождения ребенка на улице, учитывая прогулки, дорогу до школы и домой (если добирается пешком), дорогу в спортивную секцию или кружок (если добирается пешком) в течение одного дня: </h5>
</div>
<?= $form->field($model, 'fieldIndividualTheme5_1', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldIndividualTheme5_2', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<div class="text-center m-2 text-danger">
    <h5>
         Фактор риска «НАСЛЕДСТВЕННАЯ ОТЯГОЩЕННОСТЬ»
    </h5>
</div>
<div class="  ">
    <h5>6. Наличие миопии у родителей; если кого то из родителей у ребенка нет или нет информации о наличии миопии – выбирается ответ НЕТ: </h5>
</div>
<?= $form->field($model, 'fieldIndividualTheme6_1', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldIndividualTheme6_2', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldThemeIndividual(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
</div>
