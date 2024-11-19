<?php
$arrTheme1 = [
    'fieldTheme1_1',
    'fieldTheme1_2',
    'fieldTheme1_3',
    'fieldTheme1_4',
    'fieldTheme1_5',
];
$arrTheme2 = [
    'fieldTheme2_1',
    'fieldTheme2_2',
    'fieldTheme2_3',
    'fieldTheme2_4',
];
$arrTheme3 = [
    'fieldTheme3_1',
    'fieldTheme3_2',
];
$arrTheme4 = [
    'fieldTheme4_1',
];
$arrTheme5 = [
    'fieldTheme5_1',
    'fieldTheme5_2',
    'fieldTheme5_3',
    'fieldTheme5_4_1',
    'fieldTheme5_4_2',
    'fieldTheme5_4_3',
    'fieldTheme5_4_4',
    'fieldTheme5_4_5',
];
$arrIndividualTheme1 = [
    'fieldIndividualTheme1_1',
    'fieldIndividualTheme1_2',
    'fieldIndividualTheme1_3',
];
$arrIndividualTheme2 = [
    'fieldIndividualTheme2_1',
    'fieldIndividualTheme2_2',
    'fieldIndividualTheme2_3',
];
$arrIndividualTheme3 = [
    'fieldIndividualTheme3_1',
    'fieldIndividualTheme3_2',
];
$arrIndividualTheme4 = [
    'fieldIndividualTheme4_1',
    'fieldIndividualTheme4_2',
];
$arrIndividualTheme5 = [
    'fieldIndividualTheme5_1',
    'fieldIndividualTheme5_2',
];
$arrIndividualTheme6 = [
    'fieldIndividualTheme6_1',
    'fieldIndividualTheme6_2',
];


?>

<div style="margin-left: 10px">Учебный
    год: <?= Yii::$app->riskComponent->academicYear($rows['year']) ?></div>
<div style="margin-left: 10px">Класс:
    <b><?= Yii::$app->riskComponent->trainingClassIndividualDecoding($rows['class_individual']) ?></b></div>
<div>
    <b>Оценка ОБЩЕГО РИСКА - <?= $rows['risk_assessment_g'] ?></b><br>
    <b>Оценка ОБЩЕГО РИСКА по группе классов - <?= $rows['risk_assessment'] ?></b>
</div>
<i> <b>Фактор риска «МЕБЕЛЬ»:</b></i> <b><?= $rows['risk_assessment_1'] ?></b><br>
<?
for ($i = 0; $i < count($arrTheme1); $i++) {
    if (Yii::$app->riskComponent->fieldTheme1Decoding($rows[$arrTheme1[$i]]) != '0') {
        ?>
        <span>- <?=$modelOrganizationCommon->attributeLabels()[$arrTheme1[$i]]?> <b><?=Yii::$app->riskComponent->fieldTheme1Decoding($rows[$arrTheme1[$i]])?></b></span><br>
    <? } ?>
    <?
} ?>
<i><b>Фактор риска «ИСКУССТВЕННОЕ ОСВЕЩЕНИЕ»:</b></i> <b><?= $rows['risk_assessment_2'] ?></b><br>
<?
for ($i = 0; $i < count($arrTheme2); $i++) {
    $arr = $arrTheme2[$i];
    if (Yii::$app->riskComponent->fieldTheme2Decoding($rows[$arr]) != '0') {
        ?>
        <span>- <?=$modelOrganizationCommon->attributeLabels()[$arr]?> <b><?=Yii::$app->riskComponent->fieldTheme2Decoding($rows[$arr])?></b></span><br>
    <? } ?>
    <?
} ?>
<i><b>Фактор риска «Отсутствие ГИМНАСТИКИ ДЛЯ ГЛАЗ в течение учебного дня»:</b></i>
<b><?= $rows['risk_assessment_3'] ?></b><br>
<?
for ($i = 0; $i < count($arrTheme3); $i++) {
    $arr = $arrTheme3[$i];
    if (Yii::$app->riskComponent->fieldTheme3Decoding($rows[$arr]) != '0') {
        ?>
        <span>- <?=$modelOrganizationCommon->attributeLabels()[$arr]?> <b><?=Yii::$app->riskComponent->fieldTheme3Decoding($rows[$arr])?></b></span><br>
    <? } ?>
    <?
} ?>
<i><b>Фактор риска «Отсутствие ГИМНАСТИКИ ДЛЯ мышц спины и шеи в течение учебного дня»:</b></i>
<b><?= $rows['risk_assessment_4'] ?></b><br>
<?
for ($i = 0; $i < count($arrTheme4); $i++) {
    $arr = $arrTheme4[$i];
    if (Yii::$app->riskComponent->fieldTheme4Decoding($rows[$arr]) != '0') {
        ?>
        <span>- <?=$modelOrganizationCommon->attributeLabels()[$arr]?> <b><?=Yii::$app->riskComponent->fieldTheme4Decoding($rows[$arr])?></b></span><br>
    <? } ?>
    <?
} ?>
<i><b>Фактор риска «НЕРАЦИОНАЛЬНОЕ ИСПОЛЬЗОВАНИЕ ЭЛЕКТРОННЫХ СРЕДСТВ ОБУЧЕНИЯ И СРЕДСТВ МОБИЛЬНОЙ СВЯЗИ»:</b></i>
<b><?= $rows['risk_assessment_5'] ?></b><br>
<?
for ($i = 0; $i < count($arrTheme5); $i++) {
    $arr = $arrTheme5[$i];
    if (Yii::$app->riskComponent->fieldTheme5Decoding($rows[$arr]) != '0') {
        ?>
        <span>- <?=$modelOrganizationCommon->attributeLabels()[$arr]?> <b><?=Yii::$app->riskComponent->fieldTheme5Decoding($rows[$arr])?></b></span><br>
    <? } ?>
    <?
} ?><br>
<b>Оценка ИНДИВИДУАЛЬНОГО РИСКА - <?= $rows['risk_assessment_individual'] ?></b><br>

