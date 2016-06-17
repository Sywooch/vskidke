<?php

namespace frontend\components;

use yii\web\Cookie;

class UrlManager extends \yii\web\UrlManager
{
    public function createUrl($params)
    {
        $cookies = \Yii::$app->response->cookies;
        $city    = \Yii::$app->request->cookies;

        if(!isset($city['city'])) {
            $cookies->add(new Cookie(['name' => 'city', 'value' => 'kiev']));
        }
        
        if(!isset($params['city']) || empty($params['city'])) {
            $params['city'] = (!isset($city['city'])) ? \Yii::$app->params['city'] : $city['city']->value;
        }
      

        return parent::createUrl($params);
    }
}