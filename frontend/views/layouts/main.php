<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\FancyBoxAsset;
use frontend\assets\OwlCarouselAsset;
use frontend\widgets\footer\FooterWidget;
use frontend\widgets\header\HeaderWidget;
use yii\helpers\Html;
use frontend\assets\AppAsset;

OwlCarouselAsset::register($this);
FancyBoxAsset::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?= HeaderWidget::widget(); ?>
        <?= $content ?>
    <?= FooterWidget::widget()?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
