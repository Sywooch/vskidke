<?php
use common\models\Banners;
use common\models\Categories;
use frontend\widgets\CityDropdown;
use yii\helpers\Url;

/** @var Categories $category */
$category;
?>

<header class="header">
    <div class="topbar container">
        <span id="toggle-menu" class="menu-btn"><a href="#"></a></span>
        <span class="user" id="toggle-header-dropdown"><a href="#"></a></span>
        <div class="logo"><a href="<?= Url::to(['/discount/index']); ?>"></a>
        </div>
        <a href="<?= Url::to(['/discount/create']); ?>" class="mobile-create-btn" <?php if (Yii::$app->user->isGuest): ?>id="error"<?php endif; ?>></a>

        <div class=" collapse-menu" id="collapse-menu">

            <div class="btn-holder">
                <div class="btn-row">
                    <a href="#"
                       <?php if (Yii::$app->user->isGuest): ?>id="error"<?php endif; ?> class="btn-info create-btn">Разместить
                        скидку</a>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <a href="#" id="login" class="btn-default login-btn">Вход</a>
                    <?php else: ?>
                        <a href="<?= Url::to(['/site/logout']) ?>" class="btn-default login-btn">Выход</a>
                    <?php endif; ?>
                </div>
                <div class="select-row">
                    <?php if (Yii::$app->user->isGuest): ?>
                        <a href="#" id="register" class="registration">Регистрация</a>
                    <?php else: ?>
                        <span class="dropdown-wrapp">
                            <a href="#" class="registration dropdown-button">Мои данные</a>
                            <ul class="dropdown-menu" id="header-dropdown-menu">
                                <li>
                                    <a href="<?= Url::to(['/company/index']); ?>">Мои данные</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/company/edit-password', 'id' => Yii::$app->user->identity->getId()]); ?>">Сменить пароль</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/discount/my-discounts']); ?>">Мои скидки</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="#">На расмотрении</a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::to(['/discount/my-discounts', 'active' => true]); ?>">Активные</a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::to(['/discount/my-discounts', 'archive' => true]); ?>">Архивные</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/discount/create']); ?>">Разместить скидку</a>
                                </li>
                            </ul>
                        </span>
                    <?php endif; ?>
                    <div class="select-town">
                        <?= CityDropdown::widget(); ?>
                        <!--                    --><?php //Html::dropDownList('city_id', 'city_id', ArrayHelper::map(City::find()->all(), 'city_id', 'city_name'), ['class' => 'town', 'id' => 'city']); ?>
                    </div>
                </div>
            </div>
            <nav class="navbar">
                <ul class="menu">
                    <li><a href="<?= Url::to(['/discount/index']); ?>" class="all"> Все</a></li>
                    <?php foreach (Categories::find()->all() as $category): ?>
                        <li><a href="<?= Url::to(['/discount/index', 'category' => $category->category_id]); ?>"
                               class="<?= Categories::getCategoryIcon($category->category_name); ?>"><?= $category->category_name; ?></a>
                        </li>
                    <?php endforeach; ?>
                    <li><a href="#" class="search search-modal-link"> Поиск</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div id="owl-header" class="owl-carousel owl-theme">
        <?php foreach(Banners::find()->where(['position' => '3'])->all() as $banner): ?>
            <a href="<?= $banner->link; ?>" target="_blank">
                <img src="<?= $banner->getImg(); ?>" onerror="src='/images/header-banner.png'">
            </a>
        <?php endforeach; ?>
<!--        <div class="owl-controls">-->
<!--            <div id="customNav" class="owl-nav"></div>-->
<!--            <div id="customDots" class="owl-dots"></div>-->
<!--        </div>-->
    </div>
</header>