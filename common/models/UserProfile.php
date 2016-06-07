<?php
namespace common\models;

use yii\db\ActiveRecord;
use Yii;

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
 * @property string $img
 */
class UserProfile extends ActiveRecord {
    public static function tableName() {
        return 'user_profile';
    }

    public function rules() {
        return [
            [['id', 'user_id'], 'integer'],
            [['profile_name', 'profile_phone', 'profile_site', 'img'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels() {
        return [
            'profile_name'  => 'Компания',
            'profile_phone' => 'Телефон',
            'profile_site'  => 'Сайт',
            'img'           => 'Изображение'
        ];
    }

    public function getImg($size = 'original')
    {
        $sizes = ['original', 'big', 'medium', 'small'];
        if (!in_array($size, $sizes)) {
            throw new \yii\web\HttpException(404, 'Изображение не найдено');
        }
        if ($size == 'original') {
            $img = $this->img;
        } else {
            $img = str_replace('/original/', '/thumbs_' . $size . '/', $this->img);
        }
        $newImg = Yii::getAlias('@frontend/web/upload') . $img;

        if (!file_exists($newImg) || is_dir($newImg)) {
            $img = '/../img/bg-img.jpg';
        } else {
            $img = Yii::$app->params['uploadUrl'] . $img;
        }

        return $img;
    }
}