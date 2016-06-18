<?php
namespace frontend\controllers;

use \Yii;
use yii\web\Cookie;

class BaseController extends \yii\web\Controller
{
    public function init()
    {
        if(!isset(\Yii::$app->request->cookies['city'])) {
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new Cookie(['name' => 'city', 'value' => 'kiev']));
        }
        
        return parent::init();
    }
}