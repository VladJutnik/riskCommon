<?php

use yii\bootstrap4\Html;

$this->title = 'Заключение по индивидуальному риску нарушения осанки и зрения';

/*print_r('<pre>');
print_r($rows);
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
    <div class="blockView  p-3">
        <?= Html::a(
            'Вернуться назад',
            ['view-common-risk?key=' . $rows['key']],
            [
                //'title' => Yii::t('yii', 'Добавить индивидуальный риск (для внесения понадобиться ключ)'),
                'class' => 'btn btn-sm btn-outline-danger',
            ]
        ); ?>
        <h5 class="text-center"><?= $this->title ?></h5>

        <div style="margin-left: 10px">
            <div class="text-danger mt-3"><h4>Ваш Ключ - <?= $rows['key'] ?></h4></div>
            <div style="margin-left: 10px">Учебный
                год: <?= Yii::$app->riskComponent->academicYear($rows['year']) ?></div>
            <div style="margin-left: 10px">
                Класс: <?= Yii::$app->riskComponent->trainingClass($rows['class']) ?>
            </div>
            <? if ($rows['violation_posture'] === '100' || $rows['visual_impairment'] === '100'){ ?>
                <h4 class="text-center text-danger mt-4 mb-4">У респондента есть нарушение осанки и зрения, индивидуальный риск не оценивается</h4>
            <? } else { ?>
            <h5 class="text-center">Оценка ОБЩЕГО РИСКА:</b></h5>
            <table style="border: 1px solid #000000;" class=" table table-sm table-bordered">
                <tr>
                    <th class="text-center">Индекс</th>
                    <th class="text-center">Оцениваемые показатели</th>
                    <th class="text-center">Значение</th>
                </tr>
                <?=
                $this->render(
                    '/risk-common/_result-tableX.php',
                    [
                        'model' => $rows,
                    ]
                ); ?>
                <?=
                $this->render(
                    '/risk-individual/_result-tableY.php',
                    [
                        'model' => $rows,
                        'modelOrganizationCommon' => $modelOrganizationCommon,
                        'modelIndividualCommon' => $modelIndividualCommon,
                    ]
                ); ?>
            </table>
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
                    Вероятность наступления события (формирование нарушений осанки и (или) зрения) в текущем учебном
                    году, в
                    случае если факторы
                    риска не будут скорректированы составит <span
                            style="color: blue;"><?= $modelOrganizationCommon->contributionControlledFactors4($rows['risk_assessment_individual']) ?>%</span>
                    ;
                    к моменту окончания школы, при неизменных факторах риска, вероятность составит <span
                            style="color: blue;"><?= $modelOrganizationCommon->contributionControlledFactors4($rows['risk_assessment_individual_kv']) ?>%</span>
                    .
                </div>
            </div>
        </div>
    <?= Html::a('Напечатать заключение',
        ['print-individual-risk'],
        [
            'data' => [
                'method' => 'post',
                'params' => [
                    'id' => $rows['id_individual']
                ],
            ],
            'class' => 'btn btn-sm btn-outline-primary btn-block mt-2',
        ]); ?>
    <? } ?>

    </div>
</div>