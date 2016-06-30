<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class Comment
 * @package common\models
 */
class Comment extends ActiveRecord {

    const NOT_DELETED     = 0;
    const DELETED         = 1;
    const STATUS_MODERATE = 0;
    const STATUS_ACTIVE   = 1;

    /**
     * @return string
     */
    public static function tableName() {
        return 'comments';
    }

    /**
     * @return array
     */
    public function rules() {
        return [
            [['name', 'text'], 'required', 'message' => 'Поле не может быть пустым'],
            [['name', 'text'], 'filter', 'filter' => 'trim'],
            [['name', 'text'], 'filter', 'filter' => function($value){return strip_tags($value);}],
            [['discount_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discounts::className(), 'targetAttribute' => ['discount_id' => 'discount_id']],
            [['user_id'], 'integer'],
            [['date'], 'safe']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'text' => 'Текст',
            'status' => 'Статус'
        ];
    }

    /**
     * @return $this
     */
    public static function find() {
        return parent::find()->andWhere(['deleted' => self::NOT_DELETED]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->with('profile');
    }
}