<i><b>Фактор риска «СОКРАЩЕНИЕ ОПТИМАЛЬНОГО РАССТОЯНИЯ ОТ ОРГАНА ЗРЕНИЯ ДО РАБОЧЕЙ ПОВЕРХНОСТИ»:</b></i>
<b><?= $rows['risk_assessment_individual_y_1'] ?></b><br>
<?
for ($i = 0; $i < count($arrIndividualTheme1); $i++) {
    $arr = $arrIndividualTheme1[$i];
    if (Yii::$app->riskComponent->fieldTheme1IndividualDecoding($rows[$arr]) != '0') {
        ?>
        <span>- <?=$modelIndividualCommon->attributeLabels()[$arr]?> <b><?=Yii::$app->riskComponent->fieldTheme1IndividualDecoding($rows[$arr])?></b></span><br>
    <? } ?>
    <?
} ?>
<i><b> Фактор риска «Отсутствие ГИМНАСТИКИ ДЛЯ ГЛАЗ в течение учебного дня»:</b></i>
<b><?= $rows['risk_assessment_individual_y_2'] ?></b><br>
<?
for ($i = 0; $i < count($arrIndividualTheme2); $i++) {
    $arr = $arrIndividualTheme2[$i];
    if (Yii::$app->riskComponent->fieldTheme2IndividualDecoding($rows[$arr]) != '0') {
        ?>
        <span>- <?=$modelIndividualCommon->attributeLabels()[$arr]?> <b><?=Yii::$app->riskComponent->fieldTheme2IndividualDecoding($rows[$arr])?></b></span><br>
    <? } ?>
    <?
} ?>
<i><b>Фактор риска «Отсутствие ГИМНАСТИКИ ДЛЯ МЫШЦ СПИНЫ И ШЕИ в течение учебного дня»:</b></i>
<b><?= $rows['risk_assessment_individual_y_3'] ?></b><br>
<?
for ($i = 0; $i < count($arrIndividualTheme3); $i++) {
    $arr = $arrIndividualTheme3[$i];
    if (Yii::$app->riskComponent->fieldTheme3IndividualDecoding($rows[$arr]) != '0') {
        ?>
        <span>- <?=$modelIndividualCommon->attributeLabels()[$arr]?> <b><?=Yii::$app->riskComponent->fieldTheme3IndividualDecoding($rows[$arr])?></b></span><br>
    <? } ?>
    <?
} ?>
<i><b>Фактор риска «НЕРАЦИОНАЛЬНОЕ ИСПОЛЬЗОВАНИЕ ЭЛЕКТРОННЫХ СРЕДСТВ ОБУЧЕНИЯ И СРЕДСТВ МОБИЛЬНОЙ СВЯЗИ»:</b></i>
<b><?= $rows['risk_assessment_individual_y_4'] ?></b><br>
<?
if (Yii::$app->riskComponent->fieldTheme41IndividualDecoding($rows['fieldIndividualTheme4_1']) != '0') {
    ?>
    <span>- <?=$modelIndividualCommon->attributeLabels()['fieldIndividualTheme4_1']?> <b><?=Yii::$app->riskComponent->fieldTheme41IndividualDecoding($rows['fieldIndividualTheme4_1'])?></b></span><br>
<? } ?>
<?
if (Yii::$app->riskComponent->fieldTheme42IndividualDecoding($rows['fieldIndividualTheme4_2']) != '0') {
    ?>
    <span>- <?=$modelIndividualCommon->attributeLabels()['fieldIndividualTheme4_2']?> <b><?=Yii::$app->riskComponent->fieldTheme42IndividualDecoding($rows['fieldIndividualTheme4_2'])?></b></span><br>
<? } ?>

