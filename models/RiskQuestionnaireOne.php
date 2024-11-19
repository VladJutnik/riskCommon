<?php

namespace backend\modules\riskCommon\models;

use Yii;


class RiskQuestionnaireOne extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'risk_questionnaire_one';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'id_children_list',
                'key',
                'class_individual',
                'class',
                'estimation',
                'estimation_teacher',
                'estimation_parent',
            ], 'required'],
            [[
                'field_1_teacher',
                'field_2_teacher',
                'field_3_teacher',
                'field_4_teacher',
                'field_5_teacher',
                'field_6_teacher',
                'field_7_teacher',
                'field_1_parent',
                'field_2_parent',
                'field_3_parent',
                'field_4_parent',
                'field_5_parent',
                'field_6_parent',
                'field_7_parent',
                'create_at',
            ], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'field_1_teacher' => '1. Учащение дыхания: ',
            'field_2_teacher' => '2. Учащение пульса: ',
            'field_3_teacher' => '3. Повышенная потливость: ',
            'field_4_teacher' => '4. Покраснение отдельных участков кожных покровов: ',
            'field_5_teacher' => '5. Нервные тики: ',
            'field_6_teacher' => '6. Навязчивые неконтролируемые повторяющиеся движениями (ребёнок постоянно крутит что-то в руках, теребит волосы, грызёт ручку, ногти и т.д.): ',
            'field_7_teacher' => '7. Иные проявления беспокойства и нервозности: ',
            'field_1_parent' => '1. Учащение дыхания: ',
            'field_2_parent' => '2. Учащение пульса: ',
            'field_3_parent' => '3. Повышенная потливость: ',
            'field_4_parent' => '4. Покраснение отдельных участков кожных покровов: ',
            'field_5_parent' => '5. Нервные тики: ',
            'field_6_parent' => '6. Навязчивые неконтролируемые повторяющиеся движениями (вы постоянно крутите что-то в руках, теребите волосы, грызёте ручку, ногти и т.д.): ',
            'field_7_parent' => '7. Иные проявления беспокойства и нервозности: ',
        ];
    }

    public function decodingValues($id = '100')
    {
        $item = [
            '' => '',
            '0' => 'нет',
            '1' => 'иногда',
            '2' => 'почти всегда',
            '3' => 'всегда',
        ];
        return ($id != '100') ? $item[$id] : $item;
    }

    public function scoringScores($item)
    {
        $value =
            (($item['field_1_teacher'] === '2' || $item['field_1_teacher'] === '3') ? 1 : 0) +
            (($item['field_2_teacher'] === '2' || $item['field_2_teacher'] === '3') ? 1 : 0) +
            (($item['field_3_teacher'] === '2' || $item['field_3_teacher'] === '3') ? 1 : 0) +
            (($item['field_4_teacher'] === '2' || $item['field_4_teacher'] === '3') ? 1 : 0) +
            (($item['field_5_teacher'] === '2' || $item['field_5_teacher'] === '3') ? 1 : 0) +
            (($item['field_6_teacher'] === '2' || $item['field_6_teacher'] === '3') ? 1 : 0) +
            (($item['field_7_teacher'] === '2' || $item['field_7_teacher'] === '3') ? 1 : 0) +
            (($item['field_1_parent'] === '2' || $item['field_1_parent'] === '3') ? 1 : 0) +
            (($item['field_2_parent'] === '2' || $item['field_2_parent'] === '3') ? 1 : 0) +
            (($item['field_3_parent'] === '2' || $item['field_3_parent'] === '3') ? 1 : 0) +
            (($item['field_4_parent'] === '2' || $item['field_4_parent'] === '3') ? 1 : 0) +
            (($item['field_5_parent'] === '2' || $item['field_5_parent'] === '3') ? 1 : 0) +
            (($item['field_6_parent'] === '2' || $item['field_6_parent'] === '3') ? 1 : 0) +
            (($item['field_7_parent'] === '2' || $item['field_7_parent'] === '3') ? 1 : 0);

        if($value !== 0){
           $value = $value * 7.14;
            if($value > 100){
                $value = 100;
            }
            return $value;
        } else {
            return 0;
        }
    }

    public function scoringScores_teacher($item)
    {
        $value =
            (($item['field_1_teacher'] === '2' || $item['field_1_teacher'] === '3') ? 1 : 0) +
            (($item['field_2_teacher'] === '2' || $item['field_2_teacher'] === '3') ? 1 : 0) +
            (($item['field_3_teacher'] === '2' || $item['field_3_teacher'] === '3') ? 1 : 0) +
            (($item['field_4_teacher'] === '2' || $item['field_4_teacher'] === '3') ? 1 : 0) +
            (($item['field_5_teacher'] === '2' || $item['field_5_teacher'] === '3') ? 1 : 0) +
            (($item['field_6_teacher'] === '2' || $item['field_6_teacher'] === '3') ? 1 : 0) +
            (($item['field_7_teacher'] === '2' || $item['field_7_teacher'] === '3') ? 1 : 0);

        if($value !== 0){
           $value = $value * 7.14;
            if($value > 100){
                $value = 100;
            }
            return $value;
        } else {
            return 0;
        }
    }

    public function scoringScores_parent($item)
    {
        $value =
            (($item['field_1_parent'] === '2' || $item['field_1_parent'] === '3') ? 1 : 0) +
            (($item['field_2_parent'] === '2' || $item['field_2_parent'] === '3') ? 1 : 0) +
            (($item['field_3_parent'] === '2' || $item['field_3_parent'] === '3') ? 1 : 0) +
            (($item['field_4_parent'] === '2' || $item['field_4_parent'] === '3') ? 1 : 0) +
            (($item['field_5_parent'] === '2' || $item['field_5_parent'] === '3') ? 1 : 0) +
            (($item['field_6_parent'] === '2' || $item['field_6_parent'] === '3') ? 1 : 0) +
            (($item['field_7_parent'] === '2' || $item['field_7_parent'] === '3') ? 1 : 0);

        if($value !== 0){
           $value = $value * 7.14;
            if($value > 100){
                $value = 100;
            }
            return $value;
        } else {
            return 0;
        }
    }
}