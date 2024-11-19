<?php

namespace backend\modules\riskCommon\models;

use Yii;


class RiskQuestionnaireSix extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'risk_questionnaire_six';
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
                'estimation_chile',
            ], 'required'],
            [[
                'field_1_teacher',
                'field_2_teacher',
                'field_3_teacher',
                'field_4_teacher',
                'field_5_teacher',
                'field_6_teacher',

                'field_1_parent',
                'field_2_parent',
                'field_3_parent',
                'field_4_parent',
                'field_5_parent',
                'field_6_parent',

                'field_1_chile',
                'field_2_chile',
                'field_3_chile',
                'field_4_chile',
                'field_5_chile',
                'field_6_chile',
                'create_at',
            ], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'field_1_teacher' => '1. Агрессивное поведение родителей: ',
            'field_2_teacher' => '2. Агрессивное поведение учителей: ',
            'field_3_teacher' => '3. Агрессивное поведение сверстников: ',
            'field_4_teacher' => '4. Использование агрессивной информационной среды: ',
            'field_5_teacher' => '5. Использование агрессивной игровой среды: ',
            'field_6_teacher' => '6. Иные причины: ',

            'field_1_parent' => '1. Агрессивное поведение родителей: ',
            'field_2_parent' => '2. Агрессивное поведение учителей: ',
            'field_3_parent' => '3. Агрессивное поведение сверстников: ',
            'field_4_parent' => '4. Использование агрессивной информационной среды: ',
            'field_5_parent' => '5. Использование агрессивной игровой среды: ',
            'field_6_parent' => '6. Иные причины: ',

            'field_1_chile' => '1. Агрессивное поведение родителей: ',
            'field_2_chile' => '2. Агрессивное поведение учителей: ',
            'field_3_chile' => '3. Агрессивное поведение сверстников: ',
            'field_4_chile' => '4. Использование агрессивной информационной среды: ',
            'field_5_chile' => '5. Использование агрессивной игровой среды: ',
            'field_6_chile' => '6. Иные причины: ',
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
            (($item['field_1_parent'] === '1') ? 1 : 0) +
            (($item['field_2_parent'] === '1') ? 1 : 0) +
            (($item['field_3_parent'] === '1') ? 1 : 0) +
            (($item['field_4_parent'] === '1') ? 1 : 0) +
            (($item['field_5_parent'] === '1') ? 1 : 0) +
            (($item['field_6_parent'] === '1') ? 1 : 0) +
            (($item['field_1_chile'] === '1') ? 1 : 0) +
            (($item['field_2_chile'] === '1') ? 1 : 0) +
            (($item['field_3_chile'] === '1') ? 1 : 0) +
            (($item['field_4_chile'] === '1') ? 1 : 0) +
            (($item['field_5_chile'] === '1') ? 1 : 0) +
            (($item['field_6_chile'] === '1') ? 1 : 0);
        $value2 =
            (($item['field_1_teacher'] === '2') ? 1 : 0) +
            (($item['field_2_teacher'] === '2') ? 1 : 0) +
            (($item['field_3_teacher'] === '2') ? 1 : 0) +
            (($item['field_4_teacher'] === '2') ? 1 : 0) +
            (($item['field_5_teacher'] === '2') ? 1 : 0) +
            (($item['field_6_teacher'] === '2') ? 1 : 0) +
            (($item['field_1_parent'] === '2') ? 1 : 0) +
            (($item['field_2_parent'] === '2') ? 1 : 0) +
            (($item['field_3_parent'] === '2') ? 1 : 0) +
            (($item['field_4_parent'] === '2') ? 1 : 0) +
            (($item['field_5_parent'] === '2') ? 1 : 0) +
            (($item['field_6_parent'] === '2') ? 1 : 0) +
            (($item['field_1_chile'] === '2') ? 1 : 0) +
            (($item['field_2_chile'] === '2') ? 1 : 0) +
            (($item['field_3_chile'] === '2') ? 1 : 0) +
            (($item['field_4_chile'] === '2') ? 1 : 0) +
            (($item['field_5_chile'] === '2') ? 1 : 0) +
            (($item['field_6_chile'] === '2') ? 1 : 0);

        if($value1 === 0 && $value2 === 0 ){
            return 0;
        } else {
            $value1 = $value1 * 5.55;
            $value2 = $value2 * 2.77;
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
            (($item['field_6_teacher'] === '1') ? 1 : 0);
        $value2 =
            (($item['field_1_teacher'] === '2') ? 1 : 0) +
            (($item['field_2_teacher'] === '2') ? 1 : 0) +
            (($item['field_3_teacher'] === '2') ? 1 : 0) +
            (($item['field_4_teacher'] === '2') ? 1 : 0) +
            (($item['field_5_teacher'] === '2') ? 1 : 0) +
            (($item['field_6_teacher'] === '2') ? 1 : 0);

        if($value1 === 0 && $value2 === 0 ){
            return 0;
        } else {
            $value1 = $value1 * 5.55;
            $value2 = $value2 * 2.77;
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
            (($item['field_6_parent'] === '1') ? 1 : 0);
        $value2 =
            (($item['field_1_parent'] === '2') ? 1 : 0) +
            (($item['field_2_parent'] === '2') ? 1 : 0) +
            (($item['field_3_parent'] === '2') ? 1 : 0) +
            (($item['field_4_parent'] === '2') ? 1 : 0) +
            (($item['field_5_parent'] === '2') ? 1 : 0) +
            (($item['field_6_parent'] === '2') ? 1 : 0);

        if($value1 === 0 && $value2 === 0 ){
            return 0;
        } else {
            $value1 = $value1 * 5.55;
            $value2 = $value2 * 2.77;
            $valueSum = $value1 + $value2;
            if($valueSum > 100){
                $valueSum = 100;
            }
            return $valueSum;
        }
    }

    public function scoringScores_chile($item)
    {
        $value1 =
            (($item['field_1_chile'] === '1') ? 1 : 0) +
            (($item['field_2_chile'] === '1') ? 1 : 0) +
            (($item['field_3_chile'] === '1') ? 1 : 0) +
            (($item['field_4_chile'] === '1') ? 1 : 0) +
            (($item['field_5_chile'] === '1') ? 1 : 0) +
            (($item['field_6_chile'] === '1') ? 1 : 0);
        $value2 =
            (($item['field_1_chile'] === '2') ? 1 : 0) +
            (($item['field_2_chile'] === '2') ? 1 : 0) +
            (($item['field_3_chile'] === '2') ? 1 : 0) +
            (($item['field_4_chile'] === '2') ? 1 : 0) +
            (($item['field_5_chile'] === '2') ? 1 : 0) +
            (($item['field_6_chile'] === '2') ? 1 : 0);

        if($value1 === 0 && $value2 === 0 ){
            return 0;
        } else {
            $value1 = $value1 * 5.55;
            $value2 = $value2 * 2.77;
            $valueSum = $value1 + $value2;
            if($valueSum > 100){
                $valueSum = 100;
            }
            return $valueSum;
        }
    }
}