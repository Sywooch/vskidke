<?php
namespace frontend\widgets\header;

use yii\bootstrap\Widget;

class HeaderWidget extends Widget
{

    public function run(){
        return $this->render('index');
    }

}