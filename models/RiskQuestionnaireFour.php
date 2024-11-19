<?php

namespace backend\modules\riskCommon\models;

use Yii;


class RiskQuestionnaireFour extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'risk_questionnaire_four';
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
                'estimation_chile',
                'estimation_parent',
            ], 'required'],
            [[
                'field_1_chile',
                'field_2_chile',
                'field_3_chile',
                'field_4_chile',
                'field_5_chile',
                'field_6_chile',
                'field_7_chile',
                'field_8_chile',
                'field_9_chile',
                'field_10_chile',



                'field_1_parent',
                'field_2_parent',
                'field_3_parent',
                'field_4_parent',
                'field_5_parent',
                'field_6_parent',
                'field_7_parent',
                'field_8_parent',
                'field_9_parent',
                'field_10_parent',
                'create_at',
            ], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'field_1_parent'  =>  '1. Родители как правило не повышают голос на ребенка при общении с ним: ',
            'field_2_parent'  =>  '2. Родители, как правило, заранее предупреждают ребенка о каких-либо изменениях в совместных планах: ',
            'field_3_parent'  =>  '3. Если ребенок, что-то не хочет делать, и поэтому опаздывает, родители его специально не поторапливают: ',
            'field_4_parent'  =>  '4. Родители всегда корректно отзываются об учителях, не давая им негативных оценок: ',
            'field_5_parent'  =>  '5. Родители не запрещают без всяких причин делать то, что разрешалось делать раньше: ',
            'field_6_parent'  =>  '6. Родители стараются помочь ребенку найти правильное решение в любой сложившейся ситуации: ',
            'field_7_parent'  =>  '7. У ребенка есть любимое занятие по душе: ',
            'field_8_parent'  =>  '8. Ребенок посещает кружок или спортивную секцию, где ему нравится заниматься: ',
            'field_9_parent'  =>  '9. Родители владеют навыками игр и упражнений для снятия тревожности: ',
            'field_10_parent' =>  '10. Родители умеют спокойно справляться с повышенной тревожностью ребенка: ',

            'field_1_chile'  =>  '1. Родители как правило не повышают голос на меня при общении: ',
            'field_2_chile'  =>  '2. Родители, как правило, заранее предупреждают меня о каких-либо изменениях в совместных планах: ',
            'field_3_chile'  =>  '3. Если я, что-то не хочу делать, и поэтому опаздываю, родители меня специально не поторапливают: ',
            'field_4_chile'  =>  '4. Родители всегда корректно отзываются об учителях, не давая им негативных оценок: ',
            'field_5_chile'  =>  '5. Родители не запрещают мне без всяких причин делать то, что разрешалось делать раньше: ',
            'field_6_chile'  =>  '6. Родители стараются помочь мне найти правильное решение в любой сложившейся ситуации: ',
            'field_7_chile'  =>  '7. У меня есть любимое занятие по душе: ',
            'field_8_chile'  =>  '8. Я посещаю кружок или спортивную секцию, где мне нравится заниматься: ',
            'field_9_chile'  =>  '9. Родители владеют навыками игр и упражнений для снятия тревожности: ',
            'field_10_chile' => '10. Родители умеют спокойно справляться с моей повышенной тревожностью: ',
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
            (($item['field_1_chile'] !== '') ? $item['field_1_chile'] : 0) +
            (($item['field_2_chile'] !== '') ? $item['field_2_chile'] : 0) +
            (($item['field_3_chile'] !== '') ? $item['field_3_chile'] : 0) +
            (($item['field_4_chile'] !== '') ? $item['field_4_chile'] : 0) +
            (($item['field_5_chile'] !== '') ? $item['field_5_chile'] : 0) +
            (($item['field_6_chile'] !== '') ? $item['field_6_chile'] : 0) +
            (($item['field_7_chile'] !== '') ? $item['field_7_chile'] : 0) +
            (($item['field_8_chile'] !== '') ? $item['field_8_chile'] : 0) +
            (($item['field_9_chile'] !== '') ? $item['field_9_chile'] : 0) +
            (($item['field_10_chile'] !== '') ? $item['field_10_chile'] : 0) +
            (($item['field_1_parent'] !== '') ? $item['field_1_parent'] : 0) +
            (($item['field_2_parent'] !== '') ? $item['field_2_parent'] : 0) +
            (($item['field_3_parent'] !== '') ? $item['field_3_parent'] : 0) +
            (($item['field_4_parent'] !== '') ? $item['field_4_parent'] : 0) +
            (($item['field_5_parent'] !== '') ? $item['field_5_parent'] : 0) +
            (($item['field_6_parent'] !== '') ? $item['field_6_parent'] : 0) +
            (($item['field_7_parent'] !== '') ? $item['field_7_parent'] : 0) +
            (($item['field_8_parent'] !== '') ? $item['field_8_parent'] : 0) +
            (($item['field_9_parent'] !== '') ? $item['field_9_parent'] : 0) +
            (($item['field_10_parent'] !== '') ? $item['field_10_parent'] : 0);

        if($value !== 0){
            $value = $value * 2.5;
            if($value > 50){
                $value = 50;
            }
            return $value;
        } else {
            return 0;
        }
    }

    public function scoringScores_chile($item)
    {
        $value =
            (($item['field_1_chile'] !== '') ? $item['field_1_chile'] : 0) +
            (($item['field_2_chile'] !== '') ? $item['field_2_chile'] : 0) +
            (($item['field_3_chile'] !== '') ? $item['field_3_chile'] : 0) +
            (($item['field_4_chile'] !== '') ? $item['field_4_chile'] : 0) +
            (($item['field_5_chile'] !== '') ? $item['field_5_chile'] : 0) +
            (($item['field_6_chile'] !== '') ? $item['field_6_chile'] : 0) +
            (($item['field_7_chile'] !== '') ? $item['field_7_chile'] : 0) +
            (($item['field_8_chile'] !== '') ? $item['field_8_chile'] : 0) +
            (($item['field_9_chile'] !== '') ? $item['field_9_chile'] : 0) +
            (($item['field_10_chile'] !== '') ? $item['field_10_chile'] : 0);

        if($value !== 0){
            $value = $value * 2.5;
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
            (($item['field_7_parent'] !== '') ? $item['field_7_parent'] : 0) +
            (($item['field_8_parent'] !== '') ? $item['field_8_parent'] : 0) +
            (($item['field_9_parent'] !== '') ? $item['field_9_parent'] : 0) +
            (($item['field_10_parent'] !== '') ? $item['field_10_parent'] : 0);

        if($value !== 0){
            $value = $value * 2.5;
            if($value > 50){
                $value = 50;
            }
            return $value;
        } else {
            return 0;
        }
    }
}