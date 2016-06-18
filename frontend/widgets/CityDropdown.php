<?php
namespace frontend\widgets;

use common\models\City;
use Yii;
use yii\helpers\Html;

class CityDropdown extends \yii\bootstrap\Widget
{
    private static $_labels;

    private $_isError;
    
    private $items;
    
    private $active;

    public function init()
    {
        $route   = Yii::$app->controller->route;
        $appCity = (isset(Yii::$app->request->cookies['city'])) ? Yii::$app->request->cookies['city']->value : 'kiev';
        $params  = $_GET;
        $this->_isError = $route === Yii::$app->errorHandler->errorAction;

        array_unshift($params, '/'.$route);

        foreach (City::find()->asArray()->all() as $key => $city) {
            $params['city'] = $city['uri'];

            if ($city['uri'] === $appCity) {
                $this->active = \yii\helpers\Url::to($params['city']);
            }

            $this->items[\yii\helpers\Url::to($params['city'])] = self::label($key);
        }
    }

    public function run()
    {
        // Only show this widget if we're not on the error page
        if ($this->_isError) {
            return '';
        } else {
            $data  = Html::beginForm();
            $data .= Html::hiddenInput('_csrf', Yii::$app->request->getCsrfToken());
            $data .= Html::dropDownList('city', $this->active, $this->items, ['id' => 'citySwitch']);
            $data .= Html::endForm();
            return $data;
        }
    }

    public static function label($index)
    {
        if (self::$_labels===null) {
            self::$_labels = City::find()->asArray()->all();
        }

        return isset(self::$_labels[$index]['city_name']) ? self::$_labels[$index]['city_name'] : null;
    }
}