<?php

namespace backend\modules\riskCommon\models;

use Yii;


class RiskChildrenList extends \yii\db\ActiveRecord
{
    //public $class;

    public static function tableName()
    {
        return 'risk_children_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'key',
                'name_responsible_person_individual',
                'class_individual',
                'class',
            ], 'required'],
            [[
                'create_at',
                'key',
                'name_responsible_person_individual',
                'class_individual',
                'class_letter',
                'testing_date',
            ], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'class_individual' => 'Класс респондента: ',
            'name_responsible_person_individual' => 'Идентификатор респондента: ',
            'testing_date' => 'Дата проведения опроса: ',
        ];
    }


    public function scoringDescriptionColor($value = 0)
    {
        if ($value <= '28.55') {
            return '#adff2f';
        } else if ($value <= '71.44') {
            return '#ffeb33';
        } else if ($value <= '100') {
            return '#fa3737';
        } else {
            return '#000000';
        }

    }

    public function scoringDescriptionColor2($value = 0)
    {
        if ($value <= '30') {
            return '#adff2f';
        } else if ($value <= '45') {
            return '#ffeb33';
        } else if ($value <= '100') {
            return '#fa3737';
        } else {
            return '#000000';
        }

    }

    public function scoringDescriptionColor22($value = 0)
    {
        if ($value <= '27') {
            return '#adff2f';
        } else if ($value <= '49') {
            return '#ffeb33';
        } else if ($value <= '71') {
            return '#ffc30f';
        } else if ($value <= '82') {
            return '#ff9900';
        } else if ($value <= '100') {
            return '#cc5500';
        } else {
            return '#000000';
        }

    }

    public function scoringDescriptionColor33($value = 0)
    {
        if ($value <= '14') {
            return '#adff2f';
        } else if ($value <= '36') {
            return '#ffeb33';
        } else if ($value <= '58') {
            return '#ffc30f';
        } else if ($value <= '69') {
            return '#ff9900';
        } else if ($value <= '100') {
            return '#cc5500';
        } else {
            return '#000000';
        }

    }

    public function scoringDescriptionText($value = 0)
    {

        if ($value <= '28.55') {
            return 'симптоматика, свидетельствующая о беспокойстве и нервозности, соответствует границам нормы – тревожность не повышена, корректирующих мер не требуется';
        } else if ($value <= '71.44') {
            return 'симптоматика присутствует, беспокойство и нервозность повышена и требуется реализация профилактических мероприятий, индивидуального подхода и наблюдения в динамик';
        } else if ($value <= '100') {
            return 'симптоматика носит выраженный характер, беспокойство и нервозность существенно повышена, требуется консультация психолога, а также реализация профилактических мероприятий, индивидуальный подход и наблюдение в динамике';
        } else {
            return '-';
        }
    }

    public function scoringDescriptionText2($value = 0)
    {

        if ($value <= '28.55') {
            return 'внешних причин, способствующих формированию повышенной агрессии у ребенка – не выявлено';
        } else if ($value <= '71.44') {
            return 'внешние причины, способствующие формированию повышенной агрессии у респондента, присутствуют, требуется корректировка';
        } else if ($value <= '100') {
            return 'внешние причины, способствующие формированию повышенной агрессии у респондента, присутствуют, требуется корректировка, а также реализация профилактических мероприятий, индивидуальный подход и наблюдение в динамике';
        } else {
            return '-';
        }
    }

    public function scoringDescriptionTextDec($value = 0)
    {

        if ($value <= '28.55') {
            return '0 - 28,55 ';
        } else if ($value <= '71.44') {
            return '28,56 - 71,44';
        } else if ($value <= '100') {
            return '71,45 - 100';
        } else {
            return '-';
        }
    }


    public function scoringDescriptionColor50($value = 0)
    {

        if ($value <= '14.275') {
            return '#adff2f';
        } else if ($value <= '35.72') {
            return '#ffeb33';
        } else if ($value <= '50') {
            return '#fa3737';
        } else {
            return '#000000';
        }
    }

    public function scoringDescriptionText50($value = 0)
    {

        if ($value <= '14.275') {
            return 'реализуемые меры профилактики в отношении респондента со стороны учителей, соответствуют границам нормы – корректирующих мер не требуется';
        } else if ($value <= '35.72') {
            return 'реализуемые меры профилактики в отношении респондента со стороны учителей недостаточные и требуют корректировки и индивидуального подхода';
        } else if ($value <= '50') {
            return 'реализуемые меры профилактики в отношении респондента со стороны учителей недостаточные, требуется срочная их корректировка и индивидуальный подход к респонденту';
        } else {
            return '-';
        }
    }

    public function scoringDescriptionTextDec50($value = 0)
    {

        if ($value <= '14.275') {
            return '0 - 14.275';
        } else if ($value <= '35.72') {
            return '14.276 - 35.72';
        } else if ($value <= '50') {
            return '35.73 - 50';
        } else {
            return '-';
        }
    }

    public function finalAssessmentText($pril5 = 0, $pril6 = 0, $pril4 = 0)
    {
        $value = ($pril5 + $pril6) - $pril4;
        if ($value < '0') {
            return 'ОТРИЦАТЕЛЬНО';
        } else {
            return 'ПОЛОЖИТЕЛЬНО';
        }
    }

    public function percentage_of_number($integer, $percentage_number)
    {
        if (!$integer || $integer == 0 || $integer == '0') {
            return '';
        }
        $value = ($percentage_number * 100) / $integer;

        if ($value != 0) {
            return ' - ' . round($value, 1) . '%';
        } else {
            return '';
        }
    }

    public function percentage_of_number2($integer, $percentage_number)
    {
        if (!$integer || $integer == 0 || $integer == '0') {
            return '';
        }
        $value = ($percentage_number * 100) / $integer;

        if ($value != 0) {
            return round($value, 1) . '%';
        } else {
            return '';
        }
    }

    public function scoringDescriptionTextDec50111($value = 0)
    {
        if ($value <= 27) {
            return 'низкий уровень';
        } else if ($value <= 49) {
            return 'средний уровень';
        } else if ($value <= 71) {
            return 'повышенный уровень';
        } else if ($value <= 82) {
            return 'высокий уровень';
        } else {
            return 'очень высокий уровень';
        }
    }

    public function scoringDescriptionTextDec50222($value = 0)
    {
        if ($value <= 14) {
            return 'низкий уровень';
        } else if ($value <= 36) {
            return 'средний уровень';
        } else if ($value <= 58) {
            return 'повышенный уровень';
        } else if ($value <= 69) {
            return 'высокий уровень';
        } else {
            return 'очень высокий уровень';
        }
    }

/*
    public function scoringDescriptionColor22($value = 0)
    {
        if ($value <= '27') {
            return '#adff2f';
        } else if ($value <= '49') {
            return '#ffeb33';
        } else if ($value <= '71') {
            return '#ffc30f';
        } else if ($value <= '82') {
            return '#ff9900';
        } else if ($value <= '100') {
            return '#cc5500';
        } else {
            return '#000000';
        }

    }

    public function scoringDescriptionColor33($value = 0)
    {
        if ($value <= '14') {
            return '#adff2f';
        } else if ($value <= '36') {
            return '#ffeb33';
        } else if ($value <= '58') {
            return '#ffc30f';
        } else if ($value <= '69') {
            return '#ff9900';
        } else if ($value <= '100') {
            return '#cc5500';
        } else {
            return '#000000';
        }

    }
*/
}