<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\BoodstrapAsset;
use frontend\assets\FancyBoxAsset;
use frontend\assets\OwlCarouselAsset;
use frontend\widgets\footer\FooterWidget;
use frontend\widgets\header\HeaderWidget;
use rkit\yii2\plugins\ajaxform\Asset;
use yii\helpers\Html;
use frontend\assets\AppAsset;

OwlCarouselAsset::register($this);
FancyBoxAsset::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <style type="text/css">
        html, body { height: 100%; margin: 0; padding: 0; }
        #map { height: 300px; display: none}
    </style>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css" type="text/css" />
    <script async defer
            src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCoxwf8_9WJvLTDR0dFtPmkiw1ysqO-n7c">
    </script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1560917077537659',
            xfbml      : true,
            version    : 'v2.6'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

    <?= HeaderWidget::widget(); ?>
        <?= $content ?>
    <?= FooterWidget::widget()?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>