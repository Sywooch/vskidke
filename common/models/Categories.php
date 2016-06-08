<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $category_id
 * @property string $category_name
 *
 * @property Discounts[] $discounts
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name'], 'string', 'max' => 100],
        ];
    }

    public static function getColorClass() {
        return [
            '0'  => 'purple',
            '1'  => 'purple-light',
            '2'  => 'violet-light',
            '3'  => 'violet',
            '4'  => 'blue-light',
            '5'  => 'blue',
            '6'  => 'green',
            '7'  => 'green-light',
            '8'  => 'orange-light',
            '9'  => 'orange',
            '10' => 'pink',
            '11' => 'yellow',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscounts()
    {
        return $this->hasMany(Discounts::className(), ['category_id' => 'category_id']);
    }
}
