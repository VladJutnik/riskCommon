<?php

namespace backend\modules\riskCommon\models;

use Yii;
use yii\base\Model;

class RiskEstimation extends \yii\db\ActiveRecord
{
    public $radioButton1;
    public $radioButton2;
    public $radioButton3;
    public $radioButton4;
    public $radioButton5;

    public static function tableName()
    {
        return 'risk_estimation';
    }

    public function rules()
    {
        return [
            [[
                'key',
                'estimation',
                'text',
            ], 'required'],
            [[
                'user_id',
                'organization_id',
            ], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'estimation' => 'Пожалуйста, поставте свою оценку калькулятору:',
            'text' => 'Ваши пожелания:',
        ];
    }
}