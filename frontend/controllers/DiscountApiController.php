<?php
namespace frontend\controllers;

use common\models\Discounts;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class DiscountApiController extends ActiveController {
    public $modelClass = 'common\models\Discounts';

    public function actions()
    {
        $actions = parent::actions();
        // отключить действия "delete", "create", "update"
        unset($actions['delete'], $actions['create'], $actions['update']);

        return array_merge(
            $actions,
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

    /**
     * @api {get} discount-apis
     * @apiName GetDiscounts
     * @apiDescription Get list discounts
     * @apiGroup Discounts
     * @apiHeaderExample {json} Header-Example:
     *     {
     *       "Accept: application/json"
     *     }
     * @apiSuccessExample {json} Success-Response:.
     * HTTP/1.1 200 OK
     * [
     *      {
     *       "discount_id": "1420",
     *       "user_id": "423",
     *       "category_id": "4",
     *       "city_id": null,
     *       "discount_view": "14",
     *       "discount_title": "Предложение выходного дня",
     *       "discount_text": "Суббота и воскресенье с 12:00 до 17:00\r\n\r\nСкидки 30% на всю кухню, бар и кальян",
     *       "discount_date_start": "2016-07-07",
     *       "discount_date_end": "2016-12-31",
     *       "discount_app": "0",
     *       "discount_view_email": "0",
     *       "discount_price": null,
     *       "discount_old_price": null,
     *       "discount_percent": "30",
     *       "discount_gift": "",
     *       "img": "/discount/original/caf7bc40c0.jpg",
     *       "date_create": "2016-06-01"
     *       },
     *       {
     *       "discount_id": "1421",
     *       "user_id": "423",
     *       "category_id": "4",
     *       "city_id": null,
     *       "discount_view": "13",
     *       "discount_title": "Женское счастье ",
     *       "discount_text": "Каждую среду только для женской компании скидка -30% на всю кухню, бар и кальян.",
     *       "discount_date_start": "2016-07-07",
     *       "discount_date_end": "2016-12-31",
     *       "discount_app": "0",
     *       "discount_view_email": "0",
     *       "discount_price": null,
     *       "discount_old_price": null,
     *       "discount_percent": "30",
     *       "discount_gift": "",
     *       "img": "/discount/original/8bf96b2ed0.jpg",
     *       "date_create": "2016-06-01"
     *       }
     * ]
     */

    /**
     * @api {get} discount-apis/:id
     * @apiName GetDiscount
     * @apiDescription Get one discount
     * @apiGroup Discounts
     * @apiHeaderExample {json} Header-Example:
     *     {
     *       "Accept: application/json"
     *     }
     * @apiSuccessExample {json} Success-Response:.
     * HTTP/1.1 200 OK
     * {
     *       "discount_id": "1481",
     *       "user_id": "11",
     *       "category_id": "3",
     *       "city_id": null,
     *       "discount_view": "13",
     *       "discount_title": "Тестовая скидка",
     *       "discount_text": "текст тестовой скидки",
     *       "discount_date_start": "2016-07-15",
     *       "discount_date_end": "2016-07-30",
     *       "discount_app": "0",
     *       "discount_view_email": "0",
     *       "discount_price": null,
     *       "discount_old_price": null,
     *       "discount_percent": "58",
     *       "discount_gift": "",
     *       "img": "/discount/original/65d6023e9f.jpg",
     *       "date_create": "2016-07-15",
     *       "address": [
     *           {
     *           "id": "57",
     *           "user_id": "11",
     *           "city_id": "5",
     *           "address": "Чорновола 20",
     *           "lat": "50.4547908",
     *           "lng": "30.4849079",
     *           "phone": "+380971161171"
     *           },
     *           {
     *           "id": "58",
     *           "user_id": "11",
     *           "city_id": "5",
     *           "address": "карла маркса 28",
     *           "lat": "50.381974",
     *           "lng": "30.691135",
     *           "phone": "+38 (093) 720-7009"
     *           },
     *           {
     *           "id": "64",
     *           "user_id": "11",
     *           "city_id": "5",
     *           "address": "тростянецкая 1",
     *           "lat": "50.4139549",
     *           "lng": "30.6466682",
     *           "phone": "0971161171"
     *           }
     *       ],
     *       "comments": [
     *           {
     *           "id": "1",
     *           "discount_id": "1481",
     *           "user_id": "11",
     *           "name": "Максим",
     *           "text": "Кульна акция Вау!!!",
     *           "date": "2016-07-15 10:20:24",
     *           "status": "1",
     *           "deleted": "0"
     *           },
     *           {
     *           "id": "3",
     *           "discount_id": "1481",
     *           "user_id": null,
     *           "name": "Максим",
     *           "text": "Кульна акция Вау api!!!",
     *           "date": "2016-08-07 19:50:24",
     *           "status": "1",
     *           "deleted": "0"
     *           }
     *       ]
     *   }
     */
}