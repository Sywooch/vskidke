<?php
namespace frontend\controllers;

use common\models\Discounts;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class CommentApiController extends ActiveController {
    public $modelClass = 'common\models\Comment';

    public function actions()
    {
        $actions = parent::actions();

        // отключить действия "delete", "index", "view", "update"
        unset($actions['delete'], $actions['index'], $actions['view'], $actions['update']);

        return $actions;
    }

    /**
     * @api {post} comment-apis
     * @apiName CreateComment
     * @apiDescription Create comment
     * @apiGroup Comments
     * @apiVersion 0.1.0
     *  @apiHeaderExample {json} Header-Example:
     *     {
     *       "Accept: application/json"
     *     }
     * @apiParam {String} name User name
     * @apiParam {String} text Text comment
     * @apiParam {number} [discount_id] Discount id
     * @apiParam {String} [date] Date create comment
     * @apiParamExample {json} Request-Example:
     * {
     *      "name":"user name",
     *      "text":"text comment",
     *      "discount_id": 1,
     *      "date": 2016-08-08 12:52:48 date create comment
     * }
     * @apiSuccessExample {json} Success-Response:.
     * HTTP/1.1 201 Created
     * {
     *      "discount_id": 1,
     *      "name": "user name",
     *      "text": "text comment",
     *      "date": "2016-08-07 19:50:24",
     *      "id": 3
     * }
     */
}