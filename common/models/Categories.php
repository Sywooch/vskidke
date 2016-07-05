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

    public static function getCategoryIcon($name) {
        $icons = [
            'Красота'     => 'pretty',
            'Здоровье'    => 'health',
            'Мода'        => 'mode',
            'Еда'         => 'food',
            'Развлечение' => 'entertainment',
            'Отдых'       => 'rest',
            'Спорт'       => 'sport',
            'Обучение'    => 'training',
            'Товары'      => 'goods',
            'Услуги'      => 'services',
        ];

        return $icons[$name];
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

    public static function getCategory($id) {
        return parent::findOne($id);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscounts()
    {
        return $this->hasMany(Discounts::className(), ['category_id' => 'category_id']);
    }
}
