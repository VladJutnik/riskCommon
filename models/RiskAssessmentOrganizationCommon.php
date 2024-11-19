<?php


namespace backend\modules\riskCommon\models;

use Yii;

/**
 * This is the model class for table "risk_assessment_organization_common".
 *
 * @property int $id
 * @property int $user_id Кто вносил
 * @property int $organization_id Организация
 * @property string $year Учебный год
 * @property string $class Какой класс
 * @property string|null $name_responsible_person ФИО ответственного Кто вносил
 * @property string $key
 * @property float|null $fieldTheme1_1
 * @property float|null $fieldTheme1_2
 * @property float|null $fieldTheme1_3
 * @property float|null $fieldTheme1_4
 * @property float|null $fieldTheme1_5
 * @property float $fieldTheme2_1
 * @property float $fieldTheme2_2
 * @property float $fieldTheme2_3
 * @property float $fieldTheme2_4
 * @property float $fieldTheme3_1
 * @property float $fieldTheme3_2
 * @property float $fieldTheme4_1
 * @property float|null $fieldTheme5_1
 * @property float|null $fieldTheme5_2
 * @property float|null $fieldTheme5_3
 * @property float|null $fieldTheme5_4_1
 * @property float|null $fieldTheme5_4_2
 * @property float|null $fieldTheme5_4_3
 * @property float|null $fieldTheme5_4_4
 * @property float|null $fieldTheme5_4_5
 * @property float|null $risk_assessment
 * @property string $create_at
 */
