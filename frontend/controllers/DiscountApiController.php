<?php
namespace frontend\controllers;

use common\models\Discounts;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class DiscountApiController extends ActiveController {
    public $modelClass = 'common\models\Discounts';

    public function actions()
    {
        return array_merge(
            parent::actions(),
            [
                'index' => [
                    'class' => 'yii\rest\IndexAction',
                    'modelClass' => $this->modelClass,
                    'checkAccess' => [$this, 'checkAccess'],
                    'prepareDataProvider' => function ($action) {
                        /* @var $model Discounts */
                        $model        = new $this->modelClass;
                        $query        = $model::find()->where(['>=', 'discount_date_end', date('Y-m-d')]);
                        $params       = \Yii::$app->request->get();

                        if(isset($params['category'])) {
                            $query->where(['category_id' => $params['category']]);
                        }elseif (isset($params['city'])) {
                            $query->joinWith('address')->andWhere(['company_addresses.city_id' => $params['city']]);
                        }

                        return $query->asArray()->all();
                    }
                ],
                'view' => [
                    'class' => 'yii\rest\ViewAction',
                    'modelClass' => $this->modelClass,
                    'checkAccess' => [$this, 'checkAccess'],
                    'findModel' => function ($id) {
                        /* @var $model Discounts */
                        $model        = new $this->modelClass;
                        $query        = $model::find()->where(['discount_id' => $id])->with('address', 'comments');

                        return $query->asArray()->one();
                    }
                ]
            ]
        );
    }
}