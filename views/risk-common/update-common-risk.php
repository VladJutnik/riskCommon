<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'ПЕРЕЧЕНЬ ВОПРОСОВ ДЛЯ ОЦЕНКИ ОБЩЕГО РИСКА ';
/*print_r('<pre>');
print_r($patients);
print_r('</pre> <br>');
print_r($models->attributeLabels()['id']);
print_r('</pre>');*/

//var_dump($model->getErrors());
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
    <div class="blockView p-2">
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        <h5 class="text-center text-danger"><i>(ответы формируются отдельно для 1-4 классов; 5-9 классов и 10-11
                классов)</i></h5>
        <?= Html::a(
            'Вернуться назад',
            ['view-common-risk?key=' . $model['key']],
            [
                //'title' => Yii::t('yii', 'Добавить индивидуальный риск (для внесения понадобиться ключ)'),
                'class' => 'btn btn-sm btn-outline-danger',
            ]
        ); ?>
        <?php
        $form = ActiveForm::begin(); ?>

        <?=
        $this->render(
            '_form.php',
            [
                'model' => $model,
                'district_items' => $district_items,
                'region_items' => $region_items,
                'municipality_items' => $municipality_items,
                'form' => $form,
            ]
        ); ?>
        <!-- <script type="text/javascript">
             document.oncontextmenu = new Function('return false')
             document.body.oncut = new Function('return false');
             document.body.oncopy = new Function('return false');
             document.body.onpaste = new Function('return false');
         </script>
         <style>
             .node88 {
                 -webkit-user-select: none;  /* Chrome all / Safari all */
                 -moz-user-select: none;     /* Firefox all */
                 -ms-user-select: none;      /* IE 10+ */
                 user-select: none;          /* Likely future */
             }
             /*Mobile*/
             -webkit-touch-callout: default   /* displays the callout */
             -webkit-touch-callout: none      /* disables the callout */
         </style>-->
        <!--<div class="rewiew__political mt-3">
            <?/*= $form->field(
                $model,
                'check'
            )->checkbox(
                ['checked' => false]
            )->label('Я подтверждаю что я не робот и согласен с обработкой персональных данных')
            /*label('Я согласен с ' .
                HTML::a(' Политикой конфиденциальности ', '@web/approval.pdf', ['target' => '_blank']
                ) . ' и обработкой персональных данных'
            )
            */?>
        </div>-->
     <!--   <div class="row mt-2 mb-0 ml-0 mr-0 checking-robot">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 font-weight-bold mt-2 text-center text-danger" >
                <i>Прежде чем данные и расчтить риск, пожалуйста внесите число (выделенное желтым) в "Окошко для ввода"</i>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold text-center" >
                <b>Число которое необходимо внести в "Окошко для ввода": <mark><?/*= $model->captcha */?></b></mark>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 font-weight-bold mt-1">
                <?/*= $form->field($model, 'recaptcha')->textInput(['placeholder' => 'Окошко для ввода'])->label(false) */?>
            </div>
        </div>-->



        <div class="form-group">
            <?= Html::submitButton(
                'Сохранить',
                ['class' => 'btn btn-outline-primary mt-3 px-5 radius-30 btn-block']
            ) ?>
        </div>

        <?php
        ActiveForm::end(); ?>
    </div>
    </div>



<?php
$js = <<< JS
 var riskassessmentorganizationcommon = $('#riskassessmentorganizationcommon-class');
    riskassessmentorganizationcommon.on('change', function () {
        if (riskassessmentorganizationcommon.val() === "342") {
            $('.field-riskassessmentorganizationcommon-fieldtheme5_4_5').show();
        }
        else{
            $('.field-riskassessmentorganizationcommon-fieldtheme5_4_5').hide();
        }
    });
    riskassessmentorganizationcommon.trigger('change');

JS;
$this->registerJs($js, \yii\web\View::POS_READY);