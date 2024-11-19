<?php

namespace backend\modules\riskCommon\models;

use Yii;


class RiskAssessmentIndividualCommon extends \yii\db\ActiveRecord
{

    public $verifyCode;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'risk_assessment_individual_common';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'user_id',
                'key',
                'name_responsible_person_individual',
                'class_individual',
                'violation_posture',
                'visual_impairment',

            ], 'required'],
            /*['verifyCode', 'captcha','captchaAction'=>'/riskCommon/risk-common/captcha'],*/
            [[
                'user_id',
                'organization_id',

                'fieldIndividualTheme1_1',
                'fieldIndividualTheme1_2',
                'fieldIndividualTheme1_3',
                'fieldIndividualTheme2_1',
                'fieldIndividualTheme2_2',
                'fieldIndividualTheme2_3',
                'fieldIndividualTheme3_1',
                'fieldIndividualTheme3_2',
                'fieldIndividualTheme4_1',
                'fieldIndividualTheme4_2',
                'fieldIndividualTheme5_1',
                'fieldIndividualTheme5_2',
                'fieldIndividualTheme6_1',
                'fieldIndividualTheme6_2',
            ], 'integer'],
            [['risk_assessment_individual'], 'number'],
            [[
                'create_at',
                'risk_assessment_individual_y',
                'risk_assessment_individual_y_1',
                'risk_assessment_individual_y_2',
                'risk_assessment_individual_y_3',
                'risk_assessment_individual_y_4',
                'risk_assessment_individual_y_5',
                'risk_assessment_individual_z',
                'risk_assessment_individual_kv',
            ], 'safe'],
            [['name_responsible_person_individual', 'key'], 'string', 'max' => 250],
            [['class_individual'], 'string', 'max' => 50],
            [['fieldIndividualTheme1_1', 'fieldIndividualTheme1_2', 'fieldIndividualTheme1_3', 'fieldIndividualTheme2_1', 'fieldIndividualTheme2_2', 'fieldIndividualTheme2_3', 'fieldIndividualTheme3_1', 'fieldIndividualTheme3_2', 'fieldIndividualTheme4_1', 'fieldIndividualTheme4_2', 'fieldIndividualTheme5_1', 'fieldIndividualTheme5_2', 'fieldIndividualTheme6_1', 'fieldIndividualTheme6_2'], 'string', 'max' => 15],

            [[

                'fieldIndividualTheme1_1',
                'fieldIndividualTheme1_2',
                'fieldIndividualTheme1_3',
                'fieldIndividualTheme2_1',
                'fieldIndividualTheme2_2',
                'fieldIndividualTheme2_3',
                'fieldIndividualTheme3_1',
                'fieldIndividualTheme3_2',
                'fieldIndividualTheme4_1',
                'fieldIndividualTheme4_2',
                'fieldIndividualTheme5_1',
                'fieldIndividualTheme5_2',
                'fieldIndividualTheme6_1',
                'fieldIndividualTheme6_2',
            ],'required', 'when' => function($model) {
                return $model->violation_posture == '99' && $model->visual_impairment == '99';
            }, 'whenClient' => "function (attribute, value) {
                return $('#riskassessmentindividualcommon-violation_posture').val() == '99' && $('#riskassessmentindividualcommon-visual_impairment').val() == '99';
            }"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_individual' => 'Id Individual',
            'user_id' => 'User ID',
            'organization_id' => 'Organization ID',
            'name_responsible_person_individual' => 'Идентификатор респондента:',
            'key' => 'Ваш ключ для сохранения: ',
            'class_individual' => 'Класс: ',
            'fieldIndividualTheme1_1' => '1.1. При письме, если менее 30 см, интервьюер выбирает ответ ДА, если 30 см и более – ответ – НЕТ): ',
            'fieldIndividualTheme1_2' => '1.2. При чтении, если ответ 30 см и более, интервьюер выбирает ответ ДА, если 30 см и более – ответ – НЕТ): ',
            'fieldIndividualTheme1_3' => '1.3. При работе на уроке с компьютером, ноутбуком, планшетом, если менее 50 см, интервьюер выбирает ответ ДА, если 50 см и более – ответ – НЕТ): ',
            'fieldIndividualTheme2_1' => '2.1. Ребенок НЕ принимает участие в гимнастике во время уроков с использованием электронных средств обучения, если не принимает (по любой причине – нет гимнастики, не хочет выполнять упражнения, иные причины) выбирается ответ ДА/если принимает – ответ НЕТ: ',
            'fieldIndividualTheme2_2' => '2.2. Ребенок НЕ принимает участие в гимнастике во время перемен, если не принимает участие (по любой причине – нет гимнастики, не хочет выполнять упражнения, иные причины) выбирается ответ ДА /если принимает – ответ НЕТ: ',
            'fieldIndividualTheme2_3' => '2.3. Ребенок НЕ знает упражнения из гимнастики для глаз и НЕ может их выполнить самостоятельно без участия учителя (вожатого и т.д.) - ДА/если знает, может и умеет – ответ НЕТ: ',
            'fieldIndividualTheme3_1' => '3.1. Ребенок НЕ принимает участие в гимнастике во время перемен (по любой причине – нет гимнастики, не хочет выполнять упражнения, иные причины): ',
            'fieldIndividualTheme3_2' => '3.2. Ребенок НЕ знает упражнения из гимнастики для спины и шеи и НЕ может их выполнить самостоятельно без участия учителя (вожатого и т.д.): ',
            'fieldIndividualTheme4_1' => '4.1. Оценивается типичный учебный день – если продолжительность экранного времени более трех часов – ответ ДА, если три часа и менее – ответ НЕТ: ',
            'fieldIndividualTheme4_2' => '4.2. Оценивается типичный выходной день – если продолжительность экранного времени более трех часов – ответ ДА, если три часа и менее – ответ НЕТ: ',
            'fieldIndividualTheme5_1' => '5.1. Оценивается типичный учебный день – если продолжительность прогулок менее двух часов – ответ ДА, если три часа и менее – ответ НЕТ: ',
            'fieldIndividualTheme5_2' => '5.2. Оценивается типичный выходной день – если продолжительность прогулок менее двух часов – ответ ДА, если три часа и менее – ответ НЕТ: ',
            'fieldIndividualTheme6_1' => '6.1. Наличие миопии у матери – если есть – ответ ДА, если нет – ответ НЕТ: ',
            'fieldIndividualTheme6_2' => '6.2. Наличие миопии у отца – если есть – ответ ДА, если нет – ответ НЕТ: ',
            'risk_assessment_individual' => 'Risk Assessment Individual',
            'risk_assessment_individual_y' => 'Risk Assessment Individual',
            'risk_assessment_individual_z' => 'Risk Assessment Individual',
            'risk_assessment_individual_kv' => 'Risk Assessment Individual',
            'violation_posture' => 'Если у респондента нарушение осанки: ',
            'visual_impairment' => 'Если у респондента нарушение зрения: ',
            'verifyCode' => 'Введите значения с картинки:',
            'create_at' => 'Create At',
        ];
    }
}
