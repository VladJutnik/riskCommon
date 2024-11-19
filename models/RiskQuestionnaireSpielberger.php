<?php

namespace backend\modules\riskCommon\models;

use Yii;


class RiskQuestionnaireSpielberger extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'risk_questionnaire_spielberger';
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
                'rt',
                'lt',
            ], 'required'],
            [[
                'field_1',
                'field_2',
                'field_3',
                'field_4',
                'field_5',
                'field_6',
                'field_7',
                'field_8',
                'field_9',
                'field_10',
                'field_11',
                'field_12',
                'field_13',
                'field_14',
                'field_15',
                'field_16',
                'field_17',
                'field_18',
                'field_19',
                'field_20',
                'field_21',
                'field_22',
                'field_23',
                'field_24',
                'field_25',
                'field_26',
                'field_27',
                'field_28',
                'field_29',
                'field_30',
                'field_31',
                'field_32',
                'field_33',
                'field_34',
                'field_35',
                'field_36',
                'field_37',
                'field_38',
                'field_39',
                'field_40',
                'create_at',
            ], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'field_1' =>  '1. Я спокоен: ',
            'field_2' =>  '2. Мне ничто не угрожает: ',
            'field_3' =>  '3. Я нахожусь в напряжении: ',
            'field_4' =>  '4. Я испытываю сожаление: ',
            'field_5' =>  '5. Я чувствую себя свободно: ',
            'field_6' =>  '6. Я расстроен: ',
            'field_7' =>  '7. Меня волнуют возможные неудачи: ',
            'field_8' =>  '8. Я чувствую себя отдохнувшим: ',
            'field_9' =>  '9. Я не доволен собой: ',
            'field_10' => '10. Я испытываю чувство внутреннего удовлетворения: ',
            'field_11' => '11. Я уверен в себе: ',
            'field_12' => '12. Я нервничаю: ',
            'field_13' => '13. Я не нахожу себе места: ',
            'field_14' => '14. Я взвинчен: ',
            'field_15' => '15. Я не чувствую скованности, напряженности: ',
            'field_16' => '16. Я доволен: ',
            'field_17' => '17. Я озабочен: ',
            'field_18' => '18. Я слишком возбужден и мне не по себе: ',
            'field_19' => '19. Мне радостно: ',
            'field_20' => '20. Мне приятно: ',
            'field_21' => '21. Я испытываю удовольствие: ',
            'field_22' => '22. Я очень быстро устаю: ',
            'field_23' => '23. Я легко могу заплакать: ',
            'field_24' => '24. Я хотел бы быть таким же счастливым, как и другие: ',
            'field_25' => '25. Я проигрываю потому, что недостаточно быстро принимаю решения: ',
            'field_26' => '26. Обычно я чувствую себя бодрым: ',
            'field_27' => '27. Я спокоен, хладнокровен и собран: ',
            'field_28' => '28. Ожидаемые трудности обычно тревожат меня: ',
            'field_29' => '29. Я слишком переживаю из-за пустяков: ',
            'field_30' => '30. Я вполне счастлив: ',
            'field_31' => '31. Я принимаю все слишком близко к сердцу: ',
            'field_32' => '32. Мне не хватает уверенности в себе: ',
            'field_33' => '33. Обычно я чувствую себя в безопасности: ',
            'field_34' => '34. Я стараюсь избегать критических ситуаций: ',
            'field_35' => '35. У меня бывает хандра: ',
            'field_36' => '36. Я доволен: ',
            'field_37' => '37. Всякие пустяки отвлекают и волнуют меня: ',
            'field_38' => '38. Я так сильно переживаю свои разочарования, что потом долго не могу о них забыть: ',
            'field_39' => '39. Я уравновешенный человек: ',
            'field_40' => '40. Меня охватывает сильное беспокойство, когда я думаю о своих делах и заботах: ',
        ];
    }

    public function decodingValues($id = '100')
    {
        $item = [
            '' => '',
            '1' => 'A - нет, это не так ',
            '2' => 'B - пожалуй, так',
            '3' => 'C - верно',
            '4' => 'D - совершенно верно',
        ];
        return ($id != '100') ? $item[$id] : $item;
    }

    public function scoringScores($item)
    {
        $RTArray1 = [
            $item['field_3'],
            $item['field_4'],
            $item['field_6'],
            $item['field_7'],
            $item['field_9'],
            $item['field_12'],
            $item['field_13'],
            $item['field_14'],
            $item['field_17'],
            $item['field_18'],
        ];
        $RTArray2 = [
            $item['field_1'],
            $item['field_2'],
            $item['field_5'],
            $item['field_8'],
            $item['field_10'],
            $item['field_11'],
            $item['field_15'],
            $item['field_16'],
            $item['field_19'],
            $item['field_20'],
        ];

        $LTArray1 = [
            $item['field_22'],
            $item['field_23'],
            $item['field_24'],
            $item['field_25'],
            $item['field_28'],
            $item['field_29'],
            $item['field_31'],
            $item['field_32'],
            $item['field_34'],
            $item['field_37'],
            $item['field_38'],
            $item['field_40'],
        ];
        $LTArray2 = [
            $item['field_21'],
            $item['field_26'],
            $item['field_27'],
            $item['field_30'],
            $item['field_33'],
            $item['field_36'],
            $item['field_39'],
        ];

        $RTSum1 = array_sum($RTArray1);
        $RTSum2 = array_sum($RTArray2);

        $LTSum1 = array_sum($LTArray1);
        $LTSum2 = array_sum($LTArray2);

        $RTvalue1 = $RTSum1 - $RTSum2 + 35;
        $LTvalue2 = $LTSum1 - $LTSum2 + 35;
        return [
            'RTvalue1' => $RTvalue1,
            'LTvalue2' => $LTvalue2,
        ];
    }
}