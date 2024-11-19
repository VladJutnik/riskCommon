<?php

use common\models\FederalDistrict;
use common\models\Region;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Отчет по коллективному риску: ';

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
    ?>
    <style>
        td.style0 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style0 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style1 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #FFF2CB
        }

        th.style1 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #FFF2CB
        }

        td.style2 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        th.style2 {
            vertical-align: bottom;
            border-bottom: none #000000;
            border-top: none #000000;
            border-left: none #000000;
            border-right: none #000000;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: white
        }

        td.style3 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #FFF2CB
        }

        th.style3 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #FFF2CB
        }

        td.style4 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #212529;
            font-family: 'Times New Roman';
            font-size: 12pt;
            background-color: #FFF2CB
        }

        th.style4 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #212529;
            font-family: 'Times New Roman';
            font-size: 12pt;
            background-color: #FFF2CB
        }

        td.style5 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #FFF2CB
        }

        th.style5 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #FFF2CB
        }

        td.style6 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #212529;
            font-family: 'Times New Roman';
            font-size: 12pt;
            background-color: #FBE4D5
        }

        th.style6 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #212529;
            font-family: 'Times New Roman';
            font-size: 12pt;
            background-color: #FBE4D5
        }

        td.style7 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #212529;
            font-family: 'Times New Roman';
            font-size: 12pt;
            background-color: #FFF2CB
        }

        th.style7 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #212529;
            font-family: 'Times New Roman';
            font-size: 12pt;
            background-color: #FFF2CB
        }

        td.style8 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #212529;
            font-family: 'Times New Roman';
            font-size: 12pt;
            background-color: #D9E2F3
        }

        th.style8 {
            vertical-align: bottom;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #212529;
            font-family: 'Times New Roman';
            font-size: 12pt;
            background-color: #D9E2F3
        }

        td.style9 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #212529;
            font-family: 'Times New Roman';
            font-size: 12pt;
            background-color: #FFF2CB
        }

        th.style9 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #212529;
            font-family: 'Times New Roman';
            font-size: 12pt;
            background-color: #FFF2CB
        }

        td.style10 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #FBE4D5
        }

        th.style10 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #FBE4D5
        }

        td.style11 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #D9E2F3
        }

        th.style11 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #D9E2F3
        }

        td.style12 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: white
        }

        th.style12 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: white
        }

        td.style13 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: white
        }

        th.style13 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: white
        }

        td.style14 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: #E2EEDA
        }

        th.style14 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Calibri';
            font-size: 11pt;
            background-color: #E2EEDA
        }

        td.style15 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #E2EEDA
        }

        th.style15 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #E2EEDA
        }

        td.style16 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #212529;
            font-family: 'Times New Roman';
            font-size: 12pt;
            background-color: #FFF2CB
        }

        th.style16 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #212529;
            font-family: 'Times New Roman';
            font-size: 12pt;
            background-color: #FFF2CB
        }

        td.style17 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #FFF2CB
        }

        th.style17 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #FFF2CB
        }

        td.style18 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #FBE4D5
        }

        th.style18 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #FBE4D5
        }

        td.style19 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #D9E2F3
        }

        th.style19 {
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #000000 !important;
            border-top: 1px solid #000000 !important;
            border-left: 1px solid #000000 !important;
            border-right: 1px solid #000000 !important;
            font-weight: bold;
            color: #000000;
            font-family: 'Times New Roman';
            font-size: 11pt;
            background-color: #D9E2F3
        }

        table.sheet0 col.col0 {
            width: 42pt
        }

        table.sheet0 col.col1 {
            width: 42pt
        }

        table.sheet0 col.col2 {
            width: 42pt
        }

        table.sheet0 col.col3 {
            width: 42pt
        }

        table.sheet0 col.col4 {
            width: 42pt
        }

        table.sheet0 col.col5 {
            width: 42pt
        }

        table.sheet0 col.col6 {
            width: 42pt
        }

        table.sheet0 col.col7 {
            width: 42pt
        }

        table.sheet0 col.col8 {
            width: 42pt
        }

        table.sheet0 col.col9 {
            width: 42pt
        }

        table.sheet0 col.col10 {
            width: 42pt
        }

        table.sheet0 col.col11 {
            width: 42pt
        }

        table.sheet0 col.col12 {
            width: 42pt
        }

        table.sheet0 col.col13 {
            width: 42pt
        }

        table.sheet0 col.col14 {
            width: 42pt
        }

        table.sheet0 col.col15 {
            width: 42pt
        }

        table.sheet0 col.col16 {
            width: 42pt
        }

        table.sheet0 col.col17 {
            width: 42pt
        }

        table.sheet0 col.col18 {
            width: 42pt
        }

        table.sheet0 col.col19 {
            width: 42pt
        }

        table.sheet0 col.col20 {
            width: 42pt
        }

        table.sheet0 col.col21 {
            width: 42pt
        }

        table.sheet0 col.col22 {
            width: 42pt
        }

        table.sheet0 col.col23 {
            width: 42pt
        }

        table.sheet0 col.col24 {
            width: 42pt
        }

        table.sheet0 col.col25 {
            width: 42pt
        }

        table.sheet0 col.col26 {
            width: 42pt
        }

        table.sheet0 col.col27 {
            width: 42pt
        }

        table.sheet0 col.col28 {
            width: 42pt
        }

        table.sheet0 col.col29 {
            width: 42pt
        }

        table.sheet0 col.col30 {
            width: 42pt
        }

        table.sheet0 col.col31 {
            width: 42pt
        }

        table.sheet0 col.col32 {
            width: 42pt
        }

        table.sheet0 col.col33 {
            width: 42pt
        }

        table.sheet0 col.col34 {
            width: 42pt
        }

        table.sheet0 col.col35 {
            width: 42pt
        }

        table.sheet0 col.col36 {
            width: 42pt
        }

        table.sheet0 col.col37 {
            width: 42pt
        }

        table.sheet0 col.col38 {
            width: 42pt
        }

        table.sheet0 col.col39 {
            width: 42pt
        }

        table.sheet0 col.col40 {
            width: 42pt
        }

        table.sheet0 col.col41 {
            width: 42pt
        }

        table.sheet0 col.col42 {
            width: 42pt
        }

        table.sheet0 col.col43 {
            width: 42pt
        }

        table.sheet0 col.col44 {
            width: 42pt
        }

        table.sheet0 col.col45 {
            width: 42pt
        }

        table.sheet0 col.col46 {
            width: 42pt
        }

        table.sheet0 col.col47 {
            width: 42pt
        }

        table.sheet0 col.col48 {
            width: 42pt
        }

        table.sheet0 col.col49 {
            width: 42pt
        }

        table.sheet0 col.col50 {
            width: 42pt
        }

        table.sheet0 col.col51 {
            width: 42pt
        }

        table.sheet0 col.col52 {
            width: 42pt
        }

        table.sheet0 col.col53 {
            width: 42pt
        }

        table.sheet0 col.col54 {
            width: 42pt
        }

        table.sheet0 col.col55 {
            width: 42pt
        }

        table.sheet0 col.col56 {
            width: 42pt
        }

        table.sheet0 col.col57 {
            width: 42pt
        }

        table.sheet0 col.col58 {
            width: 42pt
        }

        table.sheet0 col.col59 {
            width: 42pt
        }

        table.sheet0 col.col60 {
            width: 42pt
        }

        table.sheet0 col.col61 {
            width: 42pt
        }

        table.sheet0 col.col62 {
            width: 42pt
        }

        table.sheet0 col.col63 {
            width: 42pt
        }

        table.sheet0 col.col64 {
            width: 42pt
        }

        table.sheet0 col.col65 {
            width: 42pt
        }

        table.sheet0 col.col66 {
            width: 42pt
        }

        table.sheet0 col.col67 {
            width: 42pt
        }

        table.sheet0 col.col68 {
            width: 42pt
        }

        table.sheet0 col.col69 {
            width: 42pt
        }

        table.sheet0 col.col70 {
            width: 42pt
        }

        table.sheet0 col.col71 {
            width: 42pt
        }

        table.sheet0 col.col72 {
            width: 42pt
        }

        table.sheet0 col.col73 {
            width: 42pt
        }

        table.sheet0 col.col74 {
            width: 42pt
        }

        table.sheet0 col.col75 {
            width: 42pt
        }

        table.sheet0 col.col76 {
            width: 42pt
        }

        table.sheet0 col.col77 {
            width: 42pt
        }

        table.sheet0 col.col78 {
            width: 42pt
        }

        table.sheet0 col.col79 {
            width: 42pt
        }

        table.sheet0 col.col80 {
            width: 42pt
        }

        table.sheet0 col.col81 {
            width: 42pt
        }

        table.sheet0 col.col82 {
            width: 42pt
        }

        table.sheet0 col.col83 {
            width: 42pt
        }

        table.sheet0 col.col84 {
            width: 42pt
        }

        table.sheet0 col.col85 {
            width: 42pt
        }

        table.sheet0 col.col86 {
            width: 42pt
        }

        table.sheet0 col.col87 {
            width: 42pt
        }

        table.sheet0 col.col88 {
            width: 42pt
        }

        table.sheet0 col.col89 {
            width: 42pt
        }

        table.sheet0 col.col90 {
            width: 42pt
        }

        table.sheet0 col.col91 {
            width: 42pt
        }

        table.sheet0 col.col92 {
            width: 42pt
        }

        table.sheet0 col.col93 {
            width: 42pt
        }

        table.sheet0 col.col94 {
            width: 42pt
        }

        table.sheet0 col.col95 {
            width: 42pt
        }

        table.sheet0 col.col96 {
            width: 42pt
        }

        table.sheet0 col.col97 {
            width: 42pt
        }

        table.sheet0 col.col98 {
            width: 42pt
        }

        table.sheet0 col.col99 {
            width: 42pt
        }

        table.sheet0 col.col100 {
            width: 42pt
        }

        table.sheet0 col.col101 {
            width: 42pt
        }

        table.sheet0 col.col102 {
            width: 42pt
        }

        table.sheet0 col.col103 {
            width: 42pt
        }

        table.sheet0 col.col104 {
            width: 42pt
        }

        table.sheet0 col.col105 {
            width: 42pt
        }

        table.sheet0 col.col106 {
            width: 42pt
        }

        table.sheet0 col.col107 {
            width: 42pt
        }

        table.sheet0 col.col108 {
            width: 42pt
        }

        table.sheet0 col.col109 {
            width: 42pt
        }

        table.sheet0 col.col110 {
            width: 42pt
        }

        table.sheet0 col.col111 {
            width: 42pt
        }

        table.sheet0 col.col112 {
            width: 42pt
        }

        table.sheet0 col.col113 {
            width: 42pt
        }

        table.sheet0 col.col114 {
            width: 42pt
        }

        table.sheet0 col.col115 {
            width: 42pt
        }

        table.sheet0 col.col116 {
            width: 42pt
        }

        table.sheet0 col.col117 {
            width: 42pt
        }

        table.sheet0 col.col118 {
            width: 42pt
        }

        table.sheet0 col.col119 {
            width: 42pt
        }

        table.sheet0 col.col120 {
            width: 42pt
        }

        table.sheet0 col.col121 {
            width: 42pt
        }

        table.sheet0 col.col122 {
            width: 42pt
        }

        table.sheet0 col.col123 {
            width: 42pt
        }

        table.sheet0 col.col124 {
            width: 42pt
        }

        table.sheet0 col.col125 {
            width: 42pt
        }

        table.sheet0 col.col126 {
            width: 42pt
        }

        table.sheet0 col.col127 {
            width: 42pt
        }

        table.sheet0 col.col128 {
            width: 42pt
        }

        table.sheet0 col.col129 {
            width: 42pt
        }

        table.sheet0 col.col130 {
            width: 42pt
        }

        table.sheet0 col.col131 {
            width: 42pt
        }

        table.sheet0 col.col132 {
            width: 42pt
        }

        table.sheet0 col.col133 {
            width: 42pt
        }

        table.sheet0 col.col134 {
            width: 42pt
        }

        table.sheet0 col.col135 {
            width: 42pt
        }

        table.sheet0 col.col136 {
            width: 42pt
        }

        table.sheet0 col.col137 {
            width: 42pt
        }

        table.sheet0 col.col138 {
            width: 42pt
        }

        table.sheet0 col.col139 {
            width: 42pt
        }

        table.sheet0 col.col140 {
            width: 42pt
        }

        table.sheet0 col.col141 {
            width: 42pt
        }

        table.sheet0 col.col142 {
            width: 42pt
        }

        table.sheet0 col.col143 {
            width: 42pt
        }

        table.sheet0 col.col144 {
            width: 42pt
        }

        table.sheet0 col.col145 {
            width: 42pt
        }

        table.sheet0 col.col146 {
            width: 42pt
        }

        table.sheet0 col.col147 {
            width: 42pt
        }

        table.sheet0 col.col148 {
            width: 42pt
        }

        table.sheet0 col.col149 {
            width: 42pt
        }

        table.sheet0 col.col150 {
            width: 42pt
        }

        table.sheet0 col.col151 {
            width: 42pt
        }

        table.sheet0 col.col152 {
            width: 42pt
        }

        table.sheet0 col.col153 {
            width: 42pt
        }

        table.sheet0 col.col154 {
            width: 42pt
        }

        table.sheet0 col.col155 {
            width: 42pt
        }

        table.sheet0 col.col156 {
            width: 42pt
        }

        table.sheet0 col.col157 {
            width: 42pt
        }

        table.sheet0 col.col158 {
            width: 42pt
        }

        table.sheet0 col.col159 {
            width: 42pt
        }

        table.sheet0 col.col160 {
            width: 42pt
        }

        table.sheet0 col.col161 {
            width: 42pt
        }

        table.sheet0 col.col162 {
            width: 42pt
        }

        table.sheet0 col.col163 {
            width: 42pt
        }

        table.sheet0 col.col164 {
            width: 42pt
        }

        table.sheet0 col.col165 {
            width: 42pt
        }

        table.sheet0 col.col166 {
            width: 42pt
        }

        table.sheet0 col.col167 {
            width: 42pt
        }

        table.sheet0 col.col168 {
            width: 42pt
        }

        table.sheet0 col.col169 {
            width: 42pt
        }

        table.sheet0 col.col170 {
            width: 42pt
        }

        table.sheet0 col.col171 {
            width: 42pt
        }

        table.sheet0 col.col172 {
            width: 42pt
        }

        table.sheet0 col.col173 {
            width: 42pt
        }

        table.sheet0 col.col174 {
            width: 42pt
        }

        table.sheet0 col.col175 {
            width: 42pt
        }

        table.sheet0 col.col176 {
            width: 42pt
        }

        table.sheet0 col.col177 {
            width: 42pt
        }

        table.sheet0 col.col178 {
            width: 42pt
        }

        table.sheet0 col.col179 {
            width: 42pt
        }

        table.sheet0 col.col180 {
            width: 42pt
        }

        table.sheet0 col.col181 {
            width: 42pt
        }

        table.sheet0 col.col182 {
            width: 42pt
        }

        table.sheet0 col.col183 {
            width: 42pt
        }

        table.sheet0 col.col184 {
            width: 42pt
        }

        table.sheet0 col.col185 {
            width: 42pt
        }

        table.sheet0 col.col186 {
            width: 42pt
        }

        table.sheet0 col.col187 {
            width: 42pt
        }

        table.sheet0 col.col188 {
            width: 42pt
        }

        table.sheet0 col.col189 {
            width: 42pt
        }

        table.sheet0 col.col190 {
            width: 42pt
        }

        table.sheet0 col.col191 {
            width: 42pt
        }

        table.sheet0 col.col192 {
            width: 42pt
        }

        table.sheet0 col.col193 {
            width: 42pt
        }

        table.sheet0 col.col194 {
            width: 42pt
        }

        table.sheet0 col.col195 {
            width: 42pt
        }

        table.sheet0 col.col196 {
            width: 42pt
        }

        table.sheet0 col.col197 {
            width: 42pt
        }

        table.sheet0 col.col198 {
            width: 42pt
        }

        table.sheet0 col.col199 {
            width: 42pt
        }

        table.sheet0 col.col200 {
            width: 42pt
        }

        table.sheet0 col.col201 {
            width: 42pt
        }

        table.sheet0 col.col202 {
            width: 42pt
        }

        table.sheet0 col.col203 {
            width: 42pt
        }

        table.sheet0 col.col204 {
            width: 42pt
        }

        table.sheet0 col.col205 {
            width: 42pt
        }

        table.sheet0 col.col206 {
            width: 42pt
        }

        table.sheet0 col.col207 {
            width: 42pt
        }

        table.sheet0 col.col208 {
            width: 42pt
        }

        table.sheet0 col.col209 {
            width: 42pt
        }

        table.sheet0 col.col210 {
            width: 42pt
        }

        table.sheet0 col.col211 {
            width: 42pt
        }

        table.sheet0 col.col212 {
            width: 42pt
        }

        table.sheet0 col.col213 {
            width: 42pt
        }

        table.sheet0 col.col214 {
            width: 42pt
        }

        table.sheet0 col.col215 {
            width: 42pt
        }

        table.sheet0 col.col216 {
            width: 42pt
        }

        table.sheet0 col.col217 {
            width: 42pt
        }

        table.sheet0 col.col218 {
            width: 42pt
        }

        table.sheet0 col.col219 {
            width: 42pt
        }

        table.sheet0 col.col220 {
            width: 42pt
        }

        table.sheet0 col.col221 {
            width: 42pt
        }

        table.sheet0 col.col222 {
            width: 42pt
        }

        table.sheet0 col.col223 {
            width: 42pt
        }

        table.sheet0 col.col224 {
            width: 42pt
        }

        table.sheet0 col.col225 {
            width: 42pt
        }

        table.sheet0 col.col226 {
            width: 42pt
        }

        table.sheet0 col.col227 {
            width: 42pt
        }

        table.sheet0 col.col228 {
            width: 42pt
        }

        table.sheet0 col.col229 {
            width: 42pt
        }

        table.sheet0 col.col230 {
            width: 42pt
        }

        table.sheet0 col.col231 {
            width: 42pt
        }

        table.sheet0 col.col232 {
            width: 42pt
        }

        table.sheet0 col.col233 {
            width: 42pt
        }

        table.sheet0 col.col234 {
            width: 42pt
        }

        table.sheet0 col.col235 {
            width: 42pt
        }

        table.sheet0 col.col236 {
            width: 42pt
        }

        table.sheet0 col.col237 {
            width: 42pt
        }

        table.sheet0 col.col238 {
            width: 42pt
        }

        table.sheet0 tr {
            height: 15pt
        }

        table.sheet0 tr.row0 {
            height: 15pt
        }

        table.sheet0 tr.row1 {
            height: 21.75pt
        }

        table.sheet0 tr.row2 {
            height: 35.25pt
        }

        table.sheet0 tr.row3 {
            height: 409.5pt
        }
    </style>
    <div class="p-1">

        <input type="button" class="btn btn-warning btn-block table2excel mb-3 mt-3"
               title="Вы можете скачать в формате Excel" value="Скачать в Excel" id="pechat222">
        <div class="table-responsive">
            <table id="tableId22222" class="table table-bordered table-sm table2excel_with_colors">
                <thead>
                <tr class="row0">
                    <td class="column0 style12 s style12" rowspan="4">№</td>
                    <td class="column1 style13 s style13" rowspan="4">Федеральный округ</td>
                    <td class="column2 style13 s style13" rowspan="4">Регион</td>
                    <td class="column3 style13 s style13" rowspan="4">Муниципальное образование</td>
                    <td class="column4 style13 s style13" rowspan="4">Название организации</td>
                    <td class="column4 style13 s style13" rowspan="4">Дата расчета</td>
                    <td class="column5 style1 s style1" colspan="82">1-4 классы</td>
                    <td class="column86 style1 s style1" colspan="93">5 - 9 классы</td>
                    <td class="column178 style1 s style1" colspan="60">10 -11 классы</td>
                    <td class="column237 style14 s style14" rowspan="4">R - коллекстивный риск</td>
                    <td class="column238 style14 s style14" rowspan="4">Вероятность формирования нарушений осанки и
                        зрения у обучающихся
                    </td>
                </tr>
                <tr class="row1">
                    <td class="column5 style3 s style3" colspan="6" rowspan="2">Ученическая мебель</td>
                    <td class="column11 style4 s style4" colspan="5" rowspan="2">Искусственная освещенность</td>
                    <td class="column16 style5 s style5" colspan="3" rowspan="2">Гимнастика для глаз</td>
                    <td class="column19 style4 s style4" colspan="2" rowspan="2">Гимнастика для глаз</td>
                    <td class="column21 style5 s style5" colspan="9">Использование электронных средств обучения и
                        средств мобильной связи
                    </td>
                    <td class="column30 style14 s style14" rowspan="3">Общий риск</td>
                    <td class="column30 style14 s style14" rowspan="3">Общий риск коэффециент</td>
                    <td class="column31 style6 s style6" colspan="11">1 класс</td>
                    <td class="column42 style7 s style7" colspan="11">2 класс</td>
                    <td class="column53 style6 s style6" colspan="11">3 класс</td>
                    <td class="column64 style7 s style7" colspan="11">4 класс</td>
                    <td class="column75 style8 s style8" colspan="11">ИТОГ 1 - 4 класс</td>
                    <td class="column86 style3 s style3" colspan="6" rowspan="2">Ученическая мебель</td>
                    <td class="column92 style4 s style4" colspan="5" rowspan="2">Искусственная освещенность</td>
                    <td class="column97 style5 s style5" colspan="3" rowspan="2">Гимнастика для глаз</td>
                    <td class="column100 style4 s style4" colspan="2" rowspan="2">Гимнастика для глаз</td>
                    <td class="column102 style5 s style5" colspan="9">Использование электронных средств обучения и
                        средств мобильной связи
                    </td>
                    <td class="column111 style15 s style15" rowspan="3">Общий риск</td>
                    <td class="column30 style14 s style14" rowspan="3">Общий риск коэффециент</td>
                    <td class="column112 style6 s style6" colspan="11">5 класс</td>
                    <td class="column123 style7 s style7" colspan="11">6 класс</td>
                    <td class="column134 style6 s style6" colspan="11">7 класс</td>
                    <td class="column145 style7 s style7" colspan="11">8 класс</td>
                    <td class="column156 style7 s style7" colspan="11">9 класс</td>
                    <td class="column167 style8 s style8" colspan="11">ИТОГ 5 - 9 класс</td>
                    <td class="column178 style3 s style3" colspan="6" rowspan="2">Ученическая мебель</td>
                    <td class="column184 style4 s style4" colspan="5" rowspan="2">Искусственная освещенность</td>
                    <td class="column189 style5 s style5" colspan="3" rowspan="2">Гимнастика для глаз</td>
                    <td class="column192 style4 s style4" colspan="2" rowspan="2">Гимнастика для глаз</td>
                    <td class="column194 style5 s style5" colspan="9">Использование электронных средств обучения и
                        средств мобильной связи
                    </td>
                    <td class="column203 style15 s style15" rowspan="3">Общий риск</td>
                    <td class="column30 style14 s style14" rowspan="3">Общий риск коэффециент</td>
                    <td class="column204 style6 s style6" colspan="11">10 класс</td>
                    <td class="column215 style7 s style7" colspan="11">11 класс</td>
                    <td class="column226 style8 s style8" colspan="11">ИТОГ 10 - 11 класс</td>
                </tr>
                <tr class="row2">
                    <td class="column21 style5 null style5" colspan="3"></td>
                    <td class="column24 style9 s style9" colspan="6">х5.4. конструктивные особенности используемых ЭСО
                        на уроках, в том числе недостаточный размер диагонали (1-4):
                    </td>
                    <td class="column31 style10 s style10" rowspan="2">Всего детей</td>
                    <td class="column32 style10 s style10" colspan="3">Из них, с нарушениями</td>
                    <td class="column35 style10 s style10" rowspan="2">N</td>
                    <td class="column36 style10 s style10" rowspan="2">G1</td>
                    <td class="column37 style10 s style10" rowspan="2">коэффициент</td>
                    <td class="column38 style10 s style10" rowspan="2">G2</td>
                    <td class="column39 style10 s style10" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column40 style10 s style10" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column41 style10 s style10" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                    <td class="column42 style3 s style3" rowspan="2">Всего детей</td>
                    <td class="column43 style3 s style3" colspan="3">Из них, с нарушениями</td>
                    <td class="column46 style3 s style3" rowspan="2">N</td>
                    <td class="column47 style3 s style3" rowspan="2">G1</td>
                    <td class="column48 style3 s style3" rowspan="2">коэффициент</td>
                    <td class="column49 style3 s style3" rowspan="2">G2</td>
                    <td class="column50 style3 s style3" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column51 style3 s style3" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column52 style3 s style3" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                    <td class="column53 style10 s style10" rowspan="2">Всего детей</td>
                    <td class="column54 style10 s style10" colspan="3">Из них, с нарушениями</td>
                    <td class="column57 style10 s style10" rowspan="2">N</td>
                    <td class="column58 style10 s style10" rowspan="2">G1</td>
                    <td class="column59 style10 s style10" rowspan="2">коэффициент</td>
                    <td class="column60 style10 s style10" rowspan="2">G2</td>
                    <td class="column61 style10 s style10" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column62 style10 s style10" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column63 style10 s style10" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                    <td class="column64 style3 s style3" rowspan="2">Всего детей</td>
                    <td class="column65 style3 s style3" colspan="3">Из них, с нарушениями</td>
                    <td class="column68 style3 s style3" rowspan="2">N</td>
                    <td class="column69 style3 s style3" rowspan="2">G1</td>
                    <td class="column70 style3 s style3" rowspan="2">коэффициент</td>
                    <td class="column71 style3 s style3" rowspan="2">G2</td>
                    <td class="column72 style3 s style3" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column73 style3 s style3" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column74 style3 s style3" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                    <td class="column75 style11 s style11" rowspan="2">Всего детей</td>
                    <td class="column76 style11 s style11" colspan="3">Из них, с нарушениями</td>
                    <td class="column79 style11 s style11" rowspan="2">N</td>
                    <td class="column80 style11 s style11" rowspan="2">G1</td>
                    <td class="column81 style11 s style11" rowspan="2">коэффициент</td>
                    <td class="column82 style11 s style11" rowspan="2">G2</td>
                    <td class="column83 style11 s style11" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column84 style11 s style11" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column85 style11 s style11" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                    <td class="column102 style5 null style5" colspan="3"></td>
                    <td class="column105 style9 s style9" colspan="6">х5.4. конструктивные особенности используемых ЭСО
                        на уроках, в том числе недостаточный размер диагонали (1-4):
                    </td>
                    <td class="column112 style10 s style10" rowspan="2">Всего детей</td>
                    <td class="column113 style10 s style10" colspan="3">Из них, с нарушениями</td>
                    <td class="column116 style10 s style10" rowspan="2">N</td>
                    <td class="column117 style10 s style10" rowspan="2">G1</td>
                    <td class="column118 style10 s style10" rowspan="2">коэффициент</td>
                    <td class="column119 style10 s style10" rowspan="2">G2</td>
                    <td class="column120 style10 s style10" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column121 style10 s style10" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column122 style10 s style10" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                    <td class="column123 style3 s style3" rowspan="2">Всего детей</td>
                    <td class="column124 style3 s style3" colspan="3">Из них, с нарушениями</td>
                    <td class="column127 style3 s style3" rowspan="2">N</td>
                    <td class="column128 style3 s style3" rowspan="2">G1</td>
                    <td class="column129 style3 s style3" rowspan="2">коэффициент</td>
                    <td class="column130 style3 s style3" rowspan="2">G2</td>
                    <td class="column131 style3 s style3" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column132 style3 s style3" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column133 style3 s style3" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                    <td class="column134 style10 s style10" rowspan="2">Всего детей</td>
                    <td class="column135 style10 s style10" colspan="3">Из них, с нарушениями</td>
                    <td class="column138 style10 s style10" rowspan="2">N</td>
                    <td class="column139 style10 s style10" rowspan="2">G1</td>
                    <td class="column140 style10 s style10" rowspan="2">коэффициент</td>
                    <td class="column141 style10 s style10" rowspan="2">G2</td>
                    <td class="column142 style10 s style10" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column143 style10 s style10" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column144 style10 s style10" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                    <td class="column145 style3 s style3" rowspan="2">Всего детей</td>
                    <td class="column146 style3 s style3" colspan="3">Из них, с нарушениями</td>
                    <td class="column149 style3 s style3" rowspan="2">N</td>
                    <td class="column150 style3 s style3" rowspan="2">G1</td>
                    <td class="column151 style3 s style3" rowspan="2">коэффициент</td>
                    <td class="column152 style3 s style3" rowspan="2">G2</td>
                    <td class="column153 style3 s style3" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column154 style3 s style3" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column155 style3 s style3" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                    <td class="column156 style3 s style3" rowspan="2">Всего детей</td>
                    <td class="column157 style3 s style3" colspan="3">Из них, с нарушениями</td>
                    <td class="column160 style3 s style3" rowspan="2">N</td>
                    <td class="column161 style3 s style3" rowspan="2">G1</td>
                    <td class="column162 style3 s style3" rowspan="2">коэффициент</td>
                    <td class="column163 style3 s style3" rowspan="2">G2</td>
                    <td class="column164 style3 s style3" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column165 style3 s style3" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column166 style3 s style3" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                    <td class="column167 style11 s style11" rowspan="2">Всего детей</td>
                    <td class="column168 style11 s style11" colspan="3">Из них, с нарушениями</td>
                    <td class="column171 style11 s style11" rowspan="2">N</td>
                    <td class="column172 style11 s style11" rowspan="2">G1</td>
                    <td class="column173 style11 s style11" rowspan="2">коэффициент</td>
                    <td class="column174 style11 s style11" rowspan="2">G2</td>
                    <td class="column175 style11 s style11" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column176 style11 s style11" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column177 style11 s style11" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                    <td class="column194 style5 null style5" colspan="3"></td>
                    <td class="column197 style9 s style9" colspan="6">х5.4. конструктивные особенности используемых ЭСО
                        на уроках, в том числе недостаточный размер диагонали (1-4):
                    </td>
                    <td class="column204 style10 s style10" rowspan="2">Всего детей</td>
                    <td class="column205 style10 s style10" colspan="3">Из них, с нарушениями</td>
                    <td class="column208 style10 s style10" rowspan="2">N</td>
                    <td class="column209 style10 s style10" rowspan="2">G1</td>
                    <td class="column210 style10 s style10" rowspan="2">коэффициент</td>
                    <td class="column211 style10 s style10" rowspan="2">G2</td>
                    <td class="column212 style10 s style10" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column213 style10 s style10" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column214 style10 s style10" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                    <td class="column215 style3 s style3" rowspan="2">Всего детей</td>
                    <td class="column216 style3 s style3" colspan="3">Из них, с нарушениями</td>
                    <td class="column219 style3 s style3" rowspan="2">N</td>
                    <td class="column220 style3 s style3" rowspan="2">G1</td>
                    <td class="column221 style3 s style3" rowspan="2">коэффициент</td>
                    <td class="column222 style3 s style3" rowspan="2">G2</td>
                    <td class="column223 style3 s style3" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column224 style3 s style3" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column225 style3 s style3" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                    <td class="column226 style11 s style11" rowspan="2">Всего детей</td>
                    <td class="column227 style11 s style11" colspan="3">Из них, с нарушениями</td>
                    <td class="column230 style11 s style11" rowspan="2">N</td>
                    <td class="column231 style11 s style11" rowspan="2">G1</td>
                    <td class="column232 style11 s style11" rowspan="2">коэффициент</td>
                    <td class="column233 style11 s style11" rowspan="2">G2</td>
                    <td class="column234 style11 s style11" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> общий</span>
                    </td>
                    <td class="column235 style11 s style11" rowspan="2">R<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> k</span>
                    </td>
                    <td class="column236 style11 s style11" rowspan="2">P<span
                                style="font-weight:bold; color:#212529; font-family:'Times New Roman'; font-size:6pt"> i</span>
                    </td>
                </tr>
                <tr class="row3">
                    <td class="column5 style16 s">х1.1. не промаркированная мебель</td>
                    <td class="column6 style17 s">х1.2. не стандартная мебель</td>
                    <td class="column7 style17 s">х1.3. не комплектная мебель</td>
                    <td class="column8 style17 s">х1.4. не ведется листок здоровья либо ведется не в полном объёме</td>
                    <td class="column9 style17 s">х1.5. дети не рассаживаются с учетом роста</td>
                    <td class="column10 style17 s">Итог по фактору</td>
                    <td class="column11 style17 s">х2.1. отсутствие производственного контроля за уровнем освещенности в
                        учебных классах и кабинетах
                    </td>
                    <td class="column12 style17 s">х2.2. нарушения санитарного законодательства, выявленные в ходе
                        контрольно-надзорных мероприятий, а также в ходе профилактических визитов течение прошлого
                        учебного года
                    </td>
                    <td class="column13 style17 s">х2.3. наличие в отдельных учебных классах и кабинетах перегоревших
                        ламп
                    </td>
                    <td class="column14 style17 s">х2.4. наличие учебных классов и кабинетов, в которых не установлены
                        светорассеивающие светильники
                    </td>
                    <td class="column15 style17 s">Итог по фактору</td>
                    <td class="column16 style16 s">х3.1. отсутствие проведения гимнастики для глаз вовремя перемен</td>
                    <td class="column17 style17 s">х3.2. отсутствие проведения гимнастики для глаз во время уроков с
                        использованием электронных средств обучения
                    </td>
                    <td class="column18 style17 s">Итог по фактору</td>
                    <td class="column19 style17 s">х4.1. отсутствие проведения гимнастики для мышц спины и шеи вовремя
                        перемен
                    </td>
                    <td class="column20 style17 s">Итог по фактору</td>
                    <td class="column21 style17 s">х5.1. превышение регламентированного СанПиН значения
                        продолжительности использования ЭСО во время уроков
                    </td>
                    <td class="column22 style17 s">х5.2. превышение регламентированного СанПиН значения
                        продолжительности использования ЭСО в общеобразовательной организации за учебный день
                    </td>
                    <td class="column23 style17 s">х5.3. отсутствие локального акта о запрете использования обучающимися
                        во время перемен устройств мобильной связи (сотовых телефонов)
                    </td>
                    <td class="column24 style16 s">х5.4.1. интерактивной доски</td>
                    <td class="column25 style17 s">х5.4.2. монитора компьютера</td>
                    <td class="column26 style17 s">х5.4.3. планшета</td>
                    <td class="column27 style17 s">х5.4.4. ноутбука</td>
                    <td class="column28 style17 s">х5.4.5. отсутствие второй клавиатуры у ноутбука</td>
                    <td class="column29 style17 s">Итог по фактору</td>
                    <td class="column32 style18 s">осанки и зрения</td>
                    <td class="column33 style18 s">осанки</td>
                    <td class="column34 style18 s">зрения</td>
                    <td class="column43 style17 s">осанки и зрения</td>
                    <td class="column44 style17 s">осанки</td>
                    <td class="column45 style17 s">зрения</td>
                    <td class="column54 style18 s">осанки и зрения</td>
                    <td class="column55 style18 s">осанки</td>
                    <td class="column56 style18 s">зрения</td>
                    <td class="column65 style17 s">осанки и зрения</td>
                    <td class="column66 style17 s">осанки</td>
                    <td class="column67 style17 s">зрения</td>
                    <td class="column76 style19 s">осанки и зрения</td>
                    <td class="column77 style19 s">осанки</td>
                    <td class="column78 style19 s">зрения</td>
                    <td class="column86 style16 s">х1.1. не промаркированная мебель</td>
                    <td class="column87 style17 s">х1.2. не стандартная мебель</td>
                    <td class="column88 style17 s">х1.3. не комплектная мебель</td>
                    <td class="column89 style17 s">х1.4. не ведется листок здоровья либо ведется не в полном объёме</td>
                    <td class="column90 style17 s">х1.5. дети не рассаживаются с учетом роста</td>
                    <td class="column91 style17 s">Итог по фактору</td>
                    <td class="column92 style17 s">х2.1. отсутствие производственного контроля за уровнем освещенности в
                        учебных классах и кабинетах
                    </td>
                    <td class="column93 style17 s">х2.2. нарушения санитарного законодательства, выявленные в ходе
                        контрольно-надзорных мероприятий, а также в ходе профилактических визитов течение прошлого
                        учебного года
                    </td>
                    <td class="column94 style17 s">х2.3. наличие в отдельных учебных классах и кабинетах перегоревших
                        ламп
                    </td>
                    <td class="column95 style17 s">х2.4. наличие учебных классов и кабинетов, в которых не установлены
                        светорассеивающие светильники
                    </td>
                    <td class="column96 style17 s">Итог по фактору</td>
                    <td class="column97 style16 s">х3.1. отсутствие проведения гимнастики для глаз вовремя перемен</td>
                    <td class="column98 style17 s">х3.2. отсутствие проведения гимнастики для глаз во время уроков с
                        использованием электронных средств обучения
                    </td>
                    <td class="column99 style17 s">Итог по фактору</td>
                    <td class="column100 style17 s">х4.1. отсутствие проведения гимнастики для мышц спины и шеи вовремя
                        перемен
                    </td>
                    <td class="column101 style17 s">Итог по фактору</td>
                    <td class="column102 style17 s">х5.1. превышение регламентированного СанПиН значения
                        продолжительности использования ЭСО во время уроков
                    </td>
                    <td class="column103 style17 s">х5.2. превышение регламентированного СанПиН значения
                        продолжительности использования ЭСО в общеобразовательной организации за учебный день
                    </td>
                    <td class="column104 style17 s">х5.3. отсутствие локального акта о запрете использования
                        обучающимися во время перемен устройств мобильной связи (сотовых телефонов)
                    </td>
                    <td class="column105 style16 s">х5.4.1. интерактивной доски</td>
                    <td class="column106 style17 s">х5.4.2. монитора компьютера</td>
                    <td class="column107 style17 s">х5.4.3. планшета</td>
                    <td class="column108 style17 s">х5.4.4. ноутбука</td>
                    <td class="column109 style17 s">х5.4.5. отсутствие второй клавиатуры у ноутбука</td>
                    <td class="column110 style17 s">Итог по фактору</td>
                    <td class="column113 style18 s">осанки и зрения</td>
                    <td class="column114 style18 s">осанки</td>
                    <td class="column115 style18 s">зрения</td>
                    <td class="column124 style17 s">осанки и зрения</td>
                    <td class="column125 style17 s">осанки</td>
                    <td class="column126 style17 s">зрения</td>
                    <td class="column135 style18 s">осанки и зрения</td>
                    <td class="column136 style18 s">осанки</td>
                    <td class="column137 style18 s">зрения</td>
                    <td class="column146 style17 s">осанки и зрения</td>
                    <td class="column147 style17 s">осанки</td>
                    <td class="column148 style17 s">зрения</td>
                    <td class="column157 style17 s">осанки и зрения</td>
                    <td class="column158 style17 s">осанки</td>
                    <td class="column159 style17 s">зрения</td>
                    <td class="column168 style19 s">осанки и зрения</td>
                    <td class="column169 style19 s">осанки</td>
                    <td class="column170 style19 s">зрения</td>
                    <td class="column178 style16 s">х1.1. не промаркированная мебель</td>
                    <td class="column179 style17 s">х1.2. не стандартная мебель</td>
                    <td class="column180 style17 s">х1.3. не комплектная мебель</td>
                    <td class="column181 style17 s">х1.4. не ведется листок здоровья либо ведется не в полном объёме
                    </td>
                    <td class="column182 style17 s">х1.5. дети не рассаживаются с учетом роста</td>
                    <td class="column183 style17 s">Итог по фактору</td>
                    <td class="column184 style17 s">х2.1. отсутствие производственного контроля за уровнем освещенности
                        в учебных классах и кабинетах
                    </td>
                    <td class="column185 style17 s">х2.2. нарушения санитарного законодательства, выявленные в ходе
                        контрольно-надзорных мероприятий, а также в ходе профилактических визитов течение прошлого
                        учебного года
                    </td>
                    <td class="column186 style17 s">х2.3. наличие в отдельных учебных классах и кабинетах перегоревших
                        ламп
                    </td>
                    <td class="column187 style17 s">х2.4. наличие учебных классов и кабинетов, в которых не установлены
                        светорассеивающие светильники
                    </td>
                    <td class="column188 style17 s">Итог по фактору</td>
                    <td class="column189 style16 s">х3.1. отсутствие проведения гимнастики для глаз вовремя перемен</td>
                    <td class="column190 style17 s">х3.2. отсутствие проведения гимнастики для глаз во время уроков с
                        использованием электронных средств обучения
                    </td>
                    <td class="column191 style17 s">Итог по фактору</td>
                    <td class="column192 style17 s">х4.1. отсутствие проведения гимнастики для мышц спины и шеи вовремя
                        перемен
                    </td>
                    <td class="column193 style17 s">Итог по фактору</td>
                    <td class="column194 style17 s">х5.1. превышение регламентированного СанПиН значения
                        продолжительности использования ЭСО во время уроков
                    </td>
                    <td class="column195 style17 s">х5.2. превышение регламентированного СанПиН значения
                        продолжительности использования ЭСО в общеобразовательной организации за учебный день
                    </td>
                    <td class="column196 style17 s">х5.3. отсутствие локального акта о запрете использования
                        обучающимися во время перемен устройств мобильной связи (сотовых телефонов)
                    </td>
                    <td class="column197 style16 s">х5.4.1. интерактивной доски</td>
                    <td class="column198 style17 s">х5.4.2. монитора компьютера</td>
                    <td class="column199 style17 s">х5.4.3. планшета</td>
                    <td class="column200 style17 s">х5.4.4. ноутбука</td>
                    <td class="column201 style17 s">х5.4.5. отсутствие второй клавиатуры у ноутбука</td>
                    <td class="column202 style17 s">Итог по фактору</td>
                    <td class="column205 style18 s">осанки и зрения</td>
                    <td class="column206 style18 s">осанки</td>
                    <td class="column207 style18 s">зрения</td>
                    <td class="column216 style17 s">осанки и зрения</td>
                    <td class="column217 style17 s">осанки</td>
                    <td class="column218 style17 s">зрения</td>
                    <td class="column227 style19 s">осанки и зрения</td>
                    <td class="column228 style19 s">осанки</td>
                    <td class="column229 style19 s">зрения</td>
                </tr>
                </thead>
                <tbody>
                <?
                if ($result['result'] != []) {
                    $firstKey = array_key_first($result['result']);
                    $region = $result['result'][$firstKey]['region_id'];
                    $okrug = $result['result'][$firstKey]['federal_district_id'];
                    $countStr = 1;
                    foreach ($result['result'] as $key => $row) { ?>
                        <? if ($region !== $row['region_id']) { ?>
                            <tr>
                                <th colspan="2"><?= Yii::$app->myComponent->get_federal_name($okrug)  ?> </th>
                                <th colspan="4"><?= Yii::$app->myComponent->get_region_name($region) ?> </th>
                                <?= $model->printCollectiveRiskItog($result['region'][$region]);?>
                            </tr>
                        <?} ?>
                        <? if ($okrug !== $row['federal_district_id']) { ?>
                            <tr>
                                <th colspan="6"><?= Yii::$app->myComponent->get_federal_name($okrug) ?></th>
                               <?= $model->printCollectiveRiskItog($result['okrug'][$okrug]);?>
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
                            <td><?= $row['name_responsible_person'] ?></td>
                            <td><?= $row['create_at'] ?></td>
                            <?= $model->printCollectiveRisk($row);?>
                        </tr>
                        <?

                        //print_r('<pre>');
                        //print_r($row);
                        //print_r('<br><br><br>');
                        //print_r('<br><br><br>');
                        //print_r('<br><br><br>');
                        //print_r($resultList);
                        //print_r('</pre>');
                        //exit();

                        ?>
                        <?
                    } ?>
                    <tr>
                        <th colspan="2"><?= Yii::$app->myComponent->get_federal_name($okrug)  ?>/ <?=$okrug?></th>
                        <th colspan="4"><?= Yii::$app->myComponent->get_region_name($region) ?> / <?=$region?></th>
                        <?= $model->printCollectiveRiskItog($result['region'][$region]);?>
                    </tr>
                    <tr>
                        <th colspan="6"><?= Yii::$app->myComponent->get_federal_name($okrug) ?></th>
                        <?= $model->printCollectiveRiskItog($result['okrug'][$okrug]);?>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-center">ИТОГ</th>
                        <?= $model->printCollectiveRiskItog($result['itog']);?>
                    </tr>
                    <?
                } ?>
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

                    <? /* foreach ($arrfieldTheme1 as $key => $oneName) { */ ?>
                        <th><? /*= $oneName */ ?></th>
                    <? /* } */ ?>
                    <th>Общий риск:</th>
                    <th>Общий риск с поправочным коэфициентом:</th>
                </tr>
                </thead>
                <tbody>
                <? /*
                $i = 0;
                foreach ($RiskAssessmentOrganizationCommon as $key => $one) {
                    */ ?>
                    <tr>
                        <td><? /*= ++$i */ ?></td>

                        <td><? /*= $one['federal_district_id'] */ ?></td>
                        <td><? /*= $one['region_id'] */ ?></td>
                        <td><? /*= $one['municipality_id'] */ ?></td>
                        <td><? /*= $one['year'] */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->trainingClass($one['class']) */ ?></td>

                        <td><? /*= $one['risk_assessment_g'] */ ?></td>
                        <td><? /*= $one['risk_assessment'] */ ?></td>

                        <td><? /*= Yii::$app->riskComponent->fieldTheme1Decoding($one['fieldTheme1_1']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme1Decoding($one['fieldTheme1_2']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme1Decoding($one['fieldTheme1_3']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme1Decoding($one['fieldTheme1_4']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme1Decoding($one['fieldTheme1_5']) */ ?></td>
                        <td><? /*= $one['risk_assessment_1'] */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme2Decoding($one['fieldTheme2_1']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme2Decoding($one['fieldTheme2_2']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme2Decoding($one['fieldTheme2_3']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme2Decoding($one['fieldTheme2_4']) */ ?></td>
                        <td><? /*= $one['risk_assessment_2'] */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme3Decoding($one['fieldTheme3_1']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme3Decoding($one['fieldTheme3_2']) */ ?></td>
                        <td><? /*= $one['risk_assessment_3'] */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme4Decoding($one['fieldTheme4_1']) */ ?></td>
                        <td><? /*= $one['risk_assessment_4'] */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme5Decoding($one['fieldTheme5_1']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme5Decoding($one['fieldTheme5_2']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme5Decoding($one['fieldTheme5_3']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme6Decoding($one['fieldTheme5_4_1']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme6Decoding($one['fieldTheme5_4_2']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme6Decoding($one['fieldTheme5_4_3']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme6Decoding($one['fieldTheme5_4_4']) */ ?></td>
                        <td><? /*= Yii::$app->riskComponent->fieldTheme6Decoding($one['fieldTheme5_4_5']) */ ?></td>
                        <td><? /*= $one['risk_assessment_5'] */ ?></td>

                        <td><? /*= $one['risk_assessment_g'] */ ?></td>
                        <td><? /*= $one['risk_assessment'] */ ?></td>
                    </tr>
                <? /* } */ ?>
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