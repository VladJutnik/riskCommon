<?php

use kartik\select2\Select2;
use yii\captcha\Captcha;

?>
<?= $form->field($model, 'year', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->academicYear(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>

<?= $form->field($model, 'class', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->trainingClass(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>

<div class="row mt-3">
    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-2 font-weight-bold signup-name">Федеральный округ</div>
    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 mb-2">
        <?=
        $form->field($model, 'federal_district_id')
            ->widget(
                Select2::classname(),
                [
                    'data' => $district_items,
                    'options' => [
                        //'required' => true,
                        'placeholder' => 'Выберите федеральный округ',
                        'class' => 'wwww',
                        'options' => [
                            //3 => ['disabled' => true],
                            'class' => 'wwww2',
                        ],
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]
            )->label(false);

        ?></div>

    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-2 font-weight-bold signup-name">Субъект федерации </div>
    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 mb-2"><?=
        $form->field($model, 'region_id')
            ->widget(
                Select2::classname(),
                [
                    'data' => $region_items,
                    'options' => [
                        'placeholder' => 'Выберите регион',
                    ],
                ]
            )->label(false);
        ?></div>

    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-2 font-weight-bold signup-name">Муниципальное
        образование  </div>
    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 mb-2"><?=
        $form->field($model, 'municipality_id')
            ->widget(
                Select2::classname(),
                [
                    'data' => $municipality_items,
                    'options' => [
                        //'required' => true,
                        'placeholder' => 'Выберите муниципальное образование',
                        'class' => 'wwww',
                    ],
                ]
            )->label(false);
        ?></div>

</div>
<?= $form->field($model, 'name_responsible_person', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->textInput(['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']) ?>

<div class="text-center m-2 text-danger">
    <h5>
        Фактор риска «МЕБЕЛЬ»
    </h5>
</div>
<div class="  ">
    <h5>1. В учебных классах и кабинетах, в которых проходят учебные занятия УЧЕНИЧЕСКАЯ МЕБЕЛЬ:</h5>
</div>
<?= $form->field($model, 'fieldTheme1_1', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme1(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme1_2', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme1(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme1_3', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme1(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme1_4', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme1(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme1_5', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme1(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>

<div class="text-center m-2 text-danger">
    <h5>
        Фактор риска «ИСКУССТВЕННОЕ ОСВЕЩЕНИЕ»
    </h5>
</div>
<div class=" ">
    <h5>2. В учебных классах и кабинетах, в которых проходятучебные занятия ИСКУССТВЕННОЕ ОСВЕЩЕНИЕ:</h5>
</div>

<?= $form->field($model, 'fieldTheme2_1', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme2(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme2_2', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme2(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme2_3', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme2(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme2_4', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme2(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<div class="text-center m-2 text-danger">
    <h5>
        Фактор риска «Отсутствие ГИМНАСТИКИ ДЛЯ ГЛАЗ в течение учебного дня»
    </h5>
</div>
<div class="  ">
    <h5>3. Проводится ли ГИМНАСТИКА ДЛЯ ГЛАЗ в течение учебного дня:</h5>
</div>
<?= $form->field($model, 'fieldTheme3_1', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme3(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme3_2', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme3(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<div class="text-center m-2 text-danger">
    <h5>
        Фактор риска «Отсутствие ГИМНАСТИКИ ДЛЯ мышц спины и шеи в течение учебного дня»
    </h5>
</div>
<div class=" ">
    <h5>4. Проводится ли ГИМНАСТИКА МЫШЦ СПИНЫ И ШЕИ в течение учебного дня:</h5>
</div>

<?= $form->field($model, 'fieldTheme4_1', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme4(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>

<div class="text-center m-2 text-danger">
    <h5>
        Фактор риска «НЕРАЦИОНАЛЬНОЕ ИСПОЛЬЗОВАНИЕ ЭЛЕКТРОННЫХ СРЕДСТВ ОБУЧЕНИЯ И СРЕДСТВ МОБИЛЬНОЙ СВЯЗИ»
    </h5>
</div>
<div class=" ">
    <h5>5. Насколько рационально организовано использование ЭСО (включая интерактивные доски, интерактивные панели, компьютеры, ноутбуки, планшеты) и средств мобильной связи (сотовые телефоны) в общеобразовательной организации:</h5>
</div>

<?= $form->field($model, 'fieldTheme5_1', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme5(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme5_2', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme5(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme5_3', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme5(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<div class="text-center m-2"><h6>
        5.4. Конструктивные особенности используемых ЭСО на уроках:
    </h6></div>
<?= $form->field($model, 'fieldTheme5_4_1', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme6(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme5_4_2', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme6(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme5_4_3', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme6(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme5_4_4', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme6(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>
<?= $form->field($model, 'fieldTheme5_4_5', [
    'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
    'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1'],
])->dropdownList(
    Yii::$app->riskComponent->fieldTheme6(),
    ['class' => 'form-control col-sm-12 col-md-12 col-lg-6 col-xl-6']
) ?>

<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
    'captchaAction' => 'risk-common/captcha',
    'template' => '<div class="row mt-2 mb-0 ml-0 mr-0"><div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold  text-center">{image}</div><div class="cform-control col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">{input}</div></div>',
]) ?>

<?php
$js = <<< JS
$('#riskassessmentorganizationcommon-federal_district_id').change(function() {
    $.ajax({
    url: "../../site/subjectslist",
        type: "GET",      // тип запроса
        data: { // действия
            'id': $('#riskassessmentorganizationcommon-federal_district_id').val()
        },
        // Данные пришли
        success: function( data ) {
          $("#riskassessmentorganizationcommon-region_id").html(data)
        },
        error: function(err) {
           console.log(err);
        }
    })
    $.ajax({
    url: "../../site/municipalitylist",
         type: "GET",      // тип запроса
         data: { // действия
             'id': 0
         },
         // Данные пришли
         success: function( data ) {
           $("#riskassessmentorganizationcommon-municipality_id").html(data)
         },
         error: function(err) {
            console.log(err);
         }
    })
});
	
$('#riskassessmentorganizationcommon-region_id').change(function() {
    $.ajax({
         url: "../../site/municipalitylist",
              type: "GET",      // тип запроса
              data: { // действия
                  'id': $('#riskassessmentorganizationcommon-region_id').val()
              },
              // Данные пришли
              success: function( data ) {
                $("#riskassessmentorganizationcommon-municipality_id").html(data)
              },
              error: function(err) {
                 console.log(err);
              }
    })
});	
    var randNum =  Math.floor(Math.random() * 20) + 1;
    //console.log(randNum)
    for (i = 0; i < randNum; i++) {
       document.getElementById('riskassessmentorganizationcommon-verifycode-image').click();
    }
JS;
$this->registerJs($js, \yii\web\View::POS_READY);