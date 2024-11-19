<?php

namespace backend\modules\riskCommon\models;

use Yii;
use yii\base\Model;

class PrintCollectiveRisk extends Model
{
    public $field1_4;
    public $field5_9;
    public $field10_11;

    public function rules()
    {
        return [
            [[
                'field1_4',
                'field5_9',
                'field10_11',
            ], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'field1_4' => 'Ключ для 1-4 классов:',
            'field5_9' => 'Ключ для 5-9 классов:',
            'field10_11' => 'Ключ для 10-11 классов:',
        ];
    }
}