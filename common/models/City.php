<?php
namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;

/**
 * Class City
 * @package common\models
 */
class City extends ActiveRecord {
    /**
     * @return string
     */
    public static function tableName() {
        return 'cities';
    }

    /**
     * @return array
     */
    public function rules() {
        return [
            ['city_id', 'integer'],
            ['city_name', 'string', 'max' => 150]
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels() {
        return [
            'city_name' => 'Название города'
        ];
    }

    public function behaviors() {
        $behaviors         = parent::behaviors();
        $behaviors['slug'] = [
            'class' => SluggableBehavior::className(),
            'slugAttribute' => 'uri',
            'ensureUnique'  => TRUE,
            'value'         => function ($event) {
                if (!empty($event->sender->uri)) {
                    return $event->sender->uri;
                }

                return Inflector::slug($event->sender->city_name);
            },
        ];

        return $behaviors;
    }

    public static function getCityId() {
        if (isset(\Yii::$app->request->cookies['city'])){
            $city = parent::findOne(['uri' => \Yii::$app->request->cookies['city']->value]);
        } else {
            $city = parent::findOne(['uri' => \Yii::$app->params['city']]);
        }

        return (isset($city) && isset($city->city_id)) ? $city->city_id : null;
    }

    public static function getCityName($id) {
        $city = parent::findOne($id);

        return $city->city_name;
    }
}