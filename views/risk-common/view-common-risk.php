<?php

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

<div class="container-fluid">
    <div class="blockView  p-2">
        <h4 class="text-center">МР «Оценка коллективных и индивидуальных рисков нарушений осанки и зрения у обучающихся
            общеобразовательных организаций»</h4>
        <div class="text-center">
            <b><i>Пожалуйста, оцените работу калькулятора: </i></b>
            <?= Html::a(
                'Оцените работу калькулятора',
                ['view-estimation?key=' . $model->key],
                [
                    'title' => Yii::t('yii', 'Пожалуйста, оцените работу калькулятора'),
                    'class' => 'btn btn-sm btn-outline-success mt-3 mb-3',
                ]
            ); ?>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5 border-right">
                <div style="margin-left: 10px">
                    <div class="text-danger mt-3"><h4>Ваш Ключ - <?= $model->key ?></h4></div>
                    <div style="margin-left: 10px">Учебный
                        год: <?= Yii::$app->riskComponent->academicYear($model->year) ?></div>
                    <div style="margin-left: 10px">
                        Класс: <?= Yii::$app->riskComponent->trainingClass($model->class) ?>
                    </div>
                    <h5 class="text-center">Оценка ОБЩЕГО РИСКА:</b></h5>
                    <table style="border: 1px solid #000000;" class=" table table-sm table-bordered">
                        <tr>
                            <th class="text-center">Индекс</th>
                            <th class="text-center">Оцениваемые показатели</th>
                            <th class="text-center">Значение</th>
                        </tr>
                        <?=
                        $this->render(
                            '_result-tableX.php',
                            [
                                'model' => $model,
                                'nnn' => 1,
                            ]
                        ); ?>
                        <tr>
                            <th class="text-center"><span style="font-size: 16px">R</span><span style="font-size: 8px"> общий</span></th>
                            <th class="text-center">Общий риск</th>
                            <th class="text-center"><?=round($model['risk_assessment'], 3)?></th>
                        </tr>
                    </table>

                    <h5 class="text-center">Оценка ИНДИВИДУАЛЬНОГО РИСКА: </h5>
                    - внесено детей: <b><?= $result['countChild'] ?></b><br>

                </div>
                <?= Html::a(
                    'Изменить Оценку ОБЩЕГО РИСКА',
                    ['update-common-risk?id=' . $model->key],
                    [
                        'title' => Yii::t('yii', 'Изменить расчет риска'),
                        'class' => 'btn btn-sm btn-success mt-2 mb-2 btn-block',
                    ]
                ); ?>
                <?= Html::a('Сохранение ключа и общей информации',
                    ['print-common-risk'],
                    [
                        'data' => [
                            'method' => 'post',
                            'params' => [
                                'key' => $model->key
                            ],
                        ],
                        'class' => 'btn btn-sm btn-primary btn-block',
                    ]); ?>
                <h5 class="text-center mt-2">Оценка КОЛЛЕКТИВНОГО РИСКА: </h5>
                <? if ($RiskAssessmentCollective) { ?>
                    <table style="border: 1px solid #000000;" class=" table table-sm table-bordered">

                        <tr>
                            <th align="center" rowspan="2" style="padding: 0rem;" class="text-center" >Показатели</th>
                            <th align="center" rowspan="2" style="padding: 0rem;" class="text-center" >Всего детей</th>
                            <th align="center" colspan="3" style="padding: 0rem;" class="text-center" >Из них, с нарушениями</th>
                        </tr>
                        <tr>
                            <th class="text-center" align="center" style="padding: 0rem;" >осанки и зрения</th>
                            <th class="text-center" align="center" style="padding: 0rem;" >осанки</th>
                            <th class="text-center" align="center" style="padding: 0rem;" >зрения</th>

                        </tr>
                        <tr>
                            <th class="text-center" align="center" style="padding: 0rem;" ><?= Yii::$app->riskComponent->trainingClass($model->class) ?></th>
                            <th class="text-center" align="center" style="padding: 0rem;" ><?=$RiskAssessmentCollective->field_21?></th>
                            <th class="text-center" align="center" style="padding: 0rem;" ><?=$RiskAssessmentCollective->field_22?></th>
                            <th class="text-center" align="center" style="padding: 0rem;" ><?=$RiskAssessmentCollective->field_23?></th>
                            <th class="text-center" align="center" style="padding: 0rem;" ><?=$RiskAssessmentCollective->field_24?></th>

                        </tr>
                        <? if ($model->class == '342') { ?>
                            <?=
                            $this->render(
                                '/risk-collective/table-print/_1_4.php',
                                [
                                    'model' => $RiskAssessmentCollective,
                                ]
                            ); ?>
                        <? } else if ($model->class == '486') { ?>
                            <?= $this->render(
                                '/risk-collective/table-print/_5_9.php',
                                [
                                    'model' => $RiskAssessmentCollective,
                                ]
                            ); ?>
                        <? } else { ?>
                            <?= $this->render(
                                '/risk-collective/table-print/_10_11.php',
                                [
                                    'model' => $RiskAssessmentCollective,
                                ]
                            ); ?>
                        <? } ?>

                    </table>

                    <?
                    $arraClas = [
                        '1_4' => [
                             'vse' => '1-4 классы',
                             '1' => 'в т.ч. 1 классы',
                             '2' => '2 классы',
                             '3' => '3 классы',
                             '4' => '4 классы',
                        ],
                        '5_9' => [
                            'vse' => '5-9 классы',
                            '5' => 'в т.ч.  5 классы',
                            '6' => '6 классы',
                            '7' => '7 классы',
                            '8' => '8 классы',
                            '9' => '9 классы',
                        ],
                        '10_11' => [
                            'vse' => '10-11 классы',
                            '10' => 'в т.ч.  10 классы',
                            '11' => '11 классы',
                        ],
                    ];
                    ?>
                    <table style="border: 1px solid #000000;" class=" table table-sm table-bordered">
                        <tr>
                            <th align="center" style="padding: 0rem;" class="text-center"></th>
                            <th align="center" style="padding: 0rem;" class="text-center">N</th>
                            <th align="center" style="padding: 0rem;" class="text-center">G1</th>
                            <th align="center" style="padding: 0rem;" class="text-center">коэффициент</th>
                            <th align="center" style="padding: 0rem;" class="text-center">G2</th>
                            <th align="center" style="padding: 0rem;" class="text-center"><span style="font-size: 16px">R</span><span style="font-size: 8px"> общий</span></th>
                            <th align="center" style="padding: 0rem;" class="text-center"><span style="font-size: 16px">R</span><span style="font-size: 8px"> k</span></th>
                            <th align="center" style="padding: 0rem;" class="text-center"><span style="font-size: 16px">P</span><span style="font-size: 8px"> i</span></th>
                        </tr>
                    <?$riskCalculationByClassArray = $modelR->riskCalculationByClass($RiskAssessmentCollective, $model);?>
                    <?foreach ($riskCalculationByClassArray as $key => $arrayClass){
                        foreach ($arrayClass as $keyTwo => $arrOne) {
                            if($keyTwo == 'vse'){
                                $risk = $arrOne['R_k'];
                                $ver = round($arrOne['P_i'],1);
                            }
                            ?>
                            <tr>
                                <th align="center" style="padding: 0rem;" class="text-center"><?=$arraClas[$key][$keyTwo]?></th>
                                <td align="center" style="padding: 0rem;" class="text-center"><?=$arrOne['N']?></td>
                                <td align="center" style="padding: 0rem;" class="text-center"><?=$arrOne['G1']?></td>
                                <td align="center" style="padding: 0rem;" class="text-center"><?=$arrOne['koef']?></td>
                                <td align="center" style="padding: 0rem;" class="text-center"><?=$arrOne['G2']?></td>
                                <td align="center" style="padding: 0rem;" class="text-center"><?=$arrOne['R']?></td>
                                <td align="center" style="padding: 0rem;" class="text-center"><?=$arrOne['R_k']?></td>
                                <td align="center" style="padding: 0rem;" class="text-center"><?=$arrOne['P_i']?></td>
                            </tr>
                        <?
                        }
                    }?>
                    </table>
                    <div>
                        <b>Заключение:</b> коллективный риск составляет <?=$risk?> - <?= $model->decodingTextRisk($risk) ?>, вероятность формирования нарушений осанки и зрения у обучающихся (при условии неизменности действующих общих факторов риска) составляет <?=$ver?>%.
                        <br>При разработке программы профилактических мероприятий по организации необходимо обратить внимание на следующие управляемые общеобразовательной организацией группы факторов для обучающихся:
                        <br><?= Yii::$app->riskComponent->trainingClass($model->class) ?> – <?= $model->decodingOverallRisk2($model) ?>

                    </div>
                    <?= Html::a(
                        'Изменить Оценку КОЛЛЕКТИВНОГО РИСКА',
                        ['update-collective-risk?id=' . $RiskAssessmentCollective->key],
                        [
                            'title' => Yii::t('yii', 'Изменить расчет риска'),
                            'class' => 'btn btn-sm btn-success mt-2 mb-2 btn-block',
                        ]
                    ); ?>
                    <?=  Html::a('Напечатать заключение КОЛЛЕКТИВНОГО РИСКА',
                        ['print-collective-risk'],
                        [
                            'data' => [
                                'method' => 'post',
                                'params' => [
                                    'key' => $RiskAssessmentCollective->key,
                                ],
                            ],
                            'class' => 'btn btn-sm btn-outline-primary btn-block',
                        ]);?>
                    <?=
                    Html::a(
                        'Напечатать заключение КОЛЛЕКТИВНОГО РИСКА по классам',
                        ['print-collective-risk-common?key=' . $model->key],
                        [
                            'title' => Yii::t('yii', 'Напечатать заключение КОЛЛЕКТИВНОГО РИСКА по классам'),
                            'class' => 'btn btn-sm btn-outline-primary btn-block mt-2',
                        ]
                    );
                    ?>
                <? } else {
                    echo Html::a(
                        'Добавить данные для коллективного риска',
                        ['create-collective-risk?id=' . $model->key],
                        [
                            'title' => Yii::t('yii', 'Добавить индивидуальный риск (для внесения понадобиться ключ)'),
                            'class' => 'btn btn-sm btn-success mt-3 mb-3 btn-block',
                        ]
                    );
                } ?>


            </div>

            <div class="col-sm-12 col-md-12 col-lg-7 col-xl-7">
                <?= Html::a(
                    'Добавить данные для индивидуального риска',
                    ['create-individual-common-risk?id=' . $model->key],
                    [
                        'title' => Yii::t('yii', 'Добавить индивидуальный риск (для внесения понадобиться ключ)'),
                        'class' => 'btn btn-sm btn-success mt-3 mb-3 btn-block',
                    ]
                ); ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm table2excel_with_colors">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Респондент/класс</th>
                            <th>Индивидуализированное значение риска</th>
                            <th>Расшифровка индивидуализированного значения риска</th>
                            <th></th>
                        </tr>
                        <? $i = 1;
                        foreach ($resultChild as $child) {
                            ?>
                            <tr>
                                <td class="text-center"><?= $i++ ?></td>
                                <td><?= Yii::$app->riskComponent->trainingClassIndividualDecoding($child['class_individual']) ?></td>
                                <td class="text-center"><?= ($child['violation_posture'] === '100' || $child['visual_impairment'] === '100') ? ' - ' : $child['risk_assessment_individual'] ?></td>
                                <td class="text-center"><?= ($child['violation_posture'] === '100' || $child['visual_impairment'] === '100') ? 'Риск не оценивается' : $model->decodingTextRisk($child['risk_assessment_individual']) ?></td>
                                <td>
                                    <?= Html::a(
                                        'Изменить',
                                        ['update-individual-common-risk?id=' . $child['id_individual']],
                                        [
                                            //'title' => Yii::t('yii', 'Добавить индивидуальный риск (для внесения понадобиться ключ)'),
                                            'class' => 'btn btn-sm btn-outline-success mb-1 btn-block',
                                        ]
                                    ); ?>
                                    <?= Html::a(
                                        'Заключение',
                                        ['view-individual-risk?id=' . $child['id_individual']],
                                        [
                                            //'title' => Yii::t('yii', 'Добавить индивидуальный риск (для внесения понадобиться ключ)'),
                                            'class' => 'btn btn-sm btn-outline-primary btn-block',
                                        ]
                                    ); ?>
                                </td>
                            </tr>
                            <?
                        } ?>
                    </table>
                </div>
            </div>

        </div>
        <br>
        <hr>
        <br>
        <h4 class="text-center" id="alertText">«Данные по индивидуальной и коллективной оценке уровня тревожности и агрессии у обучающихся общеобразовательных организаций, профилактике нарушений психического здоровья»</h4>
        <h5 class="text-center"><i>(для педагогов и родителей)</i></h5>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-1">
                <?= Html::a(
                    'Заполнить данные по ребенку',
                    ['content-questionnaire?key=' . $model->key.'&class='. $model->class],
                    [
                        'title' => Yii::t('yii', 'Заполнить данные по ребенку и внести опросник'),
                        'class' => 'btn btn-sm btn-success btn-block',
                    ]
                ); ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-1">
                <?= Html::a(
                    'Шаблон анкетирования',
                    ['print-content-questionnaire-pattern?key=' . $model->key.'&class='. $model->class],
                    //['print-content-questionnaire?id=1' . $one['1']],
                    [
                        //'title' => Yii::t('yii', 'Добавить индивидуальный риск (для внесения понадобиться ключ)'),
                        'class' => 'btn btn-sm btn-outline-primary btn-block',
                    ]
                ); ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-1">
                <?= Html::a(
                    'Коллективная оценка уровня тревожности и агрессии',
                    ['print-children-list?key=' . $model->key],
                    //['print-content-questionnaire?id=1' . $one['1']],
                    [
                        //'title' => Yii::t('yii', 'Добавить индивидуальный риск (для внесения понадобиться ключ)'),
                        'class' => 'btn btn-sm btn-outline-primary btn-block',
                    ]
                ); ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-1">
                <?= HTML::a('Упражнения по снятию (снижению) тревожности', '@web/exercise.pdf', ['target' => '_blank', 'class' => 'btn btn-sm btn-outline-primary btn-block']); ?>
            </div>
        </div>


        <br>
        <?if($modelRiskChildrenList){?>
            <div class="table-responsive">
                <table class="table table-bordered table-sm table2excel_with_colors">
                    <tr class="text-center">
                        <th>№</th>
                        <th>Респондент/класс</th>
                        <th>Оценка уровня реактивной и личностной тревожности </th>
                        <th>Опросник 1: «Опросник на наличие симптомов беспокойства и нервозности»</th>
                        <th>Опросник 2: «Опросник индикации возможных причин тревожности»</th>
                        <th>Опросник 3: «Меры профилактики, реализуемые в отношении ребенка со стороны учителей»</th>
                        <th>Опросник 4: «Меры профилактики, реализуемые в отношении ребенка со стороны родителей - законных представителей»</th>
                        <th>Опросник 5: «Опросник формы проявления агрессии у ребенка»</th>
                        <th>Опросник 6: «Опросник индикации возможных причин агрессивности ребенка»</th>
                        <th>Опросник диагностики агрессии по Басса-Дарки</th>
                        <th></th>
                    </tr>
                    <? $i = 1; ?>
                    <?foreach ($modelRiskChildrenList as $one){?>
                        <tr>
                            <td class="text-center"><?= $i++ ?></td>
                            <td><?=$one['name_responsible_person_individual']?> - <?=Yii::$app->riskComponent->trainingClassIndividualDecoding($one['class'])?> класс</td>
                            <td class="text-center"><b>РТ:</b> <?=$one['rt']?> (<?=Yii::$app->riskComponent->interpretation($one['rt'])?>) <b>ЛТ:</b> <?=$one['lt']?> (<?=Yii::$app->riskComponent->interpretation($one['lt'])?>) </td>
                            <td class="text-center"><?=$one['estimation_one']?> баллов</td>
                            <td class="text-center"><?=$one['estimation_two']?> баллов</td>
                            <td class="text-center"><?=$one['estimation_three']?> баллов</td>
                            <td class="text-center"><?=$one['estimation_four']?> баллов</td>
                            <td class="text-center"><?=$one['estimation_five']?> баллов</td>
                            <td class="text-center"><?=$one['estimation_six']?> баллов</td>
                            <td class="text-center"><b>Индекс агрессивности:</b> <?=$one['aggressiveness_index']?> <b>Индекс враждебности:</b> <?=$one['includes_index']?></td>
                            <td>
                                <?= Html::a(
                                    'Изменить',
                                    ['update-content-questionnaire?id=' . $one['id']],
                                    [
                                        //'title' => Yii::t('yii', 'Добавить индивидуальный риск (для внесения понадобиться ключ)'),
                                        'class' => 'btn btn-sm btn-outline-success mb-1 btn-block',
                                    ]
                                ); ?>
                                <?= Html::a(
                                    'Заключение',
                                    ['print-content-questionnaire?id=' . $one['id']],
                                    [
                                        //'title' => Yii::t('yii', 'Добавить индивидуальный риск (для внесения понадобиться ключ)'),
                                        'class' => 'btn btn-sm btn-outline-primary btn-block',
                                    ]
                                ); ?>
                            </td>
                        </tr>
                    <?}?>
                </table>
            </div>
        <?}?>
    </div>
</div>
<br>
<br>

<?php
$script = <<< JS
 
JS;
$this->registerJs($script);
?>

