<?php
use common\models\Categories;
use common\models\City;
use frontend\widgets\CityDropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var Categories $category */
$category;
?>

<header class="header">
    <div class="topbar container">
        <div class="logo-holder"><strong class="logo"><a href="<?= Url::to(['/discount/index']); ?>"></a></strong></div>
        <div class="btn-holder">
            <div class="col-left">
                <a href="<?= Url::to(['/discount/create']); ?>" <?php if(Yii::$app->user->isGuest): ?>id="error"<?php endif; ?> class="btn-info">Разместить скидку</a>
                <div class="select-town">
                    <?= CityDropdown::widget(); ?>
<!--                    --><?php //Html::dropDownList('city_id', 'city_id', ArrayHelper::map(City::find()->all(), 'city_id', 'city_name'), ['class' => 'town', 'id' => 'city']); ?>
                </div>
            </div>
            <div class="col-right">
                <?php if(Yii::$app->user->isGuest): ?>
                    <a href="#" id="login" class="btn-default">Вход</a>
                    <a href="#" id="register" class="registration">Регистрация</a>
                <?php else: ?>
                    <a href="<?= Url::to(['/site/logout'])?>" class="btn-default">Выход</a>
                    <a href="<?= Url::to(['/company/index']); ?>" class="registration">Мои данные</a>
                <?php endif; ?>
            </div>
        </div>
        <nav class="navbar">
            <!--span.menu-btn#toggle-menu-->
            <!--#collaps-menu.collapse-menu-->
            <ul class="menu">
                <li><a href="<?= Url::to(['/discount/index']); ?>" class="all"> Все</a></li>
                <?php foreach (Categories::find()->all() as $category): ?>
                    <li><a href="<?= Url::to(['/discount/index', 'category' => $category->category_id]); ?>" class="<?= Categories::getCategoryIcon($category->category_name); ?>"><?= $category->category_name; ?></a></li>
                <?php endforeach; ?>
                <li><a href="#" class="search"> Поиск</a></li>
            </ul>
        </nav>
    </div>
    <div id="owl-header" class="owl-carousel owl-theme">
        <img src="../images/header-banner.png" onerror="src=''">
        <img src="../images/header-banner.png" onerror="src=''">
        <img src="../images/header-banner.png" onerror="src=''">
        <img src="../images/header-banner.png" onerror="src=''">
        <img src="../images/header-banner.png" onerror="src=''">
        <img src="../images/header-banner.png" onerror="src=''">
        <img src="../images/header-banner.png" onerror="src=''">
        <img src="../images/header-banner.png" onerror="src=''">
        <div class="owl-controls">
            <div id="customNav" class="owl-nav"></div>
            <div id="customDots" class="owl-dots"></div>
        </div>
    </div>
</header>