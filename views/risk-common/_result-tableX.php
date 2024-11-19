



<?php if(!$nnn){?>
    <tr><td class="text-center" align="center">х1.1.</td> <td>не промаркированная мебель</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme1Decoding($model['fieldTheme1_1'])?></td></tr>
    <tr><td class="text-center" align="center">х1.2.</td> <td>не стандартная мебель</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme1Decoding($model['fieldTheme1_2'])?></td></tr>
    <tr><td class="text-center" align="center">х1.3.</td> <td>не комплектная мебель</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme1Decoding($model['fieldTheme1_3'])?></td></tr>
    <tr><td class="text-center" align="center">х1.4.</td> <td>не ведется листок здоровья либо ведется не в полном объёме</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme1Decoding($model['fieldTheme1_4'])?></td></tr>
    <tr><td class="text-center" align="center">х1.5.</td> <td>дети не рассаживаются с учетом роста</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme1Decoding($model['fieldTheme1_5'])?></td></tr>

<?}?>
<tr class="font-weight-bold"><th class="text-center" align="center">х1</th>    <th>Итого по фактору ученическая мебель</th> <th class="text-center" align="center"><?=$model['risk_assessment_1']?></th></tr>
<?php if(!$nnn){?>
    <tr><td class="text-center" align="center">х2.1.</td> <td>отсутствие производственного контроля за уровнем освещенности в учебных классах и кабинетах</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme2Decoding($model['fieldTheme2_1'])?></td></tr>
    <tr><td class="text-center" align="center">х2.2.</td> <td>нарушения санитарного законодательства, выявленные в ходе контрольно-надзорных мероприятий, а также в ходе профилактических визитов течение прошлого учебного года</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme2Decoding($model['fieldTheme2_2'])?></td></tr>
    <tr><td class="text-center" align="center">х2.3.</td> <td>наличие в отдельных учебных классах и кабинетах перегоревших ламп</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme2Decoding($model['fieldTheme2_3'])?></td></tr>
    <tr><td class="text-center" align="center">х2.4.</td> <td>наличие учебных классов и кабинетов, в которых не установлены светорассеивающие светильники</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme2Decoding($model['fieldTheme2_4'])?></td></tr>
<?}?>
<tr class="font-weight-bold"><th class="text-center" align="center">х2</th> <th>Итого по фактору искусственная освещенность</th> <th class="text-center" align="center"><?=$model['risk_assessment_2']?></th></tr>
<?php if(!$nnn){?>
    <tr><td class="text-center" align="center">х3.1.</td> <td>отсутствие проведения гимнастики для глаз вовремя перемен</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme3Decoding($model['fieldTheme3_1'])?></td></tr>
    <tr><td class="text-center" align="center">х3.2.</td> <td>отсутствие проведения гимнастики для глаз во время уроков с использованием электронных средств обучения</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme3Decoding($model['fieldTheme3_2'])?></td></tr>
<?}?>
<tr class="font-weight-bold"><th class="text-center" align="center">х3</th> <th>Итого по фактору гимнастика для глаз</th> <th class="text-center" align="center"><?=$model['risk_assessment_3']?></th></tr>
<?php if(!$nnn){?>
    <tr><td class="text-center" align="center">х4.1.</td> <td>отсутствие проведения гимнастики для мышц спины и шеи вовремя перемен</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme4Decoding($model['fieldTheme4_1'])?></td></tr>
<?}?>
<tr class="font-weight-bold"><th class="text-center" align="center">х4</th> <th>Итого по фактору гимнастика для мышц спины и шеи </th> <th class="text-center" align="center"><?=$model['risk_assessment_4']?></th></tr>
<?php if(!$nnn){?>
    <tr><td class="text-center" align="center">х5.1.</td> <td>превышение регламентированного СанПиН значения продолжительности использования ЭСО во время уроков</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme5Decoding($model['fieldTheme5_1'])?></td></tr>
    <tr><td class="text-center" align="center">х5.2.</td> <td>превышение регламентированного СанПиН значения продолжительности использования ЭСО в общеобразовательной организации за учебный день</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme5Decoding($model['fieldTheme5_2'])?></td></tr>
    <tr><td class="text-center" align="center">х5.3.</td> <td>отсутствие локального акта о запрете использования обучающимися во время перемен устройств мобильной связи (сотовых телефонов)</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme5Decoding($model['fieldTheme5_3'])?></td></tr>
    <tr><td class="text-center" align="center">х5.4.</td> <td colspan="2">конструктивные особенности используемых ЭСО на уроках, в том числе недостаточный размер диагонали (1-4):</td> </tr>

<?}?>
<?php if(!$nnn){?>
    <tr><td class="text-center" align="center">х5.4.1.</td> <td>интерактивной доски</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme6Decoding($model['fieldTheme5_4_1'])?></td></tr>
    <tr><td class="text-center" align="center">х5.4.2.</td> <td>монитора компьютера</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme6Decoding($model['fieldTheme5_4_2'])?></td></tr>
    <tr><td class="text-center" align="center">х5.4.3.</td> <td>планшета</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme6Decoding($model['fieldTheme5_4_3'])?></td></tr>
    <tr><td class="text-center" align="center">х5.4.4.</td> <td>ноутбука</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme6Decoding($model['fieldTheme5_4_4'])?></td></tr>
    <tr><td class="text-center" align="center">х5.4.5.</td> <td>отсутствие второй клавиатуры у ноутбука</td> <td class="text-center" align="center"><?=Yii::$app->riskComponent->fieldTheme6Decoding($model['fieldTheme5_4_5'])?></td></tr>
<?}?>
<tr class="font-weight-bold"><th class="text-center" align="center">х5</th> <th>Итого по фактору нерациональное использование электронных средств обучения и средств мобильной связи</th> <th class="text-center" align="center"><?=$model['risk_assessment_5']?></th></tr>


