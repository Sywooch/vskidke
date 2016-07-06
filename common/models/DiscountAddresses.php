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

    public static function attachTags($addresses, $model) {
        parent::deleteAll(['discount_id' => $model->discount_id]);

        if (is_array($addresses)) {
            foreach ($addresses AS $address) {
                $relation               = new self();
                $relation->address_id   = $address;
                $relation->discount_id = $model->discount_id;
                $relation->save();
            }
        }

        return true;
    }

    public static function getDiscountAddresses($model) {
        $addresses = parent::find()->where(['discount_id' => $model->discount_id])->all();
        $result    = [];
        $i         = 0;

        foreach ($addresses as $address) {
            /** @var CompanyAddresses $companyAddress */
            $companyAddress     = $address->relatedRecords['address'];
            $city               = $companyAddress->relatedRecords['city'];
            $result[$i]   = $companyAddress->id;
//            $result[$companyAddress->id]['name'] = $city->city_name . ' ' . $companyAddress->address;
            $i++;
        }

        return $result;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(CompanyAddresses::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discounts::className(), ['discount_id' => 'discount_id'])->inverseOf('discountAddresses');
    }
}
