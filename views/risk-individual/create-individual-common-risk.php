<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'ПЕРЕЧЕНЬ ВОПРОСОВ ДЛЯ ОЦЕНКИ ИНДИВИДУАЛЬНОГО РИСКА';
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
            <h6 class="text-center text-danger"><i>(ответы формируются интервьюером, по каждому респонденту
                    отдельно)</i></h6>
            <h6 class="text-center text-primary"><i>Если у респондента есть нарушение осанки и зрения на момент
                    последнего медицинского осмотра, индивидуальный риск не оценивается</i></h6>

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
                    'modelF' => $modelF,
                    'form' => $form,
                ]
            ); ?>
            <script type="text/javascript">
                document.oncontextmenu = new Function('return false')
                document.body.oncut = new Function('return false');
                document.body.oncopy = new Function('return false');
                document.body.onpaste = new Function('return false');
            </script>

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
    
    var violation_posture = $('#riskassessmentindividualcommon-violation_posture');
    var visual_impairment = $('#riskassessmentindividualcommon-visual_impairment');
        
    violation_posture.on('change', function () {
        if (violation_posture.val() === "99" && visual_impairment.val() === "99") {
            $('.classRedonly').show();
        }
        else{
            $('.classRedonly').hide();
        }
    });
    violation_posture.trigger('change');
    
    
    visual_impairment.on('change', function () {
        if (visual_impairment.val() === "99" && violation_posture.val() === "99") {
            $('.classRedonly').show();
        }
        else{
            $('.classRedonly').hide();
        }
    });
    visual_impairment.trigger('change');

JS;
$this->registerJs($js, \yii\web\View::POS_READY);