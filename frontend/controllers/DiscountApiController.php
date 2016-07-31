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
                        $model = new $this->modelClass;
                        $query = $model::find();
                        $dataProvider = new ActiveDataProvider(['query' => $query]);
                        $model->setAttribute('category_id', $_GET['category']);
                        $query->where(['category_id' => $model->category_id]);
                        return $dataProvider;
                    }
                ]
            ]
        );
    }
}