<?php

namespace backend\modules\riskCommon\models;

use Yii;


class RiskQuestionnaireThree extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'risk_questionnaire_three';
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
            'field_1_teacher' => '1. Учителя преимущественно обращаются к ребенку по имени: ',
            'field_2_teacher' => '2. Учителя объясняет новый материал на понятных примерах: ',
            'field_3_teacher' => '3. При объяснении нового материала ученик как правило испытывает интерес к процессу освоения новых знаний: ',
            'field_4_teacher' => '4. Перед контрольной работой большинство учителей, как правило, рассказывают о порядке проведения контрольной работы, структуре заданий, необходимых умениях для успешного решения: ',
            'field_5_teacher' => '5. При опросе ребенка учителя, как правило, не спрашивают его первым: ',
            'field_6_teacher' => '6. Учителя регулярно хвалят ребенка при всех, даже за небольшие успехи: ',
            'field_7_teacher' => '7. Учителя как правило, не акцентируют внимание коллектива на слабых сторонах ребенка: ',

            'field_1_parent' => '1. Учителя преимущественно обращаются ко мне по имени: ',
            'field_2_parent' => '2. Учителя объясняют новый материал на понятных мне примерах: ',
            'field_3_parent' => '3. При объяснении нового материала я как правило испытываю интерес к процессу освоения новых знаний: ',
            'field_4_parent' => '4. Перед контрольной работой большинство учителей, как правило, рассказывают о порядке проведения контрольной работы, структуре заданий, необходимых умениях для успешного решения: ',
            'field_5_parent' => '5. При опросе, учителя, как правило, не спрашивают меня первым: ',
            'field_6_parent' => '6. Учителя регулярно хвалят меня при всех, даже за небольшие успехи: ',
            'field_7_parent' => '7. Учителя как правило, не акцентируют внимание коллектива на моих слабых сторонах: ',
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
            (($item['field_1_teacher'] !== '') ? $item['field_1_teacher'] : 0) +
            (($item['field_2_teacher'] !== '') ? $item['field_2_teacher'] : 0) +
            (($item['field_3_teacher'] !== '') ? $item['field_3_teacher'] : 0) +
            (($item['field_4_teacher'] !== '') ? $item['field_4_teacher'] : 0) +
            (($item['field_5_teacher'] !== '') ? $item['field_5_teacher'] : 0) +
            (($item['field_6_teacher'] !== '') ? $item['field_6_teacher'] : 0) +
            (($item['field_7_teacher'] !== '') ? $item['field_7_teacher'] : 0) +
            (($item['field_1_parent'] !== '') ? $item['field_1_parent'] : 0) +
            (($item['field_2_parent'] !== '') ? $item['field_2_parent'] : 0) +
            (($item['field_3_parent'] !== '') ? $item['field_3_parent'] : 0) +
            (($item['field_4_parent'] !== '') ? $item['field_4_parent'] : 0) +
            (($item['field_5_parent'] !== '') ? $item['field_5_parent'] : 0) +
            (($item['field_6_parent'] !== '') ? $item['field_6_parent'] : 0) +
            (($item['field_7_parent'] !== '') ? $item['field_7_parent'] : 0);

        if($value !== 0){
            $value = $value * 3.57;
            if($value > 50){
                $value = 50;
            }
            return $value;
        } else {
            return 0;
        }
    }

    public function scoringScores_teacher($item)
    {
        $value =
            (($item['field_1_teacher'] !== '') ? $item['field_1_teacher'] : 0) +
            (($item['field_2_teacher'] !== '') ? $item['field_2_teacher'] : 0) +
            (($item['field_3_teacher'] !== '') ? $item['field_3_teacher'] : 0) +
            (($item['field_4_teacher'] !== '') ? $item['field_4_teacher'] : 0) +
            (($item['field_5_teacher'] !== '') ? $item['field_5_teacher'] : 0) +
            (($item['field_6_teacher'] !== '') ? $item['field_6_teacher'] : 0) +
            (($item['field_7_teacher'] !== '') ? $item['field_7_teacher'] : 0);

        if($value !== 0){
            $value = $value * 3.57;
            if($value > 50){
                $value = 50;
            }
            return $value;
        } else {
            return 0;
        }
    }

    public function scoringScores_parent($item)
    {
        $value =
            (($item['field_1_parent'] !== '') ? $item['field_1_parent'] : 0) +
            (($item['field_2_parent'] !== '') ? $item['field_2_parent'] : 0) +
            (($item['field_3_parent'] !== '') ? $item['field_3_parent'] : 0) +
            (($item['field_4_parent'] !== '') ? $item['field_4_parent'] : 0) +
            (($item['field_5_parent'] !== '') ? $item['field_5_parent'] : 0) +
            (($item['field_6_parent'] !== '') ? $item['field_6_parent'] : 0) +
            (($item['field_7_parent'] !== '') ? $item['field_7_parent'] : 0);

        if($value !== 0){
            $value = $value * 3.57;
            if($value > 50){
                $value = 50;
            }
            return $value;
        } else {
            return 0;
        }
    }
}