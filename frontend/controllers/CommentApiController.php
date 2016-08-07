<?php
namespace frontend\controllers;

use common\models\Discounts;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class CommentApiController extends ActiveController {
    public $modelClass = 'common\models\Comment';
}