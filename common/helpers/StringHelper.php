<?php
namespace common\helpers;

class StringHelper {
    /**
     * Password Generator
     * @param $number
     * @return string
     */
    public static function generatePassword($number = 10)
    {
        $symbols = ['a','b','c','d','e','f',
            'g','h','i','j','k','l',
            'm','n','o','p','r','s',
            't','u','v','x','y','z',
            'A','B','C','D','E','F',
            'G','H','I','J','K','L',
            'M','N','O','P','R','S',
            'T','U','V','X','Y','Z',
            '1','2','3','4','5','6',
            '7','8','9','0',
//            '.',',',
//            '(',')','[',']','!','?',
//            '&','^','%','@','*','$',
//            '<','>','/','|','+','-',
//            '{','}','`','~'
        ];
        // Генерируем пароль
        $password = "";
        for($i = 0; $i < $number; $i++){
            $index = rand(0, count($symbols) - 1);
            $password .= $symbols[$index];
        }
        return $password;
    }

    /**
     * @param $num
     * @param $formFor_1
     * @param $formFor_2
     * @param $formFor_3
     * @return mixed
     */
    public static function trueWordForm($num, $formFor_1, $formFor_2, $formFor_3){
        $num = abs($num) % 100;
        $num_x = $num % 10;
        if ($num > 10 && $num < 20)
            return $formFor_3;
        if ($num_x > 1 && $num_x < 5) // иначе если число оканчивается на 2,3,4
            return $formFor_2;
        if ($num_x == 1) // иначе если оканчивается на 1
            return $formFor_1;
        return $formFor_3;
    }

    /**
     * @param $text
     * @param int $maxWords
     * @return string
     */
    public static function cropString($text, $maxWords = 100)
    {
        $text = strip_tags($text);
        $text = substr($text, 0, $maxWords);
        $text = substr($text, 0, strrpos($text, ' '));

        return $text . ' ...';
    }
}