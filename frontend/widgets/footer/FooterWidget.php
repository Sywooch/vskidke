<?php
namespace frontend\widgets\footer;

use yii\bootstrap\Widget;

class FooterWidget extends Widget
{

    public function run(){
        return $this->render('index');
    }

}