<?php

namespace backend\modules\riskCommon\models;

use Yii;


class RiskQuestionnaireFive extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'risk_questionnaire_five';
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
            'field_1_teacher' => '1. Физическая агрессия к сверстникам (стремление причинить вред с помощью силы): ',
            'field_2_teacher' => '2. Физическая агрессия к учителям: ',
            'field_3_teacher' => '3. Физическая агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам: ',
            'field_4_teacher' => '4. Вербальная агрессия к сверстникам (через угрозы и оскорбления): ',
            'field_5_teacher' => '5. Вербальная агрессия к учителям: ',
            'field_6_teacher' => '6. Вербальная агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам: ',
            'field_7_teacher' => '7. Экспрессивная агрессию через угрожающие жесты, интонацию и мимику в отношении сверстников и (или) учителей и (или) родителей-законных представителей: ',

            'field_1_parent' => '1. Физическая агрессия к сверстникам (стремление причинить вред с помощью силы): ',
            'field_2_parent' => '2. Физическая агрессия к учителям: ',
            'field_3_parent' => '3. Физическая агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам: ',
            'field_4_parent' => '4. Вербальная агрессия к сверстникам (через угрозы и оскорбления): ',
            'field_5_parent' => '5. Вербальная агрессия к учителям: ',
            'field_6_parent' => '6. Вербальная агрессия к родителям (законным представителям), дедушкам, бабушкам, братьям, сестрам: ',
            'field_7_parent' => '7. Экспрессивная агрессию через угрожающие жесты, интонацию и мимику в отношении сверстников и (или) учителей и (или) родителей-законных представителей: ',
        ];
    }

    public function decodingValues($id = '100')
    {
        $item = [
            '' => '',
            '1' => 'да',
            '0' => 'нет',
            '2' => 'затрудняюсь с ответом',
        ];
        return ($id != '100') ? $item[$id] : $item;
    }

    public function scoringScores($item)
    {
        $value1 =
            (($item['field_1_teacher'] === '1') ? 1 : 0) +
            (($item['field_2_teacher'] === '1') ? 1 : 0) +
            (($item['field_3_teacher'] === '1') ? 1 : 0) +
            (($item['field_4_teacher'] === '1') ? 1 : 0) +
            (($item['field_5_teacher'] === '1') ? 1 : 0) +
            (($item['field_6_teacher'] === '1') ? 1 : 0) +
            (($item['field_7_teacher'] === '1') ? 1 : 0) +
            (($item['field_1_parent'] === '1') ? 1 : 0) +
            (($item['field_2_parent'] === '1') ? 1 : 0) +
            (($item['field_3_parent'] === '1') ? 1 : 0) +
            (($item['field_4_parent'] === '1') ? 1 : 0) +
            (($item['field_5_parent'] === '1') ? 1 : 0) +
            (($item['field_6_parent'] === '1') ? 1 : 0) +
            (($item['field_7_parent'] === '1') ? 1 : 0);

        $value2 =
            (($item['field_1_teacher'] === '2') ? 1 : 0) +
            (($item['field_2_teacher'] === '2') ? 1 : 0) +
            (($item['field_3_teacher'] === '2') ? 1 : 0) +
            (($item['field_4_teacher'] === '2') ? 1 : 0) +
            (($item['field_5_teacher'] === '2') ? 1 : 0) +
            (($item['field_6_teacher'] === '2') ? 1 : 0) +
            (($item['field_7_teacher'] === '2') ? 1 : 0) +
            (($item['field_1_parent'] === '2') ? 1 : 0) +
            (($item['field_2_parent'] === '2') ? 1 : 0) +
            (($item['field_3_parent'] === '2') ? 1 : 0) +
            (($item['field_4_parent'] === '2') ? 1 : 0) +
            (($item['field_5_parent'] === '2') ? 1 : 0) +
            (($item['field_6_parent'] === '2') ? 1 : 0) +
            (($item['field_7_parent'] === '2') ? 1 : 0);

        if($value1 === 0 && $value2 === 0 ){
            return 0;
        } else {
            $value1 = $value1 * 7.14;
            $value2 = $value2 * 3.57;
            $valueSum = $value1 + $value2;
            if($valueSum > 100){
                $valueSum = 100;
            }
            return $valueSum;
        }
    }

    public function scoringScores_teacher($item)
    {
        $value1 =
            (($item['field_1_teacher'] === '1') ? 1 : 0) +
            (($item['field_2_teacher'] === '1') ? 1 : 0) +
            (($item['field_3_teacher'] === '1') ? 1 : 0) +
            (($item['field_4_teacher'] === '1') ? 1 : 0) +
            (($item['field_5_teacher'] === '1') ? 1 : 0) +
            (($item['field_6_teacher'] === '1') ? 1 : 0) +
            (($item['field_7_teacher'] === '1') ? 1 : 0) ;

        $value2 =
            (($item['field_1_teacher'] === '2') ? 1 : 0) +
            (($item['field_2_teacher'] === '2') ? 1 : 0) +
            (($item['field_3_teacher'] === '2') ? 1 : 0) +
            (($item['field_4_teacher'] === '2') ? 1 : 0) +
            (($item['field_5_teacher'] === '2') ? 1 : 0) +
            (($item['field_6_teacher'] === '2') ? 1 : 0) +
            (($item['field_7_teacher'] === '2') ? 1 : 0);

        if($value1 === 0 && $value2 === 0 ){
            return 0;
        } else {
            $value1 = $value1 * 7.14;
            $value2 = $value2 * 3.57;
            $valueSum = $value1 + $value2;
            if($valueSum > 100){
                $valueSum = 100;
            }
            return $valueSum;
        }
    }

    public function scoringScores_parent($item)
    {
        $value1 =
            (($item['field_1_parent'] === '1') ? 1 : 0) +
            (($item['field_2_parent'] === '1') ? 1 : 0) +
            (($item['field_3_parent'] === '1') ? 1 : 0) +
            (($item['field_4_parent'] === '1') ? 1 : 0) +
            (($item['field_5_parent'] === '1') ? 1 : 0) +
            (($item['field_6_parent'] === '1') ? 1 : 0) +
            (($item['field_7_parent'] === '1') ? 1 : 0);

        $value2 =
            (($item['field_1_parent'] === '2') ? 1 : 0) +
            (($item['field_2_parent'] === '2') ? 1 : 0) +
            (($item['field_3_parent'] === '2') ? 1 : 0) +
            (($item['field_4_parent'] === '2') ? 1 : 0) +
            (($item['field_5_parent'] === '2') ? 1 : 0) +
            (($item['field_6_parent'] === '2') ? 1 : 0) +
            (($item['field_7_parent'] === '2') ? 1 : 0);

        if($value1 === 0 && $value2 === 0 ){
            return 0;
        } else {
            $value1 = $value1 * 7.14;
            $value2 = $value2 * 3.57;
            $valueSum = $value1 + $value2;
            if($valueSum > 100){
                $valueSum = 100;
            }
            return $valueSum;
        }
    }
}