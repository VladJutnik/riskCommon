<?php

namespace backend\modules\riskCommon\models;

use Yii;


class RiskAssessmentKey extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'risk_assessment_key';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'federal_district_id',
                'region_id',
                'municipality_id',
                'year',
                'key_1_4',
                'key_5_9',
                'key_10_11',
            ], 'required'],
            [[
                'create_at',
                'user_id',
                'organization_id',
            ], 'safe'],
        ];
    }
}