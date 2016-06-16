<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "discount_addresses".
 *
 * @property integer $id
 * @property integer $discount_id
 * @property integer $address_id
 *
 * @property CompanyAddresses $address
 * @property Discounts $discount
 */
class DiscountAddresses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount_addresses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['discount_id', 'address_id'], 'required'],
            [['discount_id', 'address_id'], 'integer'],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyAddresses::className(), 'targetAttribute' => ['address_id' => 'id']],
            [['discount_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discounts::className(), 'targetAttribute' => ['discount_id' => 'discount_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'discount_id' => 'Discount ID',
            'address_id' => 'Address ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(CompanyAddresses::className(), ['id' => 'address_id'])->inverseOf('discountAddresses');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discounts::className(), ['discount_id' => 'discount_id'])->inverseOf('discountAddresses');
    }
}
