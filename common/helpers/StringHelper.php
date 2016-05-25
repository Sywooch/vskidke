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
            '7','8','9','0','.',',',
            '(',')','[',']','!','?',
            '&','^','%','@','*','$',
            '<','>','/','|','+','-',
            '{','}','`','~'];
        // Генерируем пароль
        $password = "";
        for($i = 0; $i < $number; $i++){
            $index = rand(0, count($symbols) - 1);
            $password .= $symbols[$index];
        }
        return $password;
    }
}