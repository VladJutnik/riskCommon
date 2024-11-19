<?php

use common\models\FederalDistrict;
use common\models\Region;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Отчет по индивидуальному риску: ';
$items = [
    'net'=>'из Мониторинга питания',
    'da'=>'из Общего доступа',
];
//print_r('<pre>');
//print_r($result['organization']);
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

<? if ($result) { ?>
    <div class="p-1">
        <input type="button" class="btn btn-warning btn-block table2excel mb-3 mt-3"
               title="Вы можете скачать в формате Excel" value="Скачать в Excel" id="pechat222">
        <div class="table-responsive">
            <table id="tableId22222" class="table table-bordered table-sm table2excel_with_colors">
                <thead>
                <tr class="row0">
                    <th class="column0 style1 s style11" rowspan="3">№</th>
                    <th class="column1 style2 s style12" rowspan="3">Федеральный округ</th>
                    <th class="column2 style2 s style12" rowspan="3">Регион</th>
                    <th class="column3 style2 s style12" rowspan="3">Муниципальное образование</th>
                    <th class="column4 style3 s style3" rowspan="3">Название организации</th>
                    <th class="column4 style3 s style3" rowspan="3">Идентификатор респондента:</th>
                    <th class="column5 style1 s style11" rowspan="3">Дата заполнения</th>
                    <th class="column5 style1 s style11" rowspan="3">Общий риск</th>
                    <th class="column6 style1 s style9" rowspan="3">Общий риск с поправочным индексом</th>
                    <th class="column7 style4 s style4" colspan="6" rowspan="2">Ученическая мебель</th>
                    <th class="column13 style5 s style5" colspan="5" rowspan="2">Искусственная освещенность</th>
                    <th class="column18 style6 s style6" colspan="3" rowspan="2">Гимнастика для глаз</th>
                    <th class="column21 style5 s style5" colspan="2" rowspan="2">Гимнастика для глаз</th>
                    <th class="column23 style6 s style6" colspan="9">Использование электронных средств обучения и
                        средств мобильной связи
                    </th>
                    <th class="column32 style1 s style11" rowspan="3">Общий риск</th>
                    <th class="column33 style1 s style9" rowspan="3">Общий риск с поправочным индексом</th>
                    <th class="column34 style7 s style7" colspan="4" rowspan="2">Сокращение оптимального расстояния от
                        органа зрения до рабочей поверхности
                    </th>
                    <th class="column38 style7 s style7" colspan="4" rowspan="2">Отсутствие гимнастики для глаз в
                        течение учебного дня
                    </th>
                    <th class="column42 style7 s style7" colspan="3" rowspan="2">Отсутствие гимнастики для мышц спины и
                        шеи в течение учебного дня
                    </th>
                    <th class="column45 style4 s style4" colspan="3" rowspan="2">Не рациональное использование
                        электронных средств обучения и средств мобильной связи
                    </th>
                    <th class="column48 style7 s style7" colspan="3" rowspan="2">Дефицит времени нахождения ребенка на
                        улице
                    </th>
                    <th class="column51 style7 s style7" colspan="3" rowspan="2">Наследственная отягощенность</th>
                    <th class="column54 style8 s style17" rowspan="3">Сумма по факторам</th>
                    <th class="column55 style8 s style17" rowspan="3">Сумма по факторам с поправочным индексом</th>
                    <th class="column54 style8 s style17" rowspan="3">R - индивидуальный риск</th>
                    <th class="column55 style8 s style17" rowspan="3">Вероятность формирования нарушений осанки и зрения
                        у обучающихся
                    </th>
                </tr>
                <tr class="row1">
                    <th class="column23 style6 null style6" colspan="3"></th>
                    <th class="column26 style7 s style7" colspan="6">х5.4. конструктивные особенности используемых ЭСО
                        на уроках, в том числе недостаточный размер диагонали (1-4):
                    </th>
                </tr>
                <tr class="row2">
                    <th class="column7 style13 s">х1.1. не промаркированная мебель</th>
                    <th class="column8 style14 s">х1.2. не стандартная мебель</th>
                    <th class="column9 style14 s">х1.3. не комплектная мебель</th>
                    <th class="column10 style14 s">х1.4. не ведется листок здоровья либо ведется не в полном объёме</th>
                    <th class="column11 style14 s">х1.5. дети не рассаживаются с учетом роста</th>
                    <th class="column12 style14 s">Итог по фактору</th>
                    <th class="column13 style14 s">х2.1. отсутствие производственного контроля за уровнем освещенности в
                        учебных классах и кабинетах
                    </th>
                    <th class="column14 style14 s">х2.2. нарушения санитарного законодательства, выявленные в ходе
                        контрольно-надзорных мероприятий, а также в ходе профилактических визитов течение прошлого
                        учебного года
                    </th>
                    <th class="column15 style14 s">х2.3. наличие в отдельных учебных классах и кабинетах перегоревших
                        ламп
                    </th>
                    <th class="column16 style14 s">х2.4. наличие учебных классов и кабинетов, в которых не установлены
                        светорассеивающие светильники
                    </th>
                    <th class="column17 style14 s">Итог по фактору</th>
                    <th class="column18 style13 s">х3.1. отсутствие проведения гимнастики для глаз вовремя перемен</th>
                    <th class="column19 style14 s">х3.2. отсутствие проведения гимнастики для глаз во время уроков с
                        использованием электронных средств обучения
                    </th>
                    <th class="column20 style14 s">Итог по фактору</th>
                    <th class="column21 style14 s">х4.1. отсутствие проведения гимнастики для мышц спины и шеи вовремя
                        перемен
                    </th>
                    <th class="column22 style14 s">Итог по фактору</th>
                    <th class="column23 style14 s">х5.1. превышение регламентированного СанПиН значения
                        продолжительности использования ЭСО во время уроков
                    </th>
                    <th class="column24 style14 s">х5.2. превышение регламентированного СанПиН значения
                        продолжительности использования ЭСО в общеобразовательной организации за учебный день
                    </th>
                    <th class="column25 style14 s">х5.3. отсутствие локального акта о запрете использования обучающимися
                        во время перемен устройств мобильной связи (сотовых телефонов)
                    </th>
                    <th class="column26 style15 s">х5.4.1. интерактивной доски</th>
                    <th class="column27 style16 s">х5.4.2. монитора компьютера</th>
                    <th class="column28 style16 s">х5.4.3. планшета</th>
                    <th class="column29 style16 s">х5.4.4. ноутбука</th>
                    <th class="column30 style16 s">х5.4.5. отсутствие второй клавиатуры у ноутбука</th>
                    <th class="column31 style14 s">Итог по фактору</th>
                    <th class="column34 style16 s">у1.1.сокращение оптимального расстояния от органа зрения до рабочей
                        поверхности при письме
                    </th>
                    <th class="column35 style16 s">у1.2. сокращение оптимального расстояния от органа зрения до рабочей
                        поверхности при чтении
                    </th>
                    <th class="column36 style16 s">у1.3. сокращение оптимального расстояния от органа зрения до рабочей
                        поверхности при работе с компьютером, ноутбуком и планшетом
                    </th>
                    <th class="column37 style16 s">Итог по фактору</th>
                    <th class="column38 style16 s">У2.1. не участие ребенка в гимнастике во время уроков (по любой
                        причине – нет гимнастики, не хочет выполнять упражнения, иные причины)
                    </th>
                    <th class="column39 style16 s">У2.2. не участие ребенка в гимнастике во время перемен (по любой
                        причине – нет гимнастики, не хочет выполнять упражнения, иные причины)
                    </th>
                    <th class="column40 style16 s">У2.3.отсутствие навыков у ребенка к самостоятельному выполнению
                        упражнений гимнастики без участия учителя (вожатого и т.д.) по причине незнания упражнений
                    </th>
                    <th class="column41 style16 s">Итог по фактору</th>
                    <th class="column42 style16 s">У3.1. не участие ребенка в гимнастике во время перемен (по любой
                        причине – нет гимнастики, не хочет выполнять упражнения, иные причины)
                    </th>
                    <th class="column43 style16 s">У3.2. отсутствие навыков у ребенка к самостоятельному выполнению
                        упражнений гимнастики без участия учителя (вожатого и т.д.) по причине незнания упражнений
                    </th>
                    <th class="column44 style16 s">Итог по фактору</th>
                    <th class="column45 style16 s">У4.1. продолжительность экранного времени в типичный учебный день
                        более трех часов
                    </th>
                    <th class="column46 style16 s">У4.2. продолжительность экранного времени в типичный выходной день
                        более трех часов
                    </th>
                    <th class="column47 style16 s">Итог по фактору</th>
                    <th class="column48 style16 s">У5.1. продолжительность прогулок менее 2 часов в типичный учебный
                        день
                    </th>
                    <th class="column49 style16 s">У5.2. продолжительность прогулок менее 2 часов в типичный выходной
                        день
                    </th>
                    <th class="column50 style16 s">Итог по фактору</th>
                    <th class="column51 style16 s">Z1.1. миопия у матери</th>
                    <th class="column52 style16 s">Z1.2. миопия у отца</th>
                    <th class="column53 style16 s">Итог по фактору</th>
                </tr>
                </thead>
                <tbody>
                <?
                if ($result['organization'] != []) {
                    $firstKey = array_key_first($result['organization']);
                    $region = $result['organization'][$firstKey]['region_id'];
                    $okrug = $result['organization'][$firstKey]['federal_district_id'];
                    $countStr = 1;
                    $arrPrint = [
                        'risk_assessment_g',
                        'risk_assessment',
                        'fieldTheme1_1',
                        'fieldTheme1_2',
                        'fieldTheme1_3',
                        'fieldTheme1_4',
                        'fieldTheme1_5',
                        'risk_assessment_1',
                        'fieldTheme2_1',
                        'fieldTheme2_2',
                        'fieldTheme2_3',
                        'fieldTheme2_4',
                        'risk_assessment_2',
                        'fieldTheme3_1',
                        'fieldTheme3_2',
                        'risk_assessment_3',
                        'fieldTheme4_1',
                        'risk_assessment_4',
                        'fieldTheme5_1',
                        'fieldTheme5_2',
                        'fieldTheme5_3',
                        'fieldTheme5_4_1',
                        'fieldTheme5_4_2',
                        'fieldTheme5_4_3',
                        'fieldTheme5_4_4',
                        'fieldTheme5_4_5',
                        'risk_assessment_5',
                        'risk_assessment_g',
                        'risk_assessment',

                        'fieldIndividualTheme1_1',
                        'fieldIndividualTheme1_2',
                        'fieldIndividualTheme1_3',
                        'risk_assessment_individual_y_1',
                        'fieldIndividualTheme2_1',
                        'fieldIndividualTheme2_2',
                        'fieldIndividualTheme2_3',
                        'risk_assessment_individual_y_2',
                        'fieldIndividualTheme3_1',
                        'fieldIndividualTheme3_2',
                        'risk_assessment_individual_y_3',
                        'fieldIndividualTheme4_1',
                        'fieldIndividualTheme4_2',
                        'risk_assessment_individual_y_4',
                        'fieldIndividualTheme5_1',
                        'fieldIndividualTheme5_2',
                        'risk_assessment_individual_y_5',
                        'fieldIndividualTheme6_1',
                        'fieldIndividualTheme6_2',
                        'risk_assessment_individual_z',
                        'risk_assessment_individual',
                        'risk_assessment_individual_kv',
                        '1risk_assessment_individual',
                        '1risk_assessment_individual_kv',
                    ];
                    foreach ($result['organization'] as $key => $row) {
                        ?>
                        <? if ($region !== $row['region_id']) { ?>
                            <tr>
                                <th colspan="3"><?= Yii::$app->myComponent->get_federal_name($okrug) ?></th>
                                <th colspan="4"><?= Yii::$app->myComponent->get_region_name($region) ?></th>
                                <?
                                foreach ($arrPrint as $name) { ?>
                                    <td><?= ($result['region'][$region][$name] && $result['region'][$region][$name] != '0') ? round($result['region'][$region][$name] / $result['region'][$region]['count'], 3) : '0' ?></td>
                                <? } ?>

                            </tr>
                        <? } ?>
                        <? if ($okrug !== $row['federal_district_id']) { ?>
                            <th colspan="7"><?= Yii::$app->myComponent->get_federal_name($okrug) ?></th>
                            <?
                            foreach ($arrPrint as $name) { ?>
                                <td><?= ($result['okrug'][$okrug][$name] && $result['okrug'][$okrug][$name] != '0') ? round($result['okrug'][$okrug][$name] / $result['okrug'][$okrug]['count'], 3) : '0' ?></td>
                            <? } ?>
                        <? } ?>
                        <?
                        $region = $row['region_id'];
                        $okrug = $row['federal_district_id'];
                        ?>
                        <tr>
                            <td class="text-center"><?= $countStr++ ?></td>
                            <td><?= Yii::$app->myComponent->get_federal_name($row['federal_district_id']) ?></td>
                            <td><?= Yii::$app->myComponent->get_region_name($row['region_id']) ?></td>
                            <td><?= Yii::$app->myComponent->get_municipality_name($row['municipality_id']) ?></td>
                            <td><?= $row['name_responsible_person'] ?></td>
                            <td><?= $row['name_responsible_person_individual'] ?></td>
                            <td><?= $row['create_at'] ?></td>
                            <?
                            foreach ($arrPrint as $name) { ?>
                                <td><?= $row[$name] ?></td>
                            <? } ?>
                        </tr>
                    <? } ?>
                    <tr>
                        <th colspan="3"><?= Yii::$app->myComponent->get_federal_name($okrug) ?></th>
                        <th colspan="4"><?= Yii::$app->myComponent->get_region_name($region) ?></th>
                        <? foreach ($arrPrint as $name) { ?>
                            <td><?= ($result['region'][$region][$name] && $result['region'][$region][$name] != '0') ? round($result['region'][$region][$name] / $result['region'][$region]['count'], 3) : '0' ?></td>
                        <? } ?>
                    </tr>
                    <tr>
                        <th colspan="7"><?= Yii::$app->myComponent->get_federal_name($okrug) ?></th>
                        <? foreach ($arrPrint as $name) { ?>
                            <td><?= ($result['okrug'][$okrug][$name] && $result['okrug'][$okrug][$name] != '0') ? round($result['okrug'][$okrug][$name] / $result['okrug'][$okrug]['count'], 3) : '0' ?></td>
                        <? } ?>
                    </tr>
                    <tr>
                        <th colspan="7" class="text-center">ИТОГ</th>
                        <? foreach ($arrPrint as $name) { ?>
                            <td><?= ($result['itog'][$name] && $result['itog'][$name] != '0') ? round($result['itog'][$name] / $result['itog']['count'], 3) : '0' ?></td>
                        <? } ?>
                    </tr>
                <? } ?>
                </tbody>
            </table>
        </div>
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
