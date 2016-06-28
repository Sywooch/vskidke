<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "discounts".
 *
 * @property integer $discount_id
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $city_id
 * @property string  $discount_view
 * @property string $discount_title
 * @property string $discount_text
 * @property string $discount_date_start
 * @property string $discount_date_end
 * @property integer $discount_app
 * @property integer $discount_view_email
 * @property integer $discount_price
 * @property integer $discount_old_price
 * @property integer $discount_percent
 * @property string  $discount_gift
 * @property string $img
 * @property string $date_create
 *
 * @property Categories $category
 * @property City $city
 * @property User $user
 */
class Discounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id', 'discount_title', 'discount_text', 'discount_date_start', 'discount_date_end'], 'required', 'message' => 'Поле не может быть пустым'],
            [['user_id', 'category_id', 'city_id', 'discount_price', 'discount_old_price', 'discount_percent', 'discount_view'], 'integer'],
            [['discount_text', 'discount_app', 'discount_view_email', 'discount_gift'], 'string'],
            [['discount_date_start', 'discount_date_end'], 'safe'],
            [['discount_title', 'img'], 'string', 'max' => 255],
            [['date_create'], 'date', 'format' => 'Y-m-d'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'category_id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'city_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'discount_id' => 'Discount ID',
            'user_id' => 'User ID',
            'category_id' => 'Рубрика',
            'city_id' => 'Город',
            'discount_title' => 'Название скидки',
            'discount_text' => 'Текст скидки',
            'discount_date_start' => 'Дата начала скидки',
            'discount_date_end' => 'Дата окончания скидки',
            'discount_app' => 'Скидка в приложении',
            'discount_view_email' => 'Скрыть email',
            'discount_price' => 'Новая цена',
            'discount_old_price' => 'Старая цена',
            'discount_percent' => 'Процент скидки',
            'discount_gift' => 'Подарок'
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['city_id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getAddress() {
        return $this->hasMany(CompanyAddresses::className(), ['id' => 'address_id'])->viaTable(DiscountAddresses::tableName(), ['discount_id' => 'discount_id']);
    }

    public function getDiscount_addresses() {
        return $this->hasOne(DiscountAddresses::className(), ['discount_id' => 'discount_id']);
    }
}
