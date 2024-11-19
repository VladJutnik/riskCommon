<?php

use common\models\FederalDistrict;
use common\models\Region;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Отчет по агрессии и тревожности: ';
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
        <?/*= $form->field($model, 'key', $two_column)->dropDownList($items, [
        'class' => 'form-control col-6',
    ])->label('Выгрузка из какой базы?'); */?>
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
                <colgroup width="30"></colgroup>
                <colgroup width="94"></colgroup>
                <colgroup width="50"></colgroup>
                <colgroup width="187"></colgroup>
                <colgroup width="138"></colgroup>
                <colgroup width="205"></colgroup>
                <colgroup width="226"></colgroup>
                <colgroup width="220"></colgroup>
                <colgroup width="227"></colgroup>
                <colgroup width="138"></colgroup>
                <colgroup width="271"></colgroup>
                <colgroup width="258"></colgroup>
                <colgroup width="178"></colgroup>
                <colgroup width="271"></colgroup>
                <colgroup width="154"></colgroup>
                <colgroup width="140"></colgroup>
                <colgroup width="212"></colgroup>
                <colgroup width="125"></colgroup>
                <colgroup width="271"></colgroup>
                <colgroup span="2" width="138"></colgroup>
                <colgroup width="271"></colgroup>
                <colgroup width="144"></colgroup>
                <colgroup width="138"></colgroup>
                <colgroup width="248"></colgroup>
                <colgroup width="204"></colgroup>
                <colgroup width="208"></colgroup>
                <colgroup span="6" width="271"></colgroup>
                <colgroup width="180"></colgroup>
                <colgroup span="4" width="271"></colgroup>
                <colgroup width="203"></colgroup>
                <colgroup width="138"></colgroup>
                <colgroup span="2" width="271"></colgroup>
                <colgroup width="246"></colgroup>
                <colgroup span="49" width="271"></colgroup>
                <colgroup width="166"></colgroup>
                <colgroup width="151"></colgroup>
                <colgroup width="208"></colgroup>
                <colgroup width="271"></colgroup>
                <colgroup width="129"></colgroup>
                <colgroup span="2" width="271"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup width="166"></colgroup>
                <colgroup width="151"></colgroup>
                <colgroup width="208"></colgroup>
                <colgroup width="271"></colgroup>
                <colgroup width="129"></colgroup>
                <colgroup span="2" width="271"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup span="4" width="110"></colgroup>
                <colgroup span="7" width="271"></colgroup>
                <colgroup width="137"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup span="7" width="271"></colgroup>
                <colgroup width="137"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup span="7" width="271"></colgroup>
                <colgroup width="137"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup span="5" width="110"></colgroup>
                <colgroup span="7" width="271"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup span="7" width="271"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup span="4" width="110"></colgroup>
                <colgroup span="10" width="271"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup span="10" width="271"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup span="4" width="110"></colgroup>
                <colgroup width="271"></colgroup>
                <colgroup width="263"></colgroup>
                <colgroup span="2" width="271"></colgroup>
                <colgroup width="261"></colgroup>
                <colgroup span="2" width="271"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup width="271"></colgroup>
                <colgroup width="263"></colgroup>
                <colgroup span="2" width="271"></colgroup>
                <colgroup width="261"></colgroup>
                <colgroup span="2" width="271"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup span="4" width="110"></colgroup>
                <colgroup span="5" width="271"></colgroup>
                <colgroup width="137"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup span="5" width="271"></colgroup>
                <colgroup width="137"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup span="5" width="271"></colgroup>
                <colgroup width="137"></colgroup>
                <colgroup width="61"></colgroup>
                <colgroup span="5" width="110"></colgroup>
                <colgroup span="25" width="271"></colgroup>
                <colgroup width="265"></colgroup>
                <colgroup span="27" width="271"></colgroup>
                <colgroup width="208"></colgroup>
                <colgroup span="5" width="271"></colgroup>
                <colgroup width="235"></colgroup>
                <colgroup span="8" width="271"></colgroup>
                <colgroup width="256"></colgroup>
                <colgroup span="3" width="271"></colgroup>
                <colgroup width="267"></colgroup>
                <colgroup span="2" width="271"></colgroup>
                <colgroup width="161"></colgroup>
                <colgroup width="152"></colgroup>
                <colgroup width="101"></colgroup>
                <colgroup width="92"></colgroup>
                <colgroup width="54"></colgroup>
                <colgroup width="142"></colgroup>
                <colgroup width="159"></colgroup>
                <colgroup span="2" width="110"></colgroup>
                <colgroup span="2" width="171"></colgroup>
                <colgroup width="169"></colgroup>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=3 height="168" align="center" valign=middle><font face="Times New Roman" size=3 color="#212529">№</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=3 align="center" valign=middle><font face="Times New Roman" size=3 color="#212529">Контингент</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=3 align="center" valign=middle><font face="Times New Roman" size=3 color="#212529">Класс</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=3 align="center" valign=middle><font face="Times New Roman" size=3 color="#212529">Идентификатор ученика:</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=44 rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Оценка уровня реактивной и личностной тревожности (по Ч,Д, Спилбергеру, ЮЛ, Ханину)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=44 rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Оценка уровня реактивной и личностной тревожности (по Ч,Д, Спилбергеру, ЮЛ, Ханину)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=20 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Опросник на наличие симптомов беспокойства и нервозности, которые могут возникать у ребенка при получении поручений от учител</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=32 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Опросник индикации возможных причин тревожности</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=20 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Меры профилактики, реализуемые в отношении ребенка со стороны учителей (классного руководителя)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=26 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Меры профилактики, реализуемые в отношении ребенка со стороны родителей - законных представителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=20 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Опросник формы проявления агрессии у ребенка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=26 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Опросник индикации возможных причин агрессивности ребенка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=87 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Опросник агрессивности Басса – Дарки</font></td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Ответы классного руководителя</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Ответы родителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Оценка общая</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Расшифровка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">% вес ответов классного руководителя<br></font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">% вес ответов родителей<br></font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=9 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Ответы классного руководителя</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=9 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Ответы родителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=9 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Ответы респондента</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Оценка общая</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Расшифровка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">&quot;% вес ответов руководителя<br>&quot;<br></font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">% вес ответов родителей<br></font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">% вес ответов респондента<br></font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Ответы классного руководителя</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Ответы респондента</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Оценка общая</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Расшифровка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">&quot;% вес ответов классного руководителя<br>&quot;<br></font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">% вес ответов респондента<br></font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=11 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Ответы родителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=11 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Ответы респондента</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Оценка общая</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Расшифровка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">&quot;% вес ответов родителей<br>&quot;<br></font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">% вес ответов респондента<br></font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Ответы классного руководителя</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Ответы родителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Оценка общая</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Расшифровка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">% вес ответов классного руководителя</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">% вес ответов родителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=7 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Ответы классного руководителя</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=7 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Ответы родителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=7 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Ответы респондента</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Оценка общая</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Расшифровка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">% вес ответов классного руководителя<br></font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">% вес ответов родителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">% вес ответов респондента</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">1, Временами я не могу справиться с желанием причинить вред другим</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">2, Иногда сплетничаю о людях, которых не люблю</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">3, Я легко раздражаюсь, но быстро успокаиваюсь</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">4, Если меня не попросят по-хорошему, я не выполню</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">5, Я не всегда получаю то, что мне положено</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">6, Я не знаю, что люди говорят обо мне за моей спиной</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">7, Если я не одобряю поведение друзей, я даю им это почувствовать</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">8, Когда мне случалось обмануть кого-нибудь, я испытывал мучительные угрызения совести</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">9, Мне кажется, что я не способен ударить человека</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">10, Я никогда не раздражаюсь настолько, чтобы кидаться предметами</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">11, Я всегда снисходителен к чужим недостаткам</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">12, Если мне не нравится установленное правило, мне хочется нарушить его</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">13, Другие умеют почти всегда пользоваться благоприятными обстоятельствами</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">14, Я держусь настороженно с людьми, которые относятся ко мне несколько более дружественно, чем я ожидал</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">15, Я часто бываю несогласен с людьми</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">16, Иногда мне на ум приходят мысли, которых я стыжусь</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">17, Если кто-нибудь первым ударит меня, я не отвечу ему</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">18, Когда я раздражаюсь, я хлопаю дверями</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">19, Я гораздо более раздражителен, чем кажется</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">20, Если кто-то воображает себя начальником, я всегда поступаю ему наперекор</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">21, Меня немного огорчает моя судьба</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">22, Я думаю, что многие люди не любят меня</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">23, Я не могу удержаться от спора, если люди не согласны со мной</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">24, Люди, увиливающие от работы, должны испытывать чувство вины</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">25, Тот, кто оскорбляет меня и мою семью, напрашивается на драку</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">26, Я не способен на грубые шутки</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">27, Меня охватывает ярость, когда надо мной насмехаются</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">28, Когда люди строят из себя начальников, я делаю все, чтобы они не зазнавались</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">29, Почти каждую неделю я вижу кого-нибудь, кто мне не нравится</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">30, Довольно многие люди завидуют мне</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">31, Я требую, чтобы люди уважали меня</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">32, Меня угнетает то, что я мало делаю для своих родителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">33, Люди, которые постоянно изводят вас, стоят того, чтобы их &quot;щелкнули по носу&quot;</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">34, Я никогда не бываю мрачен от злости</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">35, Если ко мне относятся хуже, чем я того заслуживаю, я не расстраиваюсь</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">36, Если кто-то выводит меня из себя, я не обращаю внимания</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">37, Хотя я и не показываю этого, меня иногда гложет зависть</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">38, Иногда мне кажется, что надо мной смеются</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">39, Даже если я злюсь, я не прибегаю к &quot;сильным&quot; выражениям</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">40, Мне хочется, чтобы мои грехи были прощены</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">41, Я редко даю сдачи, даже если кто-нибудь ударит меня</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">42, Когда получается не, по-моему, я иногда обижаюсь</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">43, Иногда люди раздражают меня одним своим присутствием</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">44, Нет людей, которых бы я по-настоящему ненавидел</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">45, Мой принцип: &quot;Никогда не доверять &quot;чужакам&quot;</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">46, Если кто-нибудь раздражает меня, я готов сказать, что я о нем думаю</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">47, Я делаю много такого, о чем впоследствии жалею</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">48, Если я разозлюсь, я могу ударить кого-нибудь</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">49, С детства я никогда не проявлял вспышек гнева</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">50, Я часто чувствую себя как пороховая бочка, готовая взорваться</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">51, Если бы все знали, что я чувствую, меня бы считали человеком, с которым нелегко работать</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">52, Я всегда думаю о том, какие тайные причины заставляют людей делать что-нибудь приятное для меня</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">53, Когда на меня кричат, я начинаю кричать в ответ</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">54, Неудачи огорчают меня</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">55, Я дерусь не реже и не чаще чем другие</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">56, Я могу вспомнить случаи, когда я был настолько зол, что хватал попавшуюся мне под руку вещь и ломал ее</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">57, Иногда я чувствую, что готов первым начать драку</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">58, Иногда я чувствую, что жизнь поступает со мной несправедливо</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">59, Раньше я думал, что большинство людей говорит правду, но теперь я в это не верю</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">60, Я ругаюсь только со злости</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">61, Когда я поступаю неправильно, меня мучает совесть</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">62, Если для защиты своих прав мне нужно применить физическую силу, я применяю ее</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">63, Иногда я выражаю свой гнев тем, что стучу кулаком по столу</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">64, Я бываю грубоват по отношению к людям, которые мне не нравятся</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">65, У меня нет врагов, которые бы хотели мне навредить</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">66, Я не умею поставить человека на место, даже если он того заслуживает</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">67, Я часто думаю, что жил неправильно</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">68, Я знаю людей, которые способны довести меня до драки</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">69, Я не огорчаюсь из-за мелочей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">70, Мне редко приходит в голову, что люди пытаются разозлить или оскорбить меня</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">71, Я часто только угрожаю людям, хотя и не собираюсь приводить угрозы в исполнение</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">72, В последнее время я стал занудой</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">73, В споре я часто повышаю голос</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">74, Я стараюсь обычно скрывать свое плохое отношение к людям</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">75, Я лучше соглашусь с чем-либо, чем стану спорить</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=12 align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">1, Я спокоен: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">2, Мне ничто не угрожает: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">3, Я нахожусь в напряжении: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">4, Я испытываю сожаление: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">5, Я чувствую себя свободно: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">6, Я расстроен: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">7, Меня волнуют возможные неудачи: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">8, Я чувствую себя отдохнувшим: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">9, Я не доволен собой: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">10, Я испытываю чувство внутреннего удовлетворения: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">11, Я уверен в себе: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">12, Я нервничаю: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">13, Я не нахожу себе места: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">14, Я взвинчен: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">15, Я не чувствую скованности, напряженности: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">16, Я доволен: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">17, Я озабочен: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">18, Я слишком возбужден и мне не по себе: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">19, Мне радостно: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">20, Мне приятно: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">21, Я испытываю удовольствие: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">22, Я очень быстро устаю: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">23, Я легко могу заплакать: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">24, Я хотел бы быть таким же счастливым, как и другие: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">25, Я проигрываю потому, что недостаточно быстро принимаю решения: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">26, Обычно я чувствую себя бодрым: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">27, Я спокоен, хладнокровен и собран: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">28, Ожидаемые трудности обычно тревожат меня: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">29, Я слишком переживаю из-за пустяков: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">30, Я вполне счастлив: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">31, Я принимаю все слишком близко к сердцу: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">32, Мне не хватает уверенности в себе: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">33, Обычно я чувствую себя в безопасности: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">34, Я стараюсь избегать критических ситуаций: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">35, У меня бывает хандра: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">36, Я доволен: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">37, Всякие пустяки отвлекают и волнуют меня: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">38, Я так сильно переживаю свои разочарования, что потом долго не могу о них забыть: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">39, Я уравновешенный человек: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">40, Меня охватывает сильное беспокойство, когда я думаю о своих делах и заботах:</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Показатель РТ (реактивная тревожность)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Показатель РТ (реактивная тревожность) расшифровка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Показатель ЛТ (личностная тревожность)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Показатель ЛТ (личностная тревожность) расшифровка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">1, Я спокоен: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">2, Мне ничто не угрожает: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">3, Я нахожусь в напряжении: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">4, Я испытываю сожаление: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">5, Я чувствую себя свободно: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">6, Я расстроен: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">7, Меня волнуют возможные неудачи: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">8, Я чувствую себя отдохнувшим: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">9, Я не доволен собой: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">10, Я испытываю чувство внутреннего удовлетворения: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">11, Я уверен в себе: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">12, Я нервничаю: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">13, Я не нахожу себе места: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">14, Я взвинчен: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">15, Я не чувствую скованности, напряженности: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">16, Я доволен: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">17, Я озабочен: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">18, Я слишком возбужден и мне не по себе: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">19, Мне радостно: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">20, Мне приятно: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">21, Я испытываю удовольствие: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">22, Я очень быстро устаю: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">23, Я легко могу заплакать: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">24, Я хотел бы быть таким же счастливым, как и другие: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">25, Я проигрываю потому, что недостаточно быстро принимаю решения: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">26, Обычно я чувствую себя бодрым: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">27, Я спокоен, хладнокровен и собран: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">28, Ожидаемые трудности обычно тревожат меня: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">29, Я слишком переживаю из-за пустяков: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">30, Я вполне счастлив: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">31, Я принимаю все слишком близко к сердцу: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">32, Мне не хватает уверенности в себе: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">33, Обычно я чувствую себя в безопасности: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">34, Я стараюсь избегать критических ситуаций: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">35, У меня бывает хандра: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">36, Я доволен: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">37, Всякие пустяки отвлекают и волнуют меня: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">38, Я так сильно переживаю свои разочарования, что потом долго не могу о них забыть: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">39, Я уравновешенный человек: </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">40, Меня охватывает сильное беспокойство, когда я думаю о своих делах и заботах:</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">Показатель РТ (реактивная тревожность)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FBE5D6"><font face="Times New Roman" size=3 color="#212529">Показатель РТ (реактивная тревожность) расшифровка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Показатель ЛТ (личностная тревожность)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Показатель ЛТ (личностная тревожность) расшифровка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">1, Учащение дыхания</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">2, Учащение пульса</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">3, Повышенная потливость</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">4, Покраснение отдельных участков кожных покровов</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">5, Нервные тики</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">6, Навязчивые не контролируемыми повторяющимися движениями (ребёнок постоянно крутит что-то в руках, теребит волосы, грызёт ручку, ногти и т,д,)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">7, Иные проявления беспокойства и нервозности</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">1, Учащение дыхания</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">2, Учащение пульса</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">3, Повышенная потливость</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">4, Покраснение отдельных участков кожных покровов</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">5, Нервные тики</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">6, Навязчивые не контролируемыми повторяющимися движениями (ребёнок постоянно крутит что-то в руках, теребит волосы, грызёт ручку, ногти и т,д,)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">7, Иные проявления беспокойства и нервозности</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">1, Завышенные требования учителей, не адекватные возможностям</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">2, Завышенные требования родителей, не адекватные возможностям</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">3, Грубость и приказной тон в общении со стороны учителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">4, Грубость и приказной тон в общении со родителей (законных представителей)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">5, Грубость и приказной тон в общении со сверстниками</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">6, Противоречивость предъявляемых к ребенку требований со стороны учителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">7, Противоречивость предъявляемых к ребенку требований со стороны родителей (законных представителей)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">8, Иные причины</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">1, Завышенные требования учителей, не адекватные возможностям</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">2, Завышенные требования родителей, не адекватные возможностям</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">3, Грубость и приказной тон в общении со стороны учителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">4, Грубость и приказной тон в общении со родителей (законных представителей)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">5, Грубость и приказной тон в общении со сверстниками</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">6, Противоречивость предъявляемых к ребенку требований со стороны учителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">7, Противоречивость предъявляемых к ребенку требований со стороны родителей (законных представителей)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">8, Иные причины</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">1, Завышенные требования учителей, не адекватные возможностям</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">2, Завышенные требования родителей, не адекватные возможностям</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">3, Грубость и приказной тон в общении со стороны учителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">4, Грубость и приказной тон в общении со родителей (законных представителей)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">5, Грубость и приказной тон в общении со сверстниками</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">6, Противоречивость предъявляемых к ребенку требований со стороны учителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">7, Противоречивость предъявляемых к ребенку требований со стороны родителей (законных представителей)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">8, Иные причины</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">1, Учителя преимущественно обращается к ребенку по имени</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">2, Учителя объясняет новый материал на понятных примерах</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">3, При объяснении нового материала ученик как правило испытывает интерес к процессу освоения новых знаний</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">4, Перед контрольной работой большинство учителей, как правило, рассказывают о порядке проведения контрольной работы, структуре заданий, необходимых умениях для успешного решения</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">5, При опросе ребенка учителя, как правило, не спрашивают его первым</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">6, Учителя регулярно хвалят ребенка при всех, даже за небольшие успехи</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">7, Учителя как правило, не акцентирует внимание коллектива на слабых сторонах ребенка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">1, Учителя преимущественно обращается к ребенку по имени</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">2, Учителя объясняет новый материал на понятных примерах</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">3, При объяснении нового материала ученик как правило испытывает интерес к процессу освоения новых знаний</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">4, Перед контрольной работой большинство учителей, как правило, рассказывают о порядке проведения контрольной работы, структуре заданий, необходимых умениях для успешного решения</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">5, При опросе ребенка учителя, как правило, не спрашивают его первым</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">6, Учителя регулярно хвалят ребенка при всех, даже за небольшие успехи</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">7, Учителя как правило, не акцентирует внимание коллектива на слабых сторонах ребенка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">1, Родители как правило не повышают голос на ребенка при общении с ним</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">2, Родители, как правило, заранее предупреждают ребенка о каких-либо изменениях в совместных планах</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">3, Если ребенок, что-то не хочет делать, и поэтому опаздывает, родители его специально не поторапливают</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">4, Родители всегда корректно отзываются об учителях, не давая им негативных оценок</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">5, Родители не запрещают без всяких причин делать то, что разрешалось делать раньше</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">6, Родители стараются помочь ребенку найти правильное решение в любой сложившейся ситуации</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">7, У ребенка есть любимое занятие по душе</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">8, Ребенок посещает кружок или спортивную секцию, где ему нравится заниматься</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">9, Родители владеют навыками игр и упражнений для снятия тревожности</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">10, Родители умеют спокойно справляться с повышенной тревожностью ребенка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">1, Родители как правило не повышают голос на ребенка при общении с ним</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">2, Родители, как правило, заранее предупреждают ребенка о каких-либо изменениях в совместных планах</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">3, Если ребенок, что-то не хочет делать, и поэтому опаздывает, родители его специально не поторапливают</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">4, Родители всегда корректно отзываются об учителях, не давая им негативных оценок</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">5, Родители не запрещают без всяких причин делать то, что разрешалось делать раньше</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">6, Родители стараются помочь ребенку найти правильное решение в любой сложившейся ситуации</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">7, У ребенка есть любимое занятие по душе</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">8, Ребенок посещает кружок или спортивную секцию, где ему нравится заниматься</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">9, Родители владеют навыками игр и упражнений для снятия тревожности</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">10, Родители умеют спокойно справляться с повышенной тревожностью ребенка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">1, Физическая агрессия к сверстникам (стремление причинить вред с помощью силы)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">2, Физическая агрессия к учителям</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">3, Физическая агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">4, Вербальная агрессия к сверстникам (через угрозы и оскорбления)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">5, Вербальная агрессия к учителям</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">6, Вербальная агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">7, Экспрессивная агрессию через угрожающие жесты, интонацию и мимику в отношении сверстников и (или) учителей и (или) родителей-законных представителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">1, Физическая агрессия к сверстникам (стремление причинить вред с помощью силы)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">2, Физическая агрессия к учителям</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">3, Физическая агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">4, Вербальная агрессия к сверстникам (через угрозы и оскорбления)</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">5, Вербальная агрессия к учителям</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">6, Вербальная агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">7, Экспрессивная агрессию через угрожающие жесты, интонацию и мимику в отношении сверстников и (или) учителей и (или) родителей-законных представителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">1, Агрессивное поведение родителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">2, Агрессивное поведение учителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">3, Агрессивное поведение сверстников</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">4, Использование агрессивной информационной среды</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">5, Использование агрессивной игровой среды</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">6, Иные причины</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">1, Агрессивное поведение родителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">2, Агрессивное поведение учителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">3, Агрессивное поведение сверстников</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">4, Использование агрессивной информационной среды</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">5, Использование агрессивной игровой среды</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">6, Иные причины</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">1, Агрессивное поведение родителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">2, Агрессивное поведение учителей</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">3, Агрессивное поведение сверстников</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">4, Использование агрессивной информационной среды</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">5, Использование агрессивной игровой среды</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">6, Иные причины</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFF2CC"><font face="Times New Roman" size=3 color="#212529">Оценка</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Физическая агрессия</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Косвенная агрессия</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Раздражение</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Негативизм</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Обида</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Подозрительность</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Вербальная агрессия</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Чувство вины</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Индекс агрессивности</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Индекс агрессивности РАСШИФРОВКА</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Индекс враждебности </font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#DAE3F3"><font face="Times New Roman" size=3 color="#212529">Индекс враждебности РАСШИФРОВКА</font></td>
                </tr>
                </thead>
                <tbody>
                <?
                $asd = [
                    'conti',
                    'class',
                    'name_responsible_person_individual',
                    'SpielbergerField_1',
                    'SpielbergerField_2',
                    'SpielbergerField_3',
                    'SpielbergerField_4',
                    'SpielbergerField_5',
                    'SpielbergerField_6',
                    'SpielbergerField_7',
                    'SpielbergerField_8',
                    'SpielbergerField_9',
                    'SpielbergerField_10',
                    'SpielbergerField_11',
                    'SpielbergerField_12',
                    'SpielbergerField_13',
                    'SpielbergerField_14',
                    'SpielbergerField_15',
                    'SpielbergerField_16',
                    'SpielbergerField_17',
                    'SpielbergerField_18',
                    'SpielbergerField_19',
                    'SpielbergerField_20',
                    'SpielbergerField_21',
                    'SpielbergerField_22',
                    'SpielbergerField_23',
                    'SpielbergerField_24',
                    'SpielbergerField_25',
                    'SpielbergerField_26',
                    'SpielbergerField_27',
                    'SpielbergerField_28',
                    'SpielbergerField_29',
                    'SpielbergerField_30',
                    'SpielbergerField_31',
                    'SpielbergerField_32',
                    'SpielbergerField_33',
                    'SpielbergerField_34',
                    'SpielbergerField_35',
                    'SpielbergerField_36',
                    'SpielbergerField_37',
                    'SpielbergerField_38',
                    'SpielbergerField_39',
                    'SpielbergerField_40',
                    'SpielbergerRT',
                    'SpielbergerRT1',
                    'SpielbergerLT',
                    'SpielbergerLT1',

                    'SpielbergerField_1_1',
                    'SpielbergerField_2_1',
                    'SpielbergerField_3_1',
                    'SpielbergerField_4_1',
                    'SpielbergerField_5_1',
                    'SpielbergerField_6_1',
                    'SpielbergerField_7_1',
                    'SpielbergerField_8_1',
                    'SpielbergerField_9_1',
                    'SpielbergerField_10_1',
                    'SpielbergerField_11_1',
                    'SpielbergerField_12_1',
                    'SpielbergerField_13_1',
                    'SpielbergerField_14_1',
                    'SpielbergerField_15_1',
                    'SpielbergerField_16_1',
                    'SpielbergerField_17_1',
                    'SpielbergerField_18_1',
                    'SpielbergerField_19_1',
                    'SpielbergerField_20_1',
                    'SpielbergerField_21_1',
                    'SpielbergerField_22_1',
                    'SpielbergerField_23_1',
                    'SpielbergerField_24_1',
                    'SpielbergerField_25_1',
                    'SpielbergerField_26_1',
                    'SpielbergerField_27_1',
                    'SpielbergerField_28_1',
                    'SpielbergerField_29_1',
                    'SpielbergerField_30_1',
                    'SpielbergerField_31_1',
                    'SpielbergerField_32_1',
                    'SpielbergerField_33_1',
                    'SpielbergerField_34_1',
                    'SpielbergerField_35_1',
                    'SpielbergerField_36_1',
                    'SpielbergerField_37_1',
                    'SpielbergerField_38_1',
                    'SpielbergerField_39_1',
                    'SpielbergerField_40_1',
                    'SpielbergerRT_1',
                    'SpielbergerRT1_1',
                    'SpielbergerLT_1',
                    'SpielbergerLT1_1',

                    'modelRiskQuestionnaireOnefield_1_teacher',
                    'modelRiskQuestionnaireOnefield_2_teacher',
                    'modelRiskQuestionnaireOnefield_3_teacher',
                    'modelRiskQuestionnaireOnefield_4_teacher',
                    'modelRiskQuestionnaireOnefield_5_teacher',
                    'modelRiskQuestionnaireOnefield_6_teacher',
                    'modelRiskQuestionnaireOnefield_7_teacher',
                    'RiskQuestionnaireOneestimation_teacher',

                    'modelRiskQuestionnaireOnefield_1_parent',
                    'modelRiskQuestionnaireOnefield_2_parent',
                    'modelRiskQuestionnaireOnefield_3_parent',
                    'modelRiskQuestionnaireOnefield_4_parent',
                    'modelRiskQuestionnaireOnefield_5_parent',
                    'modelRiskQuestionnaireOnefield_6_parent',
                    'modelRiskQuestionnaireOnefield_7_parent',
                    'RiskQuestionnaireOneestimation_parent',
                    'modelRiskQuestionnaireOneOnestrItogTab1',
                    'modelRiskQuestionnaireOneOnestrItogTab1_fff',
                    'modelRiskQuestionnaireOneOnestrItogTab1_1',
                    'modelRiskQuestionnaireOneOnestrItogTab1_2',

                    'modelRiskQuestionnaireTwofield_1_teacher',
                    'modelRiskQuestionnaireTwofield_2_teacher',
                    'modelRiskQuestionnaireTwofield_3_teacher',
                    'modelRiskQuestionnaireTwofield_4_teacher',
                    'modelRiskQuestionnaireTwofield_5_teacher',
                    'modelRiskQuestionnaireTwofield_6_teacher',
                    'modelRiskQuestionnaireTwofield_7_teacher',
                    'modelRiskQuestionnaireTwofield_8_teacher',
                    'modelRiskQuestionnaireTwo_teacher',
                    'modelRiskQuestionnaireTwofield_1_parent',
                    'modelRiskQuestionnaireTwofield_2_parent',
                    'modelRiskQuestionnaireTwofield_3_parent',
                    'modelRiskQuestionnaireTwofield_4_parent',
                    'modelRiskQuestionnaireTwofield_5_parent',
                    'modelRiskQuestionnaireTwofield_6_parent',
                    'modelRiskQuestionnaireTwofield_7_parent',
                    'modelRiskQuestionnaireTwofield_8_parent',
                    'modelRiskQuestionnaireTwoestimation_parent',
                    'modelRiskQuestionnaireTwofield_1_chile',
                    'modelRiskQuestionnaireTwofield_2_chile',
                    'modelRiskQuestionnaireTwofield_3_chile',
                    'modelRiskQuestionnaireTwofield_4_chile',
                    'modelRiskQuestionnaireTwofield_5_chile',
                    'modelRiskQuestionnaireTwofield_6_chile',
                    'modelRiskQuestionnaireTwofield_7_chile',
                    'modelRiskQuestionnaireTwofield_8_chile',
                    'modelRiskQuestionnaireTwoestimation_chile',
                    'modelRiskQuestionnaireTwostrItogTab1',
                    'modelRiskQuestionnaireTwoOnestrItogTab1_fff',
                    'modelRiskQuestionnaireTwoOnestrItogTab1_1',
                    'modelRiskQuestionnaireTwoOnestrItogTab1_2',
                    'modelRiskQuestionnaireTwoOnestrItogTab1_3',


                    'modelRiskQuestionnaireThreefield_1_teacher',
                    'modelRiskQuestionnaireThreefield_2_teacher',
                    'modelRiskQuestionnaireThreefield_3_teacher',
                    'modelRiskQuestionnaireThreefield_4_teacher',
                    'modelRiskQuestionnaireThreefield_5_teacher',
                    'modelRiskQuestionnaireThreefield_6_teacher',
                    'modelRiskQuestionnaireThreefield_7_teacher',
                    'modelRiskQuestionnaireThreeestimation_teacher',
                    'modelRiskQuestionnaireThreefield_1_parent',
                    'modelRiskQuestionnaireThreefield_2_parent',
                    'modelRiskQuestionnaireThreefield_3_parent',
                    'modelRiskQuestionnaireThreefield_4_parent',
                    'modelRiskQuestionnaireThreefield_5_parent',
                    'modelRiskQuestionnaireThreefield_6_parent',
                    'modelRiskQuestionnaireThreefield_7_parent',
                    'modelRiskQuestionnaireThreeestimation_parent',
                    'modelRiskQuestionnaireThrestrItogTab1',
                    'modelRiskQuestionnaireThreOnestrItogTab1_fff',
                    'modelRiskQuestionnaireThreOnestrItogTab1_1',
                    'modelRiskQuestionnaireThreOnestrItogTab1_2',

                    'modelRiskQuestionnaireFourfield_1_parent',
                    'modelRiskQuestionnaireFourfield_2_parent',
                    'modelRiskQuestionnaireFourfield_3_parent',
                    'modelRiskQuestionnaireFourfield_4_parent',
                    'modelRiskQuestionnaireFourfield_5_parent',
                    'modelRiskQuestionnaireFourfield_6_parent',
                    'modelRiskQuestionnaireFourfield_7_parent',
                    'modelRiskQuestionnaireFourfield_8_parent',
                    'modelRiskQuestionnaireFourfield_9_parent',
                    'modelRiskQuestionnaireFourfield_10_parent',
                    'modelRiskQuestionnaireFourestimation_parent',
                    'modelRiskQuestionnaireFourfield_1_chile',
                    'modelRiskQuestionnaireFourfield_2_chile',
                    'modelRiskQuestionnaireFourfield_3_chile',
                    'modelRiskQuestionnaireFourfield_4_chile',
                    'modelRiskQuestionnaireFourfield_5_chile',
                    'modelRiskQuestionnaireFourfield_6_chile',
                    'modelRiskQuestionnaireFourfield_7_chile',
                    'modelRiskQuestionnaireFourfield_8_chile',
                    'modelRiskQuestionnaireFourfield_9_chile',
                    'modelRiskQuestionnaireFourfield_10_chile',
                    'modelRiskQuestionnaireFourestimation_chile',
                    'modelRiskQuestionnaireFourestrItogTab1',
                    'modelRiskQuestionnaireFourOnestrItogTab1_fff',
                    'modelRiskQuestionnaireFourOnestrItogTab1_1',
                    'modelRiskQuestionnaireFourOnestrItogTab1_2',

                    'modelRiskQuestionnaireFivefield_1_teacher',
                    'modelRiskQuestionnaireFivefield_2_teacher',
                    'modelRiskQuestionnaireFivefield_3_teacher',
                    'modelRiskQuestionnaireFivefield_4_teacher',
                    'modelRiskQuestionnaireFivefield_5_teacher',
                    'modelRiskQuestionnaireFivefield_6_teacher',
                    'modelRiskQuestionnaireFivefield_7_teacher',
                    'modelRiskQuestionnaireFiveestimation_teacher',
                    'modelRiskQuestionnaireFivefield_1_parent',
                    'modelRiskQuestionnaireFivefield_2_parent',
                    'modelRiskQuestionnaireFivefield_3_parent',
                    'modelRiskQuestionnaireFivefield_4_parent',
                    'modelRiskQuestionnaireFivefield_5_parent',
                    'modelRiskQuestionnaireFivefield_6_parent',
                    'modelRiskQuestionnaireFivefield_7_parent',
                    'modelRiskQuestionnaireFiveestimation_parent',
                    'modelRiskQuestionnaireFiveestrItogTab1',
                    'modelRiskQuestionnaireFiveOnestrItogTab1_fff',
                    'modelRiskQuestionnaireFiveOnestrItogTab1_1',
                    'modelRiskQuestionnaireFiveOnestrItogTab1_2',

                    'modelRiskQuestionnaireSixfield_1_teacher',
                    'modelRiskQuestionnaireSixfield_2_teacher',
                    'modelRiskQuestionnaireSixfield_3_teacher',
                    'modelRiskQuestionnaireSixfield_4_teacher',
                    'modelRiskQuestionnaireSixfield_5_teacher',
                    'modelRiskQuestionnaireSixfield_6_teacher',
                    'modelRiskQuestionnaireSixestimation_teacher',
                    'modelRiskQuestionnaireSixfield_1_parent',
                    'modelRiskQuestionnaireSixfield_2_parent',
                    'modelRiskQuestionnaireSixfield_3_parent',
                    'modelRiskQuestionnaireSixfield_4_parent',
                    'modelRiskQuestionnaireSixfield_5_parent',
                    'modelRiskQuestionnaireSixfield_6_parent',
                    'modelRiskQuestionnaireSixestimation_parent',
                    'modelRiskQuestionnaireSixfield_1_chile',
                    'modelRiskQuestionnaireSixfield_2_chile',
                    'modelRiskQuestionnaireSixfield_3_chile',
                    'modelRiskQuestionnaireSixfield_4_chile',
                    'modelRiskQuestionnaireSixfield_5_chile',
                    'modelRiskQuestionnaireSixfield_6_chile',
                    'modelRiskQuestionnaireSixestimation_chile',
                    'modelRiskQuestionnaireSixestrItogTab1',
                    'modelRiskQuestionnaireSixOnestrItogTab1_fff',
                    'modelRiskQuestionnaireSixOnestrItogTab1_1',
                    'modelRiskQuestionnaireSixOnestrItogTab1_2',
                    'modelRiskQuestionnaireSixOnestrItogTab1_3',

                    'RiskQuestionnaireBassDarckfield_1',
                    'RiskQuestionnaireBassDarckfield_2',
                    'RiskQuestionnaireBassDarckfield_3',
                    'RiskQuestionnaireBassDarckfield_4',
                    'RiskQuestionnaireBassDarckfield_5',
                    'RiskQuestionnaireBassDarckfield_6',
                    'RiskQuestionnaireBassDarckfield_7',
                    'RiskQuestionnaireBassDarckfield_8',
                    'RiskQuestionnaireBassDarckfield_9',
                    'RiskQuestionnaireBassDarckfield_10',
                    'RiskQuestionnaireBassDarckfield_11',
                    'RiskQuestionnaireBassDarckfield_12',
                    'RiskQuestionnaireBassDarckfield_13',
                    'RiskQuestionnaireBassDarckfield_14',
                    'RiskQuestionnaireBassDarckfield_15',
                    'RiskQuestionnaireBassDarckfield_16',
                    'RiskQuestionnaireBassDarckfield_17',
                    'RiskQuestionnaireBassDarckfield_18',
                    'RiskQuestionnaireBassDarckfield_19',
                    'RiskQuestionnaireBassDarckfield_20',
                    'RiskQuestionnaireBassDarckfield_21',
                    'RiskQuestionnaireBassDarckfield_22',
                    'RiskQuestionnaireBassDarckfield_23',
                    'RiskQuestionnaireBassDarckfield_24',
                    'RiskQuestionnaireBassDarckfield_25',
                    'RiskQuestionnaireBassDarckfield_26',
                    'RiskQuestionnaireBassDarckfield_27',
                    'RiskQuestionnaireBassDarckfield_28',
                    'RiskQuestionnaireBassDarckfield_29',
                    'RiskQuestionnaireBassDarckfield_30',
                    'RiskQuestionnaireBassDarckfield_31',
                    'RiskQuestionnaireBassDarckfield_32',
                    'RiskQuestionnaireBassDarckfield_33',
                    'RiskQuestionnaireBassDarckfield_34',
                    'RiskQuestionnaireBassDarckfield_35',
                    'RiskQuestionnaireBassDarckfield_36',
                    'RiskQuestionnaireBassDarckfield_37',
                    'RiskQuestionnaireBassDarckfield_38',
                    'RiskQuestionnaireBassDarckfield_39',
                    'RiskQuestionnaireBassDarckfield_40',
                    'RiskQuestionnaireBassDarckfield_41',
                    'RiskQuestionnaireBassDarckfield_42',
                    'RiskQuestionnaireBassDarckfield_43',
                    'RiskQuestionnaireBassDarckfield_44',
                    'RiskQuestionnaireBassDarckfield_45',
                    'RiskQuestionnaireBassDarckfield_46',
                    'RiskQuestionnaireBassDarckfield_47',
                    'RiskQuestionnaireBassDarckfield_48',
                    'RiskQuestionnaireBassDarckfield_49',
                    'RiskQuestionnaireBassDarckfield_50',
                    'RiskQuestionnaireBassDarckfield_51',
                    'RiskQuestionnaireBassDarckfield_52',
                    'RiskQuestionnaireBassDarckfield_53',
                    'RiskQuestionnaireBassDarckfield_54',
                    'RiskQuestionnaireBassDarckfield_55',
                    'RiskQuestionnaireBassDarckfield_56',
                    'RiskQuestionnaireBassDarckfield_57',
                    'RiskQuestionnaireBassDarckfield_58',
                    'RiskQuestionnaireBassDarckfield_59',
                    'RiskQuestionnaireBassDarckfield_60',
                    'RiskQuestionnaireBassDarckfield_61',
                    'RiskQuestionnaireBassDarckfield_62',
                    'RiskQuestionnaireBassDarckfield_63',
                    'RiskQuestionnaireBassDarckfield_64',
                    'RiskQuestionnaireBassDarckfield_65',
                    'RiskQuestionnaireBassDarckfield_66',
                    'RiskQuestionnaireBassDarckfield_67',
                    'RiskQuestionnaireBassDarckfield_68',
                    'RiskQuestionnaireBassDarckfield_69',
                    'RiskQuestionnaireBassDarckfield_70',
                    'RiskQuestionnaireBassDarckfield_71',
                    'RiskQuestionnaireBassDarckfield_72',
                    'RiskQuestionnaireBassDarckfield_73',
                    'RiskQuestionnaireBassDarckfield_74',
                    'RiskQuestionnaireBassDarckfield_75',
                    'RiskQuestionnaireBassDarckphysical_aggression_1',
                    'RiskQuestionnaireBassDarckindirect_aggression_2',
                    'RiskQuestionnaireBassDarckirritation_3',
                    'RiskQuestionnaireBassDarcknegativism_4',
                    'RiskQuestionnaireBassDarckresentment_5',
                    'RiskQuestionnaireBassDarcksuspicion_6',
                    'RiskQuestionnaireBassDarckverbal_aggression_7',
                    'RiskQuestionnaireBassDarckfeeling_guilty_8',
                    'RiskQuestionnaireBassDarckaggressiveness_index',
                    'RiskQuestionnaireBassDarckaggressiveness_index_1',
                    'RiskQuestionnaireBassDarckincludes_index',
                    'RiskQuestionnaireBassDarckincludes_index_1',
                ];
                foreach ($result as $key => $row) {?>
                    <tr>
                        <td><?=$key?></td>
                        <?
                        foreach ($asd as $one) {?>
                            <td><?=$row[$one]?></td>
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