<?php

use common\models\FederalDistrict;
use common\models\Region;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Отчет по общему риску: ';

$items = [
    'net'=>'из Мониторинга питания',
    'da'=>'из Общего доступа',
];
//print_r('<pre>');
//print_r($result);
//print_r('<br><br><br>');
//print_r('</pre>');
//exit();


?>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>

    <?php
    $two_column = ['options' => ['class' => 'row mt-3'], 'labelOptions' => ['class' => 'col-6 col-form-label font-weight-bold']];
    ?>
    <?= $form->field($model, 'federal_district_id', ['options' => ['class' => 'row'], 'labelOptions' => ['class' => 'col-6 col-form-label font-weight-bold']])->dropDownList($district_items, [
        //'prompt' => 'Выберите федеральный округ ...',
        'class' => 'form-control col-6',
        //'options' => [1 => ['Selected' => true]],
        'onchange' => '
            $.get("../risk-common/subjectslist?id="+$(this).val(), function(data){
            //$("#riskassessmentorganizationcommon-region_id").prop("disabled", true);
            
              $("select#riskassessmentorganizationcommon-region_id").html(data);
              
              document.getElementById("riskassessmentorganizationcommon-region_id").disabled = false;
            });
        '
    ]); ?>
    <?= $form->field($model, 'region_id', $two_column)->dropDownList($region_items, [
        //'prompt' => 'Выберите регион ...',
        'class' => 'form-control col-6',
    ]); ?>
    <?= $form->field($model, 'key', $two_column)->dropDownList($items, [
        'class' => 'form-control col-6',
    ])->label('Выгрузка из какой базы?'); ?>
    <div class="form-group row">
        <?= Html::submitButton('Показать', ['name' => 'identificator', 'value' => 'show', 'class' => 'btn main-button-3 form-control mt-3 col-12 identificator']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<? if ($result) {
    $arrfieldTheme1 = [
        'fieldTheme1_1' => 'x1.1. НЕ промаркирована: ',
        'fieldTheme1_2' => 'x1.2. НЕ стандартная: ',
        'fieldTheme1_3' => 'x1.3. НЕ комплектная: ',
        'fieldTheme1_4' => 'x1.4. В классных журналах нет листков здоровья: ',
        'fieldTheme1_5' => 'x1.5. НЕ во всех учебных кабинетах осуществляется подбор мебели для рассаживания детей с учетом роста: ',
        'risk_assessment_1' => 'x1. ИТОГ: ',
        'fieldTheme2_1' => 'x2.1. НЕ контролируется регулярно (реже 2-х раз в учебный год) в ходе производственного контроля и (или) НЕ отвечает гигиеническим требованиям: ',
        'fieldTheme2_2' => 'x2.2. по результатам контрольно-надзорных мероприятий (если они проводились) ВЫЯВЛЯЛИСЬ нарушения действующих санитарных норм и правил в части обеспечения должного уровня искусственной освещенности на рабочих местах обучающихся и (или) классной доске, мониторах компьютеров: ',
        'fieldTheme2_3' => 'x2.3. ИМЕЮТСЯ отдельные перегоревшие лампы в учебных классах и кабинетах: ',
        'fieldTheme2_4' => 'x2.4. НЕ ВО ВСЕХ учебных классах и кабинетах установлены светорассеивающие светильники: ',
        'risk_assessment_2' => 'x2. ИТОГ: ',
        'fieldTheme3_1' => 'x3.1. Гимнастика во время перемен НЕ ПРОВОДИТСЯ: ',
        'fieldTheme3_2' => 'x3.2. Гимнастика во время уроков с использованием электронных средств обучения НЕ ПРОВОДИТСЯ: ',
        'risk_assessment_3' => 'x3. ИТОГ: ',
        'fieldTheme4_1' => 'x4.1. Гимнастика во время перемен НЕ ПРОВОДИТСЯ: ',
        'risk_assessment_4' => 'x4. ИТОГ: ',
        'fieldTheme5_1' => 'x5.1. Средняя продолжительность (в минутах) использования ЭСО во время уроков (проводимых с использованием ЭСО): ',
        'fieldTheme5_2' => 'x5.2. Среднее суммарное время использования ЭСО в школе за учебный день: ',
        'fieldTheme5_3' => 'x5.3. Допускается ли использование сотовых телефонов во время перемен?',
        'fieldTheme5_4_1' => 'x5.4.1 интерактивная доска с диагональю менее 65 дюймов: ',
        'fieldTheme5_4_2' => 'x5.4.2 компьютеры с диагональю монитора – менее 15,6 дюймов: ',
        'fieldTheme5_4_3' => 'x5.4.3 планшеты с диагональю менее 10,5 дюймов: ',
        'fieldTheme5_4_4' => 'x5.4.4 ноутбуки –менее 14 дюймов, планшетов – менее 10,5 дюймов: ',
        'fieldTheme5_4_5' => 'x5.4.5 (для 1-4 классов) ноутбуки без второй клавиатуры: ',
        'risk_assessment_5' => 'x5. ИТОГ: ',
    ];
    ?>
    <div class="p-1">

        <input type="button" class="btn btn-warning btn-block table2excel mb-3 mt-3"
               title="Вы можете скачать в формате Excel" value="Скачать в Excel" id="pechat222">
        <div class="table-responsive">
            <table id="tableId22222" class="table table-bordered table-sm table2excel_with_colors">
                <thead>
                <tr>
                    <th align="center" class="text-center" rowspan="3">№</th>
                    <th align="center" class="text-center" rowspan="3">Федеральный округ</th>
                    <th align="center" class="text-center" rowspan="3">Регион</th>
                    <th align="center" class="text-center" rowspan="3">Муниципальное образование</th>
                    <th align="center" class="text-center" rowspan="3">Название организации</th>
                    <th align="center" class="text-center" rowspan="3">Дата внесения</th>
                    <th align="center" class="text-center" rowspan="3">Группа классов</th>
                    <th align="center" class="text-center" rowspan="3">Общий риск</th>
                    <th align="center" class="text-center" rowspan="3">Общий риск с поправочным индексом</th>
                    <th align="center" class="text-center" colspan="6" rowspan="2">х1. Ученическая мебель</th>
                    <th align="center" class="text-center" colspan="5" rowspan="2">&nbsp;х2. Искусственная
                        освещенность
                    </th>
                    <th align="center" class="text-center" colspan="3" rowspan="2">х3. Гимнастика для глаз</th>
                    <th align="center" class="text-center" colspan="2" rowspan="2">х4. Гимнастика для глаз</th>
                    <th align="center" class="text-center" colspan="9">х5. Использование электронных средств обучения и
                        средств мобильной связи
                    </th>
                    <th align="center" class="text-center" rowspan="3">Общий риск</th>
                    <th align="center" class="text-center" rowspan="3">Общий риск с поправочным индексом</th>
                </tr>
                <tr>
                    <th align="center" class="text-center" colspan="3"></th>
                    <th align="center" class="text-center" colspan="6">х5.4. конструктивные особенности используемых ЭСО
                        на уроках, в том числе недостаточный размер диагонали (1-4):
                    </th>
                </tr>
                <tr>
                    <th align="center" class="text-center">х1.1. не промаркированная мебель</th>
                    <th align="center" class="text-center">х1.2. не стандартная мебель</th>
                    <th align="center" class="text-center">х1.3. не комплектная мебель</th>
                    <th align="center" class="text-center">х1.4. не ведется листок здоровья либо ведется не в полном
                        объёме
                    </th>
                    <th align="center" class="text-center">х1.5. дети не рассаживаются с учетом роста</th>
                    <th align="center" class="text-center">Итог по фактору х1.</th>
                    <th align="center" class="text-center">х2.1. отсутствие производственного контроля за уровнем
                        освещенности в учебных классах и кабинетах
                    </th>
                    <th align="center" class="text-center">х2.2. нарушения санитарного законодательства, выявленные в
                        ходе контрольно-надзорных мероприятий, а также в ходе профилактических визитов течение прошлого
                        учебного года
                    </th>
                    <th align="center" class="text-center">х2.3. наличие в отдельных учебных классах и кабинетах
                        перегоревших ламп
                    </th>
                    <th align="center" class="text-center">х2.4. наличие учебных классов и кабинетов, в которых не
                        установлены светорассеивающие светильники
                    </th>
                    <th align="center" class="text-center">Итог по фактору х2.</th>
                    <th align="center" class="text-center">х3.1. отсутствие проведения гимнастики для глаз вовремя
                        перемен
                    </th>
                    <th align="center" class="text-center">х3.2. отсутствие проведения гимнастики для глаз во время
                        уроков с использованием электронных средств обучения
                    </th>
                    <th align="center" class="text-center">Итог по фактору х3.</th>
                    <th align="center" class="text-center">х4.1. отсутствие проведения гимнастики для мышц спины и шеи
                        вовремя перемен
                    </th>
                    <th align="center" class="text-center">Итог по фактору х4.</th>
                    <th align="center" class="text-center">х5.1. превышение регламентированного СанПиН значения
                        продолжительности использования ЭСО во время уроков
                    </th>
                    <th align="center" class="text-center">х5.2. превышение регламентированного СанПиН значения
                        продолжительности использования ЭСО в общеобразовательной организации за учебный день
                    </th>
                    <th align="center" class="text-center">х5.3. отсутствие локального акта о запрете использования
                        обучающимися во время перемен устройств мобильной связи (сотовых телефонов)
                    </th>
                    <th align="center" class="text-center">х5.4.1. интерактивной доски</th>
                    <th align="center" class="text-center">х5.4.2. монитора компьютера</th>
                    <th align="center" class="text-center">х5.4.3. планшета</th>
                    <th align="center" class="text-center">х5.4.4. ноутбука</th>
                    <th align="center" class="text-center">х5.4.5. отсутствие второй клавиатуры у ноутбука</th>
                    <th align="center" class="text-center">Итог по фактору х5.</th>
                </tr>
                </thead>
                <tbody>
                <?
                if ($result['result'] != []) {
                    $firstKey = array_key_first($result['result']);
                    $region = $result['result'][$firstKey]['region_id'];
                    $okrug = $result['result'][$firstKey]['federal_district_id'];
                    $countStr = 1;
                    foreach ($result['result'] as $key => $row) {
                    //$row['federal_district_id'] = Yii::$app->myComponent->get_federal_name($row['federal_district_id']);
                    //$row['region_id'] = Yii::$app->myComponent->get_region_name($row['region_id']);
                    //$row['municipality_id'] = Yii::$app->myComponent->get_municipality_name($row['municipality_id']);
                        ?>
                        <? if ($region !== $row['region_id']) { ?>
                            <tr>
                                <th colspan="3"><?= Yii::$app->myComponent->get_federal_name($okrug)  ?></th>
                                <th colspan="3"><?= Yii::$app->myComponent->get_region_name($region) ?></th>
                                <th><?= ($result['region'][$region]['risk_assessment_g'] && $result['region'][$region]['risk_assessment_g'] != '0' ) ? round($result['region'][$region]['risk_assessment_g']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['risk_assessment'] && $result['region'][$region]['risk_assessment'] != '0' ) ? round($result['region'][$region]['risk_assessment']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme1_1'] && $result['region'][$region]['fieldTheme1_1'] != '0' ) ? round($result['region'][$region]['fieldTheme1_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme1_2'] && $result['region'][$region]['fieldTheme1_2'] != '0' ) ? round($result['region'][$region]['fieldTheme1_2']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme1_3'] && $result['region'][$region]['fieldTheme1_3'] != '0' ) ? round($result['region'][$region]['fieldTheme1_3']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme1_4'] && $result['region'][$region]['fieldTheme1_4'] != '0' ) ? round($result['region'][$region]['fieldTheme1_4']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme1_5'] && $result['region'][$region]['fieldTheme1_5'] != '0' ) ? round($result['region'][$region]['fieldTheme1_5']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['risk_assessment_1'] && $result['region'][$region]['risk_assessment_1'] != '0' ) ? round($result['region'][$region]['risk_assessment_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme2_1'] && $result['region'][$region]['fieldTheme2_1'] != '0' ) ? round($result['region'][$region]['fieldTheme2_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme2_2'] && $result['region'][$region]['fieldTheme2_2'] != '0' ) ? round($result['region'][$region]['fieldTheme2_2']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme2_3'] && $result['region'][$region]['fieldTheme2_3'] != '0' ) ? round($result['region'][$region]['fieldTheme2_3']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme2_4'] && $result['region'][$region]['fieldTheme2_4'] != '0' ) ? round($result['region'][$region]['fieldTheme2_4']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['risk_assessment_2'] && $result['region'][$region]['risk_assessment_2'] != '0' ) ? round($result['region'][$region]['risk_assessment_2']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme3_1'] && $result['region'][$region]['fieldTheme3_1'] != '0' ) ? round($result['region'][$region]['fieldTheme3_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme3_2'] && $result['region'][$region]['fieldTheme3_2'] != '0' ) ? round($result['region'][$region]['fieldTheme3_2']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['risk_assessment_3'] && $result['region'][$region]['risk_assessment_3'] != '0' ) ? round($result['region'][$region]['risk_assessment_3']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme4_1'] && $result['region'][$region]['fieldTheme4_1'] != '0' ) ? round($result['region'][$region]['fieldTheme4_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['risk_assessment_4'] && $result['region'][$region]['risk_assessment_4'] != '0' ) ? round($result['region'][$region]['risk_assessment_4']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme5_1'] && $result['region'][$region]['fieldTheme5_1'] != '0' ) ? round($result['region'][$region]['fieldTheme5_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme5_2'] && $result['region'][$region]['fieldTheme5_2'] != '0' ) ? round($result['region'][$region]['fieldTheme5_2']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme5_3'] && $result['region'][$region]['fieldTheme5_3'] != '0' ) ? round($result['region'][$region]['fieldTheme5_3']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme5_4_1'] && $result['region'][$region]['fieldTheme5_4_1'] != '0' ) ? round($result['region'][$region]['fieldTheme5_4_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme5_4_2'] && $result['region'][$region]['fieldTheme5_4_2'] != '0' ) ? round($result['region'][$region]['fieldTheme5_4_2']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme5_4_3'] && $result['region'][$region]['fieldTheme5_4_3'] != '0' ) ? round($result['region'][$region]['fieldTheme5_4_3']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme5_4_4'] && $result['region'][$region]['fieldTheme5_4_4'] != '0' ) ? round($result['region'][$region]['fieldTheme5_4_4']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['fieldTheme5_4_5'] && $result['region'][$region]['fieldTheme5_4_5'] != '0' ) ? round($result['region'][$region]['fieldTheme5_4_5']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['risk_assessment_5'] && $result['region'][$region]['risk_assessment_5'] != '0' ) ? round($result['region'][$region]['risk_assessment_5']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['risk_assessment_g'] && $result['region'][$region]['risk_assessment_g'] != '0' ) ? round($result['region'][$region]['risk_assessment_g']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['region'][$region]['risk_assessment'] && $result['region'][$region]['risk_assessment'] != '0' ) ? round($result['region'][$region]['risk_assessment']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                            </tr>
                        <?} ?>
                        <? if ($okrug !== $row['federal_district_id']) { ?>
                            <tr>
                                <th colspan="6"><?= Yii::$app->myComponent->get_federal_name($okrug) ?></th>
                                <th><?= ($result['okrug'][$okrug]['risk_assessment_g'] && $result['okrug'][$okrug]['risk_assessment_g'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_g']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['risk_assessment'] && $result['okrug'][$okrug]['risk_assessment'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme1_1'] && $result['okrug'][$okrug]['fieldTheme1_1'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme1_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme1_2'] && $result['okrug'][$okrug]['fieldTheme1_2'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme1_2']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme1_3'] && $result['okrug'][$okrug]['fieldTheme1_3'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme1_3']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme1_4'] && $result['okrug'][$okrug]['fieldTheme1_4'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme1_4']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme1_5'] && $result['okrug'][$okrug]['fieldTheme1_5'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme1_5']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['risk_assessment_1'] && $result['okrug'][$okrug]['risk_assessment_1'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme2_1'] && $result['okrug'][$okrug]['fieldTheme2_1'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme2_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme2_2'] && $result['okrug'][$okrug]['fieldTheme2_2'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme2_2']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme2_3'] && $result['okrug'][$okrug]['fieldTheme2_3'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme2_3']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme2_4'] && $result['okrug'][$okrug]['fieldTheme2_4'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme2_4']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['risk_assessment_2'] && $result['okrug'][$okrug]['risk_assessment_2'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_2']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme3_1'] && $result['okrug'][$okrug]['fieldTheme3_1'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme3_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme3_2'] && $result['okrug'][$okrug]['fieldTheme3_2'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme3_2']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['risk_assessment_3'] && $result['okrug'][$okrug]['risk_assessment_3'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_3']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme4_1'] && $result['okrug'][$okrug]['fieldTheme4_1'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme4_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['risk_assessment_4'] && $result['okrug'][$okrug]['risk_assessment_4'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_4']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme5_1'] && $result['okrug'][$okrug]['fieldTheme5_1'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme5_2'] && $result['okrug'][$okrug]['fieldTheme5_2'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_2']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme5_3'] && $result['okrug'][$okrug]['fieldTheme5_3'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_3']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme5_4_1'] && $result['okrug'][$okrug]['fieldTheme5_4_1'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_4_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme5_4_2'] && $result['okrug'][$okrug]['fieldTheme5_4_2'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_4_2']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme5_4_3'] && $result['okrug'][$okrug]['fieldTheme5_4_3'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_4_3']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme5_4_4'] && $result['okrug'][$okrug]['fieldTheme5_4_4'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_4_4']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['fieldTheme5_4_5'] && $result['okrug'][$okrug]['fieldTheme5_4_5'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_4_5']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['risk_assessment_5'] && $result['okrug'][$okrug]['risk_assessment_5'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_5']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['risk_assessment_g'] && $result['okrug'][$okrug]['risk_assessment_g'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_g']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                                <th><?= ($result['okrug'][$okrug]['risk_assessment'] && $result['okrug'][$okrug]['risk_assessment'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                            </tr>
                        <?} ?>
                        <?
                        $region = $row['region_id'];
                        $okrug = $row['federal_district_id'];
                        ?>
                        <tr>
                            <td class="text-center"><?= $countStr++ ?></td>
                            <td><?= Yii::$app->myComponent->get_federal_name($row['federal_district_id'])  ?></td>
                            <td><?= Yii::$app->myComponent->get_region_name($row['region_id'])  ?></td>
                            <td><?= Yii::$app->myComponent->get_municipality_name($row['municipality_id']) ?></td>
                            <td><?= ($row['short_title'] != '') ? $row['short_title'] : $row['title'] ?></td>
                            <td><?= $row['create_at'] ?></td>
                            <td><?= $row['class'] ?></td>
                            <td><?= $row['risk_assessment_g'] ?></td>
                            <td><?= $row['risk_assessment'] ?></td>
                            <td><?= $row['fieldTheme1_1'] ?></td>
                            <td><?= $row['fieldTheme1_2'] ?></td>
                            <td><?= $row['fieldTheme1_3'] ?></td>
                            <td><?= $row['fieldTheme1_4'] ?></td>
                            <td><?= $row['fieldTheme1_5'] ?></td>
                            <td><?= $row['risk_assessment_1'] ?></td>
                            <td><?= $row['fieldTheme2_1'] ?></td>
                            <td><?= $row['fieldTheme2_2'] ?></td>
                            <td><?= $row['fieldTheme2_3'] ?></td>
                            <td><?= $row['fieldTheme2_4'] ?></td>
                            <td><?= $row['risk_assessment_2'] ?></td>
                            <td><?= $row['fieldTheme3_1'] ?></td>
                            <td><?= $row['fieldTheme3_2'] ?></td>
                            <td><?= $row['risk_assessment_3'] ?></td>
                            <td><?= $row['fieldTheme4_1'] ?></td>
                            <td><?= $row['risk_assessment_4'] ?></td>
                            <td><?= $row['fieldTheme5_1'] ?></td>
                            <td><?= $row['fieldTheme5_2'] ?></td>
                            <td><?= $row['fieldTheme5_3'] ?></td>
                            <td><?= $row['fieldTheme5_4_1'] ?></td>
                            <td><?= $row['fieldTheme5_4_2'] ?></td>
                            <td><?= $row['fieldTheme5_4_3'] ?></td>
                            <td><?= $row['fieldTheme5_4_4'] ?></td>
                            <td><?= $row['fieldTheme5_4_5'] ?></td>
                            <td><?= $row['risk_assessment_5'] ?></td>
                            <td><?= $row['risk_assessment_g'] ?></td>
                            <td><?= $row['risk_assessment'] ?></td>
                        </tr>
                        <?
                    }
                }
                ?>
                <tr>
                    <th colspan="3"><?= Yii::$app->myComponent->get_federal_name($okrug) ?></th>
                    <th colspan="3"><?= Yii::$app->myComponent->get_region_name($region) ?></th>
                    <th><?= ($result['region'][$region]['risk_assessment_g'] && $result['region'][$region]['risk_assessment_g'] != '0' ) ? round($result['region'][$region]['risk_assessment_g']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['risk_assessment'] && $result['region'][$region]['risk_assessment'] != '0' ) ? round($result['region'][$region]['risk_assessment']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme1_1'] && $result['region'][$region]['fieldTheme1_1'] != '0' ) ? round($result['region'][$region]['fieldTheme1_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme1_2'] && $result['region'][$region]['fieldTheme1_2'] != '0' ) ? round($result['region'][$region]['fieldTheme1_2']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme1_3'] && $result['region'][$region]['fieldTheme1_3'] != '0' ) ? round($result['region'][$region]['fieldTheme1_3']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme1_4'] && $result['region'][$region]['fieldTheme1_4'] != '0' ) ? round($result['region'][$region]['fieldTheme1_4']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme1_5'] && $result['region'][$region]['fieldTheme1_5'] != '0' ) ? round($result['region'][$region]['fieldTheme1_5']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['risk_assessment_1'] && $result['region'][$region]['risk_assessment_1'] != '0' ) ? round($result['region'][$region]['risk_assessment_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme2_1'] && $result['region'][$region]['fieldTheme2_1'] != '0' ) ? round($result['region'][$region]['fieldTheme2_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme2_2'] && $result['region'][$region]['fieldTheme2_2'] != '0' ) ? round($result['region'][$region]['fieldTheme2_2']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme2_3'] && $result['region'][$region]['fieldTheme2_3'] != '0' ) ? round($result['region'][$region]['fieldTheme2_3']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme2_4'] && $result['region'][$region]['fieldTheme2_4'] != '0' ) ? round($result['region'][$region]['fieldTheme2_4']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['risk_assessment_2'] && $result['region'][$region]['risk_assessment_2'] != '0' ) ? round($result['region'][$region]['risk_assessment_2']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme3_1'] && $result['region'][$region]['fieldTheme3_1'] != '0' ) ? round($result['region'][$region]['fieldTheme3_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme3_2'] && $result['region'][$region]['fieldTheme3_2'] != '0' ) ? round($result['region'][$region]['fieldTheme3_2']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['risk_assessment_3'] && $result['region'][$region]['risk_assessment_3'] != '0' ) ? round($result['region'][$region]['risk_assessment_3']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme4_1'] && $result['region'][$region]['fieldTheme4_1'] != '0' ) ? round($result['region'][$region]['fieldTheme4_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['risk_assessment_4'] && $result['region'][$region]['risk_assessment_4'] != '0' ) ? round($result['region'][$region]['risk_assessment_4']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme5_1'] && $result['region'][$region]['fieldTheme5_1'] != '0' ) ? round($result['region'][$region]['fieldTheme5_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme5_2'] && $result['region'][$region]['fieldTheme5_2'] != '0' ) ? round($result['region'][$region]['fieldTheme5_2']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme5_3'] && $result['region'][$region]['fieldTheme5_3'] != '0' ) ? round($result['region'][$region]['fieldTheme5_3']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme5_4_1'] && $result['region'][$region]['fieldTheme5_4_1'] != '0' ) ? round($result['region'][$region]['fieldTheme5_4_1']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme5_4_2'] && $result['region'][$region]['fieldTheme5_4_2'] != '0' ) ? round($result['region'][$region]['fieldTheme5_4_2']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme5_4_3'] && $result['region'][$region]['fieldTheme5_4_3'] != '0' ) ? round($result['region'][$region]['fieldTheme5_4_3']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme5_4_4'] && $result['region'][$region]['fieldTheme5_4_4'] != '0' ) ? round($result['region'][$region]['fieldTheme5_4_4']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['fieldTheme5_4_5'] && $result['region'][$region]['fieldTheme5_4_5'] != '0' ) ? round($result['region'][$region]['fieldTheme5_4_5']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['risk_assessment_5'] && $result['region'][$region]['risk_assessment_5'] != '0' ) ? round($result['region'][$region]['risk_assessment_5']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['risk_assessment_g'] && $result['region'][$region]['risk_assessment_g'] != '0' ) ? round($result['region'][$region]['risk_assessment_g']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['region'][$region]['risk_assessment'] && $result['region'][$region]['risk_assessment'] != '0' ) ? round($result['region'][$region]['risk_assessment']/$result['region'][$region]['count'] ,3) : '0' ?></th>
                </tr>
                <tr>
                    <th colspan="6"><?= Yii::$app->myComponent->get_federal_name($okrug) ?></th>
                    <th><?= ($result['okrug'][$okrug]['risk_assessment_g'] && $result['okrug'][$okrug]['risk_assessment_g'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_g']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['risk_assessment'] && $result['okrug'][$okrug]['risk_assessment'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme1_1'] && $result['okrug'][$okrug]['fieldTheme1_1'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme1_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme1_2'] && $result['okrug'][$okrug]['fieldTheme1_2'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme1_2']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme1_3'] && $result['okrug'][$okrug]['fieldTheme1_3'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme1_3']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme1_4'] && $result['okrug'][$okrug]['fieldTheme1_4'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme1_4']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme1_5'] && $result['okrug'][$okrug]['fieldTheme1_5'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme1_5']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['risk_assessment_1'] && $result['okrug'][$okrug]['risk_assessment_1'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme2_1'] && $result['okrug'][$okrug]['fieldTheme2_1'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme2_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme2_2'] && $result['okrug'][$okrug]['fieldTheme2_2'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme2_2']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme2_3'] && $result['okrug'][$okrug]['fieldTheme2_3'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme2_3']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme2_4'] && $result['okrug'][$okrug]['fieldTheme2_4'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme2_4']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['risk_assessment_2'] && $result['okrug'][$okrug]['risk_assessment_2'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_2']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme3_1'] && $result['okrug'][$okrug]['fieldTheme3_1'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme3_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme3_2'] && $result['okrug'][$okrug]['fieldTheme3_2'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme3_2']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['risk_assessment_3'] && $result['okrug'][$okrug]['risk_assessment_3'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_3']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme4_1'] && $result['okrug'][$okrug]['fieldTheme4_1'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme4_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['risk_assessment_4'] && $result['okrug'][$okrug]['risk_assessment_4'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_4']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme5_1'] && $result['okrug'][$okrug]['fieldTheme5_1'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme5_2'] && $result['okrug'][$okrug]['fieldTheme5_2'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_2']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme5_3'] && $result['okrug'][$okrug]['fieldTheme5_3'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_3']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme5_4_1'] && $result['okrug'][$okrug]['fieldTheme5_4_1'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_4_1']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme5_4_2'] && $result['okrug'][$okrug]['fieldTheme5_4_2'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_4_2']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme5_4_3'] && $result['okrug'][$okrug]['fieldTheme5_4_3'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_4_3']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme5_4_4'] && $result['okrug'][$okrug]['fieldTheme5_4_4'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_4_4']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['fieldTheme5_4_5'] && $result['okrug'][$okrug]['fieldTheme5_4_5'] != '0' ) ? round($result['okrug'][$okrug]['fieldTheme5_4_5']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['risk_assessment_5'] && $result['okrug'][$okrug]['risk_assessment_5'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_5']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['risk_assessment_g'] && $result['okrug'][$okrug]['risk_assessment_g'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment_g']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                    <th><?= ($result['okrug'][$okrug]['risk_assessment'] && $result['okrug'][$okrug]['risk_assessment'] != '0' ) ? round($result['okrug'][$okrug]['risk_assessment']/$result['okrug'][$okrug]['count'] ,3) : '0' ?></th>
                </tr>
                <tr>
                    <th colspan="6" class="text-center">ИТОГ</th>
                    <th><?= ($result['itog']['risk_assessment_g'] && $result['itog']['risk_assessment_g'] != '0' ) ? round($result['itog']['risk_assessment_g']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['risk_assessment'] && $result['itog']['risk_assessment'] != '0' ) ? round($result['itog']['risk_assessment']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme1_1'] && $result['itog']['fieldTheme1_1'] != '0' ) ? round($result['itog']['fieldTheme1_1']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme1_2'] && $result['itog']['fieldTheme1_2'] != '0' ) ? round($result['itog']['fieldTheme1_2']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme1_3'] && $result['itog']['fieldTheme1_3'] != '0' ) ? round($result['itog']['fieldTheme1_3']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme1_4'] && $result['itog']['fieldTheme1_4'] != '0' ) ? round($result['itog']['fieldTheme1_4']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme1_5'] && $result['itog']['fieldTheme1_5'] != '0' ) ? round($result['itog']['fieldTheme1_5']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['risk_assessment_1'] && $result['itog']['risk_assessment_1'] != '0' ) ? round($result['itog']['risk_assessment_1']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme2_1'] && $result['itog']['fieldTheme2_1'] != '0' ) ? round($result['itog']['fieldTheme2_1']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme2_2'] && $result['itog']['fieldTheme2_2'] != '0' ) ? round($result['itog']['fieldTheme2_2']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme2_3'] && $result['itog']['fieldTheme2_3'] != '0' ) ? round($result['itog']['fieldTheme2_3']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme2_4'] && $result['itog']['fieldTheme2_4'] != '0' ) ? round($result['itog']['fieldTheme2_4']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['risk_assessment_2'] && $result['itog']['risk_assessment_2'] != '0' ) ? round($result['itog']['risk_assessment_2']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme3_1'] && $result['itog']['fieldTheme3_1'] != '0' ) ? round($result['itog']['fieldTheme3_1']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme3_2'] && $result['itog']['fieldTheme3_2'] != '0' ) ? round($result['itog']['fieldTheme3_2']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['risk_assessment_3'] && $result['itog']['risk_assessment_3'] != '0' ) ? round($result['itog']['risk_assessment_3']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme4_1'] && $result['itog']['fieldTheme4_1'] != '0' ) ? round($result['itog']['fieldTheme4_1']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['risk_assessment_4'] && $result['itog']['risk_assessment_4'] != '0' ) ? round($result['itog']['risk_assessment_4']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme5_1'] && $result['itog']['fieldTheme5_1'] != '0' ) ? round($result['itog']['fieldTheme5_1']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme5_2'] && $result['itog']['fieldTheme5_2'] != '0' ) ? round($result['itog']['fieldTheme5_2']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme5_3'] && $result['itog']['fieldTheme5_3'] != '0' ) ? round($result['itog']['fieldTheme5_3']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme5_4_1'] && $result['itog']['fieldTheme5_4_1'] != '0' ) ? round($result['itog']['fieldTheme5_4_1']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme5_4_2'] && $result['itog']['fieldTheme5_4_2'] != '0' ) ? round($result['itog']['fieldTheme5_4_2']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme5_4_3'] && $result['itog']['fieldTheme5_4_3'] != '0' ) ? round($result['itog']['fieldTheme5_4_3']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme5_4_4'] && $result['itog']['fieldTheme5_4_4'] != '0' ) ? round($result['itog']['fieldTheme5_4_4']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['fieldTheme5_4_5'] && $result['itog']['fieldTheme5_4_5'] != '0' ) ? round($result['itog']['fieldTheme5_4_5']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['risk_assessment_5'] && $result['itog']['risk_assessment_5'] != '0' ) ? round($result['itog']['risk_assessment_5']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['risk_assessment_g'] && $result['itog']['risk_assessment_g'] != '0' ) ? round($result['itog']['risk_assessment_g']/$result['itog']['count'] ,3) : '0' ?></th>
                    <th><?= ($result['itog']['risk_assessment'] && $result['itog']['risk_assessment'] != '0' ) ? round($result['itog']['risk_assessment']/$result['itog']['count'] ,3) : '0' ?></th>
                </tr>
                </tbody>
            </table>
        </div>
       <!-- <br><br>

        <input type="button" class="btn btn-warning btn-sm btn-block table2excel form-control"
               title="Вы можете скачать в формате Excel" value="Скачать список в Excel" id="pechat33">
        <br>
        <div class="table-responsive">

            <table id="tableId" style="border: 1px solid black; border-collapse: collapse;"
                   class="table table-bordered table-sm border-collapse">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Федеральный округ:</th>
                    <th>Регион:</th>
                    <th>Муниципальное образование:</th>
                    <th>Год обучения:</th>
                    <th>Класс:</th>
                    <th>Общий риск:</th>
                    <th>Общий риск с поправочным коэфициентом:</th>

                    <?/* foreach ($arrfieldTheme1 as $key => $oneName) { */?>
                        <th><?/*= $oneName */?></th>
                    <?/* } */?>
                    <th>Общий риск:</th>
                    <th>Общий риск с поправочным коэфициентом:</th>
                </tr>
                </thead>
                <tbody>
                <?/*
                $i = 0;
                foreach ($RiskAssessmentOrganizationCommon as $key => $one) {
                    */?>
                    <tr>
                        <td><?/*= ++$i */?></td>

                        <td><?/*= $one['federal_district_id'] */?></td>
                        <td><?/*= $one['region_id'] */?></td>
                        <td><?/*= $one['municipality_id'] */?></td>
                        <td><?/*= $one['year'] */?></td>
                        <td><?/*= Yii::$app->riskComponent->trainingClass($one['class']) */?></td>

                        <td><?/*= $one['risk_assessment_g'] */?></td>
                        <td><?/*= $one['risk_assessment'] */?></td>

                        <td><?/*= Yii::$app->riskComponent->fieldTheme1Decoding($one['fieldTheme1_1']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme1Decoding($one['fieldTheme1_2']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme1Decoding($one['fieldTheme1_3']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme1Decoding($one['fieldTheme1_4']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme1Decoding($one['fieldTheme1_5']) */?></td>
                        <td><?/*= $one['risk_assessment_1'] */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme2Decoding($one['fieldTheme2_1']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme2Decoding($one['fieldTheme2_2']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme2Decoding($one['fieldTheme2_3']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme2Decoding($one['fieldTheme2_4']) */?></td>
                        <td><?/*= $one['risk_assessment_2'] */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme3Decoding($one['fieldTheme3_1']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme3Decoding($one['fieldTheme3_2']) */?></td>
                        <td><?/*= $one['risk_assessment_3'] */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme4Decoding($one['fieldTheme4_1']) */?></td>
                        <td><?/*= $one['risk_assessment_4'] */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme5Decoding($one['fieldTheme5_1']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme5Decoding($one['fieldTheme5_2']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme5Decoding($one['fieldTheme5_3']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme6Decoding($one['fieldTheme5_4_1']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme6Decoding($one['fieldTheme5_4_2']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme6Decoding($one['fieldTheme5_4_3']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme6Decoding($one['fieldTheme5_4_4']) */?></td>
                        <td><?/*= Yii::$app->riskComponent->fieldTheme6Decoding($one['fieldTheme5_4_5']) */?></td>
                        <td><?/*= $one['risk_assessment_5'] */?></td>

                        <td><?/*= $one['risk_assessment_g'] */?></td>
                        <td><?/*= $one['risk_assessment'] */?></td>
                    </tr>
                <?/* } */?>
                </tbody>
            </table>
        </div>-->
    </div>
<? } ?>

<?
$script = <<< JS
    $("#pechat222").click(function () {
    var table = $('#tableId22222');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                exclude: ".noExl",
                name: "Excel Document Name",
                filename: "Выгрузка общего контроля.xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });
                              
    $("#pechat33").click(function () {
    var table = $('#tableId');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                exclude: ".noExl",
                name: "Excel Document Name",
                filename: "Данные по общему риску.xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });

JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
