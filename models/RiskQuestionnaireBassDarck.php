<?php

namespace backend\modules\riskCommon\models;

use Yii;


class RiskQuestionnaireBassDarck extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'risk_questionnaire_bass_darck';
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
                'physical_aggression_1',
                'indirect_aggression_2',
                'irritation_3',
                'negativism_4',
                'resentment_5',
                'suspicion_6',
                'verbal_aggression_7',
                'feeling_guilty_8',
                'aggressiveness_index',
                'includes_index',
                'result_aggressiveness',
                'result_hostility',
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
                'field_41',
                'field_42',
                'field_43',
                'field_44',
                'field_45',
                'field_46',
                'field_47',
                'field_48',
                'field_49',
                'field_50',
                'field_51',
                'field_52',
                'field_53',
                'field_54',
                'field_55',
                'field_56',
                'field_57',
                'field_58',
                'field_59',
                'field_60',
                'field_61',
                'field_62',
                'field_63',
                'field_64',
                'field_65',
                'field_66',
                'field_67',
                'field_68',
                'field_69',
                'field_70',
                'field_71',
                'field_72',
                'field_73',
                'field_74',
                'field_75',
                'create_at',
            ], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'field_1' =>   '1. Временами я не могу справиться с желанием причинить вред другим: ',
            'field_2' =>   '2. Иногда сплетничаю о людях, которых не люблю: ',
            'field_3' =>   '3. Я легко раздражаюсь, но быстро успокаиваюсь: ',
            'field_4' =>   '4. Если меня не попросят по-хорошему, я не выполню: ',
            'field_5' =>   '5. Я не всегда получаю то, что мне положено: ',
            'field_6' =>   '6. Я не знаю, что люди говорят обо мне за моей спиной: ',
            'field_7' =>   '7. Если я не одобряю поведение друзей, я даю им это почувствовать: ',
            'field_8' =>   '8. Когда мне случалось обмануть кого-нибудь, я испытывал мучительные угрызения совести: ',
            'field_9' =>   '9. Мне кажется, что я не способен ударить человека: ',
            'field_10' =>  '10.	Я никогда не раздражаюсь настолько, чтобы кидаться предметами: ',
            'field_11' =>  '11.	Я всегда снисходителен к чужим недостаткам: ',
            'field_12' =>  '12.	Если мне не нравится установленное правило, мне хочется нарушить его: ',
            'field_13' =>  '13.	Другие умеют почти всегда пользоваться благоприятными обстоятельствами: ',
            'field_14' =>  '14.	Я держусь настороженно с людьми, которые относятся ко мне несколько более дружественно, чем я ожидал: ',
            'field_15' =>  '15.	Я часто бываю несогласен с людьми: ',
            'field_16' =>  '16.	Иногда мне на ум приходят мысли, которых я стыжусь: ',
            'field_17' =>  '17.	Если кто-нибудь первым ударит меня, я не отвечу ему: ',
            'field_18' =>  '18.	Когда я раздражаюсь, я хлопаю дверями: ',
            'field_19' =>  '19.	Я гораздо более раздражителен, чем кажется: ',
            'field_20' =>  '20.	Если кто-то воображает себя начальником, я всегда поступаю ему наперекор: ',
            'field_21' =>  '21.	Меня немного огорчает моя судьба: ',
            'field_22' =>  '22.	Я думаю, что многие люди не любят меня: ',
            'field_23' =>  '23.	Я не могу удержаться от спора, если люди не согласны со мной: ',
            'field_24' =>  '24.	Люди, увиливающие от работы, должны испытывать чувство вины: ',
            'field_25' =>  '25.	Тот, кто оскорбляет меня и мою семью, напрашивается на драку: ',
            'field_26' =>  '26.	Я не способен на грубые шутки: ',
            'field_27' =>  '27.	Меня охватывает ярость, когда надо мной насмехаются: ',
            'field_28' =>  '28.	Когда люди строят из себя начальников, я делаю все, чтобы они не зазнавались: ',
            'field_29' =>  '29.	Почти каждую неделю я вижу кого-нибудь, кто мне не нравится: ',
            'field_30' =>  '30.	Довольно многие люди завидуют мне: ',
            'field_31' =>  '31.	Я требую, чтобы люди уважали меня: ',
            'field_32' =>  '32.	Меня угнетает то, что я мало делаю для своих родителей: ',
            'field_33' =>  '33.	Люди, которые постоянно изводят вас, стоят того, чтобы их "щелкнули по носу": ',
            'field_34' =>  '34.	Я никогда не бываю мрачен от злости: ',
            'field_35' =>  '35.	Если ко мне относятся хуже, чем я того заслуживаю, я не расстраиваюсь: ',
            'field_36' =>  '36.	Если кто-то выводит меня из себя, я не обращаю внимания: ',
            'field_37' =>  '37.	Хотя я и не показываю этого, меня иногда гложет зависть: ',
            'field_38' =>  '38.	Иногда мне кажется, что надо мной смеются: ',
            'field_39' =>  '39.	Даже если я злюсь, я не прибегаю к "сильным" выражениям: ',
            'field_40' =>  '40.	Мне хочется, чтобы мои грехи были прощены: ',
            'field_41' =>  '41.	Я редко даю сдачи, даже если кто-нибудь ударит меня: ',
            'field_42' =>  '42.	Когда получается не, по-моему, я иногда обижаюсь: ',
            'field_43' =>  '43.	Иногда люди раздражают меня одним своим присутствием: ',
            'field_44' =>  '44.	Нет людей, которых бы я по-настоящему ненавидел: ',
            'field_45' =>  '45.	Мой принцип: "Никогда не доверять "чужакам": ',
            'field_46' =>  '46.	Если кто-нибудь раздражает меня, я готов сказать, что я о нем думаю: ',
            'field_47' =>  '47.	Я делаю много такого, о чем впоследствии жалею: ',
            'field_48' =>  '48.	Если я разозлюсь, я могу ударить кого-нибудь: ',
            'field_49' =>  '49.	С детства я никогда не проявлял вспышек гнева: ',
            'field_50' =>  '50.	Я часто чувствую себя как пороховая бочка, готовая взорваться: ',
            'field_51' =>  '51.	Если бы все знали, что я чувствую, меня бы считали человеком, с которым нелегко работать: ',
            'field_52' =>  '52.	Я всегда думаю о том, какие тайные причины заставляют людей делать что-нибудь приятное для меня: ',
            'field_53' =>  '53.	Когда на меня кричат, я начинаю кричать в ответ: ',
            'field_54' =>  '54.	Неудачи огорчают меня: ',
            'field_55' =>  '55.	Я дерусь не реже и не чаще чем другие: ',
            'field_56' =>  '56.	Я могу вспомнить случаи, когда я был настолько зол, что хватал попавшуюся мне под руку вещь и ломал ее: ',
            'field_57' =>  '57.	Иногда я чувствую, что готов первым начать драку: ',
            'field_58' =>  '58.	Иногда я чувствую, что жизнь поступает со мной несправедливо: ',
            'field_59' =>  '59.	Раньше я думал, что большинство людей говорит правду, но теперь я в это не верю: ',
            'field_60' =>  '60.	Я ругаюсь только со злости: ',
            'field_61' =>  '61.	Когда я поступаю неправильно, меня мучает совесть: ',
            'field_62' =>  '62.	Если для защиты своих прав мне нужно применить физическую силу, я применяю ее: ',
            'field_63' =>  '63.	Иногда я выражаю свой гнев тем, что стучу кулаком по столу: ',
            'field_64' =>  '64.	Я бываю грубоват по отношению к людям, которые мне не нравятся: ',
            'field_65' =>  '65.	У меня нет врагов, которые бы хотели мне навредить: ',
            'field_66' =>  '66.	Я не умею поставить человека на место, даже если он того заслуживает: ',
            'field_67' =>  '67.	Я часто думаю, что жил неправильно: ',
            'field_68' =>  '68.	Я знаю людей, которые способны довести меня до драки: ',
            'field_69' =>  '69.	Я не огорчаюсь из-за мелочей: ',
            'field_70' =>  '70.	Мне редко приходит в голову, что люди пытаются разозлить или оскорбить меня: ',
            'field_71' =>  '71.	Я часто только угрожаю людям, хотя и не собираюсь приводить угрозы в исполнение: ',
            'field_72' =>  '72.	В последнее время я стал занудой: ',
            'field_73' =>  '73.	В споре я часто повышаю голос: ',
            'field_74' =>  '74.	Я стараюсь обычно скрывать свое плохое отношение к людям: ',
            'field_75' =>  '75.	Я лучше соглашусь с чем-либо, чем стану спорить: ',
        ];
    }

    public function decodingValues($id = '100')
    {
        $item = [
            '' => '',
            'da' => 'да',
            'net' => 'нет',
        ];
        return ($id != '100') ? $item[$id] : $item;
    }

    public function scoringScores($item)
    {
        $arrValueBassDarck = [];

        //da net field_1
        //physical_aggression_1!
        $arr_physic_da = [
            ($item['field_1'] === 'da') ? 1 : 0,
            ($item['field_25'] === 'da') ? 1 : 0,
            ($item['field_33'] === 'da') ? 1 : 0,
            ($item['field_48'] === 'da') ? 1 : 0,
            ($item['field_55'] === 'da') ? 1 : 0,
            ($item['field_62'] === 'da') ? 1 : 0,
            ($item['field_68'] === 'da') ? 1 : 0,
        ];
        $arr_physic_net = [
            ($item['field_9'] === 'net') ? 1 : 0,
            ($item['field_17'] === 'net') ? 1 : 0,
            ($item['field_41'] === 'net') ? 1 : 0,
        ];
        //indirect_aggression_2!
        $arr_indir_da = [
            ($item['field_2'] === 'da') ? 1 : 0,
            ($item['field_18'] === 'da') ? 1 : 0,
            ($item['field_34'] === 'da') ? 1 : 0,
            ($item['field_42'] === 'da') ? 1 : 0,
            ($item['field_56'] === 'da') ? 1 : 0,
            ($item['field_63'] === 'da') ? 1 : 0,
        ];
        $arr_indi_net = [
            ($item['field_10'] === 'net') ? 1 : 0,
            ($item['field_26'] === 'net') ? 1 : 0,
            ($item['field_49'] === 'net') ? 1 : 0,
        ];
        //irritation_3
        $arr_irrit_da = [
            ($item['field_3'] === 'da') ? 1 : 0,
            ($item['field_19'] === 'da') ? 1 : 0,
            ($item['field_27'] === 'da') ? 1 : 0,
            ($item['field_43'] === 'da') ? 1 : 0,
            ($item['field_50'] === 'da') ? 1 : 0,
            ($item['field_57'] === 'da') ? 1 : 0,
            ($item['field_64'] === 'da') ? 1 : 0,
            ($item['field_72'] === 'da') ? 1 : 0,
        ];
        $arr_irrit_net = [
            ($item['field_11'] === 'net') ? 1 : 0,
            ($item['field_35'] === 'net') ? 1 : 0,
            ($item['field_69'] === 'net') ? 1 : 0,
        ];
        //negativism_4
        $arr_negat_da = [
            ($item['field_4'] === 'da') ? 1 : 0,
            ($item['field_12'] === 'da') ? 1 : 0,
            ($item['field_20'] === 'da') ? 1 : 0,
            ($item['field_23'] === 'da') ? 1 : 0,
            ($item['field_36'] === 'da') ? 1 : 0,
        ];
        $arr_negat_net = [
            //($item['field_36'] === 'net') ? 1 : 0,
        ];
        //resentment_5!
        $arr_resent_da = [
            ($item['field_5'] === 'da') ? 1 : 0,
            ($item['field_13'] === 'da') ? 1 : 0,
            ($item['field_21'] === 'da') ? 1 : 0,
            ($item['field_29'] === 'da') ? 1 : 0,
            ($item['field_37'] === 'da') ? 1 : 0,
            ($item['field_51'] === 'da') ? 1 : 0,
            ($item['field_58'] === 'da') ? 1 : 0,
        ];
        $arr_resent_net = [
            ($item['field_44'] === 'net') ? 1 : 0,
        ];
        //suspicion_6
        $arr_susp_da = [
            ($item['field_6'] === 'da') ? 1 : 0,
            ($item['field_14'] === 'da') ? 1 : 0,
            ($item['field_22'] === 'da') ? 1 : 0,
            ($item['field_30'] === 'da') ? 1 : 0,
            ($item['field_38'] === 'da') ? 1 : 0,
            ($item['field_45'] === 'da') ? 1 : 0,
            ($item['field_52'] === 'da') ? 1 : 0,
            ($item['field_59'] === 'da') ? 1 : 0,
        ];
        $arr_susp_net = [
            ($item['field_65'] === 'net') ? 1 : 0,
            ($item['field_70'] === 'net') ? 1 : 0,
        ];
        //verbal_aggression_7
        $arr_verbal_da = [
            ($item['field_7'] === 'da') ? 1 : 0,
            ($item['field_15'] === 'da') ? 1 : 0,
            ($item['field_23'] === 'da') ? 1 : 0,
            ($item['field_31'] === 'da') ? 1 : 0,
            ($item['field_46'] === 'da') ? 1 : 0,
            ($item['field_53'] === 'da') ? 1 : 0,
            ($item['field_60'] === 'da') ? 1 : 0,
            ($item['field_71'] === 'da') ? 1 : 0,
            ($item['field_73'] === 'da') ? 1 : 0,
        ];
        $arr_verbal_net = [
            ($item['field_39'] === 'net') ? 1 : 0,
            ($item['field_74'] === 'net') ? 1 : 0,
            ($item['field_75'] === 'net') ? 1 : 0,
        ];
        //feeling_guilty_8
        $arr_feeling_da = [
            ($item['field_8'] === 'da') ? 1 : 0,
            ($item['field_16'] === 'da') ? 1 : 0,
            ($item['field_24'] === 'da') ? 1 : 0,
            ($item['field_32'] === 'da') ? 1 : 0,
            ($item['field_40'] === 'da') ? 1 : 0,
            ($item['field_47'] === 'da') ? 1 : 0,
            ($item['field_54'] === 'da') ? 1 : 0,
            ($item['field_61'] === 'da') ? 1 : 0,
            ($item['field_67'] === 'da') ? 1 : 0,
        ];

        $arrValueBassDarck['physical_aggression_1'] = array_sum($arr_physic_da) + array_sum($arr_physic_net);
        $arrValueBassDarck['indirect_aggression_2'] = array_sum($arr_indir_da) + array_sum($arr_indi_net);
        $arrValueBassDarck['irritation_3'] = array_sum($arr_irrit_da) + array_sum($arr_irrit_net);
        $arrValueBassDarck['negativism_4'] = array_sum($arr_negat_da) + array_sum($arr_negat_net);
        $arrValueBassDarck['resentment_5'] = array_sum($arr_resent_da) + array_sum($arr_resent_net);
        $arrValueBassDarck['suspicion_6'] = array_sum($arr_susp_da) + array_sum($arr_susp_net);
        $arrValueBassDarck['verbal_aggression_7'] = array_sum($arr_verbal_da) + array_sum($arr_verbal_net);
        $arrValueBassDarck['feeling_guilty_8'] = array_sum($arr_feeling_da);

        $arrValueBassDarck['result_aggressiveness'] = (($arrValueBassDarck['physical_aggression_1'] * 10) + ($arrValueBassDarck['irritation_3'] * 11) + ($arrValueBassDarck['verbal_aggression_7'] * 13)) / 3;
        $arrValueBassDarck['result_hostility'] = (($arrValueBassDarck['resentment_5'] + 9) + ($arrValueBassDarck['suspicion_6'] * 10)) / 2;

        $arrValueBassDarck['aggressiveness_index'] = $arrValueBassDarck['physical_aggression_1'] + $arrValueBassDarck['irritation_3'] + $arrValueBassDarck['verbal_aggression_7'];
        $arrValueBassDarck['includes_index'] = $arrValueBassDarck['resentment_5'] + $arrValueBassDarck['suspicion_6'];

        return $arrValueBassDarck;
    }
}