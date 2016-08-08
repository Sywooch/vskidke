<?php
namespace frontend\controllers;

use common\models\Discounts;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class CityApiController extends ActiveController {
    public $modelClass = 'common\models\City';

    public function actions()
    {
        $actions = parent::actions();

        // отключить действия "delete", "create, view, update"
        unset($actions['delete'], $actions['create'], $actions['view'], $actions['update']);

        return $actions;
    }

    /**
     * @api {get} city-apis
     * @apiName GetCities
     * @apiDescription Get list cities
     * @apiGroup City
     * @apiVersion 0.1.0
     *  @apiHeaderExample {json} Header-Example:
     *     {
     *       "Accept: application/json"
     *     }
     */
}