<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class FancyBoxAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/fancybox/jquery.fancybox.css',
    ];
    public $js = [
        'js/fancybox/jquery.fancybox.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}