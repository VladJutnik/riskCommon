<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'МР «Оценка коллективных и индивидуальных рисков нарушений осанки и зрения у обучающихся общеобразовательных организаций»';

/*print_r('<pre>');
print_r($RiskAssessmentCollective);
print_r('</pre>');*/
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
        <h5 class="text-center">Оценка работы калькулятора</h5>
        <?php
        $form = ActiveForm::begin(); ?>
        <div class="text-center">
            <?=
            $form->field($model, 'estimation')
                ->radioList([
                    '1' => 'Отлично',
                    '2' => 'Хорошо',
                    '3' => 'Плохо'
                ]);
            ?>
        </div>

        <?= $form->field($model, 'text', [
            'options' => ['class' => 'row mt-2 mb-0 ml-0 mr-0'],
            'labelOptions' => ['class' => 'col-sm-12 col-md-12 col-lg-12 col-xl-12 font-weight-bold mt-1'],
        ])->textarea(
            ['class' => 'form-control col-sm-12 col-md-12 col-lg-12 col-xl-12']
        ) ?>

        <div class="form-group">
            <?= Html::submitButton(
                'Оценить',
                ['class' => 'btn btn-outline-primary mt-3 px-5 radius-30 btn-block']
            ) ?>
        </div>

        <?php
        ActiveForm::end(); ?>
        <br>
    </div>
</div>
<br>
<br>


