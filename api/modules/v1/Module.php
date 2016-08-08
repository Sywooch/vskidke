<?php

namespace api\modules\v1;

/**
 * Class Module
 * @author Maksim Nikitenko <lycifer3.mn@gmail.com>
 * @package api\modules\v1
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'api\modules\v1\controllers';
    
    public function init()
    {
        parent::init();
    }
}