<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class OwlCarouselAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/owl-carousel/owl.carousel.css',
    ];
    public $js = [
        'js/owl-carousel/owl.carousel.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}