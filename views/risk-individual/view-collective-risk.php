<?php

use common\models\DetiAnket;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Выгрузка данных по анкетам для родителей и детей по групировке (Анкета №3) за 23 год';

$itogArr = [];
$grouping_items = [
    '1' => 'по ФО',
    '2' => 'по Региону',
    '3' => 'по Школе',
];

?>

<style>
    .blockView {
        -webkit-box-shadow: 0px 5px 21px -4px rgba(7, 49, 81, 0.2);
        -moz-box-shadow: 0px 5px 21px -4px rgba(7, 49, 81, 0.2);
        box-shadow: 0px 5px 21px -4px rgba(7, 49, 81, 0.2);
        border-radius: 15px;
    }
</style>

<div class="container p-2">

    <div class="blockView  p-3">
        <?= Html::a(
            'Вернуться назад',
            ['view-common-risk?key=' . $key],
            [
                'class' => 'btn btn-sm btn-outline-danger mb-1',
            ]
        ); ?>
        <h4 class="text-center">МР «Оценка коллективных и индивидуальных рисков нарушений осанки и зрения у обучающихся общеобразовательных организаций»</h4>
        <h5 class="text-center">«Данные по коллективной оценке уровня тревожности и агрессии у обучающихся общеобразовательных организаций, профилактике нарушений психического здоровья»
            (для педагогов и родителей)</h5>
        <br>
        <input type="button" class="btn btn-warning btn-block table2excel mb-3 mt-3"
               title="Вы можете скачать в формате Excel" value="Скачать в Excel" id="pechat222">
        <br>
        <div class="table-responsive">
            <table cellspacing="0" border="0" id="tableId2" class=" table2excel_with_colors">
                <?
                foreach ($resultChild as $keyClass => $oneClass) {?>

                    <colgroup span="11" width="64"></colgroup>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=7 height="20" align="center" valign=bottom bgcolor="#92D050"><font color="#000000"><?=$keyClass?></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=7 height="20" align="center" valign=bottom bgcolor="#DEEBF7"><font color="#000000">1.
                                Спилбергер и Ханин</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=7 height="20" align="center" valign=bottom bgcolor="#DEEBF7"><font color="#000000">1.1.
                                реактичная тревожность</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=3 height="60" align="center" valign=bottom><font color="#000000">РТ_общая оценка</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Количество человек</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Колективная оценка</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">низкая тревожность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">умеренная тревожность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">высокая тревожность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 30</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">31-45</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">46 и более</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 30</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">31-45</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">46 и более</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="20" align="left" valign=bottom><font color="#000000"> <div class="text-center"><b><?= round($oneClass['vse']['rt']['rt'] / $oneClass['vse']['count'], 2) ?></b></div></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['rt']['adff2f']['count']) ? '<div class="text-center"><b>'. $oneClass['rt']['adff2f']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['rt']['ffeb33']['count']) ? '<div class="text-center"><b>'. $oneClass['rt']['ffeb33']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['rt']['fa3737']['count']) ? '<div class="text-center"><b>'. $oneClass['rt']['fa3737']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['rt']['adff2f']['count']) ? '<div class="text-center"><b>'. round( $oneClass['rt']['adff2f']['estimation']/ $oneClass['rt']['adff2f']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['rt']['ffeb33']['count']) ? '<div class="text-center"><b>'. round( $oneClass['rt']['ffeb33']['estimation']/ $oneClass['rt']['ffeb33']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['rt']['fa3737']['count']) ? '<div class="text-center"><b>'. round( $oneClass['rt']['fa3737']['estimation']/ $oneClass['rt']['fa3737']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>

                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=7 height="20" align="center" valign=bottom bgcolor="#DEEBF7"><font color="#000000">1.2.
                                личностная тревожность</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=3 height="60" align="center" valign=bottom><font color="#000000">ЛТ_общая оценка</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Количество человек</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Колективная оценка</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">низкая тревожность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">умеренная тревожность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">высокая тревожность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 30</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">31-45</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">46 и более</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 30</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">31-45</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">46 и более</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="20" align="left" valign=bottom><font color="#000000"> <div class="text-center"><b><?= round($oneClass['vse']['lt']['lt'] / $oneClass['vse']['count'], 2) ?></b></div></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['lt']['adff2f']['count']) ? '<div class="text-center"><b>'. $oneClass['lt']['adff2f']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['lt']['ffeb33']['count']) ? '<div class="text-center"><b>'. $oneClass['lt']['ffeb33']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['lt']['fa3737']['count']) ? '<div class="text-center"><b>'. $oneClass['lt']['fa3737']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['lt']['adff2f']['count']) ? '<div class="text-center"><b>'. round( $oneClass['lt']['adff2f']['estimation']/ $oneClass['lt']['adff2f']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['lt']['ffeb33']['count']) ? '<div class="text-center"><b>'. round( $oneClass['lt']['ffeb33']['estimation']/ $oneClass['lt']['ffeb33']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['lt']['fa3737']['count']) ? '<div class="text-center"><b>'. round( $oneClass['lt']['fa3737']['estimation']/ $oneClass['lt']['fa3737']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>

                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=7 height="20" align="center" valign=bottom bgcolor="#DEEBF7"><font color="#000000">2.
                                Симптомы беспокойства и нервозности</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=3 height="60" align="center" valign=bottom><font color="#000000">Оценка</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Количество человек</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Колективная оценка</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 28,6</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">28,6 - 71,44</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">71,45 - 100</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 28,6</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">28,6 - 71,44</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">71,45 - 100</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>

                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="20" align="left" valign=bottom><font color="#000000"> <div class="text-center"><b><?= round($oneClass['vse']['one']['estimation_one'] / $oneClass['vse']['count'], 2) ?></b></div></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['one']['adff2f']['count']) ? '<div class="text-center"><b>'. $oneClass['one']['adff2f']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['one']['ffeb33']['count']) ? '<div class="text-center"><b>'. $oneClass['one']['ffeb33']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['one']['fa3737']['count']) ? '<div class="text-center"><b>'. $oneClass['one']['fa3737']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['one']['adff2f']['count']) ? '<div class="text-center"><b>'. round( $oneClass['one']['adff2f']['estimation']/ $oneClass['one']['adff2f']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['one']['ffeb33']['count']) ? '<div class="text-center"><b>'. round( $oneClass['one']['ffeb33']['estimation']/ $oneClass['one']['ffeb33']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['one']['fa3737']['count']) ? '<div class="text-center"><b>'. round( $oneClass['one']['fa3737']['estimation']/ $oneClass['one']['fa3737']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>

                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=7 height="20" align="center" valign=bottom bgcolor="#DEEBF7"><font color="#000000">3.
                                Индикация причин тревожности</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=3 height="60" align="center" valign=bottom><font color="#000000">Оценка</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Количество человек</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Колективная оценка</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 28,6</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">28,6 - 71,44</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">71,45 - 100</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 28,6</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">28,6 - 71,44</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">71,45 - 100</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>

                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="20" align="left" valign=bottom><font color="#000000"> <div class="text-center"><b><?= round($oneClass['vse']['two']['estimation_two'] / $oneClass['vse']['count'], 2) ?></b></div></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['two']['adff2f']['count']) ? '<div class="text-center"><b>'. $oneClass['two']['adff2f']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['two']['ffeb33']['count']) ? '<div class="text-center"><b>'. $oneClass['two']['ffeb33']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['two']['fa3737']['count']) ? '<div class="text-center"><b>'. $oneClass['two']['fa3737']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['two']['adff2f']['count']) ? '<div class="text-center"><b>'. round( $oneClass['two']['adff2f']['estimation']/ $oneClass['two']['adff2f']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['two']['ffeb33']['count']) ? '<div class="text-center"><b>'. round( $oneClass['two']['ffeb33']['estimation']/ $oneClass['two']['ffeb33']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['two']['fa3737']['count']) ? '<div class="text-center"><b>'. round( $oneClass['two']['fa3737']['estimation']/ $oneClass['two']['fa3737']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>

                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=7 height="20" align="center" valign=bottom bgcolor="#DEEBF7"><font color="#000000">4. Меры
                                профилактики, реализуемые в отношении ребенка со стороны УЧИТЕЛЕЙ</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=3 height="60" align="center" valign=bottom><font color="#000000">Оценка</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Количество человек</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Колективная оценка</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 14,28</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">14,29 - 35,72</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">35,73 - 50</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 14,28</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">14,29 - 35,72</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">35,73 - 50</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>

                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="20" align="left" valign=bottom><font color="#000000"> <div class="text-center"><b><?= round($oneClass['vse']['three']['estimation_three'] / $oneClass['vse']['count'], 2) ?></b></div></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['three']['adff2f']['count']) ? '<div class="text-center"><b>'. $oneClass['three']['adff2f']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['three']['ffeb33']['count']) ? '<div class="text-center"><b>'. $oneClass['three']['ffeb33']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['three']['fa3737']['count']) ? '<div class="text-center"><b>'. $oneClass['three']['fa3737']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['three']['adff2f']['count']) ? '<div class="text-center"><b>'. round( $oneClass['three']['adff2f']['estimation']/ $oneClass['three']['adff2f']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['three']['ffeb33']['count']) ? '<div class="text-center"><b>'. round( $oneClass['three']['ffeb33']['estimation']/ $oneClass['three']['ffeb33']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['three']['fa3737']['count']) ? '<div class="text-center"><b>'. round( $oneClass['three']['fa3737']['estimation']/ $oneClass['three']['fa3737']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>

                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=7 height="20" align="center" valign=bottom bgcolor="#DEEBF7"><font color="#000000">5. Меры
                                профилактики, реализуемые в отношении ребенка со стороны РОДИТЕЛЕЙ</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=3 height="60" align="center" valign=bottom><font color="#000000">Оценка</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Количество человек</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Колективная оценка</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 14,28</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">14,29 - 35,72</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">35,73 - 50</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 14,28</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">14,29 - 35,72</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">35,73 - 50</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="20" align="left" valign=bottom><font color="#000000"> <div class="text-center"><b><?= round($oneClass['vse']['four']['estimation_four'] / $oneClass['vse']['count'], 2) ?></b></div></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['four']['adff2f']['count']) ? '<div class="text-center"><b>'. $oneClass['four']['adff2f']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['four']['ffeb33']['count']) ? '<div class="text-center"><b>'. $oneClass['four']['ffeb33']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['four']['fa3737']['count']) ? '<div class="text-center"><b>'. $oneClass['four']['fa3737']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['four']['adff2f']['count']) ? '<div class="text-center"><b>'. round( $oneClass['four']['adff2f']['estimation']/ $oneClass['four']['adff2f']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['four']['ffeb33']['count']) ? '<div class="text-center"><b>'. round( $oneClass['four']['ffeb33']['estimation']/ $oneClass['four']['ffeb33']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['four']['fa3737']['count']) ? '<div class="text-center"><b>'. round( $oneClass['four']['fa3737']['estimation']/ $oneClass['four']['fa3737']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>

                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=7 height="20" align="center" valign=bottom bgcolor="#DEEBF7"><font color="#000000">6. Формы
                                проявления агрессии у ребенка</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=3 height="60" align="center" valign=bottom><font color="#000000">Оценка</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Количество человек</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Колективная оценка</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 14,28</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">14,29 - 35,72</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">35,73 - 50</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 14,28</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">14,29 - 35,72</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">35,73 - 50</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="20" align="left" valign=bottom><font color="#000000"> <div class="text-center"><b><?= round($oneClass['vse']['five']['estimation_five'] / $oneClass['vse']['count'], 2) ?></b></div></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['five']['adff2f']['count']) ? '<div class="text-center"><b>'. $oneClass['five']['adff2f']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['five']['ffeb33']['count']) ? '<div class="text-center"><b>'. $oneClass['five']['ffeb33']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['five']['fa3737']['count']) ? '<div class="text-center"><b>'. $oneClass['five']['fa3737']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['five']['adff2f']['count']) ? '<div class="text-center"><b>'. round( $oneClass['five']['adff2f']['estimation']/ $oneClass['five']['adff2f']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['five']['ffeb33']['count']) ? '<div class="text-center"><b>'. round( $oneClass['five']['ffeb33']['estimation']/ $oneClass['five']['ffeb33']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['five']['fa3737']['count']) ? '<div class="text-center"><b>'. round( $oneClass['five']['fa3737']['estimation']/ $oneClass['five']['fa3737']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>

                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=7 height="20" align="center" valign=bottom bgcolor="#DEEBF7"><font color="#000000">7.
                                Индикация возможных причин агрессии</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=3 height="60" align="center" valign=bottom><font color="#000000">Оценка</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Количество человек</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Колективная оценка</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">зеленая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">желтая зона</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">красная зона</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 28,6</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">28,6 - 71,44</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">71,45 - 100</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">до 28,6</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">28,6 - 71,44</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">71,45 - 100</font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="20" align="left" valign=bottom><font color="#000000"> <div class="text-center"><b><?= round($oneClass['vse']['six']['estimation_six'] / $oneClass['vse']['count'], 2) ?></b></div></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['six']['adff2f']['count']) ? '<div class="text-center"><b>'. $oneClass['six']['adff2f']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['six']['ffeb33']['count']) ? '<div class="text-center"><b>'. $oneClass['six']['ffeb33']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['six']['fa3737']['count']) ? '<div class="text-center"><b>'. $oneClass['six']['fa3737']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['six']['adff2f']['count']) ? '<div class="text-center"><b>'. round( $oneClass['six']['adff2f']['estimation']/ $oneClass['six']['adff2f']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['six']['ffeb33']['count']) ? '<div class="text-center"><b>'. round( $oneClass['six']['ffeb33']['estimation']/ $oneClass['six']['ffeb33']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['six']['fa3737']['count']) ? '<div class="text-center"><b>'. round( $oneClass['six']['fa3737']['estimation']/ $oneClass['six']['fa3737']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>

                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=11 height="20" align="center" valign=bottom bgcolor="#DEEBF7"><font color="#000000">8.
                                Опросник агрессивности Басса-Дарки</font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=11 height="20" align="center" valign=bottom bgcolor="#DEEBF7"><font color="#000000">8.1.
                                средний индекс враждебности класса</font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=3 height="60" align="center" valign=bottom><font color="#000000">Индекс враждебности
                                класса</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=5 align="center" valign=bottom><font color="#000000">Количество человек</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=5 align="center" valign=bottom><font color="#000000">Колективная оценка</font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">низкая враждебность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">умеренная враждебность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">повышенная враждебность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#F8CBAD"><font color="#000000">высокая враждебность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#F4B183"><font color="#000000">очень высокая враждебность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">низкая враждебность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">умеренная враждебность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">повышенная враждебность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#F8CBAD"><font color="#000000">высокая враждебность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#F4B183"><font color="#000000">очень высокая враждебность</font></td>
                    </tr>

                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">0 - 14</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">15 - 36</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">37 - 58</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">59 - 69</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">70 и более</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">0 - 14</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">15 - 36</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">37 - 58</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">59 - 69</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">70 и более</font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="20" align="left" valign=bottom><font color="#000000"> <div class="text-center"><b><?= round($oneClass['vse']['includes_index']['includes_index'] / $oneClass['vse']['count'], 2) ?></b></div></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['includes_index']['adff2f']['count']) ? '<div class="text-center"><b>'. $oneClass['includes_index']['adff2f']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['includes_index']['ffeb33']['count']) ? '<div class="text-center"><b>'. $oneClass['includes_index']['ffeb33']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['includes_index']['ffc30f']['count']) ? '<div class="text-center"><b>'. $oneClass['includes_index']['ffc30f']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['includes_index']['ff9900']['count']) ? '<div class="text-center"><b>'. $oneClass['includes_index']['ff9900']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['includes_index']['cc5500']['count']) ? '<div class="text-center"><b>'. $oneClass['includes_index']['cc5500']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>

                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['includes_index']['adff2f']['count']) ? '<div class="text-center"><b>'. round( $oneClass['includes_index']['adff2f']['estimation']/ $oneClass['includes_index']['adff2f']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['includes_index']['ffeb33']['count']) ? '<div class="text-center"><b>'. round( $oneClass['includes_index']['ffeb33']['estimation']/ $oneClass['includes_index']['ffeb33']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['includes_index']['ffc30f']['count']) ? '<div class="text-center"><b>'. round( $oneClass['includes_index']['ffc30f']['estimation']/ $oneClass['includes_index']['ffc30f']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['includes_index']['ff9900']['count']) ? '<div class="text-center"><b>'. round( $oneClass['includes_index']['ff9900']['estimation']/ $oneClass['includes_index']['ff9900']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['includes_index']['cc5500']['count']) ? '<div class="text-center"><b>'. round( $oneClass['includes_index']['cc5500']['estimation']/ $oneClass['includes_index']['cc5500']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=11 height="20" align="center" valign=bottom bgcolor="#DEEBF7"><font color="#000000">8.2.
                                средний индекс агрессивности класса</font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            rowspan=3 height="60" align="center" valign=bottom><font color="#000000">Индекс агрессивности
                                класса</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=3 align="center" valign=bottom><font color="#000000">Количество человек</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            colspan=5 align="center" valign=bottom><font color="#000000">Колективная оценка</font></td>
                    </tr>
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">низкая агрессивность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">умеренная агрессивность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">повышенная агрессивность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#F8CBAD"><font color="#000000">высокая агрессивность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#F4B183"><font color="#000000">очень высокая агрессивность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#E2F0D9"><font color="#000000">низкая агрессивность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FFF2CC"><font color="#000000">умеренная агрессивность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#FBE5D6"><font color="#000000">повышенная агрессивность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#F8CBAD"><font color="#000000">высокая агрессивность</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom bgcolor="#F4B183"><font color="#000000">очень высокая агрессивность</font></td>
                    </tr>

                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">0 - 27</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">28 - 49</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">50 - 71</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">72 - 82</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">более 82</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">0 - 27</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">28 - 49</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">50 - 71</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">72 - 82</font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000">более 82</font></td>
                    </tr>
                    <tr>

                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            height="20" align="left" valign=bottom><font color="#000000"> <div class="text-center"><b><?= round($oneClass['vse']['aggressiveness_index']['aggressiveness_index'] / $oneClass['vse']['count'], 2) ?></b></div></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['aggressiveness_index']['adff2f']['count']) ? '<div class="text-center"><b>'. $oneClass['aggressiveness_index']['adff2f']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['aggressiveness_index']['ffeb33']['count']) ? '<div class="text-center"><b>'. $oneClass['aggressiveness_index']['ffeb33']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['aggressiveness_index']['ffc30f']['count']) ? '<div class="text-center"><b>'. $oneClass['aggressiveness_index']['ffc30f']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['aggressiveness_index']['ff9900']['count']) ? '<div class="text-center"><b>'. $oneClass['aggressiveness_index']['ff9900']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['aggressiveness_index']['cc5500']['count']) ? '<div class="text-center"><b>'. $oneClass['aggressiveness_index']['cc5500']['count'] .'</b></div>'  :  '<div class="text-center"><b>0</b></div>' ?> </font></td>

                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['aggressiveness_index']['adff2f']['count']) ? '<div class="text-center"><b>'. round( $oneClass['aggressiveness_index']['adff2f']['estimation']/ $oneClass['aggressiveness_index']['adff2f']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['aggressiveness_index']['ffeb33']['count']) ? '<div class="text-center"><b>'. round( $oneClass['aggressiveness_index']['ffeb33']['estimation']/ $oneClass['aggressiveness_index']['ffeb33']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['aggressiveness_index']['ffc30f']['count']) ? '<div class="text-center"><b>'. round( $oneClass['aggressiveness_index']['ffc30f']['estimation']/ $oneClass['aggressiveness_index']['ffc30f']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['aggressiveness_index']['ff9900']['count']) ? '<div class="text-center"><b>'. round( $oneClass['aggressiveness_index']['ff9900']['estimation']/ $oneClass['aggressiveness_index']['ff9900']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                            align="left" valign=bottom><font color="#000000"><?= ($oneClass['aggressiveness_index']['cc5500']['count']) ? '<div class="text-center"><b>'. round( $oneClass['aggressiveness_index']['cc5500']['estimation']/ $oneClass['aggressiveness_index']['cc5500']['count'], 2) .'</b></div>'  :  '<div class="text-center"><b>0</b></div>'?></font></td>

                    </tr>

                <?}?>

            </table>
        </div>
    </div>
</div>

<?
$script = <<< JS
   
    /*const federalDistrict = document.getElementById('detianket-federal_district_idreport');
    const opt = document.createElement('option');
    opt.value = '0';
    opt.innerHTML = 'Все регионы';
    federalDistrict.appendChild(opt);*/
    
    $("#pechat222").click(function () {
    var table = $('#tableId2');
        if (table && table.length) {
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                exclude: ".noExl",
                name: "Excel Document Name",
                filename: "Данные по коллективной оценке уровня тревожности и агрессии.xls",
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
