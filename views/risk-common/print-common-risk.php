<div class="text-danger mt-3"><h4>Ваш Ключ - <?= $model->key ?></h4></div>
<div style="margin-left: 10px">Учебный
    год: <?= Yii::$app->riskComponent->academicYear($model->year) ?></div>
<div style="margin-left: 10px">
    Класс: <?= Yii::$app->riskComponent->trainingClass($model->class) ?>
</div>
<div>
    <h5>Оценка ОБЩЕГО РИСКА - <b><?= $model['risk_assessment_g'] ?></b></h5>
    <h5>Оценка ОБЩЕГО РИСКА по группе классов- <b><?= $model['risk_assessment'] ?></b></h5>
</div>
<i>- Фактор риска «МЕБЕЛЬ»:</i> <b><?= $model->risk_assessment_1 ?></b><br>
<i>- Фактор риска «ИСКУССТВЕННОЕ ОСВЕЩЕНИЕ»:</i> <b><?= $model->risk_assessment_2 ?></b><br>
<i>- Фактор риска «Отсутствие ГИМНАСТИКИ ДЛЯ ГЛАЗ в течение учебного дня»:</i> <b><?= $model->risk_assessment_3 ?></b><br>
<i>- Фактор риска «Отсутствие ГИМНАСТИКИ ДЛЯ мышц спины и шеи в течение учебного дня»:</i> <b><?= $model->risk_assessment_4 ?></b><br>
<i>- Фактор риска «НЕРАЦИОНАЛЬНОЕ ИСПОЛЬЗОВАНИЕ ЭЛЕКТРОННЫХ СРЕДСТВ ОБУЧЕНИЯ И СРЕДСТВ МОБИЛЬНОЙ СВЯЗИ»:</i> <b><?= $model->risk_assessment_5 ?></b><br>
