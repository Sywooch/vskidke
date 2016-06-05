<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_profile".
 *
 * Class UserProfile
 * @package common\models
 * @author Maksim Nikitenko <lycifer3.mn@gmail.com>
 *
 * @property string $profile_name
 * @property string $profile_phone
 * @property string $profile_site
 * @property integer $id
 * @property integer $user_id
 * @property string $profile_img
 */
class UserProfile extends ActiveRecord {
    public static function tableName() {
        return 'user_profile';
    }

    public function rules() {
        return [
            [['id', 'user_id'], 'integer'],
            [['profile_name', 'profile_phone', 'profile_site', 'profile_img'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels() {
        return [
            'profile_name'  => 'Компания',
            'profile_phone' => 'Телефон',
            'profile_site'  => 'Сайт'
        ];
    }
}