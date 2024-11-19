<?php
namespace backend\modules\riskCommon\componentCommon;

use yii\base\Component;


class RiskComponent extends Component
{
    public function fieldBBBB2($id = false)
    {
        $item = [
            '' => '',
            '99' => '0',
            '100' => '1',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function academicYear($id = false)
    {
        $item = [
            //'2022/2023' => '2022/2023',
            '2023/2024' => '2023/2024',
            //'2024/2025' => '2024/2025',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function trainingClass($id = false)
    {
        $item = [
            '342' => '1-4 классы',
            '486' => '5-9 классы',
            '2819' => '10-11 классы',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function interpretation($id = 1)
    {
        if($id <= 30){
            $str = 'низкая тревожность';
        } else if($id < 46) {
            $str = 'умеренная тревожность';
        } else {
            $str = 'высокая тревожность';
        }
        return $str;
    }

    public function interpretationArr($a = 1, $b = 1)
    {
        $arr = [
          1 => 'низкая тревожность' ,
          2 => 'умеренная тревожность' ,
          3 => 'высокая тревожность',
        ];
        $num = ($a > $b) ? $a : $b;
        if($num <= 30){
            $str = 1;
        } else if($num < 46) {
            $str = 2;
        } else {
            $str = 3;
        }
        return $arr[$str];
    }

    public function trainingClassDecoding($id)
    {
        $item = [
            '342' => '1',
            '486' => '5',
            '2819' => '10',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function trainingClassIndividualSTR($id)
    {
        if($id == '342'){
            $item = [
                '24' => '1 класс',
                '456' => '2 класс',
                '788' => '3 класс',
                '67' => '4 класс',
            ];
        } else if($id == '486'){
            $item = [
                '345' => '5 класс',
                '26' => '6 класс',
                '3464' => '7 класс',
                '989' => '8 класс',
                '234' => '9 класс',
            ];
        }else{
            $item = [
                '239' => '10 класс',
                '221' => '11 класс',
            ];
        }


       return $item;
    }
    public function trainingClassIndividual($id = false)
    {
        $item = [
            '24' => '1 класс',
            '456' => '2 класс',
            '788' => '3 класс',
            '67' => '4 класс',
            '345' => '5 класс',
            '26' => '6 класс',
            '3464' => '7 класс',
            '989' => '8 класс',
            '234' => '9 класс',
            '239' => '10 класс',
            '221' => '11 класс',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function trainingClassIndividualName($id = false)
    {
        $item = [
            '24' => '1',
            '456' => '2',
            '788' => '3',
            '67' => '4',
            '345' => '5',
            '26' => '6',
            '3464' => '7',
            '989' => '8',
            '234' => '9',
            '239' => '10',
            '221' => '11',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function trainingClassLetter($id = false)
    {
        $item = [
            '0' => '',
            '1' => 'А',
            '2' => 'Б',
            '3' => 'В',
            '4' => 'Г',
            '5' => 'Д',
            '6' => 'Е',
            '7' => 'Ж',
            '8' => 'З',
            '9' => 'И',
            '10' => 'Й',
            '11' => 'К',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function trainingClassIndividualDecoding($id)
    {
        $item = [
            '24' => '1',
            '456' => '2',
            '788' => '3',
            '67' => '4',
            '345' => '5',
            '26' => '6',
            '3464' => '7',
            '989' => '8',
            '234' => '9',
            '239' => '10',
            '221' => '11',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function fieldBBBB($id = false)
    {
        $item = [
            '' => '',
            '99' => 'нет',
            '100' => 'да',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function fieldTheme1($id = false)
    {
        $item = [
            '' => '',
            '99' => 'нет',
            '100' => 'да',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function fieldTheme1Decoding($id)
    {
        $item = [
            '' => '0',
            '99' => '0',
            '100' => '0.017',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function fieldTheme2($id = false)
    {
        $item = [
            '' => '',
            '77' => 'нет',
            '89' => 'да',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function fieldTheme2Decoding($id)
    {
        $item = [
            '' => '0',
            '77' => '0',
            '89' => '0.022',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function fieldTheme3($id = false)
    {
        $item = [
            '' => '',
            '23' => 'нет',
            '45' => 'да',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function fieldTheme3Decoding($id)
    {
        $item = [
            '' => '0',
            '23' => '0',
            '45' => '0.014',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function fieldTheme4($id = false)
    {
        $item = [
            '' => '',
            '56' => 'нет',
            '78' => 'да',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function fieldTheme4Decoding($id)
    {
        $item = [
            '' => '0',
            '56' => '0',
            '78' => '0.029',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function fieldTheme5($id = false)
    {
        $item = [
            '' => '',
            '23' => 'нет',
            '47' => 'да',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function fieldTheme5Decoding($id)
    {
        $item = [
            '' => '0',
            '23' => '0',
            '47' => '0.064',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function fieldTheme6($id = false)
    {
        $item = [
            '' => '',
            '33' => 'нет',
            '67' => 'да',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function fieldTheme6Decoding($id)
    {
        $item = [
            '' => '0',
            '33' => '0',
            '67' => '0.013',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }

    public function fieldThemeIndividual($id = false)
    {
        $item = [
            '' => '',
            '99' => 'нет',
            '100' => 'да',
        ];
        return (!is_bool($id)) ? $item[$id] : $item;
    }
    public function fieldTheme1IndividualDecoding($id)
    {
        $item = [
            '' => '0',
            '99' => '0',
            '100' => '0.029',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function fieldTheme2IndividualDecoding($id)
    {
        $item = [
            '' => '0',
            '99' => '0',
            '100' => '0.014',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function fieldTheme3IndividualDecoding($id)
    {
        $item = [
            '' => '0',
            '99' => '0',
            '100' => '0.029',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function fieldTheme41IndividualDecoding($id)
    {
        $item = [
            '' => '0',
            '99' => '0',
            '100' => '0.045',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function fieldTheme42IndividualDecoding($id)
    {
        $item = [
            '' => '0',
            '99' => '0',
            '100' => '0.018',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function fieldTheme51IndividualDecoding($id)
    {
        $item = [
            '' => '0',
            '99' => '0',
            '100' => '0.145',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function fieldTheme52IndividualDecoding($id)
    {
        $item = [
            '' => '0',
            '99' => '0',
            '100' => '0.058',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
    public function fieldTheme6IndividualDecoding($id)
    {
        $item = [
            '' => '0',
            '99' => '0',
            '100' => '0.079',
        ];
        return ($item[$id]) ? $item[$id] : 0;
    }
}