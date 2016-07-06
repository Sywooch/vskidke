<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banners".
 *
 * @property integer $id
 * @property string $img
 * @property integer $position
 * @property string $link
 */
class Banners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position'], 'required'],
            [['position'], 'integer'],
            [['link'], 'string', 'max' => 255],
            ['img', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Изображение',
            'position' => 'Позиция',
            'link' => 'Ссылка'
        ];
    }

    public static function getPositions() {
        return [
            '1' => 'Левый',
            '2' => 'Правый',
            '3' => 'Топ',
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
            $img = '/../images/header-banner.png';
        } else {
            $img = Yii::$app->params['uploadUrl'] . $img;
        }

        return $img;
    }
}
