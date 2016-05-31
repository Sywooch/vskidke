<?php
namespace common\models;

use yii\db\ActiveRecord;

class City extends ActiveRecord {
    public static function tableName() {
        return 'cities';
    }

    public function rules() {
        return [
            ['city_id', 'integer'],
            ['city_name', 'string', 'max' => 150]
        ];
    }

    public function attributeLabels() {
        return [
            'city_name' => 'Название города'
        ];
    }
}