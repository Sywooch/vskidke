<?php
namespace frontend\controllers;

use common\models\Discounts;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class CityApiController extends ActiveController {
    public $modelClass = 'common\models\City';

    /**
     * @ApiDescription(section="City", description="Get list cities")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/city-apis")
     * @ApiParams(name="city_id", type="integer", nullable=false, description="City id")
     * @ApiParams(name="data", type="array", sample="{'city_id':'int','city_name':'string', 'uri':'string'}")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *  'transaction_id':'int',
     *  'transaction_status':'string'
     * }")
     */
}