<?php

/* @var $this yii\web\View */

use common\models\Categories;
use common\models\Discounts;
use frontend\components\LinkPager;

$this->title = 'Vskidke.com';

/** @var Discounts $model */
$model;
?>

<div class="container main">
    <div class="content">
        <div class="filter-holder">
            <div class="btn-holder">
                <button class="filter-btn">новинки</button>
                <button class="filter-btn active">популярные</button>
            </div>
            <div class="filter-select-block"><span class="descr">акций на странице</span>
                <select class="filter-select">
                    <option>10</option>
                    <option>20</option>
                    <option>30</option>
                    <option>40</option>
                    <option>50</option>
                </select>
            </div>
        </div>
        <div class="item-list">
            <?php foreach ($models as $model): ?>
            <div class="item <?= array_rand(Categories::getColorClass(), 1); ?>">
                <div style="background:url(<?= $model->getImg('medium'); ?>) no-repeat 0 0; background-size:contain contain; " class="img-holder">
                    <div class="label">
                        <div class="price">
                            <span class='old-price'><?= $model->discount_old_price; ?></span> <?= $model->discount_price; ?> грн
                        </div>
                    </div>
                    <div class="info-block">
                        <div class="views">123</div>
                        <div class="os-holder">
                            <a href="" class="android"></a>
                            <a href="" class="mac"></a>
                        </div>
                    </div>
                </div>
                <div class="text-holder">
                    <div class="item-title"><?= $model->discount_title; ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination-holder">
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]);?>
<!--            <ul class="pagination-block">-->
<!--                <!--li(role='menuitem').pagination-prev.disabled-->-->
<!--                <!--    a(href='#', aria-label='Previous', role='link') Назад-->-->
<!--                <li role="menuitem" class="disabled pagination-item"><a href="javascript:void(0)" role="link">1</a></li>-->
<!--                <li role="menuitem" class="active pagination-item"><a href="javascript:void(0)" role="link">2</a></li>-->
<!--                <li role="menuitem" class="pagination-item"><a href="javascript:void(0)" role="link">3</a></li>-->
<!--                <li role="menuitem" class="pagination-item"><a href="javascript:void(0)" role="link">4</a></li>-->
<!--                <li role="menuitem" class="disabled pagination-item"><a href="javascript:void(0)" role="link">...</a></li>-->
<!--                <li role="menuitem" class="pagination-item"><a href="javascript:void(0)" role="link">22</a></li>-->
<!--                <!--li(role='menuitem').pagination-next-->-->
<!--                <!--    a(href='javascript:void(0)', aria-label='Previous', role='link') Вперед-->-->
<!--            </ul>-->
        </div>
    </div>
    <aside class="sidebar-left sidebar"><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a></aside>
    <aside class="sidebar-right sidebar"><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a><a href="#" class="sidebar-banner"><img src="../images/banner.png" onerror="src=&quot;../images/banner.png&quot;"></a></aside>
</div>