class RiskAssessmentOrganizationCommon extends \yii\db\ActiveRecord
{
    public $verifyCode;
    public $check;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'risk_assessment_organization_common';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'user_id', 'organization_id', 'year', 'class',
                'federal_district_id',
                'region_id',
                'municipality_id',
                'fieldTheme1_1',
                'fieldTheme1_2',
                'fieldTheme1_3',
                'fieldTheme1_4',
                'fieldTheme1_5',
                'fieldTheme2_1',
                'fieldTheme2_2',
                'fieldTheme2_3',
                'fieldTheme2_4',
                'fieldTheme3_1',
                'fieldTheme3_2',
                'fieldTheme4_1',
                'fieldTheme5_1',
                'fieldTheme5_2',
                'fieldTheme5_3',
                'fieldTheme5_4_1',
                'fieldTheme5_4_2',
                'fieldTheme5_4_3',
                'fieldTheme5_4_4',
                'verifyCode',
                'name_responsible_person',

                ], 'required'],
            //['captcha', 'required'],
            //['verifyCode', 'required'],
            //['captcha', 'captcha', 'captchaAction' => '/risk-common/controller/captcha'],
            //['verifyCode', 'captcha', 'captchaAction' => '/module/controller/captcha'],
            //[['captcha','recaptcha'], 'required'],
            //['recaptcha', 'compare', 'compareAttribute' => 'captcha', 'operator' => '=='],
            //['check', 'compare', 'compareValue' => 1, 'message' => 'Необходимо отметить что Вы согласны на обработку персональных данных'],

            [[
                'user_id',
                'organization_id',

                'fieldTheme1_1',
                'fieldTheme1_2',
                'fieldTheme1_3',
                'fieldTheme1_4',
                'fieldTheme1_5',
                'fieldTheme2_1',
                'fieldTheme2_2',
                'fieldTheme2_3',
                'fieldTheme2_4',
                'fieldTheme3_1',
                'fieldTheme3_2',
                'fieldTheme4_1',
                'fieldTheme5_1',
                'fieldTheme5_2',
                'fieldTheme5_3',
                'fieldTheme5_4_1',
                'fieldTheme5_4_2',
                'fieldTheme5_4_3',
                'fieldTheme5_4_4',
                'fieldTheme5_4_5',
                ], 'integer'],
            [['fieldTheme1_1', 'fieldTheme1_2', 'fieldTheme1_3', 'fieldTheme1_4', 'fieldTheme1_5', 'fieldTheme2_1', 'fieldTheme2_2', 'fieldTheme2_3', 'fieldTheme2_4', 'fieldTheme3_1', 'fieldTheme3_2', 'fieldTheme4_1', 'fieldTheme5_1', 'fieldTheme5_2', 'fieldTheme5_3', 'fieldTheme5_4_1', 'fieldTheme5_4_2', 'fieldTheme5_4_3', 'fieldTheme5_4_4', 'fieldTheme5_4_5', 'risk_assessment'], 'number'],
            [[
                'create_at',
                'risk_assessment_1',
                'risk_assessment_2',
                'risk_assessment_3',
                'risk_assessment_4',
                'risk_assessment_5',
                'risk_assessment_g',
            ], 'safe'],
            [['year', 'class'], 'string', 'max' => 50],
            [['name_responsible_person', 'key'], 'string', 'max' => 250],
            [
                'name_responsible_person',
                'match',
                'pattern' => '/^[а-яА-ЯёЁ0-9\s]+$/u',
                'message' => 'Принимаются только символы кириллицы и цифры'
            ],
            [[
                'fieldTheme5_4_5',
            ],'required', 'when' => function($model) {
                return $model->class == '342';
            }, 'whenClient' => "function (attribute, value) {
                return $('#riskassessmentorganizationcommon-class').val() == '342';
            }"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'organization_id' => 'Organization ID',
            'year' => 'Учебный год: ',
            'class' => 'Класс: ',
            'name_responsible_person' => 'Название организации в котором проводились исследования: ',
            'key' => 'Ключ: ',
            'fieldTheme1_1' => '1.1. НЕ промаркирована (да - риск есть, нет - риска нет): ',
            'fieldTheme1_2' => '1.2. НЕ стандартная (да - риск есть, нет - риска нет): ',
            'fieldTheme1_3' => '1.3. НЕ комплектная (да - риск есть, нет - риска нет): ',
            'fieldTheme1_4' => '1.4. В классных журналах нет листков здоровья (либо есть, но не во всех классах), либо в листках здоровья отсутствует информация о росте обучающихся и потребного росту номера мебели (да - риск есть, нет - риска нет): ',
            'fieldTheme1_5' => '1.5. НЕ во всех учебных кабинетах осуществляется подбор мебели для рассаживания детей с учетом роста (да - риск есть, нет - риска нет): ',
            'fieldTheme2_1' => '2.1. НЕ контролируется регулярно (реже 2-х раз в учебный год) в ходе производственного контроля и (или) НЕ отвечает гигиеническим требованиям (да - риск есть, нет - риска нет): ',
            'fieldTheme2_2' => '2.2. по результатам контрольно-надзорных мероприятий (если они проводились) ВЫЯВЛЯЛИСЬ нарушения действующих санитарных норм и правил в части обеспечения должного уровня искусственной освещенности на рабочих местах обучающихся и (или) классной доске, мониторах компьютеров (да - риск есть, нет - риска нет): ',
            'fieldTheme2_3' => '2.3. ИМЕЮТСЯ отдельные перегоревшие лампы в учебных классах и кабинетах (да - риск есть, нет - риска нет): ',
            'fieldTheme2_4' => '2.4. НЕ ВО ВСЕХ учебных классах и кабинетах установлены светорассеивающие светильники (да - риск есть, нет - риска нет): ',
            'fieldTheme3_1' => '3.1. Гимнастика во время перемен НЕ ПРОВОДИТСЯ (да - риск есть, нет - риска нет): ',
            'fieldTheme3_2' => '3.2. Гимнастика во время уроков с использованием электронных средств обучения НЕ ПРОВОДИТСЯ (да - риск есть, нет - риска нет): ',
            'fieldTheme4_1' => '4.1. Гимнастика во время перемен НЕ ПРОВОДИТСЯ (да - риск есть, нет - риска нет): ',
            'fieldTheme5_1' => '5.1. Средняя продолжительность (в минутах) использования ЭСО во время уроков (проводимых с использованием ЭСО) (да - риск есть, нет - риска нет) (для детей 1-4 класса – составляет более 20 минут – ответ ДА, если 25 минут и менее – ответ – НЕТ; для детей 5-9 класса - если более 30 минут – ответ ДА, если 30 минут и менее – ответ – НЕТ; для детей 10-11 класса – если более 35 минут – ответ ДА, если 35 минут и менее – ответ – НЕТ): ',
            'fieldTheme5_2' => '5.2. Среднее суммарное время использования ЭСО в школе за учебный день (да - риск есть, нет - риска нет) (для детей 1-4 класса - если более 80 минут– ответ ДА, если 80 и менее  – ответ – НЕТ; для детей 5-9 класса - если более100 минут – ответ ДА, если 100 минут и менее – ответ – НЕТ; для детей 10-11 класса – если более 120 минут– ответ ДА, если 120 минут и менее – ответ – НЕТ): ',
            'fieldTheme5_3' => '5.3. Допускается ли использование сотовых телефонов во время перемен? (да - риск есть, нет - риска нет)',
            'fieldTheme5_4_1' => '5.4.1	интерактивная доска с диагональю менее 65 дюймов (да - риск есть, нет - риска нет): ',
            'fieldTheme5_4_2' => '5.4.2	компьютеры с диагональю монитора – менее 15,6 дюймов (да - риск есть, нет - риска нет): ',
            'fieldTheme5_4_3' => '5.4.3	планшеты с диагональю менее 10,5 дюймов (да - риск есть, нет - риска нет): ',
            'fieldTheme5_4_4' => '5.4.4	ноутбуки –менее 14 дюймов, планшетов – менее 10,5 дюймов (да - риск есть, нет - риска нет): ',
            'fieldTheme5_4_5' => '5.4.5	(для 1-4 классов) ноутбуки без второй клавиатуры (да - риск есть, нет - риска нет): ',
            'risk_assessment' => 'Risk Assessment',
            'create_at' => 'Create At',
            'verifyCode' => 'Введите значения с картинки:',
            'recaptcha' => 'Введите значения выделенное желтым',
        ];
    }

    public function generateKey () {
        do
        {
            $key = implode('-', str_split(substr(strtolower(md5(microtime().rand(100000, 999999))), 0, 30), 6));
            $uniqueNumber = RiskAssessmentOrganizationCommon::find()->select('key')->where(['key' => $key])->one();
        } while ($uniqueNumber);
        return $key;
    }


    public function printCollectiveRisk ($row) {
        $modelR = new RiskAssessmentCollective();
        $arrCommon = $this->printArrCommon();
        $arrCollective = $this->printArrCollective();

        $modelArr342 = [];
        $RiskAssessmentCollective342 = [];
        $modelArr486 = [];
        $RiskAssessmentCollective486 = [];
        $modelArr2819 = [];
        $RiskAssessmentCollective2819 = [];
        $table = '';
        foreach($arrCommon as $oneKeyCommon){
            $modelArr342['class'] = '342';
            $modelArr342[$oneKeyCommon] = $row[$oneKeyCommon.'_common_342'];

            $table .= '<td>' .round($row[$oneKeyCommon.'_common_342'],3) .'</td>';
        }
        foreach($arrCollective as $oneKeyCollective){
            $RiskAssessmentCollective342[$oneKeyCollective] = $row[$oneKeyCollective.'_collective_342'];
        }
        $riskCalculationByClassArray1_4 = $modelR->riskCalculationByClass($RiskAssessmentCollective342, $modelArr342);

        $table .= '<td>' . $row['field_1_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_2_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_3_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_4_collective_342']  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][1]['N'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][1]['G1'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][1]['koef'],2)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][1]['G2'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][1]['R'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][1]['R_k'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][1]['P_i'],1)  .'</td>';
        $table .= '<td>' . $row['field_5_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_6_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_7_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_8_collective_342']  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][2]['N'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][2]['G1'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][2]['koef'],2)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][2]['G2'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][2]['R'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][2]['R_k'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][2]['P_i'],1)  .'</td>';
        $table .= '<td>' . $row['field_9_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_10_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_11_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_12_collective_342']  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][3]['N'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][3]['G1'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][3]['koef'],2)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][3]['G2'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][3]['R'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][3]['R_k'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][3]['P_i'],1)  .'</td>';
        $table .= '<td>' . $row['field_13_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_14_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_15_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_16_collective_342']  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][4]['N'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][4]['G1'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][4]['koef'],2)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][4]['G2'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][4]['R'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][4]['R_k'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4'][4]['P_i'],1)  .'</td>';
        $table .= '<td>' . $row['field_21_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_22_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_23_collective_342']  .'</td>';
        $table .= '<td>' . $row['field_24_collective_342']  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4']['vse']['N'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4']['vse']['G1'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4']['vse']['koef'],2)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4']['vse']['G2'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4']['vse']['R'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4']['vse']['R_k'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray1_4['1_4']['vse']['P_i'],1)  .'</td>';

        foreach($arrCommon as $oneKeyCommon){
            $modelArr486['class'] = '486';
            $modelArr486[$oneKeyCommon] = $row[$oneKeyCommon.'_common_486'];
            $table .= '<td>' . round($row[$oneKeyCommon.'_common_486'],3)  .'</td>';
        }
        foreach($arrCollective as $oneKeyCollective){
            $RiskAssessmentCollective486[$oneKeyCollective] = $row[$oneKeyCollective.'_collective_486'];
        }
        $riskCalculationByClassArray5_9 = $modelR->riskCalculationByClass($RiskAssessmentCollective486, $modelArr486);
        $table .= '<td>' . $row['field_1_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_2_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_3_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_4_collective_486']  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][5]['N'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][5]['G1'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][5]['koef'],2)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][5]['G2'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][5]['R'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][5]['R_k'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][5]['P_i'],1)  .'</td>';
        $table .= '<td>' . $row['field_5_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_6_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_7_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_8_collective_486']  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][6]['N'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][6]['G1'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][6]['koef'],2)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][6]['G2'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][6]['R'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][6]['R_k'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][6]['P_i'],1)  .'</td>';
        $table .= '<td>' . $row['field_9_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_10_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_11_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_12_collective_486']  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][7]['N'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][7]['G1'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][7]['koef'],2)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][7]['G2'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][7]['R'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][7]['R_k'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][7]['P_i'],1)  .'</td>';
        $table .= '<td>' . $row['field_13_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_14_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_15_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_16_collective_486']  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][8]['N'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][8]['G1'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][8]['koef'],2)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][8]['G2'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][8]['R'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][8]['R_k'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][8]['P_i'],1)  .'</td>';
        $table .= '<td>' . $row['field_17_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_18_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_19_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_20_collective_486']  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][9]['N'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][9]['G1'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][9]['koef'],2)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][9]['G2'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][9]['R'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][9]['R_k'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9'][9]['P_i'],1)  .'</td>';
        $table .= '<td>' . $row['field_21_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_22_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_23_collective_486']  .'</td>';
        $table .= '<td>' . $row['field_24_collective_486']  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9']['vse']['N'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9']['vse']['G1'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9']['vse']['koef'],2)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9']['vse']['G2'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9']['vse']['R'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9']['vse']['R_k'],1)  .'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray5_9['5_9']['vse']['P_i'],1)  .'</td>';
        foreach($arrCommon as $oneKeyCommon){
            $modelArr2819['class'] = '2819';
            $modelArr2819[$oneKeyCommon] = $row[$oneKeyCommon.'_common_2819'];
            $table .= '<td>' . round($row[$oneKeyCommon.'_common_2819'],3) .'</td>';
        }
        foreach($arrCollective as $oneKeyCollective){
            $RiskAssessmentCollective2819[$oneKeyCollective] = $row[$oneKeyCollective.'_collective_2819'];
        }
        $riskCalculationByClassArray10_11 = $modelR->riskCalculationByClass($RiskAssessmentCollective2819, $modelArr2819);
        $table .= '<td>' . $row['field_1_collective_2819'].'</td>';
        $table .= '<td>' . $row['field_2_collective_2819'].'</td>';
        $table .= '<td>' . $row['field_3_collective_2819'].'</td>';
        $table .= '<td>' . $row['field_4_collective_2819'].'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][10]['N'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][10]['G1'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][10]['koef'],2).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][10]['G2'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][10]['R'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][10]['R_k'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][10]['P_i'],1).'</td>';
        $table .= '<td>' . $row['field_5_collective_2819'].'</td>';
        $table .= '<td>' . $row['field_6_collective_2819'].'</td>';
        $table .= '<td>' . $row['field_7_collective_2819'].'</td>';
        $table .= '<td>' . $row['field_8_collective_2819'].'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][11]['N'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][11]['G1'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][11]['koef'],2).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][11]['G2'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][11]['R'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][11]['R_k'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11'][11]['P_i'],1).'</td>';
        $table .= '<td>' . $row['field_21_collective_2819'].'</td>';
        $table .= '<td>' . $row['field_22_collective_2819'].'</td>';
        $table .= '<td>' . $row['field_23_collective_2819'].'</td>';
        $table .= '<td>' . $row['field_24_collective_2819'].'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11']['vse']['N'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11']['vse']['G1'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11']['vse']['koef'],2).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11']['vse']['G2'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11']['vse']['R'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11']['vse']['R_k'],1).'</td>';
        $table .= '<td>' . round($riskCalculationByClassArray10_11['10_11']['vse']['P_i'],1).'</td>';
        $arrrayRisk = [
            0 => (!$riskCalculationByClassArray1_4['1_4']['vse']['R_k']) ? 0 : $riskCalculationByClassArray1_4['1_4']['vse']['R_k'],
            1 => (!$riskCalculationByClassArray5_9['5_9']['vse']['R_k']) ? 0 : $riskCalculationByClassArray5_9['5_9']['vse']['R_k'],
            2 => (!$riskCalculationByClassArray10_11['10_11']['vse']['R_k']) ? 0 : $riskCalculationByClassArray10_11['10_11']['vse']['R_k'],
        ];
        $arrrayVer = [
            0 => (!$riskCalculationByClassArray1_4['1_4']['vse']['P_i']) ? 0 : $riskCalculationByClassArray1_4['1_4']['vse']['P_i'],
            1 => (!$riskCalculationByClassArray5_9['5_9']['vse']['P_i']) ? 0 : $riskCalculationByClassArray5_9['5_9']['vse']['P_i'],
            2 => (!$riskCalculationByClassArray10_11['10_11']['vse']['P_i']) ? 0 : $riskCalculationByClassArray10_11['10_11']['vse']['P_i'],
        ];
        $valueRisk = array_sum($arrrayRisk)/count($arrrayRisk);
        $valueVer = array_sum($arrrayVer)/count($arrrayVer);
        $table .= '<td>' .round($valueRisk,1).'</td>';
        $table .= '<td>' .round($valueVer,1).'</td>';
        return $table;

    }

    public function printCollectiveRiskItog ($row) {
        $modelR = new RiskAssessmentCollective();
        $arrCommon = $this->printArrCommon();
        $arrCollective = $this->printArrCollective();

        $modelArr342 = [];
        $RiskAssessmentCollective342 = [];
        $modelArr486 = [];
        $RiskAssessmentCollective486 = [];
        $modelArr2819 = [];
        $RiskAssessmentCollective2819 = [];
        $table = '';
        foreach($arrCommon as $oneKeyCommon){
            $modelArr342['class'] = '342';
            $modelArr342[$oneKeyCommon] = $row[$oneKeyCommon.'_common_342'];
            $table .= '<th>' .  round($row[$oneKeyCommon.'_common_342']/$row['count'] ,3)  .'</th>';
        }
        foreach($arrCollective as $oneKeyCollective){
            $RiskAssessmentCollective342[$oneKeyCollective] = $row[$oneKeyCollective.'_collective_342'];
        }
        $riskCalculationByClassArray1_4 = $modelR->riskCalculationByClass($RiskAssessmentCollective342, $modelArr342);

        $table .= '<th>' .  round($row['field_1_collective_342'] /$row['count'] ,3)  .'</th>';
        $table .= '<th>' .  round($row['field_2_collective_342'] /$row['count'] ,3)  .'</th>';
        $table .= '<th>' .  round($row['field_3_collective_342'] /$row['count'] ,3)  .'</th>';
        $table .= '<th>' .  round($row['field_4_collective_342'] /$row['count'] ,3)  .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][1]['N'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][1]['G1'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][1]['koef'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][1]['G2'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][1]['R'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][1]['R_k'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][1]['P_i'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_5_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_6_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_7_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_8_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][2]['N'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][2]['G1'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][2]['koef'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][2]['G2'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][2]['R'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][2]['R_k'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][2]['P_i'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_9_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_10_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_11_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_12_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][3]['N'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][3]['G1'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][3]['koef'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][3]['G2'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][3]['R'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][3]['R_k'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][3]['P_i'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_13_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_14_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_15_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_16_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][4]['N'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][4]['G1'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][4]['koef'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][4]['G2'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][4]['R'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][4]['R_k'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4'][4]['P_i'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_21_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_22_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_23_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($row['field_24_collective_342'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray1_4['1_4']['vse']['N'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray1_4['1_4']['vse']['G1'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray1_4['1_4']['vse']['koef'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray1_4['1_4']['vse']['G2'] /$row['count'] ,3)  .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4']['vse']['R'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4']['vse']['R_k'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' . round($riskCalculationByClassArray1_4['1_4']['vse']['P_i'] /$row['count'] ,3) .'</th>';

        foreach($arrCommon as $oneKeyCommon){
            $modelArr486['class'] = '486';
            $modelArr486[$oneKeyCommon] = $row[$oneKeyCommon.'_common_486'];
            $table .= '<th>' . round($row[$oneKeyCommon.'_common_486'] /$row['count'] ,3) .'</th>';
        }
        foreach($arrCollective as $oneKeyCollective){
            $RiskAssessmentCollective486[$oneKeyCollective] = $row[$oneKeyCollective.'_collective_486'];
        }
        $riskCalculationByClassArray5_9 = $modelR->riskCalculationByClass($RiskAssessmentCollective486, $modelArr486);
        $table .= '<th>' .  round($row['field_1_collective_486'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($row['field_2_collective_486'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($row['field_3_collective_486'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($row['field_4_collective_486'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][5]['N'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][5]['G1'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][5]['koef'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][5]['G2'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][5]['R'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][5]['R_k'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][5]['P_i'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_5_collective_486'] /$row['count'] ,3)  .'</th>';
        $table .= '<th>' .  round($row['field_6_collective_486'] /$row['count'] ,3)  .'</th>';
        $table .= '<th>' .  round($row['field_7_collective_486'] /$row['count'] ,3)  .'</th>';
        $table .= '<th>' .  round($row['field_8_collective_486'] /$row['count'] ,3)  .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][6]['N'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][6]['G1'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][6]['koef'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][6]['G2'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][6]['R'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][6]['R_k'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][6]['P_i'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_9_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_10_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_11_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_12_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][7]['N'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][7]['G1'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][7]['koef'] /$row['count'] ,3)  .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][7]['G2'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][7]['R'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][7]['R_k'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][7]['P_i'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_13_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_14_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_15_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_16_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][8]['N'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][8]['G1'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][8]['koef'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][8]['G2'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][8]['R'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][8]['R_k'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][8]['P_i'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_17_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_18_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_19_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_20_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][9]['N'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][9]['G1'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][9]['koef'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][9]['G2'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][9]['R'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][9]['R_k'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9'][9]['P_i'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_21_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_22_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_23_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_24_collective_486'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9']['vse']['N'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9']['vse']['G1'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9']['vse']['koef'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9']['vse']['G2'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9']['vse']['R'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9']['vse']['R_k'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray5_9['5_9']['vse']['P_i'] /$row['count'] ,3) .'</th>';
        foreach($arrCommon as $oneKeyCommon){
            $modelArr2819['class'] = '2819';
            $modelArr2819[$oneKeyCommon] = $row[$oneKeyCommon.'_common_2819'];
            $table .= '<th>' . round($row[$oneKeyCommon.'_common_2819'] /$row['count'] ,3) .'</th>';
        }
        foreach($arrCollective as $oneKeyCollective){
            $RiskAssessmentCollective2819[$oneKeyCollective] = $row[$oneKeyCollective.'_collective_2819'];
        }
        $riskCalculationByClassArray10_11 = $modelR->riskCalculationByClass($RiskAssessmentCollective2819, $modelArr2819);
        $table .= '<th>' .  round($row['field_1_collective_2819'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($row['field_2_collective_2819'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($row['field_3_collective_2819'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($row['field_4_collective_2819'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][10]['N'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][10]['G1'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][10]['koef'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][10]['G2'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][10]['R'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][10]['R_k'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][10]['P_i'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($row['field_5_collective_2819'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_6_collective_2819'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_7_collective_2819'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($row['field_8_collective_2819'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][11]['N'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][11]['G1'] /$row['count'] ,3) .'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][11]['koef'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][11]['G2'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][11]['R'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][11]['R_k'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11'][11]['P_i'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($row['field_21_collective_2819'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($row['field_22_collective_2819'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($row['field_23_collective_2819'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($row['field_24_collective_2819'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11']['vse']['N'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11']['vse']['G1'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11']['vse']['koef'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11']['vse']['G2'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11']['vse']['R'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11']['vse']['R_k'] /$row['count'] ,3).'</th>';
        $table .= '<th>' .  round($riskCalculationByClassArray10_11['10_11']['vse']['P_i'] /$row['count'] ,3).'</th>';
        $arrrayRisk = [
            0 => (!$riskCalculationByClassArray1_4['1_4']['vse']['R_k']) ? 0 : $riskCalculationByClassArray1_4['1_4']['vse']['R_k'],
            1 => (!$riskCalculationByClassArray5_9['5_9']['vse']['R_k']) ? 0 : $riskCalculationByClassArray5_9['5_9']['vse']['R_k'],
            2 => (!$riskCalculationByClassArray10_11['10_11']['vse']['R_k']) ? 0 : $riskCalculationByClassArray10_11['10_11']['vse']['R_k'],
        ];
        $arrrayVer = [
            0 => (!$riskCalculationByClassArray1_4['1_4']['vse']['P_i']) ? 0 : $riskCalculationByClassArray1_4['1_4']['vse']['P_i'],
            1 => (!$riskCalculationByClassArray5_9['5_9']['vse']['P_i']) ? 0 : $riskCalculationByClassArray5_9['5_9']['vse']['P_i'],
            2 => (!$riskCalculationByClassArray10_11['10_11']['vse']['P_i']) ? 0 : $riskCalculationByClassArray10_11['10_11']['vse']['P_i'],
        ];
        $valueRisk = array_sum($arrrayRisk)/count($arrrayRisk);
        $valueVer = array_sum($arrrayVer)/count($arrrayVer);
        $table .= '<th>' . round($valueRisk/$row['count'] ,3).'</th>';
        $table .= '<th>' . round($valueVer /$row['count'] ,3).'</th>';
        return $table;

    }

    public function decodingOverallRisk ($model) {

        $arr = [
            'fieldTheme1_1' => Yii::$app->riskComponent->fieldTheme1Decoding($model->fieldTheme1_1),
            'fieldTheme1_2' => Yii::$app->riskComponent->fieldTheme1Decoding($model->fieldTheme1_2),
            'fieldTheme1_3' => Yii::$app->riskComponent->fieldTheme1Decoding($model->fieldTheme1_3),
            'fieldTheme1_4' => Yii::$app->riskComponent->fieldTheme1Decoding($model->fieldTheme1_4),
            'fieldTheme1_5' => Yii::$app->riskComponent->fieldTheme1Decoding($model->fieldTheme1_5),
            'fieldTheme2_1' => Yii::$app->riskComponent->fieldTheme2Decoding($model->fieldTheme2_1),
            'fieldTheme2_2' => Yii::$app->riskComponent->fieldTheme2Decoding($model->fieldTheme2_2),
            'fieldTheme2_3' => Yii::$app->riskComponent->fieldTheme2Decoding($model->fieldTheme2_3),
            'fieldTheme2_4' => Yii::$app->riskComponent->fieldTheme2Decoding($model->fieldTheme2_4),
            'fieldTheme3_1' => Yii::$app->riskComponent->fieldTheme3Decoding($model->fieldTheme3_1),
            'fieldTheme3_2' => Yii::$app->riskComponent->fieldTheme3Decoding($model->fieldTheme3_2),
            'fieldTheme4_1' => Yii::$app->riskComponent->fieldTheme4Decoding($model->fieldTheme4_1),
            'fieldTheme5_1' => Yii::$app->riskComponent->fieldTheme5Decoding($model->fieldTheme5_1),
            'fieldTheme5_2' => Yii::$app->riskComponent->fieldTheme5Decoding($model->fieldTheme5_2),
            'fieldTheme5_3' => Yii::$app->riskComponent->fieldTheme5Decoding($model->fieldTheme5_3),
            'fieldTheme5_4_1' => Yii::$app->riskComponent->fieldTheme6Decoding($model->fieldTheme5_4_1),
            'fieldTheme5_4_2' => Yii::$app->riskComponent->fieldTheme6Decoding($model->fieldTheme5_4_2),
            'fieldTheme5_4_3' => Yii::$app->riskComponent->fieldTheme6Decoding($model->fieldTheme5_4_3),
            'fieldTheme5_4_4' => Yii::$app->riskComponent->fieldTheme6Decoding($model->fieldTheme5_4_4),
            'fieldTheme5_4_5' => Yii::$app->riskComponent->fieldTheme6Decoding($model->fieldTheme5_4_5),
        ];

        return $arr;
    }

    public function decodingOverallRisk2 ($model) {
        $arr = $this->decodingOverallRisk($model);
        $arrStr = [
            'fieldTheme1_1' => 'х1.1.',
            'fieldTheme1_2' => 'х1.2.',
            'fieldTheme1_3' => 'х1.3.',
            'fieldTheme1_4' => 'х1.4.',
            'fieldTheme1_5' => 'х1.5.',
            'fieldTheme2_1' => 'х2.1.',
            'fieldTheme2_2' => 'х2.2.',
            'fieldTheme2_3' => 'х2.3.',
            'fieldTheme2_4' => 'х2.4.',
            'fieldTheme3_1' => 'х3.1.',
            'fieldTheme3_2' => 'х3.2.',
            'fieldTheme4_1' => 'х4.1.',
            'fieldTheme5_1' => 'х5.1.',
            'fieldTheme5_2' => 'х5.2.',
            'fieldTheme5_3' => 'х5.3.',
            'fieldTheme5_4_1' => 'х5.4.1.',
            'fieldTheme5_4_2' => 'х5.4.2.',
            'fieldTheme5_4_3' => 'х5.4.3.',
            'fieldTheme5_4_4' => 'х5.4.4.',
            'fieldTheme5_4_5' => 'х5.4.5.',
        ];
        $str = '';
        foreach ($arr as $key => $one){
            if ($one != '0'){
                $str .= $arrStr[$key].' ';
            }
        }

        return $str;
    }

    public function generalCalculateRisk1 ($arr) {

        $dd =
            $arr['fieldTheme1_1'] +
            $arr['fieldTheme1_2'] +
            $arr['fieldTheme1_3'] +
            $arr['fieldTheme1_4'] +
            $arr['fieldTheme1_5']
        ;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateRisk2 ($arr) {
        $dd =
            $arr['fieldTheme2_1'] +
            $arr['fieldTheme2_2'] +
            $arr['fieldTheme2_3'] +
            $arr['fieldTheme2_4']
        ;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateRisk3 ($arr) {
        $dd =
            $arr['fieldTheme3_1'] +
            $arr['fieldTheme3_2']
        ;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateRisk4 ($arr) {
        $dd =
            $arr['fieldTheme4_1']
        ;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateRisk5 ($arr) {
        $dd =
            $arr['fieldTheme5_1'] +
            $arr['fieldTheme5_2'] +
            $arr['fieldTheme5_3'] +
            $arr['fieldTheme5_4_1'] +
            $arr['fieldTheme5_4_2'] +
            $arr['fieldTheme5_4_3'] +
            $arr['fieldTheme5_4_4'] +
            $arr['fieldTheme5_4_5']
        ;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateRisk ($x1 = 0, $x2 = 0, $x3 = 0, $x4 = 0, $x5 = 0 ) {
        $dd = ($x1 + $x2 + $x3 + $x4 + $x5);
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateRiskG ($x1 = 0, $x2 = 0, $x3 = 0, $x4 = 0, $x5 = 0 ) {
        $dd = ($x1 + $x2 + $x3 + $x4 + $x5) * 1.127;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function decodingOverallIndividualRisk ($model) {
        $arr = [
            'fieldIndividualTheme1_1' => Yii::$app->riskComponent->fieldTheme1IndividualDecoding($model->fieldIndividualTheme1_1),
            'fieldIndividualTheme1_2' => Yii::$app->riskComponent->fieldTheme1IndividualDecoding($model->fieldIndividualTheme1_2),
            'fieldIndividualTheme1_3' => Yii::$app->riskComponent->fieldTheme1IndividualDecoding($model->fieldIndividualTheme1_3),
            'fieldIndividualTheme2_1' => Yii::$app->riskComponent->fieldTheme2IndividualDecoding($model->fieldIndividualTheme2_1),
            'fieldIndividualTheme2_2' => Yii::$app->riskComponent->fieldTheme2IndividualDecoding($model->fieldIndividualTheme2_2),
            'fieldIndividualTheme2_3' => Yii::$app->riskComponent->fieldTheme2IndividualDecoding($model->fieldIndividualTheme2_3),
            'fieldIndividualTheme3_1' => Yii::$app->riskComponent->fieldTheme3IndividualDecoding($model->fieldIndividualTheme3_1),
            'fieldIndividualTheme3_2' => Yii::$app->riskComponent->fieldTheme3IndividualDecoding($model->fieldIndividualTheme3_2),
            'fieldIndividualTheme4_1' => Yii::$app->riskComponent->fieldTheme41IndividualDecoding($model->fieldIndividualTheme4_1),
            'fieldIndividualTheme4_2' => Yii::$app->riskComponent->fieldTheme42IndividualDecoding($model->fieldIndividualTheme4_2),
            'fieldIndividualTheme5_1' => Yii::$app->riskComponent->fieldTheme51IndividualDecoding($model->fieldIndividualTheme5_1),
            'fieldIndividualTheme5_2' => Yii::$app->riskComponent->fieldTheme52IndividualDecoding($model->fieldIndividualTheme5_2),
            'fieldIndividualTheme6_1' => Yii::$app->riskComponent->fieldTheme6IndividualDecoding($model->fieldIndividualTheme6_1),
            'fieldIndividualTheme6_2' => Yii::$app->riskComponent->fieldTheme6IndividualDecoding($model->fieldIndividualTheme6_2),
        ];

        return $arr;
    }

    public function generalCalculateIndividualYRisk ($arr) {

        $dd =
            $arr['fieldIndividualTheme1_1'] +
            $arr['fieldIndividualTheme1_2'] +
            $arr['fieldIndividualTheme1_3'] +
            $arr['fieldIndividualTheme2_1'] +
            $arr['fieldIndividualTheme2_2'] +
            $arr['fieldIndividualTheme2_3'] +
            $arr['fieldIndividualTheme3_1'] +
            $arr['fieldIndividualTheme3_2'] +
            $arr['fieldIndividualTheme4_1'] +
            $arr['fieldIndividualTheme4_2'] +
            $arr['fieldIndividualTheme5_1'] +
            $arr['fieldIndividualTheme5_2']
        ;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateIndividualY1Risk ($arr) {

        $dd =
            $arr['fieldIndividualTheme1_1'] +
            $arr['fieldIndividualTheme1_2'] +
            $arr['fieldIndividualTheme1_3']
        ;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateIndividualY2Risk ($arr) {

        $dd =
            $arr['fieldIndividualTheme2_1'] +
            $arr['fieldIndividualTheme2_2'] +
            $arr['fieldIndividualTheme2_3']
        ;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateIndividualY3Risk ($arr) {

        $dd =
            $arr['fieldIndividualTheme3_1'] +
            $arr['fieldIndividualTheme3_2']
        ;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateIndividualY4Risk ($arr) {

        $dd =
            $arr['fieldIndividualTheme4_1'] +
            $arr['fieldIndividualTheme4_2']
        ;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateIndividualY5Risk ($arr) {

        $dd =
            $arr['fieldIndividualTheme5_1'] +
            $arr['fieldIndividualTheme5_2']
        ;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateIndividualZRisk ($arr) {
        $dd =
            $arr['fieldIndividualTheme6_1'] +
            $arr['fieldIndividualTheme6_2']
        ;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateIndividualRisk ($xRisk = 0, $yRisk = 0, $zRisk = 0) {
        $dd = $xRisk + $yRisk + $zRisk;
        if($dd > 1){
            return 1;
        }
        return $dd;
    }

    public function generalCalculateIndividualKvRisk ($risk, $class = 1) {
        $array = [
            '11' => '1.000',
            '10' => '1.100',
            '9' => '1.200',
            '8' => '1.250',
            '7' => '1.300',
            '6' => '1.325',
            '5' => '1.350',
            '4' => '1.375',
            '3' => '1.400',
            '2' => '1.500',
            '1' => '1.600',
        ];
        $dd = $risk * $array[$class];
        //if($dd > 1){
        //    return 1;
        //}
        return $dd;
    }

    public function decodingTextRisk ($x) {
        if($x < 0.5){
            return '«Низкий риск»';
        } else if($x < 0.25){
            return '«Риск ниже среднего»';
        } else if($x < 0.75){
            return '«Средний риск»';
        } else if($x < 0.95){
            return '«Риск выше среднего»';
        } else {
            return '«Высокий риск»';
        }
        return '--';
    }

    public function contributionControlledFactors ($x) {
        if(
            $x['risk_assessment_individual'] &&
            $x['risk_assessment_individual_z'] &&
            $x['risk_assessment_individual'] !== 0
        ){
            $riskNN = $x['risk_assessment_individual'] - $x['risk_assessment_individual_z'];
            $percentRisk = ($riskNN/$x['risk_assessment_individual'])*100 ;
            return round($percentRisk, 1);
        } else {
            return 0;
        }
    }

    public function contributionControlledFactors2 ($x) {
        if(
            $x['risk_assessment_g'] &&
            $x['risk_assessment_individual'] &&
            $x['risk_assessment_individual'] !== 0
        ){
            //$riskNN = $x['risk_assessment_individual'] - $x['risk_assessment_g'];
            $percentRisk = ($x['risk_assessment_g']/$x['risk_assessment_individual'])*100 ;
            return round($percentRisk, 1);
        } else {
            return 0;
        }
    }

    public function contributionControlledFactors3 ($x) {
        if(
            $x['risk_assessment_g'] &&
            $x['risk_assessment_individual'] &&
            $x['risk_assessment_individual_z'] &&
            $x['risk_assessment_individual'] !== 0
        ){
            $riskNN = $x['risk_assessment_individual'] - $x['risk_assessment_individual_z'];
            //$riskNN2 = $x['risk_assessment_individual'] - $x['risk_assessment_g'];
            $riskNN3 = $riskNN - $x['risk_assessment_g'];
            $percentRisk = ($riskNN3/$x['risk_assessment_individual'])*100 ;
            return round($percentRisk, 1);
        } else {
            return 0;
        }
    }

    public function contributionControlledFactors4 ($x) {
        $riskNN = ($x * $x) * 100;
        return round($riskNN, 1);

    }

    public function printArrCommon () {
        return [
            'fieldTheme1_1',
            'fieldTheme1_2',
            'fieldTheme1_3',
            'fieldTheme1_4',
            'fieldTheme1_5',
            'risk_assessment_1',
            'fieldTheme2_1',
            'fieldTheme2_2',
            'fieldTheme2_3',
            'fieldTheme2_4',
            'risk_assessment_2',
            'fieldTheme3_1',
            'fieldTheme3_2',
            'risk_assessment_3',
            'fieldTheme4_1',
            'risk_assessment_4',
            'fieldTheme5_1',
            'fieldTheme5_2',
            'fieldTheme5_3',
            'fieldTheme5_4_1',
            'fieldTheme5_4_2',
            'fieldTheme5_4_3',
            'fieldTheme5_4_4',
            'fieldTheme5_4_5',
            'risk_assessment_5',
            'risk_assessment_g',
            'risk_assessment',
        ];
    }

    public function printArrCollective () {
        return [
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
        ];
    }
}
