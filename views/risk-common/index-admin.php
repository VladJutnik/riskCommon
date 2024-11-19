<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Оценка коллективных и индивидуальных рисков нарушений осанки и зрения у обучающихся общеобразовательных организаций';
/*print_r('<pre>');
print_r($patients);
print_r('</pre> <br>');
print_r($models->attributeLabels()['id']);
print_r('</pre>');*/
?>

    <style>
        .flex-container {

            display: flex;

            justify-content: flex-start;
            align-items: stretch;
            /* flex-flow: row nowrap; */
            flex-direction: row;
            flex-wrap: wrap;
            align-content: stretch;

            background-color: #dee7f8;
            height: 100%;
            padding: 15px;
            gap: 5px;

        }

        .flex-container > div {
            background: #ffe3b5;
            border: 3px solid #fc9d35;
            border-radius: 5px;
            padding: 8px;
        }


        .item1 {
            /* flex:1 1 auto; */
            flex-grow: 1;
        }

        .item2 {
            /* flex:1 1 auto; */
            flex-grow: 1;
        }

        .item3 {
            /* flex:1 1 auto; */
            flex-grow: 1;
        }


    </style>

    <div class="flex-container mt-2">
        <div class="item1 radius-30">
            <?= Html::a(
                'Рассчитать общий риск',
                ['create-common-risk'],
                [
                    'class' => 'btn btn-sm btn-outline-success mt-3 px-5 radius-30 btn-block',
                    'title' => Yii::t('yii', 'Вы можете '),
                ]
            )
            ?>
            <div class="text-center mt-3">
                <?php
                $form = ActiveForm::begin(); ?>

                <div class="mb-2 text-center"><b>Загрузить риск <br>(<i>Если у Вас уже есть ключ, который выдается при
                            заполнении общего риска</i>)</b></div>
                <?= $form->field($model, 'key')->textInput(['class' => 'form-control'])->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton(
                        'Загрузить',
                        ['class' => 'btn btn-sm btn-outline-success mt-3 px-5 radius-30 btn-block']
                    ) ?>
                </div>

                <?php
                ActiveForm::end(); ?>
            </div>
        </div>
        <div class="item2 radius-30">
            <?= Html::a(
                'Выгрузить общий риск',
                ['report-common-risk?key=2'],
                [
                    'class' => 'btn btn-sm btn-outline-success p-2 px-5 mt-3 radius-30 btn-block',
                    'title' => Yii::t('yii', 'Вы можете '),
                ]
            )
            ?>
            <?= Html::a(
                'Выгрузить индивидуальный риск',
                ['report-individual-risk?key=2'],
                [
                    'class' => 'btn btn-sm btn-outline-success p-2 px-5 mt-2 radius-30 btn-block',
                    'title' => Yii::t('yii', 'Вы можете '),
                ]
            )
            ?>
            <?= Html::a(
                'Выгрузить коллективный риск',
                ['report-collective-risk?key=2'],
                [
                    'class' => 'btn btn-sm btn-outline-success p-2 px-5 mt-2 radius-30 btn-block',
                    'title' => Yii::t('yii', 'Вы можете '),
                ]
            )
            ?>
            <?= Html::a(
                'Выгрузить данные по агрессии и тревожности',
                ['report-aggression-risk?key=2'],
                [
                    'class' => 'btn btn-sm btn-outline-success p-2 px-5 mt-2 radius-30 btn-block',
                    'title' => Yii::t('yii', 'Вы можете '),
                ]
            )
            ?>
            <?= Html::a(
                'Выгрузить длинник данные по агрессии и тревожности',
                ['report-aggression-risk2?key=2'],
                [
                    'class' => 'btn btn-sm btn-outline-success p-2 px-5 mt-2 radius-30 btn-block',
                    'title' => Yii::t('yii', 'Вы можете '),
                ]
            )
            ?>
        </div>
    </div>

    <div class="flex-container">
        <div class="item1">
            <h5 class="text-center">
                Общий риск 1-4 кл <br>
                <b>Ключ:</b> 1e3a0f-9e4d4b-9df806-b1a252-c150ca
            </h5>

            <?= Html::a(
                'Загрузить общий риск 1-4кл',
                ['view-common-risk?key=1e3a0f-9e4d4b-9df806-b1a252-c150ca'],
                [
                    'class' => 'btn btn-sm btn-outline-success p-2 px-5 mt-2 radius-30 btn-block',
                    'title' => Yii::t('yii', 'Вы можете '),
                ]
            )
            ?>
        </div>
        <div class="item2">
            <h5 class="text-center">
                Общий риск 5-9 кл <br>
                <b>Ключ:</b> 6c84fa-5a9c08-dae1e7-219d3a-3314fc
            </h5>

            <?= Html::a(
                'Загрузить общий риск 5-9кл',
                ['view-common-risk?key=6c84fa-5a9c08-dae1e7-219d3a-3314fc'],
                [
                    'class' => 'btn btn-sm btn-outline-success p-2 px-5 mt-2 radius-30 btn-block',
                    'title' => Yii::t('yii', 'Вы можете '),
                ]
            )
            ?>
        </div>
        <div class="item3">
            <h5 class="text-center">
                Общий риск 10-11 кл <br>
                <b>Ключ:</b> 5aa821-693426-a53e66-df9153-6c39a2
            </h5>

            <?= Html::a(
                'Загрузить общий риск 10-11кл',
                ['view-common-risk?key=5aa821-693426-a53e66-df9153-6c39a2'],
                [
                    'class' => 'btn btn-sm btn-outline-success p-2 px-5 mt-2 radius-30 btn-block',
                    'title' => Yii::t('yii', 'Вы можете '),
                ]
            )
            ?>
        </div>
    </div>
    <div class="flex-container">
        <div class="item1">
            <h5 class="text-center">Количественные данные <br>по общему риску</h5>
            <? if($riskCommonArr !== []) { ?>
                <table class="table table-bordered table-sm">
                    <?foreach ($riskCommonArr['ocrug'] as $kee => $one){?>
                        <tr>
                            <th><?=$kee?></th>
                            <th><?=$one?></th>
                        </tr>
                        <?foreach ($riskCommonArr['reg'][$kee] as $kee2 => $one2){?>
                            <tr>
                                <td><?=$kee2?></td>
                                <td><?=$one2?></td>
                            </tr>
                        <?}?>
                        <?foreach ($riskCommonArr['reg2'][$kee] as $kee3 => $one3){?>
                            <?foreach ($one3 as $kee4 => $one4){?>
                                <tr>
                                    <th align="center" class="text-center"><?=Yii::$app->riskComponent->trainingClass($kee4)?></th>
                                    <td><?=$one4?></td>
                                </tr>
                            <?}?>
                        <?}?>
                    <?}?>
                </table>
            <? } else { ?>
                <i class="text-center">Количественные данные не найдены</i>
            <? } ?>
        </div>
        <div class="item2">
            <h5 class="text-center">Количественные данные <br>по коллективному риску</h5>
            <? if($riskCollectiveArr === []) { ?>
                <i class="text-center">Количественные данные не найдены</i>
            <? } else { ?>
                <table class="table table-bordered table-sm">
                    <?foreach ($riskCollectiveArr['ocrug'] as $kee => $one){?>
                        <tr>
                            <th><?=$kee?></th>
                            <th><?=$one?></th>
                        </tr>
                        <?foreach ($riskCollectiveArr['reg'][$kee] as $kee2 => $one2){?>
                            <tr>
                                <td><?=$kee2?></td>
                                <td><?=$one2?></td>
                            </tr>
                        <?}?>
                        <?foreach ($riskCollectiveArr['reg2'][$kee] as $kee3 => $one3){?>
                            <?foreach ($one3 as $kee4 => $one4){?>
                                <tr>
                                    <th align="center" class="text-center"><?=Yii::$app->riskComponent->trainingClass($kee4)?></th>
                                    <td><?=$one4?></td>
                                </tr>
                            <?}?>
                        <?}?>
                    <?}?>
                </table>
            <? } ?>
        </div>
        <div class="item3">
            <h5 class="text-center">Количественные данные <br>по индивидуальному риску</h5>
            <? if($riskIndividualArr !== []) { ?>
                <table class="table table-bordered table-sm">
                    <?foreach ($riskIndividualArr['ocrug'] as $kee => $one){?>
                        <tr>
                            <th><?=$kee?></th>
                            <th><?=$one?></th>
                        </tr>
                        <?foreach ($riskIndividualArr['reg'][$kee] as $kee2 => $one2){?>
                            <tr>
                                <td><?=$kee2?></td>
                                <td><?=$one2?></td>
                            </tr>
                        <?}?>
                        <tr>
                            <th class="text-center">Класс: </th>
                            <th class="text-center">Кол.</th>
                        </tr>
                        <?foreach ($riskIndividualArr['reg2'][$kee] as $kee3 => $one3){?>
                            <?foreach ($one3 as $kee4 => $one4){?>
                                <tr>
                                    <th align="center" class="text-center"><?=Yii::$app->riskComponent->trainingClassIndividualDecoding($kee4)?></th>
                                    <td><?=$one4?></td>
                                </tr>
                            <?}?>
                        <?}?>
                    <?}?>
                </table>
            <? } else { ?>
                <i class="text-center">Количественные данные не найдены</i>
            <? } ?>
        </div>
        <div class="item4">
            <h5 class="text-center">Количественные данные <br>по тревожности и агрессии</h5>
            <? if($riskChildrenListArr !== []) { ?>
                <table class="table table-bordered table-sm">
                    <?foreach ($riskChildrenListArr['ocrug'] as $kee => $one){?>
                        <tr>
                            <th><?=$kee?></th>
                            <th><?=$one?></th>
                        </tr>
                        <?foreach ($riskChildrenListArr['reg'][$kee] as $kee2 => $one2){?>
                            <tr>
                                <td><?=$kee2?></td>
                                <td><?=$one2?></td>
                            </tr>
                        <?}?>
                        <?foreach ($riskChildrenListArr['reg2'][$kee] as $kee3 => $one3){?>
                            <?foreach ($one3 as $kee4 => $one4){?>
                                <tr>
                                    <th class="text-center"><?=Yii::$app->riskComponent->trainingClass($kee4)?></th>
                                    <th class="text-center"><?=$one4?></th>
                                </tr>
                                <?foreach ($riskChildrenListArr['reg3'][$kee][$kee3][$kee4] as $kee5 => $one5){?>
                                    <tr>
                                        <th align="center" class="text-center">класс: <?=Yii::$app->riskComponent->trainingClassIndividualDecoding($kee5)?></th>
                                        <td><?=$one5?></td>
                                    </tr>
                                <?}?>
                            <?}?>
                        <?}?>
                    <?}?>
                </table>
            <? } else { ?>
                <i class="text-center">Количественные данные не найдены</i>
            <? } ?>
        </div>
    </div>

<?php
$script = <<< JS

JS;
$this->registerJs($script);
?>