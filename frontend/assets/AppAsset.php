<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        'css/main.css',
        'css/jquery.formstyler.css',
        'css/jquery.mCustomScrollbar.min.css',
    ];
    public $js = [
        'http://maps.googleapis.com/maps/api/js?key=AIzaSyCoxwf8_9WJvLTDR0dFtPmkiw1ysqO-n7c',
        'js/app.js',
        'js/jquery.form.min.js',
        'js/jquery.formstyler.min.js',
        'js/jquery.mCustomScrollbar.min.js',
        'js/main.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
