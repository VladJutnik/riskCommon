<?php

namespace backend\modules\riskCommon\models;

use Yii;


class RiskQuestionnaireTwo extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'risk_questionnaire_two';
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
                'field_7_teacher',
                'field_8_teacher',
                'field_1_parent',
                'field_2_parent',
                'field_3_parent',
                'field_4_parent',
                'field_5_parent',
                'field_6_parent',
                'field_7_parent',
                'field_8_parent',
                'field_1_chile',
                'field_2_chile',
                'field_3_chile',
                'field_4_chile',
                'field_5_chile',
                'field_6_chile',
                'field_7_chile',
                'field_8_chile',
                'create_at',
            ], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'field_1_teacher' => '1. Завышенные требования учителей, не адекватные возможностям: ',
            'field_2_teacher' => '2. Завышенные требования родителей, не адекватные возможностям: ',
            'field_3_teacher' => '3. Грубость и приказной тон в общении со стороны учителей: ',
            'field_4_teacher' => '4. Грубость и приказной тон в общении со стороны родителей (законных представителей): ',
            'field_5_teacher' => '5. Грубость и приказной тон в общении со сверстниками: ',
            'field_6_teacher' => '6. Противоречивость предъявляемых к ребенку требований со стороны учителей: ',
            'field_7_teacher' => '7. Противоречивость предъявляемых к ребенку требований со стороны родителей (законных представителей): ',
            'field_8_teacher' => '8. Иные причины: ',

            'field_1_parent' => '1. Завышенные требования учителей, не адекватные возможностям: ',
            'field_2_parent' => '2. Завышенные требования родителей, не адекватные возможностям: ',
            'field_3_parent' => '3. Грубость и приказной тон в общении со стороны учителей: ',
            'field_4_parent' => '4. Грубость и приказной тон в общении со стороны родителей (законных представителей): ',
            'field_5_parent' => '5. Грубость и приказной тон в общении со сверстниками: ',
            'field_6_parent' => '6. Противоречивость предъявляемых к ребенку требований со стороны учителей: ',
            'field_7_parent' => '7. Противоречивость предъявляемых к ребенку требований со стороны родителей (законных представителей): ',
            'field_8_parent' => '8. Иные причины: ',

            'field_1_chile' => '1. Завышенные требования учителей, не адекватные возможностям: ',
            'field_2_chile' => '2. Завышенные требования родителей, не адекватные возможностям: ',
            'field_3_chile' => '3. Грубость и приказной тон в общении со стороны учителей: ',
            'field_4_chile' => '4. Грубость и приказной тон в общении со стороны родителей (законных представителей): ',
            'field_5_chile' => '5. Грубость и приказной тон в общении со сверстниками: ',
            'field_6_chile' => '6. Противоречивость предъявляемых к ребенку требований со стороны учителей: ',
            'field_7_chile' => '7. Противоречивость предъявляемых к ребенку требований со стороны родителей (законных представителей): ',
            'field_8_chile' => '8. Иные причины: ',
        ];
    }

    public function decodingValues($id = '100')
    {
        $item = [
            '' => '',
            '1' => 'да',
            '0' => 'нет',
        ];
        return ($id != '100') ? $item[$id] : $item;
    }

    public function scoringScores($item)
    {
        $value =
            (($item['field_1_teacher'] !== ''  && $item['field_1_teacher'] !== '0') ? 1 : 0) +
            (($item['field_2_teacher'] !== ''  && $item['field_2_teacher'] !== '0') ? 1 : 0) +
            (($item['field_3_teacher'] !== ''  && $item['field_3_teacher'] !== '0') ? 1 : 0) +
            (($item['field_4_teacher'] !== ''  && $item['field_4_teacher'] !== '0') ? 1 : 0) +
            (($item['field_5_teacher'] !== ''  && $item['field_5_teacher'] !== '0') ? 1 : 0) +
            (($item['field_6_teacher'] !== ''  && $item['field_6_teacher'] !== '0') ? 1 : 0) +
            (($item['field_7_teacher'] !== ''  && $item['field_7_teacher'] !== '0') ? 1 : 0) +
            (($item['field_8_teacher'] !== ''  && $item['field_8_teacher'] !== '0') ? 1 : 0) +
            (($item['field_1_parent'] !== ''  && $item['field_1_parent'] !== '0') ? 1 : 0) +
            (($item['field_2_parent'] !== ''  && $item['field_2_parent'] !== '0') ? 1 : 0) +
            (($item['field_3_parent'] !== ''  && $item['field_3_parent'] !== '0') ? 1 : 0) +
            (($item['field_4_parent'] !== ''  && $item['field_4_parent'] !== '0') ? 1 : 0) +
            (($item['field_5_parent'] !== ''  && $item['field_5_parent'] !== '0') ? 1 : 0) +
            (($item['field_6_parent'] !== ''  && $item['field_6_parent'] !== '0') ? 1 : 0) +
            (($item['field_7_parent'] !== ''  && $item['field_7_parent'] !== '0') ? 1 : 0) +
            (($item['field_8_parent'] !== ''  && $item['field_8_parent'] !== '0') ? 1 : 0) +
            (($item['field_1_chile'] !== ''  && $item['field_1_chile'] !== '0') ? 1 : 0) +
            (($item['field_2_chile'] !== ''  && $item['field_2_chile'] !== '0') ? 1 : 0) +
            (($item['field_3_chile'] !== ''  && $item['field_3_chile'] !== '0') ? 1 : 0) +
            (($item['field_4_chile'] !== ''  && $item['field_4_chile'] !== '0') ? 1 : 0) +
            (($item['field_5_chile'] !== ''  && $item['field_5_chile'] !== '0') ? 1 : 0) +
            (($item['field_6_chile'] !== ''  && $item['field_6_chile'] !== '0') ? 1 : 0) +
            (($item['field_7_chile'] !== ''  && $item['field_7_chile'] !== '0') ? 1 : 0) +
            (($item['field_8_chile'] !== ''  && $item['field_8_chile'] !== '0') ? 1 : 0);

        if($value !== 0){
            $value = $value * 4.16;
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
            (($item['field_1_teacher'] !== ''  && $item['field_1_teacher'] !== '0') ? 1 : 0) +
            (($item['field_2_teacher'] !== ''  && $item['field_2_teacher'] !== '0') ? 1 : 0) +
            (($item['field_3_teacher'] !== ''  && $item['field_3_teacher'] !== '0') ? 1 : 0) +
            (($item['field_4_teacher'] !== ''  && $item['field_4_teacher'] !== '0') ? 1 : 0) +
            (($item['field_5_teacher'] !== ''  && $item['field_5_teacher'] !== '0') ? 1 : 0) +
            (($item['field_6_teacher'] !== ''  && $item['field_6_teacher'] !== '0') ? 1 : 0) +
            (($item['field_7_teacher'] !== ''  && $item['field_7_teacher'] !== '0') ? 1 : 0) +
            (($item['field_8_teacher'] !== ''  && $item['field_8_teacher'] !== '0') ? 1 : 0);


        if($value !== 0){
            $value = $value * 4.16;
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
            (($item['field_1_parent'] !== ''  && $item['field_1_parent'] !== '0') ? 1 : 0) +
            (($item['field_2_parent'] !== ''  && $item['field_2_parent'] !== '0') ? 1 : 0) +
            (($item['field_3_parent'] !== ''  && $item['field_3_parent'] !== '0') ? 1 : 0) +
            (($item['field_4_parent'] !== ''  && $item['field_4_parent'] !== '0') ? 1 : 0) +
            (($item['field_5_parent'] !== ''  && $item['field_5_parent'] !== '0') ? 1 : 0) +
            (($item['field_6_parent'] !== ''  && $item['field_6_parent'] !== '0') ? 1 : 0) +
            (($item['field_7_parent'] !== ''  && $item['field_7_parent'] !== '0') ? 1 : 0) +
            (($item['field_8_parent'] !== ''  && $item['field_8_parent'] !== '0') ? 1 : 0);

        if($value !== 0){
            $value = $value * 4.16;
            if($value > 100){
                $value = 100;
            }
            return $value;
        } else {
            return 0;
        }
    }

    public function scoringScores_chile($item)
    {
        $value =
            (($item['field_1_chile'] !== ''  && $item['field_1_chile'] !== '0') ? 1 : 0) +
            (($item['field_2_chile'] !== ''  && $item['field_2_chile'] !== '0') ? 1 : 0) +
            (($item['field_3_chile'] !== ''  && $item['field_3_chile'] !== '0') ? 1 : 0) +
            (($item['field_4_chile'] !== ''  && $item['field_4_chile'] !== '0') ? 1 : 0) +
            (($item['field_5_chile'] !== ''  && $item['field_5_chile'] !== '0') ? 1 : 0) +
            (($item['field_6_chile'] !== ''  && $item['field_6_chile'] !== '0') ? 1 : 0) +
            (($item['field_7_chile'] !== ''  && $item['field_7_chile'] !== '0') ? 1 : 0) +
            (($item['field_8_chile'] !== ''  && $item['field_8_chile'] !== '0') ? 1 : 0);

        if($value !== 0){
            $value = $value * 4.16;
            if($value > 100){
                $value = 100;
            }
            return $value;
        } else {
            return 0;
        }
    }
}