<i><b>Фактор риска «ДЕФИЦИТ ВРЕМЕНИ НАХОЖДЕНИЯ РЕБЕНКА НА УЛИЦЕ»:</b></i>
<b><?= $rows['risk_assessment_individual_y_5'] ?></b><br>
<?
if (Yii::$app->riskComponent->fieldTheme51IndividualDecoding($rows['fieldIndividualTheme5_1']) != '0') {
    ?>
    <span>- <?=$modelIndividualCommon->attributeLabels()['fieldIndividualTheme5_1']?> <b><?=Yii::$app->riskComponent->fieldTheme51IndividualDecoding($rows['fieldIndividualTheme5_1'])?></b></span><br>
<? } ?>
<?
if (Yii::$app->riskComponent->fieldTheme52IndividualDecoding($rows['fieldIndividualTheme5_2']) != '0') {
    ?>
    <span>- <?=$modelIndividualCommon->attributeLabels()['fieldIndividualTheme5_2']?> <b><?=Yii::$app->riskComponent->fieldTheme52IndividualDecoding($rows['fieldIndividualTheme5_2'])?></b></span><br>
<? } ?>
<b>Фактор риска «НАСЛЕДСТВЕННАЯ ОТЯГОЩЕННОСТЬ» - <?= $rows['risk_assessment_individual_z'] ?></b><br>
<?
for ($i = 0; $i < count($arrIndividualTheme6); $i++) {
    $arr = $arrIndividualTheme6[$i];
    if (Yii::$app->riskComponent->fieldTheme6IndividualDecoding($rows[$arr]) != '0') {
        ?>
        <span>- <?=$modelIndividualCommon->attributeLabels()[$arr]?> <b><?=Yii::$app->riskComponent->fieldTheme6IndividualDecoding($rows[$arr])?></b></span><br>
    <? } ?>
    <?
} ?>
<b>Оценка ИНДИВИДУАЛЬНОГО РИСКА с учетом поправочного индекса -
    <?= $rows['risk_assessment_individual_kv'] ?></b>
<div>



    <b>Заключение:</b>
    <div style="text-indent: 25px;">
        Индивидуальный риск – <span
                    style="color: blue;"><?= $modelOrganizationCommon->decodingTextRisk($rows['risk_assessment_individual']) ?>
        </span> (R=<span style="color: blue;"><?= $rows['risk_assessment_individual'] ?></span>),
        в т.ч. вклад управляемых факторов составляет <span
                    style="color: blue;"><?= $modelOrganizationCommon->contributionControlledFactors($rows) ?>%</span>
        ,
        из них на управляемые общеобразовательной организацией
        факторы приходится <span
                    style="color: blue;"><?= $modelOrganizationCommon->contributionControlledFactors2($rows) ?>%</span>
        ;
        на факторы, управляемые семьей – <span
                    style="color: blue;"><?= $modelOrganizationCommon->contributionControlledFactors3($rows) ?>%</span>
        .
    </div>
    <div style="text-indent: 25px;">
        Вероятность наступления события (формирование нарушений осанки и (или) зрения) в текущем учебном году, в
        случае если факторы
        риска не будут скорректированы составит <span
                    style="color: blue;"><?= $modelOrganizationCommon->contributionControlledFactors4($rows['risk_assessment_individual']) ?>%</span>
        ;
        к моменту окончания школы, при неизменных факторах риска, вероятность составит <span
                    style="color: blue;"><?= $modelOrganizationCommon->contributionControlledFactors4($rows['risk_assessment_individual_kv']) ?>%</span>
        .
    </div>
</div>
