<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sities".
 *
 * @property integer $city_id
 * @property string $city_name
 *
 * @property Discounts[] $discounts
 */
class Sities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'city_id' => 'City ID',
            'city_name' => 'City Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscounts()
    {
        return $this->hasMany(Discounts::className(), ['city_id' => 'city_id']);
    }
}
