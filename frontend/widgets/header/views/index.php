<?php
use yii\helpers\Url;
?>

<header class="header">
    <div class="topbar container">
        <div class="logo-holder"><strong class="logo"><a href="<?= Url::to(['/']); ?>"></a></strong></div>
        <div class="btn-holder">
            <div class="col-left">
                <a href="<?= Url::to(['/discount/create']); ?>" class="btn-info">Разместить скидку</a>
                <div class="select-town">
                    <select name="town">
                        <option value="1">Днепропетровск</option>
                        <option value="2">Киев</option>
                    </select>
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
                <li><a href="#" class="all"> Все</a></li>
                <li><a href="#" class="pretty"> Красота</a></li>
                <li><a href="#" class="health"> Здоровье</a></li>
                <li><a href="#" class="mode"> Мода</a></li>
                <li><a href="#" class="food"> Еда</a></li>
                <li><a href="#" class="entertainment"> Развлечение</a></li>
                <li><a href="#" class="rest"> Отдых</a></li>
                <li><a href="#" class="sport"> Спорт</a></li>
                <li><a href="#" class="training"> Обучение</a></li>
                <li><a href="#" class="goods"> Товары</a></li>
                <li><a href="#" class="services"> Услуги</a></li>
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