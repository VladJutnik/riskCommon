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
        .blockView {
            -webkit-box-shadow: 0px 5px 21px -4px rgba(7, 49, 81, 0.2);
            -moz-box-shadow: 0px 5px 21px -4px rgba(7, 49, 81, 0.2);
            box-shadow: 0px 5px 21px -4px rgba(7, 49, 81, 0.2);
            border-radius: 5px;
        }
    </style>
    <div class="container ">
        <br>
    <div class="blockView p-3">
        <h1 class="text-center text-danger">Калькулятор расчета комнатных растений</h1>
        <h6 class="text-center text-danger"><i>(если Вы хотите оценить количественные показатели комнатных растений на площадь помещения)</i></h6>
        <?= Html::a(
            'Калькулятор расчета комнатных растений',
            ['/flower'],
            [
                'class' => 'btn btn-sm btn-outline-danger mt-3 px-5 radius-30 btn-block',
                'title' => Yii::t('yii', 'Перенаправит Вас на калькулятор'),
            ]
        )
        ?>
    </div>
        <br>
        <br>

        <div class="blockView p-3">
            <h1 class="text-center"><?= $this->title ?></h1>
            <h5 class="text-center text-danger"><i>(работает в тестовом режиме)</i></h5>
            <div class=" text-center">
                <div class="mb-2"><b>Рассчитать риск</b></div>
                <?= Html::a(
                    'Рассчитать общий риск',
                    ['create-common-risk'],
                    [
                        'class' => 'btn btn-sm btn-outline-success mt-3 px-5 radius-30 btn-block',
                        'title' => Yii::t('yii', 'Вы можете'),
                    ]
                )
                ?>
               <!-- --><?/*= Html::Button(
                    'Индивидуальный риск',
                    ['class' => 'btn btn-sm btn-outline-success mt-3 px-5 radius-30 btn-block']
                ) */?>
            </div>
            <div class="text-center mt-3">
                <?php
                $form = ActiveForm::begin(); ?>

                <div class="mb-2"><b>Загрузить риск <br>(<i>Если у Вас уже есть ключ, который выдается при заполнении общего риска</i>)</b></div>
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
    </div>

<?php
$script = <<< JS

JS;
$this->registerJs($script);
?>