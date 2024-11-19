<?php

namespace backend\modules\riskCommon\models;

use Yii;

/**
 * This is the model class for table "risk_assessment_collective".
 *
 * @property int $id_collective
 * @property int $user_id Кто вносил
 * @property int|null $organization_id Организация
 * @property string|null $name_responsible_person_individual ФИО ответственного Кто вносил
 * @property string $key
 * @property string $class_collective Какой класс
 * @property string|null $field_1
 * @property string|null $field_2
 * @property string|null $field_3
 * @property string|null $field_4
 * @property string|null $field_5
 * @property string|null $field_6
 * @property string|null $field_7
 * @property string|null $field_8
 * @property string|null $field_9
 * @property string|null $field_10
 * @property string|null $field_11
 * @property string|null $field_12
 * @property string|null $field_13
 * @property string|null $field_14
 * @property string|null $field_15
 * @property string|null $field_16
 * @property string|null $field_17
 * @property string|null $field_18
 * @property string|null $field_19
 * @property string|null $field_20
 * @property string|null $field_21
 * @property string|null $field_22
 * @property string|null $field_23
 * @property string|null $field_24
 * @property string $create_at
 */
class RiskAssessmentCollective extends \yii\db\ActiveRecord
{
    public $verifyCode;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'risk_assessment_collective';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'user_id',
                'key',
                'class_collective',
                //'verifyCode'
            ], 'required'],
            [['user_id', 'organization_id'], 'integer'],
            [['create_at'], 'safe'],
            [['name_responsible_person_individual', 'key'], 'string', 'max' => 250],
            [['class_collective'], 'string', 'max' => 50],
            [['field_1', 'field_2', 'field_3', 'field_4', 'field_5', 'field_6', 'field_7', 'field_8', 'field_9', 'field_10', 'field_11', 'field_12', 'field_13', 'field_14', 'field_15', 'field_16', 'field_17', 'field_18', 'field_19', 'field_20', 'field_21', 'field_22', 'field_23', 'field_24'], 'number', 'min' => 0, 'max' => 1000],

            /*[
                [
                    'field4_1',
                    'field4_2',
                    'field4_3',
                    'field4_21',
                    'field4_22',
                    'field4_23',
                ],
                'validateSum','message'=>'Проверьте правильность суммы'
            ],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_collective' => 'Id Collective',
            'user_id' => 'User ID',
            'organization_id' => 'Organization ID',
            'name_responsible_person_individual' => 'Name Responsible Person Individual',
            'key' => 'Key',
            'class_collective' => 'Class Collective',
            'field_1' => 'Field 1',
            'field_2' => 'Field 2',
            'field_3' => 'Field 3',
            'field_4' => 'Field 4',
            'field_5' => 'Field 5',
            'field_6' => 'Field 6',
            'field_7' => 'Field 7',
            'field_8' => 'Field 8',
            'field_9' => 'Field 9',
            'field_10' => 'Field 10',
            'field_11' => 'Field 11',
            'field_12' => 'Field 12',
            'field_13' => 'Field 13',
            'field_14' => 'Field 14',
            'field_15' => 'Field 15',
            'field_16' => 'Field 16',
            'field_17' => 'Field 17',
            'field_18' => 'Field 18',
            'field_19' => 'Field 19',
            'field_20' => 'Field 20',
            'field_21' => 'Field 21',
            'field_22' => 'Field 22',
            'field_23' => 'Field 23',
            'field_24' => 'Field 24',
            'create_at' => 'Create At',
        ];
    }

    public function validateSum($attribute)
    {
        $rules_array_sum = [
            'field_21' => ['==', 'field4_5', 'field4_9', 'field4_13'],
            'field_22' => ['==', 'field4_6', 'field4_10', 'field4_14'],
            'field_23' => ['==', 'field4_7', 'field4_11', 'field4_15'],
            'field_24' => ['==', 'field4_1', 'field4_17', 'field4_15'],
        ];
        //print_r(count($rules_array_sum[$attribute])); exit();
        $sum = 0;
        for ($i = 0, $count_info = count($rules_array_sum[$attribute]) - 1; $count_info > 0; $count_info--, $i++) {
            $sum = $sum + $this[$rules_array_sum[$attribute][$i + 1]];
        }
        switch ($rules_array_sum[$attribute][0]) {
            case '==':
                if ((int)$this->$attribute !== (int)$sum) {
                    $this->addError(
                        $attribute,
                        'У Вас ошибка п1о ' . $rules_array_sum[$attribute][0] . ' выделенных строк;'
                    );
                    for (
                        $j = 0, $count_info = count(
                            $rules_array_sum[$attribute]
                        ) - 1; $count_info > 0; $count_info--, $j++
                    ) {
                        $this->addError(
                            $rules_array_sum[$attribute][$j + 1],
                            'Ошибка, проверьте правильность внесения: ' . $this->getAttributeLabel(
                                $rules_array_sum[$attribute][$j + 1]
                            ) . ';'
                        );
                    }
                }
                break;
            case '<=':
                if ((int)$this->$attribute > (int)$sum) {
                    $this->addError(
                        $attribute,
                        'У Вас ошибка по ' . $rules_array_sum[$attribute][0] . ' выделенных строк;'
                    );
                    for (
                        $j = 0, $count_info = count(
                            $rules_array_sum[$attribute]
                        ) - 1; $count_info > 0; $count_info--, $j++
                    ) {
                        $this->addError(
                            $rules_array_sum[$attribute][$j + 1],
                            'Ошибка, проверьте правильность внесения: ' . $this->getAttributeLabel(
                                $rules_array_sum[$attribute][$j + 1]
                            ) . ';'
                        );
                    }
                }
                break;
            case '<':
                if ((int)$this->$attribute >= (int)$sum) {
                    $this->addError(
                        $attribute,
                        'У Вас ошибка по ' . $rules_array_sum[$attribute][0] . ' выделенных строк;'
                    );
                    for (
                        $j = 0, $count_info = count(
                            $rules_array_sum[$attribute]
                        ) - 1; $count_info > 0; $count_info--, $j++
                    ) {
                        $this->addError(
                            $rules_array_sum[$attribute][$j + 1],
                            'Ошибка, проверьте правильность внесения: ' . $this->getAttributeLabel(
                                $rules_array_sum[$attribute][$j + 1]
                            ) . ';'
                        );
                    }
                }
                break;
            case '>':
                if ((int)$this->$attribute <= (int)$sum) {
                    $this->addError(
                        $attribute,
                        'У Вас ошибка по ' . $rules_array_sum[$attribute][0] . ' выделенных строк;'
                    );
                    for (
                        $j = 0, $count_info = count(
                            $rules_array_sum[$attribute]
                        ) - 1; $count_info > 0; $count_info--, $j++
                    ) {
                        $this->addError(
                            $rules_array_sum[$attribute][$j + 1],
                            'Ошибка, проверьте правильность внесения: ' . $this->getAttributeLabel(
                                $rules_array_sum[$attribute][$j + 1]
                            ) . ';'
                        );
                    }
                }
                break;
            case '>=':
                if ((int)$this->$attribute < (int)$sum) {
                    $this->addError(
                        $attribute,
                        'У Вас ошибка по ' . $rules_array_sum[$attribute][0] . ' выделенных строк;'
                    );
                    for (
                        $j = 0, $count_info = count(
                            $rules_array_sum[$attribute]
                        ) - 1; $count_info > 0; $count_info--, $j++
                    ) {
                        $this->addError(
                            $rules_array_sum[$attribute][$j + 1],
                            'Ошибка, проверьте правильность внесения: ' . $this->getAttributeLabel(
                                $rules_array_sum[$attribute][$j + 1]
                            ) . ';'
                        );
                    }
                }
                break;
        }
    }

    public function riskCalculationByClass($array, $modelR)
    {
        /*
            <tr>
                <td align="center" style="padding: 0rem;" class="text-center">1-4 классы</td>
                <td align="center" style="padding: 0rem;" class="text-center"><?=$model->field_21?></td>
                <?$g1 = $model->field_22 + $model->field_23 + $model->field_24 ?>
                <td align="center" style="padding: 0rem;" class="text-center"><?=$g1?></td>
                <?$koef = 1.469 ?>
                <td align="center" style="padding: 0rem;" class="text-center"><?=$koef?></td>
                <?$g2 = $model->field_21 - $g1 ?>
                <td align="center" style="padding: 0rem;" class="text-center"><?=$g2?></td>
                <?$risk = round($modelR['risk_assessment'], 3) ?>
                <td align="center" style="padding: 0rem;" class="text-center"><?=$risk?></td>
                <?$riskKol = ($model->field_21 == '0') ? 0 : round(( ($g1*$koef) + ($g2*$risk) )/$model->field_21, 3) ?>
                <td align="center" style="padding: 0rem;" class="text-center"><?=$riskKol?></td>
                <?$ver = round(( $riskKol*$riskKol*100), 3) ?>
                <td align="center" style="padding: 0rem;" class="text-center"><?=$ver?></td>
            </tr>
         */

        $arrClass = [
            '1_4' => [
                '1' => [
                    'field_1',
                    'field_2',
                    'field_3',
                    'field_4',
                ],
                '2' => [
                    'field_5',
                    'field_6',
                    'field_7',
                    'field_8',
                ],
                '3' => [
                    'field_9',
                    'field_10',
                    'field_11',
                    'field_12',
                ],
                '4' => [
                    'field_13',
                    'field_14',
                    'field_15',
                    'field_16',
                ],
            ],
            '5_9' => [
                '5' => [
                    'field_1',
                    'field_2',
                    'field_3',
                    'field_4',
                ],
                '6' => [
                    'field_5',
                    'field_6',
                    'field_7',
                    'field_8',
                ],
                '7' => [
                    'field_9',
                    'field_10',
                    'field_11',
                    'field_12',
                ],
                '8' => [
                    'field_13',
                    'field_14',
                    'field_15',
                    'field_16',
                ],
                '9' => [
                    'field_17',
                    'field_18',
                    'field_19',
                    'field_20',
                ],

            ],
            '10_11' => [
                '10' => [
                    'field_1',
                    'field_2',
                    'field_3',
                    'field_4',
                ],
                '11' => [
                    'field_5',
                    'field_6',
                    'field_7',
                    'field_8',
                ],
            ],
        ];

        $arrCoefficient = [
            '1' => '1.600',
            '2' => '1.500',
            '3' => '1.400',
            '4' => '1.375',
            '5' => '1.350',
            '6' => '1.325',
            '7' => '1.300',
            '8' => '1.250',
            '9' => '1.200',
            '10' => '1.100',
            '11' => '1.000',
        ];
        $risk = round($modelR['risk_assessment'], 3);
        $class = '';
        $koefVse = '';
        if ($modelR['class'] == '342') {
            $class = '1_4';
            $koefVse = '1.469';
        } else if ($modelR['class'] == '486') {
            $class = '5_9';
            $koefVse = '1.285';
        } else {
            $class = '10_11';
            $koefVse = '1.05';
        }
        $result = [];
        $n = $array['field_21'];
        $g1 = $array['field_22'] + $array['field_23'] + $array['field_24'];
        $koef = $koefVse;
        $g2 = $n - $g1;
        $R = $risk;
        $riskKol = ($n == '0') ? 0 : round(( ($g1*$koef) + ($g2*$R) )/$n, 3);
        $ver = round(( $riskKol*$riskKol*100), 3);
        $result[$class]['vse'] = [
            'N' => $n,
            'G1' => $g1,
            'koef' => $koef,
            'G2' => $g2,
            'R' => $R,
            'R_k' => $riskKol,
            'P_i' => $ver,
        ];

        foreach ($arrClass[$class] as $key => $oneArrClass){

            $n = $array[$oneArrClass[0]];
            $g1 = $array[$oneArrClass[1]] + $array[$oneArrClass[2]] + $array[$oneArrClass[3]];
            $koef =  round($arrCoefficient[$key], 3);
            $g2 = $n - $g1;
            $R = $risk;
            $riskKol = ($n == '0') ? 0 : round(( ($g1*$koef) + ($g2*$R) )/$n, 3);
            $ver = round(( $riskKol*$riskKol*100), 3);
            $result[$class][$key] = [
                'N' => $n,
                'G1' => $g1,
                'koef' => $koef,
                'G2' => $g2,
                'R' => $R,
                'R_k' => $riskKol,
                'P_i' => $ver,
            ];
        }
        //print_r('<pre>');
        //print_r($modelR);
        //print_r('<br>');
        //print_r($array);
        //print_r('<br>');
        //print_r($result);
        //print_r('<br>');
        //print_r($arrClass[$class]);
        //print_r('</pre>');
        //exit();
        //exit();
        return $result;

        //$result = [
        //    'field_21' => ['==', 'field4_5', 'field4_9', 'field4_13'],
        //    'field_22' => ['==', 'field4_6', 'field4_10', 'field4_14'],
        //    'field_23' => ['==', 'field4_7', 'field4_11', 'field4_15'],
        //    'field_24' => ['==', 'field4_1', 'field4_17', 'field4_15'],
        //];
    }
}
